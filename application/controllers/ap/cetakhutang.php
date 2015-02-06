<?php defined('BASEPATH') or die('Access Denied');

class cetakhutang extends AdminPage{

	function cetakhutang(){
		parent::AdminPage();
		$this->pageCaption = 'User Page';
	}

	function index(){
		$data['project'] = $this->db->query("select * from project where judul = 'Y' and kd_project like '%11%'")->result();
		$this->parameters=$data;
		$this->loadTemplate('ap/cetakhutang_view',$data);
	}

	function cetakhtg(){
		extract(PopulateForm());
		$data['awal'] = $this->input->post('awal');
		$data['akhir'] = $this->input->post('akhir');
		$data['console'] = $this->input->post('console');
		$data['project'] = $this->input->post('project');
		$data['vendor'] = $this->input->post('vendor');
		//var_dump($data['project']);exit();
		$data['ven'] = $this->db->query("select nm_supplier from pemasok where kd_supp_gb = ".$data['vendor']." and kd_project = ".$data['project']."")->result();
		$data['hutang'] = $this->db->query("select * from db_apledger where project_no = ".$data['project']." and vendor_acct = ".$data['vendor']."")->row();
		if ($data['hutang'] == null) {
			$data['detail'] = 0;
				//continue;
		} else {
			if ($data['awal'] == '') {
				$data['detail'] = $this->db->query("select * from db_apinvoice where trx_amt-base_amt != 0 and vendor_acct = '".$data['hutang']->vendor_acct."' and project_no = '".$data['hutang']->project_no."' and doc_no = '".$data['hutang']->doc_no."' ")->result();
			} else {
				$data['detail'] = $this->db->query("select * from db_apinvoice where trx_amt-base_amt != 0 and vendor_acct = '".$data['hutang']->vendor_acct."' and project_no = '".$data['hutang']->project_no."' and doc_no = '".$data['hutang']->doc_no."' and due_date <= '".inggris_date($data['awal'])."'")->result();
			}
			
			
		}
		if(@$klik){
			//var_dump($data['project']);exit();
			$this->load->view('ap/print/print_kartuhutang',$data);
			//echo "untuk pdf";
		} else if(@$export) {
			$this->load->view('ap/print/print_kartuhutang_excel',$data);
			//echo "untuk excel";		
		}
	}

	function get_project($id){
		$tmp = '';
        $data = $this->db->query("select kd_project,nm_project from project where kd_project like '%".$id."%' and judul = 'N'")->result_array();
        if (!empty($data)) {
            $tmp .= "<option value='' selected> PILIH PROJECT </option>";
            foreach ($data as $row) {
                $tmp .= "<option value='" . $row['kd_project'] . "'>" . $row['nm_project'] . "</option>";
            }
        } else {
            $tmp .= "<option value='' selected> PILIH PROJECT </option>";
        }
        die($tmp);
	}

	function get_vendor($id){
		$tmp = '';
        $data = $this->db->query("select kd_supplier,kd_supp_gb,nm_supplier from pemasok where kd_project = ".$id."")->result_array();
        if (!empty($data)) {
            $tmp .= "<option value='' selected> PILIH VENDOR </option>";
            foreach ($data as $row) {
                $tmp .= "<option value='" . $row['kd_supplier'] . "'>" . $row['nm_supplier'] . "</option>";
            }
        } else {
            $tmp .= "<option value='' selected> PILIH VENDOR </option>";
        }
        die($tmp);
	}

}