<?
	defined('BASEPATH') or die('Access Denied');
	
	class generalledgeracccon extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			$session = $this->UserLogin->isLogin();
			$pt = $session['id_pt'];
			
			$data['account'] = $this->db->select('acc_no,(acc_no +"  ||  "+ acc_name) as acc_name')
								->where('type','2')
								->where('id_pt',$pt)
								->order_by('acc_no','asc')
								->get('db_coa')->result();
	
			
			
			$data['project'] = $this->db->query("SELECT subproject_id, nm_subproject as project_name FROM db_subproject where id_pt='$pt'
			UNION SELECT '0' subproject_id, 'All' as project_name")->result();
			
			$this->parameters=$data;
			
			$this->loadTemplate('gl/generalledgeracccon_view',$data);
							
			}
			
		function cetakgl(){
					
				extract(PopulateForm());
				if(@$klik){
			$this->load->view('gl/print/print_gl_listingbyaccount');
				}else if(@$ekspor){
			$this->load->view('gl/print/print_gl_listingbyaccount_excel');		
		}
				 
				 
				 
		}}	
?>
