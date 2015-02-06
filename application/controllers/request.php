<?php
defined('BASEPATH') or die('Access Denied');
Class request extends AdminPage{
	function request()
	{
		parent::AdminPage();
		$this->pageCaption = 'Print Budget ';
	}
	
	function index()
	{
		$data['divisi'] = $this->db->get('user_group')->result();
		$this->parameters['data'] = $data;
		$this->loadTemplate('report/request_view');
	}
	
	function divisi()
	{
		$this->loadTemplate('report/divisi_view');
	}
		
}
