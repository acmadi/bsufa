<?
	defined('BASEPATH') or die('Access Denied');
	
	class outstanding_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			
			$data['vendor'] = $this->db->select('kd_supp_gb,nm_supp_gb')
								->order_by('nm_supp_gb','asc')
								->get('pemasokmaster')->result();
	
			$this->parameters=$data;
			
			$this->loadTemplate('gl/outstanding_view',$data);
							
			}
			
		function cetakgl(){
			extract(PopulateForm());
				if(@$klik){
			$this->load->view('gl/print/print_reporoutstanding');
				}else if(@$ekspor){
			$this->load->view('gl/print/print_reporoutstanding');		
		}
			

				 
		}}	
?>
