<?php
class cekgiro extends DBController{
	function __construct(){
		parent::__construct('cekgiro_model');
		$this->set_page_title('Cek / Giro');
		$this->template_dir = 'finance/cekgiro';
	}
	
	protected function setup_form($data=false){
										     
	}
	
	function get_json(){
	}
		
	
	function index(){
		$this->set_grid_column('cekgiro_id','ID',array('hidden'=>true));
		$this->set_grid_column('cekgiro_tglterima','Tanggal Terima',array('width'=>95,'align'=>'Left'));
		$this->set_grid_column('cekgiro_tglambil','Tanggal Ambil',array('width'=>95,'align'=>'Left'));
		$this->set_grid_column('cekgiro_nm','Nama',array('width'=>95,'align'=>'Left'));
		$this->set_grid_column('cekgiro_jml','Jumlah',array('width'=>95,'align'=>'Left'));
		$this->set_jqgrid_options(array('width'=>870,'height'=>300,'caption'=>'List Cek / Giro'));
		parent::index();		
	}
	
	
		function loaddata(){
			#die($this->input->post('parent_id'));
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				
				switch($data_type){
					case 'project':
					    $dt = array('1','11','111','112','12','21');
						$sql = $this->db->select('kd_project id,nm_project nama')
										->where_not_in('kd_project',$dt)
										->get('project')->result();
						break;
					case 'trans':
						$sql = $this->db->select('tranbank_id id,nomor nama')
										->where('kd_project',$parent_id)
										->where('nomor_cek !=','')
										->get('tranbank')->result();
						
						break;
					default:
					    $sql = $this->db->select('subproject_id id,nm_subproject nama')
										->where('id_pt',$pt)
										->order_by('nm_subproject','ASC')
										->get('db_subproject')->result();
				}
				$response = array();
				if($sql){
					foreach($sql as $row){
						$response[] = $row;
					}
				}else{
					$response['error'] = 'Data kosong';
				}
				die(json_encode($response));
			}			
		}
		
		
		function cekit($id){
			$data = $this->db->where('tranbank_id',$id)
							 ->get('tranbank')->row();
			echo json_encode($data);
		}
	
		function cekgiro_view(){
			extract(PopulateForm());
			include_once( APPPATH."libraries/translate_currency.php");
			die("test");
			$dtprt['project'] = $project;
			$dtprt['trans'] = $trans;
			$dtprt['no_cek'] = $no_cek;
			$jum = str_replace(',','',$jml);
			/*if ($pilihan == "Rp"){*/
			$dtprt['outnominal'] = toRupiah($jum); 
			/*}else{
				$dtprt['outnominal'] = toDollar($jum);
			}*/
			$dtprt['jml'] = $jml;
			$dtprt['nm'] = $nm;
			$dtprt['norek']= $norek;
			$dtprt['tgl']= $tgl;
			$dtprt['nb']= $nb;
			
			if ($print) {
				switch ($bank){
					case "bukopin":
						die("TES1");
						if ($pil == "Check") {
							die("tes");
							$this->load->view('finance/template/cekprint_bukopin',$dtprt);	
						}else{
							die("coba");
							$this->load->view('finance/template/giroprint_bukopin',$dtprt);	
						}
						break;
					case "mandiri":
					   die("TES2");
						if ($pil == "Check") {
							$this->load->view('finance/template/cekprint_mandiri',$dtprt);	
						}else{
							$this->load->view('finance/template/giroprint_mandiri',$dtprt);	
						}
						break;
					case "mega":
						die("TES3");
						if ($pil == "Check") {
							$this->load->view('finance/template/cekprint_mega',$dtprt);	
						}else{
							$this->load->view('finance/template/giroprint_mega',$dtprt);	
						}
						break;
					case "btn":
						die("TES3");
						if ($pil == "Check") {
							$this->load->view('finance/template/cekprint_btn',$dtprt);	
						}else{
							$this->load->view('finance/template/giroprint_btn',$dtprt);	
						}
						break;
					case "bri":
						die("TES4");
						if ($pil == "Check") {
							$this->load->view('finance/template/cekprint_bri',$dtprt);	
						}else{
							$this->load->view('finance/template/giroprint_bri',$dtprt);	
						}
						break;
				}
			}

		}

}
