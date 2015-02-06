<?
	defined('BASEPATH') or die('Access Denied');
	
	class appaddbgtproj_call extends AdminPage{

		function appaddbgtproj_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'ADD BUSGET';
		}
		
		function index($id){
			//~ $data['view'] = $this->db->where('id_reclass',$id)
									//~ ->order_by('id_bgtproj_update')
									//~ ->get('db_bgtproj_update_tempg')->result();
									//~ 
									
			$data['row'] = $this->db->join('db_subproject','subproject_id = id_subproject')
									->where('id_bgtproj_update_add',$id)	
									->get('db_bgtproj_update_add')->row();
 

			//~ $data['sql'] = $this->db->join('db_subproject','id_subproject = subproject_id')
								//~ ->where('id_bgtproj_update_add',$id)	
								//~ ->get('db_bgtproj_update_add')->row();
						//~ 
			
			
			
							
			//~ $data['sql1'] = $this->db->select('TOP 1 *')
								//~ ->where('id_reclass',$id)	
								//~ ->order_by('id_bgtproj_update','asc')
								//~ ->get('db_bgtproj_update_temp')->row();
								//~ 
		//~ $row = 	$this->db->select('TOP 1 *')
								//~ ->where('id_reclass',$id)	
								//~ ->order_by('id_bgtproj_update','asc')
								//~ ->get('db_bgtproj_update_temp')->row();
		//~ $row->id_subproject;
		//~ 
		//~ 
		//~ $data['sql2'] = $this->db->select('TOP 1 *')
								//~ ->where('id_reclass',$id)	
								//~ ->order_by('id_bgtproj_update','desc')
								//~ ->get('db_bgtproj_update_temp')->row();
								//~ 
			
				
			$this->load->view('approval/project/app_appaddbgtproj',$data);
		}
	}	
