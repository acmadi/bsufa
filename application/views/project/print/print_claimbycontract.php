<?php

		
			require('fpdf/classreport.php');
			extract(PopulateForm());
			$pdf=new PDF('L','mm','A4');
			
			$pdf->SetMargins(1,10,4);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#QUERY
			
			
			
			#HEAD
			#HEADER CONTENT
				$pt		= "PT. Graha Multi Insani";
				$periode	= "As Of";
				$judul = "Historical Claim List";
				#$project = "All";
	
			#CETAK TANGGAL
				$now  = date("d-m-Y");
			#TANGGAL CETAK
				$pdf->SetFont('Arial','',6);
				$pdf->SetXY(258,10);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							
				$pdf->SetXY(268,10);
				$pdf->Cell(2,4,':',4,0,'L');
								
				$pdf->SetXY(269,10);
				$pdf->Cell(10,4,$now,0,0,'L');
			
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
				
				$pdf->Ln(5);
				$pdf->SetX(25);
				#$pdf->Cell(0,10,'Project : '.$project,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				#$pdf->Ln(5);
				$pdf->SetX(25);
				$pdf->Cell(0,10,'As Of : '.$tgl.' ',20,0,'L');
		
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
			
			// Start Isi Tabel
			
			
							
			$pdf->SetX(6);
			
			
			$pdf->SetFont('Arial','',8);
				
			
			
			$pdf->Ln(4);
			$pdf->Cell(8,10,'No',1,0,'C',1);
			$pdf->Cell(30,10,'Kontrak Kerja',1,0,'C',1);
			$pdf->Cell(40,10,'Contractor',1,0,'C',1);
			$pdf->Cell(72,10,'J O B',1,0,'C',1);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(18,10,'Contract',1,0,'C',1);
			$pdf->Cell(18,10,'Claim',1,0,'C',1);
			#$pdf->Cell(22,10,'Add/Deduct',1,0,'C',1);
			$pdf->Cell(18,10,'PAID',1,0,'C',1);
			$pdf->SetFont('Arial','',7);
			#$pdf->Cell(19,6,'Amount (IDR)',1,0,'C',1);
			$pdf->Cell(54,6,'Out Standing',1,0,'C',1);
			
			
			//~ $pdf->Cell(18,10,'Deduction',1,0,'C',1);
			$pdf->SetFont('Arial','',8);
			//$pdf->Cell(18,10,'Claim',1,0,'C',1);
			#$pdf->Cell(22,10,'Add/Deduct',1,0,'C',1);
			//$pdf->Cell(18,10,'PAID',1,0,'C',1);
			$pdf->Cell(18,10,'CTC',1,0,'C',1);
			
			$pdf->Cell(8,10,'(%)',1,0,'C',1);
			
			
			
			$pdf->Ln(5);
					
			#$pdf->Cell(60,0,'',0,0,'R',0);
			// $pdf->SetX(12);
			// $pdf->Cell(30,5,'Number',1,0,'C',1);
			// $pdf->Cell(15,5,'Date',1,0,'C',1);
			
			$pdf->SetX(205);
			$pdf->SetFont('Arial','',7);
			#$pdf->Cell(19,5,'(Excl.Tax)','L',0,'C',1);
			$pdf->Cell(18,5,'Due Date',1,0,'C',1);
			$pdf->Cell(18,5,'CJC Prosess',1,0,'C',1);
			$pdf->Cell(18,5,'Total',1,0,'C',1);
			
		
			$pdf->SetFont('Arial','',7);
			
			$i = 1;	
			$no = 1;
			$max = 23;
			
			
			$contract_amount = 0;
			$contract_bftax = 0;
			$var_trbgt_month = 0;
			$bgt_ytd = 0;
			$trbgt_ytd = 0;
			$var_trbgt_ytd = 0;
			$bgt_tot = 0;
			$trbgt_tot 	= 0;
			$var_trbgt_tot 	= 0;
			$totpaid =  0 ;
			
			
			
			
			
			
			$pdf->Ln(5);
			
			extract(PopulateForm());
			
			$tanggal = inggris_date($tgl);


			#die($tanggal);
			$query = $this->db->query("sp_rptclaimbycontract '".$tanggal."'")->result();
			$totclaim = 0;
			$totbalance = 0;
			$totkontrak = 0;
			$deduct = 0;
			$totcurrent = 0;
			
			foreach($query as $row){
				
				$balance = $row->contract_amount - $row->claim;
				$persen = ($row->claim / $row->contract_amount) * 100; 
				
				
				$pdf->SetFont('Arial','',5);
				$pdf->Cell(8,6,$i,1,0,'C',0);
				$pdf->Cell(30,6,$row->no_kontrak,1,0,'L',0);
				
				//$pdf->Cell(15,6,indo_date($row->start_date),1,0,'C',0);
				$pdf->SetFont('Arial','',5);
				
				$pdf->Cell(40,6,$row->nm_supplier,1,0,'L',0);
				
				$pdf->SetFont('Arial','',6);
				$pdf->Cell(72,6,substr($row->job,0,69),1,0,'L',0);
				$pdf->SetFont('Arial','',6);
				#$pdf->SetX(139);
				
				if($row->currency == 'USD'){
						$kontrak 	=	$row->due_date;
						
						$current 	= $kontrak + $row->progress;
						
						
						$claim		=	$row->claim * 9700;
						$blc		= 	$kontrak - $claim;
						$paid		= 	$row->paid * 9700;
						$pdf->Cell(18,6,number_format($contract_amount),1,0,'R',0);
						$pdf->Cell(18,6,number_format($claim),1,0,'R',0);
						$pdf->Cell(18,6,number_format($paid),1,0,'R',0);
						$pdf->Cell(18,6,number_format($kontrak),1,0,'R',0);
						#$pdf->Cell(19,6,#number_format($row->contract_bftax),1,0,'R',0);
						#$pdf->Cell(22,6,'0',1,0,'R',0);
						$pdf->Cell(18,6,number_format($row->deduction),1,0,'R',0);
						$pdf->Cell(18,6,number_format($current),1,0,'R',0);
						//$pdf->Cell(18,6,number_format($claim),1,0,'R',0);
						//$pdf->Cell(18,6,number_format($paid),1,0,'R',0);
						$pdf->Cell(18,6,number_format($blc),1,0,'R',0);
						$pdf->Cell(8,6,number_format($persen),1,0,'R',0);
						
						
						
						$totkontrak 	= $totkontrak + $kontrak;
						$contract_amount 	= $contract_amount + $row->contract_amount;
						$totclaim = $totclaim + $row->claim;
						$totbalance = $totbalance + $balance;
						$totpaid = $totpaid + $paid;
						$deduct = $deduct + $row->progress;
						$totcurrent = $totcurrent + $current;
				}
				else{
						$current 	= $row->due_date + $row->progress;
						$pdf->Cell(18,6,number_format($row->contract_amount),1,0,'R',0);
						$pdf->Cell(18,6,number_format($row->claim),1,0,'R',0);
						$pdf->Cell(18,6,number_format($row->paid),1,0,'R',0);
						$pdf->Cell(18,6,number_format($row->due_date),1,0,'R',0);
						$pdf->Cell(18,6,number_format($row->progress),1,0,'R',0);
						#$pdf->Cell(19,6,#number_format($row->contract_bftax),1,0,'R',0);
						#$pdf->Cell(22,6,'0',1,0,'R',0);
						$pdf->Cell(18,6,number_format($current),1,0,'R',0);
						//$pdf->Cell(18,6,number_format($row->claim),1,0,'R',0);
						//$pdf->Cell(18,6,number_format($row->paid),1,0,'R',0);
						$pdf->Cell(18,6,number_format($balance),1,0,'R',0);
						$pdf->Cell(8,6,number_format($persen),1,0,'R',0);
						
						
						$totkontrak = $totkontrak + $row->due_date;
						$contract_amount 	= $contract_amount + $row->contract_amount;
						$totclaim = $totclaim + $row->claim;
						$totbalance = $totbalance + $balance;
						$totpaid 	= $totpaid + $row->paid;
						$deduct 	= $deduct + $row->progress;
						$totcurrent = $totcurrent + $current;
				}
			
			
				$pdf->Ln(6);
				
								if($no == $max){
											$pdf->AddPage();
											#HEADER CONTENT
													$pt		= "PT. Graha Multi Insani";
													$periode	= "As Of";
													$judul = "Contract List";
													#$project = "All";
										
												#CETAK TANGGAL
													$now  = date("d-m-Y");
												#TANGGAL CETAK
													$pdf->SetFont('Arial','',6);
													$pdf->SetXY(258,10);
													$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
																
													$pdf->SetXY(268,10);
													$pdf->Cell(2,4,':',4,0,'L');
																	
													$pdf->SetXY(269,10);
													$pdf->Cell(10,4,$now,0,0,'L');
												
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
													
													$pdf->Ln(5);
													$pdf->SetX(25);
													#$pdf->Cell(0,10,'Project : '.$project,20,0,'L');
													$pdf->SetFont('Arial','B',11);
													#$pdf->Ln(5);
													$pdf->SetX(25);
													$pdf->Cell(0,10,'As Of : '.$tgl.' ',20,0,'L');
											
													$pdf->Ln(10);
													
													$pdf->Cell(0,0,'',1,0,'L');
												
												// Start Isi Tabel
												
			
							
			$pdf->SetX(6);
			
			
			$pdf->SetFont('Arial','',8);
				
			
			
			$pdf->Ln(4);
			$pdf->Cell(8,10,'No',1,0,'C',1);
			$pdf->Cell(30,10,'Kontrak Kerja',1,0,'C',1);
			$pdf->Cell(40,10,'Contractor',1,0,'C',1);
			$pdf->Cell(72,10,'J O B',1,0,'C',1);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(18,10,'Contract',1,0,'C',1);
			$pdf->Cell(18,10,'Claim',1,0,'C',1);
			#$pdf->Cell(22,10,'Add/Deduct',1,0,'C',1);
			$pdf->Cell(18,10,'PAID',1,0,'C',1);
			$pdf->SetFont('Arial','',7);
			#$pdf->Cell(19,6,'Amount (IDR)',1,0,'C',1);
			$pdf->Cell(54,6,'Out Standing',1,0,'C',1);
			
			
			//~ $pdf->Cell(18,10,'Deduction',1,0,'C',1);
			$pdf->SetFont('Arial','',8);
			//$pdf->Cell(18,10,'Claim',1,0,'C',1);
			#$pdf->Cell(22,10,'Add/Deduct',1,0,'C',1);
			//$pdf->Cell(18,10,'PAID',1,0,'C',1);
			$pdf->Cell(18,10,'CTC',1,0,'C',1);
			
			$pdf->Cell(8,10,'(%)',1,0,'C',1);
			
			
			
			$pdf->Ln(5);
					
			#$pdf->Cell(60,0,'',0,0,'R',0);
			// $pdf->SetX(12);
			// $pdf->Cell(30,5,'Number',1,0,'C',1);
			// $pdf->Cell(15,5,'Date',1,0,'C',1);
			
			$pdf->SetX(205);
			$pdf->SetFont('Arial','',7);
			#$pdf->Cell(19,5,'(Excl.Tax)','L',0,'C',1);
			$pdf->Cell(18,5,'Due Date',1,0,'C',1);
			$pdf->Cell(18,5,'CJC Process',1,0,'C',1);
			$pdf->Cell(18,5,'Total',1,0,'C',1);
			
			
											$pdf->Ln(5);
											$no=0;
						}
						
				
				$no++;
				$i++;
				
				#$totkontrak 	= $totkontrak + $row->contract_amount;
				#$totclaim = $totclaim + $row->claim;
				#$totbalance = $totbalance + $balance;
				
				
				#$contract_bftax		= $contract_bftax + $row->contract_bftax;
				/*$var_trbgt_month 	= $var_trbgt_month + ($row->bgt_month - $row->trbgt_month);
				
				$bgt_ytd 			= $bgt_ytd + $row->bgt_ytd;
				$trbgt_ytd 			= $trbgt_ytd + $row->trbgt_ytd;
				$var_trbgt_ytd 		= $var_trbgt_ytd + ($row->bgt_ytd - $row->trbgt_ytd);
							
				$bgt_tot 			= $bgt_tot + $row->bgt_tot;
				$trbgt_tot 			= $trbgt_tot + $row->trbgt_tot;
				$var_trbgt_tot 		= $var_trbgt_tot + ($row->bgt_tot - $row->trbgt_tot);*/
	
				
				
			}
			
				#$pdf->SetFont('Arial','B',8);
				$pdf->SetFont('Arial','',6);
				$pdf->setFillColor(222,222,222);
				$pdf->Cell(150,6,'GRAND TOTAL',1,0,'R',1);
				$pdf->Cell(18,6,number_format($contract_amount),1,0,'R',1);
				$pdf->Cell(18,6,number_format($totclaim),1,0,'R',1);
				$pdf->Cell(18,6,number_format($totpaid),1,0,'R',1);
				$pdf->Cell(18,6,number_format($totkontrak),1,0,'R',1);
				$pdf->Cell(18,6,number_format($deduct),1,0,'R',1);
				$pdf->Cell(18,6,number_format($totcurrent),1,0,'R',1);
				#$pdf->Cell(19,6,number_format($contract_bftax),1,0,'R',1);
				//$pdf->Cell(18,6,number_format($totclaim),1,0,'R',1);
				#$pdf->Cell(22,6,'0',1,0,'R',1);
				//$pdf->Cell(18,6,number_format($totpaid),1,0,'R',1);
				$pdf->Cell(18,6,number_format($totbalance),1,0,'R',1);
				$pdf->Cell(8,6,'',1,0,'R',1);
				
				/*$pdf->Cell(25,8,number_format($var_trbgt_month),1,0,'R',1);
				
				$pdf->SetX(139);
				$pdf->Cell(25,8,number_format($bgt_ytd),1,0,'R',1);
				$pdf->Cell(25,8,number_format($trbgt_ytd),1,0,'R',1);
				$pdf->Cell(25,8,number_format($var_trbgt_ytd),1,0,'R',1);
				
				$pdf->SetX(214);
				$pdf->Cell(25,8,number_format($bgt_tot),1,0,'R',1);
				$pdf->Cell(25,8,number_format($trbgt_tot),1,0,'R',1);
				$pdf->Cell(25,8,number_format($var_trbgt_tot),1,0,'R',1);*/
				
				
			
					
			
			$pdf->Output("hasil.pdf","I");	;
	
