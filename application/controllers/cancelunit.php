<?php
class cancelunit extends DBController{
	function __construct(){
		parent::__construct('cancelunit_model');
		$this->set_page_title('Unit Cancelation');
		$this->template_dir = 'finance/cancelunit';
		
		$session_id = $this->UserLogin->isLogin();
		$this->pt_id = $session_id['id_pt'];
		
		
		
	}
	
	protected function setup_form($data=false){
		$this->parameters['kary'] = $this->db->join('db_kary','id_kary = id_karyawan')
									->get('db_kwttd')->result();
		$this->parameters['cek'] = $this->db->order_by('kwitansi_id','DESC')
									->get('db_kwitansi')->row();
	}
	
	function get_json(){
		$this->set_custom_function('kwitansi_tgl','indo_date');
		$this->set_custom_function('amt','currency');
		$this->set_custom_function('outstanding','currency');
		$this->set_custom_function('selling_price','currency');
		parent::get_json();
	}
		
	//select sum(amount) as total,sum(pay_amount) as totalbayar,no_sp, id_sp, customer_nama,unit_no,id_billing

	function index(){
		$this->set_grid_column('sp_id','ID',array('hidden'=>true));
		$this->set_grid_column('no_sp','SP No',array('width'=>25,'align'=>'Left'));
		$this->set_grid_column('customer_nama','Nama Customer',array('width'=>95,'align'=>'Left'));
		$this->set_grid_column('unit_no','Unit No',array('width'=>95,'align'=>'Left'));
		$this->set_grid_column('selling_price','Selling Price',array('width'=>40,'align'=>'Right'));
		$this->set_grid_column('amt','Paid',array('width'=>40,'align'=>'Right'));
		$this->set_grid_column('outstanding','Outstanding',array('width'=>40,'align'=>'Right'));
		$this->set_grid_column('flag_id','flag_id',array('width'=>40,'align'=>'Right','hidden'=>true));
		$this->set_jqgrid_options(array('width'=>870,'height'=>300,'caption'=>'All unit with payment','sortname'=>'customer_nama','sortorder'=>'asc'));
		parent::index();		
	}
	
	
	function reschedule($id){
		$pt = $this->pt_id;
		if($pt == 44){
			$unit = "db_unit_yogya";
		}
		if($pt == 11){
			$unit = "db_unit_bdm";
		}
		if($pt == 22){
			$unit = "db_unit_bdm";
		}
		
		$SQL = "select sp_id, no_sp, selling_price, customer_nama ,unit_no
					from db_sp inner join db_customer on db_sp.id_customer = db_customer.customer_id
							   inner join ".$unit." on db_sp.id_unit = ".$unit.".unit_id
							   where db_sp.sp_id = $id";
		$data['row'] = $this->db->query($SQL)->row();
		$data['paid'] = $this->db->query("select sum(pay_amount) as paid from db_billing where id_sp = $id ")->row();
		$data['outs'] = $this->db->query("select sum(pay_sisa) as out_standing from db_billing where id_sp = $id")->row();
		$data['last_due'] = $this->db->query("select MAX(due_date) as last_due from db_billing where id_sp='2855' and pay_amount > 0")->row()->last_due;
		$data['pernah_angsuran'] = $this->db->query("select count(pay_sisa) as jml from db_billing where id_sp = $id and pay_sisa = 0")->row();
		$data['sisa_angsuran'] = $this->db->query("select count(pay_sisa) as jml from db_billing where id_sp = $id and pay_sisa > 0")->row();
		
		$this->load->view('finance/reschedule-unit',$data);
	}
	
