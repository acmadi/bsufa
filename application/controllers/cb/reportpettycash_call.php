<?
	defined('BASEPATH') or die('Access Denied');
	
	class reportpettycash_call extends AdminPage{

		function reportpettycash_call()
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
			
			$this->loadTemplate('cb/reportpettycash_view',$data);
							
			}
			
		function cetakpetty(){
		
			

				 $this->load->view('cb/print/print_pettycash');
		}}	
?>
