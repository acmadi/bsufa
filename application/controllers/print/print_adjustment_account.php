<?php
class print_adjustment_account extends controller{
	function index(){
		extract(PopulateForm());
		//Cek nama PT
		$session_id = $this->UserLogin->isLogin();
		$pt = $session_id['id_pt'];				
		$data_pt = $this->mstmodel->get_nama_pt($pt);
		$nama_pt = "PT \t".$data_pt['ket'];

		//~ list($d1,$m1,$y1) = split("-",$tgl1);
		//~ $tglawal  = $y1."-".$m1."-".$d1; 
		$arrbgt = array("","bgt1","bgt2","bgt3","bgt4","bgt5","bgt6","bgt7",
		"bgt8","bgt9","bgt10","bgt11","bgt12");
		
		//Data untuk di Looping
		$data = $this->mstmodel->adjustment_item($code,$thn);
		$dtbgt = $this->mstmodel->cekmstbudget($code,$thn);
		if($dtbgt > 0){
			$dtbgt = $this->mstmodel->getmstbudget($code,$thn,$pt);
			$tot = $dtbgt->tot_mst;
			$descbgt = $dtbgt->descbgt;	
		}else{
			die("Data Not Found");
		}



			
		
		require('fpdf/classreport.php');
		$pdf=new PDF('L','mm','A4');
		$pdf->SetMargins(2,10,2);
		$pdf->AliasNbPages();
		$pdf->AddPage();
				
		#header
		$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);
		$pdf->setFillColor(222,222,222);
		$pdf->SetXY(25,10);
		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(50,6,$nama_pt,2,0,'L');
		$pdf->SetXY(25,16);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(50,6,'Mutasi Adjustment Budget  '.$thn,2,0,'L');
		$pdf->SetXY(25,22);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(30,6,'Code',2,0,'L');
		$pdf->Cell(10,6,':',2,0,'C');
		$pdf->Cell(30,6,$code,2,0,'L');
		$pdf->SetXY(25,28);
		$pdf->Cell(30,6,'Description',2,0,'L');
		$pdf->Cell(10,6,':',2,0,'C');
		$pdf->Cell(30,6,$descbgt,2,0,'L');
		$pdf->SetXY(25,34);
		$pdf->Cell(30,6,'Amount',2,0,'L');
		$pdf->Cell(10,6,':',2,0,'C');
		$pdf->Cell(30,6,number_format($tot),2,0,'L');
		$pdf->SetXY(25,40);
		$pdf->Cell(30,6,'As Off',2,0,'L');
		$pdf->Cell(10,6,':',2,0,'C');
		$pdf->Cell(30,6,'',2,0,'L');
		/*$pdf->SetXY(25,35);
		$pdf->Cell(30,6,'Tahun',2,0,'L');
		$pdf->Cell(10,6,':',2,0,'C');
		$pdf->Cell(30,6,$thn,2,0,'L');*/		
		#end header
		
		//$pdf->SetLineWidth(0.5);
		//$pdf->Line(5,40,500,40);
		$y_axis_initial = 50;
		$y_axis = 0;
		$pdf->SetFont('Arial','',10);
		$pdf->setFillColor(222,222,222);
		$pdf->SetY($y_axis_initial);
		$pdf->SetX(5);
		$pdf->Cell(15,6,'No',1,0,'C',1);
		$pdf->Cell(50,6,'Adjustment Date',1,0,'C',1);
		$pdf->Cell(50,6,'Budget Month',1,0,'C',1);
		$pdf->Cell(50,6,'Adjustment',1,0,'C',1);
		$pdf->Cell(50,6,'Current Budget',1,0,'C',1);
		$pdf->Ln();	
		$max=35;
		$row_height = 6;
		$y_axis = $y_axis + $row_height;
		$no=0;
		$totreal = 0;
		$jml = 0;
		
