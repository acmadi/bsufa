<?
	defined('BASEPATH') or die('Access Denied');
	
	class printbankbook_call extends AdminPage{

		function printbankbook_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			
			$data['bank'] = $this->db->select('bank_coa,bank_nm')
								->order_by('bank_nm','asc')
								->where('id_pt',44)
								->get('db_bank')->result();
	
			$this->parameters=$data;
			
			$this->loadTemplate('cb/printbankbook_view',$data);
							
			}
			
		function cetakbankbook(){
		extract(PopulateForm());
			#die($code);

				 $this->load->view('cb/print/print_bankbook',$code);
				
		}}	
?>
