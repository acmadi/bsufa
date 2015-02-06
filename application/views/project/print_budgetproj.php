<?php

		
			require('fpdf/tanpapage.php');
			extract(PopulateForm());
			$pdf=new PDF('L','mm','A4');
			
			$pdf->SetMargins(4,10,4);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEADER CONTENT
				$pt		= "PT. Graha Multi Insani";
				$periode	= "Periode";
				$judul = "Request Budget vs Budget";
	
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
			
			#$month1 = date( 'F', mktime(0, 0, 0, $periode1));		
			#$month2 = date( 'F', mktime(0, 0, 0, $periode2));		
					
			#Header
				$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'As Of'.' : '. ' ',20,0,'L');
		
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
			
			// Start Isi Tabel
			
			
							
			$pdf->SetX(6);
			
			
			$pdf->SetFont('Arial','B',9);
				
			
			
			$pdf->Ln(4);
			
			$pdf->Cell(60,10,'Budget Project Description',1,0,'C',1);
			$pdf->Cell(75,5,'This Month',1,0,'C',1);
			$pdf->Cell(75,5,'YTD',1,0,'C',1);
			$pdf->Cell(75,5,'Year End',1,0,'C',1);
			
			
			$pdf->Ln(5);
					
			$pdf->Cell(60,0,'',0,0,'R',0);
			$pdf->Cell(25,5,'Budget',1,0,'C',1);
			$pdf->Cell(25,5,'Actual',1,0,'C',1);
			$pdf->Cell(25,5,'Varian',1,0,'C',1);
			$pdf->Cell(25,5,'Budget',1,0,'C',1);
			$pdf->Cell(25,5,'Actual',1,0,'C',1);
			$pdf->Cell(25,5,'Varian',1,0,'C',1);
			$pdf->Cell(25,5,'Budget',1,0,'C',1);
			$pdf->Cell(25,5,'Actual',1,0,'C',1);
			$pdf->Cell(25,5,'Varian',1,0,'C',1);
			
			
		
			$pdf->SetFont('Arial','',9);
			
			$i = 1;	
			$no = 0;
			$max = 28;	
			$pdf->Ln(5);
			
					
			
	for($i = 1;$i <= 200; $i++){
		if($no == $max){ 
			$pdf->AddPage();
			//				
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#HEADER CONTENT
				$pt		= "PT. Graha Multi Insani";
				$periode	= "Periode";
				$judul = "Request Budget vs Budget";
	
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
			
			#$month1 = date( 'F', mktime(0, 0, 0, $periode1));		
			#$month2 = date( 'F', mktime(0, 0, 0, $periode2));		
					
			#Header
				$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'As Of'.' : '. '',20,0,'L');
			
			$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
			
			
			$pdf->SetX(2);
			
			
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(4);
			$pdf->Cell(60,10,'Budget Project Description',1,0,'C',1);
			$pdf->Cell(75,5,'This Month',1,0,'C',1);
			$pdf->Cell(75,5,'YTD',1,0,'C',1);
			$pdf->Cell(75,5,'Year End',1,0,'C',1);
			
			
			$pdf->Ln(5);
					
			$pdf->Cell(60,0,'',0,0,'R',0);
			$pdf->Cell(25,5,'Budget',1,0,'C',1);
			$pdf->Cell(25,5,'Actual',1,0,'C',1);
			$pdf->Cell(25,5,'Varian',1,0,'C',1);
			$pdf->Cell(25,5,'Budget',1,0,'C',1);
			$pdf->Cell(25,5,'Actual',1,0,'C',1);
			$pdf->Cell(25,5,'Varian',1,0,'C',1);
			$pdf->Cell(25,5,'Budget',1,0,'C',1);
			$pdf->Cell(25,5,'Actual',1,0,'C',1);
			$pdf->Cell(25,5,'Varian',1,0,'C',1);
			$pdf->Ln(5);
			$no = 0;
	
			
		}
		
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(60,5,'Tes',1,0,'L',0);
			$pdf->Cell(25,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(25,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(25,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(25,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(25,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(25,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(25,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(25,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(25,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Ln(5);				
			$i++;
			$no++;
		
	}
	/*
			$pdf->SetFont('Arial','B',6);
			$pdf->Cell(20,5,'Date',1,0,'C',1);
			$pdf->Cell(28,5,'No',1,0,'C',1);
			$pdf->Cell(20,5,'Date',1,0,'C',1);
			$pdf->Cell(28,5,'No',1,0,'C',1);
			$pdf->Cell(60,5,'',0,0,'R',0);
			$pdf->Cell(80,5,'',0,0,'R',0);
			$pdf->Cell(17,5,'',0,0,'R',0);
			$pdf->Cell(23,5,'',0,0,'R',0);
		*/	
			$pdf->Output("hasil.pdf","I");	;
	
