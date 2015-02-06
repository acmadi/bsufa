<?php
			require('fpdf/tanpapage.php');
			
			extract(PopulateForm());
			$pdf=new PDF('L','mm','A4');
			$pt = 44;
			$pdf->SetMargins(20,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			
			
			#HEAD
			#HEADER CONTENT
				
				$judul 		= "Proposed Budget";
				$periode	= "";
	
			#CETAK TANGGAL
				$tglcetak  = date("d-m-Y");
			#TANGGAL CETAK
				$pdf->SetFont('Arial','',6);
				$pdf->SetXY(258,10);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							
				$pdf->SetXY(268,10);
				$pdf->Cell(2,4,':',4,0,'L');
								
				$pdf->SetXY(269,10);
				$pdf->Cell(10,4,$tglcetak,0,0,'L');
			
			#Header
				$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
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
						
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(30,5,'Date',20,0,'L');
			$pdf->Cell(2,5,':',20,0,'C');
			$pdf->Cell(30,5,$tgl,20,0,'L');
			$pdf->Ln(5);
			#$pdf->SetFont('Arial','B',9);
			$pdf->Cell(30,5,'Job',10,0,'L',0);
			$pdf->Cell(2,5,':',10,0,'C',0);
			$pdf->Cell(65,5,$job,10,0,'L',0);
			$pdf->Ln(10);
			
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(8,5,'No',1,0,'C',1);
			$pdf->Cell(90,5,'Detail Job',1,0,'C',1);
			$pdf->Cell(80,5,'Budget Description',1,0,'C',1);
			$pdf->Cell(30,5,'Total Budget',1,0,'C',1);
			$pdf->Cell(30,5,'Balanced Budget',1,0,'C',1);
			$pdf->Cell(30,5,'Proposed Budget',1,0,'C',1);
			
			
		
			$pdf->SetFont('Arial','',6);
			
			$i = 1;	
			$no = 1;
			$noo = 0;
			$max = 15;	
			$pdf->Ln(5);
			
					
	$data = $this->db->join('db_bgtprojcode','kd_bgtproj = kode_bgtproj')
					 ->where('no_trbgtproj',$no_prop)
					 ->get('db_trbgtproj')->result();
	$total = 0;		 
	foreach($data as $row){
		if($noo == $max){ 
			$pdf->AddPage();
			//				
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#HEADER CONTENT
				$pt			= "Graha Multi Insani";
				$judul 		= "";
				$periode	= "";
				
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
				$pdf->Cell(0,10,'',20,0,'L');
			
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(1);
				$pdf->Cell(0,0,'',1,0,'L');
			
			
			#start Tabel
			$pdf->SetX(2);
			$pdf->SetFont('Arial','B',10);
			$pdf->Ln(4);
			$pdf->Cell(8,5,'',1,0,'C',1);
			$pdf->Cell(65,5,'Proposed Budget',1,0,'C',1);
			$pdf->Ln(5);

			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(8,5,'No',1,0,'C',1);
			$pdf->Cell(90,5,'Detail Job',1,0,'C',1);
			$pdf->Cell(80,5,'Budget Description',1,0,'C',1);
			$pdf->Cell(30,5,'Total Budget',1,0,'C',1);
			$pdf->Cell(30,5,'Balanced Budget',1,0,'C',1);
			$pdf->Cell(30,5,'Proposed Budget',1,0,'C',1);
			
			
			
			$pdf->Ln(5);
			$noo = 0;
	
			
		}
	$a = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa4";
			$total = $total + $row->nilai_proposed;
			$pdf->SetFont('Arial','',8);
			$blc = $row->total_bgt - ($row->total_prop + $row->nilai_proposed);
			$pdf->Cell(8,5,$no,1,0,'C',0);
			$pdf->Cell(90,5,$row->main_job,1,0,'L',0);
			$pdf->Cell(80,5,$row->nm_bgtprojcode,1,0,'L',0);
			$pdf->Cell(30,5,number_format($row->total_bgt),1,0,'R',0);
			$pdf->Cell(30,5,number_format($blc),1,0,'R',0);
			$pdf->Cell(30,5,number_format($row->nilai_proposed),1,0,'R',0);
			
		
			$pdf->Ln(5);		
			$i++;
			$no++;
			$noo++;
		
	}
			$pdf->SetFont('Arial','B',8);
	  	
			//$pdf->Cell(8,5,$no,1,0,'C',0);
			$pdf->Cell(8,5,'',10,0,'C',0);
			$pdf->Cell(90,5,'',10,0,'L',0);
			$pdf->Cell(80,5,'',10,0,'L',0);
			$pdf->Cell(30,5,'',10,0,'R',0);
			$pdf->Cell(30,5,'Total',1,0,'L',1);
			$pdf->Cell(30,5,number_format($total),1,0,'R',1);
			$pdf->Ln(30);
			
			
			$pdf->SetFont('Arial','B',10);
			if($total > 30000000){
			
			$pdf->Cell(98,5,'Proposed by :',10,0,'L',0);
			$pdf->Cell(80,5,'Approved by :',10,0,'C',0);
			$pdf->Cell(40,5,'',10,0,'R',0);
			$pdf->Cell(30,5,'Acknowledge :',10,0,'L',0);
			$pdf->Cell(30,5,'',10,0,'R',0);
			$pdf->Ln(30);
			
			
			
			$pdf->Cell(98,5,'(Project Manager)',10,0,'L',0);
			$pdf->Cell(80,5,'(General Manager)',10,0,'C',0);
			$pdf->Cell(40,5,'',10,0,'R',0);
			$pdf->Cell(30,5,'(Director)',10,0,'L',0);
			$pdf->Cell(30,5,'',10,0,'R',0);}
			
			else{
			$pdf->Cell(98,5,'Proposed by :',10,0,'L',0);
			$pdf->Cell(80,5,'Approved by :',10,0,'C',0);
			$pdf->Cell(40,5,'',10,0,'R',0);
			
			$pdf->Ln(30);
			
			
			
			$pdf->Cell(98,5,'(Project Manager)',10,0,'L',0);
			$pdf->Cell(80,5,'(General Manager)',10,0,'C',0);
			$pdf->Cell(40,5,'',10,0,'R',0);
			
			
				
				}
			
			
		
		
			$pdf->Output("hasil.pdf","I");	;
	
