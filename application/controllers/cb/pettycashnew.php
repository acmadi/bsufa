<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pettycashnew extends DBController {

	function __construct()
	{
		parent::__construct('pettycashnew_model');
		$this->set_page_title('PETTY CASH');
		$this->default_limit = 10;
		$this->template_dir = 'cb/pettycashnew';
		$this->load->model('pettycashnew_model');
	}

	function index()
	{
		$this->set_grid_column('id_ptcash','ID',array('hidden'=>true));
		$this->set_grid_column('voucher','Voucher',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('tanggal','Date',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('deskripsi','Description',array('width'=>200, 'formatter' => 'cellColumn'));	
		$this->set_grid_column('amount','Amount',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_jqgrid_options(array('width'=>1300,'height'=>350,'caption'=>'PETTY CASH','rownumbers'=>true,'sortname'=>'id_ptcash','sortorder'=>'desc'));
		parent::index();	
	}

	function reimburse()
	{
		$this->load->view('cb/pettycashnew-reimburse');	
	}

	function simpandata()
	{
		$cekvoucher = $this->db->query("select top 1 * from db_pettynew where YEAR(tanggal) = '".date('Y')."' and MONTH(tanggal) = '".date('m')."' ")->row()->voucher;
		if ($cekvoucher == null) {
			$data['voucher'] = "PT/".date('Y')."/".date('m')."/00001";
		} else {
			$pecah = explode('/', $cekvoucher);
			$no = $pecah[3]+1;
			if($no<=9){
				$data['voucher'] = "PT/".date('Y')."/".date('m')."/0000".$no;
			}elseif($no<=99){
				$data['voucher'] = "PT/".date('Y')."/".date('m')."/000".$no;
			}elseif($no<=999){
				$data['voucher'] = "PT/".date('Y')."/".date('m')."/00".$no;
			}elseif($no<=9999){
				$data['voucher'] = "PT/".date('Y')."/".date('m')."/0".$no;
			}elseif($no<=99999){
				$data['voucher'] = "PT/".date('Y')."/".date('m')."/".$no;
			}
		}
		$cekptc= $this->db->query("select top(1) * from master_pettycash where status = 1")->row();
		$data['kode_cashflow'] = $this->input->post('kode', TRUE);
		$data['nomor_petty'] = $cekptc->nomor_mptcash;
		$data['amount'] = replace_numeric($this->input->post('amt', TRUE));
		$data['deskripsi'] = $this->input->post('desc', TRUE);
		$data['tanggal'] = inggris_date($this->input->post('tgl', TRUE));
		$data['flag_hapus'] = 0;
		$this->db->query("update master_pettycash set saldo_mptcash = saldo_mptcash - ".$data['amount']." where nomor_mptcash = '".$cekptc->nomor_mptcash."' ");
		$q = $this->pettycashnew_model->insertdata('db_pettynew',$data);
		if ($q == TRUE) {
			die('sukses');
		} else {
			die('Gagal Simpan');
		}
		
	}

	function ubahdata($id)
	{

	}

	function delete($id)
	{
		$cekptc= $this->db->query("select top(1) * from master_pettycash where status = 1")->row();
		$key = explode('&', $id);
		$amt = $this->db->query("select amount from db_pettynew where id_ptcash = ".$key[0]." ")->row();
		$q = $this->db->query("update master_pettycash set saldo_mptcash = saldo_mptcash + ".$data['amount']." and flag_hapus = 1 where nomor_mptcash = '".$cekptc->nomor_mptcash."' ");
		if ($q == TRUE) {
			echo "<script>alert('Sukses');history.go(-1);refreshTable();</script>";
		} else {
			die('Gagal Simpan');
		}
	}

}

/* End of file mpettycash.php */
/* Location: ./application/controllers/mpettycash.php */