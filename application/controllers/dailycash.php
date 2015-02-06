<?php
class dailycash extends DBController{
	function __construct(){
		parent::__construct('dailycash_model');
		$this->set_page_title('Daily Cash');
		$this->template_dir = 'cb/dailycash';
		$this->default_limit = 10;
		$session_id = $this->UserLogin->isLogin();
		$this->user = $session_id['id'];
		$this->load->model('dailycash_model');

	}


	protected function setup_form($data=false){
		$this->parameters['pt'] = $this->db->query("select * from pt")->result();
		
	}

	function get_json(){
		$this->set_custom_function('tgl','indo_date');
		$this->set_custom_function('debet','currency');
		$this->set_custom_function('credit','currency');
		parent::get_json();
	}

	function index(){

		$session_id = $this->UserLogin->isLogin();

		$this->parameters['pt'] = $this->db->query("select * from pt")->result();

		$this->parameters['proj'] = $this->db->query("select * from db_subproject where id_pt = ".$session_id['id_pt']." ")->result();

		$this->parameters['strPost']		= 0;

		//clear session
		$this->session->set_userdata('sesspt', '');
		$this->session->set_userdata('sessproject', '');
		$this->session->set_userdata('sessbank', '');
			
		if($this->input->post('submit') == TRUE ) {
			$this->parameters['strPost']		= 1;

			//set session
			$this->session->set_userdata('sesspt', $this->input->post('pt'));
			$this->session->set_userdata('sessproject', $this->input->post('project'));
			$this->session->set_userdata('sessbank', $this->input->post('bank'));

			$this->parameters['ptsess'] = $session_id['id_pt'];
			$this->parameters['projeksess'] = $this->db->query("select * from db_subproject where subproject_id = ".$this->session->userdata('sessproject')."")->row();
			$this->parameters['banksess'] = $this->db->query("select * from bank where bank_id = ".$this->session->userdata('sessbank')."")->row();
			$this->parameters['cashsess'] = $this->db->query("select end_amount from db_dailycash where bank_id = ".$this->session->userdata('sessbank')." and id_pt = ".$this->session->userdata('sesspt')." and id_project = ".$this->session->userdata('sessproject')."")->row();

			$this->set_grid_column('id_dailycashdet','ID',array('width'=>30,'hidden'=>true));
			$this->set_grid_column('nm_pt','Nama PT',array('width'=>30,'align'=>'left'));
			$this->set_grid_column('nm_subproject','Proyek',array('width'=>40,'align'=>'left'));
			$this->set_grid_column('namabank','Bank',array('width'=>40,'align'=>'left'));
			$this->set_grid_column('debet','Debet',array('width'=>30,'align'=>'right'));
			$this->set_grid_column('credit','Kredit',array('width'=>30,'align'=>'right'));
			$this->set_grid_column('tgl','Tanggal',array('width'=>30,'align'=>'right'));
			$this->set_grid_column('remark','Keterangan',array('width'=>30,'align'=>'center'));
			$this->set_jqgrid_options(array('width'=>1230,'height'=>400,'caption'=>'Daily Cash By Project','rownumbers'=>true,'sortname'=>'id_dailycashdet','sortorder'=>'desc'));
		}
		parent::index();
	}

	function add(){
		$cashsess = $this->db->query("select end_amount from db_dailycash where bank_id = ".$this->session->userdata('sessbank')." and id_pt = ".$this->session->userdata('sesspt')." and id_project = ".$this->session->userdata('sessproject')."")->row();
		if ($cashsess != null) {
			$this->parameters['ptsess'] = $this->db->query("select * from pt where id_pt = ".$this->session->userdata('sesspt')."")->row();
			$this->parameters['projeksess'] = $this->db->query("select * from db_subproject where subproject_id = ".$this->session->userdata('sessproject')."")->row();
			$this->parameters['banksess'] = $this->db->query("select * from bank where bank_id = ".$this->session->userdata('sessbank')."")->row();
			$this->parameters['cashsess'] = $this->db->query("select end_amount from db_dailycash where bank_id = ".$this->session->userdata('sessbank')." and id_pt = ".$this->session->userdata('sesspt')." and id_project = ".$this->session->userdata('sessproject')."")->row();
			parent::add();
		} else { 
			echo "<script type='text/javascript'>
				alert('Belum Ada Nilai Saldo Awal');
				refreshTable();
			</script>";
		} 
	}
	
