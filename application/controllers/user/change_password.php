<?php
defined('BASEPATH') or die('Access Denied');
Class change_password extends AdminPage{
	function request()
	{
		parent::AdminPage();
		$this->pageCaption = 'Change Password';
	}
	
	function index()
	{
		$session_id = $this->UserLogin->isLogin();
		//$username = $session_id['username'];
		$this->parameters['session'] = $session_id;
		$this->loadTemplate('user/change_password_view');
	}
	
	function ubah_password(){
		extract(PopulateForm());
		$data = array 
		(
			'password'=>md5($password1)
		);
		$update = $this->db->where('id_user',$id_user)
						   ->update('user_admin',$data);
						   
		if($update){
			echo"Password change";
		}else{
			echo"Password not change";
		}
		
	}	
}
