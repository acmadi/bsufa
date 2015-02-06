<?php
	defined('BASEPATH') or die('Access Denied');
	class Setupmenu_model extends Base_model{
			
		function Setupmenu_model(){
			parent::Base_model();
			$this->tableName = 'user_group';
			$this->primaryField = 'id_group';
			$this->fields = array(
				'group_name'=>array('GoupName',true)
			);
		}
	}
?>
