<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class historyjurnal_model extends DBModel {

	function __construct()
	{
		parent::__construct('view_post_jurnal','id');
	}

	function before_fetch()
	{
		$session_id = $this->UserLogin->isLogin();
		$pt = $session_id['id_pt'];
		$this->db->where('id_pt', $pt);
		$this->db->where('status', 1);
		parent::before_fetch();
	}
}