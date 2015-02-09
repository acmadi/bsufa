<?php

		//doc_no, doc_date, nm_supplier,inv_no, inv_date,due_date,descs, trx_amt, 
		//(trx_amt*10)/100 as PPN, (trx_amt*10)/100 as PPH23
		
			require('fpdf/classreport.php');
			extract(PopulateForm());
			$pdf=new PDF('L','mm','A4');
			
		//	die($vendor.'-'.$project_detail.'-'.$checkbox.'-'.$startdate);
			
			$data = $this->db->query("sp_Kartuhutang '".$vendor."','".$project_detail."','".$checkbox."','".inggris_date($startdate)."'")
							 ->result();
			#var_dump($data);exit();				 
			$vendr = $this->db->where('kd_supp_gb', $vendor)->get('pemasok')->row();
			
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEADER CONTENT
			
			if($checkbox == 0){
			
				$judul 		= "Statement AP - ".$vendr->nm_supplier;
			
			}else{
			
				$judul 		= "Statement AP All Vendor";
			
			}
			
				$pt			= "PT. Bakrie Swasakti Utama";
				$periode	= "As Of";
	
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
				#$pdf->Image(site_url().'assets/img/thewave.png',4,13,70);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(75);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(75,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(75,22);
				$pdf->Cell(0,10,$periode.' : '.$startdate,20,0,'L');
		
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
			
			// Start Isi Tabel
			
			
			$pdf->SetX(6);
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(4);
			
			$pdf->Cell(8,10,'No',1,0,'C',1);
			$pdf->Cell(45,10,'A/P',1,0,'C',1);
			//$pdf->Cell(15,10,'Unit',1,0,'C',1);
			$pdf->Cell(45,10,'Doc No',1,0,'C',1);
			$pdf->Cell(15,10,'Date',1,0,'C',1);
			$pdf->Cell(100,10,'Description',1,0,'C',1);
			$pdf->Cell(20,10,'Debet',1,0,'C',1);
			$pdf->Cell(20,10,'Credit',1,0,'C',1);
			$pdf->Cell(20,10,'Saldo',1,0,'C',1);
			//$pdf->Cell(20,10,'Total',1,0,'C',1);
			
			
			$pdf->Ln(5);
			
			// $pdf->Cell(8,5,'',10,0,'C',0);
			// $pdf->Cell(25,5,'No.',1,0,'C',1);
			// $pdf->Cell(25,5,'Date',1,0,'C',1);
			// $pdf->Cell(45,5,'',10,0,'L',0);
			// $pdf->Cell(20,5,'No.',1,0,'C',1);
			// $pdf->Cell(20,5,'Date.',1,0,'C',1);
			// $pdf->Cell(20,5,'Due Date',1,0,'C',1);
			// $pdf->Cell(55,5,'',10,0,'C',0);
			// $pdf->Cell(20,5,'',10,0,'C',0);
			// $pdf->Cell(20,5,'',10,0,'C',0);
			// $pdf->Cell(20,5,'',10,0,'C',0);
			// $pdf->Cell(20,5,'',10,0,'C',0);
			
		
			$pdf->SetFont('Arial','',6);
			
			$i = 1;	
			$no = 1;
			$noo = 0;
			$max = 14;	
			$pdf->Ln(5);
			$tot1 = 0;
			$tot2 = 0;
			$tot3 = 0;
			
			$tot5 = 0;
			$tot6 = 0;
			$tot7 = 0;
			$tot8 = 0;
			
			$totol = 0;
					
			
	// for($i = 1;$i <= 200; $i++){
	
	//print_r($data);
	//die();
	
	foreach($data as $row){	
		#$tot1 = 0;
		#$tot2 = 0;
		#$tot3 = 0;
		#$tot4 = 0;
		
		
		if($noo == $max){ 
			$pdf->AddPage();
			//				
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#HEADER CONTENT
				$pt			= "PT. Bakrie Swasakti Utama";
				$periode	= "As Of";
				
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
			#$pdf->Image(site_url().'assets/img/thewave.png',4,13,70);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(75);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(75,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(75,22);
				$pdf->Cell(0,10,$periode.' : '.$startdate,20,0,'L');
			
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
			
			
			$pdf->SetX(2);
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(4);
			$pdf->Cell(8,10,'No',1,0,'C',1);
			$pdf->Cell(45,10,'A/P',1,0,'C',1);
			//$pdf->Cell(15,10,'Unit',1,0,'C',1);
			$pdf->Cell(45,10,'Doc No',1,0,'C',1);
			$pdf->Cell(15,10,'Date',1,0,'C',1);
			$pdf->Cell(100,10,'Description',1,0,'C',1);
			$pdf->Cell(20,10,'Debet',1,0,'C',1);
			$pdf->Cell(20,10,'Credit',1,0,'C',1);
			$pdf->Cell(20,10,'Saldo',1,0,'C',1);
			
			
			$pdf->Ln(5);
			
			// $pdf->Cell(8,5,'',10,0,'C',0);
			// $pdf->Cell(25,5,'No.',1,0,'C',1);
			// $pdf->Cell(25,5,'Date',1,0,'C',1);
			// $pdf->Cell(45,5,'',10,0,'L',0);
			// $pdf->Cell(20,5,'No.',1,0,'C',1);
			// $pdf->Cell(20,5,'Date.',1,0,'C',1);
			// $pdf->Cell(20,5,'Due Date',1,0,'C',1);
			// $pdf->Cell(55,5,'',10,0,'C',0);
			// $pdf->Cell(20,5,'',10,0,'C',0);
			// $pdf->Cell(20,5,'',10,0,'C',0);
			// $pdf->Cell(20,5,'',10,0,'C',0);
			// $pdf->Cell(20,5,'',10,0,'C',0);
			
			$pdf->Ln(5);
			$noo = 0;
	
			
		}
	$a = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa4";
			$pdf->SetFont('Arial','',6);
			// $tot1 = $tot1 + $row->mbase_amt;
			// $tot2 = $tot2 + $row->mtax_amt;
			// $tot3 = $tot3 + $row->mtax_deduct_amt;
			// $tot4 = $tot3 + $tot1;
			
			
			
			$pdf->Cell(8,10,$no,1,0,'C',0);
			$pdf->Cell(45,10,$row->AP,1,0,'C',0);
			$pdf->Cell(45,10,$row->voucher,1,0,'C',0);
			$pdf->Cell(15,10,inggris_date($row->doc_date),1,0,'L',0);
			#$pdf->MultiCell(100,10,$row->descs);
			$y = $pdf->GetY();
			$x = $pdf->GetX();
			$width = 100;
		
			#$pdf->Cell(40,50, 'quantity', 1, 0, "l");


			$pdf->MultiCell($width,10,($row->descs),1,'L');
				$pdf->SetXY($x + $width, $y);
			$pdf->Cell(20,10,number_format($row->debet),1,0,'R',0);
			$pdf->Cell(20,10,number_format($row->credit),1,0,'R',0);
			$pdf->Cell(20,10,number_format($row->balance),1,0,'R',0);

					$ap = "select apinvoice_id from db_apinvoice where doc_no ='".$row->AP."'";
					$id_ap = $this->db->query($ap)->row();

					$cas = "select id_cash,id_ap from db_cashplan where id_ap =".$id_ap->apinvoice_id;
					$id_cash = $this->db->query($cas)->row();
 					


					$d = "select a.*,b.doc_no as ap from db_cashheader a
							left join db_apinvoice b on a.apinvoice_id = b.apinvoice_id
							where b.apinvoice_id = ".$row->apinvoice_id."  and a.voucher is not null  and a.trans_date <= '".inggris_date($startdate)."'";
 					$detail = $this->db->query($d)->result();						
				#var_dump($detail);exit();
				$pdf->Ln(10);
					foreach ($detail as $pow){

					$pdf->setFillColor(120,221,45);

							$pdf->Cell(8,10,'',1,0,'C',0);
							$pdf->Cell(45,10,$pow->ap,1,0,'C',0);
							$pdf->Cell(45,10,$pow->voucher,1,0,'C',0);
							$pdf->Cell(15,10,inggris_date($pow->trans_date),1,0,'L',0);
							#$pdf->MultiCell(100,10,$row->descs);
							$y = $pdf->GetY();
							$x = $pdf->GetX();
							$width = 100;
						
							#$pdf->Cell(40,50, 'quantity', 1, 0, "l");


							$pdf->MultiCell($width,10,($row->descs),1,'L',0);
								$pdf->SetXY($x + $width, $y);
							$pdf->Cell(20,10,number_format($pow->base_amount),1,0,'R',0);
							$pdf->Cell(20,10,'0',1,0,'R',0);
							$pdf->Cell(20,10,number_format($row->credit-$pow->base_amount),1,0,'R',0);
				$pdf->Ln(10);

					$tu = 0;


						$tot6 = $tot6 + $pow->base_amount;
						$tut = $tu + $pow->base_amount;
					}	
			
			
		
	
			

			
			#	$pdf->Ln(5);


		
		#	$pdf->Ln(5);		
			$tot1 = 0;
			$tot2 = 0;
			$tot3 = 0;
			
			//$tot5 = $tot5 + $tot4;
			#$tot6 = $tot6 + $row->debet;
			$tot7 = $tot7 + $row->credit;
			
			$tot8 = $tot7 - $tot6;
			$i++;
			$no++;
			$noo++;
		
	}


	$pdf->setFillColor(222,222,222);
			$pdf->Cell(8,10,'',10,0,'C',0);
			$pdf->Cell(25,10,'',10,0,'C',0);
			$pdf->Cell(25,10,'',10,0,'C',0);
			$pdf->Cell(55,10,'',10,0,'L',0);
			
			$pdf->Cell(100,10,'GRAND TOTAL',1,0,'L',1);
			$pdf->Cell(20,10,number_format($tot6),1,0,'R',1);
			$pdf->Cell(20,10,number_format($tot7),1,0,'R',1);
			$pdf->Cell(20,10,number_format($tot8),1,0,'R',1);
			//$pdf->Cell(20,5,number_format('0'),1,0,'R',1);
		 
		 	
			$pdf->SetFont('Arial','B',6);
	  	/*
			$pdf->Cell(8,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(15,5,'',10,0,'C',0);
			$pdf->Cell(40,5,'',10,0,'L',0);
			$pdf->Cell(80,5,'',10,0,'L',0);
			$pdf->Cell(25,5,'',10,0,'L',0);
			$pdf->Cell(25,5,'',10,0,'C',0);
			$pdf->Cell(50,5,'Grand Total',1,0,'C',1);
			$pdf->Cell(25,5,number_format(1000000000),1,0,'R',1);
			
		*/
			$pdf->Output("Statement AP " . $judul. ".pdf","I");	;
	
