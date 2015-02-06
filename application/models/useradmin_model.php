<?php
	defined('BASEPATH') or die('Access Denied');
	class Useradmin_model extends Base_model{
			
		function Useradmin_model(){
			parent::Base_model();
			$this->tableName = 'user_admin';
			$this->primaryField = 'id_user';
			$this->fields = array(
				'group_id'=>array('Group ID',true),
				'username'=>array('Username',true),
				'password'=>array('Password',true,'matches[passconf]|md5'),
				'passconf'=>array('Password Confirmation',true,'md5'),
				'status'=>array('Status',true)
			);
			$this->ignoreFields = array('passconf');
		}
		
		function checkUsername($value=false){			
			$check = $this->dataNotRedudant('username',$value);
			if(!$check){
			  setError('Username has been used before,please try another username');
			  return FALSE;
			}else return TRUE;
		}
		
	}
?>
