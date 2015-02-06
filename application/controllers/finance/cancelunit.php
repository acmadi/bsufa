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
	//die($id);
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
		//$data['last_paydate'] = $this->db->query("select 
		
		$data['pernah_angsuran'] = $this->db->query("select count(pay_sisa) as jml from db_billing where id_sp = $id and pay_sisa = 0")->row();
		$data['sisa_angsuran'] = $this->db->query("select count(pay_sisa) as jml from db_billing where id_sp = $id and pay_sisa > 0")->row();
		
		$this->load->view('finance/reschedule-unit',$data);
	}
	
	function proses_reschedule(){
			//var_dump($this->input->post('pay_dp'));exit;
			if($this->input->post('totout')!='0'){
				echo "<script>alert('Gagal Reschedule! Terdapat Kesalahan Nominal!');
				document.location.href='".base_url()."finance/cancelunit';
				</script>";
			}else{
				$pay_dp = $this->input->post('pay_dp');
				$id_sp = $this->input->post('id_sp');
				$diffmth = $this->input->post('diffmount');
				/*$tgl1  = $this->input->post('tgl_1');
				$tgl2  = $this->input->post('tgl_2');
				$ppm   = $this->input->post('ppm');
				$mdf   = $this->input->post('mdf');*/
				//var_dump($this->input->post('diffmount'));exit();
				$sql_select = "select * from db_billing where id_sp = '$id_sp' and pay_amount='0'";
				$row = $this->db->query($sql_select)->result();
				/* Backup ke Tabel db_billing_history*/
				foreach($row as $rows){
				$data = array(
				'id_billing'	=> "$rows->id_billing",
				'id_sp'			=> "$rows->id_sp",
				'tgl'			=> inggris_date($rows->tgl),
				'no_bill'		=> "$rows->no_bill",
				'id_paygroup'	=> "$rows->id_paygroup",
				'amount'		=> $rows->amount,
				'due_date'		=> inggris_date($rows->due_date),
				'pay_amount'	=> $rows->pay_amount,
				'pay_sisa'		=> $rows->pay_sisa,
				'tgl_paydate'	=> inggris_date($rows->tgl_paydate),
				'balance_amount'=> $rows->balance_amount,
				'id_payjns'		=> "$rows->id_payjns",
				'bank_nm'		=> "$rows->bank_nm",
				'bank_no'		=> "$rows->bank_no",
				'bank_ref'		=> "$rows->bank_ref",
				'bank_duedate'	=> inggris_date($rows->bank_duedate),
				'id_flag'		=> "$rows->id_flag",
				'hari_sisa'		=> "$rows->hari_sisa",
				'bunga_amt'		=> $rows->bunga_amt
				);
				$this->db->insert('db_billing_history',$data);
				}
				$this->db->query("delete from db_billing where id_sp = '$id_sp' and pay_sisa > 0");
				for($i=1;$i<=$diffmth;$i++){
				if($i<=$pay_dp){
				$new_data = array(
				'id_sp'			=> $id_sp,
				'id_paygroup'	=> '2',
				'amount'		=> replace_numeric($this->input->post("amount".$i."")),
				'due_date'		=> inggris_date($this->input->post("due_date".$i."")),
				'pay_amount'	=> '0',
				'pay_sisa'		=> replace_numeric($this->input->post("amount".$i."")),
				'bank_nm'		=> 'DP',
				'id_flag'		=> '0',
				'bunga_amt'		=> replace_numeric($this->input->post("bunga".$i.""))
				);
				$this->db->insert('db_billing',$new_data);
				}else{
				$new_data = array(
				'id_sp'			=> $id_sp,
				'id_paygroup'	=> '3',
				'amount'		=> replace_numeric($this->input->post("amount".$i."")),
				'due_date'		=> inggris_date($this->input->post("due_date".$i."")),
				'pay_amount'	=> '0',
				'pay_sisa'		=> replace_numeric($this->input->post("amount".$i."")),
				'bank_nm'		=> 'Pelunasan',
				'id_flag'		=> '0',
				'bunga_amt'		=> replace_numeric($this->input->post("bunga".$i.""))
				);
				$this->db->insert('db_billing',$new_data);
				}
				}
				echo "<script>alert('Reschedule Berhasil!');
				document.location.href='".base_url()."finance/cancelunit';
				</script>";
			}
	}
				
	function cancel($id){
		$month_now = date('m');
		$year_now = date('Y');
		$closing = $this->db->query("select top 1 * from db_closingfinance order by id_closf desc")->row();
		if ($month_now <= $closing->periode_bulan && $year_now <= $closing->periode_tahun) {
			die('Bulan tersebut sudah closing');
		} else {
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
	}
	
	function ok(){
		$month_now = date('m');
		$year_now = date('Y');
		$closing = $this->db->query("select top 1 * from db_closingfinance order by id_closf desc")->row();
		if ($month_now <= $closing->periode_bulan && $year_now <= $closing->periode_tahun) {
			die('Bulan tersebut sudah closing');
		} else {
			extract(PopulateForm());
			$this->db->query("sp_batalunit '".$id."'");
			die('Cancel Unit Sukses');
		}
	}
}
?>
