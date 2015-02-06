<?php

		
			require('fpdf/tanpapage.php');
			extract(PopulateForm());
			$pdf=new PDF('L','mm','A4');
			
			$pdf->SetMargins(20,0,0,5);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEADER CONTENT
				$pt			= "Bakri Swasakti Utama";
				$judul 		= "Summary A/P Vendor";
				$periode	= "Periode";
	
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
			
			#Header
				$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'As Of'.' : '. ' s/d ',20,0,'L');
		
				$pdf->Ln(10);
				
				$pdf->Cell(268,0,'',1,0,'L');
			// Start Isi Tabel
			
			
			$pdf->SetX(6);
			$pdf->SetFont('Arial','B',9);
			$pdf->Ln(4);
			
			$pdf->Cell(8,10,'No',1,0,'C',1);
			$pdf->Cell(80,10,'VENDOR',1,0,'C',1);
			$pdf->Cell(60,10,'TOTAL',1,0,'C',1);
			
		
			$pdf->SetFont('Arial','',6);
			
			$i = 1;	
			$no = 0;
			$max = 28;	
			$pdf->Ln(10);
			
					
			
	for($i = 1;$i <= 200; $i++){
		if($no == $max){ 
			$pdf->AddPage();
			//				
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#HEADER CONTENT
				$pt		= "PT. Bumi Daya Makmur";
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
				$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'As Of'.' : '. ' s/d ',20,0,'L');
			
			$pdf->Ln(10);
				
				$pdf->Cell(268,0,'',1,0,'L');
			
			$pdf->SetX(2);
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(4);
			$pdf->Cell(8,10,'No',1,0,'C',1);
			$pdf->Cell(80,10,'VENDOR',1,0,'C',1);
			$pdf->Cell(60,10,'TOTAL',1,0,'C',1);
			
			$pdf->Ln(10);
			$no = 0;
	
			
		}
		
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(8,5,$i,1,0,'C',0);
			$pdf->Cell(80,5,'VENDOR',1,0,'C',0);
			$pdf->Cell(60,5,'TOTAL',1,0,'C',0);$pdf->Ln(5);				
			$i++;
			$no++;
		
	}
			$pdf->SetFont('Arial','B',6);
	  	
			$pdf->Cell(88,5,'TOTAL',1,0,'C',1);
			$pdf->Cell(60,5,'TOTAL',1,0,'C',1);$pdf->Ln(5);	
		
			$pdf->Output("hasil.pdf","I");	;
	
