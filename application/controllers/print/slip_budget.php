<?
Class slip_budget Extends controller{
	
	function __construct(){
				parent::controller();
	}
		
	function index(){		
		extract(PopulateForm());
		
		#Cek session data
        $session_id = $this->UserLogin->isLogin(); 
		#$divisi_id = $session_id['divisi_id'];
		$pt = $session_id['id_pt'];
		$parent = $session_id['id_parent'];


		#Convert to string
		$convert_amount = str_replace(',',"",$amount);
		$convert_bgt_month = str_replace(',',"",$bgt_month);
        $convert_blc_month = str_replace(',',"",$blc_month);
        $convert_blc_ann = str_replace(',',"",$blc_ann);
		
		#convert tanggal
		list($d,$m,$y) = split("-",$tgl_aju);
		$tanggal = $y."-".$m."-".$d;
        
		#mendapatkan nama PT
		$data_pt = $this->db->where('id_pt',$pt)
							->get('pt')->row();
		$nama_pt = "PT \t".$data_pt->ket;


		#Kondisi status budget		
		if($convert_amount > $convert_blc_ann)
			{ $status = 'Over Budget';}
		elseif ($convert_blc_ann <= 0)
			{ $status = 'Over Budget';}
		else{ $status = 'On Budget';}

		#Ambil nama divisi
		$row2 = $this->mstmodel->getdivisi($divisi_id);
		//var_dump($row2);exit;
		
		#Ambil Budget account
		$row = $this->mstmodel->getmstbudget($code,$bgt_year,$pt);
		#Convert data detail budget string to Numeric 		
		$bgt_month 	= 	str_replace(',',"",$bgt_month);
		$amount 	= 	str_replace(',',"",$amount);
		$actmonth 	= 	str_replace(',',"",$actmonth);
		$blc_month	=	str_replace(',',"",$blc_month);
		$bgt_ytd 	= 	str_replace(',',"",$bgt_ytd);
		$actytd 	= 	str_replace(',',"",$actytd);
		$blc_ytd 	= 	str_replace(',',"",$blc_ytd);
		$actann		=	str_replace(',',"",$actann);
		$blc_ann	=	str_replace(',',"",$blc_ann);
		$annu_tot 	= 	str_replace(',',"",$annu_tot);
		#End
	
		#Perhitungan detail budget
		$actmonth 	=  	$actmonth + $amount;
		$blc_month	=	$bgt_month - $actmonth;
		//$actytd 	= 	$actytd + $amount;
		$actytd 	= 	$actytd + $amount;
		$blc_ytd	=	$bgt_ytd - $actytd;
		$actann		= 	$actann	+ $amount;
		// if ($bgt_year='2013'){
		// $blc_ann	=	$annu_tot - $actytd; 
		// }else{
		//$blc_ann	=	$actytd;
	//	}
		
	    $blc_ann	=	$annu_tot - $actann; 

		#End
		
		#Convert data divisi budget string to Numeric 	
		$totmnthdiv		= 	str_replace(',',"",$totmnthdiv);
		$actdivmonth	= 	str_replace(',',"",$actdivmonth);
		$blc_divmonth	= 	str_replace(',',"",$blc_divmonth);
		$totytddiv		= 	str_replace(',',"",$totytddiv);
		$actdivytd		= 	str_replace(',',"",$actdivytd);
		$blc_divytd		= 	str_replace(',',"",$blc_divytd);
		$totdiv			= 	str_replace(',',"",$totdiv);
		$actdivann		= 	str_replace(',',"",$actdivann);
		$blc_divann		= 	str_replace(',',"",$blc_divann);
		#end
		
		#Perhitungan data divisi budget
		$actdivmonth	=  	$actdivmonth + $amount;
		$blc_divmonth	=	$totmnthdiv - $actdivmonth;
		$actdivytd		= 	$actdivytd + $amount;
		$blc_divytd		=	$totytddiv - $actdivytd;
		$actdivann		= 	$actdivann	+ $amount;
		$blc_divann		=	$totdiv	 - $actdivann; 
		#End
		
		#Convert data seluruh divisi budget string to Numeric 	
		$totmnthalldiv	= 	str_replace(',',"",$totmnthalldiv);		
		$actalldivmonth	= 	str_replace(',',"",$actalldivmonth);
		$blcmnthalldiv	= 	str_replace(',',"",$blcmnthalldiv);
		$totytdalldiv	= 	str_replace(',',"",$totytdalldiv);
		$actalldivytd	= 	str_replace(',',"",$actalldivytd);
		$blcytdalldiv	= 	str_replace(',',"",$blcytdalldiv);
		$totalldiv		= 	str_replace(',',"",$totalldiv);
		$actalldivann	= 	str_replace(',',"",$actalldivann);
		$blcalldiv		= 	str_replace(',',"",$blcalldiv);
		#end
		
		#Perhitungan data seluruh divisi budget
		$actalldivmonth	=  	$actalldivmonth + $amount;
		$blcmnthalldiv	=	$totmnthalldiv - $actalldivmonth;
		$actalldivytd	= 	$actalldivytd + $amount;
		$blcytdalldiv	=	$totytdalldiv - $actalldivytd;
		$actalldivann	= 	$actalldivann + $amount;
		$blcalldiv		=	$totalldiv - $actalldivann; 
		#End

		#Cek last no print
		$lastrow = $this->db->order_by('id_hstprint','DESC')
						     ->get('history_form_print')->row();
		$lastid = $lastrow->id_hstprint;
		$nourut = $lastid + 1;
		
		#Ambil data dari Form Budget
		$data['cekdata'] = array 
		(
		    'tgl_aju' => $tgl_aju,
		    'nama_pt' => $nama_pt,
			'amount' => number_format($amount),
			'status' => $status,
			'divisi_nm' => $row2->divisi_nm,
			'code_acc' => $row->code,
			'descbgt' => $row->descbgt,
			'bgt_month' => number_format($bgt_month),
			'actmonth' => number_format($actmonth),
			'blc_month' => number_format($blc_month),
			'bgt_ytd' => number_format($bgt_ytd), 
			'actytd' => number_format($actytd),
			'blc_ytd' => number_format($blc_ytd),
			'annu_tot' => number_format($annu_tot),
			'actann' => number_format($actann),
			'blc_ann' => number_format($blc_ann),
			'totmnthdiv' => number_format($totmnthdiv),
			'actdivmonth' => number_format($actdivmonth),
			'blc_divmonth' => number_format($blc_divmonth),
			'totytddiv' => number_format($totytddiv),
			'actdivytd' => number_format($actdivytd),
			'blc_divytd' => number_format($blc_divytd),
			'totdiv' => number_format($totdiv),
			'actdivann' => number_format($actdivann),
			'blc_divann' => number_format($blc_divann),
			'totmnthalldiv' => number_format($totmnthalldiv),
			'actalldivmonth' => number_format($actalldivmonth),
			'blcmnthalldiv' => number_format($blcmnthalldiv),
			'totytdalldiv' => number_format($totytdalldiv),
			'actalldivytd' => number_format($actalldivytd),
			'blcytdalldiv' => number_format($blcytdalldiv),
			'totalldiv' => number_format($totalldiv),
			'actalldivann' => number_format($actalldivann),
			'blcalldiv' => number_format($blcalldiv),
			'remark' => $remark,
			'last_id' => $nourut
		);
		
		
		#list($d,$m,$y) = split("-",$tgl_aju);
		#$tanggal = $y."-".$m."-".$d;
		#$row = $this->mstmodel->getmstbudget($code,$y,$pt);
		#$row2 = $this->mstmodel->getdivisi($divisi_id);

		#Cek last no print
		#$lastrow = $this->db->order_by('id_hstprint','DESC')
						  # ->get('history_form_print')->row();
		#$lastid = $lastrow->id_hstprint;

		if($code=='Select Budget'){
			echo"
				<script type='text/javascript'>
					alert('Hasil Print Error, Cek kembali pengajuan budget');
					window.close();
				</script>
			";
			//die("Hasil Print Error, Cek kembali pengajuan budget");
			exit;
		//~ }elseif($flag_pr == ""){
		//~ die("Tipe Budget Harus Di isi");
		//~ 
		//~ }
		}elseif($convert_amount < 0){
			//("test/?a=1&b=2")
			//redirect("print/slip_budget/slip_besar/?a=1&b=2");
			#Cek Form Slip Budget
			$no_urut = $this->mstmodel->cek_slip_budget(1,$code,$noid);
			$kodeform = "P/$tgl_aju/$no_urut";
			$data['cekkode'] = $kodeform;		
			$simpandata = array
			(
				'code_id' => $code,
				'amount' => $convert_amount,			
				'status_bgt' => $status,
				'divisi_id' => $divisi_id,
				'remark' => $remark,
				'id_pt' => $pt,
				'id_parent' => $parent,
				'tanggal' => $tanggal,
				'form_kode' => $kodeform,
				'divthn' => $bgt_year,
				'description' => $desc,
				'appamount' => 0,
				'flag_id'=> 0,
				'proses' => 0,
				'flag_pr' => $flag_pr
				
			);
			$this->db->insert("db_trbgtdiv",$simpandata);
			$this->load->view('print/slip_budget_besar',$data);
	    }else{
			#Cek Form Slip Budget
			$no_urut = $this->mstmodel->cek_slip_budget(1,$code,$noid);
			$kodeform = "P/$tgl_aju/$no_urut";
			$data['cekkode'] = $kodeform;		
			$simpandata = array
			(
				'code_id' => $code,
				'amount' => $convert_amount,			
				'status_bgt' => $status,
				'divisi_id' => $divisi_id,
				'remark' => $remark,
				'id_parent' => $parent,
				'id_pt' => $pt,
				'tanggal' => $tanggal,
				'form_kode' => $kodeform,
				'description' => $desc,
				'divthn' => $bgt_year,
				'appamount' => 0,
				'flag_id'=> 0,
				'proses' => 0,
				'flag_pr' => $flag_pr
			);
			$this->db->insert("db_trbgtdiv",$simpandata);
			$this->load->view("print/slip_budget_kecil",$data);
		}
	}
}

