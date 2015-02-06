<?php
			require('fpdf/tanpapage.php');
			
			extract(PopulateForm());
			$pdf=new PDF('P','mm','A4');
			$pt = 44;
			$pdf->SetMargins(10,5,10);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			
			
			#HEAD
			#HEADER CONTENT
				
				$pt			= "PT. Graha Multi Insani";
				$judul 		= "Taman Rasuna Apartemen - Combined";
				$periode	= "Periode";
	
			#CETAK TANGGAL
				$tglcetak  = date("d-m-Y");
			#TANGGAL CETAK
				$pdf->SetFont('Arial','',6);
				$pdf->SetXY(258,10);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							
				$pdf->SetXY(268,10);
				$pdf->Cell(2,4,':',4,0,'L');
								
				$pdf->SetXY(269,10);
				$pdf->Cell(10,4,'',0,0,'L');
			
			#Header
				#$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'BUDGED 2007',20,0,'L');
				$pdf->Ln(10);
				#$pdf->SetXY(25,22);
				#$pdf->Cell(0,10,'',20,0,'L');
		
				#$pdf->Ln(5);
				
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(1);
				$pdf->Cell(0,0,'',1,0,'L');
				
			// Start Isi Tabel
			
	
		
			$pdf->SetFont('Arial','B',15);
			$pdf->Ln(4);
						
			$pdf->SetFont('Arial','B',20);
			$pdf->Cell(190,10,'BUDGET MONITORING',20,0,'C');
			
			$pdf->Ln(13);
			$pdf->Cell(190,0,'',1,0,'C');
			$pdf->Ln(5);
			
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(75,5,'Account Title',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(117,5,'CURENT TAX FINAL',10,0,'L',0);
			$pdf->Ln(5);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(75,5,'Sub Account',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(117,5,'Current Tax Finak Atas Pengalihan atas Tanah ',10,0,'L',0);
			$pdf->Ln(5);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(75,5,'Status',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(117,5,'Non Budget',10,0,'L',0);
			$pdf->Ln(5);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(75,5,'Annual Budget',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(77,5,'(In-Rp.)',10,0,'L',0);
			$pdf->Cell(30,5,'0',10,0,'R',0);
			$pdf->Ln(5);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(75,5,'Budget Year To Date',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(77,5,'(In-Rp.)',10,0,'L',0);
			$pdf->Cell(30,5,'0',10,0,'R',0);
			$pdf->Ln(13);
			
			
			$total = 3000001212;
			
			$pdf->SetFont('Arial','B',20);
			$pdf->Cell(190,10,'REQUEST',20,0,'C');
			
			$pdf->Ln(13);
			$pdf->Cell(190,0,'',1,0,'C');
			$pdf->Ln(5);
			
			
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(75,5,'Date',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(77,5,date("d-m-Y"),10,0,'L',0);
			$pdf->Cell(30,5,'',10,0,'R',0);
			$pdf->Ln(5);
			$pdf->Cell(75,5,'Divisi / Unit',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(77,5,'Accounting',10,0,'L',0);
			$pdf->Cell(30,5,'',10,0,'R',0);
			$pdf->Ln(5);
			$pdf->Cell(75,5,'P I C',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(77,5,'TP',10,0,'L',0);
			$pdf->Cell(30,5,'',10,0,'R',0);
			$pdf->Ln(10);
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(79,5,'Value Allocation For :',10,0,'L',0);
			$pdf->Cell(83,5,'',10,0,'L',0);
			$pdf->Cell(63,5,'',10,0,'L',0);
			$pdf->Ln(5);
			$pdf->Cell(79,5,'PROJECT',10,0,'L',0);
			$pdf->Cell(83,5,'Alokasi %',10,0,'L',0);
			$pdf->Cell(63,5,'VALUE (In-Rp.)',10,0,'L',0);
			$pdf->Ln(5);
			$pdf->SetFont('Arial','',9);
			
			#alokasi project
			$pdf->SetX(15);
			$pdf->Cell(79,5,'Taman Rasuna',10,0,'L',0);
			$pdf->Cell(83,5,'0.38',10,0,'L',0);
			$pdf->Cell(63,5,'VALUE (In-Rp.)',10,0,'L',0);
			$pdf->Ln(5);
			
			$pdf->SetX(15);
			$pdf->Cell(79,5,'ROP',10,0,'L',0);
			$pdf->Cell(83,5,'0.38',10,0,'L',0);
			$pdf->Cell(63,5,'VALUE (In-Rp.)',10,0,'L',0);
			$pdf->Ln(5);
			
			$pdf->SetX(15);
			$pdf->Cell(79,5,'Wisma Bakrie 1',10,0,'L',0);
			$pdf->Cell(83,5,'0.38',10,0,'L',0);
			$pdf->Cell(63,5,'VALUE (In-Rp.)',10,0,'L',0);
			$pdf->Ln(5);
			
			$pdf->SetX(15);
			$pdf->Cell(79,5,'Wisma Bakrie 2',10,0,'L',0);
			$pdf->Cell(83,5,'0.38',10,0,'L',0);
			$pdf->Cell(63,5,'VALUE (In-Rp.)',10,0,'L',0);
			$pdf->Ln(5);
			
			$pdf->SetX(15);
			$pdf->Cell(79,5,'Tower 18',10,0,'L',0);
			$pdf->Cell(83,5,'0.38',10,0,'L',0);
			$pdf->Cell(63,5,'VALUE (In-Rp.)',10,0,'L',0);
			#$pdf->Ln(5);
			#end alokasi project
			
			
			$pdf->Ln(10);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(75,5,'Request Amount',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(77,5,'(In-Rp.)',10,0,'L',0);
			$pdf->Cell(30,5,number_format($total),10,0,'R',0);
			$pdf->Ln(5);
			$pdf->Cell(75,5,'Year To Date Request',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(77,5,'(In-Rp.)',10,0,'L',0);
			$pdf->Cell(30,5,'0',10,0,'R',0);
			$pdf->Ln(5);
			$pdf->Cell(75,5,'Balance - Year To Date',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(77,5,'(In-Rp.)',10,0,'L',0);
			$pdf->Cell(30,5,'0',10,0,'R',0);
			$pdf->Ln(5);
			$pdf->Cell(75,5,'Balance - Annual Budget',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(77,5,'(In-Rp.)',10,0,'L',0);
			$pdf->Cell(30,5,'0',10,0,'R',0);
			$pdf->Ln(5);
			$pdf->Cell(75,5,'Year To Date request To Annual Budget Percentage',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(77,5,'(In-Rp.)',10,0,'L',0);
			$pdf->Cell(30,5,'0',10,0,'R',0);
			$pdf->Ln(13);
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(20,5,'Remark',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Ln(5);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(190,5,'Kas Negara, pembayaran PPhTB final pengalihan unit TRA 07198 a/n Arni',10,0,'L',0);
			
			
			
			$pdf->Ln(13);
			$pdf->Cell(190,0,'',1,0,'C');
			$pdf->Ln(5);
			
			
			
			
			$pdf->Ln(8);
			$pdf->Cell(30,5,'Verified Date',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(63,5,'',10,0,'L',0);
		$pdf->Ln(5);
		
			
			$pdf->SetFont('Arial','',10);
			if($total > 30000000){
			
			$pdf->Cell(79,5,'Verified by :',10,0,'L',0);
			$pdf->Cell(83,5,'Acknowledge by :',10,0,'L',0);
			$pdf->Cell(63,5,'Approved by :',10,0,'L',0);
			$pdf->Ln(30);
			
			
			
			$pdf->Cell(79,5,'('.' Administrator '.')',10,0,'L',0);
			$pdf->Cell(83,5,'('.' Azman '.')',10,0,'L',0);
			$pdf->Cell(63,5,'('.' BOD '.')',10,0,'L',0);
			
			}else{
			$pdf->Cell(98,5,'Proposed by :',10,0,'C',0);
			$pdf->Cell(80,5,'Approved by :',10,0,'C',0);
			$pdf->Cell(40,5,'',10,0,'R',0);
			
			$pdf->Ln(30);
			
			
			
			$pdf->Cell(98,5,'(Project Manager)',10,0,'L',0);
			$pdf->Cell(80,5,'(General Manager)',10,0,'C',0);
			$pdf->Cell(40,5,'',10,0,'R',0);
			
			
				
				}
			
			
		
		
			$pdf->Output("hasil.pdf","I");	;
	
