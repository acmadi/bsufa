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
			$pdf->Cell(110,5,'PT. GRAHA MULTI INSANI',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(25,5,'Voucher No.',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(30,3.5,'tes',1,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetFont('Arial','',6);
			$pdf->SetX(25);
			$pdf->Cell(110,5,'Komplek Apartemen Taman Rasuna',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(25,5,'Cheque/Giro No.',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(30,3.5,'tes juga',1,0,'L');
			$pdf->Ln(3);
			$pdf->SetFont('Arial','',6);
			
			$pdf->SetX(25);
			$pdf->Cell(100,5,'Jl. HR. Rasuna Said - Kuningan',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(25,5,'',10,0,'L');
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(100,5,'Jakarta Selatan (12960)',10,0,'L');
			$pdf->SetFont('Arial','',6);
			
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(100,5,'Telp : (021) 830-5011 Fax : (021) 830-5012',10,0,'L');
			$pdf->SetFont('Arial','',6);
			
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(100,5,'NPWP : 021.672.152.2-011.00',10,0,'L');
			$pdf->SetFont('Arial','',6);
				
			
			$pdf->Ln(6);
			$pdf->SetFont('Arial','B',11);
			$pdf->SetX(25);
			$pdf->Cell(110,5,'REQUEST PAYMENT VOUCHER',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(25,5,'AP No.',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->SetFont('Arial','B',6);
			$pdf->Cell(30,4,'AP000009',1,0,'L');
			$pdf->Ln(5);
			
			$pdf->SetFont('Arial','',6);
			
			$pdf->SetX(10);
			$pdf->Cell(20,5,'BANK',10,0,'L');
			$pdf->Cell(4,5,':',10,0,'L');
			$pdf->Cell(59,4,'',1,0,'L');
			$pdf->Cell(42,4,'',10,0,'L');
			$pdf->Cell(25,5,'AP Date',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(30,4,'22-06-2012',1,0,'L');
			$pdf->Ln(5);
			
			$pdf->SetX(10);
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(20,5,'Paid to',10,0,'L');
			$pdf->Cell(4,5,':',10,0,'L');
			$pdf->SetFont('Arial','B',6);
			$pdf->Cell(59,4,'MARKETING',1,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(42,4,'',10,0,'L');
			$pdf->Cell(25,5,'AP Due Date',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(30,4,'22-06-2012',1,0,'L');
			$pdf->Ln(5);
			
			$pdf->SetX(10);
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(20,5,'Address',10,0,'L');
			$pdf->Cell(4,5,':',10,0,'L');
			$pdf->Cell(158,12,'',1,0,'L');
			$pdf->Ln(13);
			
			$pdf->SetX(10);
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(20,5,'AMOUNT',10,0,'L');
			$pdf->Cell(4,5,':',10,0,'L');
			$pdf->Cell(55,5,'',1,0,'L');
			$pdf->Ln(6);
			
			$pdf->SetX(10);
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(20,5,'TERBILANG',10,0,'L');
			$pdf->Cell(4,5,':',10,0,'L');
			$pdf->Cell(158,12,'',1,0,'L');
			$pdf->Ln(13);
			
			$pdf->SetX(10);
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(20,5,'REMARK',10,0,'L');
			$pdf->Cell(4,5,':',10,0,'L');
			$pdf->Cell(158,12,'',1,0,'L');
				$pdf->Ln(17);
			
			
			
			
			
			
			
			#start Tabel
			$pdf->SetX(10);
		
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(8,4,'No',1,0,'C',1);
			$pdf->Cell(26,4,'COA',1,0,'C',1);
			$pdf->Cell(78,4,'ACCOUNT NAME',1,0,'C',1);
			$pdf->Cell(35,4,'DEBET',1,0,'C',1);
			$pdf->Cell(35,4,'CREDIT',1,0,'C',1);
			$pdf->Ln(4);
			
			for($i = 1;$i <= 27; $i++){
			$pdf->SetX(10);
			$pdf->Cell(8,4,$i,1,0,'C',0);
			$pdf->Cell(26,4,'6.00.00.00.1',1,0,'L',0);
			$pdf->Cell(78,4,'Account',1,0,'L',0);
			$pdf->Cell(35,4,number_format(1000000000),1,0,'R',0);
			$pdf->Cell(35,4,number_format(1000000000),1,0,'R',0);
			$pdf->Ln(4);	
				
				
			}
			$pdf->Ln(7);		
			$pdf->SetX(15);
			$pdf->SetFont('Arial','',5);
		
			
			$pdf->SetX(28);
			$pdf->Cell(25,8,'Prepared By',1,0,'C',0);
			$pdf->Cell(50,4,'Checked By',1,0,'C',0);
			$pdf->Cell(70,8,'Verified By',1,0,'C',0);
			
			$pdf->Ln(4);
			
			$pdf->SetX(28);
			$pdf->Cell(25,8,'',10,0,'C',0);
			$pdf->Cell(25,4,'ACCOUNTING',1,0,'C',0);
			$pdf->Cell(25,4,'BUDGET CONTROL',1,0,'C',0);
			$pdf->Cell(35,4,'',10,0,'C',0);		
			$pdf->Cell(35,4,'',10,0,'C',0);
			$pdf->Ln(4);
			
			$pdf->SetX(28);
			$pdf->Cell(25,15,'',1,0,'C',0);
			$pdf->Cell(25,15,'',1,0,'C',0);
			$pdf->Cell(25,15,'',1,0,'C',0);
			$pdf->Cell(35,15,'',1,0,'C',0);		
			$pdf->Cell(35,15,'',1,0,'C',0);
			$pdf->Ln(15);
			
			$pdf->SetX(28);
			$pdf->Cell(25,4,'Date. ',1,0,'L',0);
			$pdf->Cell(25,4,'Date. ',1,0,'L',0);
			$pdf->Cell(25,4,'Date. ',1,0,'L',0);
			$pdf->Cell(35,4,'Date. ',1,0,'L',0);		
			$pdf->Cell(35,4,'Date. ',1,0,'L',0);			
			$pdf->Ln(25);
		
	
	
	
				$pdf->SetFont('Arial','',6);
				$pdf->SetX(180);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
				$pdf->Cell(2,4,':',4,0,'L');
				$pdf->Cell(2,4,date("Y-m-d"),4,0,'L');
			$pdf->Output("hasil.pdf","I");

