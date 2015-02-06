<?php
class print_kartu_piutang extends controller{
	function kartu_piutang($id){
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
					
					$paytipe	= $row->paytipe_nm;
					$priceman	= number_format($priceman);
					#$discamount = $row->discamount;
					#var_dump($paytipe);exit;
					$dp			= $pricesell * (30/100);
					$dp			= number_format($dp);
					
					$pl			= $pricesell * (70/100);
					$pl			= number_format($pl);
					
					$pricelist	= $row->pricelist_ppn;
					$pricelist	= number_format($pricelist);
					
					
					#$pricesell	= number_format($pricesell);
					
					
					
					
					$hodate		= $row->ho_date;
					$hodate		= indo_date($hodate);
					
					#$date		= indo_date($date);
					
					#$project	= $row->nm_subproject;
					#$status		= $row->csfustat_nm;
					#$tipecs		= $row->cstipe_nm;
					#$desc		= $row->csdesc_nm;
					#$note		= $row->note;

			
			$tgl  = date("d-m-Y");
				
			require('fpdf/tanpapage.php');
			
			$pdf=new PDF('P','mm','LEGAL');
			
			$pdf->SetMargins(10,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			
			#HEAD COLOUM 1
			$head_judul 	= "PAYMENT SCHEDULE PER CUSTOMER";
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
			
			
			#TANGGAL CETAK
			$pdf->SetFont('Arial','',6);
			$pdf->SetXY(155,10);
			$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							
			$pdf->SetXY(160,10);
			$pdf->Cell(2,4,':',4,0,'L');
								
			$pdf->SetXY(167,7);
			$pdf->Cell(20,10,$tgl,10,0,'L');
			
			
			
			
			
			
			
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
							$pdf->Cell(20,4,'Term Of Payment',0,0,'L',0);	
								
									$pdf->SetXY(145,33);
									$pdf->Cell(8,4,':',4,0,'L');
									$pdf->SetXY(148,30);
									$pdf->Cell(20,10,$paytipe,10,0,'L');
										
							
							
							
							
							
							
				$pdf->SetFont('Arial','',10);
				$pdf->SetXY(25,37);
				$pdf->Cell(30,4,$head_spno,0,0,'L',0);
				
					$pdf->SetXY(70,37);
					$pdf->Cell(8,4,':',4,0,'L');
					
							$pdf->SetXY(72,34);
							$pdf->Cell(0,10,$nosp,20,0,'L');
							
								#$pdf->SetXY(115,37);
								#$pdf->Cell(40,4,'TOP',0,0,'L',0);	
								
									#$pdf->SetXY(160,37);
									#$pdf->Cell(8,4,':',4,0,'L');
									
										#$pdf->SetXY(174,34);
										#$pdf->Cell(20,10,$discamount,10,0,'R');
#										$pdf->Cell(20,10,$discount.' + '.$discount2,10,0,'R');
								
								
								
								
								
								
								
								
					
				$pdf->SetXY(25,41);
				$pdf->Cell(30,4,$head_nounit,0,0,'L',0);
				
					$pdf->SetXY(70,41);
					$pdf->Cell(8,4,':',4,0,'L');
				
						$pdf->SetXY(72,38);
						$pdf->Cell(0,10,$unitno,20,0,'L');
					
							
							#$pdf->SetXY(115,41);
							#$pdf->Cell(30,4,$head_pricesell,0,0,'L',0);	
							
								#$pdf->SetXY(160,41);
								#$pdf->Cell(8,4,':  Rp. ',4,0,'L');
								
									#$pdf->SetXY(174,38);
									#$pdf->Cell(20,10,$pricesell,10,0,'R');
							
							
							
							#$pdf->SetXY(130,41);
							#$pdf->Cell(30,4,$head_pl,0,0,'L',0);	
							
								#$pdf->SetXY(160,41);
								#$pdf->Cell(8,4,':  Rp. ',4,0,'L');
								
									#$pdf->SetXY(174,38);
									#$pdf->Cell(20,10,$pl,10,0,'R');
								
					
				#$pdf->SetXY(25,45);
				#$pdf->Cell(30,4,$head_view,0,0,'L',0);
				
					#$pdf->SetXY(70,45);
					#$pdf->Cell(8,4,':',4,0,'L');
					
							#$pdf->SetXY(72,42);
							#$pdf->Cell(0,10,$unitview,20,0,'L');
					#die('tes');
								#$pdf->SetXY(115,45);
								#$pdf->Cell(30,4,$head_dp,0,0,'L',0);	
								
									#$pdf->SetXY(160,45);
									#$pdf->Cell(8,4,':  Rp. ',4,0,'L');
									
										#$pdf->SetXY(174,45);
										#$pdf->Cell(20,4,$dp,4,0,'R');
										
				
				#$pdf->SetXY(25,49);
				#$pdf->Cell(30,4,$head_sqm,0,0,'L',0);
				
					#$pdf->SetXY(70,49);
					#$pdf->Cell(8,4,':',4,0,'L');
					
							#$pdf->SetXY(72,46);
							#$pdf->Cell(0,10,$tanah.' & '.$bangunan,20,0,'L');
					
								#$pdf->SetXY(115,49);
								#$pdf->Cell(30,4,$head_pl,0,0,'L',0);	
								
									#$pdf->SetXY(160,49);
									#$pdf->Cell(8,4,':  Rp. ',4,0,'L');
									
										#$pdf->SetXY(174,49);
										#$pdf->Cell(20,4,$pl,4,0,'R');
				
				$pdf->SetXY(25,45);
				$pdf->Cell(30,4,$head_nama,0,0,'L',0);
					
					$pdf->SetXY(70,45);
					$pdf->Cell(8,4,':',4,0,'L');
					
						$pdf->SetXY(72,42);
						$pdf->Cell(0,10,$custnama,20,0,'L');
						
						#HEAD TABLE
							$pdf->SetXY(25,75);

							#$pdf->Cell(168,7,'History Payment',1,0,'C',0);
							
							$pdf->Ln(5);
							$pdf->SetX(25);
							$pdf->Cell(8,7,$head_no,1,0,'C',0);
							$pdf->Cell(30,7,$head_top,1,0,'C',0);
							$pdf->Cell(18,7,'Due Date',1,0,'C',0);
							$pdf->Cell(18,7,'Pay Date',1,0,'C',0);
							$pdf->Cell(30,7,'Due Amount',1,0,'C',0);
							$pdf->Cell(30,7,'Pay Amount',1,0,'C',0);
							$pdf->Cell(30,7,'Balance',1,0,'C',0);
							#$pdf->Cell(30,7,'Pinalty',1,0,'C',0);
							$pdf->Ln(7);					
														
							
			$no=0;
        	$i = 1;
			
			$pdf->SetFont('Arial','',8);
//					$pdf->SetXY(30,82);
			$n = 0;
			$m = 0;
			$totamount = 0;
			$totbalance = 0;
			$cek = $this->db->join('db_unit','unit_id = id_unit','left')
						 ->join('db_customer','customer_id = id_customer','left')
						 ->join('db_billing','sp_id = id_sp','left')
						 ->join('db_paygroup','paygroup_id = id_paygroup')
						 ->join('db_paytipe','paytipe_id = id_paytipe')
						 ->where('id_sp',$id)
						 ->order_by('due_date','ASC')
						 ->get('db_sp')->result();
			#$cek = $this->db->join			 
			$data['cekbill'] = 'cekbill';


			$x= 0;
			$subamount = 0;
			$subpay =0;
			$subos = 0;
			//if(@$cekbill):
			$no=0; 
			$totbill =0;
			$totpay =0;
				
	foreach($cek as $row){
	#DUE DATE
	$duedate = indo_date($row->due_date);
	#TOTAL BILLING
	$totbill = $totbill + ($row->amount);
	
	
	
	$no++;			
			#select count(id_paygroup) from db_billing where id_sp = 3 and id_paygroup = 2
			$dt = $this->db->select('count(id_paygroup) as id')
				   ->where('id_sp',$row->id_sp)
				   ->where('id_paygroup',2)
				   ->get('db_billing')->row();

				
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
			#die('tes');
			$n++;
							if($row->paytipe_id!=2) $n="";
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
					}

//				$amount = number_format($amount);
			
				$os = $row->amount - $row->pay_amount;
	
				if($os < 0 ) {
				$os = 0;
		
			}
				if($row->tgl_paydate == NULL) $row->tgl_paydate = "-";
				else $row->tgl_paydate = indo_date($row->tgl_paydate);
	
				$subamount = $subamount + ceil($row->amount);
				$subpay = $subpay + $row->pay_amount;
				$subos = $subos + $os;
				#TOTAL PAYMENT
				$totpay = $totpay + ($row->pay_amount);
					
				$pdf->SetX(25);
				
				$pdf->Cell(8,6,$i,1,0,'C',0);
				$pdf->Cell(30,6,$row->paygroup_nm  ." ".$n.$m,1,0,'L',0);
				$pdf->Cell(18,6,$duedate,1,0,'C',0);
				$pdf->Cell(18,6,$row->tgl_paydate,1,0,'C',0);
				$pdf->Cell(30,6,number_format($row->amount),1,0,'R',0);
				$pdf->Cell(30,6,number_format($row->pay_amount),1,0,'R',0);
				$pdf->Cell(30,6,number_format($os),1,0,'R',0);
				#$pdf->Cell(30,6,'-',1,0,'C',0);
							
				
				$no++;
				$i++;
				$pdf->Ln(6);
				
			}
				$pdf->SetX(25);
				#$pdf->Cell(8,7,'',1,0,'C',0);
				
				$pdf->SetFont('Arial','B',10);		
				$pdf->Cell(74,4,'Total',1,0,'R',0);
				$pdf->Cell(30,4,number_format($totbill),1,0,'R',0);
				$pdf->Cell(30,4,number_format($subpay),1,0,'R',0);
				$pdf->Cell(30,4,number_format($subos),1,0,'R',0);
				#$pdf->Cell(30,4,'',10,0,'C',0);
				 
				/* 
				$pdf->SetFont('Arial','B',9);
				$pdf->Cell(68,5,'TOTAL',1,0,'R',0);
				$pdf->Cell(40,5,$totamount,1,0,'R',0);
				$pdf->Cell(30,5,'',1,0,'C',0);
				$pdf->Cell(36,5,'Pay Date',1,0,'C',0);
				$pdf->Cell(36,5,'Pay Amount',1,0,'C',0);
				$pdf->Cell(36,5,'Balance',1,0,'C',0);
				$pdf->Cell(30,5,'Pinalty',1,0,'C',0);
						*/	
					#APPROVAL
				//$pdf->SetX(30);
				$pdf->SetXY(25,55);
				$pdf->SetFont('Arial','u',10);
				$pdf->Cell(30,4,'Total Billing',0,0,'L',0);
				
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(2,4,':',0,0,'R',0);
				$pdf->Cell(30,4,number_format($pricesell),0,0,'R',0);
				
				$pdf->SetXY(25,60);
				#$pdf->setFillColor(222,222,222);
				$pdf->SetFont('Arial','u',10);
				$pdf->Cell(30,4,'Total Payment',0,0,'L',0);
				
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(2,4,':',0,0,'R',0);
				$pdf->Cell(30,4,number_format($totpay),0,0,'R',0);
				
				#TOTAL BALANCED
				$totbalbill = $pricesell - $totpay;
				
				$pdf->SetXY(25,65);
				#$pdf->setFillColor(222,222,222);
				$pdf->SetFont('Arial','u',10);
				$pdf->Cell(30,4,'Balanced',0,0,'L',0);
				
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(2,4,':',0,0,'R',0);
				$pdf->Cell(30,4,number_format($totbalbill),0,0,'R',0);
				
				#HITUNG PERSEN
				
				$persen = ($totpay/$pricesell) * 100;
				
				$pdf->SetXY(25,70);
				#$pdf->setFillColor(222,222,222);
				$pdf->SetFont('Arial','u',10);
				$pdf->Cell(30,4,'Payment (%)',0,0,'L',0);
				
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(2,4,':',0,0,'R',0);
				$pdf->Cell(30,4,number_format($persen).' %',0,0,'R',0);
				
				#$totamount = number_format($totamount);
				
				$pdf->Output("hasil.pdf","I");	
		
	}
}
