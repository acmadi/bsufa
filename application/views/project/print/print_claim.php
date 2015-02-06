<?php

		
			require('fpdf/classpdf.php');
			extract(PopulateForm());
			$pdf=new PDF('L','mm','A4');
			
			$pdf->SetMargins(5,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEADER CONTENT
				$pt			= "GRAHA MULTI INSANI";
				$judul 		= "Historical Claim";
				
	
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
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
								
			
			// Start Isi Tabel
			
		
		
			$pdf->SetFont('Arial','B',10);
			$pdf->Ln(4);
			
			$pdf->Cell(40,5,'Contract No.',10,0,'L',0);
			$pdf->Cell(3,5,':',10,0,'C',0);
			$pdf->Cell(65,5,@$header->no_kontrak,10,0,'L',0);
			$pdf->Ln(7);
			
			$pdf->Cell(40,5,'Contractor',10,0,'L',0);
			$pdf->Cell(3,5,':',10,0,'C',0);
			$pdf->Cell(65,5,@$header->nm_supplier,10,0,'L',0);
			$pdf->Ln(7);
			
			$pdf->Cell(40,5,'Job',10,0,'L',0);
			$pdf->Cell(3,5,':',10,0,'C',0);
			$pdf->Cell(65,5,@$header->job,10,0,'L',0);
			$pdf->Ln(7);
			
			$pdf->Cell(40,5,'Total Contract',10,0,'L',0);
			$pdf->Cell(3,5,':',10,0,'C',0);
			$pdf->Cell(65,5,number_format(@$header->contract_amount).'  Incl.PPN',10,0,'L',0);
			$pdf->Ln(12);
			
			
			
			$pdf->SetFont('Arial','B',11);
			$pdf->Cell(30,10,'Claim Term',1,0,'C',1);
			$pdf->Cell(23,10,'Date',1,0,'C',1);
			$pdf->Cell(65,10,'No. CJC',1,0,'C',1);
			#$pdf->Cell(40,7,'TOP',1,0,'C',1);
			$pdf->Cell(30,10,'Value',1,0,'C',1);
			$pdf->Cell(20,10,'Progress',1,0,'C',1);
			$pdf->Cell(120,10,'Remark',1,0,'C',1);
			
			
			
		
			$pdf->SetFont('Arial','',6);
			
			$i = 1;	
			$no = 1;
			$noo = 0;
			$max = 15;	
			$pdf->Ln(10);
			$totvalue = 0;
			$totprog = 0;
					
			
	foreach(@$claim as $row){
		
					if($noo == $max){ 
			$pdf->AddPage();
			//				
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#HEADER CONTENT
				$pt			= "GRAHA MULTI INSANI";
				$judul 		= "Historical Claim";
				
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
				
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
								
		
			
			
			#$pdf->SetX(2);
			$pdf->SetFont('Arial','B',10);
			$pdf->Ln(4);
			$pdf->Cell(40,5,'Contract No.',10,0,'L',0);
			$pdf->Cell(3,5,':',10,0,'C',0);
			$pdf->Cell(65,5,'',10,0,'C',0);
			$pdf->Ln(4);
			
			$pdf->Cell(40,5,'Contractor',10,0,'L',0);
			$pdf->Cell(3,5,':',10,0,'C',0);
			$pdf->Cell(65,5,'',10,0,'C',0);
			$pdf->Ln(4);
			
			$pdf->Cell(40,5,'Job',10,0,'L',0);
			$pdf->Cell(3,5,':',10,0,'C',0);
			$pdf->Cell(65,5,'',10,0,'C',0);
			$pdf->Ln(4);
			
			$pdf->Cell(40,5,'Total Contract',10,0,'L',0);
			$pdf->Cell(3,5,':',10,0,'C',0);
			$pdf->Cell(65,5,'',10,0,'C',0);
			$pdf->Ln(12);
			
			
			
			$pdf->SetFont('Arial','B',11);
			$pdf->Cell(8,7,'No',1,0,'C',1);
			$pdf->Cell(30,7,'Date',1,0,'C',1);
			$pdf->Cell(45,7,'No. CJC',1,0,'C',1);
			$pdf->Cell(40,7,'TOP',1,0,'C',1);
			$pdf->Cell(35,7,'Value',1,0,'C',1);
			$pdf->Cell(30,7,'Progress',1,0,'C',1);
			$pdf->Cell(70,7,'Remark',1,0,'C',1);
			
			
			$pdf->Ln(7); 
			$noo = 0;
	
			
		}
	
			
			$totvalue = $totvalue +  $row->claim_amount;
			$totprog = $totprog + $row->prog;
			
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(30,10,'Pembayaran '.$no,1,0,'L',0);
			$pdf->Cell(23,10,indo_date($row->date_cjc),1,0,'C',0);
			$pdf->Cell(65,10,$row->no_cjc,1,0,'L',0);
			#$pdf->Cell(40,10,$row->ket_spk,1,0,'C',0);
			$pdf->Cell(30,10,number_format($row->claim_amount),1,0,'R',0);
			$pdf->Cell(20,10,number_format($row->prog).' %',1,0,'C',0);
			$pdf->Cell(120,10,$row->remark,1,0,'L',0);
		
			$pdf->Ln(10);		
			$i++;
			$no++;
			$noo++;
		
	}
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(118,10,'T O T A L',1,0,'C',0);
			$pdf->Cell(30,10,number_format($totvalue),1,0,'R',0);	
			$pdf->Cell(20,10,number_format($totprog).' %',1,0,'C',0);	
			$pdf->Cell(120,10,'',1,0,'C',0);	
		
		
			$pdf->Output("hasil.pdf","I");	;
	
