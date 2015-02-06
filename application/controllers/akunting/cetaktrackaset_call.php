<?
	defined('BASEPATH') or die('Access Denied');
	
	class cetaktrackaset_call extends AdminPage{

		function cetaktrackaset_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}

		function index()
		{
			$data['asset'] = $this->db->query("select * from db_aset order by nm_brg asc")->result();
			$this->parameters=$data;
			$this->loadTemplate('accounting/cetaktrackaset_view', $data);
		}

		function cetaktrack()
		{
			if ($this->input->post('all') == 1) {
				$data['all'] = 1;
				$this->load->view('accounting/print/print_trackaset', $data);
			} else {
				$data['all'] = 0;
				$this->load->view('accounting/print/print_trackaset', $data);
			}
			
		}
	}