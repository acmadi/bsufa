<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autocompleted extends Controller {

	function __construct()
	{
		parent::__construct();
		$session_id = $this->UserLogin->isLogin();
		$this->user = $session_id['username'];
	}

	function get_project_pt()
	{
		$term = $this->input->post('term');
		$idpt = $this->input->post('idpt');
		$Qry  = "SELECT distinct subproject_id,nm_subproject FROM db_subproject WHERE id_pt = ".$idpt." and nm_subproject like '%".$term."%' and pt_id !='' ORDER BY nm_subproject ASC";
		$Sql  = $this->db->query($Qry)->result();
		
		foreach ($Sql as $r){
			$r->value  = $r->nm_subproject;
			$r->id	   = $r->subproject_id;
			$row_set[] = $r; 		
		}

		echo json_encode($row_set);	
	}

	function get_bank()
	{
		$term = $this->input->post('term');
		$idpro = $this->input->post('idpro');
		$Qry  = "SELECT distinct namabank,bank_id,nomorrek FROM bank WHERE kd_project = ".$idpro." and (namabank like '%".$term."%' or nomorrek like '%".$term."%') ORDER BY namabank ASC";
		$Sql  = $this->db->query($Qry)->result();
		
		foreach ($Sql as $r){
			$r->value  = $r->namabank." - ".$r->nomorrek;
			$r->id	   = $r->bank_id;
			$row_set[] = $r; 		
		}

		echo json_encode($row_set);
	}

	function get_coa_ptcash(){
			$session_id = $this->UserLogin->isLogin();
			$this->pt	= $session_id['id_pt'];
			$term = $this->input->post('term');
			$Qry  = "SELECT acc_no,acc_name FROM db_coa WHERE acc_no LIKE '".$term."%' or acc_name LIKE '".$term."%' and id_pt = ".$this->pt." ORDER BY id_coa";
			$Sql  = $this->db->query($Qry)->result();
			
			if (count($Sql) > 0) {
				foreach ($Sql as $r){
					$r->value  = $r->acc_no;
					$r->id	   = $r->acc_name;
					$row_set[] = $r; 		
				}
			} else {
				$r->value  = "Tidak Ada COA";
				$r->id	   = "Tidak Ada COA";
				$row_set[] = $r; 
			}

			echo json_encode($row_set);
		}

}

/* End of file autocompleted.php */
/* Location: ./application/controllers/autocompleted.php */