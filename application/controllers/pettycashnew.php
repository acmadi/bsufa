<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pettycashnew extends DBController {

	function __construct()
	{
		parent::__construct('pettycashnew_model');
		$this->set_page_title('PETTY CASH');
		$this->default_limit = 10;
		$this->template_dir = 'cb/pettycashnew';
		$this->load->model('pettycashnew_model');
		error_reporting(0);
	}

	function get_json(){
		$this->set_custom_function('tanggal','indo_date');
		$this->set_custom_function('amount','currency');
		parent::get_json();
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
			$data['voucher'] = "PC/".date('Y')."/".date('m')."/00001";
		} else {
			$pecah = explode('/', $cekvoucher);
			$no = $pecah[3]+1;
			if($no<=9){
				$data['voucher'] = "PC/".date('Y')."/".date('m')."/0000".$no;
			}elseif($no<=99){
				$data['voucher'] = "PC/".date('Y')."/".date('m')."/000".$no;
			}elseif($no<=999){
				$data['voucher'] = "PC/".date('Y')."/".date('m')."/00".$no;
			}elseif($no<=9999){
				$data['voucher'] = "PC/".date('Y')."/".date('m')."/0".$no;
			}elseif($no<=99999){
				$data['voucher'] = "PC/".date('Y')."/".date('m')."/".$no;
			}
		}
		$cekptc= $this->db->query("select top(1) * from master_pettycash where status = 1")->row();
		$data['kode_cashflow'] = $this->input->post('kode', TRUE);
		$data['nomor_petty'] = $cekptc->nomor_mptcash;
		$data['amount'] = replace_numeric($this->input->post('amt', TRUE));
		$data['deskripsi'] = $this->input->post('desc', TRUE);
		$data['tanggal'] = inggris_date($this->input->post('tgl', TRUE));
		$data['flag_hapus'] = 0;
		$data['status'] = 0;
		$this->db->query("update master_pettycash set saldo_mptcash = saldo_mptcash - ".$data['amount']." where nomor_mptcash = '".$cekptc->nomor_mptcash."' ");
		$q = $this->pettycashnew_model->insertdata('db_pettynew',$data);
		if ($q == TRUE) {
			die('sukses');
		} else {
			die('Gagal Simpan');
		}
		
	}

	function update($id)
	{
		$cek = $this->db->query("select status from db_pettynew where id_ptcash = ".$id." ")->row();
		if ($cek->status == 1) {
			echo "<script>alert('Sudah Di Reimburse');refreshTable();</script>";
		} else {
			parent::update($id);
		}
	}

	function updatedata($id)
	{
		$cekpta= $this->db->query("select * from db_pettynew where id_ptcash = ".$id."")->row();
		$data['kode_cashflow'] = $this->input->post('kode', TRUE);
		$data['amount'] = replace_numeric($this->input->post('amt', TRUE));
		$data['deskripsi'] = $this->input->post('desc', TRUE);
		$data['tanggal'] = inggris_date($this->input->post('tgl', TRUE));
		$this->db->query("update master_pettycash set saldo_mptcash = saldo_mptcash - ".$data['amount']." + ".$cekpta->amount." where nomor_mptcash = '".$cekpta->nomor_petty."' ");
		$q = $this->pettycashnew_model->updatedata('db_pettynew','id_ptcash',$id,$data);
		if ($q == TRUE) {
			die('sukses');
		} else {
			die('Gagal Update Data');
		}
	}

	function delete($id)
	{
		$cek = $this->db->query("select status from db_pettynew where id_ptcash = ".$id." ")->row();
		if ($cek->status == 1) {
			echo "<script>alert('Sudah Di Reimburse');refreshTable();</script>";
		} else {
			$cekptc= $this->db->query("select top(1) * from master_pettycash where status = 1")->row();
			$key = explode('&', $id);
			$amt = $this->db->query("select amount from db_pettynew where id_ptcash = ".$key[0]." ")->row();
			$q = $this->db->query("update master_pettycash set saldo_mptcash = (saldo_mptcash + ".replace_numeric($amt->amount).") where nomor_mptcash = '".$cekptc->nomor_mptcash."' ");
			$q2 = $this->db->query("update db_pettynew set flag_hapus = 1 where id_ptcash = ".$key[0]."");
			if (($q == TRUE) && ($q2 == TRUE)) {
				echo "<script>alert('Sukses');history.go(-1);refreshTable();</script>";
			} else {
				die('Gagal Simpan');
			}
		}
	}

	function reimbursin()
	{
		$cekptc= $this->db->query("select top 1 bln_mptcash from master_pettycash order by id_mptcash desc")->row();
		$data['from'] = inggris_date($this->input->post('from', TRUE));
		$data['to'] = inggris_date($this->input->post('to', TRUE));
		$range = $this->db->query("select voucher from db_pettynew where flag_hapus != 1 and tanggal >= '".$data['from']."' and tanggal <= '".$data['to']."' ")->result();
		if(is_null($cekptc->bln_mptcash)) {
			foreach ($range as $row) {
				$bk = $this->db->query("select voucher from db_gldetail where SUBSTRING(voucher,0,3) = 'BK' order by gl_id desc")->row();
				$pecah = explode('/', $bk->voucher);
				$no = $pecah[3]+1;
				if($no<=9){
					$voucherbk = "BK/".date('Y')."/".date('m')."/0000".$no;
				}elseif($no<=99){
					$voucherbk = "BK/".date('Y')."/".date('m')."/000".$no;
				}elseif($no<=999){
					$voucherbk = "BK/".date('Y')."/".date('m')."/00".$no;
				}elseif($no<=9999){
					$voucherbk = "BK/".date('Y')."/".date('m')."/0".$no;
				}elseif($no<=99999){
					$voucherbk = "BK/".date('Y')."/".date('m')."/".$no;
				}
				$voucher = $row->voucher;
				$q = $this->db->query("sp_insertpettynew '".$voucher."','".$voucherbk."'");
				//var_dump("sp_insertpettynewa '".$voucher."','".$voucherbk."'");exit();
			}
		} else {
			if ($cekptc->bln_mptcash >= $data['from']){
				echo "<script>alert('Tanggal Awal Tidak Boleh Lebih Kecil Dari Opening');history.go(-1);refreshTable();</script>";
			} else {
				foreach ($range as $row) {
					$bk = $this->db->query("select voucher from db_gldetail where SUBSTRING(voucher,0,3) = 'BK' order by gl_id desc")->row();
					$pecah = explode('/', $bk->voucher);
					$no = $pecah[3]+1;
					if($no<=9){
						$voucherbk = "BK/".date('Y')."/".date('m')."/0000".$no;
					}elseif($no<=99){
						$voucherbk = "BK/".date('Y')."/".date('m')."/000".$no;
					}elseif($no<=999){
						$voucherbk = "BK/".date('Y')."/".date('m')."/00".$no;
					}elseif($no<=9999){
						$voucherbk = "BK/".date('Y')."/".date('m')."/0".$no;
					}elseif($no<=99999){
						$voucherbk = "BK/".date('Y')."/".date('m')."/".$no;
					}
					$voucher = $row->voucher;
					$q = $this->db->query("sp_insertpettynew '".$voucher."','".$voucherbk."'");
					//var_dump($q);exit();
				}
			}
		}
		die('sukses');

	}

	function print_report()
	{
		$this->load->view('cb/print/print_pc');
	}

}

/* End of file mpettycash.php */
/* Location: ./application/controllers/mpettycash.php */