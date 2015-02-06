<?php
class print_jadwal_pembayaran_unit extends controller{
	function jadwal_pembayaran_unit($id){
		#die("test");
			
			$query = $this->db->query("ViewCustomer " .$id."");
			$data	= $query->result();	
									
					$row 		= $query->row();
					#var_dump($row);
					$name		= $row->customer_nama;
					$project	= $row->nm_subproject;
					#var_dump($project);
					$head_pt	= $row->ket;
					$nosp		= $row->no_sp;
					$salesdate	= $row->tgl_sales;
					$salesdate	= indo_date($salesdate);#$city		= $row->kota_nm;
					$unitno		= $row->unit_no;
					$unitview	= $row->view_unit;
					$tanah		= $row->tanah;
					$bangunan	= $row->bangunan;
					$custnama	= $row->customer_nama;
					$hp			= $row->customer_hp;
					$alamat		= $row->customer_alamat1;
					$pricelist	= $row->pricelist_ppn;
					$discount	= $row->discount;
					$discount2	= $row->discount2;
					$pricesell	= $row->selling_price;
					$salesname	= $row->nama;
					$paytipe    = $row->paytipe_id;
					$priceman   = $row->price_manual;
					
					$priceman	= number_format($priceman);
					#$discamount = $row->discamount;
					#var_dump($paytipe);exit;
					$dp			= $row->dp;//$pricesell * (30/100);
					$dp			= number_format($dp);
					
					$pl			= $row->pl;//$pricesell * (70/100);
					$pl			= number_format($pl);
					
					$pricelist	= $row->pricelist_ppn;
					$pricelist	= number_format($pricelist);
					
					
					$pricesell	= number_format($pricesell);
					
					
					
					
					$hodate		= $row->ho_date;
					$hodate		= indo_date($hodate);
					
					#$date		= indo_date($date);
					
					#$project	= $row->nm_subproject;
					#$status		= $row->csfustat_nm;
					#$tipecs		= $row->cstipe_nm;
					#$desc		= $row->csdesc_nm;
					#$note		= $row->note;

			
			
				
			require('fpdf/tanpapage.php');
			
			$pdf=new PDF('P','mm','LEGAL');
			
			$pdf->SetMargins(10,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			
			#HEAD COLOUM 1
			$head_judul 	= "BILLING SCHEDULE";
			$head_spdate = "SP Date";
			$head_spno = "SP No";
			$head_nounit ="Unit Number";
			$head_view ="Unit View";
			#$head_sqm ="Land & Building (Sqm)";
			$head_nama = "Customer Name";
			$head_hp ="Mobile Phone Number";
			$head_address ="Address:";
			#var_dump($project);exit;
			if($project=="AWANA CONDOTEL"){
				$head_sqm = "Nett / SGA";
				$tanah = 0;
			}else{
				$head_sqm ="Land & Building (Sqm)"; 
				$tanah = $tanah;
			}

				
				#HEAD COLOUM 2
				if($discount==0){
					$head_discount	=	"Discount Amount (Rp)";
					$discamount = number_format($row->discamount);
					
				}else{
					$head_discount	=	"Discount (%)";
					$discamount = number_format($row->discount + $row->adddisc);
				}
				$head_pricelist	=	"Price List";
				$head_pricesell	=	"Selling Price";
				$head_dp		=	"DP 30%";
				$head_pl		=	"PL 70%";
				#$head_hodate	=	"Hand Over Schedule";
				
					#HEAD TABLE
					$head_no	= "NO";
					$head_top	= "Term Of Payment";
					$head_amount	= "Amount";
					$head_duedate	= "Due Date";
			
			$pdf->SetFont('Arial','B',16);		
			$pdf->SetXY(25,10);
			$pdf->Cell(0,10,$project,20,0,'L');
			
			#image
			#$pdf->SetXY(100,10);
			#$pdf->Image(site_url().'assets/images/graha.jpg',175,10,20);
			
			$pdf->SetFont('Arial','B',10);		
			$pdf->SetXY(25,16);
			$pdf->Cell(0,10,'PT. '.$head_pt,20,0,'L');
			
			$pdf->SetFont('Arial','u',12);		
			$pdf->SetXY(25,25);
			$pdf->Cell(0,10,$head_judul,20,0,'L');
			
			#subhead
			$pdf->SetFont('Arial','',10);		
				
				$pdf->SetXY(25,33);
				#$pdf->setFillColor(222,222,222);
				$pdf->Cell(30,4,$head_spdate,0,0,'L',0);
					
					$pdf->SetXY(70,33);
					$pdf->Cell(8,4,':',4,0,'L');
						
						$pdf->SetXY(72,33);
						$pdf->Cell(8,4,$salesdate,4,0,'L');
					
							$pdf->SetXY(115,33);
							$pdf->Cell(40,4,$head_pricelist,0,0,'L',0);	
							
								$pdf->SetXY(160,33);
								$pdf->Cell(8,4,':  Rp. ',4,0,'L');
								
									$pdf->SetXY(174,30);
									$pdf->Cell(20,10,$priceman,10,0,'R');
							
							
							
							
							
							
				
				$pdf->SetXY(25,37);
				$pdf->Cell(30,4,$head_spno,0,0,'L',0);
				
					$pdf->SetXY(70,37);
					$pdf->Cell(8,4,':',4,0,'L');
					
							$pdf->SetXY(72,34);
							$pdf->Cell(0,10,$nosp,20,0,'L');
							
								$pdf->SetXY(115,37);
								$pdf->Cell(40,4,$head_discount,0,0,'L',0);	
								
									$pdf->SetXY(160,37);
									$pdf->Cell(8,4,':',4,0,'L');
									
										$pdf->SetXY(174,34);
										$pdf->Cell(20,10,$discamount,10,0,'R');
#										$pdf->Cell(20,10,$discount.' + '.$discount2,10,0,'R');
								
								
								
								
								
								
								
								
					
				$pdf->SetXY(25,41);
				$pdf->Cell(30,4,$head_nounit,0,0,'L',0);
				
					$pdf->SetXY(70,41);
					$pdf->Cell(8,4,':',4,0,'L');
				
						$pdf->SetXY(72,38);
						$pdf->Cell(0,10,$unitno,20,0,'L');
					
							
							$pdf->SetXY(115,41);
							$pdf->Cell(30,4,$head_pricesell,0,0,'L',0);	
							
								$pdf->SetXY(160,41);
								$pdf->Cell(8,4,':  Rp. ',4,0,'L');
								
									$pdf->SetXY(174,38);
									$pdf->Cell(20,10,$pricesell,10,0,'R');
							
							
							
							#$pdf->SetXY(130,41);
							#$pdf->Cell(30,4,$head_pl,0,0,'L',0);	
							
								#$pdf->SetXY(160,41);
								#$pdf->Cell(8,4,':  Rp. ',4,0,'L');
								
									#$pdf->SetXY(174,38);
									#$pdf->Cell(20,10,$pl,10,0,'R');
								
					
				$pdf->SetXY(25,45);
				$pdf->Cell(30,4,$head_view,0,0,'L',0);
				
					$pdf->SetXY(70,45);
					$pdf->Cell(8,4,':',4,0,'L');
					
							$pdf->SetXY(72,42);
							$pdf->Cell(0,10,$unitview,20,0,'L');
					#die('tes');
								$pdf->SetXY(115,45);
								$pdf->Cell(30,4,$head_dp,0,0,'L',0);	
								
									$pdf->SetXY(160,45);
									$pdf->Cell(8,4,':  Rp. ',4,0,'L');
									
										$pdf->SetXY(174,45);
										$pdf->Cell(20,4,$dp,4,0,'R');
										
				
				$pdf->SetXY(25,49);
				$pdf->Cell(30,4,$head_sqm,0,0,'L',0);
				
					$pdf->SetXY(70,49);
					$pdf->Cell(8,4,':',4,0,'L');
					
							$pdf->SetXY(72,46);
							$pdf->Cell(0,10,$tanah.' & '.$bangunan,20,0,'L');
					
								$pdf->SetXY(115,49);
								$pdf->Cell(30,4,$head_pl,0,0,'L',0);	
								
									$pdf->SetXY(160,49);
									$pdf->Cell(8,4,':  Rp. ',4,0,'L');
									
										$pdf->SetXY(174,49);
										$pdf->Cell(20,4,$pl,4,0,'R');
				
				$pdf->SetXY(25,53);
				$pdf->Cell(30,4,$head_nama,0,0,'L',0);
					
					$pdf->SetXY(70,53);
					$pdf->Cell(8,4,':',4,0,'L');
					
						$pdf->SetXY(72,50);
						$pdf->Cell(0,10,$custnama,20,0,'L');
						
								#$pdf->SetXY(130,53);
								#$pdf->Cell(30,4,$head_hodate,0,0,'L',0);
								
									#$pdf->SetXY(167,53);
									#$pdf->Cell(8,4,':',4,0,'L');								
									
											#$pdf->SetXY(170,50);
											#$pdf->Cell(20,10,$hodate,10,0,'R');
					
				
				#$pdf->SetXY(25,57);
				#$pdf->Cell(30,4,$head_hp,0,0,'L',0);
				
					#$pdf->SetXY(70,57);
					#$pdf->Cell(8,4,':',4,0,'L');
				
						#$pdf->SetXY(72,54);
						#$pdf->Cell(0,10,$hp,20,0,'L');
				
					
				#$pdf->SetXY(25,61);
				#$pdf->Cell(30,4,$head_address,0,0,'L',0);
				
					#$pdf->SetXY(70,61);
					#$pdf->Cell(8,4,':',4,0,'L');

					#Potong Almat	
					#$almt1 = substr($alamat,0,40);
					#$almt2 = substr($alamat,41,60);
				
						#$pdf->SetXY(72,58);
						#$pdf->Cell(0,10,$almt1,20,0,'L');
						#$pdf->SetXY(57,62);
						#$pdf->Cell(0,10,$almt2,20,0,'L');
						
								
							#HEAD TABLE
							$pdf->SetXY(25,75);
							$pdf->Cell(8,7,$head_no,1,0,'C',0);
							$pdf->SetXY(33,75);
							$pdf->Cell(60,7,$head_top,1,0,'C',0);
							$pdf->SetXY(93,75);
							$pdf->Cell(40,7,$head_amount,1,0,'C',0);
							$pdf->SetXY(133,75);
							$pdf->Cell(30,7,$head_duedate,1,0,'C',0);
									
									#APPROVAL
										$pdf->SetFont('Arial','B',12);
										$pdf->SetXY(25,270);
										$pdf->Cell(60,4,'Penerima Pesanan',0,0,'L',0);
										$pdf->Cell(60,4,'PEMESAN',0,0,'L',0);
										$pdf->Cell(60,4,'Sales',0,0,'L',0);
										
											$pdf->SetXY(25,300);
											$pdf->SetFont('Arial','',10);
											$pdf->Cell(60,4,'Chief Marketing Officer',0,0,'L',0);
											$pdf->Cell(60,4,$name,0,0,'L',0);
											$pdf->Cell(60,4,$salesname,0,0,'L',0);
			$no=0;
        	$i = 1;
			
			$pdf->SetFont('Arial','',12);
					$pdf->SetXY(30,82);
			$n = 0;
			$m = 0;
			$totamount = 0;
			
			#select count(id_paygroup) from db_billing where id_sp = 3 and id_paygroup = 2
			$dt = $this->db->select('count(id_paygroup) as id')
						   ->where('id_sp',$row->id_sp)
						   ->where('id_paygroup',2)
						   ->where('id_flag !=',10)
						   ->get('db_billing')->row();
						  # var_dump($dt->id);exit;
						   
			foreach($data as $row){
					#$paygroup = $row->paygroup_nm;
					#var_dump($paygroup);
					if($row->paytipe_id==1)
					{
						#die("test");
						if($row->paygroup_nm=="Pelunasan"){
							$n++;
							if($dt->id <= 1) $m="";
						}else{
							$n="";
						}
							
						if($row->paygroup_nm=="Down Payment"){
							$m++;
							if($dt->id <= 1) $m="";
						}else{
							$m="";
						}							
					}else{
						if($row->paygroup_nm=="Pelunasan"){
							$n++;
							if($row->paytipe_id!=2) $n="";
							if($dt->id <= 1) $m="";
						}else{
							$n="";
						}
							
						if($row->paygroup_nm==="Down Payment"){
							$m++;
							if($dt->id <= 1) $m="";
						}else{
							$m="";
						}	
					}

							
							
				$amount = $row->amount;
				$totamount	= $totamount+$amount;
				$amount = number_format($amount);
				
				
				
				$duedate = $row->due_date;
				$duedate = indo_date($duedate);
				
				$pdf->SetX(25);
				$pdf->Cell(8,7,$i,1,0,'C',0);
				$pdf->Cell(60,7,$row->paygroup_nm.' '.$n.$m,1,0,'L',0);
				$pdf->Cell(40,7,$amount,1,0,'R',0);
				$pdf->Cell(30,7,$duedate,1,0,'C',0);
				
				$no++;
				$i++;
				$pdf->Ln(7);
				
			}
			
				
				$totamount = number_format($totamount);
				
				$pdf->SetX(25);
				#$pdf->Cell(8,7,'',1,0,'C',0);
				
				$pdf->SetFont('Arial','B',12);
				$pdf->Cell(68,7,'TOTAL',1,0,'R',0);
				$pdf->Cell(40,7,$totamount,1,0,'R',0);
				$pdf->Cell(30,7,'',1,0,'C',0);
				
			$pdf->Output("hasil.pdf","I");	;
	}
}
