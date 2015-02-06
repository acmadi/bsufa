<?php
	#die('tes');
	require('fpdf/classpdf.php');
	$pdf=new PDF('L','mm','A4');
	$pdf->SetMargins(2,10,2);
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',14);
	$pdf->SetMargins(2,10,2);
		
						
	#HEADER 
	$judul 		= "Kartu Hutang Kontraktor/Supplier";
	$periode	= "As Off";
	$date		= "24 January 2012";
	$project	= "XXX";
	$angka		= "100000000000000";
	$contractor	= "PT. Pandega Design Weharima";
	$job		= "Pembuatan maket Skala 1:100 dan skala 1:200";
	
	#CETAK TANGGAL
	$tgl  = date("d-m-Y");
	#TANGGAL CETAK
			$pdf->SetFont('Arial','',6);
			$pdf->SetXY(258,10);
			$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							
			$pdf->SetXY(268,10);
			$pdf->Cell(2,4,':',4,0,'L');
								
			$pdf->SetXY(269,10);
			$pdf->Cell(10,4,$tgl,0,0,'L');
			
	#$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
	$pdf->SetFont('Arial','B',12);
	$pdf->SetX(25);
	$pdf->Cell(0,10,'PT. XXX',20,0,'L');
	$pdf->Ln(8);
	
	$pdf->SetFont('Arial','',11);
	$pdf->SetX(25);
	$pdf->Cell(0,5,'Project '.$project,20,0,'L');
	$pdf->Ln(5);
	
	$pdf->SetFont('Arial','',9);
	$pdf->SetX(25);
	$pdf->Cell(0,5,$judul,20,0,'L');
	$pdf->Ln(5);
	
	$pdf->SetFont('Arial','',8);
	$pdf->SetX(25);
	$pdf->Cell(27,5,'Contractor/Supplier : ',0,0,'L');
	$pdf->Cell(10,5,$contractor,20,0,'L');
	$pdf->Ln(5);
	
	$pdf->SetFont('Arial','',8);
	$pdf->SetX(25);
	$pdf->Cell(10,5,$periode.' : ',0,0,'L');
	$pdf->Cell(10,5,$date,20,0,'L');
	$pdf->Ln(10);
	
	$pdf->Cell(0,0,'',1,10,'L',1);		
	$pdf->Ln(5);
	
	
	#TABLE HEADER
	$pdf->SetFont('Arial','B',8);
	$pdf->setFillColor(222,222,222);
	$pdf->SetX(5);
	$pdf->Cell(25,10,'Date',1,0,'C',1);
	$pdf->Cell(30,10,'A/P. No',1,0,'C',1);
	$pdf->Cell(30,10,'Doc. No',1,0,'C',1);
	$pdf->Cell(110,10,'Description',1,0,'C',1);
	$pdf->Cell(30,10,'Debet',1,0,'C',1);
	$pdf->Cell(30,10,'Credit',1,0,'C',1);
	$pdf->Cell(30,10,'Saldo',1,0,'C',1);
	
	$pdf->Ln(10);
	
	$no = 1;
	$pdf->SetX(5);
	for($i = 1;$i <= 60; $i++){
			
			#PAGE HEADER SELANJUTNYA
			#$no = 1;
			$max = 18;
				if($no == $max){
						#HEADER TOP
						$pdf->AddPage();
							$pdf->SetFont('Arial','B',14);
							$pdf->SetMargins(2,10,2);
								
												
							#HEADER 
							$judul 		= "Kartu Hutang Kontraktor/Supplier";
							$periode	= "As Off";
							$date		= "24 January 2012";
							$project	= "XXX";
							$angka		= "100000000000000";
							$contractor	= "PT. Pandega Design Weharima";
							$job		= "Pembuatan maket Skala 1:100 dan skala 1:200";
							
							#CETAK TANGGAL
							$tgl  = date("d-m-Y");
							#TANGGAL CETAK
									$pdf->SetFont('Arial','',6);
									$pdf->SetXY(258,10);
									$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
													
									$pdf->SetXY(268,10);
									$pdf->Cell(2,4,':',4,0,'L');
														
									$pdf->SetXY(269,10);
									$pdf->Cell(10,4,$tgl,0,0,'L');
									
							#$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
							$pdf->SetFont('Arial','B',12);
							$pdf->SetX(25);
							$pdf->Cell(0,10,'PT. XXX',20,0,'L');
							$pdf->Ln(8);
							
							$pdf->SetFont('Arial','',11);
							$pdf->SetX(25);
							$pdf->Cell(0,5,'Project '.$project,20,0,'L');
							$pdf->Ln(5);
							
							$pdf->SetFont('Arial','',9);
							$pdf->SetX(25);
							$pdf->Cell(0,5,$judul,20,0,'L');
							$pdf->Ln(5);
							
							$pdf->SetFont('Arial','',8);
							$pdf->SetX(25);
							$pdf->Cell(27,5,'Contractor/Supplier : ',0,0,'L');
							$pdf->Cell(10,5,$contractor,20,0,'L');
							$pdf->Ln(5);
							
							$pdf->SetFont('Arial','',8);
							$pdf->SetX(25);
							$pdf->Cell(10,5,$periode.' : ',0,0,'L');
							$pdf->Cell(10,5,$date,20,0,'L');
							$pdf->Ln(10);
							
							$pdf->Cell(0,0,'',1,10,'L',1);		
							$pdf->Ln(5);
						
								#$no = 0;
								
								#TABLE HEADER
								$pdf->SetFont('Arial','B',8);
								$pdf->setFillColor(222,222,222);
								$pdf->SetX(5);
								$pdf->Cell(25,10,'Date',1,0,'C',1);
								$pdf->Cell(30,10,'A/P. No',1,0,'C',1);
								$pdf->Cell(30,10,'Doc. No',1,0,'C',1);
								$pdf->Cell(110,10,'Description',1,0,'C',1);
								$pdf->Cell(30,10,'Debet',1,0,'C',1);
								$pdf->Cell(30,10,'Credit',1,0,'C',1);
								$pdf->Cell(30,10,'Saldo',1,0,'C',1);
								
								$pdf->Ln(10);
						
							$no = 0;		
								
						}	
					$pdf->SetX(5);
					$pdf->Cell(25,7,$date,1,0,'C');
					$pdf->Cell(30,7,'AP0000000',1,0,'L');
					$pdf->Cell(30,7,'BK0000000',1,0,'L');
					$pdf->Cell(110,7,'Description',1,0,'L');
					$pdf->Cell(30,7,number_format($angka),1,0,'C');
					$pdf->Cell(30,7,number_format($angka),1,0,'C');
					$pdf->Cell(30,7,number_format($angka),1,0,'C');
					$pdf->Ln(7);
					$no++;
			
	}
	
	$pdf->SetFont('Arial','B',7);
	$pdf->setFillColor(222,222,222);
	$pdf->SetX(5);
	$pdf->Cell(195,8,'T O T A L',1,0,'R',1);
	$pdf->Cell(30,8,number_format($angka),1,0,'R',1);
	$pdf->Cell(30,8,number_format($angka),1,0,'R',1);
	$pdf->Cell(30,8,number_format($angka),1,0,'R',1);
	
	
	
	/*$pdf->SetXY(115,101);
	$pdf->Cell(30,10,'Contract Amount',1,0,'C');
	$pdf->Cell(90,5,'I N V O I C E',1,0,'C');
	$pdf->Cell(30,10,'C T C',1,0,'C');*/
	
	
	
	

	#$pdf->Output("history.pdf","I");		
	$pdf->Output("kontrakstatus.pdf","I");
#redirect($url);

