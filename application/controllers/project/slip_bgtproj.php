<?
Class slip_bgtproj Extends controller{
	
	function __construct(){
		parent::controller();
		$session_id = $this->UserLogin->isLogin();
		$this->user = $session_id['username'];
		$this->pt = $session_id['id_pt'];
		$this->id = $session_id['id'];		
	}
		
	function index(){		
		extract(PopulateForm());
		$blc = replace_numeric($blc);
		$amount = replace_numeric($amount);
		$blc = replace_numeric($blc);
		$blc = $blc - $amount;
		list($d,$m,$y) = split("-",$tgl);
		$tanggal = $y."-".$m."-".$d;
		
		
		//Cek Gabungan Kawasan
		$cekgab = $this->db->select('isnull(id_gabungan,0) as id_gab,nm_ssubbgtproj,nm_scost')
						   ->join('db_costproj','id_scostproj = id_sbgtproj')
						   ->join('db_ssubbgtproj b','a.id_ssubbgtproj = b.id_ssubbgtproj')
						   ->where('kode_bgtproj',$bgt)
						   ->get('db_bgtproj_update a')->row();
		
		//Cek Struktur
		$gabungan = $cekgab->id_gab;
		$struktur = $cekgab->nm_scost;
		$substruk = $cekgab->nm_ssubbgtproj;
		//Cek nama pt
		$dt_pt = $this->db->where('id_pt',$this->pt)
						  ->get('pt')->row();
		$nama_pt = $dt_pt->nm_pt;
		
		//Budget  YTD
		$cekbgtuse = $this->db->select_sum('nilai_proposed')
							  ->where('kd_bgtproj',$bgt)
							  ->get('db_trbgtproj')->row();
							 // var_dump($cekbgtuse);exit;
		@$nilai_proposed = $cekbgtuse->nilai_proposed;					  
		if(@$nilai_proposed == NULL) $nilai_proposed = $amount;
		else $nilai_proposed = $nilai_proposed + $amount;
		
		//var_dump($nilai_proposed);exit;
							  
		$ytotbgt = replace_numeric($totbgt);
		$usebgt = $nilai_proposed;
		$yblcbgt = $ytotbgt - $usebgt;

		
		
		
		//Cek sisa budget tahunan
		$data['cekdata'] = array 
		(
			'kd_bgtproj' => $bgt,
			'descbgt'	=> $desc,
			'tgl_proposed' => $tgl,
			'amount' => number_format($amount),
			'blc'	=> $blc,
			'remark' => $remark,
			'tgl_aju' => $tgl,
			'id_subproject' => $project_id,
			'blc' => number_format($blc),
			'totbgt' => $totbgt,
			'ytotbgt' => number_format($ytotbgt),
			'yblcbgt' => number_format($yblcbgt),
			'usebgt' => number_format($usebgt),
			'id_pt' => $this->pt,
			'nama_pt' => $nama_pt,
			'Struk' => $struktur,
			'substruk' => $substruk
		);
		
		if($bgt==""){
			echo"
				<script type='text/javascript'>
					alert('Hasil Print Error, Cek kembali pengajuan budget');
					window.close();
				</script>
			";
			exit;
			
		}elseif($amount < 0){
			$data['status'] = "On Budget";	
			$this->load->view('project/print/slip_budget_besar',$data);
		}elseif($gabungan==1){
			$data['status'] = "On Budget";
			$this->db->query("sp_Insbgtproj '".$bgt."','".$tanggal."',".$amount.",'".$remark."',".$project_id.",".$this->pt."");
			$scekdata = $this->db->select('no_trbgtproj as no')
								 ->order_by('id_trbgtproj','DESC')
								 ->get('db_trbgtproj')->row();
			$data['cekkode'] = $scekdata->no;
			$this->load->view("project/print/slip_budget_gabungan",$data);
	    }else{
			
			$simpandata = array
			(
				'kd_bgtproj' => $bgt,
				'no_trbgtproj' => 'XXX',
				'tgl_proposed' => $tanggal,
				'nilai_proposed' => $amount,
				'remark1' => $remark,
				'id_subproject' => $project_id,
				'id_pt' =>$this->pt,
				'id_flag' => 1
			);
			$data['status'] = "On Budget";
			$this->db->query("sp_Insbgtproj '".$bgt."','".$tanggal."',".$amount.",'".$remark."',".$project_id.",".$this->pt."");
			$scekdata = $this->db->select('no_trbgtproj as no')
								 ->order_by('id_trbgtproj','DESC')
								 ->get('db_trbgtproj')->row();
			$data['cekkode'] = $scekdata->no;
			$this->load->view("project/print/slip_budget_kecil",$data);
		}
	}
}

