<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mpettycash extends DBController {

	function __construct()
	{
		parent::__construct('mstpettycash_model');
		$this->set_page_title('PETTY CASH');
		$this->default_limit = 10;
		$this->template_dir = 'cb/mpettycash';
		//$this->load->model('');
	}
	
	function get_json(){
		$this->set_custom_function('bln_mptcash','indo_date');
		$this->set_custom_function('amount_mptcash','currency');
		$this->set_custom_function('saldo_mptcash','currency');
		parent::get_json();
	}

	function index()
	{
		$this->set_grid_column('id_mptcash','ID',array('hidden'=>true));
		$this->set_grid_column('nomor_mptcash','No Master Pettycash',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('bln_mptcash','Date',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('amount_mptcash','Amount',array('width'=>200, 'formatter' => 'cellColumn'));	
		$this->set_grid_column('saldo_mptcash','Saldo',array('width'=>200, 'formatter' => 'cellColumn'));	
		$this->set_jqgrid_options(array('width'=>1300,'height'=>350,'caption'=>'PETTY CASH','rownumbers'=>true,'sortname'=>'','sortorder'=>'id_mptcash'));
		parent::index();
		#id_mptcash, nomor_mptcash, bln_mptcash, amount_mptcash, saldo_mptcash, deskripsi
	}
	
	function input_saldo(){
		$mpt = $this->input->post('nomor_mpt');
		$tgl = date('Y')."-".$this->input->post('bln_mptcash')."-".date('d');
		$amt = str_replace(",","",$this->input->post('amount'));
		$sld = str_replace(",","",$this->input->post('saldo')) + $amt;
		$des = $this->input->post('petty_desc');
		$Q = "insert into master_pettycash (
									nomor_mptcash,
									bln_mptcash,
									amount_mptcash,
									saldo_mptcash,
									deskripsi
								) values 
								(
									'".$mpt."',
									'".$tgl."',
									'".$amt."',
									'".$sld."',
									'".$des."'
								)";
		echo $Q;
		$this->db->query($Q);
	}

}

/* End of file mpettycash.php */
/* Location: ./application/controllers/mpettycash.php */