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
				$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
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
			
			$pdf->Cell(30,5,'Project Name',10,0,'R',0);
			$pdf->Cell(2,5,':',10,0,'C',0);
			$pdf->Cell(40,5,'PT. Bumi Daya Makmur',10,0,'L',0);
			$pdf->Ln(5);
			$pdf->Cell(30,5,'Total Project',10,0,'R',0);
			$pdf->Cell(2,5,':',10,0,'C',0);
			$pdf->Cell(40,5,'',10,0,'R',0);
			$pdf->Ln(5);
			$pdf->Cell(30,5,'Land Effective',10,0,'R',0);
			$pdf->Cell(2,5,':',10,0,'C',0);
			$pdf->Cell(40,5,'',10,0,'R',0);
			$pdf->Ln(5);
			$pdf->Cell(30,5,'SGFA',10,0,'R',0);
			$pdf->Cell(2,5,':',10,0,'C',0);
			$pdf->Cell(40,5,'',10,0,'R',0);
			$pdf->Ln(5);
			$pdf->Cell(30,5,'GBA',10,0,'R',0);
			$pdf->Cell(2,5,':',10,0,'C',0);
			$pdf->Cell(40,5,'',10,0,'R',0);
			$pdf->Ln(5);
			
			$pdf->Cell(70,15,'Development Cost',1,0,'C',1);
			$pdf->Cell(30,15,'Budget',1,0,'C',1);
			$pdf->Cell(150,5,'Commitment Contract',1,0,'C',1);
			$pdf->Cell(40,15,'Uncommitment Amount',1,0,'C',1);
			
			
			$pdf->Ln(5);
					
			$pdf->SetX(104);
			$pdf->Cell(30,10,'Contract Amount',1,0,'C',1);
			$pdf->Cell(90,5,'Invoice',1,0,'C',1);
			$pdf->Cell(30,10,'CTC',1,0,'C',1);
			#$pdf->Cell(30,10,'Budget',1,0,'C',1);
			
			
			$pdf->Ln(5);
			$pdf->SetX(134);
			$pdf->Cell(30,5,'Amount',1,0,'C',1);
			$pdf->Cell(30,5,'Paid',1,0,'C',1);
			$pdf->Cell(30,5,'Outstanding',1,0,'C',1);
			#$pdf->Cell(30,10,'Budget',1,0,'C',1);
			
			
			#$pdf->Ln(5);
			
		
			$pdf->SetFont('Arial','',9);
			
			$i = 1;	
			$no = 0;
			$max = 22;	
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
				$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
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
			$pdf->Cell(30,5,'Project Name',10,0,'R',0);
			$pdf->Cell(2,5,':',10,0,'C',0);
			$pdf->Cell(40,5,'PT. Bumi Daya Makmur',10,0,'L',0);
			$pdf->Ln(5);
			$pdf->Cell(30,5,'Total Project',10,0,'R',0);
			$pdf->Cell(2,5,':',10,0,'C',0);
			$pdf->Cell(40,5,'',10,0,'R',0);
			$pdf->Ln(5);
			$pdf->Cell(30,5,'Land Effective',10,0,'R',0);
			$pdf->Cell(2,5,':',10,0,'C',0);
			$pdf->Cell(40,5,'',10,0,'R',0);
			$pdf->Ln(5);
			$pdf->Cell(30,5,'SGFA',10,0,'R',0);
			$pdf->Cell(2,5,':',10,0,'C',0);
			$pdf->Cell(40,5,'',10,0,'R',0);
			$pdf->Ln(5);
			$pdf->Cell(30,5,'GBA',10,0,'R',0);
			$pdf->Cell(2,5,':',10,0,'C',0);
			$pdf->Cell(40,5,'',10,0,'R',0);
			$pdf->Ln(5);
			
			$pdf->Cell(70,15,'Development Cost',1,0,'C',1);
			$pdf->Cell(30,15,'Budget',1,0,'C',1);
			$pdf->Cell(150,5,'Commitment Contract',1,0,'C',1);
			$pdf->Cell(40,15,'Uncommitment Amount',1,0,'C',1);
			
			
			$pdf->Ln(5);
					
			$pdf->SetX(104);
			$pdf->Cell(30,10,'Contract Amount',1,0,'C',1);
			$pdf->Cell(90,5,'Invoice',1,0,'C',1);
			$pdf->Cell(30,10,'CTC',1,0,'C',1);
			#$pdf->Cell(30,10,'Budget',1,0,'C',1);
			
			
			$pdf->Ln(5);
			$pdf->SetX(134);
			$pdf->Cell(30,5,'Amount',1,0,'C',1);
			$pdf->Cell(30,5,'Paid',1,0,'C',1);
			$pdf->Cell(30,5,'Outstanding',1,0,'C',1);
			$pdf->Ln(5);
			$no = 0;
	
			
		}
		
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(70,5,'Tes',1,0,'L',0);
			$pdf->Cell(30,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(30,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(30,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(30,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(30,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(30,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(40,5,number_format(1000000000000),1,0,'R',0);
			
			$pdf->Ln(5);				
			$i++;
			$no++;
		
	}
	
			$pdf->Cell(70,1,'',1,0,'R',0);
			$pdf->Cell(30,1,'',1,0,'R',0);
			$pdf->Cell(30,1,'',1,0,'R',0);
			$pdf->Cell(30,1,'',1,0,'R',0);
			$pdf->Cell(30,1,'',1,0,'R',0);
			$pdf->Cell(30,1,'',1,0,'R',0);
			$pdf->Cell(30,1,'',1,0,'R',0);
			$pdf->Cell(40,1,'',1,0,'R',0);
	$pdf->Ln(1);
	$pdf->SetFont('Arial','B',8);
			$pdf->Cell(70,5,'Total',1,0,'R',0);
			$pdf->Cell(30,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(30,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(30,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(30,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(30,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(30,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(40,5,number_format(1000000000000),1,0,'R',0);
		
		$pdf->Ln(5);
		$pdf->Cell(70,5,'Cost per SQM SGFA',1,0,'R',0);
			$pdf->Cell(30,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(30,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(30,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(30,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(30,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(30,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Cell(40,5,number_format(1000000000000),1,0,'R',0);
			$pdf->Output("hasil.pdf","I");	;
	
