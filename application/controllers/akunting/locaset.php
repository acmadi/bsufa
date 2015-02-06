<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class locaset extends DBController {

	function __construct()
	{
		parent::__construct('locaset_model');
		$this->set_page_title('ASSET LOCATION');
		$this->default_limit = 10;
		$this->template_dir = 'accounting/locaset';
		$this->load->model('locaset_model');
	}

	function index()
	{
		$this->set_grid_column('id_lokasi','ID',array('hidden'=>true));
		$this->set_grid_column('kd_lokasi','Kode Lokasi',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('lokasi','Lokasi',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('detail','Detail',array('width'=>200, 'formatter' => 'cellColumn'));		
		$this->set_jqgrid_options(array('width'=>1300,'height'=>350,'caption'=>'ASSET LOCATION','rownumbers'=>true,'sortname'=>'','sortorder'=>''));
		parent::index();	
	}

	function saveloc()
	{
		$session_id = $this->UserLogin->isLogin();
		$data['kd_lokasi'] = $this->input->post('kd_lokasi', TRUE);
		$data['lokasi'] = $this->input->post('lokasi', TRUE);
		$data['detail'] = $this->input->post('detail', TRUE);
		$data['id_pt'] = $session_id['id_pt'];
		$send = $this->locaset_model->savedata($data);
		if ($send == TRUE) {
			die("sukses");
		} else {
			die("Gagal Simpan Data");
		}
	}

	function updateloc($id)
	{
		$data['kd_lokasi'] = $this->input->post('kd_lokasi', TRUE);
		$data['lokasi'] = $this->input->post('lokasi', TRUE);
		$data['detail'] = $this->input->post('detail', TRUE);
		$send = $this->locaset_model->updatedata($id,$data);
		if ($send == TRUE) {
			die("sukses");
		} else {
			die("Gagal Update Data");
		}
	}

	function delete($get)
	{
		$id = explode('&', $get);
		$this->db->where('id_lokasi', $id[0]);
		$this->db->delete('db_lokasi_aset');
		echo "<script>
			alert('Hapus Berhasil');
			history.go(-1);
			refreshTable();
			</script>";
	}

}

/* End of file locaset.php */
/* Location: ./application/controllers/locaset.php */