<?php

		
			require('fpdf/tanpapage.php');
			extract(PopulateForm());
			$pdf=new PDF('P','mm','A4');
			
							 
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			#HEAD
			#HEADER CONTENT
			$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				
			#CETAK TANGGAL
				#$tgl  = date("d-m-Y");
			#TANGGAL CETAK
				
			#	$pdf->Cell(10,4,$tgl,0,0,'L');
			
				#Header
			#$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
			$pdf->SetX(25);
				
			// Start diatas tabel
			
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(130,5,'PT. GRAHA MULTI INSANI',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(25,5,'No. PR',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(30,5,'PR-1234/0842',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(130,5,'Komplek Apartemen Taman Rasuna',10,0,'L');
			$pdf->SetFont('Arial','B',6);
			$pdf->Cell(25,5,'Request',10,0,'L');
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			$pdf->SetFont('Arial','',6);
			
			$pdf->SetX(25);
			$pdf->Cell(130,5,'Jl. HR. Rasuna Said - Kuningan',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(25,5,'Transaction Date',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(30,5,'PR-1234/0842',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(130,5,'Jakarta Selatan (12960)',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(25,5,'Approved Date',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(30,5,'PR-1234/0842',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(130,5,'Telp : (021) 830-5011 Fax : (021) 830-5012',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(25,5,'Requestor',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(30,5,'PR-1234/0842',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(130,5,'NPWP : 021.672.152.2-011.00',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(25,5,'Department',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(30,5,'PR-1234/0842',10,0,'L');
				
			
			$pdf->Ln(13);
			$pdf->SetFont('Arial','B',9);
			$pdf->SetX(25);
			$pdf->Cell(130,5,'PURCHASE REQUISITION',10,0,'L');
			$pdf->Ln(10);
			
			$pdf->SetFont('Arial','B',6);
			$pdf->Cell(80,5,'Suggested Selected :',10,0,'L');
			$pdf->Cell(25,5,'Budget Control Use Only',10,0,'L');
			$pdf->Ln(5);
			$pdf->SetFont('Arial','',6);
			
			$pdf->Cell(20,5,'Name',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(59,5,'Abas',10,0,'L');
			$pdf->Cell(15,4,'X',1,0,'C');
			$pdf->Cell(15,5,'Budgeted',10,0,'L');
			$pdf->Ln(5);
			
			$pdf->Cell(20,5,'Address',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(59,5,'Kuningan',10,0,'L');
			$pdf->Cell(15,4,'X',1,0,'C');
			$pdf->Cell(15,5,'Non Budgeted',10,0,'L');
			$pdf->Ln(5);
			
			$pdf->Cell(20,5,'Phone / Fax',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(59,5,'021 - 0000000',10,0,'L');
			$pdf->Ln(5);
			
			$pdf->Cell(20,5,'TOP',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(40,5,'',10,0,'L');
			$pdf->Cell(50,4,'Budgeted < 30 Juta',1,0,'C',1);
			$pdf->Ln(5);
			
			$pdf->SetFont('Arial','B',6);
			$pdf->Cell(40,5,'Reason For Requisition',10,0,'L');
			$pdf->Ln(5);
			
			$pdf->Cell(206,5,'Toner Untuk Yogya',1,0,'L');
			$pdf->Ln(1);
			
			
			#start Tabel
			$pdf->Ln(5);
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(8,8,'No',1,0,'C',1);
			$pdf->Cell(10,8,'Qty',1,0,'C',1);
			$pdf->Cell(13,8,'Unit',1,0,'C',1);
			$pdf->Cell(55,8,'Description',1,0,'C',1);
			$pdf->Cell(40,4,'Vendor 1 :'.'Tes',1,0,'C',1);
			$pdf->Cell(40,4,'Vendor 2 :'.'Tus',1,0,'C',1);
			$pdf->Cell(40,4,'Vendor 3 :'.'Tis',1,0,'C',1);
			$pdf->Ln(4);
			
			$pdf->Cell(8,0,'',0,0,'C',0);
			$pdf->Cell(10,0,'',0,0,'C',0);
			$pdf->Cell(13,0,'',0,0,'C',0);
			$pdf->Cell(55,0,'',0,0,'C',0);
			$pdf->Cell(20,4,'This Month',1,0,'C',1);		
			$pdf->Cell(20,4,'Previous',1,0,'C',1);		
			$pdf->Cell(20,4,'YTD',1,0,'C',1);		
			$pdf->Cell(20,4,'Balance',1,0,'C',1);
			$pdf->Cell(20,4,'Balance',1,0,'C',1);
			$pdf->Cell(20,4,'Balance',1,0,'C',1);
			$pdf->Ln(4);
			
			for($i = 1;$i <= 27; $i++){
			
			$pdf->Cell(8,4,$i,1,0,'C',0);
			$pdf->Cell(10,4,'Qty '.$i,1,0,'C',0);
			$pdf->Cell(13,4,'Unit '.$i,1,0,'C',0);
			$pdf->Cell(55,4,'Description '.$i,1,0,'C',0);
			$pdf->Cell(20,4,number_format(1000000000),1,0,'R',0);		
			$pdf->Cell(20,4,'X',1,0,'R',0);		
			$pdf->Cell(20,4,'X',1,0,'R',0);		
			$pdf->Cell(20,4,'X',1,0,'R',0);		
			$pdf->Cell(20,4,'X',1,0,'R',0);		
			$pdf->Cell(20,4,'X',1,0,'R',0);
			$pdf->Ln(4);	
				
				
			}
			$pdf->Ln(7);		
			$pdf->SetX(15);
			$pdf->SetFont('Arial','',6);
		
			
			$pdf->SetX(28);
			$pdf->Cell(150,4,'Approval Signature',1,0,'C',0);
			$pdf->Ln(4);		
				
			$pdf->SetX(28);
			$pdf->Cell(55,4,'Prepared By',1,0,'C',0);
			$pdf->Cell(25,4,'FAM',1,0,'C',0);
			$pdf->Cell(25,4,'FC',1,0,'C',0);		
			$pdf->Cell(45,4,'General Manager',1,0,'C',0);		
				
			$pdf->Ln(4);
			
			$pdf->SetX(28);
			$pdf->Cell(55,15,'',1,0,'C',0);
			$pdf->Cell(25,15,'',1,0,'C',0);
			$pdf->Cell(25,15,'',1,0,'C',0);
			$pdf->Cell(45,15,'',1,0,'C',0);		
			$pdf->Ln(15);
			
			$pdf->SetX(28);
			$pdf->Cell(55,3,'Date :',1,0,'L',0);
			$pdf->Cell(25,3,'Date :',1,0,'L',0);
			$pdf->Cell(25,3,'Date :',1,0,'L',0);		
			$pdf->Cell(45,3,'Date :',1,0,'L',0);		
			$pdf->Ln(25);
		
	
	
	
				$pdf->SetFont('Arial','',6);
				$pdf->SetX(180);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
				$pdf->Cell(2,4,':',4,0,'L');
				$pdf->Cell(2,4,date("Y-m-d"),4,0,'L');
			$pdf->Output("hasil.pdf","I");

