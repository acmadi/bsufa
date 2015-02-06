<?php
#class customerservice extends Controller{
#	function index(){
	
#	$this->load->view('marketing/customerservice-input');
#	}
#}

class frontoffice extends DBController{
	function __construct(){
		parent::__construct('frontoffice_model');
		$this->set_page_title('Customer Service');
		$this->template_dir = 'marketing/frontoffice';
		$this->default_limit = 30;
		$session_id = $this->UserLogin->isLogin();
		$this->user_account = $session_id['username'];
	}

	function before_fetch(){
	    $CI =&get_instance();
		$CI->load->model('userlogin','user');
		$session_id = $CI->user->isLogin();	
		
		
		#$this->db->select('customer_nama');
		$user = $session_id['id'];
			
		
		parent::before_fetch();
		
	}
	
	protected function setup_form($data=false){
			$this->load->model('frontoffice_model','customer');
			#$id = @$data->id_cs;
			#$this->parameters['cs'] = $this->customer->customerservice($id);
			#$this->parameters['followup'] = $this->customer->followup($id);
	}
	
	
	
	
	function get_json(){
		
		$this->set_custom_function('tgl','indo_date');
		
		
		parent::get_json();
		
		}
	
	function index(){
		$this->set_grid_column('fo_id','ID',array('hidden'=>true));
		#$this->set_grid_column('flag_id','status',array('width'=>50,'hidden'=>true,'formatter' => 'cellColumn'));
		$this->set_grid_column('tgl','Date',array('width'=>50,'align'=>'left','formatter' => 'cellColumn'));
		#$this->set_grid_column('flag_id','Status',array('width'=>50,'align'=>'left','formatter' => 'cellColumn'));
		$this->set_grid_column('nama','Name',array('width'=>80,'align'=>'left','formatter' => 'cellColumn'));
		$this->set_grid_column('pic','Contact Person',array('width'=>80,'align'=>'left','formatter' => 'cellColumn'));
		$this->set_grid_column('source','Source',array('width'=>80,'align'=>'left','formatter' => 'cellColumn'));
		$this->set_grid_column('tujuan','Reason',array('width'=>80,'align'=>'left','formatter' => 'cellColumn'));
		$this->set_jqgrid_options(array('width'=>980,'height'=>300,'caption'=>'Front Office','rownumbers'=>true,'sortname'=>'fo_id','sortorder'=>'desc'));
		parent::index();
	}
	
	
	
	
	function InputFO(){
			extract(PopulateForm());
			$session_id = $this->UserLogin->isLogin();
			$idpt = $session_id['id_pt'];
			$iduser =  $session_id['id'];
			
			
			$tgl = inggris_date($tgl);
			
			
			$query = $this->db->query("InputFO '".$venue."','".$tgl."','".$nama."','".$pic."','".$source."','".$tujuan."'");
		
			#var_dump($query);
			$sukses = 4;
			die(json_encode($sukses));
	}
	
	 
}

?>
