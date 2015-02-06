<?php
	extract(PopulateForm());
			#$data = $this->db->query("sp_listtrbal '".inggris_date($tgl)."'")->result();
			#$data = $this->db->query("neraca '".inggris_date($tgl)."'")->row();
		
			require('fpdf/classreport.php');
			extract(PopulateForm());
			$pdf=new PDF('P','mm','A4');
			
			
			
			$pdf->SetMargins(15,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			
			$date = inggris_date($tgl);

			#BULAN MUNDUR
			$blnutama = date('m',strtotime($date));
			$thnutama = date('Y',strtotime($date));
			
			#HEAD
			#HEADER CONTENT
				$pt			= "PT. BAKRIE SWASAKTI UTAMA";
				$judul 		= "PROFIT/LOSS";
				$periode	= "Periode";
	
			#CETAK TANGGAL
				$tgl2  = date("d-m-Y");
			#TANGGAL CETAK
				$pdf->SetFont('Arial','',6);
				$pdf->SetXY(258,10);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							
				$pdf->SetXY(268,10);
				$pdf->Cell(2,4,':',4,0,'L');
								
				$pdf->SetXY(269,10);
				$pdf->Cell(10,4,$tgl2,0,0,'L');
			
			#Header
				//$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'As Of'.' : '.' '.$tgl,20,0,'L');
				$pdf->Ln(10);
				$pdf->Cell(150,0,'',1,0,'L');
				$pdf->Ln(1);
				$pdf->Cell(150,0,'',1,0,'L');
				$pdf->Ln(3);
			
			// Start Isi Tabel
			
			
			
			$pdf->SetFont('Arial','B',8);
			
			
			$pdf->Cell(25,5,'ACCOUNT',10,0,'L');
			$pdf->Cell(50,5,'DESCRIPTION ',10,0,'L');
			$pdf->Cell(40,5,'CURRENT MONTH',10,0,'C');
			
			$pdf->Cell(30,5,'YEAR TO DATE',10,0,'L');
			
			$pdf->Ln(5);
			$pdf->Cell(150,0,'',1,0,'L');
		
						
			$period = date('Ym',strtotime($tgl));
			
			#KEPALA 4 SAMPAI 5
			
			$sql = "select  b.acc_name as acc_name,b.acc_no as acc_no,c.db_base as db_base,c.cr_base as cr_base,
						((c.balance_base+c.db_base)-c.cr_base) as ending_base
                        from db_coa b 
                        join db_trlbal c on c.acc_no = b.acc_no
                        where left(b.acc_no,1) > = '4' and left(b.acc_no,1) < = '5' and c.acc_period=".$period."  and b.account_neraca='1'
                        group by b.acc_name,b.acc_no,c.db_base,c.cr_base, ((c.balance_base+c.db_base)-c.cr_base) order by b.acc_no";
		    $cek  = $this->db->query($sql)->result();
			
			foreach($cek as $row){		
					
					$pdf->SetX(15);
					$pdf->SetFont('Arial','B',7);		
					$pdf->Cell(25,10,$row->acc_no,10,0,'L',0);
					$pdf->Cell(100,10,$row->acc_name,10,0,'L',0);
					$pdf->Ln(3);
			
						#DETAIL KEPALA
						$sql = "select b.acc_name ,b.acc_no ,(c.db_base - c.cr_base) as end_base from db_coa b 
								join db_trlbal c on c.acc_no = b.acc_no
								where  c.acc_period=".$period."  and account_neraca = '$row->acc_no'
								group by b.acc_name,b.acc_no,c.db_base,c.cr_base order by b.acc_no";
						$cek1 = $this->db->query($sql)->result();
							
							
							$a=0;#VARIABEL TOTAL DETAIL CURRENT
							$b=0;#TOTAL CURRENT GROSS PROFIT
							#END
							
							FOREACH($cek1 AS $roow){
													
								#TOTAL DETAIL YTD
								$sql 	=  "select db_base - cr_base as end_base,(select balance_base from db_trlbal 
											where substring(acc_period,1,4) = '$thnutama' and substring(acc_period,5,2) = '$blnutama' and acc_no = '$roow->acc_no') 
											as balance from db_trlbal 
											where substring(acc_period,1,4) = '$thnutama' and substring(acc_period,5,2) = '$blnutama' and acc_no = '$roow->acc_no'";
								$queri 	= $this->db->query($sql)->row();
										$totytd = $queri->balance + $queri->end_base;
							
									$pdf->SetFont('Arial','',7);		
									$pdf->Cell(25,10,$roow->acc_no,10,0,'L',0);
									$pdf->Cell(30,10,$roow->acc_name,10,0,'L',0);
									$pdf->Cell(50,10,number_format($roow->end_base),10,0,'R',0);
									$pdf->Cell(30,10,number_format($totytd),10,0,'R',0);
									$pdf->Ln(3);		

									#TOTAL DETAIL
									$a  = $a+ $roow->end_base;
									#END [TOTAL DETAIL]
									
							
							}
							#END [DETAIL KEPALA]
								
								#TOTAL DETAIL ACCOUNT
								$pdf->SetX(40);
								$pdf->SetFont('Arial','B',7);		
								$pdf->Cell(50,10,'Total '.$row->acc_name,10,0,'L',0);
								$pdf->SetFont('Arial','U'.'U'.'B',7);	  	
								$pdf->Cell(30,10,number_format($a),10,0,'R',0);
								
									#TOTAL YTD
									$sql = "select sum(balance_base + (db_base - cr_base)) as totytdblc from db_trlbal a
											JOIN db_coa b ON a.acc_no = b.acc_no
											where acc_type = 2 and acc_period = ".$period." and account_neraca= '$row->acc_no'";
									$que = $this->db->query($sql)->row();
								
								$pdf->Cell(30,10,number_format($que->totytdblc),10,0,'R',0);
								$pdf->Ln(5);
								#END [TOTAL DETAIL ACCOUNT]
			
									
			}
			
			#TOTAL CURRENT REVENUE
			// $sql = "select sum(balance_base + (db_base - cr_base))*-1 as totrevenue from db_trlbal a
					// JOIN db_coa b ON a.acc_no = b.acc_no
					// where acc_type = 2 and acc_period = ".$period." and account_neraca= '4.00'";
			// $queri = $this->db->query($sql)->row();
			
			$sql = "select sum((db_base - cr_base))*-1 as totrevenue from db_trlbal a
					JOIN db_coa b ON a.acc_no = b.acc_no
					where acc_type = 2 and acc_period = ".$period." and account_neraca= '4.00'";
			$queri = $this->db->query($sql)->row();
			
			#TOTAL YTD REVENUE
			$sql = "select sum(balance_base + (db_base - cr_base))*-1 as totytdrevenue from db_trlbal a
					JOIN db_coa b ON a.acc_no = b.acc_no
					where acc_type = 2 and substring(acc_period,1,4) = '$thnutama' and substring(acc_period,5,2) = '$blnutama' and account_neraca= '4.00'";
			$querii = $this->db->query($sql)->row();
									
			#TOTAL CURRENT COST OF SALES
			// $sql = "select sum(balance_base + (db_base - cr_base)) as totcos from db_trlbal a
					// JOIN db_coa b ON a.acc_no = b.acc_no
					// where acc_type = 2 and acc_period = ".$period." and account_neraca= '5.00'";
			// $querri = $this->db->query($sql)->row();
			
			$sql = "select sum((db_base - cr_base)) as totcos from db_trlbal a
					JOIN db_coa b ON a.acc_no = b.acc_no
					where acc_type = 2 and acc_period = ".$period." and account_neraca= '5.00'";
			$querri = $this->db->query($sql)->row();
			
			#TOTAL YTD COST OF SALES
			$sql = "select sum(balance_base + (db_base - cr_base)) as totytdcos from db_trlbal a
					JOIN db_coa b ON a.acc_no = b.acc_no
					where acc_type = 2 and substring(acc_period,1,4) = '$thnutama' and substring(acc_period,5,2) = '$blnutama' and account_neraca= '5.00'";
			$querrii = $this->db->query($sql)->row();
								
			#TOTAL CURRENT GROSSPROFIT
			$b = $queri->totrevenue - $querri->totcos;
			$c = $querii->totytdrevenue - $querrii->totytdcos;
			
			
			
			
			$pdf->SetX(40);
			$pdf->Cell(50,10,'TOTAL GROSS PROFIT',10,0,'L',0);
			$pdf->Cell(30,10,number_format($b),10,0,'R',0);
			$pdf->Cell(30,10,number_format($c),10,0,'R',0);
			$pdf->Ln(5);
			#END [KEPALA 4 SAMPAI 5]??'??
			
			
			
			#KEPALA 6
			
			$sql = "select  b.acc_name as acc_name,b.acc_no as acc_no,c.db_base as db_base,c.cr_base as cr_base,
						((c.balance_base+c.db_base)-c.cr_base) as ending_base
                        from db_coa b 
                        join db_trlbal c on c.acc_no = b.acc_no
                        where left(b.acc_no,1) > = '6' and left(b.acc_no,1) <  '7' and c.acc_period=".$period."  and b.account_neraca='1'
                        group by b.acc_name,b.acc_no,c.db_base,c.cr_base, ((c.balance_base+c.db_base)-c.cr_base) order by b.acc_no";
		    $cek  = $this->db->query($sql)->result();
			
			$s=0;#VAR TOTAL CURRENT KEPALA 6
			$t=0;#VAR TOTAL YTD KEPALA 6
			foreach($cek as $row){		
				
					
					$pdf->SetX(15);
					$pdf->SetFont('Arial','B',7);		
					$pdf->Cell(25,10,$row->acc_no,10,0,'L',0);
					$pdf->Cell(100,10,$row->acc_name,10,0,'L',0);
					$pdf->Ln(3);
			
						#DETAIL KEPALA
						$sql = "select b.acc_name ,b.acc_no ,(c.db_base - c.cr_base) as end_base from db_coa b 
								join db_trlbal c on c.acc_no = b.acc_no
								where  c.acc_period=".$period."  and account_neraca = '$row->acc_no'
								group by b.acc_name,b.acc_no,c.db_base,c.cr_base order by b.acc_no";
						$cek1 = $this->db->query($sql)->result();
							
							#VARIABEL TOTAL DETAIL CURRENT
							$a=0;
							#END
							
							FOREACH($cek1 AS $roow){
													
								#TOTAL DETAIL YTD
								$sql 	=  "select db_base - cr_base as end_base,(select balance_base from db_trlbal 
											where substring(acc_period,1,4) = '$thnutama' and substring(acc_period,5,2) = '$blnutama' and acc_no = '$roow->acc_no') 
											as balance from db_trlbal 
											where substring(acc_period,1,4) = '$thnutama' and substring(acc_period,5,2) = '$blnutama' and acc_no = '$roow->acc_no'";
								$queri 	= $this->db->query($sql)->row();
										$totytd = $queri->balance + $queri->end_base;
							
									$pdf->SetFont('Arial','',7);		
									$pdf->Cell(25,10,$roow->acc_no,10,0,'L',0);
									$pdf->Cell(30,10,$roow->acc_name,10,0,'L',0);
									$pdf->Cell(50,10,number_format($roow->end_base),10,0,'R',0);
									$pdf->Cell(30,10,number_format($totytd),10,0,'R',0);
									$pdf->Ln(3);		

									#TOTAL DETAIL
									$a  = $a+ $roow->end_base;
									#END [TOTAL DETAIL]
									
							
							}
							#END [DETAIL KEPALA]
								
								#TOTAL DETAIL ACCOUNT
								$pdf->SetX(40);
								$pdf->SetFont('Arial','B',7);		
								$pdf->Cell(50,10,'Total '.$row->acc_name,10,0,'L',0);
								$pdf->SetFont('Arial','U'.'U'.'B',7);	  	
								$pdf->Cell(30,10,number_format($a),10,0,'R',0);
								
									#TOTAL YTD
									$sql = "select sum(balance_base + (db_base - cr_base)) as totytdblc from db_trlbal a
											JOIN db_coa b ON a.acc_no = b.acc_no
											where acc_type = 2 and acc_period = ".$period." and account_neraca= '$row->acc_no'";
									$que = $this->db->query($sql)->row();
								
								$pdf->Cell(30,10,number_format($que->totytdblc),10,0,'R',0);
								$pdf->Ln(5);
								#END [TOTAL DETAIL ACCOUNT]
			
				$s = $s + $a;#TOTAL CUURRENT KEPALA 6
				$t = $t + $que->totytdblc;#TOTAL YTD KEPALA 6
			}
			
								
								
			
						
			$pdf->SetX(40);
			$pdf->Cell(50,10,'TOTAL PROFIT(LOSS) for OPERATION',10,0,'L',0);
			$pdf->Cell(30,10,number_format($s),10,0,'R',0);
			$pdf->Cell(30,10,number_format($t),10,0,'R',0);
			
			$pdf->Ln(5);
			#END [KEPALA 6]
			
			
			#KEPALA 7
			
			$sql = "select  b.acc_name as acc_name,b.acc_no as acc_no,c.db_base as db_base,c.cr_base as cr_base,
						((c.balance_base+c.db_base)-c.cr_base) as ending_base
                        from db_coa b 
                        join db_trlbal c on c.acc_no = b.acc_no
                        where left(b.acc_no,1) > = '7' and left(b.acc_no,1) <  '8' and c.acc_period=".$period."  and b.account_neraca='1'
                        group by b.acc_name,b.acc_no,c.db_base,c.cr_base, ((c.balance_base+c.db_base)-c.cr_base) order by b.acc_no";
		    $cek  = $this->db->query($sql)->result();
			
			foreach($cek as $row){		
					
					$pdf->SetX(15);
					$pdf->SetFont('Arial','B',7);		
					$pdf->Cell(25,10,$row->acc_no,10,0,'L',0);
					$pdf->Cell(100,10,$row->acc_name,10,0,'L',0);
					$pdf->Ln(3);
			
						#DETAIL KEPALA
						$sql = "select b.acc_name ,b.acc_no ,(c.db_base - c.cr_base) as end_base from db_coa b 
								join db_trlbal c on c.acc_no = b.acc_no
								where  c.acc_period=".$period."  and account_neraca = '$row->acc_no'
								group by b.acc_name,b.acc_no,c.db_base,c.cr_base order by b.acc_no";
						$cek1 = $this->db->query($sql)->result();
							
							#VARIABEL TOTAL DETAIL CURRENT
							$a=0;
							#END
							
							FOREACH($cek1 AS $roow){
													
								#TOTAL DETAIL YTD
								$sql 	=  "select db_base - cr_base as end_base,(select balance_base from db_trlbal 
											where substring(acc_period,1,4) = '$thnutama' and substring(acc_period,5,2) = '$blnutama' and acc_no = '$roow->acc_no') 
											as balance from db_trlbal 
											where substring(acc_period,1,4) = '$thnutama' and substring(acc_period,5,2) = '$blnutama' and acc_no = '$roow->acc_no'";
								$queri 	= $this->db->query($sql)->row();
										$totytd = $queri->balance + $queri->end_base;
							
									$pdf->SetFont('Arial','',7);		
									$pdf->Cell(25,10,$roow->acc_no,10,0,'L',0);
									$pdf->Cell(30,10,$roow->acc_name,10,0,'L',0);
									$pdf->Cell(50,10,number_format($roow->end_base),10,0,'R',0);
									$pdf->Cell(30,10,number_format($totytd),10,0,'R',0);
									$pdf->Ln(3);		

									#TOTAL DETAIL
									$a  = $a+ $roow->end_base;
									#END [TOTAL DETAIL]
									
							
							}
							#END [DETAIL KEPALA]
								
								#TOTAL DETAIL ACCOUNT
								$pdf->SetX(40);
								$pdf->SetFont('Arial','B',7);		
								$pdf->Cell(50,10,'Total '.$row->acc_name,10,0,'L',0);
								$pdf->SetFont('Arial','U'.'U'.'B',7);	  	
								$pdf->Cell(30,10,number_format($a),10,0,'R',0);
								
									#TOTAL YTD
									$sql = "select sum(balance_base + (db_base - cr_base)) as totytdblc from db_trlbal a
											JOIN db_coa b ON a.acc_no = b.acc_no
											where acc_type = 2 and acc_period = ".$period." and account_neraca= '$row->acc_no'";
									$que = $this->db->query($sql)->row();
								
								$pdf->Cell(30,10,number_format($que->totytdblc),10,0,'R',0);
								$pdf->Ln(5);
								#END [TOTAL DETAIL ACCOUNT]
			
			
			
			}
			
			#END [KEPALA 7]
			
			
			
			$pdf->Ln(5);
			
			
			#TOTAL OTHER INCOME AND EXPENSES
			$oth = "select sum(a.db_base - a.cr_base) as totinc, 
					(select sum(c.db_base - c.cr_base) from db_trlbal c join db_coa d on c.acc_no = d.acc_no
						where c.acc_type = 2 and c.acc_period =".$period." and d.account_neraca = '7.02') as totexp 
				 from db_trlbal a join db_coa b on a.acc_no = b.acc_no where a.acc_type = 2 and a.acc_period =".$period." and b.account_neraca = '7.01'";
			
			$hasil = $this->db->query($oth)->row();
			$totincexp = $hasil->totinc - (-1 * $hasil->totexp);
			
			$ytdoth = "select sum(a.balance_base + (a.db_base - a.cr_base)) as totinc, 
					(select sum(c.balance_base + (c.db_base - c.cr_base)) from db_trlbal c join db_coa d on c.acc_no = d.acc_no
						where c.acc_type = 2 and c.acc_period =".$period." and  d.account_neraca = '7.02') as totexp 
				 from db_trlbal a join db_coa b on a.acc_no = b.acc_no where a.acc_type = 2 and a.acc_period =".$period."
				 and b.account_neraca = '7.01'";
			
			$hasil2 = $this->db->query($ytdoth)->row();
			#foreach($hasil2 as $roww):
			
			$totincexp2 = $hasil2->totinc - (-1 * $hasil2->totexp);	 	 
			
			#endforeach;
			
			
			
			
			#TOTAL BEFORE TAX
			$sql = "select sum((db_base-cr_base)) as endbase, 
							(select sum((db_base-cr_base)) from db_trlbal 
							  where left(acc_no,1) > 5 and left(acc_no,1) <= 7 and acc_type=2 and acc_period=".$period.") as totcost
								
							
						from db_trlbal 	where left(acc_no,1)>=4 and left(acc_no,1) <= 5 and acc_type=2  and acc_period=".$period."";
			
			
			$queri = $this->db->query($sql)->row();
			$totbftax = ($queri->endbase*-1) - $queri->totcost ;
				
			// $sql2 = "select sum(balance_base +(db_base-cr_base)) as endbase, 
							// (select sum(balance_base+(db_base-cr_base)) from db_trlbal 
							  // where left(acc_no,1) > 4 and acc_type=2 and left(acc_no,1) <= 7 and substring(acc_period,1,4)=".$thnutama." and substring(acc_period,5,2)<=".$blnutama." ) as totcost
								
							
						// from db_trlbal 	where left(acc_no,1)=4 and acc_type=2 and substring(acc_period,1,4)=".$thnutama." and substring(acc_period,5,2)<=".$blnutama."";
			
			
			$sql2 = "select sum(balance_base +(db_base-cr_base)) as endbase, 
							(select sum(balance_base+(db_base-cr_base)) from db_trlbal 
							  where left(acc_no,1) > 5 and acc_type=2 and left(acc_no,1) <= 7 and acc_period=".$period." ) as totcost
								
							
						from db_trlbal 	where left(acc_no,1)>=4 and left(acc_no,1) <= 5 and acc_type=2 and acc_period=".$period."";
			
			$queri2 = $this->db->query($sql2)->row();
			$tottax = ($queri2->endbase*-1) - $queri2->totcost;
			
			
			#TOTAL AFTER TAX
			$sql4 = "select sum(db_base-cr_base) as totdelapan
														
						from db_trlbal 	where left(acc_no,1) >= 8 and acc_type=2 and acc_period=".$period."";
			
			
			$queri4 = $this->db->query($sql4)->row();
			$totbftax4 = $totbftax - $queri4->totdelapan;
				
			// $sql5 = "select sum(balance_base + (db_base-cr_base)) totaftertax 
												
					// from db_trlbal where left(acc_no,1)>=8 and acc_type=2 
					
					// and substring(acc_period,1,4)=".$thnutama." and substring(acc_period,5,2)<=".$blnutama."";
					
			$sql5 = "select sum(balance_base + (db_base-cr_base)) totaftertax 
												
					from db_trlbal where left(acc_no,1)>=8 and acc_type=2 
					
					and acc_period=".$period."";
			
			$queri5 = $this->db->query($sql5)->row();
			$tottax5 = $tottax - $queri5->totaftertax;
			
			
			
			
			#$totbftax = $queri->totcost;
			//~ $tut2 = "select (sum(db_base)-sum(cr_base)) as ret2
			//~ from db_trlbal where left(acc_no,1)>5 and acc_type=2 and acc_period<=".$period."";
			//~ $re3 = $this->db->query($tut2)->row();
			
			//~ $pnl = ($re->ret1 - $re1->ret2);
			//~ $pnl2 = $ear->earning+($re2->ret1 - $re3->ret2);
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(25,5,'',10,0,'L',0);
		  	$pdf->Cell(50,5,'TOTAL OTHER INCOME(EXPENSES)',10,0,'L',0);
		  	$pdf->SetFont('Arial','U'.'B',7);
		  	$pdf->Cell(30,5,number_format($totincexp),10,0,'R',0);
		  	$pdf->Cell(30,5,number_format($totincexp2),10,0,'R',0);
			$pdf->Ln(5);
			
			
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(25,5,'',10,0,'L',0);
		  	$pdf->Cell(50,5,'TOTAL PROFIT(LOSS) BEFORE TAX',10,0,'L',0);
		  	$pdf->SetFont('Arial','U'.'B',7);
		  	$pdf->Cell(30,5,number_format($totbftax),10,0,'R',0);
		  	$pdf->Cell(30,5,number_format($tottax),10,0,'R',0);
			$pdf->Ln(5);
			$pdf->Cell(25,5,'',10,0,'L',0);
			
			
			$pdf->Ln(5);
					#QUERY DIATAS DELAPAN
					$sqlab = "select  b.acc_name,b.acc_no from db_coa b join db_trlbal c on c.acc_no = b.acc_no 
								where left(b.acc_no,1) > = '8' and b.account_neraca='1' group by b.acc_name,b.acc_no order by b.acc_no";
					$cekab  = $this->db->query($sqlab)->result();
					foreach($cekab as $rows){
			
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(25,5,$rows->acc_no,10,0,'L',0);
			$pdf->Cell(100,5,$rows->acc_name,10,0,'L',0);
			$pdf->Ln(3);
			
					#DETAIL QUERY DELAPAN
					
					$sqlac = "select a.balance_base,a.acc_no,a.acc_name from db_trlbal a JOIN db_coa b on a.acc_no = b.acc_no 
								 where account_neraca = '$rows->acc_no' and a.acc_period = ".$period."
										group by a.balance_base,a.acc_no,a.acc_name order by a.acc_no";
					$queriac = $this->db->query($sqlac)->result();
						foreach($queriac as $rowss){
			
			$pdf->SetFont('Arial','',7);				
			$pdf->Cell(25,5,$rowss->acc_no,10,0,'L',0);
			$pdf->Cell(50,5,$rowss->acc_name,10,0,'L',0);		
			
					#QUERY THISMON DELAPAN
					$sqlad = "select (db_base - cr_base) as dismon from db_trlbal a
								JOIN db_coa b ON a.acc_no = b.acc_no
									where a.acc_type = 2 and a.acc_period = ".$period." and a.acc_no = '$rowss->acc_no'";
					$queriad = $this->db->query($sqlad)->row();
					
					#QUERY THISMON DELAPAN
					$sqlae = "select sum(balance_base + (db_base - cr_base)) as totalytd 
								from db_trlbal a JOIN db_coa b ON a.acc_no = b.acc_no where a.acc_type = 2 and a.acc_period = ".$period." 
									and a.acc_no = '$rowss->acc_no'";
					$queriae = $this->db->query($sqlae)->row();				
							#foreach($queriad as $rowsss){
			$pdf->Cell(30,5,number_format($queriad->dismon),10,0,'R',0);
			$pdf->Cell(30,5,number_format($queriae->totalytd),10,0,'R',0);		  				
							
							#}
								
			
				$pdf->Ln(3);
				}
				$pdf->Ln(1);
			$pdf->SetFont('Arial','B',7);				
			$pdf->Cell(25,5,'',10,0,'L',0);
			$pdf->Cell(50,5,'TOTAL '.$rows->acc_name,10,0,'L',0);
					#QUERY TOTAL KEBAWAH
					$sqlaf = "select sum(db_base - cr_base) as totdismonbw 
								from db_trlbal a JOIN db_coa b ON a.acc_no = b.acc_no where a.acc_type = 2 and a.acc_period = ".$period." 
									and account_neraca = '$rows->acc_no'";
					$queriaf = $this->db->query($sqlaf)->row();	
					
					$sqlag = "select sum(balance_base +(db_base - cr_base)) as totalytdbw 
								from db_trlbal a JOIN db_coa b ON a.acc_no = b.acc_no where a.acc_type = 2 and a.acc_period = ".$period." 
									and account_neraca = '$rows->acc_no'";
					$queriag = $this->db->query($sqlag)->row();	
									
			$pdf->Cell(30,5,number_format($queriaf->totdismonbw ),10,0,'R',0);
			$pdf->Cell(30,5,number_format($queriag->totalytdbw ),10,0,'R',0);
			  
			  $pdf->Ln(5);
			}			
						 
			$pdf->Ln(5);
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(25,5,'',10,0,'L',0);
		  	$pdf->Cell(50,5,'TOTAL PROFIT(LOSS) AFTER TAX',10,0,'L',0);
		  	$pdf->SetFont('Arial','U'.'B',7);
		  	$pdf->Cell(30,5,number_format($totbftax4),10,0,'R',0);
		  	$pdf->Cell(30,5,number_format($tottax5),10,0,'R',0);
			
			$pdf->Ln(5);
			
			
			#$pdf->SetFont('Arial','B',7);
	  	
			$pdf->Output("hasil.pdf","I");	;
	
