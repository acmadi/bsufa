<?php
Class print_divisi extends controller{
	
	function __construct(){
		parent::controller();
		$this->load->Model('printrequest_model','printrequest');
	}
	
	function index(){
		//check session
		extract(PopulateForm());
		$session_id = $this->UserLogin->isLogin();
		$pt = $session_id['id_pt'];	
		$parent = $session_id['id_parent'];	
	
		$arr = array("","bgt1","bgt2","bgt3","bgt4","bgt5","bgt6","bgt7","bgt8","bgt9","bgt10","bgt11","bgt12");
		//$tgl = $this->input->post('tgl');
		$path = substr($tgl,3,2);
		//$thn = substr($tgl,6,4);
		$i = str_replace("0","",substr($tgl,3,2));
		$bln = $arr[$i];
		list($d1,$m1,$y1) = split('-',$tgl); 
		$dt1 = $m1.'/'.$d1.'/'.$y1;
		//var_dump($thn);exit;
		$data_pt = $this->printrequest->get_nama_pt($pt);
		$nama_pt = "PT \t".$data_pt['ket'];
		#die($nama_pt);
		

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
		
		//Data Divisi	
		$data = $this->printrequest->get_data_divisi($stringmonth,$thn,$pt,$dt1);
		
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

	
	
		require('fpdf/classreport.php');
		$pdf=new PDF('L','mm','A4');
		$pdf->SetMargins(2,10,2);
		$pdf->AliasNbPages();
		$pdf->AddPage();
		#header
		$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
		$pdf->SetFont('Arial','B',14);
		$pdf->SetXY(25,10);
		$pdf->Cell(0,10,$nama_pt,20,0,'L');
		$pdf->SetFont('Arial','',10);
		$judul = "As Of \t".$stringmonth;
		$pdf->SetFont('Arial','B',12);
		$pdf->SetXY(25,16);
		$pdf->Cell(0,10,'Operational Budget Monitoring - All Division',20,0,'L');
		$pdf->SetFont('Arial','B',10);
		$pdf->SetXY(25,22);
		$pdf->Cell(0,10,'As of date ( '.$tgl.' )',20,0,'L');
		
		
		$pdf->SetFont('Arial','',10);
		$pdf->setFillColor(222,222,222);
		$pdf->SetXY(5,38);		
		$pdf->Cell(55,13,'DIVISION',1,0,'C',1);
		$pdf->SetXY(60,38);
		$pdf->Cell(75,7,'THIS MONTH',1,0,'C',1);
		$pdf->SetXY(135,38);
		$pdf->Cell(75,7,'YTD',1,0,'C',1);
		$pdf->SetXY(210,38);
		$pdf->Cell(75,7,'ANNUAL',1,0,'C',1);		
		#end header
		
		
		$y_axis_initial = 45;
		$y_axis = 0;
		$pdf->setFillColor(222,222,222);
		$pdf->SetY($y_axis_initial);
		$pdf->SetFont('Arial','',8);
		$pdf->SetX(5);
		$pdf->Cell(55,6,'',0,0,'C');
		$pdf->Cell(25,6,'BUDGET',1,0,'C',1);
		$pdf->Cell(25,6,'ACTUAL',1,0,'C',1);
		$pdf->Cell(25,6,'AVAILABLE',1,0,'C',1);
		$pdf->Cell(25,6,'BUDGET',1,0,'C',1);
		$pdf->Cell(25,6,'ACTUAL',1,0,'C',1);
		$pdf->Cell(25,6,'AVAILABLE',1,0,'C',1);
		$pdf->Cell(25,6,'BUDGET',1,0,'C',1);
		$pdf->Cell(25,6,'ACTUAL',1,0,'C',1);
		$pdf->Cell(25,6,'AVAILABLE',1,0,'C',1);
		$pdf->Ln();
		
		$max=22;
		$row_height = 6;
		$y_axis = $y_axis + $row_height;
		$no=0;
        
		$a = 1;
		$total1 = 0;
		$total2 = 0;
		$total3 = 0;
		$total4 = 0;
		$total5 = 0;
		$total6 = 0;
		$total7 = 0;
		$total8 = 0;
		$total9 = 0;
		foreach($data as $row){	
			$division = $row->divisi_nm;
			$id_divisi = $row->divisi_id;
			//Monthly
			$month_budget = $row->$bln;
			$month_actual = $row->actual_month; 
			$month_avaliable = $month_budget - $month_actual;
			
			//YTD
			$jml = $this->db->select('divisi_id,'.$var.' as total')
							->from('db_mstbgt_update')
							->where('divisi_id',$id_divisi)
							->where('thn',$thn)
							->where('id_pt',$pt)
							->group_by('divisi_id')
							->get()->row_array();
			$hsl = $jml['total'];
			$ytd_budget = $hsl;
			$ytd_actual = $row->actual_ytd;
			$ytd_avaliable = $ytd_budget - $ytd_actual;

			
			
			//Annual
			$annual_budget = $row->annual_budget;
			$annual_actual = $row->annual_actual;
			$annual_avaliable = $annual_budget - $annual_actual;
			//var_dump($annual_actual);exit;
			//Total all
			$total1 = $total1 + $month_budget;
			$total2 = $total2 + $month_actual;
			$total3 = $total3 + $month_avaliable;
			$total4 = $total4 + $ytd_budget;
			$total5 = $total5 + $ytd_actual;
			$total6 = $total6 + $ytd_avaliable;
			$total7 = $total7 + $annual_budget;
			$total8 = $total8 + $annual_actual;
			$total9 = $total9 + $annual_avaliable;
			
			if ($no == $max){ 
				$pdf->AddPage();
				#header
				$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',12);
				$pdf->SetXY(25,10);
				$pdf->Cell(0,10,$nama_pt,20,0,'L');
				$pdf->SetFont('Arial','',10);
				$judul = "As Of \t".$stringmonth;
				$pdf->SetXY(25,15);
				$pdf->Cell(0,10,'Operational Budget Monitoring - All Division',20,0,'L');
				$pdf->SetXY(25,20);
				$pdf->Cell(0,10,'Tahun : '.$thn,20,0,'L');
				$pdf->SetXY(25,25);
				$pdf->Cell(0,10,'As of date ( '.$tgl.' )',20,0,'L');
		
				$pdf->SetFont('Arial','',10);
				$pdf->setFillColor(222,222,222);
				$pdf->SetXY(5,38);		
				$pdf->Cell(55,13,'DIVISION',1,0,'C',1);
				$pdf->SetXY(60,38);
				$pdf->Cell(75,7,'THIS MONTH',1,0,'C',1);
				$pdf->SetXY(135,38);
				$pdf->Cell(75,7,'YTD',1,0,'C',1);
				$pdf->SetXY(210,38);
				$pdf->Cell(75,7,'ANNUAL',1,0,'C',1);		
				#end header
				
				$pdf->SetFont('Arial','',8);
				$pdf->SetY(45);
				$pdf->SetX(5);
				$pdf->Cell(55,6,'',0,0,'C');
				$pdf->Cell(25,6,'BUDGET',1,0,'C',1);
				$pdf->Cell(25,6,'ACTUAL',1,0,'C',1);
				$pdf->Cell(25,6,'AVAILABLE',1,0,'C',1);
				$pdf->Cell(25,6,'BUDGET',1,0,'C',1);
				$pdf->Cell(25,6,'ACTUAL',1,0,'C',1);
				$pdf->Cell(25,6,'AVAILABLE',1,0,'C',1);
				$pdf->Cell(25,6,'BUDGET',1,0,'C',1);
				$pdf->Cell(25,6,'ACTUAL',1,0,'C',1);
				$pdf->Cell(25,6,'AVAILABLE',1,0,'C',1);
				$pdf->SetY(45);
				$y_axis = $y_axis + $row_height;
				$no=0;
				$pdf->Ln();
			}
			$pdf->SetX(5);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(55,6,$division,1,0,'L');
			$pdf->Cell(25,6,number_format($month_budget,","),1,0,'R');
			$pdf->Cell(25,6,number_format($month_actual,","),1,0,'R');
			$pdf->Cell(25,6,number_format($month_avaliable,","),1,0,'R');
			$pdf->Cell(25,6,number_format($ytd_budget,","),1,0,'R');
			$pdf->Cell(25,6,number_format($row->actual_ytd,","),1,0,'R');
			$pdf->Cell(25,6,number_format($ytd_avaliable,","),1,0,'R');
			$pdf->Cell(25,6,number_format($annual_budget,","),1,0,'R');
			$pdf->Cell(25,6,number_format($annual_actual,","),1,0,'R');
			$pdf->Cell(25,6,number_format($annual_avaliable,","),1,0,'R');
			$pdf->Ln();
			$no++;				
		}
		$pdf->SetX(5);
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(55,6,'TOTAL :',1,0,'L');
		$pdf->Cell(25,6,number_format($total1,","),1,0,'R');
		$pdf->Cell(25,6,number_format($total2,","),1,0,'R');
		$pdf->Cell(25,6,number_format($total3,","),1,0,'R');
		$pdf->Cell(25,6,number_format($total4,","),1,0,'R');
		$pdf->Cell(25,6,number_format($total5,","),1,0,'R');
		$pdf->Cell(25,6,number_format($total6,","),1,0,'R');
		$pdf->Cell(25,6,number_format($total7,","),1,0,'R');
		$pdf->Cell(25,6,number_format($total8,","),1,0,'R');
		$pdf->Cell(25,6,number_format($total9,","),1,0,'R');

        $thn2 = substr($tgl,6,4);
        if($thn != $thn2) echo"PDF error Cek Tahun dan As Off";
        else $pdf->Output();
					
	}
}
