<?
Class slip_appbudget Extends controller{
	
	function __construct(){
				parent::controller();
	}
		
	function index(){		
		extract(PopulateForm());
		$session_id = $this->UserLogin->isLogin();
		$divisi_id = $session_id['divisi_id'];
		$pt = $session_id['id_pt'];
		#Cek Form Slip Budget
		$no_urut = $this->mstmodel->cek_slip_budget(2,$code,$id);
		#Cek last no print
		$lastrow = $this->db->order_by('id_hstprint','DESC')
						   ->get('history_form_print')->row();
		$lastid = $lastrow->id_hstprint;
		$thn = '2011';
		#list($d,$m,$y) = split("-",$apptanggal);
		#apptanggal = $y."-".$m."-".$d;
		
		//Jika Kondisi Budget di tolak
		if($app=='Unapprove'){
			$data = array
			(
				'flag_id'=> 2
			);
			$this->db->where('id_trbgt',$id);
			$this->db->update('db_trbgtdiv',$data);	
			echo"
				<script type='text/javascript'>
					alert('Data Unapproved');
					window.close();
				</script>
			";		
			exit;
		}
		
		
		#Ambil Data
		$tanggal	= 	$this->input->post('proptanggal');
		$apptanggal	= 	$this->input->post('apptanggal');
		$div 		= 	$this->input->post('div');		
		$acc		= 	$this->input->post('orgn_coa');
		$descacc	= 	$this->input->post('descacc');
		$cf			= 	$this->input->post('cf');
		$desccf		= 	$this->input->post('desccf');
		$appremark 	= 	$this->input->post('remark');
		
		
		$row = $this->mstmodel->getmstbudget($code,$thn,$pt);
		$row2 = $this->mstmodel->getdivisi($div);
		
		//Post
		
		#ambil data detail budget dari form proposed budget
		$amount 		= 	$this->input->post('propamount');
		$id				=	$this->input->post('id');
		$appamount 		= 	$this->input->post('appamount');
		$totmnth 		= 	$this->input->post('totmnth');
		$totytd			= 	$this->input->post('totytd');
		$actmnth 		= 	$this->input->post('actmnth');
		$actytd			= 	$this->input->post('actytd');
		
		#RETRIEVE BUDGET ANNUAL
		$totmst			= 	$this->input->post('totmst');
		$totdiv			= 	$this->input->post('totdiv');
		$totalldiv		= 	$this->input->post('totalldiv');
		$actann			= 	$this->input->post('actann');
		$actanndiv		= 	$this->input->post('actanndiv');
		$actannalldiv	= 	$this->input->post('actannalldiv');
		$blcann			= 	$this->input->post('blcann');
		$blcanndiv		= 	$this->input->post('blcanndiv');
		$blcannalldiv	= 	$this->input->post('blcannalldiv');
		$totmnthdiv		= 	$this->input->post('totmnthdiv');
		$totmnthalldiv	= 	$this->input->post('totmnthalldiv');
		$actdivmonth	=	$this->input->post('actdivmonth');
		$blc_divmonth	=	$this->input->post('blc_divmonth');
		$totytddiv		=	$this->input->post('totytddiv');
		$actdivytd		=	$this->input->post('actdivytd');
		$actytddiv		=	$this->input->post('actytddiv');
		$blcytddiv		=	$this->input->post('blcytddiv');
		$actanndiv		=	$this->input->post('actanndiv');
		$blcanndiv		=	$this->input->post('blcanndiv');
		
		$blcalldiv		=	$this->input->post('blcalldiv');
		$actalldivann	=	$this->input->post('actalldivann');
		$totalldiv		=	$this->input->post('totalldiv');
		$blcytdalldiv	=	$this->input->post('blcytdalldiv');
		$actalldivytd	=	$this->input->post('actalldivytd');
		$totytdalldiv	=	$this->input->post('totytdalldiv');
		$blcalldivmonth	=	$this->input->post('blcalldivmonth');
		$actmnthalldiv	=	$this->input->post('actmnthalldiv');
		$totmnthalldiv	=	$this->input->post('totmnthalldiv');
		$actytdalldiv	=	$this->input->post('actytdalldiv');
		
		
		#HILANGKAN KOMA BUDGET ANNUAL
		$totmst			= 	str_replace(',',"",$totmst);
		$totdiv			= 	str_replace(',',"",$totdiv);
		$totalldiv		= 	str_replace(',',"",$totalldiv);
		$actann			= 	str_replace(',',"",$actann);
		$actanndiv		= 	str_replace(',',"",$actanndiv);
		$actannalldiv	= 	str_replace(',',"",$actannalldiv);
		$blcann			= 	str_replace(',',"",$blcann);
		$blcanndiv		= 	str_replace(',',"",$blcanndiv);
		$blcannalldiv	= 	str_replace(',',"",$blcannalldiv);
		$totmnthdiv		= 	str_replace(',',"",$totmnthdiv);
		$actdivmonth	=	str_replace(',',"",$actdivmonth);
		$totmnthalldiv	= 	str_replace(',',"",$totmnthalldiv);
		$blc_divmonth	= 	str_replace(',',"",$blc_divmonth);
		$totytddiv		= 	str_replace(',',"",$totytddiv);
		$actdivytd		= 	str_replace(',',"",$actdivytd);
		$actytddiv		=	str_replace(',',"",$actytddiv);
		$blcytddiv		=	str_replace(',',"",$blcytddiv);
		$actanndiv		=	str_replace(',',"",$actanndiv);
		$blcanndiv		=	str_replace(',',"",$blcanndiv);
		
		$blcalldiv		=	str_replace(',',"",$blcalldiv);
		$actalldivann	=	str_replace(',',"",$actalldivann);
		$totalldiv		=	str_replace(',',"",$totalldiv);
		$blcytdalldiv	=	str_replace(',',"",$blcytdalldiv);
		$actalldivytd	=	str_replace(',',"",$actalldivytd);
		$totytdalldiv	=	str_replace(',',"",$totytdalldiv);
		$blcalldivmonth	=	str_replace(',',"",$blcalldivmonth);
		$actmnthalldiv	=	str_replace(',',"",$actmnthalldiv);
		$totmnthalldiv	=	str_replace(',',"",$totmnthalldiv);
		$actytdalldiv	=	str_replace(',',"",$actytdalldiv);
		
		#HILANGKAN KOMA
		$appamount		= str_replace(',',"",$appamount);
		$totmnth		= str_replace(',',"",$totmnth);
		$totytd			= str_replace(',',"",$totytd);
		$actmnth		= str_replace(',',"",$actmnth);
		$actytd			= str_replace(',',"",$actytd);
		
		
		
		
		
		
		$actmnth		= $appamount + $actmnth;
		$blcmnth		= $totmnth - $appamount;
		
		$actytd			= $actytd + $appamount;
		$blcytd			= $totytd - $actytd; 	
		$batasstatus	= $appamount + $actann;
						
		//~ $blc_ann 		= 	$this->input->post('blc_ann');
		//~ $blc_divytd 	= 	$this->input->post('blcdivytd');
		//~ $actytd 		= 	$this->input->post('actytd');
		//~ $blc_divmonth 	=	$this->input->post('blc_divmonth');
		//~ $actann			=	$this->input->post('actann');
		//~ $bgt_month		= 	$this->input->post('bgt_month');
		//~ $actmonth 		= 	$this->input->post('actmonth');
		//~ $blc_month 		= 	$this->input->post('blc_month');
		//~ $bgt_ytd 		= 	$this->input->post('bgt_ytd');
		//~ $blc_ytd 		= 	$this->input->post('blc_ytd');
		//~ $annu_tot 		= 	$this->input->post('annu_tot');
		//~ #End
		//~ #list($d,$m,$Y) = split("-",$apptgl);
		//~ #$apptgl = $d."-".$m."-".$Y;
		//~ #ambil data divisi budget dari form proposed budget
		//~ $totmnthdiv		= 	$this->input->post('totmnthdiv');
		//~ $actdivmonth	=	$this->input->post('actdivmonth');
		//~ $blc_divmonth	=	$this->input->post('blc_divmonth');
		//~ $totytddiv		=	$this->input->post('totytddiv');
		//~ $actdivytd		=	$this->input->post('actdivytd');
		//~ $blc_divytd		=	$this->input->post('blc_divytd');
		//~ $totdiv			=	$this->input->post('totdiv');
		//~ $actdivann		=	$this->input->post('actdivann');
		//~ $blc_divann		=	$this->input->post('blc_divann');
		//~ #End
		//~ 
		//~ #ambil data seluruh divisi budget dari form proposed budget
		//~ 
		//~ $totmnthalldiv	= 	$this->input->post('totmnthalldiv');
		//~ 
		//~ $actalldivmonth	=	$this->input->post('actalldivmonth');
		//~ $blcmnthalldiv	=	$this->input->post('blcmnthalldiv');
		//~ $totytdalldiv	=	$this->input->post('totytdalldiv');
		//~ $actalldivytd	=	$this->input->post('actalldivytd');
		//~ $blcytdalldiv	=	$this->input->post('blcytdalldiv');
		//~ $totalldiv		=	$this->input->post('totalldiv');
		//~ $actalldivann	=	$this->input->post('actalldivann');
		//~ $blcalldiv		=	$this->input->post('blcalldiv');
		//~ #End
		//~ 
		//~ 
		//~ 
		//~ #Convert data detail budget string to Numeric 		
		//~ $bgt_month 	= 	str_replace(',',"",$bgt_month);
		//~ $amount 	= 	str_replace(',',"",$amount);
		//~ $appamount = 	str_replace(',',"",$appamount);
		//~ $actmonth 	= 	str_replace(',',"",$actmonth);
		//~ $blc_month	=	str_replace(',',"",$blc_month);
		//~ $bgt_ytd 	= 	str_replace(',',"",$bgt_ytd);
		//~ $actytd 	= 	str_replace(',',"",$actytd);
		//~ $blc_ytd 	= 	str_replace(',',"",$blc_ytd);
		//~ $actann		=	str_replace(',',"",$actann);
		//~ $blc_ann	=	str_replace(',',"",$blc_ann);
		//~ $annu_tot 	= 	str_replace(',',"",$annu_tot);
		//~ #End
	//~ 
		//~ #Perhitungan detail budget
		//~ $actmonth 	=  	$actmonth + $appamount;
		//~ $blc_month	=	$bgt_month - $actmonth;
		//~ $actytd 	= 	$actytd + $appamount;
		//~ $blc_ytd	=	$bgt_ytd - $actytd;
		//~ $actann		= 	$actann	+ $appamount;
		//~ $blc_ann	=	$annu_tot - $actann;
		//~ $varian		=	$amount - $appamount; 
		//~ #End
		//~ 
		//~ #Convert data divisi budget string to Numeric 	
		//~ $totmnthdiv		= 	str_replace(',',"",$totmnthdiv);
		//~ $actdivmonth	= 	str_replace(',',"",$actdivmonth);
		//~ $blc_divmonth	= 	str_replace(',',"",$blc_divmonth);
		//~ $totytddiv		= 	str_replace(',',"",$totytddiv);
		//~ $actdivytd		= 	str_replace(',',"",$actdivytd);
		//~ $blc_divytd		= 	str_replace(',',"",$blc_divytd);
		//~ $totdiv			= 	str_replace(',',"",$totdiv);
		//~ $actdivann		= 	str_replace(',',"",$actdivann);
		//~ $blc_divann		= 	str_replace(',',"",$blc_divann);
		//~ #end
		//~ 
		//~ #Perhitungan data divisi budget
		//~ $actdivmonth	=  	$actdivmonth + $appamount;
		//~ $blc_divmonth	=	$totmnthdiv - $actdivmonth;
		//~ $actdivytd		= 	$actdivytd + $appamount;
		//~ $blc_divytd		=	$totytddiv - $actdivytd;
		//~ $actdivann		= 	$actdivann	+ $appamount;
		//~ $blc_divann		=	$totdiv	 - $actdivann; 
		//~ 
		//~ $appamount		= 	str_replace(',',"",$appamount);
		//~ 
		//~ 
		//~ #End
		//~ 
		//~ #Convert data seluruh divisi budget string to Numeric 	
		//~ 
		//~ $totmnthalldiv	= 	str_replace(',',"",$totmnthalldiv);
		//~ 
		//~ $actalldivmonth	= 	str_replace(',',"",$actalldivmonth);
		//~ $blcmnthalldiv	= 	str_replace(',',"",$blcmnthalldiv);
		//~ $totytdalldiv	= 	str_replace(',',"",$totytdalldiv);
		//~ $actalldivytd	= 	str_replace(',',"",$actalldivytd);
		//~ $blcytdalldiv	= 	str_replace(',',"",$blcytdalldiv);
		//~ $totalldiv		= 	str_replace(',',"",$totalldiv);
		//~ $actalldivann	= 	str_replace(',',"",$actalldivann);
		//~ $blcalldiv		= 	str_replace(',',"",$blcalldiv);
		//~ #end
		//~ 
		//~ #Perhitungan data seluruh divisi budget
		//~ $actalldivmonth	=  	$actalldivmonth + $appamount;
		//~ 
		//~ $blcmnthalldiv	=	$totmnthalldiv - $actalldivmonth;
		//~ 
		//~ $actalldivytd	= 	$actalldivytd + $appamount;
		//~ $blcytdalldiv	=	$totytdalldiv - $actalldivytd;
		//~ $actalldivann	= 	$actalldivann + $appamount;
		//~ $blcalldiv		=	$totalldiv - $actalldivann; 
		//~ #End
		//~ 
			//~ 
		//~ 
		
		
		
		#Kondisi status budget		
		if($batasstatus > $blcann)
			{ $status = 'Over Budget';}
		//~ else if ($blc_month <= 0)
			//~ { $status = 'Over Budget';}
			
		else{ $status = 'On Budget';}
		
		$kodeform = "A/".$apptanggal."/".$no_urut;
		//var_dump($remark);exit;
					
		$data = array
		(
			
			'appamount' => $appamount,
			/*'blc_month' => str_replace(',',"",$blc_month),
			'blc_ytd' => str_replace(',',"",$blc_ytd),
			'blc_ann' => str_replace(',',"",$blc_ann),
			'blc_divmonth' => str_replace(',',"",$blc_divmonth),
			'blc_divytd' => str_replace(',',"",$blc_divytd),
			'blc_divann' => str_replace(',',"",$blc_divann),
			'blc_divallmonth' => str_replace(',',"",$blc_divallmonth),
			'blc_divallytd' => str_replace(',',"",$blc_divallytd),
			'blc_divallann' => str_replace(',',"",$blc_divallann),*/
			'apptanggal' => inggris_date($apptanggal),
			'status_bgt' => $status,
			'appremark' => $remark,
			'form_kode' => $kodeform,
			'flag_id'=> 1
		);
		$this->db->where('id_trbgt',$id);
		$this->db->update('db_trbgtdiv',$data);
		
		
		//~ 
		
		#cetak format tanggal
		#list($y,$m,$d) = split("-",$tanggal);
		#$tanggal = $d."-".$m."-".$y;
		#list($y,$m,$d) = split("-",$apptanggal);
		#$apptanggal = $d."-".$m."-".$y;
		
		
		#Print Budget	
		require('fpdf/classpdf.php');
		$pdf=new PDF('L','mm','A4');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',18);
		$pdf->Cell(0,15,'APPROVED BUDGET FORM',20,0,'C');
		/*$pdf->SetLineWidth(0.5);
		$pdf->Line(0,16,100,16);*/
		//Line break
		$pdf->Ln(15);
		$pdf->SetFont('Arial','B',8);
		$pdf->SetXY(250,2);
		$pdf->Cell(2,5,$kodeform,0,0,'L');
		$pdf->SetXY(30,2);
		$pdf->Cell(2,20,"",0,0,'L');
		$pdf->SetFont('Times','',12);
		$pdf->SetXY(10,30);
		$pdf->Cell(0,5,"Approved Date",0,1);
		$pdf->SetXY(40,30);
		$pdf->Cell(0,5,":",0,1);
		$pdf->SetXY(45,30);
		$pdf->Cell(0,5,$apptanggal,0,1);
		$pdf->SetXY(10,37);
		$pdf->Cell(0,5,"Approved",0,1);
		$pdf->SetXY(40,37);
		$pdf->Cell(0,5,":",0,1);
		$pdf->SetXY(45,37);
		$pdf->Cell(0,5,number_format($appamount),0,1);
		$pdf->SetXY(10,44);
		$pdf->Cell(0,5,"Status.",0,1);
		$pdf->SetXY(40,44);
		$pdf->Cell(0,5,":",0,1);
		$pdf->SetXY(45,44);
		$pdf->Cell(40,5,$status,0,1,'L');
		$pdf->SetXY(10,51);
		$pdf->Cell(0,5,"Divisi",0,1);
		$pdf->SetXY(40,51);
		$pdf->Cell(0,5,":",0,1);
		$pdf->SetXY(45,51);
		$pdf->Cell(0,5,$row2->divisi_nm,0,1);
		
		
		$pdf->SetXY(90,30);
		$pdf->Cell(0,5,"Proposed Date",0,1);
		$pdf->SetXY(117,30);
		$pdf->Cell(0,5,":",0,1);
		$pdf->SetXY(120,30);
		$pdf->Cell(0,5,$tanggal,0,1);
		$pdf->SetXY(90,37);
		$pdf->Cell(0,5,"Proposed",0,1);
		$pdf->SetXY(117,37);
		$pdf->Cell(0,5,":",0,1);
		$pdf->SetXY(120,37);
		$pdf->Cell(0,5,$amount,0,1);
		$pdf->SetXY(90,44);
		$pdf->Cell(0,5,"BGT. Account",0,1);
		$pdf->SetXY(117,44);
		$pdf->Cell(0,5,":",0,1);
		$pdf->SetXY(120,44);
		$pdf->Cell(0,5,$row->code,0,1);
		$pdf->SetXY(90,51);
		$pdf->Cell(0,5,"BGT. Desc",0,1);
		$pdf->SetXY(117,51);
		$pdf->Cell(0,5,":",0,1);
		$pdf->SetXY(120,51);
		$pdf->Cell(0,5,$row->descbgt,0,1);
		
		
		
		$pdf->SetXY(180,30);
		$pdf->Cell(10,5,"ACC. Account",0,1);
		$pdf->SetXY(207,30);
		$pdf->Cell(5,5,":",0,1);
		$pdf->SetXY(210,30);
		$pdf->Cell(20,5,$acc,0,1);
		$pdf->SetXY(180,37);
		$pdf->Cell(10,5,"ACC. Desc",0,1);
		$pdf->SetXY(207,37);
		$pdf->Cell(5,5,":",0,1);
		$pdf->SetXY(210,37);
		$pdf->Cell(20,5,$descacc,0,1);
		
		
		$pdf->SetXY(180,44);
		$pdf->Cell(10,5,"CF. Account",0,1);
		$pdf->SetXY(207,44);
		$pdf->Cell(5,5,":",0,1);
		$pdf->SetXY(210,44);
		$pdf->Cell(20,5,$cf,0,1);
		$pdf->SetXY(180,51);
		$pdf->Cell(10,5,"CF. Desc",0,1);
		$pdf->SetXY(207,51);
		$pdf->Cell(5,5,":",0,1);
		$pdf->SetXY(210,51);
		$pdf->Cell(20,5,$desccf,0,1);
		
		
		
		
		$pdf->SetFont('Arial','B',14);
		$pdf->SetXY(10,58);
		$pdf->Cell(90,8,"ACCOUNT BUDGET",1,1,'C');
		$pdf->SetXY(101,58);
		$pdf->Cell(90,8,"DIVISON BUDGET",1,1,'C');
		$pdf->SetXY(192,58);
		$pdf->Cell(90,8,"COMPANY BUDGET",1,1,'C');
		
		
		
		
		
		#Budget Detail
		
		$pdf->SetFont('Times','',12);
		$pdf->SetXY(10,68);
		$pdf->Cell(40,5,"Budget Month",0,1);
		$pdf->SetXY(51,68);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(54,68);
		$pdf->Cell(45,5,number_format($totmnth),0,1,'R');
		$pdf->SetXY(10,75);
		$pdf->Cell(40,5,"Actual Month",0,1);
		$pdf->SetXY(51,75);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(54,75);
		$pdf->Cell(45,5,number_format($actmnth),0,1,'R');
		$pdf->SetXY(10,83);
		$pdf->Cell(40,5,"Balanced Month",0,1);
		$pdf->SetXY(51,83);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(54,83);
		$pdf->Cell(45,5,number_format($blcmnth),0,1,'R');
		
		$pdf->SetXY(10,90);
		$pdf->Cell(40,5,"Budget YTD",0,1);
		$pdf->SetXY(51,90);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(54,90);
		$pdf->Cell(45,5,number_format($totytd),0,1,'R');
		$pdf->SetXY(10,97);
		$pdf->Cell(40,5,"Actual YTD",0,1);
		$pdf->SetXY(51,97);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(54,97);
		$pdf->Cell(45,5,number_format($actytd),0,1,'R');
		$pdf->SetXY(10,104);
		$pdf->Cell(40,5,"Balanced YTD",0,1);
		$pdf->SetXY(51,104);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(54,104);
		$pdf->Cell(45,5,number_format($blcytd),0,1,'R');
		
		
		
		$pdf->SetXY(10,111);
		$pdf->Cell(40,5,"Budget Annual",0,1);
		$pdf->SetXY(51,111);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(54,111);
		$pdf->Cell(45,5,number_format($totmst),0,1,'R');
		$pdf->SetXY(10,118);
		$pdf->Cell(40,5,"Actual Annual",0,1);
		$pdf->SetXY(51,118);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(54,118);
		$pdf->Cell(45,5,number_format($actann),0,1,'R');
		$pdf->SetXY(10,125);
		$pdf->Cell(40,5,"Balanced Annual",0,1);
		$pdf->SetXY(51,125);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(54,125);
		$pdf->Cell(45,5,number_format($blcann),0,1,'R');
		
		
		/*Budget Divisi*/
				
		$pdf->SetFont('Times','',12);
		$pdf->SetXY(101,68);
		$pdf->Cell(40,5,"Budget Month",0,1);
		$pdf->SetXY(142,68);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(145,68);
		$pdf->Cell(45,5,number_format($totmnthdiv),0,1,'R');
		$pdf->SetXY(101,75);
		$pdf->Cell(40,5,"Actual Month",0,1);
		$pdf->SetXY(142,75);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(145,75);
		$pdf->Cell(45,5,number_format($actdivmonth),0,1,'R');
		$pdf->SetXY(101,83);
		$pdf->Cell(40,5,"Balanced Month",0,1);
		$pdf->SetXY(142,83);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(145,83);
		$pdf->Cell(45,5,number_format($blc_divmonth),0,1,'R');
		$pdf->SetXY(101,90);
		$pdf->Cell(40,5,"Budget YTD",0,1);
		$pdf->SetXY(142,90);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(145,90);
		$pdf->Cell(45,5,number_format($totytddiv),0,1,'R'); 
		$pdf->SetXY(101,97);
		$pdf->Cell(40,5,"Actual YTD",0,1);
		$pdf->SetXY(142,97);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(145,97);
		$pdf->Cell(45,5,number_format($actytddiv),0,1,'R');
		$pdf->SetXY(101,104);
		$pdf->Cell(40,5,"Balanced YTD",0,1);
		$pdf->SetXY(142,104);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(145,104);
		$pdf->Cell(45,5,number_format($blcytddiv),0,1,'R');
		$pdf->SetXY(101,111);
		$pdf->Cell(40,5,"Budget Annual",0,1);
		$pdf->SetXY(142,111);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(145,111);
		$pdf->Cell(45,5,number_format($totdiv)	,0,1,'R');
		$pdf->SetXY(101,118);
		$pdf->Cell(40,5,"Actual Annual",0,1);
		$pdf->SetXY(142,118);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(145,118);
		$pdf->Cell(45,5,number_format($actanndiv),0,1,'R');
		$pdf->SetXY(101,125);
		$pdf->Cell(40,5,"Balanced Annual",0,1);
		$pdf->SetXY(142,125);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(145,125);
		$pdf->Cell(45,5,number_format($blcanndiv),0,1,'R');
		
		
		#Cetak Budget All Divisi
		
		$pdf->SetFont('Times','',12);
		$pdf->SetXY(192,68);
		$pdf->Cell(40,5,"Budget Month",0,1);
		$pdf->SetXY(233,68);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(236,68);
		$pdf->Cell(45,5,number_format($totmnthalldiv),0,1,'R');
		$pdf->SetXY(192,75);
		$pdf->Cell(40,5,"Actual Month",0,1);
		$pdf->SetXY(233,75);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(236,75);
		$pdf->Cell(45,5,number_format($actmnthalldiv),0,1,'R');
		$pdf->SetXY(192,83);
		$pdf->Cell(40,5,"Balanced Month",0,1);
		$pdf->SetXY(233,83);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(236,83);
		$pdf->Cell(45,5,number_format($blcalldivmonth),0,1,'R');
		$pdf->SetXY(192,90);
		$pdf->Cell(40,5,"Budget YTD",0,1);
		$pdf->SetXY(233,90);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(236,90);
		$pdf->Cell(45,5,number_format($totytdalldiv),0,1,'R');
		$pdf->SetXY(192,97);
		$pdf->Cell(40,5,"Actual YTD",0,1);
		$pdf->SetXY(233,97);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(236,97);
		$pdf->Cell(45,5,number_format($actytdalldiv),0,1,'R');
		$pdf->SetXY(192,104);
		$pdf->Cell(40,5,"Balanced YTD",0,1);
		$pdf->SetXY(233,104);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(236,104);
		$pdf->Cell(45,5,number_format($blcytdalldiv),0,1,'R');
		$pdf->SetXY(192,111);
		$pdf->Cell(40,5,"Budget Annual",0,1);
		$pdf->SetXY(233,111);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(236,111);
		$pdf->Cell(45,5,number_format($totalldiv),0,1,'R');
		$pdf->SetXY(192,118);
		$pdf->Cell(40,5,"Actual Annual",0,1);
		$pdf->SetXY(233,118);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(236,118);
		$pdf->Cell(45,5,number_format($actannalldiv),0,1,'R');
		$pdf->SetXY(192,125);
		$pdf->Cell(40,5,"Balanced Annual",0,1);
		$pdf->SetXY(233,125);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(236,125);
		$pdf->Cell(45,5,number_format($blcannalldiv),0,1,'R');
		
		
		//~ #Approval 
		//~ /*if ($status == 'On Budget')
			//~ { 	$pdf->SetXY(10,150);
				//~ $pdf->Cell(30,5,"Prepared by :",0,1);
				//~ $pdf->SetXY(100,150);
				//~ $pdf->Cell(0,5,"Approved by :",0,1);}
		//~ else {	$pdf->SetXY(10,150);
				//~ $pdf->Cell(30,5,"Prepared by :",0,1);
				//~ $pdf->SetXY(80,150);
				//~ $pdf->Cell(0,5,"Aknowledge by:",0,1);
				//~ $pdf->SetXY(150,150);
				//~ $pdf->Cell(0,5,"Approved by :",0,1);}*/
		//~ 
		
		
		
		$url= "reprint/Approved Budget".$lastid.".pdf";
		$pdf->Output($url);
		redirect($url);						
}

	}

