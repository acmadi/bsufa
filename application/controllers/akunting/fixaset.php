<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fixaset extends DBController {

	function __construct()
	{
		parent::__construct('asset_model');
		$this->set_page_title('FIX ASSET');
		$this->default_limit = 30;
		$this->template_dir = 'accounting/fixaset';
		$this->load->model('asset_model');
		error_reporting(0);
	}

	function get_json()
	{
		$this->set_custom_function('nilai_aset','currency');
		parent::get_json();
	}

	function index()
	{
		$this->set_grid_column('id_aset','ID',array('hidden'=>true));
		$this->set_grid_column('kd_aset','Kode Aset',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('nm_brg','Nama Aset',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('kd_lokasi','Lokasi Aset',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('tgl_penerimaan','Date',array('width'=>200, 'formatter' => 'cellColumn'));			
		$this->set_grid_column('nilai_aset','Nilai Aset',array('width'=>160, 'formatter' => 'cellColumn'));		
		$this->set_grid_column('kategori','Kategori',array('width'=>160, 'align'=>'right', 'formatter' => 'cellColumn'));		
		$this->set_jqgrid_options(array('width'=>1300,'height'=>350,'caption'=>'FIX ASSET','rownumbers'=>true,'sortname'=>'id_aset','sortorder'=>'desc'));
		parent::index();
	}

	function add_data()
	{
		$data['kat'] = $this->db->query("select * from db_kategori_aset order by kategori asc")->result();
		$data['loka'] = $this->db->query("select * from db_lokasi_aset order by kd_lokasi asc")->result();
		$this->load->view('accounting/fixaset-input', $data);
	}

	function savefix()
	{
		$session_id = $this->UserLogin->isLogin();
		$data['id_pt'] = $session_id['id_pt'];
		$data['kd_aset'] = $this->input->post('kd_aset', TRUE);
		$data['nilai_satuan'] = replace_numeric($this->input->post('satuan', TRUE));
		$data['qty'] = $this->input->post('qty', TRUE);
		$data['nm_brg'] = $this->input->post('nama', TRUE);
		$data['kd_lokasi'] = $this->input->post('lokasi', TRUE);
		$data['kategori'] = $this->input->post('kategori', TRUE);
		$data['nilai_aset'] = replace_numeric($this->input->post('nilai', TRUE));
		$data['tgl_penerimaan'] = inggris_date($this->input->post('tgl', TRUE));
		$data['remark'] = $this->input->post('remark', TRUE);
		$data['flag_aset'] = 1;
		$send = $this->asset_model->savedata($data);
		if ($send == TRUE) {
			$data['coa1'] = $this->input->post('coa1', TRUE);
			$data['coa2'] = $this->input->post('coa2', TRUE);
			$this->savejurnalaset($data);
			die("sukses");
		} else {
			die("Gagal Simpan Data");
		}
	}

	function savejurnalaset($in)
	{
		$session_id = $this->UserLogin->isLogin();
		$user = $session_id['username'];
		$data['kodeaset'] = $in['kd_aset'];
		$data['trans_date'] = $in['tgl_penerimaan'];
		$data['module'] = 'AM'; //AM = Asset Management
		$data['remark'] = $in['remark'];
		$data['user_input'] = $user;
		$data['input_date'] = date('Y-m-d');
		$data['audit_date'] = $data['input_date'];
		$cekvoucher = $this->db->query("select top 1 * from db_jurnalasetheader where YEAR(trans_date) = '".date('Y')."' and MONTH(trans_date) = '".date('m')."' ")->row()->voucher;
		if ($cekvoucher == '') {
			$data['voucher'] = "AM/".date('Y')."/".date('m')."/00001";
		} else {
			$pecah = explode('/', $cekvoucher);
			$no = $pecah[3]+1;
			if($no<=9){
				$data['voucher'] = "AM/".date('Y')."/".date('m')."/0000".$no;
			}elseif($no<=99){
				$data['voucher'] = "AM/".date('Y')."/".date('m')."/000".$no;
			}elseif($no<=999){
				$data['voucher'] = "AM/".date('Y')."/".date('m')."/00".$no;
			}elseif($no<=9999){
				$data['voucher'] = "AM/".date('Y')."/".date('m')."/0".$no;
			}elseif($no<=99999){
				$data['voucher'] = "AM/".date('Y')."/".date('m')."/".$no;
			}
		}
		$data['debet'] = intval($in['nilai_aset']);
		$data['credit'] = 0;
		$data['balance'] = $data['debet'];
		$send = $this->asset_model->savedatajurnal($data);
		if ($send == TRUE) {
			$this->db->query("insert into db_glheader(voucher,trans_date,desc,debit,credit,balance,module,status,audit_user,audit_date,entry_date,project_cd) values ('".$data['voucher']."','".$data['trans_date']."','".$data['remark']."',".$data['debet'].",".$data['credit'].",".$data['balance'].",'".$data['module']."',0,'".$data['user_input']."','".$data['input_date']."','".$data['input_date']."','-')");
			$data['coa1'] = $in['coa1'];
			$data['coa2'] = $in['coa2'];
			$data['kategori'] = $in['kategori'];
			$this->savedetailjurnal($data);
			die("sukses");
		} else {
			var_dump($data);
			die("Gagal Simpan Data");
		}
		
	}

	function savedetailjurnal($head)
	{
		$kat = 12*$head['kategori'];
		$nilai = $head['debet'] / $kat ;
		$time = $head['trans_date'];
		for ($i=1; $i <= $kat ; $i++) { 
			$data['voucher'] = $head['voucher'];
			$data['remark'] = $head['remark'];
			$data['user_input'] = $head['user_input'];
			$data['input_date'] = date('Y-m-d');
			$data['status'] = 0;
			$data['debet'] = $nilai;
			$data['credit'] = 0;
			$data['balance'] = $data['debet'];
			$time = date('Y-m-d', strtotime($time. ' + 30 days'));
			$data['trans_date'] = $time;
			$data['module'] = $head['module'];
			$data['acc_no'] = $head['coa1'];
			$data['acc_no_lawan'] = $head['coa2'];
			$send = $this->asset_model->savedetailjurnal($data);
		}
	}

	function updatefix($id)
	{
		$data['kd_aset'] = $this->input->post('kd_aset', TRUE);
		$data['nm_brg'] = $this->input->post('nama', TRUE);
		$data['kd_lokasi'] = $this->input->post('lokasi', TRUE);
		$data['kategori'] = $this->input->post('kategori', TRUE);
		$data['nilai_aset'] = replace_numeric($this->input->post('nilai', TRUE));
		$data['tgl_penerimaan'] = $this->input->post('tgl', TRUE);
		$data['remark'] = $this->input->post('remark', TRUE);
		$send = $this->asset_model->updatedata($id,$data);
		if ($send == TRUE) {
			die("sukses");
		} else {
			die("Gagal Update Data");
		}
	}

	function delete($get)
	{
		$id = explode('&', $get);
		$this->db->where('id_aset', $id[0]);
		$this->db->delete('db_aset');
		echo "<script>
			alert('Hapus Berhasil');
			history.go(-1);
			refreshTable();
			</script>";
	}

	function gen()
	{
		$data['barangpo'] = $this->db->query("select * from db_BarangPOMsk")->result();
		$this->load->view('accounting/fixaset-generate',$data);
	}

}

/* End of file fixasset.php */
/* Location: ./application/controllers/fixasset.php */