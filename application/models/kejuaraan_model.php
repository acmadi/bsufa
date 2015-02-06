<?
	defined('BASEPATH') or die('Access Denied');
	
	class Kejuaraan_model extends Base_model{
		
		function Kejuaraan_model(){
			parent::Base_model();
			$this->tableName = 'kejuaraan';
			$this->primaryField = 'kejuaraan_id';
			$this->fields = array(
				'kejuaraan_name'=>array('Name Kejuaraan',true),
				'kejuaraan_desc'=>array('Description Kejuaraan',true)
			);
		}
	}
?>
