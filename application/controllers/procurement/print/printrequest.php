<?php
defined('BASEPATH') or die('Access Denied');
Class printrequest extends Controller{
	
	function __construct(){
		parent::controller();
		$this->load->Model('printrequest_model','printrequest');
	}
	
	function index(){
		//check session
		extract(PopulateForm());
		$session_id = $this->UserLogin->isLogin();
		$pt = $session_id['id_pt'];
		
		//Check All data this Month
		$arr = array("","bgt1","bgt2","bgt3","bgt4","bgt5","bgt6","bgt7","bgt8","bgt9","bgt10","bgt11","bgt12");
		$tgl = $this->input->post('tgl');
		$id_divisi = $this->input->post('divisi');
		$path = substr($tgl,3,2);
		$data_pt = $this->printrequest->get_nama_pt($pt);
		$nama_pt = "PT \t".$data_pt['ket'];

			#var_dump($id_divisi);exit;
		
		//nama bulan
		switch($path)
		{
			case "01" :
				$stringmonth = "January";
				break;
			case "02" :
				$stringmonth = "February";
				break;
			case "03" :
				$stringmonth = "March";
				break;
			case "04" :
				$stringmonth = "April";
				break;
			case "05" :
				$stringmonth = "May";
				break;
			case "06" :
				$stringmonth = "June";
				break;
			case "07" :
				$stringmonth = "July";
				break;
			case "08" :
				$stringmonth = "August";
				break;
			case "09" :
				$stringmonth = "September";
				break;
			case "10" :
				$stringmonth = "October";
				break;
			case "11" :
				$stringmonth = "November";
				break;
			case "12" :
				$stringmonth = "December";
				break;
		} 	
					
		
		$i = str_replace("0","",substr($tgl,3,2));
		$bln = $arr[$i];
		if($id_divisi=="all"){
			$data = $this->printrequest->get_all($path,$pt);
			$division = "All";
		}else{
			//Check nama jabatan
			$check = $this->printrequest->check_divisi($id_divisi);
			#var_dump($id_divisi);
			#Update Tanggal
			list($d1,$m1,$y1) = split('-',$tgl); 
			#list($d2,$m2,$y2) = split('-',$tgl1);
			$dt1 = $m1.'/'.$d1.'/'.$y1;
			#$dt2 = $m2.'/'.$d2.'/'.$y2;
			$division = $check['divisi_nm'];
			$tglawal = "01/01/".$thn;
			$data = $this->printrequest->get_data($stringmonth,$id_divisi,$pt,$tglawal,$thn,$dt1);
		}

		if(intval($path) == 12){
			$var = 'sum(bgt1 + bgt2 + bgt3 + bgt4 + bgt5 + bgt6 + bgt7 + 
			        bgt8 + bgt9 + bgt10 + bgt11 + bgt12)
			       ';
		}elseif(intval($path) == 11){
			$var = 'sum(bgt1 + bgt2 + bgt3 + bgt4 + bgt5 + bgt6 + bgt7 + 
			        bgt8 + bgt9 + bgt10 + bgt11)';
		}elseif(intval($path) == 10){
			$var = 'sum(bgt1 + bgt2 + bgt3 + bgt4 + bgt5 + bgt6 + bgt7 + 
			        bgt8 + bgt9 + bgt10)';
		}elseif(intval($path) == 9){
			$var = 'sum(bgt1 + bgt2 + bgt3 + bgt4 + bgt5 + bgt6 + bgt7 + 
			        bgt8 + bgt9)';
		}elseif(intval($path) == 8){
			$var = 'sum(bgt1 + bgt2 + bgt3 + bgt4 + bgt5 + bgt6 + bgt7 + 
			        bgt8)';
		}elseif(intval($path) == 7){
			$var = 'sum(bgt1 + bgt2 + bgt3 + bgt4 + bgt5 + bgt6 + bgt7)';
		}elseif(intval($path) == 6){
			$var = 'sum(bgt1 + bgt2 + bgt3 + bgt4 + bgt5 + bgt6)';
		}elseif(intval($path) == 5){
			$var = 'sum(bgt1 + bgt2 + bgt3 + bgt4 + bgt5)';
		}elseif(intval($path) == 4){
			$var = 'sum(bgt1 + bgt2 + bgt3 + bgt4)';
		}elseif(intval($path) == 3){
			$var = 'sum(bgt1 + bgt2 + bgt3)';
		}elseif(intval($path) == 2){
			$var = 'sum(bgt1 + bgt2)';
		}elseif(intval($path) == 1){
			$var = 'sum(bgt1)';
		}	
		
		require('fpdf/classrequest.php');
		$pdf=new PDF('L','mm','A4');
		$pdf->SetMargins(2,10,2);
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',12);
		$pdf->SetXY(25,10);
		$pdf->Cell(0,10,$nama_pt,20,0,'L');
		#Variable Judul Header
		$pdf->SetFont('Arial','',10);
		$judul = "As Of \t".$stringmonth;
		$pdf->SetXY(25,15);
		$pdf->Cell(0,10,'Operational Budget Monitoring - '.$division.' Division',20,0,'L');
		$pdf->SetXY(25,20);
		$pdf->Cell(0,10,'As of date ( '.$tgl.' )',20,0,'L');
		
		$y_axis_initial = 45;
		$y_axis = 0;
		$pdf->SetFont('Arial','',8);
		$pdf->setFillColor(222,222,222);
		$pdf->SetY($y_axis_initial);
		$pdf->SetFont('Arial','',8);
		$pdf->SetX(2);
		$pdf->Cell(15,6,'',0,0,'C');
		$pdf->Cell(70,6,'',0,0,'C');
		$pdf->Cell(23,6,'ACTUAL',1,0,'C',1);
		$pdf->Cell(23,6,'BUDGET',1,0,'C',1);
		$pdf->Cell(23,6,'BALANCE',1,0,'C',1);
		$pdf->Cell(23,6,'ACTUAL',1,0,'C',1);
		$pdf->Cell(23,6,'BUDGET',1,0,'C',1);
		$pdf->Cell(23,6,'BALANCE',1,0,'C',1);
		$pdf->Cell(23,6,'ACTUAL',1,0,'C',1);
		$pdf->Cell(23,6,'BUDGET',1,0,'C',1);
		$pdf->Cell(23,6,'BALANCE',1,0,'C',1);
		$pdf->Ln();
		
		$max=22;
		$row_height = 6;
		$y_axis = $y_axis + $row_height;
		$no=0;
        
		$a = 1;
		$tot1 = 0;
		$tot2 = 0;
		$tot3 = 0;
		$tot4 = 0;
		$tot5 = 0;
		$tot6 = 0;
		$tot7 = 0;
		$tot8 = 0;
		$tot9 = 0;
		
		foreach($data as $row){
			$code = $row->code;
			$description = $row->descbgt;
			
			//Monthly
			$act_month = $row->act_month;
			$budget_month = $row->$bln;
			$balance_month = $budget_month - $act_month;
			
			//Annual
			$act_annual = $row->act_annual;
			$budget_annual = $row->tot_mst;
			$balance_annual = $budget_annual - $act_annual;
			
			
			#Cek nilai YTD
			$jml = $this->db->select(''.$var.' as total')
							->from('db_mstbgt_update')
							->where('code',$code)
							->where('thn',$thn)
							->where('id_pt',$pt)
							->get()->row_array();
			$hsl = $jml['total'];
			
			$budget_ytd = $hsl;
			$act_ytd = $row->act_ytd;
			$balance_ytd = $budget_ytd - $act_ytd; 		
			#var_dump($budget_ytd."-".$act_annual);exit;
			// Total keseluruhan
			$tot1 = $tot1 + $act_month;
			$tot2 = $tot2 + $budget_month;
			$tot3 = $tot3 + $balance_month;
			$tot4 = $tot4 + $act_ytd;
			$tot5 = $tot5 + $budget_ytd;
			#$tot6 = $tot6 + $balance_ytd;
			$tot7 = $tot7 + $act_annual;
			$tot8 = $tot8 + $budget_annual;
			$tot9 = $tot9 + $balance_annual;
			

			
			#var_dump($month_request);
			if ($no == $max){ 
				$pdf->AddPage();
				$pdf->SetFont('Arial','B',12);
				$pdf->SetXY(25,10);
				$pdf->Cell(0,10,$nama_pt,20,0,'L');
				$pdf->SetFont('Arial','',10);
				$pdf->SetXY(25,15);
				$pdf->Cell(0,10,'Operational Budget Monitoring - " '.$division.' " Division',20,0,'L');
				$pdf->SetXY(25,20);
				$pdf->Cell(0,10,'As of date ( '.$tgl.' )',20,0,'L');
				$pdf->SetFont('Arial','',8);
				$pdf->SetY(45);
				$pdf->SetX(2);
				$pdf->Cell(15,6,'',0,0,'C');
				$pdf->Cell(70,6,'',0,0,'C');
				$pdf->Cell(23,6,'ACTUAL',1,0,'C',1);
				$pdf->Cell(23,6,'BUDGET',1,0,'C',1);
				$pdf->Cell(23,6,'BALANCE',1,0,'C',1);
				$pdf->Cell(23,6,'ACTUAL',1,0,'C',1);
				$pdf->Cell(23,6,'BUDGET',1,0,'C',1);
				$pdf->Cell(23,6,'BALANCE',1,0,'C',1);
				$pdf->Cell(23,6,'ACTUAL',1,0,'C',1);
				$pdf->Cell(23,6,'BUDGET',1,0,'C',1);
				$pdf->Cell(23,6,'BALANCE',1,0,'C',1);
				$pdf->SetY(45);
				$y_axis = $y_axis + $row_height;
				$no=0;
				$pdf->Ln();
			}
			
			$pdf->SetX(2);
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(15,6,$code,1,0,'C');
			$pdf->Cell(70,6,$description,1,0,'L');
			$pdf->Cell(23,6,number_format($act_month,","),1,0,'R');
			$pdf->Cell(23,6,number_format($budget_month,","),1,0,'R');
			$pdf->Cell(23,6,number_format($balance_month,","),1,0,'R');
			$pdf->Cell(23,6,number_format($act_ytd,","),1,0,'R');
			$pdf->Cell(23,6,number_format($budget_ytd,","),1,0,'R');
			$pdf->Cell(23,6,number_format($balance_ytd,","),1,0,'R');
			$pdf->Cell(23,6,number_format($act_annual,","),1,0,'R');
			$pdf->Cell(23,6,number_format($budget_annual,","),1,0,'R');
			$pdf->Cell(23,6,number_format($balance_annual,","),1,0,'R');
			$pdf->Ln();
			$no++;				
		}
		#var_dump($tot4);
		$tot6 = $tot5 - $tot4;
		$pdf->SetX(2);
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(85,6,'Total :',1,0,'R');
		$pdf->SetFont('Arial','B',6);
		$pdf->Cell(23,6,number_format($tot1,","),1,0,'R');
		$pdf->Cell(23,6,number_format($tot2,","),1,0,'R');
		$pdf->Cell(23,6,number_format($tot3,","),1,0,'R');
		$pdf->Cell(23,6,number_format($tot4,","),1,0,'R');
		$pdf->Cell(23,6,number_format($tot5,","),1,0,'R');
		$pdf->Cell(23,6,number_format($tot6,","),1,0,'R');
		$pdf->Cell(23,6,number_format($tot7,","),1,0,'R');
		$pdf->Cell(23,6,number_format($tot8,","),1,0,'R');
		$pdf->Cell(23,6,number_format($tot9,","),1,0,'R');
		$pdf->Output();	
	}
}
