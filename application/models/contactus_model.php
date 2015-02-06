<?php
	defined('BASEPATH') or die('Access Denied');
	
	class ContactUs_model extends Base_model{		

		function ContactUs_model(){
			parent::Base_model();
			$this->tableName = 'contactus';
			$this->primaryField = 'id_contactus';
			$this->fields = array(
				'name'=>array('Name',true),
				'email'=>array('Email',true,'valid_email'),
				'message'=>array('Message',true),
				'ipaddr'=>array('Ipaddr',false),		
				'status'=>array('Status')			
			);
		}	
		
		function save($id = false){
			if(!$id) $this->db->set('submitdate',now());
			return parent::save($id);
		}
	}
?>
