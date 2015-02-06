<?php
Class tblkarycuti extends DBController{
	function __construct(){
		parent::__construct('tblkarycuti_model');
		$this->set_page_title('Cuti Karyawan');
		$this->default_limit = 15;
		$this->template_dir = 'hrd/tblkarycuti';
	}

	protected function setup_form($data=false){
			$this->load->model('tblkarycuti_model','cutikary');
			$session_id = $this->UserLogin->isLogin();
			$divisi = $session_id['divisi_id'];
			$id = @$data->karycuti_id;
			$idkary = @$data->kary_id;
			$this->parameters['karycuti'] = $this->cutikary->namadiv($divisi);
			$this->parameters['joinall'] = $this->cutikary->joinall_table($id);
			$this->parameters['jmlcuti'] = $this->cutikary->jumlah_cuti($idkary);
			$this->parameters['flowapp'] = $this->cutikary->flowapp();
			$this->parameters['view'] = $this->mstmodel->viewkary($id);
			
			//var_dump($this->parameters['view']);
			
	}

	function index(){
		$this->set_grid_column('karycuti_id','ID',array('hidden'=>true));
		$this->set_grid_column('nama','Nama',array('width'=>175));
		$this->set_grid_column('divisi_nm','Divisi',array('width'=>150));
		$this->set_grid_column('tgl_aju','Tanggal',array('width'=>100,'align'=>'center'));
		$this->set_grid_column('aju_cuti','Jumlah Cuti',array('width'=>100,'align'=>'center'));
		$this->set_grid_column('karycutijns_nm','Jenis Cuti',array('width'=>100,'align'=>'center'));
		$this->set_grid_column('flowapp_nm','Status Approval',array('width'=>200));
		$this->set_jqgrid_options(array('width'=>900,'height'=>200,'caption'=>'Cuti Karyawan','rownumbers'=>true));
		parent::index();

	}
	
	function data($id){
		$data = $this->db->join('db_divisi','divisi_id = id_divisi')
					    ->join('db_karyjab','karyjab_id = id_karyjab')
						->join('db_karycutipar','db_karycutipar.id_kary = db_kary.id_kary')
						->where('db_kary.id_kary',$id)
						->get('db_kary')
						->row_array();					
		
		
		
		
		echo json_encode($data);
		
		}	
		
	 function cek_tanggal($tgl1,$tgl2,$tgl3,$tgl4)	{
	  list($d1,$m1,$y1) = split("-",$tgl1);
	  list($d2,$m2,$y2) = split("-",$tgl2);
	  list($d3,$m3,$y3) = split("-",$tgl3);
	  list($d4,$m4,$y4) = split("-",$tgl4);
	  $tgl1 = $y1."-".$m1."-".$d1;
	  $tgl2 = $y2."-".$m2."-".$d2;
	  $tgl3 = $y3."-".$m3."-".$d3;
	  $tgl4 = $y4."-".$m4."-".$d4;
	  $jml  = (strtotime($tgl2) - strtotime($tgl1))/86400;
	  $jml1 = (strtotime($tgl3) - strtotime($tgl2))/86400;
	  $jml2 = (strtotime($tgl4) - strtotime($tgl3))/86400;
	  //$jml3 = (strtotime($tgl4) - strtotime($tgl2))/86400;
	  $data = array
	  (
		'jml'=>$jml,
		'jml1'=>$jml1,
		'jml2'=>$jml2
		//'jml3'=>$jml3
	  );
	  echo json_encode($data);
	  
	}	
	
	function cuti_istimewa($id){
		$data = $this->db->join('db_karycutials','id_karycutials = karycutials_id')
						->where('kary_id',$id)
						->get('db_karycuti')
						->row_array();	
	echo json_encode($data);
	}
	
	function istimewa($id){
		$data = $this->db->where('karycutials_id',$id)
						->get('db_karycutials')
						->row_array();	
	echo json_encode($data);
	}
	
	
		
   function hitung($id){
	   $dt = $this->db->select('sum(aju_cuti) as jml')
					  ->where('kary_id',$id)
					  ->where('flowapp_id','10')
					  ->get('db_karycuti')
					  ->row_array();
	   if($dt['jml']==NULL)
		$jml = 0;
	   else
	    $jml = $dt['jml'];
	   
	   $data = array
	   (
			'jml' => $jml
	   );
	   
	   echo json_encode($data);
   }
 
 
		function loaddata(){
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				switch($data_type){
					case 'karycutials':
						$sql = $this->db->select('karycutials_id id,karycutials_nm nama')
										->where('id_karycutijns',$parent_id)
										->order_by('karycutials_nm','asc')
										->get('db_karycutials')
										->result();
						break;
					case 'karycutijns':
					default:
					    $sql = $this->db->select('karycutijns_id id,karycutijns_nm nama')
										->get('db_karycutijns')->result();
							
				}
				$response = array();
				if($sql){
					foreach($sql as $row){
						$response[] = $row;
					}
				}
				die(json_encode($response));
			}
		}  
  
  function insert_cuti(){
	$this->load->Model('tblkarycuti_model','cuti');
	$session_id = $this->UserLogin->isLogin();
	$divisi_id = $session_id['divisi_id'];
	$user_id = $session_id['id'];
	$class = $session_id['class'];
    $pt = $session_id['id_pt'];
	$level = $session_id['level_id'];
	$modul = '1';
			
			
			
	$dtapprove = $this->cuti->approv_id();
	$idapprove = $dtapprove['no_link'] + 1;		
	extract(PopulateForm());
	
	
	if($lama_cuti > 0) $jmlcuti = $lama_cuti;
	else $jmlcuti = $aju_cuti;
	
	if ($id_karylvl > 3){
		$id_karylvl = 3;}
	
	elseif ($id_karylvl == 3){
		$id_karylvl = 2;}
	elseif($id_karylvl == 10){
		$id_karylvl = 1;}
	elseif ($id_karylvl == 2){
		$id_karylvl = 1;}
	
	elseif ($id_karylvl == 1){
	$id_karylvl = 0;}	
	$data = array
	(							
		'tgl_aju'=>	$tgl_aju,
		'jns_cuti'=> $jns_cuti,
		'id_karycutials'=>$this->input->post('cuti_kat'),
		'kary_id'=>$nip,
		'aju_cuti'=>$jmlcuti,
		'startdate_cuti'=>$tgl_mulai, 
		'enddate_cuti'=>$tgl_akhir,
	    'tgl_msk'=>$tgl_msk,
		'pic_delegasi'=>$delegasi,
		'ket_cuti'=>$ket, 
		'jns_cuti'=>$jns_cuti,
		//'id_pt'=>$pt,
		//'user_id'=>$user_id,
		//'id_divisi'=>$id_div,
		//'level_id'=>$level,
		'flowapp_id'=>$id_karylvl,
		'modul_id'=>$modul,
		'transaksi_id'=> $idapprove,
									
	);
	
	$data2 = array
	(
		'modul_id' => $modul,
		'tgl_aju' => $tgl_mulai,
		'kary_id' => $nip,
		'pt_id' => $pt,
		'id_approval' => $id_karylvl,
		'no_link' => $idapprove
	);
					
	$this->db->insert('db_karycuti',$data);
	$this->db->insert('db_approval',$data2);
	redirect('tblkarycuti');
					 
					
  }	   

   
}
