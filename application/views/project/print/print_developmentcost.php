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
			#$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$PT 		= "PT. ......";
				$project	= "Project";
				$judul		= "DEVELOPMENT COST";
	
			#CETAK TANGGAL
				#$tgl  = date("d-m-Y");
			#TANGGAL CETAK
				
			#	$pdf->Cell(10,4,$tgl,0,0,'L');
			
				#Header
			$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetX(25);
				$pdf->SetFont('Arial','B',12);
				$pdf->Cell(0,10,$PT,20,0,'L');
				$pdf->Ln(5);
				
				$pdf->SetX(25);
				$pdf->SetFont('Arial','B',11);
				$pdf->Cell(0,10,$project,20,0,'L');
				$pdf->Ln(5);
				
				$pdf->SetX(25);
				$pdf->SetFont('Arial','B',9);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(1);
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(5);
				
			// Start diatas tabel
			
			$pdf->SetFont('Arial','',11);
			$pdf->SetX(5);
			
			$pdf->Cell(81,0,'',1,0,'L');
			$pdf->Ln();
			$pdf->SetX(5);
			$pdf->Cell(81,8,'CONDOTEL',0,0,'C',1);
			$pdf->Ln(8);
			$pdf->SetX(5);
			$pdf->Cell(81,0,'',1,0,'L');
			
			$pdf->Ln(8);
			$pdf->SetX(5);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(40,5,'DEVELOPMENT COST',10,0,'L');
			$pdf->Ln(5);
			
			$pdf->SetFont('Arial','',7);
			
			$pdf->SetX(15);	
			$pdf->Cell(40,5,'Land Area',10,0,'L');
			$pdf->Cell(130,5,number_format(10000000000),10,0,'R');
			
			$pdf->Ln(4);
			
			$pdf->SetX(15);	
			$pdf->Cell(40,5,'GBA',10,0,'L');
			$pdf->Cell(130,5,number_format(10000000000),10,0,'R');
			
			$pdf->Ln(4);
			
			$pdf->SetX(15);	
			$pdf->Cell(40,5,'SGFA',10,0,'L');
			$pdf->Cell(130,5,number_format(10000000000),10,0,'R');
			
			$pdf->Ln(4);
			
			$pdf->SetX(15);	
			$pdf->Cell(40,5,'SALEABLE',10,0,'L');
			$pdf->Cell(130,5,number_format(10000000000),10,0,'R');
			
			$pdf->Ln(4);
			
			$pdf->SetX(15);	
			$pdf->Cell(40,5,'Cost Of Sales',10,0,'L');
			$pdf->Cell(130,5,number_format(10000000000),10,0,'R');
			
			$pdf->Ln(10);
			
			#start Tabel
			$pdf->SetFont('Arial','B',8);
			$pdf->SetX(15);
			$pdf->Cell(81,0,'',1,0,'L');
			$pdf->Ln();
			$pdf->SetX(15);
			$pdf->Cell(170,0,'',1,0,'L');
			$pdf->Ln(0);
			$pdf->SetFont('Arial','B',8);
			$pdf->SetX(15);
			$pdf->Cell(120,4,'Development Cost',0,0,'L',1);
			$pdf->Cell(25,4,'COST/Sqmt',0,0,'R',1);
			$pdf->Cell(25,4,'Total',0,0,'R',1);
			$pdf->Ln(4);
			$pdf->SetX(15);
			$pdf->Cell(170,0,'',1,0,'L');
			
			
			
			$pdf->SetFont('Arial','',8);
		
			$pdf->SetX(15);
			//for($i = 1;$i <= 8; $i++){
			$pdf->SetX(15);
			$pdf->Cell(120,4,'Land',0,0,'L',0);
			$pdf->Cell(25,4,'0.41',0,0,'R',0);
			$pdf->Cell(25,4,number_format(3,0),0,0,'R',0);
			$pdf->Ln(4);
            	$pdf->SetX(15);	
			$pdf->Cell(120,4,'Interest',0,0,'L',0);
			$pdf->Cell(25,4,'1.25',0,0,'R',0);
			$pdf->Cell(25,4,number_format(1000000000000),0,0,'R',0);
			$pdf->Ln(4);	
            	$pdf->SetX(15);
			$pdf->Cell(120,4,'Development Cost',0,0,'L',0);
			$pdf->Cell(25,4,'1.25',0,0,'R',0);
			$pdf->Cell(25,4,number_format(1000000000000),0,0,'R',0);
			$pdf->Ln(4);	
            	$pdf->SetX(15);
			$pdf->Cell(120,4,'Development Cost',0,0,'L',0);
			$pdf->Cell(25,4,'1.25',0,0,'R',0);
			$pdf->Cell(25,4,number_format(1000000000000),0,0,'R',0);
			$pdf->Ln(4);	
            	$pdf->SetX(15);
			$pdf->Cell(120,4,'Development Cost',0,0,'L',0);
			$pdf->Cell(25,4,'1.25',0,0,'R',0);
			$pdf->Cell(25,4,number_format(1000000000000),0,0,'R',0);
			$pdf->Ln(4);	
            	$pdf->SetX(15);
			$pdf->Cell(120,4,'Development Cost',0,0,'L',0);
			$pdf->Cell(25,4,'1.25',0,0,'R',0);
			$pdf->Cell(25,4,number_format(1000000000000),0,0,'R',0);
			$pdf->Ln(4);	
            	$pdf->SetX(15);
			$pdf->Cell(120,4,'Development Cost',0,0,'L',0);
			$pdf->Cell(25,4,'1.25',0,0,'R',0);
			$pdf->Cell(25,4,number_format(1000000000000),0,0,'R',0);
			$pdf->Ln(4);	
            	$pdf->SetX(15);
			$pdf->Cell(120,4,'Development Cost',0,0,'L',0);
			$pdf->Cell(25,4,'1.25',0,0,'R',0);
			$pdf->Cell(25,4,number_format(1000000000000),0,0,'R',0);
			$pdf->Ln(4);	
				
				
			//}
				
			$pdf->SetX(15);
			$pdf->Cell(170,0,'',1,0,'L');
			$pdf->Ln();
			$pdf->SetFont('Arial','B',8);
			$pdf->SetX(15);
			$pdf->Cell(120,4,'Total Development Cost',0,0,'L',0);
			$pdf->Cell(25,4,'1.25',0,0,'R',0);
			$pdf->Cell(25,4,number_format(1000000000000),0,0,'R',0);
			$pdf->Ln(4);
			$pdf->SetX(15);
			$pdf->Cell(170,0,'',1,0,'L');
				$pdf->Ln(5);
	
			
	# ni yang ke dua		
			$pdf->SetFont('Arial','',10);
			$pdf->SetX(5);
			
			
			$pdf->Ln();
			$pdf->SetX(5);
			$pdf->Cell(81,4,'DEVELOPMENNT COST (RETAIL)',0,0,'C',1);
						
			
			$pdf->Ln(5);
			
			$pdf->SetFont('Arial','',7);
			
			$pdf->SetX(15);	
			$pdf->Cell(40,5,'Land Area',10,0,'L');
			$pdf->Cell(130,5,number_format(10000000000),10,0,'R');
			
			$pdf->Ln(4);
			
			$pdf->SetX(15);	
			$pdf->Cell(40,5,'GBA',10,0,'L');
			$pdf->Cell(130,5,number_format(10000000000),10,0,'R');
			
			$pdf->Ln(4);
			
			$pdf->SetX(15);	
			$pdf->Cell(40,5,'SGFA',10,0,'L');
			$pdf->Cell(130,5,number_format(10000000000),10,0,'R');
			
			$pdf->Ln(4);
			
			$pdf->SetX(15);	
			$pdf->Cell(40,5,'SALEABLE',10,0,'L');
			$pdf->Cell(130,5,number_format(10000000000),10,0,'R');
			
			$pdf->Ln(4);
			
			$pdf->SetX(15);	
			$pdf->Cell(40,5,'Cost Of Sales',10,0,'L');
			$pdf->Cell(130,5,number_format(10000000000),10,0,'R');
			
			$pdf->Ln(10);
			
			#start Tabel
			$pdf->SetFont('Arial','B',8);
			$pdf->SetX(15);
			$pdf->Cell(81,0,'',1,0,'L');
			$pdf->Ln();
			$pdf->SetX(15);
			$pdf->Cell(170,0,'',1,0,'L');
			$pdf->Ln(0);
			$pdf->SetFont('Arial','B',8);
			$pdf->SetX(15);
			$pdf->Cell(120,4,'Development Cost',0,0,'L',1);
			$pdf->Cell(25,4,'COST/Sqmt',0,0,'R',1);
			$pdf->Cell(25,4,'Total',0,0,'R',1);
			$pdf->Ln(4);
			$pdf->SetX(15);
			$pdf->Cell(170,0,'',1,0,'L');
			
			
			
			$pdf->SetFont('Arial','',8);
		
			$pdf->SetX(15);
			for($i = 1;$i <= 8; $i++){
			$pdf->SetX(15);
			$pdf->Cell(120,4,'Development Cost',0,0,'L',0);
			$pdf->Cell(25,4,'1.25',0,0,'R',0);
			$pdf->Cell(25,4,number_format(1000000000000),0,0,'R',0);
			$pdf->Ln(4);	
				
				
			}
				
			$pdf->SetX(15);
			$pdf->Cell(170,0,'',1,0,'L');
			$pdf->Ln();
			$pdf->SetFont('Arial','B',8);
			$pdf->SetX(15);
			$pdf->Cell(120,4,'Total Development Cost',0,0,'L',0);
			$pdf->Cell(25,4,'1.25',0,0,'R',0);
			$pdf->Cell(25,4,number_format(1000000000000),0,0,'R',0);
			$pdf->Ln(4);
			$pdf->SetX(15);
			$pdf->Cell(170,0,'',1,0,'L');
			$pdf->Ln(4);
			
			$pdf->SetX(15);
			$pdf->Cell(170,0,'',1,0,'L');
			$pdf->Ln();
			$pdf->SetFont('Arial','B',8);
			$pdf->SetX(15);
			$pdf->Cell(120,4,'Total Development Cost',0,0,'L',1);
			$pdf->Cell(25,4,'1.25',0,0,'R',1);
			$pdf->Cell(25,4,number_format(1000000000000),0,0,'R',1);
			$pdf->Ln(4);
			$pdf->SetX(15);
			$pdf->Cell(170,0,'',1,0,'L');
	
	
				$pdf->SetFont('Arial','',6);
				$pdf->SetX(180);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
				$pdf->Cell(2,4,':',4,0,'L');
				$pdf->Cell(2,4,date("Y-m-d"),4,0,'L');
				
				
			$pdf->Output("hasil.pdf","I");

