<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class moveaset extends DBController {

	function __construct()
	{
		parent::__construct('moveaset_model');
		$this->set_page_title('FIX ASSET');
		$this->default_limit = 30;
		$this->template_dir = 'accounting/moveaset';
		$this->load->model('moveaset_model');
	}

	protected function setup_form($data=false)
	{
		$session = $this->UserLogin->isLogin();
		$pt = $session['id_pt'];
                        
		$this->parameters['kdaset'] = $this->db->select('*')->order_by('kd_aset','ASC')->get('db_aset')->result(); 
		$this->parameters['loka'] = $this->db->query("select * from db_lokasi_aset order by kd_lokasi asc")->result();    
		$this->parameters['project_detail'] = $this->db->select('subproject_id,nm_subproject')
			->where('pt_id',$pt )
			->order_by('subproject_id','ASC')
			->get('db_subproject')
			->result();	
   
																								
    }

	function get_json()
	{
		$this->set_custom_function('tanggal','indo_date');
		parent::get_json();
	}

	function index()
	{
		$this->set_grid_column('id','ID',array('hidden'=>true));
		$this->set_grid_column('kd_aset','Kode Aset',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('nm_brg','Nama Aset',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('lb','Lokasi Awal',array('width'=>200, 'formatter' => 'cellColumn'));
		$this->set_grid_column('lk','Lokasi Awal',array('width'=>200, 'formatter' => 'cellColumn'));			
		$this->set_grid_column('tanggal','Date',array('width'=>160, 'formatter' => 'cellColumn'));
		$this->set_grid_column('remark','Keterangan',array('width'=>160, 'formatter' => 'cellColumn'));			
		$this->set_jqgrid_options(array('width'=>1300,'height'=>350,'caption'=>'PEMINDAHAN ASSET','rownumbers'=>true,'sortname'=>'id','sortorder'=>'desc'));
		parent::index();
		
	}

	function get_aset()
	{
		$c = $this->input->post('c');
		if ($c == "") {
			echo "--Pilih Aset--";
		} else {
			$Q = $this->db->query("select * from db_aset where kd_aset = '".$c."'")->result();
			echo $Q[0]->nm_brg;
		}
	}

	function get_lokasi()
	{
		$c = $this->input->post('c');
		if ($c == "") {
			echo "--Pilih Aset--";
		} else {
			$Q = $this->db->query("select * from db_aset a join db_lokasi_aset b on a.kd_lokasi = b.kd_lokasi where a.kd_aset = '".$c."'")->result();
			echo $Q[0]->lokasi;	
		}
	}

	function get_kode_lokasi()
	{
		$c = $this->input->post('c');
		if ($c == "") {
			echo "--Pilih Aset--";
		} else {
			$Q = $this->db->query("select * from db_aset a join db_lokasi_aset b on a.kd_lokasi = b.kd_lokasi where a.kd_aset = '".$c."'")->result();
			echo $Q[0]->kd_lokasi;	
		}
	}

	function move()
	{
		$data['kd_aset'] = $this->input->post('kode');
		$data['lokasi_before'] = $this->input->post('kd_lokasi');
		$data['lokasi_after'] = $this->input->post('lokasi_after');
		$data['remark'] = $this->input->post('remark');
		$data['tanggal'] = inggris_date($this->input->post('tgl'));
		$send = $this->moveaset_model->savedata($data);
		if ($send == TRUE) {
			die("sukses");
		} else {
			die("Gagal Simpan Data");
		}
	}

}

/* End of file moveaset.php */
/* Location: ./application/controllers/moveaset.php */