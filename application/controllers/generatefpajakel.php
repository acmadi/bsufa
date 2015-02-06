<?php
class generatefpajakel extends DBController{
	function __construct(){
		parent::__construct('generatefpajakel_model');

		$this->template_dir = 'tax/generatefpajakel';
		$this->default_limit = 30;
		$session_id = $this->UserLogin->isLogin();
		$this->user = $session_id['id'];
		
	}


	protected function setup_form($data=false){
		$this->parameters['pt'] = $this->db->query("select * from pt")->result();
	}

	function get_json(){
		$this->set_custom_function('trx_amount','currency');
		$this->set_custom_function('tax_amount','currency');
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
		
		
		
		$this->set_grid_column('id_invoice','ID',array('width'=>30,'hidden'=>true));
		$this->set_grid_column('no_fakturpajak','NO Faktur Pajak',array('width'=>30,'align'=>'center'));
		$this->set_grid_column('date_fakturpajak','Tanggal Faktur Pajak',array('width'=>30,'align'=>'center'));
		$this->set_grid_column('no_invoice','NO INV',array('width'=>30,'align'=>'center'));
		$this->set_grid_column('customer_nama','Nama Customer',array('width'=>30,'align'=>'left'));
		#$this->set_grid_column('npwp','NPWP',array('width'=>30,'align'=>'left'));
		$this->set_grid_column('trx_amount','DPP',array('width'=>30,'align'=>'left'));
		$this->set_grid_column('tax_amount','PPN',array('width'=>30,'align'=>'left'));
		$this->set_grid_column('ttd_fakturpajak','TTD',array('width'=>30,'align'=>'left'));
		$this->set_jqgrid_options(array('width'=>1230,'height'=>400,'caption'=>'Faktur Pajak PPN KELUARAN','rownumbers'=>true,'sortname'=>'id_invoice','sortorder'=>'desc'));
	}
	parent::index();
	}
	
	
	function nopaj($id){
		$tex = "select no_invoice from db_invoice where id_invoice = $id";
		$tom['toc'] = $this->db->query($tex)->row();
				
		$ceku = "select * from db_fakturpajak where no_ap = '".$tom['toc']->no_invoice."'";		
		$cek = $this->db->query($ceku)->row();
			//var_dump($cek);exit;
		
			if(@$cek->no_ap == @$tom['toc']->no_invoice){
			echo "<script type='text/javascript'>
				alert('Sudah diisi Nomor Pajak nya..');
				refreshTable();
				</script>";
			}else{
			$te = "select * from db_invoice where id_invoice = $id";
			$tom['to'] = $this->db->query($te)->row();
		
			$this->load->view('tax/generatefpajak-kel',$tom);
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
				'tipe' => 'A',
				'ttd_fakturpajak' => $ttd
				);
		
			$this->db->insert('db_fakturpajak',$data);
			
			echo "<script type='text/javascript'>
				alert('Save Success..');
		history.go(-2).reload(true);
				</script>";	
		}		
			
	
	function printfpaj($id){
		$qu = "select no_invoice from db_invoice where id_invoice = $id";
		$data['noap'] = $this->db->query($qu)->row();
		
		$q = "
			SELECT  id_invoice, nm_project, no_fakturpajak,db_customer.customer_nama,db_customer.customer_alamat1, db_invoice.description,
			date_fakturpajak,nilai_fakturpajak, ttd_fakturpajak, db_invoice.id_subproject, no_invoice, trx_amount, tax_amount, customer_nama
			FROM db_invoice
			LEFT JOIN db_loo_sewa ON db_loo_sewa.kd_tenant = db_invoice.kd_tenant
			LEFT JOIN db_customer ON db_customer.customer_id = db_loo_sewa.id_customer
			LEFT JOIN project ON db_invoice.id_subproject = project.kd_project
			LEFT JOIN db_fakturpajak ON no_ap = no_invoice
			WHERE db_invoice.no_invoice  ='".$data['noap']->no_invoice."'";
		$data['dat'] = $this->db->query($q)->row();
		
		
		$this->load->view('tax/print/tax_reportk', $data);
	}
	
	/*
	function faktur_view($tgl1,$tgl2){
		$this->parameters['start'] = inggris_date($tgl1);
		$this->parameters['end']   = inggris_date($tgl2);

		$this->parameters['grid_data'] = json_encode($this->grid_options);
			#var_dump($this->parameters['grid_data']);
		$this->set_grid_column('id_dailycash','ID',array('width'=>30,'hidden'=>true));
		$this->set_grid_column('bank_nm','Kind Of Bank Account',array('width'=>30,'align'=>'center'));
		$this->set_grid_column('bank_acc','Account Number',array('width'=>30,'align'=>'left'));
		$this->set_grid_column('begining','Beginning Balance',array('width'=>30,'align'=>'right'));
		$this->set_grid_column('debet','Debit',array('width'=>30,'align'=>'right'));
		$this->set_grid_column('credit','Credit',array('width'=>30,'align'=>'right'));
		$this->set_grid_column('ending','Ending Balance',array('width'=>30,'align'=>'right'));
		$this->set_grid_column('remark','Remark',array('width'=>30,'align'=>'center'));
		$this->set_jqgrid_options(array('width'=>1230,'height'=>400,'caption'=>'Daily Cash By Account','rownumbers'=>true,'sortname'=>'id_dailycash','sortorder'=>'desc'));
			
		
			#Tambahan Menu Header
			
			$var = $this->initModule();
			if($var) $this->parameters = array_merge($this->parameters,$var);
			$session_id = $this->UserLogin->isLogin();			
			$this->parameters['session_id'] =  $session_id['username'];
			$this->parameters['site_id'] =  $this->UserLogin->getSitesID();
			$this->parameters['pageCaption'] = $this->pageCaption;			
			##Akhir
		
		$this->load_view('viewfaktur',$this->parameters);
	
	}
	*/
	
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

