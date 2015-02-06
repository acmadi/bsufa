<?php
class generatefpajak extends DBController{
	function __construct(){
		parent::__construct('generatefpajak_model');

		$this->template_dir = 'tax/generatefpajak';
		$this->default_limit = 30;
		$session_id = $this->UserLogin->isLogin();
		$this->user = $session_id['id'];
		
	}


	protected function setup_form($data=false){
		$this->parameters['pt'] = $this->db->query("select * from pt")->result();
	}

	function get_json(){
		$this->set_custom_function('dpp_ppn','currency');
		$this->set_custom_function('ppn','currency');
		$this->set_custom_function('date_fakturpajak','indo_date');
		parent::get_json();
	}

	function index(){
	
	$this->parameters['pt'] = $this->db->query("select * from pt")->result();
	$this->parameters['projek'] = $this->db->query("select * from db_subproject")->result();
	
	$this->parameters['strPost']		= 0;

	//clear session
	$this->session->set_userdata('sesspt', '');
	$this->session->set_userdata('sessproject', '');
	$this->session->set_userdata('sessstart', '');
	$this->session->set_userdata('sessend', '');
		
	if($this->input->post('submit') == TRUE) {
		$this->parameters['strPost']		= 1;

		//set session
		$this->session->set_userdata('sesspt', $this->input->post('pt'));
		$this->session->set_userdata('sessproject', $this->input->post('subproject'));
		$this->session->set_userdata('sessstart', $this->input->post('startdate'));
		$this->session->set_userdata('sessend', $this->input->post('enddate'));
	

		$this->parameters['ptsess'] = $this->db->query("select * from pt where id_pt = ".$this->input->post('pt')."")->row();
		$this->parameters['projeksess'] = $this->db->query("select * from db_subproject where subproject_id = ".$this->input->post('subproject')."")->row();
		$this->parameters['startdates'] = $this->session->userdata('sessstart');
		$this->parameters['enddates'] = $this->session->userdata('sessend');
		
		
		
		$this->set_grid_column('apinvoice_id','ID',array('width'=>30,'hidden'=>true));
		$this->set_grid_column('no_fakturpajak','NO Faktur Pajak',array('width'=>30,'align'=>'left'));
		$this->set_grid_column('date_fakturpajak','Tanggal Faktur Pajak',array('width'=>30,'align'=>'center'));
		$this->set_grid_column('doc_no','NO AP',array('width'=>30,'align'=>'center'));
		$this->set_grid_column('nm_supplier','Nama Vendor',array('width'=>30,'align'=>'left'));
		$this->set_grid_column('npwp','NPWP',array('width'=>30,'align'=>'left'));
		$this->set_grid_column('dpp_ppn','DPP',array('width'=>25,'align'=>'right'));
		$this->set_grid_column('ppn','PPN',array('width'=>25,'align'=>'right'));
		$this->set_grid_column('ttd_fakturpajak','TTD',array('width'=>30,'align'=>'left'));
		
		$this->set_jqgrid_options(array('width'=>1230,'height'=>400,'caption'=>'Faktur Pajak PPN MASUKAN','rownumbers'=>true,'sortname'=>'apinvoice_id','sortorder'=>'desc'));
	}
	parent::index();
	}
	
	function printfpaj($id){
		$qu = "select doc_no from db_apinvoice where apinvoice_id = $id";
		$data['noap'] = $this->db->query($qu)->row();
		
		$q = "SELECT  apinvoice_id, no_fakturpajak, date_fakturpajak,nilai_fakturpajak, ttd_fakturpajak,kontak, doc_no, nm_supplier,alamat,descs,trx_amt, npwp, dpp_ppn, (dpp_ppn * 10)/100 ppn
				FROM db_apinvoice
				LEFT JOIN db_fakturpajak ON no_ap = doc_no
				LEFT JOIN pemasok ON vendor_acct = kd_supplier
				where doc_no ='".$data['noap']->doc_no."'";
		$data['dat'] = $this->db->query($q)->row();
		
		
		$this->load->view('tax/print/tax_reportm', $data);
	}
	
	
	function nopaj($id){
		$tex = "select apinvoice_id,doc_no,dpp_ppn,(dpp_ppn * 10)/100 as ppn from db_apinvoice where apinvoice_id = $id";
		$tom['toc'] = $this->db->query($tex)->row();
				
		$ceku = "select * from db_fakturpajak where no_ap = '".$tom['toc']->doc_no."'";		
		$cek = $this->db->query($ceku)->row();
			//var_dump($cek);exit;
		
			if(@$cek->no_ap == @$tom['toc']->doc_no){
			echo "<script type='text/javascript'>
				alert('Sudah diisi Nomor Pajak nya..');
				refreshTable();
				</script>";
			}else{
			$te = "select apinvoice_id,doc_no,dpp_ppn,(dpp_ppn * 10)/100 as ppn from db_apinvoice where apinvoice_id = $id";
			$tom['to'] = $this->db->query($te)->row();
		
			$this->load->view('tax/generatefpajak-mas',$tom);
			}
	}
	
