<?
	defined('BASEPATH') or die('Access Denied');
	
	class cetaklistaset_call extends AdminPage{

		function cetaklistaset_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}

		function index()
		{
			$this->loadTemplate('accounting/cetaklistaset_view');
		}

		function cetaklist()
		{
			extract(PopulateForm());
			$data['tgl'] = $this->input->post('tgl', TRUE);
			if ($this->input->post('klik') == TRUE) {
				$this->load->view('accounting/print/print_listaset',$data);
			} else {
				$this->load->view('accounting/print/print_listaset_excel',$data);
			}
		}
	}