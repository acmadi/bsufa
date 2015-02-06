<?php
class print_jadwal_pembayaran_unit extends controller{
	function jadwal_pembayaran_unit($id){
		
		die('text');	
		
			$query = $this->db->query("ViewCustomer " .$id."");
			$data	= $query->result();	
			var_dump($data);						
				
					$row 		= $query->row();
					#var_dump($row);
					$name		= $row->customer_nama;
					$project	= $row->nm_subproject;
					var_dump($project);
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
					#$discamount = $row->discamount;
					#var_dump($paytipe);exit;
					$dp			= $pricesell * (30/100);
					$dp			= number_format($dp);
					
					$pl			= $pricesell * (70/100);
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
			
			$pdf=new PDF('P','mm','A4');
			
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
			$head_hp ="Mobile Phone";
			$head_address ="Address:";
			
			var_dump($project);
			
			if($project == "AWANA CONDOTEL"){
				$head_sqm = "Nett / SGA";
			}else{
				$head_sqm ="Land & Building (Sqm)"; 
			}

				
				#HEAD COLOUM 2
				if($discount==0){
					$head_discount	=	"Discount Amount";
					$discamount = number_format($row->discamount);
					
				}else{
					$head_discount	=	"Discount (%)";
					$discamount = number_format($row->discount + $row->adddisc);
				}
				$head_pricelist	=	"Price List";
				$head_pricesell	=	"Selling Price (Tax)";
				$head_dp		=	"DP 30%";
				$head_pl		=	"PL 70%";
				$head_hodate	=	"Hand Over Date";
				
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
			$pdf->Image(site_url().'assets/images/graha.jpg',175,10,20);
			
			$pdf->SetFont('Arial','B',10);		
			$pdf->SetXY(25,16);
			$pdf->Cell(0,10,'PT. '.$head_pt,20,0,'L');
			
			$pdf->SetFont('Arial','u',12);		
			$pdf->SetXY(25,25);
			$pdf->Cell(0,10,$head_judul,20,0,'L');
			
			#subhead
			$pdf->SetFont('Arial','',8);		
				
				$pdf->SetXY(25,33);
				#$pdf->setFillColor(222,222,222);
				$pdf->Cell(30,4,$head_spdate,0,0,'L',0);
					
					$pdf->SetXY(55,33);
					$pdf->Cell(8,4,':',4,0,'L');
						
						$pdf->SetXY(57,33);
						$pdf->Cell(8,4,$salesdate,4,0,'L');
					
							$pdf->SetXY(130,33);
							$pdf->Cell(30,4,$head_pricelist,0,0,'L',0);	
							
								$pdf->SetXY(167,33);
								$pdf->Cell(8,4,':',4,0,'L');
								
									$pdf->SetXY(170,30);
									$pdf->Cell(20,10,$pricelist,10,0,'R');
				
				$pdf->SetXY(25,37);
				$pdf->Cell(30,4,$head_spno,0,0,'L',0);
				
					$pdf->SetXY(55,37);
					$pdf->Cell(8,4,':',4,0,'L');
					
							$pdf->SetXY(57,34);
							$pdf->Cell(0,10,$nosp,20,0,'L');
							
								$pdf->SetXY(130,37);
								$pdf->Cell(30,4,$head_discount,0,0,'L',0);	
								
									$pdf->SetXY(167,37);
									$pdf->Cell(8,4,':',4,0,'L');
									
										$pdf->SetXY(170,34);
										$pdf->Cell(20,10,$discamount,10,0,'R');
#										$pdf->Cell(20,10,$discount.' + '.$discount2,10,0,'R');
									
					
				$pdf->SetXY(25,41);
				$pdf->Cell(30,4,$head_nounit,0,0,'L',0);
				
					$pdf->SetXY(55,41);
					$pdf->Cell(8,4,':',4,0,'L');
				
						$pdf->SetXY(57,38);
						$pdf->Cell(0,10,$unitno,20,0,'L');
					
							$pdf->SetXY(130,41);
							$pdf->Cell(30,4,$head_pricesell,0,0,'L',0);	
							
								$pdf->SetXY(167,41);
								$pdf->Cell(8,4,':',4,0,'L');
								
									$pdf->SetXY(170,38);
									$pdf->Cell(20,10,$pricesell,10,0,'R');
								
					
				$pdf->SetXY(25,45);
				$pdf->Cell(30,4,$head_view,0,0,'L',0);
				
					$pdf->SetXY(55,45);
					$pdf->Cell(8,4,':',4,0,'L');
					
							$pdf->SetXY(57,42);
							$pdf->Cell(0,10,$unitview,20,0,'L');
					
								$pdf->SetXY(130,45);
								$pdf->Cell(30,4,$head_dp,0,0,'L',0);	
								
									$pdf->SetXY(167,45);
									$pdf->Cell(8,4,':',4,0,'L');
									
										$pdf->SetXY(170,46);
										$pdf->Cell(20,4,$dp,4,0,'R');
										
				
				$pdf->SetXY(25,49);
				$pdf->Cell(30,4,$head_sqm,0,0,'L',0);
				
					$pdf->SetXY(55,49);
					$pdf->Cell(8,4,':',4,0,'L');
					
							$pdf->SetXY(57,46);
							$pdf->Cell(0,10,$tanah.' & '.$bangunan,20,0,'L');
					
								$pdf->SetXY(130,49);
								$pdf->Cell(30,4,$head_pl,0,0,'L',0);	
								
									$pdf->SetXY(167,49);
									$pdf->Cell(8,4,':',4,0,'L');
									
										$pdf->SetXY(170,50);
										$pdf->Cell(20,4,$pl,4,0,'R');
				
				$pdf->SetXY(25,53);
				$pdf->Cell(30,4,$head_nama,0,0,'L',0);
					
					$pdf->SetXY(55,53);
					$pdf->Cell(8,4,':',4,0,'L');
					
						$pdf->SetXY(57,50);
						$pdf->Cell(0,10,$custnama,20,0,'L');
						
								$pdf->SetXY(130,53);
								$pdf->Cell(30,4,$head_hodate,0,0,'L',0);
								
									$pdf->SetXY(167,53);
									$pdf->Cell(8,4,':',4,0,'L');								
									
											$pdf->SetXY(170,51);
											$pdf->Cell(20,10,$hodate,10,0,'R');
					
				
				$pdf->SetXY(25,57);
				$pdf->Cell(30,4,$head_hp,0,0,'L',0);
				
					$pdf->SetXY(55,57);
					$pdf->Cell(8,4,':',4,0,'L');
				
						$pdf->SetXY(57,54);
						$pdf->Cell(0,10,$hp,20,0,'L');
				
					
				$pdf->SetXY(25,61);
				$pdf->Cell(30,4,$head_address,0,0,'L',0);
				
					$pdf->SetXY(55,61);
					$pdf->Cell(8,4,':',4,0,'L');

					#Potong Almat	
					$almt1 = substr($alamat,0,40);
					$almt2 = substr($alamat,41,60);
				
						$pdf->SetXY(57,58);
						$pdf->Cell(0,10,$almt1,20,0,'L');
						$pdf->SetXY(57,62);
						$pdf->Cell(0,10,$almt2,20,0,'L');
						
								
							#HEAD TABLE
							$pdf->SetXY(25,75);
							$pdf->Cell(8,4,$head_no,1,0,'C',0);
							$pdf->SetXY(33,75);
							$pdf->Cell(60,4,$head_top,1,0,'C',0);
							$pdf->SetXY(93,75);
							$pdf->Cell(40,4,$head_amount,1,0,'C',0);
							$pdf->SetXY(133,75);
							$pdf->Cell(30,4,$head_duedate,1,0,'C',0);
									
									#APPROVAL
										$pdf->SetFont('Arial','B',8);
										$pdf->SetXY(25,250);
										$pdf->Cell(60,4,'Customer',0,0,'L',0);
										$pdf->Cell(60,4,'Sales',0,0,'L',0);
										$pdf->Cell(60,4,'Developer',0,0,'L',0);
										
											$pdf->SetXY(25,270);
											$pdf->SetFont('Arial','',10);
											$pdf->Cell(60,4,$name,0,0,'L',0);
											$pdf->Cell(60,4,$salesname,0,0,'L',0);
											$pdf->Cell(60,4,'Chief Marketing Officer',0,0,'L',0);
			$no=0;
        	$i = 1;
			
			$pdf->SetFont('Arial','',10);
					$pdf->SetXY(30,80);
			$n = 0;
			foreach($data as $row){
				$paygroup = $row->paygroup_nm;
				
				if($paygroup=="Pelunasan"){
					$n++;
					if($row->paytipe_id!=2) $n="";
				}else{
					$n="";
				}
				$amount = $row->amount;
				$amount = number_format($amount);
				
				$duedate = $row->due_date;
				$duedate = indo_date($duedate);
				
				$pdf->SetX(25);
				$pdf->Cell(8,4,$i,0,0,'C',0);
				$pdf->Cell(60,4,$paygroup." ".$n,0,0,'L',0);
				$pdf->Cell(40,4,$amount,0,0,'R',0);
				$pdf->Cell(30,4,$duedate,0,0,'C',0);
				
				$no++;
				$i++;
				$pdf->Ln();
				
			}
			
			$pdf->Output("hasil.pdf","I");	;
	}
}
