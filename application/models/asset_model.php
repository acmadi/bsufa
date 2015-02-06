<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class asset_model extends DBModel {

	function __construct()
	{
		parent::__construct('db_aset','id_aset');
	}

	function before_fetch()
	{
		parent::before_fetch();
	}

	function savedata($data)
	{
		$q = $this->db->insert('db_aset', $data);
		return $q;
	}

	function savedatajurnal($data)
	{
		$q = $this->db->insert('db_jurnalasetheader', $data);
		return $q;
	}

	function savedetailjurnal($data)
	{
		$q = $this->db->insert('db_jurnalasetdetail', $data);
		return $q;
	}

	function savedataglheader($data)
	{
		$q = $this->db->insert('db_glheader', $data);
		return $q;
	}

	function updatedata($id,$data)
	{
		$this->db->where('id_aset', $id);
		$q = $this->db->update('db_aset', $data);
		return $q;
	}

}

/* End of file asset_model.php */
/* Location: ./application/models/asset_model.php */