	function inpajnom(){
			$nom = $this->input->post('nom');
			$tgd = $this->input->post('tglo');
			$ttd = $this->input->post('ttd');
			$noap = $this->input->post('noap');
			$ppn = $this->input->post('ppn');
		
			
			$data = array(
				'no_ap' => $noap,
				'no_fakturpajak' => $nom,
				'nilai_fakturpajak' => $ppn,
				'date_fakturpajak' => inggris_date($tgd),
				'tipe' => 'B',
				'ttd_fakturpajak' => $ttd
				);
		
			$this->db->insert('db_fakturpajak',$data);
			
			echo "<script type='text/javascript'>
				alert('Save Success..');
		history.go(-2).reload(true);
				</script>";	
		}		
			
	
	
	function savenum(){
				$datadet['star'] = $this->input->post('star');
				$datadet['en'] = $this->input->post('star');
				$datadet['pro'] = $this->input->post('star');
				$datadet['no1'] = $this->input->post('star');
				$datadet['no2'] = $this->input->post('star');
				#die($datadet['startdate']);
				
				$te = "select * from db_apinvoice 
				left join db_fakturpajak on no_ap = db_apinvoice.doc_no
				where dpp_ppn IS NOT NULL and project_no = ".$datadet['pro'].
				" and inv_date BETWEEN ".$datadet['star']."AND ".$datadet['en']." order by apinvoice_id desc";
				
				$tery = $this->db->query($te)->result();
				foreach($tery as $row){	
					
				
				}
				echo "<script type='text/javascript'>
				alert('Pemberian nomor faktur pajak berhasil');
				history.go(-2).reload(true);
				</script>";	
	}
	
	function detail($id){
		$this->db->where('id_dailycash', $id);
		$data['pt'] = $this->db->query("select * from pt")->result();
		$data['data'] = $this->db->get('view_daily')->row();
		$this->load->view('cb/dailycash-form', $data);
	}

	//update change prjek dan bank
	function get_project($id){
		$tmp = '';
        $data = $this->db->query("select distinct id_subproject,nm_subproject from view_daily where id_pt = ".$id."")->result_array();
        if (!empty($data)) {
            $tmp .= "<option value=''> Pilih Project </option>";
            foreach ($data as $row) {
                $tmp .= "<option value='" . $row['id_subproject'] . "'>" . $row['nm_subproject'] . "</option>";
            }
        } else {
            $tmp .= "<option value=''> Pilih Project </option>";
        }
        die($tmp);
	}
	
	function get_bank($id){
		$tmp = '';
        $data = $this->db->query("select distinct bank_id,bank_nm from view_daily where id_subproject = ".$id."")->result_array();
        if (!empty($data)) {
            $tmp .= "<option value=''> Pilih Bank </option>";
            foreach ($data as $row) {
                $tmp .= "<option value='" . $row['bank_id'] . "'>" . $row['bank_nm'] . "</option>";
            }
        } else {
            $tmp .= "<option value=''> Pilih Bank </option>";
        }
        die($tmp);	
	}
	//end update
	
	function deletecash($id){
		$this->dailycash_model->deletemcash($id);
		echo "<script type='text/javascript'>
				alert('Berhasil');
				refreshTable();
			</script>";		
	}

	function nong($id){
		die($id);
	}
	
	function viewb(){
	
	redirect('cb/dailycash');
	}
}

