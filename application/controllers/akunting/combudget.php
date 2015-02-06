<?php
Class combudget extends AdminPage{
	function __construct(){
		parent::AdminPage();
		$this->load->Model('mstbudget_model','budget');
	}
	
	function index(){
		#$this->load->Model('mstbudget_model','budget');
		$data['project'] = $this->budget->getparent();
		$data['divisi'] = $this->budget->get_divisi();
		$this->parameters['data'] = $data;
		$this->loadTemplate('mis/combudget_view');
	}
	
	function search(){
		if($this->input->post('submit')){
			$acc = $this->input->post('nmacc');
		}
		    $acc = $this->input->post('nmacc');
		    $data['acc'] = $this->budget->getacc($acc);
			$this->parameters['data'] = $data;
			$this->loadTemplate('mis/search_view');	
	}
	
	function hitung($code,$tgl){
		$session_id = $this->UserLogin->isLogin();
		$pt = $session_id['id_pt'];
		$thn = substr($tgl,6,4);
		$bln = substr($tgl,3,2);
		//Annual Budget
		$dtann = $this->budget->bgtann($code,$pt,$thn);
		$dtblc = $this->budget->bgtactann($code,$pt,$thn);						  
		$annact = $dtblc['total']; 
		$annual = $dtann['tot_mst'];
		$blcann = $annual - $annact;
				
		//YTD
		$strarr = array("","bgt1","bgt2","bgt3","bgt4","bgt5","bgt6","bgt7","bgt8","bgt9","bgt10","bgt11","bgt12");
		$dtactytd = $this->budget->bgtactytd($code,$pt,$thn);
		$actytd = $dtactytd['total']*1;
		$total=0;
		for($i=1;$i<=$bln;$i++){
			$n = $strarr[$i];
			$jml = $this->db->select($n)
						    ->where('code',$code)
						    ->where('thn',$thn)
						    ->get('db_mstbgt')->row_array();
			$hsl = $jml[$n];
			$total = $total + $hsl;
		}
		$blcytd = $total - $actytd;

		$data = array
		(
			'A' => $annual,
			'B' => $blcann,
			'C' => $total,
			'D' => $blcytd,
			'E' => $actytd
		);
		
		echo json_encode($data);
		
	}
		
}
