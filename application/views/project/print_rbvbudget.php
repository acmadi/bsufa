<?php

		
			require('fpdf/classreport.php');
			extract(PopulateForm());
			$pdf=new PDF('L','mm','A4');
			
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
				$pdf->Cell(0,10,$rows->nm_subproject,20,0,'L');
				$pdf->SetXY(25,28);
				$pdf->Cell(0,10,'As Of : '.$tgl.' ',20,0,'L');
		
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
			
			// Start Isi Tabel
			
			
							
			$pdf->SetX(6);
			
			
			$pdf->SetFont('Arial','B',9);
				
			
			
			$pdf->Ln(4);
			$pdf->Cell(10,10,'No',1,0,'C',1);
			$pdf->Cell(50,10,'Budget Project Description',1,0,'C',1);
			$pdf->Cell(75,5,'This Month',1,0,'C',1);
			$pdf->Cell(75,5,'YTD',1,0,'C',1);
			$pdf->Cell(75,5,'TOTAL',1,0,'C',1);
			
			
			$pdf->Ln(5);
					
			$pdf->Cell(60,0,'',0,0,'R',0);
			$pdf->Cell(25,5,'Budget',1,0,'C',1);
			$pdf->Cell(25,5,'Actual',1,0,'C',1);
			$pdf->Cell(25,5,'Varian',1,0,'C',1);
			$pdf->Cell(25,5,'Budget',1,0,'C',1);
			$pdf->Cell(25,5,'Actual',1,0,'C',1);
			$pdf->Cell(25,5,'Varian',1,0,'C',1);
			$pdf->Cell(25,5,'Budget',1,0,'C',1);
			$pdf->Cell(25,5,'Actual',1,0,'C',1);
			$pdf->Cell(25,5,'Varian',1,0,'C',1);
			
			
		
			$pdf->SetFont('Arial','',9);
			
			$i = 1;	
			$no = 1;
			$max = 17;
			
			
			$totbgt = 0;
			$trbgt_month = 0;
			$var_trbgt_month = 0;
			$bgt_ytd = 0;
			$trbgt_ytd = 0;
			$var_trbgt_ytd = 0;
			$bgt_tot = 0;
			$trbgt_tot 	= 0;
			$var_trbgt_tot 	= 0;

			
			
			
			
			
			
			$pdf->Ln(5);
			
			
			
			$tanggal = inggris_date($tgl);

			#$det_rptbgt = 0;
			#die($det_rptbgt);
			#if($det_rptbgt != 1){
			#$cek = "tes";
			#echo $cek;
			#}
			#else{
			$query = $this->db->query("sp_rptbgtproj '".$tanggal."','".$proj_rptbgt."'")->result();
			
			
			foreach($query as $row){
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,8,$i,1,0,'C',0);
				$pdf->Cell(50,8,$row->nm_bgtproj,1,0,'L',0);
				
				$pdf->Cell(25,8,number_format($row->bgt_month),1,0,'R',0);
				$pdf->Cell(25,8,number_format($row->trbgt_month),1,0,'R',0);
				$pdf->Cell(25,8,number_format(($row->bgt_month) - ($row->trbgt_month)),1,0,'R',0);
				
				$pdf->SetX(139);
				$pdf->Cell(25,8,number_format($row->bgt_ytd),1,0,'R',0);
				$pdf->Cell(25,8,number_format($row->trbgt_ytd),1,0,'R',0);
				$pdf->Cell(25,8,number_format(($row->bgt_ytd) - ($row->trbgt_ytd)),1,'R',0);
				
				$pdf->SetX(214);
				$pdf->Cell(25,8,number_format($row->bgt_tot),1,0,'R',0);
				$pdf->Cell(25,8,number_format($row->trbgt_tot),1,0,'R',0);
				$pdf->Cell(25,8,number_format(($row->bgt_tot) - ($row->trbgt_tot)),1,0,'R',0);
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
											$pdf->Cell(0,10,$rows->nm_subproject,20,0,'L');
											$pdf->SetXY(25,28);
											$pdf->Cell(0,10,'As Of : '.$tgl.' ',20,0,'L');
																	
											$pdf->Ln(10);
												
											$pdf->Cell(0,0,'',1,0,'L');
														
														
											$pdf->SetX(6);
											
											
											$pdf->SetFont('Arial','B',9);
												
											
											
											$pdf->Ln(4);
											$pdf->Cell(10,10,'No',1,0,'C',1);
											$pdf->Cell(50,10,'Budget Project Description',1,0,'C',1);
											$pdf->Cell(75,5,'This Month',1,0,'C',1);
											$pdf->Cell(75,5,'YTD',1,0,'C',1);
											$pdf->Cell(75,5,'TOTAL',1,0,'C',1);
											
											
											$pdf->Ln(5);
													
											$pdf->Cell(60,0,'',0,0,'R',0);
											$pdf->Cell(25,5,'Budget',1,0,'C',1);
											$pdf->Cell(25,5,'Actual',1,0,'C',1);
											$pdf->Cell(25,5,'Varian',1,0,'C',1);
											$pdf->Cell(25,5,'Budget',1,0,'C',1);
											$pdf->Cell(25,5,'Actual',1,0,'C',1);
											$pdf->Cell(25,5,'Varian',1,0,'C',1);
											$pdf->Cell(25,5,'Budget',1,0,'C',1);
											$pdf->Cell(25,5,'Actual',1,0,'C',1);
											$pdf->Cell(25,5,'Varian',1,0,'C',1);
											$pdf->Ln(5);
											$no=0;
						}
						
				$no++;
				$i++;
				
				$totbgt 			= $totbgt +	$row->bgt_month;
				$trbgt_month 		= $trbgt_month + $row->trbgt_month;
				$var_trbgt_month 	= $var_trbgt_month + ($row->bgt_month - $row->trbgt_month);
				
				$bgt_ytd 			= $bgt_ytd + $row->bgt_ytd;
				$trbgt_ytd 			= $trbgt_ytd + $row->trbgt_ytd;
				$var_trbgt_ytd 		= $var_trbgt_ytd + ($row->bgt_ytd - $row->trbgt_ytd);
							
				$bgt_tot 			= $bgt_tot + $row->bgt_tot;
				$trbgt_tot 			= $trbgt_tot + $row->trbgt_tot;
				$var_trbgt_tot 		= $var_trbgt_tot + ($row->bgt_tot - $row->trbgt_tot);
	
				
				
			}
			
				#$pdf->SetFont('Arial','B',8);
				$pdf->SetFont('Arial','B',8);
				$pdf->setFillColor(222,222,222);
				$pdf->Cell(60,8,'GRAND TOTAL',1,0,'R',1);
				
				$pdf->Cell(25,8,number_format($totbgt),1,0,'R',1);
			
				$pdf->Cell(25,8,number_format($trbgt_month),1,0,'R',1);
				$pdf->Cell(25,8,number_format($var_trbgt_month),1,0,'R',1);
				
				$pdf->SetX(139);
				$pdf->Cell(25,8,number_format($bgt_ytd),1,0,'R',1);
				$pdf->Cell(25,8,number_format($trbgt_ytd),1,0,'R',1);
				$pdf->Cell(25,8,number_format($var_trbgt_ytd),1,0,'R',1);
				
				$pdf->SetX(214);
				$pdf->Cell(25,8,number_format($bgt_tot),1,0,'R',1);
				$pdf->Cell(25,8,number_format($trbgt_tot),1,0,'R',1);
				$pdf->Cell(25,8,number_format($var_trbgt_tot),1,0,'R',1);
				
				
			
					
			
			$pdf->Output("hasil.pdf","I");	;
	
		#}
