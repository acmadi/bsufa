<?php
		
		//doc_no, doc_date, nm_supplier,inv_no, inv_date,due_date,descs, trx_amt, 
		//(trx_amt*10)/100 as PPN, (trx_amt*10)/100 as PPH23
		//die('a');
			ini_set('memory_limit','512M');
			require('fpdf/classreport.php');
			extract(PopulateForm());
	
			$oo = $this->db->query("sp_apoutstanding '".inggris_date($startdate)."','".inggris_date($enddate)."'");
			$dd = $oo->result();
			
			//var_dump($dd);exit;
			$pdf=new PDF('L','mm','A4');
			
			$pdf->SetMargins(5,10,3);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEADER CONTENT
				$pts		= "PT. Bakrie Swasakti Utama";
				$judul 		= "List AP Outstanding";
				$periode	= "As Off";
	
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#TANGGAL CETAK
				$pdf->SetFont('Arial','',6);
				$pdf->SetXY(258,10);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							
				$pdf->SetXY(268,10);
				$pdf->Cell(2,4,':',4,0,'L');
								
				$pdf->SetXY(269,10);
				$pdf->Cell(10,4,date('m-d-Y'),0,0,'L');
			
			#Header
				//$pdf->Image(site_url().'assets/img/eastonpark.png',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pts,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'Periode : '.$startdate.' To : '.$enddate,20,0,'L');
		
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
			
			// Start Isi Tabel
			
			
			$pdf->SetX(6);
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(4);
			
			$pdf->Cell(8,10,'No',1,0,'C',1);
			$pdf->Cell(30,10,'A/P',1,0,'C',1);
			//$pdf->Cell(30,10,'Doc No',1,0,'C',1);
			$pdf->Cell(30,10,'Date',1,0,'C',1);
			$pdf->Cell(130,10,'Description',1,0,'C',1);
			//$pdf->Cell(20,10,'Debet',1,0,'C',1);
			//$pdf->Cell(20,10,'Credit',1,0,'C',1);
			$pdf->Cell(20,10,'Amount',1,0,'C',1);
						
			$pdf->Ln(5);
			
			$pdf->SetFont('Arial','',6);
			
			$pdf->Cell(8,10,'','L'.'B',0,'C',0);
			$pdf->Cell(30,10,'','B'.'R',0,'C',0);
			//$pdf->Cell(30,10,'','B'.'R',0,'C',0);
			$pdf->Cell(30,10,'','B'.'R',0,'L',0);
			$pdf->Cell(130,10,'','B'.'R',0,'L',0);
			//$pdf->Cell(20,10,'','B'.'R',0,'R',0);
			//$pdf->Cell(20,10,'','B'.'R',0,'R',0);
			$pdf->Cell(20,10,'','B'.'R',0,'R',0);

			$pdf->Ln(5);
			$no = 1;
			$td = 0;
			$tc = 0;
			$ts = 0;
			foreach($dd as $row){
			$pdf->Cell(8,5,$no,1,0,'C',0);
			$pdf->Cell(30,5,$row->doc_no,1,0,'C',0);
			//$pdf->Cell(30,5,'',1,0,'L',0);
			$pdf->Cell(30,5,indo_date($row->due_date),1,0,'C',0);
			$pdf->Cell(130,5,$row->descs,1,0,'L',0);
			//$pdf->Cell(20,5,'',1,0,'R',0);
			//$pdf->Cell(20,5,number_format($row->base_amt),1,0,'R',0);
			$pdf->Cell(20,5,'Rp '.number_format($row->base_amt),1,0,'R',0);

			$pdf->Ln(5);
	
			
			/*$cb = $this->db->query("sp_getcashbook ".$row->apinvoice_id."")->row();
			//var_dump($row->apinvoice_id);
			if(!empty($cb)){
			$pdf->Cell(8,5,'',1,0,'C',0);
			$pdf->Cell(30,5,$row->doc_no,1,0,'C',0);
			$pdf->Cell(30,5,$cb->voucher,1,0,'L',0);
			$pdf->Cell(30,5,$cb->payment_date,1,0,'C',0);
			$pdf->Cell(130,5,$cb->descs,1,0,'L',0);
			$pdf->Cell(20,5,$cb->amount,1,0,'R',0);
			$pdf->Cell(20,5,'',1,0,'R',0);
			$pdf->Cell(20,5,'0',1,0,'R',0);

			$pdf->Ln(5);
			
			$pdf->Cell(8,5,'',1,0,'C',0);
			$pdf->Cell(155,5,'',1,0,'C',0);
			$pdf->Cell(65,5,'SUB TOTAL',1,0,'L',1);
			$pdf->Cell(20,5,number_format($cb->amount),1,0,'R',1);
			$pdf->Cell(20,5,number_format($row->base_amt),1,0,'R',1);
			$pdf->Cell(20,5,0,1,0,'R',1);

			$pdf->Ln(5);
			$td = $td+$cb->amount;
			$tc = $tc+$row->base_amt;
			$ts = $ts+0;
			}else{
			$pdf->Cell(8,5,'',1,0,'C',0);
			$pdf->Cell(155,5,'',1,0,'C',0);
			$pdf->Cell(65,5,'SUB TOTAL',1,0,'L',1);
			$pdf->Cell(20,5,'',1,0,'R',1);
			$pdf->Cell(20,5,number_format($row->base_amt),1,0,'R',1);
			$pdf->Cell(20,5,number_format($row->base_amt),1,0,'R',1);

			$pdf->Ln(5);
			$td = $td+0;
			$tc = $tc+$row->base_amt;
			$ts = $ts+$row->base_amt;
			}*/
			
			
			
			
	$no++; }
			$pdf->Cell(8,5,'',10,0,'C',0);
			$pdf->Cell(25,5,'',10,0,'C',0);
			$pdf->Cell(25,5,'',10,0,'C',0);
			$pdf->Cell(15,5,'',10,0,'L',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(65,5,'GRAND TOTAL',1,0,'L',1);
			//$pdf->Cell(20,5,number_format($td),1,0,'R',1);
			//$pdf->Cell(20,5,number_format($tc),1,0,'R',1);
			$pdf->Cell(20,5,number_format($ts),1,0,'R',1);
			//$pdf->Cell(20,5,number_format('0'),1,0,'R',1);
		
			
			$pdf->SetFont('Arial','B',6);
			$pdf->Output("hasil.pdf","I");	;
	
