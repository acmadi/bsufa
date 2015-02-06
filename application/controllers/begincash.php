<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Begincash extends DBController {

	function __construct()
	{
		parent::__construct('begincash_model');
		$this->template_dir = 'cb/begincash';
		$this->default_limit = 10;
		$this->load->model('begincash_model');
	}

	function get_json()
	{
		$this->set_custom_function('begin_amount','currency');
		$this->set_custom_function('end_amount','currency');
		$this->set_custom_function('begin_date','indo_date');
		parent::get_json();
	}

	function index()
	{	

		$this->set_grid_column('id_dailycash','ID',array('width'=>30,'hidden'=>true));
		$this->set_grid_column('nm_pt','Nama PT',array('width'=>30,'align'=>'left'));
		$this->set_grid_column('nm_subproject','Proyek',array('width'=>40,'align'=>'left'));
		$this->set_grid_column('namabank','Bank',array('width'=>40,'align'=>'left'));
		//$this->set_grid_column('nomorrek','Account Number',array('width'=>30,'align'=>'left'));
		$this->set_grid_column('begin_date','Tanggal Transaksi',array('width'=>20,'align'=>'center'));
		$this->set_grid_column('begin_amount','Saldo Awal',array('width'=>30,'align'=>'right'));
		$this->set_grid_column('end_amount','Saldo Saat Ini',array('width'=>30,'align'=>'right'));
		$this->set_jqgrid_options(array('width'=>1230,'height'=>400,'caption'=>'Daily Cash','rownumbers'=>true,'sortname'=>'id_dailycash','sortorder'=>'desc'));
		parent::index();
	}

	function add(){
		$session_id = $this->UserLogin->isLogin();
		$this->parameters['pt'] = $this->db->query("select * from pt")->result();
		$this->parameters['proj'] = $this->db->query("select * from db_subproject where id_pt = ".$session_id['id_pt']." ")->result();
		parent::add();
	}

	function get_bank($id)
	{
		$tmp = '';
		if($id){
			$Q = "select * from bank where kd_project = ".$id." and namabank NOT LIKE '%transit%'";
			$data = $this->db->query($Q)->result_array();
		}else{
			$tmp .= "<option value=''> Pilih Bank </option>";
			die($tmp);
		}
		
		if (!empty($data)) {
			$tmp .= "<option value=''> Pilih Bank </option>";
			foreach ($data as $row) {
				$tmp .= "<option value='" . $row['bank_id'] . "'>" . $row['namabank'] . " - " . $row['nomorrek'] . "</option>";
			}
		} else {
			$tmp .= "<option value=''> Pilih Bank </option>";
		}
		die($tmp);
	}

	function saveheader()
	{
		$session_id = $this->UserLogin->isLogin();
		$data['begin_date'] = date('Y-m-d H:i:s');
		$data['id_pt'] = $session_id['id_pt'];
		$data['id_project'] = $this->input->post('project');
		$data['bank_id'] = $this->input->post('bank');
		$data['begin_amount'] = replace_numeric($this->input->post('begin'));
		$data['end_amount'] = replace_numeric($this->input->post('begin'));
		$cek = $this->db->query("select * from db_dailycash where id_pt = ".$data['id_pt']." and id_project = ".$data['id_project']." and bank_id = ".$data['bank_id']." ")->result();
		if ($cek == TRUE) {
			die("Nilai Beginning Sudah Ada");
		} else {
			$this->begincash_model->savedata($data);
			$sukses = 4;
			die(json_encode($sukses));
		}
		//echo "<script type='text/javascript'>alert('save success');window.location.href='".site_url()."cb/begincash';</script>";
	}

	function update($id)
	{
		$this->parameters['pt'] = $this->db->query("select * from pt")->result();
		parent::update($id);
	}

	function updateheader($id)
	{
		$data['begin_date'] = date('Y-m-d H:i:s');
		$data['id_pt'] = $this->input->post('pt');
		$data['id_project'] = $this->input->post('project');
		$data['bank_id'] = $this->input->post('bank');
		$data['begin_amount'] = replace_numeric($this->input->post('begin'));
		$data['end_amount'] = replace_numeric($this->input->post('begin'));
		$this->begincash_model->updatedata($id,$data);
		echo "<script type='text/javascript'>alert('update success');window.location.href='".site_url()."cb/begincash';</script>";
	}

	function deletebegin($idcash)
	{
		$pecah = explode('&', $idcash);
		$this->begincash_model->deletedata($pecah[0]);
		echo "<script>
			alert('Sukses');
			refreshTable();
		</script>";
	}

}

/* End of file begincash.php */
/* Location: ./application/controllers/begincash.php */