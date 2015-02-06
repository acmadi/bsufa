<?php
class mcekgiro extends DBController{
	function __construct(){
		parent::__construct('mcekgiro_model');
		$this->set_page_title('Cek / Giro');
		$this->template_dir = 'finance/mcekgiro';
		$session_id = $this->UserLogin->isLogin();
		$this->user_account = $session_id['username'];
	}


	function get_json(){
		$this->set_custom_function('cekgiro_tglterima','indo_date');
		$this->set_custom_function('cekgiro_jml','currency');
		/*$this->set_custom_function('bank_id','bankcek');*/
		parent::get_json();
	}
		
	
	function index(){
		$this->set_grid_column('cekgiro_id','ID',array('hidden'=>true));
		$this->set_grid_column('cekgiro_tglterima','Tanggal',array('width'=>50,'align'=>'Left','formatter' => 'cellColumn'));
		$this->set_grid_column('cekgiro_nm','Penagih',array('width'=>95,'align'=>'Left','formatter' => 'cellColumn'));
		$this->set_grid_column('cekgiro_jml','Jumlah',array('width'=>55,'align'=>'right','formatter' => 'cellColumn'));
		$this->set_grid_column('cekgiro_bank','Bank',array('width'=>70,'align'=>'left','formatter' => 'cellColumn'));
		$this->set_jqgrid_options(array('width'=>870,'height'=>300,'caption'=>'List Cek / Giro','sortname'=>'cekgiro_id','sortorder'=>'desc'));
		if($this->user_account!="")parent::index();
		else redirect("user/login");		
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
			
			#$dtprt['project'] = $project;
			#$dtprt['trans'] = $trans;
			$dtprt['no_cek'] = $no_cek;
			$dtprt['tglklr'] = $tglklr;
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
			
			#format tgl
			/*@list($d,$m,$y) = split("-",$tgl);
			@list($d1,$m1,$y1) = split("-",$tglklr);
			$tglklr1 = "";
			$tglterima = "";*/
			
			#die("test");
			if ($print) {
				/*$query = $this->db->query("sp_InsertCek '".$pil."','".$nm."','"
				.$tglterima."','".$tglklr1."',ss
				'".$no_cek."','".$norek."',".$jum.",'".$nb."'");*/
				$data = array
				(
					'cekgiro_kd' => $pil,
					'cekgiro_nm'  => $nm,
					'cekgiro_tglterima' => $tgl,
					'cekgiro_tglklr' => $tglklr,
					'cekgiro_nomor' => $no_cek,
					'cekgiro_rek' => $norek,
					'cekgiro_jml' => $jum,
					'cekgiro_bank' => $nb
				);
				$this->db->insert('db_cekgiro',$data);
				switch ($bank){
					case "bukopin":
						if ($pil == "Check") {
							$this->load->view('finance/template/cekprint_bukopin',$dtprt);	
						}else{
							$this->load->view('finance/template/giroprint_bukopin',$dtprt);	
						}
						break;
					case "mandiri":
						if ($pil == "Check") {
							$this->load->view('finance/template/cekprint_mandiri',$dtprt);	
						}else{
							$this->load->view('finance/template/giroprint_mandiri',$dtprt);	
						}
						break;
					case "mega":
						if ($pil == "Check") {
							$this->load->view('finance/template/cekprint_mega',$dtprt);	
						}else{
							$this->load->view('finance/template/giroprint_mega',$dtprt);	
						}
						break;
					case "btn":
						if ($pil == "Check") {
							$this->load->view('finance/template/cekprint_btn',$dtprt);	
						}else{
							$this->load->view('finance/template/giroprint_btn',$dtprt);	
						}
						break;
					case "bri":
						if ($pil == "Check") {
							$this->load->view('finance/template/cekprint_bri',$dtprt);	
						}else{
							$this->load->view('finance/template/giroprint_bri',$dtprt);	
						}
						break;
				}
			}
			#die("sukses");
		}

}
