<?php
class contractactiv extends DBController{
	function __construct(){
		parent::__construct('contractactiv_model');
		$this->set_page_title('List contractactiv');
		$this->template_dir = 'leasing/contractactiv';
		$this->default_limit = 17;
		$session_id = $this->UserLogin->isLogin();
		$this->user_account = $session_id['username'];
	}

	protected function setup_form($data=false){
			
			//$this->parameters['sql'] = $this->db->query('sp_getnoactivation')->row();
			
	}
	
	function get_json(){
		$this->set_custom_function('tgl_activation','indo_date');
		$this->set_custom_function('tgl_endactivation','indo_date');
		$this->set_custom_function('tot_sewa','currency');
		parent::get_json();
		}
	
	
	function index(){
		$this->set_grid_column('id','ID',array('hidden'=>true,'key'=>true));
		$this->set_grid_column('no_activation','No.Contract',array('width'=>50,'align'=>'left','formatter' => 'cellColumn'));
		
		$this->set_grid_column('tgl_activation','Start Date',array('width'=>30,'formatter' => 'cellColumn'));
		$this->set_grid_column('tgl_endactivation','End Date',array('width'=>30,'formatter' => 'cellColumn'));
		$this->set_grid_column('tot_sewa','Total Leased',array('width'=>80,'align'=>'right','formatter' => 'cellColumn'));
		$this->set_grid_column('kegiatan','Decription',array('width'=>50,'align'=>'left','formatter' => 'cellColumn'));
		$this->set_grid_column('customer_nama','Name',array('width'=>50,'align'=>'left','formatter' => 'cellColumn'));
		
		$this->set_jqgrid_options(array('width'=>1100,'height'=>350,'caption'=>'List Contract Activition','rownumbers'=>true,'sortname'=>'id','sortorder'=>'desc'));
		parent::index();
	}
	
	function InputActiv(){
			extract(PopulateForm());
			$session_id = $this->UserLogin->isLogin();
			$idpt = $session_id['id_pt'];
			$iduser =  $session_id['id'];
			
			$query = $this->db->query("SP_InputActSewa '".$no_activation."','".$penyewa."','".$kegiatan."','".$period."',
			'".inggris_date($tglmulai)."','".replace_numeric($biaya_sewa)."','".replace_numeric($totsewa)."','0','".$iduser."'");
			
		
			$sukses = 4;
			die(json_encode($sukses));
	}
	
	
	function print_invoice($id){		
		
			$q=$this->db->query("delete from db_invoice_print");
		
		
			$jml=strlen($id);			
            $a=explode(',',$id);
            $ja=count($a);
            for($i=0;$i<$ja;$i++){
             $q=$this->db->query("insert into db_invoice_print values($a[$i])");
		   
			   
	        }
			
			$this->load->view('leasing/print/print_rptinvoice');
		

			//die($id);
			// $dtprv['id'] = $id;
			
			// $this->load->view('leasing/print/print_rptinvoice',$dtprv);
		}
	
	function UpdateCustomer(){
			//~ extract(PopulateForm());
			//~ $session_id = $this->UserLogin->isLogin();
			//~ $idpt = $session_id['id_pt'];
			//~ $iduser =  $session_id['id'];
			//~ $idflag ='1';
			//~ $idproject='1111';
			//~ $tgl=inggris_date($customertgllhr);
			//~ 
			//~ die($idkarysek);
			//~ 
			//~ $query = $this->db->query("UpdateCustomer '".$idfilter."','".$idgroup."','".$customernama."','".$tgl."',
			//~ '".$customertmptlhr."','".$idagama."','".$idkarysek."','".$customerstatus."','".$idprofesi."','".$customerhp."',
			//~ '".$customertlp."','".$customerfax."','".$idtipe."','".$idno."','".$email."','".$npwp."','".$idtipemedia."','".$idmedia."',
			//~ '".$idmotivie."','".$customeralamat1."','".$idnegara."','".$idpropinsi."','".$idkota."','".$kdpos."','".$customeralamat2."','".$idnegara1."','".$idpropinsi1."','".$idkota1."','".$kdpos1."','".$iduser."','".$idpt."','".$idflag."',
			//~ '".$idetnis."','".$fb."','".$twiter."','".$custcompnm."','".$idbisnis."','".$custcompalamat."','".$custcomphp."',
			//~ '".$custcompfax."','".$custcompnpwp."','".$id."'");
			//~ 
		//~ 
			//~ $sukses = 4;
			//~ die(json_encode($sukses));
	}
	
			function tampil($id){
			
				$row = "SELECT customer_nama,customer_alamat1,pic,customer_tlp FROM db_customer WHERE customer_id = ".$id."";
				
				$data = $this->db->query($row)->row_array();
			
				echo json_encode($data);
		
				}
	
	
	
	
	
			function loaddata(){
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
					
					$session_id = $this->UserLogin->isLogin();
					$idpt = $session_id['id_pt'];
					$iduser =  $session_id['id'];
					
				switch($data_type){
					case 'penyewa':
						$row = "SELECT customer_id as id, customer_nama as nama FROM db_customer WHERE category = 'rental'";
						
						$sql = $this->db->query($row)->result();
						break;
					
					
				
				}
				$response = array();
				if($sql){
					foreach($sql as $row){
						$response[] = $row;
					}
				}
				die(json_encode($response));
			}
		}
	
}

