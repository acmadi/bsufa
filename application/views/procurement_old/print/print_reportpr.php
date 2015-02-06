<?php

		
			require('fpdf/tanpapage.php');
			extract(PopulateForm());
			
			//die($ven);
			//$div = '';
		
		
			
			$data = $this->db->query("sp_allreportpr '".$div."','".$kat."','".$ven."','".inggris_date($start_date)."','".inggris_date($end_date)."'")
							 ->result();
			//var_dump($ven);
			$pdf=new PDF('L','mm','A4');
				if ($kat == 1){
						$kat = 'Divisi';
					}else if ($kat == 2){
						$kat = 'Vendor';
					}else if ($kat == 3){
						$kat = 'ALL';
					}else {
						$kat = 'anda salah syntax';
					}
				
				
				
			$pdf->SetMargins(7,0,0,5);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEADER CONTENT
				$judul 		= "ALL PR REPORT";
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
			
			
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$judul,20,0,'L');
			
				$pdf->SetFont('Arial','',8);
				
				
				$pdf->SetXY(25,16);
				$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);
				#$pdf->Cell(0,10,'Kategori'.' : '.$kat,20,0,'L');
				#$pdf->SetXY(25,19);
				$pdf->Cell(0,10,'Periode'.'  : '.indo_date($start_date).' - '.indo_date($end_date),20,0,'L');
	
				
			
			
		
			
			// Start Isi Tabel
			
		
							
			$pdf->SetX(5);
			
			
			$pdf->SetFont('Arial','',6);
				
			
			
			$pdf->Ln(25);
			
			
			$pdf->Cell(8,10,'No',1,0,'C',1);
			$pdf->Cell(29,5,'PR',1,0,'C',1);
			$pdf->Cell(37,5,'PO',1,0,'C',1);
			$pdf->Cell(37,5,'MRR',1,0,'C',1);
			$pdf->Cell(43,10,'VENDOR',1,0,'C',1);
			$pdf->Cell(43,10,'Description',1,0,'C',1);
			$pdf->Cell(20,10,'Amount',1,0,'C',1);
			$pdf->Cell(20,10,'Division',1,0,'C',1);
			$pdf->Cell(28,5,'Lead Time',1,0,'C',1);
			$pdf->Cell(20,10,'Remark',1,0,'C',1);
			
			
			$pdf->Ln(5);
			
			
			//$pdf->Cell(22,5,'I. THE 18th',1,0,'C',0);
			$pdf->Cell(8,5,'',0,0,'C',0);
			$pdf->Cell(14,5,'Date',1,0,'C',1);
			$pdf->Cell(15,5,'No',1,0,'C',1);
			$pdf->Cell(14,5,'Date',1,0,'C',1);
			$pdf->Cell(23,5,'No',1,0,'C',1);
			$pdf->Cell(14,5,'Date',1,0,'C',1);
			$pdf->Cell(23,5,'No',1,0,'C',1);
			$pdf->Cell(43,5,'',0,0,'R',0);
			$pdf->Cell(43,5,'',0,0,'R',0);
			$pdf->Cell(20,5,'',0,0,'R',0);
			$pdf->Cell(20,5,'',0,0,'R',0);
			$pdf->Cell(14,5,'PR to PO',1,0,'C',1);
			$pdf->Cell(14,5,'PO to MRR',1,0,'C',1);
			$pdf->Cell(20,5,'',0,0,'C',0);			
			
			
			
			
			
			//$pdf->Cell(22,5,'I. THE 18th',1,0,'C',0);
				
			
			
			$i = 1;	
			$no = 0;
			$max = 25;	
			$tothrg = 0;
			$pdf->Ln(5);	   
			foreach($data as $row){
				$tothrg = $tothrg + $row->harga_tot;
				if($no == $max){ 
					$pdf->AddPage();
					#HEADER CONTENT
				$judul 		= "ALL PR REPORT";
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
			
			#$month1 = date( 'F', mktime(0, 0, 0, $periode1));		
			#$month2 = date( 'F', mktime(0, 0, 0, $periode2));		
					
			#Header
			#$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$judul,20,0,'L');
			
				$pdf->SetFont('Arial','',8);
				
				$pdf->SetXY(25,16);
				$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);
				#$pdf->Cell(0,10,'Kategori'.' : '.$kat,20,0,'L');
				#$pdf->SetXY(25,19);
				$pdf->Cell(0,10,'Periode'.' : '.$start_date.' - '.$end_date,20,0,'L');
	
	
		$pdf->Ln(25);
					
					$pdf->SetFont('Arial','',6);
					$pdf->Cell(8,10,'No',1,0,'C',1);
					$pdf->Cell(29,5,'PR',1,0,'C	',1);
					$pdf->Cell(37,5,'PO',1,0,'C',1);
					$pdf->Cell(37,5,'MRR',1,0,'C',1);
					$pdf->Cell(43,10,'VENDOR',1,0,'C',1);
					$pdf->Cell(43,10,'Description',1,0,'C',1);
					$pdf->Cell(20,10,'Amount',1,0,'C',1);
					$pdf->Cell(20,10,'Division',1,0,'C',1);
					$pdf->Cell(28,5,'Lead Time',1,0,'C',1);
					$pdf->Cell(20,10,'Remark',1,0,'C',1);
			
			
					$pdf->Ln(5);
			
			
					//$pdf->Cell(22,5,'I. THE 18th',1,0,'C',0);
					$pdf->Cell(8,5,'',0,0,'C',0);
					$pdf->Cell(14,5,'Date',1,0,'C',1);
					$pdf->Cell(15,5,'No',1,0,'C',1);
					$pdf->Cell(14,5,'Date',1,0,'C',1);
					$pdf->Cell(23,5,'No',1,0,'C',1);
					$pdf->Cell(14,5,'Date',1,0,'C',1);
					$pdf->Cell(23,5,'No',1,0,'C',1);
					$pdf->Cell(43,5,'',0,0,'R',0);
					$pdf->Cell(43,5,'',0,0,'R',0);
					$pdf->Cell(20,5,'',0,0,'R',0);
					$pdf->Cell(20,5,'',0,0,'R',0);
					$pdf->Cell(14,5,'PR to PO',1,0,'C',1);
					$pdf->Cell(14,5,'PO to MRR',1,0,'C',1);
					$pdf->Cell(20,5,'',0,0,'C',0);			
			
			$pdf->Ln(5);
			$no = 0;
			
			}	
					
				$tglpo = indo_date($row->tgl_po);
				$tglmrr = indo_date($row->tgl_mrr);
				if($tglpo == '01-01-1970'){
					$tglpo = "-";
				}
				if($tglmrr == '01-01-1970'){
					$tglmrr = "-";
				}	
				if($row->status_pr == '2') $app = "Unapprove";
				else $app = "";
				$pdf->Cell(8,5,$i,1,0,'C',0);
				$pdf->Cell(14,5,indo_date($row->tgl_aproval),1,0,'C',0);
				$pdf->Cell(15,5,$row->no_pr,1,0,'C',0);
				$pdf->Cell(14,5,$tglpo,1,0,'C',0);
				$pdf->Cell(23,5,$row->no_po,1,0,'C',0);
				$pdf->Cell(14,5,$tglmrr,1,0,'C',0);
				$pdf->Cell(23,5,$row->no_mrr,1,0,'C',0);
				$pdf->Cell(43,5,substr($row->nm_supp,0,39),1,0,'L',0);
				$pdf->Cell(43,5,substr($row->ket_pr,0,32),1,0,'L',0);
				$pdf->Cell(20,5,number_format($row->harga_tot),1,0,'R',0);
				$pdf->Cell(20,5,$row->div,1,0,'C',0);
				$pdf->Cell(14,5,$row->d1,1,0,'C',0);
				$pdf->Cell(14,5,$row->d2,1,0,'C',0);
				$pdf->Cell(20,5,$app,1,0,'C',0);
				$pdf->Ln(5);				
				$i++;
				$no++;
				
				
				
				
		}
		
				
			//	$totamount = number_format($totamount);
				
				$pdf->SetX(7);
				#$pdf->Cell(8,7,'',1,0,'C',0);
				
				$pdf->SetFont('Arial','B',6);
					$pdf->Cell(8,5,'',0,0,'C',0);
				$pdf->Cell(14,5,'',0,0,'C',0);
				$pdf->Cell(15,5,'',0,0,'C',0);
				$pdf->Cell(14,5,'',0,0,'C',0);
				$pdf->Cell(23,5,'',0,0,'C',0);
				$pdf->Cell(14,5,'',0,0,'C',0);
				$pdf->Cell(23,5,'',0,0,'C',0);
				$pdf->Cell(43,5,'',0,0,'L',0);
				$pdf->Cell(43,5,'TOTAL',1,0,'L',1);
				$pdf->Cell(20,5,number_format($tothrg),1,0,'R',1);
		
				
			$pdf->Output("hasil.pdf","I");	;