	function proses_reschedule(){
		$month_now = date('m');
		$year_now = date('Y');
		$closing = $this->db->query("select top 1 * from db_closingfinance order by id_closf desc")->row();
		if ($month_now == $closing->periode_bulan && $year_now == $closing->periode_tahun) {
			die('Bulan tersebut sudah closing');
		} else {

			$id_sp = $this->input->post('id_sp');
			$tgl1  = $this->input->post('tgl_1');
			$tgl2  = $this->input->post('tgl_2');
			$ppm   = $this->input->post('ppm');
			$mdf   = $this->input->post('mdf');
			
			$sql_select = "select * from db_billing where id_sp = '$id_sp' and pay_amount='0'";
			
			$row = $this->db->query($sql_select)->result_array();
			
			/* Backup ke Tabel db_billing_history*/
			foreach($row as $r){ 
				/* untuk men-set nilai numeric agar tidak error pada saat insert ke table history */
				if($r['balance_amount']==""){$r['balance_amount']=0;}
				if($r['amount']==""){$r['amount']=0;}
				if($r['pay_amount']==""){$r['pay_amount']=0;}
				if($r['pay_sisa']==""){$r['pay_sisa']=0;}
				/* end if */
				
				
				$ins = "insert into db_billing_history 
						(id_billing, id_sp, tgl, no_bill, id_paygroup, amount, due_date, pay_amount, pay_sisa, tgl_paydate, 
						 balance_amount, id_payjns, bank_nm, bank_no, bank_ref, bank_duedate, id_flag,hari_sisa) 
						 values 
						('$r[id_billing]', 
						 '$r[id_sp]', 
						 '$r[tgl]', 
						 '$r[no_bill]', 
						 '$r[id_paygroup]', 
						  $r[amount], 
						 '$r[due_date]', 
						  $r[pay_amount], 
						  $r[pay_sisa], 
						 '$r[tgl_paydate]', 
						  $r[balance_amount], 
						 '$r[id_payjns]', 
						 '$r[bank_nm]', 
						 '$r[bank_no]', 
						 '$r[bank_ref]', 
						 '$r[bank_duedate]', 
						 '$r[id_flag]',
						 '$r[hari_sisa]')";		
				$this->db->query($ins);
			}
			
			/* Hapus row di db_billing untuk di buat lagi row yang baru */
			$del = "delete from db_billing where id_sp = '$id_sp' and pay_amount='0'";
			$this->db->query($del);
			
			/* set nilai jadi 0 (nol) jika ada paysisa yang memiliki nilai */
			$this->db->query("update db_billing set pay_sisa = 0 where id_sp = '$id_sp'");
			
			/* Pembuatan row baru */
			$sql = "insert into db_billing (id_sp,tgl,due_date,pay_sisa,pay_amount) values 
										   ('$id_sp',$tgl1,$tgl2,'$ppm','0')";
			for($x=1; $x<=$mdf; $x++){
				$this->db->query($sql);
			}
			
			die("success");
		}
	}
				
	function cancel($id){

			//die($id);
			$data['id'] = $id;
			$this->load->view('finance/cancelunit-cancel',$data);
			
			//die('sukses');
			//~ $this->db->query("sp_batalunit '".$id."'");
			//~ echo"
						//~ <script type='text/javascript'>
							//~ alert('Cancel Unit Berhasil');
							//~ document.location.href = 'cancelunit';
							//~ refreshTable();
						//~ </script>
					//~ ";
			#$this->db->query("sp_batalunit '".$id."'");
			//~ $data['sp'] = $this->db->select('no_sp, sp_id, customer_nama,unit_no,sum(kwtbill_pay) as amt,db_sp.id_flag as flag_id,
						//~ (select max(tgl_paydate) from db_billing where id_sp = 71) as tgl_paydate,selling_price, (selling_price-sum(kwtbill_pay)) as outstanding')
						 //~ ->group_by('no_sp,sp_id,customer_nama,unit_no,selling_price,db_sp.id_flag')
						 //~ ->having('round(sum(amount),0) >= selling_price')
						 //~ ->or_having('round(sum(amount),0) >= selling_price - 100')
						 //~ ->where('sp_id',$id)
						 //~ ->order_by('customer_nama','asc')->get('db_sp')->row();
			//~ var_dump($data['sp']);
	}
	
	function ok(){
		$month_now = date('m');
		$year_now = date('Y');
		$closing = $this->db->query("select top 1 * from db_closingfinance order by id_closf desc")->row();
		if ($month_now == $closing->periode_bulan && $year_now == $closing->periode_tahun) {
			die('Bulan tersebut sudah closing');
		} else {
			extract(PopulateForm());
			$this->db->query("sp_batalunit '".$id."'");
			die('Cancel Unit Sukses');
		}
	}
}
?>
