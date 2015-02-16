<?php
defined('BASEPATH') or die('Access Denied');
Class request extends AdminPage{
	function request()
	{
		parent::AdminPage();
		//$this->pageCaption = 'Print Summary Budget ';
	}
	
	function index()
	{
		//$data['divisi'] = $this->db->get('db_divisi')->result();
		$session_id = $this->UserLogin->isLogin();
		$divisi = $session_id['divisi_id'];	
		#$pt = session_id['id_pt'];
		$parent = $session_id['id_parent'];
		
		$data['divisi'] = $this->mstmodel #->where('id_parent',$parent)
										 ->get_id('divisi_id',$divisi,'db_divisi');
		
		
		$this->parameters['data'] = $data;
		$this->loadTemplate('report/request_view');
	}
	
	function divisi()
	{
		$this->loadTemplate('report/divisi_view');
	}
	function appervendor()
	{
		/*
		$data['project'] = $this->db->where('judul','N')
									->get('project')->result();
		
		$this->db->query("select * from db_subproject where id_pt='".$this->pt."' and pt_id <> 12 order by nm_subproject")->result();
*/
		$data['project'] = $this->db->query("select * from db_subproject where id_pt=11 and pt_id <> 12 order by nm_subproject")->result();
		

		$this->parameters['data'] = $data;
		
		
		$this->loadTemplate('report/appervendor_view');
	}
	
	
	function summary_budget(){
		$this->loadTemplate('report/summary_budget_view');
	}
	
	function get_project($id){
		$data = "<option value='-'></option>";
		$data .= "<option value='0'>All</option>";
		$sql = $this->db->query("select subproject_id,nm_subproject from db_subproject where id_pt = '$id' and pt_id <> 12")->result();
		
		foreach($sql as $row){
		$data .= "<option value='".$row->subproject_id."'>".$row->nm_subproject."</option>";
		}
		die($data);
	}
	
	function realisasi_account(){
		extract(PopulateForm());
		
		$session = $this->UserLogin->isLogin();
		$divisi = $session['divisi_id'];
		$level = $session['level_id'];
		$pt = $session['id_pt'];
		$parent = $session['id_parent'];
		
		if($level==1){
			$data['item'] = $this->db->where('id_pt',$pt)
									 ->order_by('code','ASC')
									 ->get('db_mstbgt_update')->result();
		}elseif($level==3 and $parent== '1203'){
			$data['item'] = $this->db->where('id_pt',$pt)
									 ->where('id_parent',$parent)
									 ->order_by('code','ASC')
									 ->get('db_mstbgt_update')->result();
		}else{
			$data['item'] = $this->db->where('divisi_id',$divisi)
									 ->where('id_pt',$pt)
			                         #->where('thn',$thn)
			                         ->order_by('code','ASC')
									 ->get('db_mstbgt_update')->result();
		}
		$this->parameters['data'] = $data;
		$this->loadTemplate('report/summary_realisasi_view');
	}
	
	function master_budget(){
		$session = $this->UserLogin->isLogin();
		$divisi = $session['divisi_id'];
		$level = $session['level_id'];
		$pt = $session['id_pt'];
		$parent = $session['id_parent'];
		
		if($level==3) 
			$data['divisi'] = $this->db->where('id_pt',$pt)
									->where('parent_id',$parent)
									->get('db_divisi')->result();
		else
			$data['divisi'] = $this->db->where('divisi_id',$divisi)
									   ->get('db_divisi')->result();
		$this->parameters['data'] = $data;
		$this->loadTemplate('report/master_budget_view');
	}
	
	function adjustment_budget(){
		$session = $this->UserLogin->isLogin();
		$divisi = $session['divisi_id'];
		$parent = $session['id_parent'];
		$level = $session['level_id'];
		if($level==3) 
		$data['item'] = $this->db->where('id_parent',$parent)
								 ->order_by('code','ASC')
								 ->get('db_mstbgt_update')->result();	
		
		else
		$data['item'] = $this->db->where('divisi_id',$divisi)
								 ->order_by('code','ASC')
								 ->get('db_mstbgt_update')->result();		
		$this->parameters['data'] = $data;
		$this->loadTemplate('report/adjustment_budget_view');
	}

	function reclass_budget(){
		$session = $this->UserLogin->isLogin();
		$divisi = $session['divisi_id'];
		$parent = $session['id_parent'];
		$level = $session['level_id'];
		
		if($level==3) 
		$data['item'] = $this->db->where('id_parent',$parent)
								 ->order_by('code','ASC')
								 ->get('db_mstbgt_update')->result();	
		
		else
		$data['item'] = $this->db->where('divisi_id',$divisi)
								 ->order_by('code','ASC')
								 ->get('db_mstbgt_update')->result();		
		$this->parameters['data'] = $data;
		$this->loadTemplate('report/reclass_budget_view');
	}

	function loaddata(){
			#die($this->input->post('parent_id'));
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				$session_id = $this->UserLogin->isLogin();
				$pt = $session_id['id_pt'];
				$divisi = $session_id['divisi_id'];
				$lvl = $session_id['level_id'];
				$id_parent = $session_id['id_parent'];
				//die($lvl);
				//die($id_parent.' '.$lvl);
								 
				switch($data_type){
					case 'code':
						if($lvl==3){
							$sql = $this->db->select("code id,' {' +code+ '}' + descbgt  nama")
										->where('thn',$parent_id)
										->where('id_parent',$id_parent)
										->where('id_pt',$pt)
										->get('db_mstbgt_update')->result();
						}elseif($lvl == 13){
							$sql = $this->db->select("code id,' {' +code+ '}' + descbgt  nama")
										->where('thn',$parent_id)
										->where('id_parent',$id_parent)
										->get('db_mstbgt_update')->result();
						
						}elseif($lvl == 14){
							$sql = $this->db->select("code id,' {' +code+ '}' + descbgt  nama")
										->where('thn',$parent_id)
										->where('id_parent',$id_parent)
										->get('db_mstbgt_update')->result();
						
						}elseif($lvl == 15){
							$sql = $this->db->select("code id,' {' +code+ '}' + descbgt  nama")
										->where('thn',$parent_id)
										->where('id_parent',$id_parent)
										->get('db_mstbgt_update')->result();
						
						}elseif($lvl == 16){
							$sql = $this->db->select("code id,' {' +code+ '}' + descbgt  nama")
										->where('thn',$parent_id)
										->where('id_parent',$id_parent)
										->get('db_mstbgt_update')->result();
						
						}else{
							$sql = $this->db->select("code id,' {' +code+ '}' + descbgt  nama")
										->where('thn',$parent_id)
										->where('divisi_id',$divisi)
										->where('id_pt',$pt)
										->get('db_mstbgt_update')->result();							
						}
						break;
					default:
					    $sql = $this->db->select('subproject_id id,nm_subproject nama')
										->where('id_pt',$pt)
										->order_by('nm_subproject','ASC')
										->get('db_subproject')->result();
				}
				$response = array();
				if($sql){
					foreach($sql as $row){
						$response[] = $row;
					}
				}else{
					$response['error'] = 'Data kosong';
				}
				die(json_encode($response));
			}			
		}	
}
