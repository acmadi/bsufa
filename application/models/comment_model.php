<?
	defined('BASEPATH') or die('Access Denied');

	class Comment_model extends Base_model{
	
	   function Comment_model(){
		parent::Base_model();
		$this->tableName = 'comment_article';
		$this->primaryField = 'id_comment';
		$this->fields = array(
			'name'=>array('Nama',true),
			'email'=>array('Email',true,'valid_email'),
			'comment_content'=>array('Isi Komentar',true),
			'comment_date'=>array('Tanggal Komentar',true)
		);
	   }
	}
?>
