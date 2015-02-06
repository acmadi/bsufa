<?
	defined('BASEPATH') or die('Access Denied');
	
	class reportcancelunit_call extends AdminPage{

		function reportcancelunit_call()
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
			
			$this->loadTemplate('sales/reportcancelunit_view',$data);
							
			}
			
		function cetakcancelunit(){
		
			

				 $this->load->view('sales/print/print_cancelunit');
		}}	
?>
