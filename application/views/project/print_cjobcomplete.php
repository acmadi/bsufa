<?php

		
			require('fpdf/tanpapage.php');
			include_once( APPPATH."libraries/translate_currency.php");
			extract(PopulateForm());
			$pdf=new PDF('P','mm','A4');
			
			#var_dump($detjob);
			
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			#HEAD
			#HEADER CONTENT
			#$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$PT 		= "PT. Graha Multi Insani";
				$project	= "Project";
				$judul		= "CERTIFICATE OF JOB COMPLETION";
	
			#CETAK TANGGAL
				#$tgl  = date("d-m-Y");
			#TANGGAL CETAK
				
			#	$pdf->Cell(10,4,$tgl,0,0,'L');
			
				#Header
		#$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetX(25);
				$pdf->SetFont('Arial','B',18);
				$pdf->Cell(0,10,$PT,20,0,'L');
				$pdf->Ln(10);
				
				#$pdf->SetX(25);
				#$pdf->SetFont('Arial','B',11);
				#$pdf->Cell(0,10,$project,20,0,'L');
				#$pdf->Ln(5);
				
				$pdf->SetX(25);
				$pdf->SetFont('Arial','B',12);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(10);
				
			// Start diatas tabel
			
			$pdf->SetFont('Arial','',10);
			
			$pdf->SetX(5);
			$pdf->Cell(50,5,'DATE',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(30,5,indo_date(@$rows->date_cjc),10,0,'L');
			$pdf->Ln(8);
			
			$pdf->SetX(5);
			$pdf->Cell(50,5,'CJC NO.',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(30,5,@$rows->no_cjc,10,0,'L');
			$pdf->Ln(8);
			
			$pdf->SetX(5);
			$pdf->Cell(50,5,'CONTRACT NO.',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(80,5,@$rows->no_kontrak,10,0,'L');
			$pdf->Ln(8);
			
			$pdf->SetX(5);	
			$pdf->Cell(50,5,'CONTRACT COST (Rp.)',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(80,5,number_format($rows->contract_amount).' (Incl. PPN 10%)',10,0,'L');
			$pdf->Ln(8);
			
			$pdf->SetX(5);	
			$pdf->Cell(50,5,'CONTRACTOR NAME',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(100,5,@$rows->nm_supplier,10,0,'L');
			$pdf->Ln(8);
			
			$pdf->SetX(5);	
			$pdf->Cell(50,5,'CONTRACTOR ADDRESS',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(100,5,@$rows->alamat,10,0,'L');
			$pdf->Ln(12);
			
			$pdf->SetX(5);	
			$pdf->Cell(50,5,'JOB',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(100,5,@$rows->mainjob_desc,10,0,'L');
			$pdf->Ln(12);
			
			$pdf->SetX(5);	
			$pdf->Cell(50,5,'PREVIOUS PROGRESS (%)',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(40,5,@$rows->nilai.'%',10,0,'R');
			$pdf->Ln(8);
			
			$pdf->SetX(5);	
			$pdf->Cell(50,5,'THIS TERM PROGRESS (%)',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(40,5,@$rows->proposed_progress.'%',10,0,'R');
			$pdf->Ln(8);
			
			$pdf->SetX(5);	
			
			$pdf->Cell(50,5,'PROGRESS VALUE (Rp) ',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->SetFont('Arial','B','10');
			$pdf->Cell(40,5,number_format(@$rows->claim_amount),10,0,'R');
			$pdf->Cell(40,5,'(Incl. PPN 10%)',10,0,'L');
			$pdf->Ln(8);
			$pdf->SetFont('Arial','','10');
			$pdf->SetX(5);	
			$pdf->Cell(50,5,'',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->SetFont('Arial','B','10');
			$claim = number_format(@$rows->claim_amount);
			$pdf->Cell(40,5,'('.ucwords(toRupiah($claim)).' Rupiah)',10,'b','L');
			
			$pdf->Ln(8);
			$pdf->SetFont('Arial','','10');
			#TIPE BAYAR
			#if(@$rows->pemby_id == 1){ 
			#	$bayar = 'DP';
			#	}
			#elseif(@$rows->pemby_id == 2){ $bayar = 'Progress';}
			#else{ $bayar = 'Retenssi';}
			
			#END
			
			$pdf->SetX(5);	
			$pdf->Cell(50,5,'REMARK ',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(100,5,@$rows->remark,10,0,'L');
			$pdf->Ln(10);
			$pdf->SetX(5);
			#start Tabel
			$pdf->SetFont('Arial','',10);
			/*$pdf->Cell(7,8,'No',1,0,'C',1);
			#$pdf->Cell(10,8,'Qty',1,0,'C',1);
			#$pdf->Cell(15,8,'Unit',1,0,'C',1);
			$pdf->Cell(90,8,'Detail Job Description',1,0,'C',1);
			$pdf->Cell(87,4,'Precentage of progress by management team',1,0,'C',1);
			$pdf->Ln(4);
			
			#$pdf->Cell(13,0,'',0,0,'C',0);
			#$pdf->Cell(10,0,'',0,0,'C',0);
			#$pdf->Cell(15,0,'',0,0,'C',0);
			#$pdf->Cell(81,0,'',0,0,'C',0);
			#$pdf->Cell(21.75,4,'This Month',1,0,'C',1);		
			$pdf->SetXY(102,106);
			$pdf->Cell(21.75,4,'This Month',1,0,'C',1);
			$pdf->Cell(21.75,4,'Previous',1,0,'C',1);		
			$pdf->Cell(21.75,4,'YTD',1,0,'C',1);		
			$pdf->Cell(21.75,4,'Balance',1,0,'C',1);*/
			$pdf->Ln(10);
			

			
			
			#var_dump(@$id);
			$i = 1;	
			$no = 0;
			#oreach($cek as $ro){
			$pdf->SetX(15);
			#$pdf->Cell(40,4,@$detjob->job,1,0,'L',0);
			#
			#var_dump($detjob);
			/*foreach($detjob as $row){
			$pdf->SetX(5);
			$pdf->Cell(7,4,$i,1,0,'C',0);
			#$pdf->Cell(10,4,@$row->qty,1,0,'C',0);
			#$pdf->Cell(15,4,@$row->unit,1,0,'C',0);
			$pdf->Cell(90,4,@$row->job,1,0,'L',0);
			#$pdf->Cell(21.75,4,number_format(@$row->nil_prog),1,0,'C',0);		
			#$pdf->Cell(21.75,4,'',1,0,'C',0);		
			$pdf->Cell(21.75,4,number_format(@$row->thismon),1,0,'C',0);
			$pdf->Cell(21.75,4,number_format(@$row->prev),1,0,'C',0);
			$pdf->Cell(21.75,4,number_format(@$row->ytd),1,0,'C',0);		
			$pdf->Cell(21.75,4,number_format(@$row->blc),1,0,'C',0);
			$pdf->Ln(4);	
			$i++;	
				
			}*/
			$pdf->Ln(10);		
			$pdf->SetX(5);
			$pdf->SetFont('Arial','',7);
		
			$pdf->Cell(40,6,substr(@$rows->nm_supplier,0,25),1,0,'C',0);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(80,6,'CHECKED BY',1,0,'C',0);
			#$pdf->Cell(50,6,'REVIEW BY',1,0,'C',0);
			$pdf->Cell(80,6,'APPROVED BY',1,0,'C',0);
			$pdf->Ln(6);
			
			$pdf->SetX(45);
			#$pdf->Cell(30,8,'',0,0,'C',0);
			$pdf->Cell(40,6,'General Manager',1,0,'C',0);
			$pdf->Cell(40,6,'Finance Control',1,0,'C',0);
			$pdf->Cell(40,6,'Director',1,0,'C',0);		
			#$pdf->Cell(30,3,'COO',1,0,'C',0);		
			$pdf->Cell(40,6,'CFO',1,0,'C',0);		
			$pdf->Ln(6);
			
			$pdf->SetX(5);
			$pdf->Cell(40,30,'',1,0,'C',0);
			$pdf->Cell(40,30,'',1,0,'C',0);
			$pdf->Cell(40,30,'',1,0,'C',0);
			$pdf->Cell(40,30,'',1,0,'C',0);		
			$pdf->Cell(40,30,'',1,0,'C',0);		
			#$pdf->Cell(40,15,'',1,0,'C',0);		
			$pdf->Ln(30);
			
			
		
	
	
	
				$pdf->SetFont('Arial','',7);
				$pdf->SetXY(180,10);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
				$pdf->Cell(2,4,':',4,0,'L');
				$pdf->Cell(2,4,date("d-m-Y"),4,0,'L');
			$pdf->Output("hasil.pdf","I");

