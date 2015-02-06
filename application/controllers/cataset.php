<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cataset extends DBController {

	function __construct()
	{
		parent::__construct('cataset_model');
		$this->set_page_title('CATEGORY ASSET');
		$this->default_limit = 10;
		$this->template_dir = 'accounting/cataset';
		$this->load->model('cataset_model');
	}

	protected function setup_form($data=false)
	{

	}

	function index()
	{
		$this->set_grid_column('id','ID',array('hidden'=>true));
		$this->set_grid_column('kd_kategori','Kode Kategori',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('kategori','Kategori',array('width'=>200, 'formatter' => 'cellColumn'));		
		$this->set_jqgrid_options(array('width'=>1300,'height'=>350,'caption'=>'CATEGORY ASSET','rownumbers'=>true,'sortname'=>'','sortorder'=>''));
		parent::index();	
	}

	function savekat()
	{
		$data['kd_kategori'] = $this->input->post('kode', TRUE);
		$data['kategori'] = $this->input->post('kategori', TRUE);
		$send = $this->cataset_model->savedata($data);
		if ($send == TRUE) {
			die("sukses");
		} else {
			die("Gagal Simpan Data");
		}
	}

	function updatekat($id)
	{
		$data['kd_kategori'] = $this->input->post('kode', TRUE);
		$data['kategori'] = $this->input->post('kategori', TRUE);
		$send = $this->cataset_model->updatedata($id,$data);
		if ($send == TRUE) {
			die("sukses");
		} else {
			die("Gagal Update Data");
		}	
	}

	function delete($get)
	{
		$id = explode('&', $get);
		$this->db->where('id', $id[0]);
		$this->db->delete('db_kategori_aset');
		echo "<script>
			alert('Hapus Berhasil');
			history.go(-1);
			refreshTable();
			</script>";
	}

}

/* End of file cataset.php */
/* Location: ./application/controllers/cataset.php */