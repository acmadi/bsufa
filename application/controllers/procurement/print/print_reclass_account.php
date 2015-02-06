<?php
class print_reclass_account extends controller{
	function index(){
		extract(PopulateForm());
		list($d1,$m1,$y1) = split("-",$tgl1);
		$tglawal  = $y1."-".$m1."-".$d1; 
		$arrbgt = array("","bgt1","bgt2","bgt3","bgt4","bgt5","bgt6","bgt7",
		"bgt8","bgt9","bgt10","bgt11","bgt12");

		//Cek nama PT
		$session_id = $this->UserLogin->isLogin();
		$pt = $session_id['id_pt'];				
		$data_pt = $this->mstmodel->get_nama_pt($pt);
		$nama_pt = "PT \t".$data_pt['ket'];

		
		//Data untuk di Looping
		$data = $this->mstmodel->reclass_item($code,$tglawal,$thn);
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
		$pdf->SetFont('Arial','B',14);
		$pdf->SetXY(25,10);
		$pdf->Cell(50,6,$nama_pt,2,0,'L');
		$pdf->SetFont('Arial','B',12);
		$pdf->SetXY(25,16);
		$pdf->Cell(50,6,'Mutasi Reclass Budget  '.$thn,2,0,'L');
		$pdf->SetFont('Arial','B',10);
		$pdf->SetXY(25,22);
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
		$pdf->Cell(30,6,$tgl1,2,0,'L');
		/*$pdf->SetXY(25,35);
		$pdf->Cell(30,6,'Tahun',2,0,'L');
		$pdf->Cell(10,6,':',2,0,'C');
		$pdf->Cell(30,6,$thn,2,0,'L');*/
		$pdf->SetXY(5,50);
		$pdf->Cell(8,5,'No',1,0,'C',1);
		$pdf->Cell(30,5,'Date',1,0,'C',1);
		$pdf->Cell(30,5,'Code',1,0,'C',1);
		$pdf->Cell(70,5,'Description',1,0,'C',1);	
		$pdf->Cell(40,5,'Amount',1,0,'C',1);
		$pdf->Cell(40,5,'Type',1,0,'C',1);
		$pdf->Cell(40,5,'Balanced Budget',1,0,'C',1);
		$pdf->Ln();	
		#end header
		
		//$pdf->SetLineWidth(0.5);
		//$pdf->Line(5,40,500,40);
		$y_axis_initial = 50;
		$y_axis = 0;
		$pdf->SetFont('Arial','',10);
		$pdf->setFillColor(222,222,222);
		$pdf->SetY($y_axis_initial);
		//$pdf->SetX(63);
		//$pdf->Cell(8,5,'No',1,0,'C',1);
		//$pdf->Cell(20,5,'Date',1,0,'C',1);
		//$pdf->Cell(30,5,'Reclass Amount',1,0,'C',1);
		//$pdf->Cell(30,5,'Code',1,0,'C',1);
		//$pdf->Cell(25,5,'Description',1,0,'C',1);
		//$pdf->Cell(30,5,'Amount',1,0,'C',1);
		//$pdf->Cell(30,5,'Code',1,0,'C',1);
		//$pdf->Cell(25,5,'Description',1,0,'C',1);
		//$pdf->Cell(30,5,'Amount',1,0,'C',1);
		//$pdf->Cell(30,5,'Code',1,0,'C',1);
		//$pdf->Cell(25,5,'Description',1,0,'C',1);
		//$pdf->Cell(30,5,'Amount',1,0,'C',1);
		$pdf->Ln();	
		$max=35;
		$row_height = 6;
		$y_axis = $y_axis + $row_height;
		$no=0;
		$totreal = 0;
		$totamount = 0 ;
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
				$pdf->Cell(30,6,$tgl1,2,0,'L');
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
				$pdf->SetY($y_axis_initial);;
				$pdf->SetXY(5);
				$pdf->Cell(8,5,'No',1,0,'C',1);
				$pdf->Cell(30,5,'Date',1,0,'C',1);
				$pdf->Cell(30,5,'Code',1,0,'C',1);
				$pdf->Cell(70,5,'Description',1,0,'C',1);	
				$pdf->Cell(40,5,'Amount',1,0,'C',1);
				$pdf->Cell(40,5,'Type',1,0,'C',1);
				$pdf->Cell(40,5,'Balanced Budget',1,0,'C',1);
				$pdf->Ln();	
				$row_height = 5;
				$y_axis = $y_axis + $row_height;
				$no=0;				
				}
			$no++;
			$real = $row->amount;
			$totreal = $totreal + $real;
			$jml = $tot + $totreal;
			$rowrec = $this->mstmodel->getmstbudget($row->coderec,$thn,$pt);
			$rowupdate = $this->mstmodel->getmstbudgetupdate($row->codeadj,$thn);
			$tot_current = $dtbgt->tot_mst + $real;
			//$last_id = $row->id_trbgt;
			//Get Reclass Code
			if($row->mutasi == 'K'){
				$totamount = $totamount - $row->amount;
				$balanced = $tot - $totamount;
				$rec_amount = "(".number_format($row->amount).")";
				$ket = "Deduction";
				$pdf->SetFont('Arial','B',8);
				$pdf->SetX(5);
				$pdf->Cell(8,5,$no,2,0,'C');
				$pdf->Cell(30,5,indo_date($row->tanggal),2,0,'C');
				$pdf->Cell(30,5,$row->coderec,2,0,'L');
				$pdf->Cell(70,5,$rowrec->descbgt,2,0,'L');
				$pdf->Cell(40,5,$rec_amount,2,0,'R');
				$pdf->Cell(40,5,$ket,2,0,'C');
				$pdf->Cell(40,5,number_format($balanced),2,0,'C');
			}else{
				$ket = "Additional";
				$totamount = $totamount + $row->amount;
				$balanced = $tot + $totamount;
				$rec_amount = number_format($row->amount);
				$pdf->SetFont('Arial','B',8);
				$pdf->SetX(5);
				$pdf->Cell(8,5,$no,2,0,'C');
				$pdf->Cell(30,5,indo_date($row->tanggal),2,0,'C');
				$pdf->Cell(30,5,$row->coderec,2,0,'L');
				$pdf->Cell(70,5,$rowrec->descbgt,2,0,'L');
				$pdf->Cell(40,5,$rec_amount,2,0,'R');
				$pdf->Cell(40,5,$ket,2,0,'C');
				$pdf->Cell(40,5,number_format($balanced),2,0,'C');
				$ket = "Additional";

			}
			
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
		$pdf->Cell(15,6,number_format($balanced),2,0,'L');
		$pdf->Ln();
		$pdf->SetX(5);
		$pdf->Cell(50,6,'Total Reclass Amount',2,0,'L');
		$pdf->Cell(15,6,':',2,0,'L');
		$pdf->Cell(15,6,number_format($totamount),2,0,'L');

        $thn2 = substr($tgl1,6,4);
        if($thn != $thn2) echo"PDF error Cek Tahun dan As Off";
        else $pdf->Output();

	}
}



