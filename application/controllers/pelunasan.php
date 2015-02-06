<?php
class pelunasan extends DBController{
	function __construct(){
		parent::__construct('pelunasan_model');
		$this->set_page_title('List Customer Lunas');
		$this->template_dir = 'finance/pelunasan';
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
		$this->set_grid_column('id_print','id print',array('hidden'=>false, 'width'=>0.000001,'align'=>'Right'));
		$this->set_jqgrid_options(array('width'=>870,'height'=>300,'caption'=>'List Kwitansi','sortname'=>'customer_nama','sortorder'=>'asc'));
		parent::index();		
	}
	
	function cekjab(){
		$id = $this->input->post('id');
		$rdt = $this->db->join('db_karyjab','id_karyjab = karyjab_id')
					   ->where('id_kary',$id)
					   ->get('db_kary')->row();
		$jab = $rdt->karyjab_nm;
		die($jab);
		
	}
	
	function printpl($id){

//	die($id);
	$session_id = $this->UserLogin->isLogin();
	$this->user = $session_id['username'];
	$this->pt	= $session_id['id_pt'];
	$this->level = $session_id['level_id']; 
	$pt = $this->pt;
	
	//die($this->user);
	
	$os = $this->db->select_sum('pay_sisa')
							   ->where('id_sp',$id)
							   ->get('db_billing')->row();
	
	
	$no_sp = $this->db->where('sp_id',$id)
							->get('db_sp')->row();
							
	$no_sp2 = $no_sp->sp_id;
	$id_print = $no_sp->id_print;
	
	if($id_print == 1 and  $this->level != 5){
			echo"
				<script type='text/javascript'>
					alert('Kwitansi Sudah Pernah di Print');
					refreshTable();
				</script>
			";
	}elseif ($os->pay_sisa > 10000){
	
		echo"
				<script type='text/javascript'>
					alert('Kwitansi belum lunas');
					refreshTable();
				</script>
			";
			
		}else{
			
		
	
	
	$q=$this->db->query("Update db_sp  set id_print=1 WHERE sp_id='$no_sp2'");
	
			
	include_once( APPPATH."libraries/translate_currency.php");		
	$data['cekdt'] = $this->db->query("sp_showkwlunas ".$id)->row();	
		//die($id);
		
	if ($pt=='44'){	
	$this->load->view('sales/kwplprint_gmi',$data);
	//$this->load->view('sales/rkwprint_lunas',$data);
	}else {
	//$this->load->view('sales/kwplprint_project',$data);
	$this->load->view('sales/kwitansilunas_new',$data);
	}
	
	}
	}
	
	function kwitansi_view($id=false){
		
		#Pengganti dari $this->input->post
		extract(PopulateForm());
		include_once( APPPATH."libraries/translate_currency.php"); 
		$session_id = $this->UserLogin->isLogin();
		$user_id = $session_id['id'];	

		

		if($id){
			#kwitansi
			$row = $this->db->where('kwitansi_id',$id)
							->get('db_kwitansi')->row();
			
			#nama karyawan				
			$cekid = $this->db->where('id_kary',$row->id_ttd)
							  ->get('db_kary')->row();
			#jabatan karyawan
			$cekjab = $this->db->where('karyjab_id',$cekid->id_karyjab)
						       ->get('db_karyjab')->row();
						 
			$dtprv['tgl'] = $row->kwitansi_tgl;
			$dtprv['nomor'] = $row->kwitansi_no;
			$dtprv['tdari'] = $row->kwitansi_terima;
			$dtprv['curr'] = $row->kwitansi_curr;
			$pilihan  = $row->kwitansi_curr;
			$dtprv['jumlah'] = $row->kwitansi_jml;
			$dtprv['untuk'] = $row->kwitansi_pembyr;
			$dtprv['ket1'] = $row->kwitansi_ket1;
			$dtprv['ket2'] = $row->kwitansi_ket2;
			$dtprv['ket3'] = $row->kwitansi_ket3;
			$dtprv['nama'] = $cekid->nama;
			$dtprv['jabatan'] = $cekjab->karyjab_nm;			
			
			if ($pilihan == "Rp"){
				$dtprv['outnominal'] = toRupiah($row->kwitansi_jml);
				$dtprv['format'] = "Rupiah"; 
			}else{
				$dtprv['outnominal'] = toRupiah($row->kwitansi_jml);
				$dtprv['format'] = "Dolar";
			}
			$this->load->view('finance/kwprint',$dtprv);
			
		}else {
			$dtprv['tgl'] = $tgl;
			$dtprv['nomor'] = $nomor;
			$dtprv['tdari'] = $tdari;
			$pilihan = $curr;
			$dtprv['curr'] = $pilihan;
			$jum = str_replace(',','',$jumlah);
			if ($pilihan == "Rp"){
				$dtprv['outnominal'] = toRupiah($jum);
				$dtprv['format'] = "rupiah"; 
			}else{
				$dtprv['outnominal'] = toRupiah($jum);
				$dtprv['format'] = "dolar";
			}
		
			$row = $this->db->where('id_kary',$ttd)
						 ->get('db_kary')->row();
		
			$dtprv['jumlah'] = $jum;
			$dtprv['untuk'] = $untuk;
			$dtprv['ket1'] = $ket1;
			$dtprv['ket2'] = $ket2;
			$dtprv['ket3'] = $ket3;
			$dtprv['nama'] = $row->nama;
			$dtprv['jabatan'] = $this->input->post('jabatan');
			
			
			$query = $this->db->query("sp_InsertKwitansi '".inggris_date($tgl)."','".$nomor."'
			,'".$tdari."',".$jum.",'".$untuk."','".$ket1."','".$ket2."','"
			.$ket3."','".$curr."','".$ttd."',".$user_id."");
			/*$data = array
			(
				'kwitansi_tgl'=> $tgl,
				'kwitansi_no' => $nomor,
				'kwitansi_terima' => $tdari,
				'kwitansi_jml' => $jum, 
				'kwitansi_pembyr' => $untuk,
				'kwitansi_ket1' => $ket1,
				'kwitansi_ket2' => $ket2,
				'kwitansi_ket3' => $ket3,
				'kwitansi_curr' => $curr, 
				'id_ttd'=> $ttd
			);
			$this->db->insert('db_kwitansi',$data);*/
			$this->load->view('finance/kwprint',$dtprv);
		}	
	
	 	/*Simpan Data Kwitansi
		$data = array
		(
			'kwitansi_tgl'=> $tgl,
			'kwitansi_no' => $nomor,
			'kwitansi_terima' => $tdari,
			'kwitansi_jml' => $jum, 
			'kwitansi_pembyr' => $untuk,
			'kwitansi_ket' => $kets,
			'kwitansi_curr' => $curr, 
			'id_ttd'=> $ttd
		);
		
		$this->db->insert('db_kwitansi',$data);*/

	}
	
	
	function update_data(){
		extract(PopulateForm());
		$jum = str_replace(',','',$jumlah);
		$query = $this->db->query("sp_UpdateKwitansi '".inggris_date($tgl)."','".$nomor."'
		,'".$tdari."',".$jum.",'".$untuk."','".$ket1."','".$ket2."','"
		.$ket3."','".$curr."','".$ttd."',".$kwt_id."");
		redirect('kwitansi');
	}

}
