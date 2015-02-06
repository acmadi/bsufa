<?php

		
			require('fpdf/classreport.php');
			extract(PopulateForm());
			$pdf=new PDF('P','mm','A4');
			
			#die($det_rptbgt);
			$pdf->SetMargins(4,10,4);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#QUERY
			extract(PopulateForm());
			
			$rows = $this->db->where('subproject_id',$proj_rptbgt)
					->get('db_subproject')->row();
			#HEAD
			#HEADER CONTENT
				$pt		= "PT. Graha Multi Insani";
				$periode	= "As Of";
				$judul = "Project Budget & Realization";
				
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
				$pdf->SetFont('Arial','B',11);
				$pdf->Ln(5);
				$pdf->SetXY(25,22);
				
				if($det_rptbgt == 1){
				$pdf->Cell(0,10,'ALL PROJECT',20,0,'L');
				}else{
				$pdf->Cell(0,10,@$rows->nm_subproject,20,0,'L');
				}
				
				$pdf->SetXY(25,28);
				$pdf->Cell(0,10,'As Of : '.$tgl.' ',20,0,'L');
		
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
			
			// Start Isi Tabel
			
			
							
			$pdf->SetX(6);
			
			
			$pdf->SetFont('Arial','B',8);
				
			
			
			$pdf->Ln(4);
			//$pdf->Cell(10,10,'No',1,0,'C',1);
			$pdf->Cell(20,10,'Code Budget',1,0,'C',1);
			$pdf->Cell(73-5,10,'Budget Project Description',1,0,'C',1);
			//$pdf->Cell(75-6,5,'This Month',1,0,'C',1);
			$pdf->Cell(25,5,'Budget','T',0,'C',1);
			$pdf->Cell(100-8,5,'TOTAL',1,0,'C',1);
			
			
			$pdf->Ln(5);
					
			$pdf->Cell(93-5,0,'',0,0,'R',0);
			//$pdf->Cell(25-2,5,'Budget',1,0,'C',1);
			//$pdf->Cell(25-2,5,'Actual',1,0,'C',1);
			//$pdf->Cell(25-2,5,'Varian',1,0,'C',1);
			//$pdf->Cell(25-2,5,'Budget',1,0,'C',1);
			//$pdf->Cell(25-2,5,'Actual',,0,'C',1);
			$pdf->Cell(25,5,'','B',0,'C',1);
			$pdf->Cell(25-2,5,'Real Budget',1,0,'C',1);
			$pdf->Cell(25-2,5,'Actual',1,0,'C',1);
			$pdf->Cell(25-2,5,'Deduction',1,0,'C',1);
			$pdf->Cell(25-2,5,'Varian',1,0,'C',1);
			
			
		
			$pdf->SetFont('Arial','',8);
			
			$i = 1;	
			$no = 1;
			$max = 28;
			
			
			$totbgt = 0;
			$trbgt_month = 0;
			$var_trbgt_month = 0;
			$bgt_ytd = 0;
			$trbgt_ytd = 0;
			$var_trbgt_ytd = 0;
			$bgt_tot = 0;
			$bgt_tot_detail = 0;
			$trbgt_tot 	= 0;
			$var_trbgt_tot 	= 0;

			$deduction =0;
			
			
			
			
			
			
			$pdf->Ln(5);
			
			
			
			$tanggal = inggris_date($tgl);

			#$det_rptbgt = 0;
			#die($det_rptbgt);
			#if($det_rptbgt != 1){
			#$cek = "tes";
			#echo $cek;
			#}
			#else{
				
				
				
			$query = $this->db->query("sp_rptbgtproj '".$tanggal."','".$proj_rptbgt."',".$det_rptbgt."")->result();
			
			
			foreach($query as $row){
			
				if ($row->acc_head == 1){
				$pdf->SetFont('Arial','B',7);
				$pdf->setFillColor(222,222,222);
				//$pdf->Cell(10,8,'',1,0,'C',0);
				
				if ($row->header <=8){
				$pdf->Cell(20,8,$row->coa_no2,"L",0,'L',0);
				}else{
				$pdf->Cell(20,8,$row->coa_no2,"L",0,'R',0);
				}
				//$pdf->Cell(75-5,8,$row->nm_bgtproj,1,0,'L',0);
				$pdf->Cell(73-5,8,substr($row->nm_bgtproj,0,55),0,0,'L',0);
			//	$pdf->Ln(2);
				// $pdf->SetX(36);
					
				// $pdf->Cell(70-5,14,substr($row->nm_bgtproj,55,55),'L'.'R',0,'L',0);
				
				// $pdf->Cell(25-2,8,number_format($row->bgt_month),1,0,'R',0);
				// $pdf->Cell(25-2,8,number_format($row->trbgt_month),1,0,'R',0);
				// $pdf->Cell(25-2,8,number_format(($row->bgt_month) - ($row->trbgt_month)),1,0,'R',0);
				
				// //$pdf->SetX(139);
				// $pdf->Cell(25-2,8,number_format($row->bgt_ytd),1,0,'R',0);
				// $pdf->Cell(25-2,8,number_format($row->trbgt_ytd),1,0,'R',0);
				// if ($row->trbgt_tot2 ==0){
				// $pdf->Cell(25,8,'',0,'R',0);
				// }else if ($row->trbgt_tot2 <0){
				// $pdf->SetTextColor(222,222,222);
				// $pdf->Cell(25,8,number_format(($row->trbgt_tot2)),0,'R',0);
				// }else{
				// $pdf->Cell(25,8,number_format(($row->trbgt_tot2)),0,'R',0);
				// }
				
				//$pdf->SetX(214);
				$pdf->Cell(25,8,number_format(($row->bgt_ytd)),0,'R',0);
				$pdf->Cell(25-2,8,number_format($row->bgt_tot),0,0,'R',0);
				$pdf->Cell(25-2,8,number_format($row->trbgt_tot),0,0,'R',0);
				$pdf->Cell(25-2,8,number_format($row->trbgt_ytd),0,0,'R',0);
				$pdf->Cell(25-2,8,number_format(($row->bgt_tot) - ($row->trbgt_tot)+($row->trbgt_ytd)),"R",0,'R',0);
				$pdf->Ln(8);
				
								if($no == $max){
											$pdf->AddPage();
											#HEADER CONTENT
											$pt		= "PT. Graha Multi Insani";
											$periode	= "As Of";
											$judul = "Project Budget & Realization";
									
									

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
											$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
											$pdf->SetFont('Arial','B',18);
									
											$pdf->SetX(25);
											$pdf->Cell(0,10,$pt,20,0,'L');
											
											$pdf->SetFont('Arial','B',12);
												
											$pdf->SetXY(25,16);
											$pdf->Cell(0,10,$judul,20,0,'L');
											$pdf->SetFont('Arial','B',11);
											$pdf->Ln(5);
											$pdf->SetXY(25,22);
											$pdf->Cell(0,10,@$rows->nm_subproject,20,0,'L');
											$pdf->SetXY(25,28);
											$pdf->Cell(0,10,'As Of : '.$tgl.' ',20,0,'L');
																	
											$pdf->Ln(10);
												
											$pdf->Cell(0,0,'',1,0,'L');
														
														
											$pdf->SetX(6);
											
											
											$pdf->SetFont('Arial','B',8);
												
											
											
											$pdf->Ln(4);
			//$pdf->Cell(10,10,'No',1,0,'C',1);
			$pdf->Cell(20,10,'Code Budget',1,0,'C',1);
			$pdf->Cell(73-5,10,'Budget Project Description',1,0,'C',1);
			//$pdf->Cell(75-6,5,'This Month',1,0,'C',1);
			$pdf->Cell(25,5,'','T',0,'C',1);
			$pdf->Cell(100-8,5,'TOTAL',1,0,'C',1);
			
			
			$pdf->Ln(5);
					
			$pdf->Cell(93-5,0,'',0,0,'R',0);
			//$pdf->Cell(25-2,5,'Budget',1,0,'C',1);
			//$pdf->Cell(25-2,5,'Actual',1,0,'C',1);
			//$pdf->Cell(25-2,5,'Varian',1,0,'C',1);
			//$pdf->Cell(25-2,5,'Budget',1,0,'C',1);
			//$pdf->Cell(25-2,5,'Actual',,0,'C',1);
			$pdf->Cell(25,5,'Budget','B',0,'C',1);
			$pdf->Cell(25-2,5,'Real Budget',1,0,'C',1);
			$pdf->Cell(25-2,5,'Actual',1,0,'C',1);
			$pdf->Cell(25-2,5,'Deduction',1,0,'C',1);
			$pdf->Cell(25-2,5,'Varian',1,0,'C',1);
			
											$pdf->Ln(5);
											$no=0;
						}
			}else{
			$pdf->SetFont('Arial','',7);
				//$pdf->Cell(10,8,'',1,0,'C',0);
				$pdf->Cell(20,8,$row->coa_no2,"L",0,'L',0);
				//$pdf->Cell(75-5,8,$row->nm_bgtproj,1,0,'L',0);
				$pdf->Cell(73-5,8,substr($row->nm_bgtproj,0,55),0,0,'L',0);
			//	$pdf->Ln(2);
				// $pdf->SetX(36);
					
				// $pdf->Cell(70-5,14,substr($row->nm_bgtproj,55,55),'L'.'R',0,'L',0);
				
				// $pdf->Cell(25-2,8,number_format($row->bgt_month),1,0,'R',0);
				// $pdf->Cell(25-2,8,number_format($row->trbgt_month),1,0,'R',0);
				// $pdf->Cell(25-2,8,number_format(($row->bgt_month) - ($row->trbgt_month)),1,0,'R',0);
				
				// //$pdf->SetX(139);
				// $pdf->Cell(25-2,8,number_format($row->bgt_ytd),1,0,'R',0);
				// $pdf->Cell(25-2,8,number_format($row->trbgt_ytd),1,0,'R',0);
				$pdf->Cell(25,8,'',0,'R',0);
				
				//$pdf->SetX(214);
				if ($row->trbgt_tot2<0){
				$pdf->Cell(25-2,8,'',0,0,'R',0);
				$pdf->Cell(25-2,8,'',0,0,'R',0);
				$pdf->Cell(25-2,8,number_format($row->trbgt_tot2),0,0,'R',0);
				$pdf->Cell(25-2,8,'',"R",0,'R',0);
				}else{
				$pdf->Cell(25-2,8,number_format($row->trbgt_month),0,0,'R',0);
				$pdf->Cell(25-2,8,number_format($row->trbgt_tot2),0,0,'R',0);
				$pdf->Cell(25-2,8,'',0,0,'R',0);
				$pdf->Cell(25-2,8,'',"R",0,'R',0);
				}
				
				$pdf->Ln(8);
				
								if($no == $max){
											$pdf->AddPage();
											#HEADER CONTENT
											$pt		= "PT. Graha Multi Insani";
											$periode	= "As Of";
											$judul = "Project Budget & Realization";
									
									

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
											$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
											$pdf->SetFont('Arial','B',18);
									
											$pdf->SetX(25);
											$pdf->Cell(0,10,$pt,20,0,'L');
											
											$pdf->SetFont('Arial','B',12);
												
											$pdf->SetXY(25,16);
											$pdf->Cell(0,10,$judul,20,0,'L');
											$pdf->SetFont('Arial','B',11);
											$pdf->Ln(5);
											$pdf->SetXY(25,22);
											$pdf->Cell(0,10,@$rows->nm_subproject,20,0,'L');
											$pdf->SetXY(25,28);
											$pdf->Cell(0,10,'As Of : '.$tgl.' ',20,0,'L');
																	
											$pdf->Ln(10);
												
											$pdf->Cell(0,0,'',1,0,'L');
														
														
											$pdf->SetX(6);
											
											
											$pdf->SetFont('Arial','B',8);
												
											
											
											$pdf->Ln(4);
			//$pdf->Cell(10,10,'No',1,0,'C',1);
			$pdf->Cell(20,10,'Code Budget',1,0,'C',1);
			$pdf->Cell(73-5,10,'Budget Project Description',1,0,'C',1);
			//$pdf->Cell(75-6,5,'This Month',1,0,'C',1);
			$pdf->Cell(25,5,'','T',0,'C',1);
			$pdf->Cell(100-8,5,'TOTAL',1,0,'C',1);
			
			
			$pdf->Ln(5);
					
			$pdf->Cell(93-5,0,'',0,0,'R',0);
			//$pdf->Cell(25-2,5,'Budget',1,0,'C',1);
			//$pdf->Cell(25-2,5,'Actual',1,0,'C',1);
			//$pdf->Cell(25-2,5,'Varian',1,0,'C',1);
			//$pdf->Cell(25-2,5,'Budget',1,0,'C',1);
			//$pdf->Cell(25-2,5,'Actual',,0,'C',1);
			$pdf->Cell(25,5,'Budget','B',0,'C',1);
			$pdf->Cell(25-2,5,'Real Budget',1,0,'C',1);
			$pdf->Cell(25-2,5,'Actual',1,0,'C',1);
			$pdf->Cell(25-2,5,'Deduction',1,0,'C',1);
			$pdf->Cell(25-2,5,'Varian',1,0,'C',1);
			
											$pdf->Ln(5);
											$no=0;
						}
			
			
			
			}
						
				$no++;
				$i++;
				
				$totbgt 			= $totbgt +	$row->bgt_month;
				$trbgt_month 		= $trbgt_month + $row->trbgt_month;
				$var_trbgt_month 	= $var_trbgt_month + ($row->bgt_month - $row->trbgt_month);
				
				$bgt_ytd 			= $bgt_ytd + $row->bgt_ytd;
				$trbgt_ytd 			= $trbgt_ytd + $row->trbgt_ytd;
				$var_trbgt_ytd 		= $var_trbgt_ytd + ($row->bgt_ytd - $row->trbgt_ytd);
							
				$bgt_tot_detail			= $bgt_tot_detail + $row->trbgt_tot2;
				$bgt_tot 			= $bgt_tot + $row->bgt_tot;
				$trbgt_tot 			= $trbgt_tot + $row->trbgt_tot;
				$var_trbgt_tot 		= $var_trbgt_tot + ($row->bgt_tot - $row->trbgt_tot+$row->trbgt_ytd);
	
				
				
			}
			
				#$pdf->SetFont('Arial','B',8);
				$pdf->SetFont('Arial','B',7);
				$pdf->setFillColor(222,222,222);
				$pdf->Cell(93-5,8,'GRAND TOTAL',1,0,'R',1);
				
				// $pdf->Cell(25-2,8,number_format($totbgt),1,0,'R',1);
			
				// $pdf->Cell(25-2,8,number_format($trbgt_month),1,0,'R',1);
				// $pdf->Cell(25-2,8,number_format($var_trbgt_month),1,0,'R',1);
				
				// //$pdf->SetX(139);
				// $pdf->Cell(25-2,8,number_format($bgt_ytd),1,0,'R',1);
				// $pdf->Cell(25-2,8,number_format($trbgt_ytd),1,0,'R',1);
				$pdf->Cell(25,8,number_format($bgt_ytd),1,0,'R',1);
				
				//$pdf->SetX(214);
				$pdf->Cell(25-2,8,number_format($bgt_tot),1,0,'R',1);
				$pdf->Cell(25-2,8,number_format($trbgt_tot),1,0,'R',1);
				$pdf->Cell(25-2,8,number_format($trbgt_ytd),1,0,'R',1);
				$pdf->Cell(25-2,8,number_format($var_trbgt_tot),1,0,'R',1);
				

				
				
			
					
			
			$pdf->Output("hasil.pdf","I");	;
	
		#}
