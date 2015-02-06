<?php
#class customerservice extends Controller{
#	function index(){
	
#	$this->load->view('marketing/customerservice-input');
#	}
#}

class customerservice extends DBController{
	function __construct(){
		parent::__construct('customerservice_model');
		$this->set_page_title('Customer Servicce');
		$this->template_dir = 'marketing/customerservice';
		$this->default_limit = 30;
		$session_id = $this->UserLogin->isLogin();
		$this->user_account = $session_id['username'];
	}

	function before_fetch(){
	    $CI =&get_instance();
		$CI->load->model('userlogin','user');
		$session_id = $CI->user->isLogin();	
		
		
		$this->db->select('customer_nama');
		$user = $session_id['id'];
			
		
		parent::before_fetch();
		
	}
	
	protected function setup_form($data=false){
			$this->load->model('customerservice_model','customer');
			$id = @$data->id_cs;
			$this->parameters['cs'] = $this->customer->customerservice($id);
			$this->parameters['followup'] = $this->customer->followup($id);
	}
	
	
	
	
	function get_json(){
		
		$this->set_custom_function('tgl_complaint','indo_date');
		
		
		parent::get_json();
		
		}
	
	function index(){
		$this->set_grid_column('id_cs','ID',array('hidden'=>true));
		$this->set_grid_column('flag_id','status',array('width'=>50,'hidden'=>true,'formatter' => 'cellColumn'));
		$this->set_grid_column('tgl_complaint','Tgl.Complaint',array('width'=>50,'align'=>'left','formatter' => 'cellColumn'));
		#$this->set_grid_column('flag_id','Status',array('width'=>50,'align'=>'left','formatter' => 'cellColumn'));
		$this->set_grid_column('customer_nama','Name',array('width'=>80,'align'=>'left','formatter' => 'cellColumn'));
		$this->set_grid_column('customer_hp','Handphone',array('width'=>60,'formatter' => 'cellColumn'));
		$this->set_grid_column('cstipe_nm','Complaint Type',array('width'=>100,'formatter' => 'cellColumn'));
		$this->set_grid_column('csdesc_nm','Complaint',array('width'=>100,'formatter' => 'cellColumn'));
		$this->set_jqgrid_options(array('width'=>1100,'height'=>300,'caption'=>'Complaint Customer','rownumbers'=>true,'sortname'=>'id_customer','sortorder'=>'desc'));
		parent::index();
	}
	
