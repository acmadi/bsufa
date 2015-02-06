<?php
	class masterstrukproj extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('masterstrukproj_model');
			$this->set_page_title('Master Struktur Project');
			$this->default_limit = 30;
			$this->template_dir = 'project/masterstrukproj';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->pt = $session_id['id_pt'];
			$this->id = $session_id['id'];
		}
		
		protected function setup_form($data=false){
			$this->parameters['project'] = $this->db->where('id_pt',$this->pt)
													->get('db_subproject')->result();
			$this->parameters['costproj'] = $this->db->get('db_costproj')->result();													
		}
		
		function get_json(){
			$this->set_custom_function('land','currency');
			$this->set_custom_function('construction','currency');
			$this->set_custom_function('softcost','currency');
			$this->set_custom_function('infrastructure','currency');
			$this->set_custom_function('permite','currency');
			$this->set_custom_function('idc','currency');
			$this->set_custom_function('kawasan','currency');
			parent::get_json();
		}		
			
		function index(){
			$this->set_grid_column('subproject_id','',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('nm_subproject','Project',array('width'=>60,'align'=>'left'));			
			$this->set_grid_column('land','Land',array('width'=>40,'align'=>'right'));			
			$this->set_grid_column('construction','Construction',array('width'=>40,'align'=>'right'));			
			$this->set_grid_column('softcost','Soft Cost',array('width'=>40,'align'=>'right'));			
			$this->set_grid_column('infrastructure','Infrastruktur',array('width'=>40,'align'=>'right'));			
			$this->set_grid_column('permite','Permite / Legal',array('width'=>40,'align'=>'right'));			
			$this->set_grid_column('idc','IDC',array('width'=>40,'align'=>'right'));			
			$this->set_grid_column('kawasan','Kawasan Infrastruktur',array('width'=>40,'align'=>'right'));			
			$this->set_jqgrid_options(array('width'=>1200,'height'=>350,'caption'=>'Master Struktur Project','rownumbers'=>true));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}		
		
		
		function cekdata($id){
			$data = $this->db->select('tot_bgtproj,land_bgtproj,sgfa,gba')
							 ->where('project_id',$id)
							 ->get('db_hbgtproject')->row();
	 
			die(json_encode($data));			
		}
		
		
		function save(){
			extract(PopulateForm());
			$tgl = date("Y-m-d");
			$data = array
			(
				'id_hbgbtproj' => $project_id,
				'id_scostproj' => $cost,
				'nilai_scost' => replace_numeric($bgtcost),
				'input_date' => $tgl,
				'input_user' => $this->id,
			);
			
			
			if($save){
				$this->db->insert('db_sbgtproj',$data);
				die("sukses");
			}
			
		}
		
	
	}

