<?php
			#die('tes');
			extract(PopulateForm());
			#var_dump($cek);
			
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];
			$data_pt = $this->mstmodel->get_nama_pt($pt);
			$nama_pt = "PT \t".$data_pt['ket'];
			
			$start_date = inggris_date($start_date);
			$end_date	= inggris_date($end_date);
			
			
			#SUMMARY SALES REPORT
			
			
			
			
			
			
			
			#DETAIL SALES REPORT
			
			
			
			
			
			#QUERY
			
			#$rows = $this->db->query("PaymentCustomerReport '".$subproject."','".$start_date."','".$end_date."'")->row();
			
			$data1 = $this->db->query("PaymentCustomerReport '".$subproject."','".$start_date."','".$end_date."',".$pt."");
			//$data1 = $this->db->query("PaymentCustomerReport '".$subproject."','".$end_date."',".$pt."");
			
			$data = $data1->result();
			#var_dump($data);
			
			#$nmsubproject= $rows->nm_subproject;
			$dtproj = $this->db->where('subproject_id',$subproject)
							   ->get('db_subproject')->row();
			$nmsubproject = $dtproj->nm_subproject;				   
			
			#Price/m2
		
			
					
			
			
			#kondisi Beda Project
			require('fpdf/classreport.php');
			$pdf=new PDF('L','mm','A4');
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',14);
			$pdf->SetMargins(2,10,2);
		
			
			#HEADER CONTENT
			$judul 		= "PAYMENT CUSTOMER REPORT";
			$periode	= "Periode";
			
			
			
			
			#Header
			$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
			#pdf->SetFont('Arial','B',12);
			$pdf->SetFont('Arial','B',12);
			$pdf->SetX(25);
			$pdf->Cell(0,10,$nama_pt,20,0,'L');
			
			$pdf->SetFont('Arial','B',12);		
			$pdf->SetXY(25,16);
			$pdf->Cell(70,10,$judul.' - ',20,0,'L');
			
			#$pdf->SetFont('Arial','B',12);		
			#$pdf->SetXY(82,16);
			$pdf->Cell(20,10,$nmsubproject,20,0,'L');
			
			
			$pdf->ln(8);
			$pdf->SetX(25);
			$pdf->Cell(20,10,$periode,20,0,'L');
			
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(20,10,': '.indo_date($start_date),0,0,'L');
			$pdf->Cell(20,10,'To  '.indo_date($end_date),0,0,'L');
			
						
			
			$pdf->SetFont('Arial','B',10);
					$pdf->SetXY(30,45);
			
			
			#HEADER TABLE
			
			$y_axis_initial = 40;
			$y_axis = 0;
			$pdf->SetFont('Arial','',8);
			$pdf->setFillColor(222,222,222);
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(3);
			$pdf->Cell(8,6,'No',1,0,'C',1);
			$pdf->Cell(20,6,'SP Date',1,0,'C',1);
			$pdf->Cell(40,6,'Customer',1,0,'C',1);
			$pdf->Cell(20,6,'Unit.No',1,0,'C',1);
			$pdf->Cell(25,6,'TOP',1,0,'C',1);
			$pdf->Cell(25,6,'Selling Price',1,0,'C',1);
			$pdf->Cell(22,6,'Total Paid',1,0,'C',1);
			$pdf->Cell(22,6,'Payment BF',1,0,'C',1);
			$pdf->Cell(22,6,'Payment DP',1,0,'C',1);
			$pdf->Cell(22,6,'Payment PL',1,0,'C',1);
			$pdf->Cell(22,6,'O/S',1,0,'C',1);
			$pdf->Cell(8,6,'Paid',1,0,'C',1);
			$pdf->Cell(35,6,'Sales Name',1,0,'C',1);
			
			
			$pdf->Ln();
			#END$pricemanual = $rows->price_manual;
			
			$max=15;
			$row_height = 4;
			$y_axis = $y_axis + $row_height;
			$no=1;
        	$i = 1;
			#Menkosongkan Total
			
					#$tottanah 			= 0;
					#$totbangunan		= 0;
					#$totpricemanual		= 0;
					$totsellingprice 	= 0;
					#$totdiscamount		= 0;
					#$totbf				= 0;
					#$totdp				= 0;
					#$totpl 				= 0;
					$grandtotpaid		= 0;
					$grandtotbf			= 0;
					$grandtotdp			= 0;
					$grandtotpl			= 0;
					$grandos			= 0;
			#var_dump($data);
			
			foreach($data as $row){
				
				#ROW DATA
					$tglsales = $row->tgl_sales;
					$tglsales = indo_date($tglsales);
					
					
					
					$customernama = $row->customer_nama;
					$unitno = $row->unit_no;
					$paytipenm = $row->paytipe_nm;
					#$tanah = $row->tanah;
					#$discamount = $row->discamount;
					#$bangunan = $row->bangunan;
					$sellingprice = $row->selling_price;
					#$pricemanual = $row->price_manual;
					#$idsp = $row->sp_id;
					#var_dump($idsp);
					$nama = $row->nama;
					
					#$bf = $row->bf;
					#$dp = $row->dp;
					#$pl = $row->pl;
					
					
					#$tottanah 			= $tottanah + $tanah;
					#$totbangunan		= $totbangunan + $bangunan;
					#$totpricemanual		= $totpricemanual + $pricemanual;
					$totsellingprice 	= $totsellingprice + $sellingprice;
					#$totdiscamount		= $totdiscamount + $discamount;
					#$totbf				= $totbf + $bf;
					#$totdp				= $totdp + $dp;
					#$totpl				= $totpl + $pl;
					
					
					
					#$pricem2 = $sellingprice/$bangunan;
					
					#$pricemanual =  number_format($row->price_manual);
					#$pricem2	= number_format($pricem2);
					
					#$discamount = number_format($row->discamount);
										
					
					
					
					
					
					#TOTAL PAID PER CUSTOMER
					/*$sql = $this->db->select('sum(kwtbill_pay) as tot_paid')
									->join('db_billing','id_billing = id_bill')
									->join('db_sp','id_sp = sp_id')
									->where('sp_id',$idsp)
									->where('isnull(db_kwtbill.id_flag,0) !=','10')
									->get('db_kwtbill')
									->row();*/
					#TOTAL BF PER CUSTOMER
					/*$sql1 = $this->db->select('sum(pay_amount) as tot_bf')
									->where('id_sp',$idsp)
									->where('id_paygroup','1')
									->get('db_billing')
									->row();*/
					#TOTAL DP PER CUSTOMER
					/*$sql2 = $this->db->select('sum(pay_amount) as tot_dp')
									->where('id_sp',$idsp)
									->where('id_paygroup','2')
									->get('db_billing')
									->row();*/
					
					#TOTAL PL PER CUSTOMER
					/*$sql3 = $this->db->select('sum(pay_amount) as tot_pl')
									->where('id_sp',$idsp)
									->where('id_paygroup','3')
									->get('db_billing')
									->row();*/
					
					#TOTAL OS PER CUSTOMER
					#$totpaid = $sql->tot_paid;
					#$os = $sellingprice - $totpaid;
					
					#PERSEN PAID
					#$persen = ($totpaid/$sellingprice) * 100; 
					
					
					#TOTAL PAID
					#$grandtotpaid 	= $grandtotpaid + $totpaid;
					#TOTAL BF					
					#$totbf 			= $sql1->tot_bf;
					#$grandtotbf 	= $grandtotbf + $totbf; 
					#TOTAL DP
					#$totdp = $sql2->tot_dp;
					#$grandtotdp		= $grandtotdp + $totdp;
					#TOTAL PL
					#$totpl 			= $sql3->tot_pl;
					#$grandtotpl		= $grandtotpl + $totpl;
					#TOTAL OS
					#$grandos		= $grandos + $os;
					
					
				
				
				#PAGE HEADER SELANJUTNYA
				if($no == $max){
						#HEADER TOP
						$pdf->AddPage();
						$pdf->SetFont('Arial','B',12);
						$pdf->SetX(25);
						    $pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);
							$pdf->SetFont('Arial','B',12);
							$pdf->SetX(25);
							$pdf->Cell(0,10,$nama_pt,20,0,'L');
			
							$pdf->SetFont('Arial','B',12);		
							$pdf->SetXY(25,16);
							$pdf->Cell(70,10,$judul.' - ',20,0,'L');
							$pdf->Cell(20,10,$nmsubproject,20,0,'L');
			
			
								$pdf->ln(8);
								$pdf->SetX(25);
								$pdf->Cell(20,10,$periode,20,0,'L');
			
										$pdf->SetFont('Arial','',9);
										$pdf->Cell(20,10,': '.indo_date($start_date),0,0,'L');
										$pdf->Cell(20,10,'To  '.indo_date($end_date),0,0,'L');
			
											$pdf->SetFont('Arial','B',10);
											$pdf->SetXY(30,45);
			
			
						
						#END
						
							#HEADER TABLE
			
							$y_axis_initial = 40;
							$y_axis = 0;
							$pdf->SetFont('Arial','',8);
							$pdf->setFillColor(222,222,222);
							$pdf->SetY($y_axis_initial);
							$pdf->SetX(3);
							$pdf->Cell(8,6,'No',1,0,'C',1);
							$pdf->Cell(20,6,'SP Date',1,0,'C',1);
							$pdf->Cell(40,6,'Customer',1,0,'C',1);
							$pdf->Cell(20,6,'Unit.No',1,0,'C',1);
							$pdf->Cell(25,6,'TOP',1,0,'C',1);
							$pdf->Cell(25,6,'Selling Price',1,0,'C',1);
							$pdf->Cell(22,6,'Total Paid',1,0,'C',1);
							$pdf->Cell(22,6,'Payment BF',1,0,'C',1);
							$pdf->Cell(22,6,'Payment DP',1,0,'C',1);
							$pdf->Cell(22,6,'Payment PL',1,0,'C',1);
							$pdf->Cell(22,6,'O/S',1,0,'C',1);
							$pdf->Cell(8,6,'Paid',1,0,'C',1);
							$pdf->Cell(35,6,'Sales Name',1,0,'C',1);
			
			
							$pdf->Ln();
									#END
							
							$no = 0;
						
					}
			//Isi Data Pembayaran		
			$bf = $row->bf;
			$dp = $row->dp;
			$pl = $row->pl;
			$totpaid = $bf + $dp + $pl;
			$selling = 	$row->selling_price;
			$os = $selling - $totpaid;
			$persen = ($totpaid/$selling) * 100;
			
			//Total Keseluruhan Payment
			$grandtotpaid = $grandtotpaid + $totpaid;
			$grandtotbf = $grandtotbf + $bf;
			$grandtotdp = $grandtotdp + $dp;
			$grandtotpl = $grandtotpl + $pl;	
			$grandos = $grandos + $os;
					
			$pdf->SetX(3);
			$pdf->SetFont('Arial','',8);	
			$pdf->Cell(7,8,$i,20,0,'R');
			$pdf->Cell(20,8,$tglsales,20,0,'C');
			$pdf->Cell(40,8,$customernama,20,0,'L');
			$pdf->Cell(20,8,$unitno,20,0,'C');
			$pdf->Cell(26,8,$paytipenm,20,0,'C');
			#$pdf->Cell(10,8,$tanah,20,0,'C');
			#$pdf->Cell(10,8,$bangunan,20,0,'C');
			$pdf->Cell(25,8,number_format($selling),20,0,'R');
			$pdf->Cell(22,8,number_format($totpaid),20,0,'R');
			$pdf->Cell(22,8,number_format($bf),20,0,'R');
			$pdf->Cell(22,8,number_format($dp),20,0,'R');
			$pdf->Cell(22,8,number_format($pl),20,0,'R');
			$pdf->Cell(22,8,number_format($os),20,0,'R');
			$pdf->Cell(8,8,number_format($persen).'%',20,0,'C');
			$pdf->Cell(22,8,$nama,20,0,'L');
			
			#$pdf->Cell(20,8,$pricem2,20,0,'R');
			#$pdf->Cell(20,8,$bf,20,0,'R');
			#$pdf->Cell(20,8,$dp,20,0,'R');
			#$pdf->Cell(20,8,$pl,20,0,'R');
			#$pdf->SetFont('Arial','',7);
			#$pdf->Cell(60,8,$row->nm_subproject,20,0,'L');
			#$pdf->Cell(30,8,$row->media_nm,20,0,'L');
			$no++;	
			$i++;
			$pdf->Ln();
				
	}
			
					$pdf->SetX(3);
					$pdf->SetFont('Arial','B',8);
					$pdf->Cell(113,8,'TOTAL',0,0,'R',1);
					#$pdf->Cell(25,8,number_format($totpricemanual),0,0,'R',1);
					#$pdf->Cell(19,8,number_format($totdiscamount),0,0,'R',1);
					$pdf->Cell(25,8,number_format($totsellingprice),0,0,'R',1);
					#$pdf->Cell(20,8,'',0,0,'R',1);
					$pdf->Cell(22,8,number_format($grandtotpaid),0,0,'R',1);
					$pdf->Cell(22,8,number_format($grandtotbf),0,0,'R',1);
					$pdf->Cell(22,8,number_format($grandtotdp),0,0,'R',1);
					$pdf->Cell(22,8,number_format($grandtotpl),0,0,'R',1);
					$pdf->Cell(22,8,number_format($grandos),0,0,'R',1);
					$pdf->Cell(42,8,'',0,0,'R',1);				
			
			
			
			$pdf->Output("history.pdf","I");	

#$url= "reprint/sp".$idsp.".pdf";
#$pdf->Output($url);
#redirect($url);
			
#$pdf->Output("hasil.pdf","I");
