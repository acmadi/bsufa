<?
	defined('BASEPATH') or die('Access Denied');
	
	class budgetmon_call extends AdminPage{

		function budgetmon_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			
		
							
			}
			
		function budgetmonprint(){
		
			

				 $this->load->view('project/print/print_budgetmon');
		}}	
?>
