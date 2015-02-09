<?php

		
			require('fpdf/tanpapage.php');
			extract(PopulateForm());
			$pdf=new PDF('P','mm','A4');
			
			$pdf->SetMargins(10,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];
			$data_pt = $this->mstmodel->get_nama_pt($pt);
			$nama_pt = $data_pt['ket'];
			
			#HEAD
			#HEADER CONTENT
				$pt			= "PT. Bakrie Swasakti Utama";
				$judul 		= "Reimburs Petty Cash";
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
				#$pdf->Image(site_url().'assets/img/thewave.png',10,10,55);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(70);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(70,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(70,22);
				$pdf->Cell(0,10,'As Of'.' : '.indo_date($tgl1). ' s/d '.indo_date($tgl2),20,0,'L');
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
								
			
			// Start Isi Tabel
			
		
		
			$pdf->SetFont('Arial','B',7);
			$pdf->Ln(4);
			
			$pdf->Cell(8,5,'No',1,0,'C',1);
			$pdf->Cell(20,5,'Tanggal',1,0,'C',1);
			$pdf->Cell(20,5,'Nomor',1,0,'C',1);
			$pdf->Cell(85,5,'Keterangan',1,0,'C',1);
			$pdf->Cell(20,5,'Debit',1,0,'C',1);
			$pdf->Cell(20,5,'Kredit',1,0,'C',1);
			$pdf->Cell(20,5,'Saldo',1,0,'C',1);
			
			
		
			$pdf->SetFont('Arial','',6);
			
			$i = 1;	
			$no = 1;
			$noo = 0;
			$max = 45;	
			$pdf->Ln(5);
			
			$que = "select * from db_pettyclaim 
					where claim_date between '".inggris_date($tgl1)."' and '".inggris_date($tgl2)."'  order by pettycash_id";
			$query = $this->db->query($que)->result();		
	
	foreach($query as $row){
	#for($i = 1;$i <= 200; $i++){
		if($noo == $max){ 
			$pdf->AddPage();
			//				
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#HEADER CONTENT
				
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
				#$pdf->Image(site_url().'assets/img/thewave.png',10,10,55);		
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(70);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(70,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(70,22);
				$pdf->Cell(0,10,'As Of'.' : '.indo_date($tgl1). ' s/d '.indo_date($tgl2),20,0,'L');
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
								
		
			
			
			$pdf->SetX(2);
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(4);
			$pdf->Cell(8,5,'No',1,0,'C',1);
			$pdf->Cell(20,5,'Tanggal',1,0,'C',1);
			$pdf->Cell(20,5,'Nomor',1,0,'C',1);
			$pdf->Cell(85,5,'Keterangan',1,0,'C',1);
			$pdf->Cell(20,5,'Debit',1,0,'C',1);
			$pdf->Cell(20,5,'Kredit',1,0,'C',1);
			$pdf->Cell(20,5,'Saldo',1,0,'C',1);
		
			
			
			$pdf->Ln(5);
			$noo = 0;
	
			
		}
	$a = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa4";
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(8,5,$no,1,0,'C',0);
			$pdf->Cell(20,5,indo_date($row->claim_date),1,0,'C',0);
			$pdf->Cell(20,5,$row->claim_no,1,0,'L',0);
			$pdf->Cell(85,5,$row->petty_desc,1,0,'L',0);
			$pdf->Cell(20,5,number_format($row->debet),1,0,'R',0);
			$pdf->Cell(20,5,number_format($row->credit),1,0,'R',0);
			$pdf->Cell(20,5,number_format($row->saldo),1,0,'R',0);
			
		
			$pdf->Ln(5);		
			$i++;
			$no++;
			$noo++;
		
	}
			$pdf->SetFont('Arial','B',6);
	  	
			//~ //$pdf->Cell(8,5,$no,1,0,'C',0);
			//~ $pdf->Cell(73,5,'GRAND TOTAL',1,0,'C',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'L',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'C',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'C',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'C',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'C',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'R',1);
		//~ $pdf->Ln(10);
		
		$pdf->SetFont('Arial','',6);
				$pdf->SetX(180);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
				$pdf->Cell(2,4,':',4,0,'L');
				$pdf->Cell(2,4,date("Y-m-d"),4,0,'L');
			$pdf->Output("hasil.pdf","I");	;
	
