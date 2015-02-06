<?php
	class masterproj extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('masterproj_model');
			$this->set_page_title('Master Project');
			$this->default_limit = 30;
			$this->template_dir = 'project/masterproj';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->pt = $session_id['id_pt'];
			$this->id = $session_id['id'];
			$this->parent = $session_id['id_parent'];
		}
		
		protected function setup_form($data=false){
			$this->parameters['project'] = $this->db->where('id_pt',$this->pt)
													->get('db_subproject')->result();						
		}
		
		function get_json(){
			$this->set_custom_function('tgl_startproj','indo_date');
			$this->set_custom_function('tgl_endproj','indo_date');
			$this->set_custom_function('tot_bgtproj','currency');
			$this->set_custom_function('land_bgtproj','currency');
			$this->set_custom_function('sgfa','currency');
			$this->set_custom_function('gba','currency');
			parent::get_json();
		}
		
		function index(){
			$this->set_grid_column('id_hbgtproj','',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('nm_subproject','Project Name',array('width'=>60));
			$this->set_grid_column('tot_bgtproj','Total Budget',array('width'=>40,'align'=>'right'));
			$this->set_grid_column('remark','Remarks',array('width'=>60));
			$this->set_grid_column('tgl_startproj','Start Date',array('width'=>30));
			$this->set_grid_column('tgl_endproj','End Date',array('width'=>30));
			$this->set_grid_column('land_bgtproj','Land',array('width'=>30));
			$this->set_grid_column('sgfa','SGFA',array('width'=>30));
			$this->set_grid_column('gba','GBA',array('width'=>30));
									
			$this->set_jqgrid_options(array('width'=>1200,'height'=>350,'caption'=>'Master Project','rownumbers'=>true));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}
		
		function save(){
			extract(PopulateForm());
			$data = array(
					'tgl_startproj'	=> $start_date,
					'tgl_endproj'	=> $end_date,
					#'kode_bgtproj'	=> $kode_bgtproj,
					'land_bgtproj'	=> replace_numeric($land),
					'sgfa'	=> replace_numeric($sgfa),
					'gba'	=> replace_numeric($gba),
					'tot_bgtproj' => replace_numeric($totbgt),
					'remark' => $remarks,
					'user_input' => $this->id,
					'project_id' => $project_id,
					'pt_id' => $this->pt
			);
			
				
			if($save){
				$this->db->insert('db_hbgtproject',$data);
				die("sukses");
			}
			
		}		
	}

