<?
	defined('BASEPATH') or die('Access Denied');
	
	class reportlastpayment_call extends AdminPage{

		function reportlastpayment_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			
			$data['account'] = $this->db->select('acc_no,(acc_no +"  ||  "+ acc_name) as acc_name')
								->where('type','2')
								->order_by('acc_no','asc')
								->get('db_coa')->result();
	
			$this->parameters=$data;
			
			$this->loadTemplate('finance/reportlastpayment_view',$data);
							
			}
			
		function cetaklastpayment(){
		
			

				 $this->load->view('finance/print_lastpayment');
		}}	
?>
