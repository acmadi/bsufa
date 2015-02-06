<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cataset_model extends DBModel {

	function __construct()
	{
		parent::__construct('db_kategori_aset','id');
	}

	function before_fetch()
	{
		parent::before_fetch();
	}

	function savedata($data)
	{
		$q = $this->db->insert('db_kategori_aset', $data);
		return $q;
	}

	function updatedata($id,$data)
	{
		$this->db->where('id', $id);
		$q = $this->db->update('db_kategori_aset', $data);
		return $q;
	}

}

/* End of file asset_model.php */
/* Location: ./application/models/asset_model.php */