	function loaddata(){
			extract(PopulateForm());
			$session_id = $this->UserLogin->isLogin();
			$idpt = $session_id['id_pt'];
			
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				
				
				switch($data_type){
					
					case 'namacustomer':
						$sql = $this->db->select('customer_id id,customer_nama nama')
										->where('id_flag','1')
										->order_by('nama','asc')
										->get('db_customer')
										->result();
							
						break;
					
					case 'subproject':
						$sql = $this->db->select('subproject_id id,nm_subproject nama')
										->get('db_subproject')
										->result();
						break;
						
					case 'tipe':
						$sql = $this->db->select('cstipe_id id,cstipe_nm nama')
										->get('db_cstipe')
										->result();
						break;
						
					case 'tipedesc':
						$sql = $this->db->select('csdesc_id id,csdesc_nm nama')
										->where('cstipe_id',$parent_id)
										->get('db_csdesc')
										->result();
						break;
					
					case 'divisi':
						$sql = $this->db->select('divisi_id id,divisi_nm nama')
										->where('id_pt',$idpt)
										->order_by('divisi_nm','asc')
										->get('db_divisi')
										->result();
						break;
						
					case 'status':
						$sql = $this->db->select('csfustat_id id,csfustat_nm nama')
										->order_by('csfustat_nm','asc')
										->get('db_csfustat')
										->result();
						break;				
					case 'fuby':
						$sql = $this->db->select('fumedia_id id,fumedia_nm nama')
										->order_by('nama','asc')
										->get('db_fumedia')
										->result();
							
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
		
	function data($id){
		
		$data = $this->db->join('db_kota','id_kota = kota_id','left')
						->where('customer_id',$id)
						->get('db_customer')
						->row();

		die(json_encode($data));
	}
	
	function InputCustomerComplaint(){
			extract(PopulateForm());
			$session_id = $this->UserLogin->isLogin();
			$idpt = $session_id['id_pt'];
			$iduser =  $session_id['id'];
			
			
			
			$datemodif = inggris_date($complaintdate);
			$flag = 0;
			$complaintdate=inggris_date($complaintdate);
			
			
			$query = $this->db->query("InputCustomerComplaint '".$namacustomer."','".$complaintdate."','".$subproject."',
			'".$tipe."','".$tipedesc."','".$divisi."','".$note."','".$flag."','".$iduser."','".$datemodif."'");
		
			#####CONVERT NAME######
			
			$sql 	= "SELECT divisi_nm FROM db_divisi WHERE divisi_id = $divisi";
			$row	= $this->db->query($sql)->row();
			
			$sql 	= "SELECT customer_nama FROM db_customer WHERE customer_id = $namacustomer ";
			$roww	= $this->db->query($sql)->row();
			
			$sql	= "SELECT nm_subproject FROM db_subproject WHERE subproject_id = $subproject";
			$roow	= $this->db->query($sql)->row();
			
			$sql	= "SELECT cstipe_nm FROM db_cstipe WHERE cstipe_id =  $tipe";
			$rooow	= $this->db->query($sql)->row();
			
			$sql	= "SELECT csdesc_nm FROM db_csdesc WHERE csdesc_id =  $tipedesc";
			$rowww	= $this->db->query($sql)->row();
			
			
			######################################################
			
			
###SEND NOTIFIKASI##################
if($checkbox == 0){			
if($divisi == 11){
			
$message = "Kepada Departemen $row->divisi_nm \n
				
Dengan hormat,\n
Sehubungan dengan adanya informasi dari pihak customer, ATAS NAMA $roww->customer_nama, \n 
PROJECT $roow->nm_subproject \n
dengan KATEGORI $rooow->cstipe_nm \n
TERKAIT $rowww->csdesc_nm \n
Kami mohon kerjasamanya UNTUK DAPAT $note \n

Demikian informasi customer service ini kami sampaikan, atas perhatian dan kerjasamanya\n
Kami ucapkan Terimakasih \n

Hormat Kami 
Departemen Customer Service 

Send from automation application system
http://mis.bsu.co.id";			

//die($message);
$this->email->from($this->from_cs, $this->displayname_cs);
$list = array('erwan@bsu.co.id','arishandoko@bsu.co.id','lita@bsu.co.id','taty.w@bsu.co.id');
//$list1 = array('sovi@bsu.co.id','denny@bsu.co.id','rina@bsu.co.id','barly@bsu.co.id','reynold@bsu.co.id','arm@bsu.co.id','ali@bsu.co.id');
$this->email->to($list);
//$this->email->cc($list1);
$this->email->subject($this->subject_cs);
$this->email->message($message);	
$this->email->send();}
			
elseif($divisi == 10){
	
	$message = "Kepada Departemen $row->divisi_nm \n
				
Dengan hormat,\n
Sehubungan dengan adanya informasi dari pihak customer, ATAS NAMA $roww->customer_nama, \n 
PROJECT $roow->nm_subproject \n
dengan KATEGORI $rooow->cstipe_nm \n
TERKAIT $rowww->csdesc_nm \n
Kami mohon kerjasamanya UNTUK DAPAT $note \n

Demikian informasi customer service ini kami sampaikan, atas perhatian dan kerjasamanya\n
Kami ucapkan Terimakasih \n

Hormat Kami 
Departemen Customer Service 

Send from automation application system
http://mis.bsu.co.id";			

//die($message);
$this->email->from($this->from_cs, $this->displayname_cs);
$list = array('evi@bsu.co.id','lutfiah@bsu.co.id');
//$list1 = array('ariesta.mutiara@bsu.co.id','jovialmecca@bsu.co.id','rina@bsu.co.id','barly@bsu.co.id','reynold@bsu.co.id','arm@bsu.co.id','ali@bsu.co.id');
$this->email->to($list);
//$this->email->cc($list1);
$this->email->subject($this->subject_cs);
$this->email->message($message);	
$this->email->send();}

elseif($divisi == 7){
	
	$message = "Kepada Departemen $row->divisi_nm \n
				
Dengan hormat,\n
Sehubungan dengan adanya informasi dari pihak customer, ATAS NAMA $roww->customer_nama, \n 
PROJECT $roow->nm_subproject \n
dengan KATEGORI $rooow->cstipe_nm \n
TERKAIT $rowww->csdesc_nm \n
Kami mohon kerjasamanya UNTUK DAPAT $note \n

Demikian informasi customer service ini kami sampaikan, atas perhatian dan kerjasamanya\n
Kami ucapkan Terimakasih \n

Hormat Kami 
Departemen Customer Service 

Send from automation application system
http://mis.bsu.co.id";			

//die($message);
$this->email->from($this->from_cs, $this->displayname_cs);
$list = array('putri.rahayu@bsu.co.id','sarif@bsu.co.id');
//$list1 = array('chrismedy@bsu.co.id','totot@bsu.co.id','rina@bsu.co.id','barly@bsu.co.id','reynold@bsu.co.id','arm@bsu.co.id','ali@bsu.co.id');
$this->email->to($list);
//$this->email->cc($list1);
$this->email->subject($this->subject_cs);
$this->email->message($message);	
$this->email->send();}
}
else{
$message = "Kepada Departemen $row->divisi_nm \n
				
Dengan hormat,\n
Sehubungan dengan adanya informasi dari pihak customer, ATAS NAMA $roww->customer_nama, \n 
PROJECT $roow->nm_subproject \n
dengan KATEGORI $rooow->cstipe_nm \n
TERKAIT $rowww->csdesc_nm \n
Kami mohon kerjasamanya UNTUK DAPAT $note \n

Demikian informasi customer service ini kami sampaikan, atas perhatian dan kerjasamanya\n
Kami ucapkan Terimakasih \n

Hormat Kami 
Departemen Customer Service 

Send from automation application system
http://mis.bsu.co.id";			

//die($message);
$this->email->from($this->from_cs, $this->displayname_cs);
//$list = array('erwan@bsu.co.id','arishandoko@bsu.co.id','lita@bsu.co.id','taty.w@bsu.co.id');
$list = array('gunawan@bsu.co.id','barly@bsu.co.id');
//$list1 = array('sovi@bsu.co.id','denny@bsu.co.id','rina@bsu.co.id','barly@bsu.co.id','reynold@bsu.co.id','arm@bsu.co.id','ali@bsu.co.id');
$this->email->to($list);
//$this->email->cc($list1);
$this->email->subject($this->subject_cs);
$this->email->message($message);	
$this->email->send();

}


			
			
			$sukses = 4;
			die(json_encode($sukses));
			
	}
	function InputCSFollowup(){
			extract(PopulateForm());
			$session_id = $this->UserLogin->isLogin();
			$idpt = $session_id['id_pt'];
			$iduser =  $session_id['id'];
			$idflag ='1';
			$idproject='1111';
			
			$fudate=inggris_date($fudate);
			$nextfudate=inggris_date($nextfudate);
			
			$query = $this->db->query("InputCSFollowup'".$customer."','".$status."',
			'".$fudate."','".$note."','".$nextfudate."','".$fuby."'");
			
				
		
			$sukses = 4;
			die(json_encode($sukses));
	}
	
	
	
}

?>
