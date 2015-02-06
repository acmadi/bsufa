<?php
class useraccess extends DBController{
	function __construct(){
		parent::__construct('useraccess_model');
		$this->set_page_title('List Username');
		$this->template_dir = 'user/useraccess';
	    $session_id = $this->UserLogin->isLogin();
	    $this->user_account = $session_id['id'];
	    //var_dump($this->user_account);exit;
	}

	protected function setup_form($data=false){
		$this->parameters['UserGroup'] = $this->db->order_by('group_name','ASC')
												  ->get('user_group')->result();
		$this->parameters['pt'] = $this->db->get('pt')->result();
		$this->parameters['divisi'] = $this->db->order_by('divisi_nm','ASC')
											   ->get('db_divisi')->result();
	}
	
	function index(){
		$this->set_grid_column('id_user','ID',array('hidden'=>true));
		$this->set_grid_column('group_name','Group Name',array('width'=>100,'align'=>'left','formatter' => 'cellColumn'));
		$this->set_grid_column('kary_id','ID Karyawan',array('width'=>60));
		$this->set_grid_column('username','Username',array('width'=>90,'formatter' => 'cellColumn'));
		$this->set_grid_column('divisi_nm','Division',array('width'=>100));
		$this->set_grid_column('ket','PT',array('width'=>100));
		$this->set_grid_column('status','Status',array('width'=>40));
		$this->set_jqgrid_options(array('width'=>860,'height'=>300,'caption'=>'List User','rownumbers'=>true,'sortname'=>'username','sortorder'=>'ASC'));
		if($this->user_account==1)parent::index();
		else redirect("user/login");
	}
	
	function cekuser(){
		$field = $this->input->get('fieldId');
		$value = $this->input->get('fieldValue');
		$save = $this->db->where('username',$value)
						 ->get('user_admin')->num_rows();
		$call = $save > 0;
		$result = array($field,!$call);
		echo json_encode($result);
	}
	
	function save(){
		extract(PopulateForm());
		$dt = array
		(
			'group_id' => $group,
			'id_pt' => $pt,
			'divisi_id' => $divisi,
			'username' => $username,
			'password' => md5($pass1),
			'status' => $status 
		);
		
		$this->db->insert('user_admin',$dt);
		echo"sukses";
		//parent::save();
	}
	
		
}


