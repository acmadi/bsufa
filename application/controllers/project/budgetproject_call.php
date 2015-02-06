<?
	defined('BASEPATH') or die('Access Denied');
	
	class budgetproject_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];
			
			$data = $this->db->where('pt_id',$pt)
							->get('db_subproject')->result();
			$this->parameters['proj'] = $data;
			#var_dump($data);
			$this->loadTemplate('project/budgetproject_view');
							
			}
			
		function budgetvbudget(){
		
			

				 $this->load->view('project/print/print_rbvbudget');
                 
		}
        
        function sumdevproj(){
            
            $this->load->view('project/print/print_developmentcost');
        }
        
        }	
?>
