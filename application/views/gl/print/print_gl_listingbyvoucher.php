<?php

		
			require('fpdf/classreport.php');
			extract(PopulateForm());
			$pdf=new PDF('P','mm','A4');
			
			// $data = $this->db->query("sp_printgeneralledger '".inggris_date($tgl)."'")
							 // ->result();
							 
			$rows= $this->db->query("sp_printgeneralledger2 '".inggris_date($tgl)."', '".inggris_date($tgl2)."','".$project_detail."'")->result();
			
			$pdf->SetMargins(3,5,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEADER CONTENT
				$pt			= "PT. BAKRIE SWASAKTI UTAMA";
				$judul 		= "JOURNAL TRANSACTION LISTING";
				$periode	= "Periode";
	
			#CETAK TANGGAL
				$tgl1  = date("d-m-Y");
			#TANGGAL CETAK
				$pdf->SetFont('Arial','',6);
				/*
				$pdf->SetXY(258,10);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							
				$pdf->SetXY(268,10);
				$pdf->Cell(2,4,':',4,0,'L');
								
				$pdf->SetXY(269,10);
				$pdf->Cell(10,4,$tgl,0,0,'L');
				*/
				$pdf->Ln(1);
			
			#Header
				//$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',16);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','',8);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'As Of'.' : '.inggris_date($tgl). ' s/d '.inggris_date($tgl2),20,0,'L');
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(1);
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(5);
		
			// Start Isi Tabel
			
			$pdf->SetFont('Arial','B',7);
			$pdf->Ln(4);
			
			$pdf->Cell(15,10,'Trans. Date',10,0,'C',0);
			$pdf->Cell(20,10,'Account No.',10,0,'C',0);
			$pdf->Cell(30,10,'Acc. Name',10,0,'C',0);
			$pdf->Cell(78,10,'Description',10,0,'C',0);
			$pdf->Cell(60,5,'In Base Currency',10,0,'C',0);
			$pdf->Ln(5);
			
			$pdf->Cell(15,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(30,5,'',10,0,'C',0);
			$pdf->Cell(78,5,'',10,0,'C',0);
			$pdf->Cell(30,5,'Debit',10,0,'R',0);
			$pdf->Cell(30,5,'Credit',10,0,'R',0);
			
			
			
		
			$pdf->SetFont('Arial','',6);
			
			$i = 1;	
			$h = 1;
			$no = 1;
			$noo = 0;
			$max = 5;	
			$pdf->Ln(5);
			
//for($h = 1;$h <= 2; $i++){		
	foreach($rows as $row){	

			$pdf->SetFont('Arial','B',7);		
			$pdf->Cell(15,10,indo_date($row->trans_date),10,0,'L',0);
			$pdf->Cell(30,10,$row->voucher,10,0,'L',0);
			
			$pdf->Cell(78,10,substr($row->desc,0,100),10,0,'L',0);
			$pdf->Ln(3);
			$pdf->SetX(48);
			$pdf->Cell(78,10,substr($row->desc,100,200),10,0,'L',0);
			
			$pdf->Ln(6);
			
			$voucher = $row->voucher;
			
			$data2 = $this->db->query("sp_printgeneralledger '".$voucher."'")
							 ->result();
			
			
	
	//for($i = 1;$i <= 29; $i++){
		//foreach($data as $row){	

		//~ if($noo == $max){ 
			//~ $pdf->AddPage();
			//~ //				
			//~ #CETAK TANGGAL
				//~ $tgl  = date("d-m-Y");
			//~ #HEADER CONTENT
				//~ $pt			= "PT. GRAHA MULTI INSANI";
				//~ $judul 		= "JOURNAL TRANSACTION LISTING";
				//~ $periode	= "Periode";
	//~ 
			//~ #CETAK TANGGAL
				//~ $tgl1  = date("d-m-Y");
			//~ #TANGGAL CETAK
				//~ $pdf->SetFont('Arial','',6);
				//~ /*
				//~ $pdf->SetXY(258,10);
				//~ $pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							//~ 
				//~ $pdf->SetXY(268,10);
				//~ $pdf->Cell(2,4,':',4,0,'L');
								//~ 
				//~ $pdf->SetXY(269,10);
				//~ $pdf->Cell(10,4,$tgl,0,0,'L');
				//~ */
				//~ $pdf->Ln(1);
			//~ 
			//~ #Header
				//~ $pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				//~ $pdf->SetFont('Arial','B',16);
	//~ 
				//~ $pdf->SetX(25);
				//~ $pdf->Cell(0,10,$pt,20,0,'L');
			//~ 
				//~ $pdf->SetFont('Arial','B',12);
				//~ 
				//~ $pdf->SetXY(25,16);
				//~ $pdf->Cell(0,10,$judul,20,0,'L');
				//~ $pdf->SetFont('Arial','',8);
				//~ $pdf->SetXY(25,22);
				//~ $pdf->Cell(0,10,'As Of'.' : '.inggris_date($tgl). ' s/d '.inggris_date($tgl2),20,0,'L');
				//~ $pdf->Ln(10);
				//~ 
				//~ $pdf->Cell(0,0,'',1,0,'L');
				//~ $pdf->Ln(1);
				//~ $pdf->Cell(0,0,'',1,0,'L');
			//~ 
			//~ 
			//~ 
			//~ $pdf->SetX(2);
			//~ $pdf->SetFont('Arial','B',8);
			//~ $pdf->Ln(4);
			//~ $pdf->Cell(15,10,'Trans. Date',10,0,'C',0);
			//~ $pdf->Cell(20,10,'Account No.',10,0,'C',0);
			//~ $pdf->Cell(30,10,'Acc. Name',10,0,'C',0);
			//~ $pdf->Cell(78,10,'Description',10,0,'C',0);
			//~ $pdf->Cell(60,5,'In Base Currency',10,0,'C',0);
			//~ $pdf->Ln(5);
			//~ 
			//~ $pdf->Cell(15,5,'',10,0,'C',0);
			//~ $pdf->Cell(20,5,'',10,0,'C',0);
			//~ $pdf->Cell(30,5,'',10,0,'C',0);
			//~ $pdf->Cell(78,5,'',10,0,'C',0);
			//~ $pdf->Cell(30,5,'Debit',10,0,'R',0);
			//~ $pdf->Cell(30,5,'Credit',10,0,'R',0);
			//~ 
			//~ 
			//~ $pdf->Ln(5);
			//~ $noo = 0;
	//~ 
			//~ 
		//~ }

$pdf->Ln(3);		
					$a=0;
					$b=0;
$pdf->SetFont('Arial','',7);
					foreach($data2 as $roow){
					$a = $a + $roow->debit;
					$b = $b + $roow->credit;
							$pdf->Cell(15,5,'',10,0,'L',0);
							$pdf->Cell(20,5,$roow->acc_no,10,0,'L',0);
							$pdf->Cell(30,5,substr($roow->acc_name,0,22),10,0,'L',0);
							$pdf->Cell(78,5,substr($roow->line_desc,0,70),10,0,'L',0);
							$pdf->Cell(30,5,number_format($roow->debit),10,0,'R',0);
							$pdf->Cell(30,5,number_format($roow->credit),10,0,'R',0);
							$pdf->Ln(3);
							$pdf->SetX(38);
							$pdf->Cell(30,5,substr($roow->acc_name,22,40),10,0,'L',0);
							$pdf->Cell(78,5,substr($roow->line_desc,70,100),10,0,'L',0);
							$pdf->Ln(3);	
	
					
	
					
					}
					
		#buat garis		
			$pdf->Ln(3);
			$pdf->Cell(15,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'L',0);
			$pdf->Cell(30,5,'',10,0,'R',0);
			$pdf->Cell(78,5,'',10,0,'R',0);
			$pdf->Cell(30,0,'',1,0,'C',0);
			$pdf->Cell(30,0,'',1,0,'C',0);
			
			$pdf->Ln(1);
			
			$pdf->SetFont('Arial','B',6);
			$pdf->Cell(15,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'L',0);
			$pdf->Cell(30,5,'',10,0,'R',0);
			$pdf->Cell(78,5,'Sub Total :',10,0,'R',0);
			if ($a < 0) {
				$pdf->Cell(30,5,number_format($a*-1),10,0,'R',0);
			} else {
				$pdf->Cell(30,5,number_format($a),10,0,'R',0);
			}
			if ($b < 0) {
				$pdf->Cell(30,5,number_format($b*-1),10,0,'R',0);
			} else {
				$pdf->Cell(30,5,number_format($b),10,0,'R',0);
			}
			$pdf->Ln(3);		
					
			$pdf->Ln(3);
			$pdf->Cell(15,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'L',0);
			$pdf->Cell(30,5,'',10,0,'R',0);
			$pdf->Cell(78,5,'',10,0,'R',0);
			$pdf->Cell(30,0,'',1,0,'C',0);
			$pdf->Cell(30,0,'',1,0,'C',0);
			
			$pdf->Ln(1);
	
	
	
	$pdf->Ln(3);
	$h++;
	$noo++;
	}
//	}
				$pdf->SetFont('Arial','B',6);
	  	
			$pdf->Ln(15);
				$pdf->SetFont('Arial','',6);
				$pdf->SetX(180);
				//~ $pdf->Cell(10,4,'Print Date',0,0,'L',0);	
				//~ $pdf->Cell(2,4,':',4,0,'L');
				//~ $pdf->Cell(2,4,date("Y-m-d"),4,0,'L');
			$pdf->Output("hasil.pdf","I");	;
	
