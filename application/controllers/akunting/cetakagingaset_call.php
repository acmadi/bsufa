<?
	defined('BASEPATH') or die('Access Denied');
	
	class cetakagingaset_call extends AdminPage{

		function cetakagingaset_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}

		function index()
		{
			$data['asset'] = $this->db->query("select * from db_aset order by nm_brg asc")->result();
			$this->parameters=$data;
			$this->loadTemplate('accounting/cetakagingaset_view', $data);
		}

		function cetakaging()
		{
			$this->load->view('accounting/print/print_agingaset');
		}
	}