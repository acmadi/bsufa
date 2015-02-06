<?php
	class Budgetalocation extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('budgetalocation_model');
			$this->set_page_title('BUDGET ALOCATION');
			$this->default_limit = 30;
			$this->template_dir = 'accounting/budgetalocation';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
		}
		
		
		function get_json(){
			//$this->set_custom_function('trx_amt','currency');
			parent::get_json();
		}
		
		function index(){
			
			#die("test");
			//$this->budgetalocation_model->index();
			$this->set_grid_column('kd_project','ID',array('hidden'=>true));
			$this->set_grid_column('kd_project','Kode Project',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('nm_project','Nama Project',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_grid_column('alokasi_persen','Persen (%)',array('width'=>200, 'formatter' => 'cellColumn'));
			$this->set_jqgrid_options(array('width'=>1000,'height'=>350,'caption'=>'BUDGED','rownumbers'=>true,'sortname'=>'kd_project','sortorder'=>'DESC'));
			parent::index();		
		}
		
		function set_alokasi(){
			$url= $this->input->post('url');
			$kp = $this->input->post('kodeproject');
			$pp = $this->input->post('persen');
			$this->db->query('SET IDENTITY_INSERT db_alokasibgt OFF');
			$this->db->query("insert into db_alokasibgt (id_subproject,alokasi_persen) values ('$kp','$pp')");
			redirect('accounting/budgetalocation');
		}
		
		function view_add($id){
			$sql = $this->db->query("select a.* from project a where a.kd_project = '$id'")->row();
			$data['nm_project'] = $sql->nm_project;
			$data['alokasi_persen'] = $sql->alokasi_persen;
			$data['kd_project'] = $sql->kd_project;
			$this->load->view('accounting/budgetalocation-input',$data);			
		}
		
		function show_project($id){
			$this->db->query("update project set is_show = '0'");
			$this->db->query("update project set is_show = '1' where kd_project like '".$id."%' and judul = 'N'");
			//redirect('budgetalocation');
		}
		
		function save_persen(){
		$jml = $this->db->query("select sum(project.alokasi_persen) as total from project
		where project.kd_project like '11%' and project.judul = 'N' ")->row()->total;
		$kode = $this->input->post('kd_project');
		$nama = $this->input->post('nm_project');
		$alok = $this->input->post('alokasi_persen');
		//die($alok);
		//die($kode." ".$nama." ".$alok);
		if((int)$alok+(int)$jml<=100){
		$this->db->query("update project set alokasi_persen = '$alok' where kd_project='$kode'");
		echo "<script>alert('Berhasil');
		document.location.href='".base_url()."budgetalocation';
		</script>";
		}else{
		echo "<script>alert('Gagal');
		document.location.href='".base_url()."budgetalocation';
		</script>";
		}
		}
	}
?>
