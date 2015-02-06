<?php
	defined('BASEPATH') or die('Access Denied');
	class Links_model extends Base_model{
			
		function Links_model(){
			parent::Base_model();
			$this->tableName = 'links';
			$this->primaryField = 'id_link';
			$this->fields = array(
				'link_index'=>array('Link Index',true,'is_natural'),
				'name'=>array('Name',true),
				'url'=>array('URL',true),
				'status'=>array('Status',true)
			);
		}
		
		function getLinks(){
			$this->db->order_by('link_index');
			$this->db->where('status','on');			
			return $this->get();
		}
		
	}
?>
