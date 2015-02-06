<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class locaset_model extends DBModel {

	function __construct()
	{
		parent::__construct('db_lokasi_aset','id_lokasi');
	}

	function before_fetch()
	{
		parent::before_fetch();
	}

	function savedata($data)
	{
		$q = $this->db->insert('db_lokasi_aset', $data);
		return $q;
	}

	function updatedata($id,$data)
	{
		$this->db->where('id_lokasi', $id);
		$q = $this->db->update('db_lokasi_aset', $data);
		return $q;
	}

}

/* End of file asset_model.php */
/* Location: ./application/models/asset_model.php */