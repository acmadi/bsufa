<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mutasiaset_model extends DBModel {

	function __construct()
	{
		parent::__construct('db_aset','id_aset');
	}

	function before_fetch()
	{
		$this->db->select("id_aset,nm_brg,kd_aset,remark,nilai_aset,tgl_penerimaan,CASE flag_aset WHEN 1 THEN 'Aktif' WHEN 2 THEN 'Mutasi' WHEN 3 THEN 'Dijual' ELSE 'Tidak Aktif' END as status ");
		parent::before_fetch();
	}

	function insertdata($table,$data)
	{
		$q = $this->db->insert($table, $data);
		return $q;
	}

	function getdetail($table,$pk,$value,$key,$order)
	{
		$this->db->where($pk,$value);
		$this->db->order_by($key, $order);
		$q = $this->db->get($table);
		return $q;
	}

	function updatedata($table,$pk,$value,$data)
	{
		$this->db->where($pk,$value);
		$q = $this->db->update($table, $data);
		return $q;
	}
}