<?
	defined('BASEPATH') or die('Access Denied');
	
	class printcashflow_call extends AdminPage{

		function printcashflow_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			
			$data['vendor'] = $this->db->select('kd_supp_gb,nm_supp_gb')
								->order_by('nm_supp_gb','asc')
								->get('pemasokmaster')->result();
	
			$this->parameters=$data;
			
			$this->loadTemplate('cb/printcashflow_view');
							
			}
			
		function cetakcashflow(){
		
			

				 $this->load->view('cb/print/print_cashflow');
				
		}}	
?>