		$montharr = array
		(
			'bgt1'=>'January',
			'bgt2'=>'February',
			'bgt3'=>'March',
			'bgt4'=>'April',
			'bgt5'=>'Mai',
			'bgt6'=>'June',
			'bgt7'=>'July',
			'bgt8'=>'August',
			'bgt9'=>'September',
			'bgt10'=>'October',
			'bgt11'=>'November',
			'bgt12'=>'December'
			
		);
		foreach($data as $row){
			if ($no == $max){
				#header
				$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);
				$pdf->setFillColor(222,222,222);
				$pdf->SetFont('Arial','B',14);
				$pdf->SetXY(25,10);
				$pdf->Cell(50,6,'Mutasi Realisasi Budget',2,0,'L');
				$pdf->SetFont('Arial','B',10);
				$pdf->SetXY(25,15);
				$pdf->Cell(30,6,'Code Budget',2,0,'L');
				$pdf->Cell(10,6,':',2,0,'C');
				$pdf->Cell(30,6,$code,2,0,'L');
				$pdf->SetXY(25,20);
				$pdf->Cell(30,6,'Desc Budget',2,0,'L');
				$pdf->Cell(10,6,':',2,0,'C');
				$pdf->Cell(30,6,$dtbgt->descbgt,2,0,'L');
				$pdf->SetXY(25,25);
				$pdf->Cell(30,6,'Amount Budget',2,0,'L');
				$pdf->Cell(10,6,':',2,0,'C');
				$pdf->Cell(30,6,number_format($tot),2,0,'L');
				$pdf->SetXY(25,30);
				$pdf->Cell(30,6,'As Off',2,0,'L');
				$pdf->Cell(10,6,':',2,0,'C');
				$pdf->Cell(30,6,'',2,0,'L');
				$pdf->SetXY(25,35);
				$pdf->Cell(30,6,'Tahun',2,0,'L');
				$pdf->Cell(10,6,':',2,0,'C');
				$pdf->Cell(30,6,$thn,2,0,'L');		
				#end header
		
				//$pdf->SetLineWidth(0.5);
				//$pdf->Line(5,40,500,40);
				$y_axis_initial = 50;
				$y_axis = 0;
				$pdf->SetFont('Arial','',10);
				$pdf->setFillColor(222,222,222);
				$pdf->SetY($y_axis_initial);
				$pdf->SetX(5);
				$pdf->Cell(15,6,'No',1,0,'C',1);
				$pdf->Cell(50,6,'Date',1,0,'C',1);
				$pdf->Cell(50,6,'Month',1,0,'C',1);
				$pdf->Cell(50,6,'Adjustment',1,0,'C',1);
				$pdf->Cell(50,6,'Balanced',1,0,'C',1);
				$pdf->Ln();	
				$row_height = 6;
				$y_axis = $y_axis + $row_height;
				$no=0;				
				}
			$no++;
			$mutasi = $row->mutasi;
			$real = $row->amount;
			
			if($mutasi =='C'){
				$totreal = $totreal + $real;
				$jml = $tot + $totreal;
				$adj = number_format($real);
			}else{
				$totreal = $totreal - $real;
				$jml = $tot - $totreal;
				$adj = "(".number_format($real).")";
			}
			
			$arr = $row->monthbgt;
			$month = $montharr[$arr];
			//$last_id = $row->id_trbgt;
			$pdf->SetFont('Arial','B',8);
			$pdf->SetX(5);
			$pdf->Cell(15,6,$no,2,0,'C');
			$pdf->Cell(50,6,indo_date($row->tanggal),2,0,'C');
			$pdf->Cell(50,6,$month,2,0,'C');
			$pdf->Cell(50,6,$adj,2,0,'R');
			$pdf->Cell(50,6,number_format($jml),2,0,'R');
			$pdf->Ln();		
		}
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetX(5);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(50,6,'Original Amount',2,0,'L');
		$pdf->Cell(15,6,':',2,0,'L');
		$pdf->Cell(15,6,number_format($tot),2,0,'L');
		$pdf->Ln();
		$pdf->SetX(5);
		$pdf->Cell(50,6,'Current Amount',2,0,'L');
		$pdf->Cell(15,6,':',2,0,'L');
		$pdf->Cell(15,6,number_format($jml),2,0,'L');
		$pdf->Ln();
		$pdf->SetX(5);
		$pdf->Cell(50,6,'Total Adjustment Amount',2,0,'L');
		$pdf->Cell(15,6,':',2,0,'L');
		$pdf->Cell(15,6,number_format($totreal),2,0,'L');

		
		/*$pdf->Cell(270,0,'',1,0,'L');
		$pdf->SetX(5);		
		$pdf->Cell(65,6,'Total',2,0,'L');
		$pdf->Cell(100,6,number_format($totreal),2,0,'R');
		$pdf->Cell(50,6,number_format($jml),2,0,'R');*/
        //~ $thn2 = substr($tgl1,6,4);
        //~ if($thn != $thn2) echo"PDF error Cek Tahun dan As Off";
        $pdf->Output();

	}
}