	function detail($id)
	{
		$cek = $this->db->query('select bank_id from view_daily where id_dailycashdet = '.$id.'')->row();
		$data['hasil'] = $this->db->query("select * from view_daily where bank_id = ".$cek->bank_id." and year(begin_date) = '".date('Y')."' and month(begin_date) = '".date('m')."' and day(begin_date) = '".date('d')."' ")->result();
		$this->load->view('cb/dailycash-form', $data);
	}
	
	function savecash(){
		$pt = $this->input->post('pt');
		$project = $this->input->post('project');
		$bank = $this->input->post('bank');
		$idcash = $this->db->query("select id_dailycash from db_dailycash where id_project = ".$project." and id_pt = ".$pt." and bank_id = ".$bank." ")->row();

		$data['id_dailycash'] = $idcash->id_dailycash;
		$data['tgl'] = date('Y-m-d H:i');
		$data['flag_hapus'] = 0;
		$data['remark'] = $this->input->post('remark');
		$data['debet'] = replace_numeric($this->input->post('debet'));
		$data['credit'] = replace_numeric($this->input->post('credit'));
		$this->dailycash_model->insertcash($data);
		$this->db->query("update db_dailycash set end_amount = end_amount + ".$data['debet']." - ".$data['credit']." where id_dailycash = ".$idcash->id_dailycash." ");
		echo "<script type='text/javascript'>
				alert('Berhasil');
				history.go(-1).reload(true);
				refreshTable();
			</script>";
	}

	function editcash($id){
		$idcash = $this->input->post('idcash');
		$cekcash = $this->db->query("select end_amount,bank_id from db_dailycash where id_dailycash = ".$idcash." ")->row();
		$cekdet = $this->db->query("select debet,credit from db_dailycashdet where id_dailycashdet = ".$id." ")->row();
		$data['tgl'] = date('Y-m-d H:i');
		$data['remark'] = $this->input->post('remark');
		$data['debet'] = replace_numeric($this->input->post('debet'));
		$data['credit'] = replace_numeric($this->input->post('credit'));
		$this->dailycash_model->updatecash($id,$data);
		$this->db->query("update db_dailycash set end_amount = ".$cekcash->end_amount." + ".$data['debet']." - ".$data['credit']." - ".$cekdet->debet." + ".$cekdet->credit." where id_dailycash = ".$idcash."");
		echo "<script type='text/javascript'>
				alert('Berhasil');
				history.go(-1).reload(true);
				refreshTable();
			</script>";
	}

	function deletecash($id){
		$this->dailycash_model->deletemcash($id);
		echo "<script type='text/javascript'>
				alert('Berhasil');
				refreshTable();
			</script>";		
	}

	function reportdata(){
		$session_id = $this->UserLogin->isLogin();
		if (($this->input->post('project') == '')) {
			$data['tanggal'] = $this->input->post('date');
			$this->load->view('cb/print/report_daily',$data);
		} elseif (($this->input->post('bank') == '') and ($this->input->post('project') == '')) {
			$data['tanggal'] = inggris_date($this->input->post('date'));
			$data['idpt'] = $session_id['id_pt'];
			$data['bankid'] = 0;
			$data['projekid'] = 0;
			$this->load->view('cb/print/report_daily_detail',$data);
		} else {
			$data['tanggal'] = inggris_date($this->input->post('date'));
			$data['idpt'] = $session_id['id_pt'];
			$data['bankid'] = $this->input->post('bank');
			$data['projekid'] = $this->input->post('project');
			$this->load->view('cb/print/report_daily_detail',$data);
		}
	}
}

