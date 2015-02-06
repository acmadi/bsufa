<?
	defined('BASEPATH') or die('Access Denied');
	
	class budgetmonitoring_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			
		
			$this->loadTemplate('project/budgetmonitoring_view');
							
			}
			
		function budgetmonitoring(){
		
			

				 $this->load->view('project/print/print_budgetmonitoringprogress');
		}}	
?>
