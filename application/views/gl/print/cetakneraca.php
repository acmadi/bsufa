<?php
	#die('tes');
	include_once( APPPATH."libraries/translate_currency.php");
	require('fpdf/tanpapage.php');
	$pdf=new PDF('L','mm','A4');
	$pdf->SetMargins(2,10,2);
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',14);
	$pdf->SetMargins(2,10,2);
		
						
	#HEADER 
	$judul 		= "Balanced Sheet";
	$periode	= "As Off";
	$date		= "24 January 2012";
	$date1		= "24 January 2013";
	$project	= "XXX";
	$angka		= "100000000000000";
	$contractor	= "PT. Pandega Design Weharima";
	$job		= "Pembuatan maket Skala 1:100 dan skala 1:200";
	
	$bilangan 	= UcFirst(toRupiah(11200000000));
	
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
	$pdf->Cell(10,5,$periode.' : '.$date,0,0,'L');
	$pdf->Ln(5);
	
	$pdf->Cell(0,1,'','B',0,'R');
	$pdf->Ln(0.7);
	$pdf->Cell(0,1,'','B',0,'R');
	$pdf->Ln(5);
	
	###HEADER DATE####
	$pdf->SetFont('Arial','B',7);
	$pdf->SetX(5);
	$pdf->Cell(85,5,'',20,0,'L');
	$pdf->Cell(25,5,$date,'B'.'T',0,'R',0);
	$pdf->Cell(5,5,'',20,0,'R');
	$pdf->Cell(25,5,$date1,'B'.'T',0,'R',0);
	
	$pdf->Cell(5,5,'',20,0,'R');
	$pdf->Cell(85,5,'',20,0,'L');
	$pdf->Cell(25,5,$date,'B'.'T',0,'R',0);
	$pdf->Cell(5,5,'',20,0,'R');
	$pdf->Cell(25,5,$date1,'B'.'T',0,'R',0);
	
	$pdf->Ln(5);
	
	##ASSETS###
	$pdf->SetX(5);
	$pdf->Cell(145,5,'ASSETS',20,0,'L');
	$pdf->Cell(85,5,'LIABILITIES',20,0,'L');
	$pdf->Ln(5);
	
	$pdf->SetX(7);
	$pdf->Cell(145,5,'Current Assets',20,0,'L');
	$pdf->Cell(83,5,'Current Liabilities',20,0,'L');
	$pdf->Ln(4);
		for($i=0;$i < 1; $i++){
				$pdf->SetFont('Arial','',7);
				$pdf->SetX(9);
				$pdf->Cell(81,5,'Cash on Hand & Bank',20,0,'L');
				$pdf->Cell(25,5,number_format($angka),20,0,'R');
				$pdf->Cell(30,5,number_format($angka),20,0,'R');
				$pdf->Cell(9,5,'',20,0,'R');
				$pdf->Cell(81,5,'Loan Short Term',20,0,'L');
				$pdf->Cell(25,5,number_format($angka),20,0,'R');
				$pdf->Cell(30,5,number_format($angka),20,0,'R');
				$pdf->Ln(4);
				
				
				$pdf->SetX(9);
				$pdf->Cell(81,5,'Time Deposit',20,0,'L');
				$pdf->Cell(25,5,number_format($angka),20,0,'R');
				$pdf->Cell(30,5,number_format($angka),20,0,'R');
				
				$pdf->SetFont('Arial','B',7);
				$pdf->Cell(9,5,'',20,0,'R');
				$pdf->Cell(81,5,'Account Payable',20,0,'L');
				$pdf->Ln(4);
				
				$pdf->SetX(9);
				$pdf->Cell(147,5,'Account Receivable',20,0,'L');
				
				$pdf->SetFont('Arial','',7);
				$pdf->Cell(79,5,'Account Payable Trade',20,0,'L');
				$pdf->Cell(25,5,number_format($angka),20,0,'R');
				$pdf->Cell(30,5,number_format($angka),20,0,'R');
				$pdf->Ln(4);
				
				$pdf->SetX(11);
				$pdf->Cell(79,5,'Account Receivable Trade',20,0,'L');
				$pdf->Cell(25,5,number_format($angka),20,0,'R');
				$pdf->Cell(30,5,number_format($angka),20,0,'R');
				$pdf->Cell(11,5,'',20,0,'R');
				$pdf->Cell(79,5,'Account Payable Afiliasi',20,0,'L');
				$pdf->Cell(25,5,number_format($angka),20,0,'R');
				$pdf->Cell(30,5,number_format($angka),20,0,'R');
				$pdf->Ln(4);
				
				
				$pdf->SetX(11);
				$pdf->Cell(79,5,'Account Receivable Afiliasi',20,0,'L');
				$pdf->Cell(25,5,number_format($angka),20,0,'R');
				$pdf->Cell(30,5,number_format($angka),20,0,'R');
				$pdf->Cell(11,5,'',20,0,'R');
				$pdf->Cell(79,5,'Account Payable Others',20,0,'L');
				$pdf->Cell(25,5,number_format($angka),20,0,'R');
				$pdf->Cell(30,5,number_format($angka),20,0,'R');
				
				
				
		}
	$pdf->Ln(8);
	$pdf->SetFont('Arial','B',7);
		
	$pdf->SetX(5);
	$pdf->Cell(85,5,'TOTAL ASSETS',20,0,'C');
	$pdf->Cell(25,5,number_format($angka),'B'.'T',0,'R',0);
	$pdf->Cell(5,5,'',20,0,'R');
	$pdf->Cell(25,5,number_format($angka),'B'.'T',0,'R',0);
	
	$pdf->Cell(5,5,'',20,0,'R');
	$pdf->Cell(85,5,'TOTAL LIABILITIES & EQUITY',20,0,'C');
	$pdf->Cell(25,5,number_format($angka),'B'.'T',0,'R',0);
	$pdf->Cell(5,5,'',20,0,'R');
	$pdf->Cell(25,5,number_format($angka),'B'.'T',0,'R',0);
	
	$pdf->Ln(5.7);
	$pdf->Cell(88,5,'',20,0,'R');
	$pdf->Cell(25,5,'','T',0,'R');
	$pdf->Cell(5,5,'',20,0,'R');
	$pdf->Cell(25,5,'','T',0,'R');

	$pdf->Cell(90,5,'',20,0,'R');
	$pdf->Cell(25,5,'','T',0,'R');
	$pdf->Cell(5,5,'',20,0,'R');
	$pdf->Cell(25,5,'','T',0,'R');

	$pdf->Ln(10);
	$pdf->Cell(0,1,'','B',0,'R');
	$pdf->Ln(0.7);
	$pdf->Cell(0,1,'','B',0,'R');
	$pdf->Ln(5);
	
	
	#$pdf->Output("history.pdf","I");		
	$pdf->Output("kontrakstatus.pdf","I");
#redirect($url);

