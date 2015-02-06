<?php

		
			require('fpdf/tanpapage.php');
			extract(PopulateForm());
			$pdf=new PDF('L','mm','A4');
			
			$pdf->SetMargins(4,10,4);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			extract(PopulateForm());
			#HEAD
			#HEADER CONTENT
				$rows = $this->db->where('subproject_id',$proj_rptbgt)
						->get('db_subproject')->row();
				
				$pt		= "PT. Graha Multi Insani";
				$periode	= "Periode";
				$judul = "SUMMARY PROJECT COST REPORT";
	
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
				#$pdf->Cell(0,10,'As Of'.' : '. ' ',20,0,'L');
		
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
			
			// Start Isi Tabel
			
			
							
			$pdf->SetX(6);
			
			
			$pdf->SetFont('Arial','',10);
				
			
				
			$pdf->Ln(4);
			
			$pdf->Cell(30,5,'Project Name',10,0,'R',0);
			$pdf->Cell(2,5,':',10,0,'C',0);
			$pdf->Cell(40,5,$rows->nm_subproject,10,0,'L',0);
			$pdf->Ln(5);
			#$pdf->Cell(30,5,'Total Project',10,0,'R',0);
			#$pdf->Cell(2,5,':',10,0,'C',0);
			#$pdf->Cell(40,5,'',10,0,'R',0);
			#$pdf->Ln(5);
			#$pdf->Cell(30,5,'Land Effective',10,0,'R',0);
			#$pdf->Cell(2,5,':',10,0,'C',0);
			#$pdf->Cell(40,5,'',10,0,'R',0);
			#$pdf->Ln(5);
			#$pdf->Cell(30,5,'SGFA',10,0,'R',0);
			#$pdf->Cell(2,5,':',10,0,'C',0);
			#$pdf->Cell(40,5,'',10,0,'R',0);
			#$pdf->Ln(5);
			#$pdf->Cell(30,5,'GBA',10,0,'R',0);
			#$pdf->Cell(2,5,':',10,0,'C',0);
			#$pdf->Cell(40,5,'',10,0,'R',0);
			$pdf->Ln(5);
			
			$pdf->Cell(60,15,'Development Cost',1,0,'C',1);
			$pdf->Cell(32,15,'Budget',1,0,'C',1);
			$pdf->Cell(160,5,'Commitment Contract',1,0,'C',1);
			$pdf->Cell(32,15,'Uncommitment',1,0,'C',1);
			
			
			$pdf->Ln(5);
					
			$pdf->SetX(96);
			$pdf->Cell(32,10,'Contract Amount',1,0,'C',1);
			$pdf->Cell(96,5,'Invoice',1,0,'C',1);
			$pdf->Cell(32,10,'CTC',1,0,'C',1);
			#$pdf->Cell(30,10,'Budget',1,0,'C',1);
			
			
			$pdf->Ln(5);
			$pdf->SetX(128);
			$pdf->Cell(32,5,'Progress',1,0,'C',1);
			$pdf->Cell(32,5,'Paid',1,0,'C',1);
			$pdf->Cell(32,5,'Outstanding',1,0,'C',1);
			#$pdf->Cell(30,10,'Budget',1,0,'C',1);
			
			
			#$pdf->Ln(5);
			
		
			$pdf->SetFont('Arial','',9);
			
			$i = 1;	
			$no = 0;
			$max = 22;	
			$pdf->Ln(5);
			$totbudget = 0;
			$totcotr	= 0;
		    $totinoive = 0;
			$totpaid= 0;
			$totos=0;
			$totctc=0;
			$totuncomit=0;
			
	
			
			$tanggal = inggris_date($tgl);


			#die($proj_rptbgt);
			$query = $this->db->query("sp_printsumbgtproj '".$proj_rptbgt."'")->result();
			
			
			foreach($query as $row){
				$pdf->SetFont('Arial','B',9);
				#$pdf->Cell(10,8,$i,1,0,'C',0);
				#$pdf->Cell(50,8,$row->nm_bgtproj,1,0,'L',0);
				
			#$os = $row->Invoice - $row->Paid;
			#$ctc = $row->nilai_kontrak - $row->Invoice; 
			$uncomit = $row->nilai_budget - $row->nilai_kontrak;
			
			$pdf->Cell(60,10,$row->nm_scost,1,0,'L',0);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(32,10,number_format($row->nilai_budget),1,0,'R',0);
			$pdf->Cell(32,10,number_format($row->nilai_kontrak),1,0,'R',0);
			$pdf->Cell(32,10,''/*number_format($row->Invoice)*/,1,0,'R',0);
			$pdf->Cell(32,10,'',1,0,'R',0);
			$pdf->Cell(32,10,''/*number_format($os)*/,1,0,'R',0);
			$pdf->Cell(32,10,''/*number_format($ctc)*/,1,0,'R',0);
			$pdf->Cell(32,10,number_format($uncomit),1,0,'R',0);
			#$pdf->Cell(32,10,number_format(1000000000000),1,0,'R',0);
			
			$pdf->Ln(10);				
			$i++;
			$no++;
			
			$totbudget  = $totbudget + $row->nilai_budget;
			$totcotr	= $totcotr + $row->nilai_kontrak;
		    #$totinoive 	= $totinoive + $row->Invoice;
			#$totpaid	= $totpaid + $row->Paid;
			#$totos		=$totos + $os;
			#$totctc		=$totctc + $ctc;
			$totuncomit	= $totuncomit + $uncomit;
			
			
		
	}
	
	
			#$pdf->Ln(5);
			$pdf->SetFont('Arial','B',10);
			$pdf->setFillColor(222,222,222);
			$pdf->Cell(60,10,'TOTAL',1,0,'R',1);
			$pdf->Cell(32,10,number_format($totbudget),1,0,'R',1);
			$pdf->Cell(32,10,number_format($totcotr),1,0,'R',1);
			$pdf->Cell(32,10,''/*number_format($totinoive)*/,1,0,'R',1);
			$pdf->Cell(32,10,''/*number_format($totpaid)*/,1,0,'R',1);
			$pdf->Cell(32,10,''/*number_format($totos)*/,1,0,'R',1);
			$pdf->Cell(32,10,''/*number_format($totctc)*/,1,0,'R',1);
			$pdf->Cell(32,10,number_format($totuncomit),1,0,'R',1);
			$pdf->Output("hasil.pdf","I");	;
	
