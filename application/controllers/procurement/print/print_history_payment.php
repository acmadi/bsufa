<?php
class print_history_payment extends controller{
	
	
	/*function cek_lunas($spid){
		$dt = $this->db->select('id_paygroup,paygroup_nm,id_billing')
					 ->join('db_paygroup','paygroup_id = id_paygroup','left')
					 #->where('id_paygroup',2)
					 ->where('id_sp',$spid)
					 ->order_by('id_billing','DESC')
					 ->get('db_billing')->result();
					 
		$chk = $this->db->select('count(id_paygroup) as id')
					   ->where('id_sp',$spid)
				       ->where('id_paygroup',2)
				       ->get('db_billing')->row();

		$n = 0;		
		#var_dump($dt);
		$x = 165;	 
		foreach($dt as $row):
			if($row->id_paygroup == 2){
				if($chk->id <= 1) $n="";
				elseif($row->id_billing == $x) $n = 1;
				else $n++;
			}
		endforeach;			 

		return $n;
	}*/
	
	function history_payment($id){
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

			
			
				
			require('fpdf/tanpapage.php');
			
			$pdf=new PDF('L','mm','LEGAL');
			
			$pdf->SetMargins(10,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			
			#HEAD COLOUM 1
			$head_judul 	= "HISTORICAL PAYMENT";
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
					
							#$pdf->SetXY(115,33);
							#$pdf->Cell(40,4,$head_pricelist,0,0,'L',0);	
							
								#$pdf->SetXY(160,33);
								#$pdf->Cell(8,4,':  Rp. ',4,0,'L');
								
									#$pdf->SetXY(174,30);
									#$pdf->Cell(20,10,$priceman,10,0,'R');
							
							
							
							
							
							
				
				$pdf->SetXY(25,37);
				$pdf->Cell(30,4,$head_spno,0,0,'L',0);
				
					$pdf->SetXY(70,37);
					$pdf->Cell(8,4,':',4,0,'L');
					
							$pdf->SetXY(72,34);
							$pdf->Cell(0,10,$nosp,20,0,'L');
							
								#$pdf->SetXY(115,37);
								#$pdf->Cell(40,4,$head_discount,0,0,'L',0);	
								
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
									#$pdf->Cell(20,10,number_format($pricesell),10,0,'R');
							
							
							
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
							$pdf->SetFont('Arial','B',9);	
							$pdf->setFillColor(222,222,222);
							$pdf->Cell(8,6,$head_no,1,0,'C',0);
							$pdf->Cell(30,6,$head_top,1,0,'C',0);
							$pdf->Cell(18,6,$head_duedate,1,0,'C',0);
							$pdf->Cell(18,6,'Pay Date',1,0,'C',0);
							$pdf->Cell(30,6,'Pay Amount',1,0,'C',0);
							$pdf->Cell(130,6,'Description',1,0,'C',0);
							$pdf->Cell(30,6,'Bank Store',1,0,'C',0);
							$pdf->Cell(30,6,'Pinalty',1,0,'C',0);
							$pdf->Ln(6);					
														
							
			$no=0;
        	$i = 1;
			
			$pdf->SetFont('Arial','',8);
//					$pdf->SetXY(30,82);
			$n = 0;
			$m = 0;
			$totamount = 0;
			$totbalance = 0;
			$totpay =0;

			
			
			
			#select count(id_paygroup) from db_billing where id_sp = 3 and id_paygroup = 2
			$dt = $this->db->select('kwtbill_id,kwtbill_sisa,id_billing,due_date,id_paygroup,due_date,paygroup_nm,tgl_paydate,amount,kwtbill_pay,kwtbill_paydate,kwtbill_remark,kwtbill_nm')
						   ->join('db_billing','id_bill = id_billing','left')
						   ->join('db_paygroup','paygroup_id = id_paygroup','left')
						   ->order_by('id_billing','ASC')
						   ->where('id_sp',$id)
						   ->where('isnull(db_kwtbill.id_flag,0) !=',10)
						   ->get('db_kwtbill')->result();
						   
						   
			$cekdp = $this->db->select('id_billing')
							->order_by('id_billing','ASC')
							->where('id_paygroup',2)
							->where('id_sp',$id)
							->get('db_billing')->row();

			$cekpl = $this->db->select('id_billing')
							->order_by('id_billing','ASC')
							->where('id_paygroup',3)
							->where('id_sp',$id)
							->get('db_billing')->row();
#			var_dump($dt);
			$jumpay = 0;		
			
			$x = $cekdp->id_billing;	
			$y = $cekpl->id_billing;	
			$n = 1;
			$k = 1;   
			foreach($dt as $rows){								   
				
				$duedate = indo_date($rows->due_date);
				
				
				if($rows->id_paygroup==2){
					if($rows->id_paygroup != 3) $k= "";
					if($rows->id_billing==$x){
						if($n < 1) $n = 1;
						else $n = $n;
					}else{
						$n++;
						$x = $rows->id_billing;
					}
					$x = $x;
					
					#$n = $this->cek_lunas($id);
					/*if($rowcek->id <= 1){
						$n="";
					}else{
						$n = "1";
					}$n++;*/
					#var_dump($rows->id_billing);
					
				}elseif($rows->id_paygroup==3){
					if($rows->id_paygroup != 2) $n = "";
					if($rows->id_billing==$y){
						if($k < 1) $k = 1;
						else $k = $k;
					}else{
						$k++;
						$y = $rows->id_billing;
					}
					$y = $y;
									
				}else{
					$n ="";
					$k = "";
				}
				
				#TOTAL PAYMENT
				$totpay = $totpay + ($rows->kwtbill_pay);
				
				
				
				$sisa = $rows->amount - $rows->kwtbill_sisa;
				$pdf->SetX(25);
				$pdf->Cell(8,5,$i,0,0,'C',0);
				$pdf->Cell(30,5,$rows->paygroup_nm.' '.$n.$k,0,0,'L',0);
				$pdf->Cell(18,5,$duedate,0,0,'C',0);
				$pdf->Cell(18,5,indo_date($rows->kwtbill_paydate),0,0,'C',0);
				$pdf->Cell(30,5,number_format($rows->kwtbill_pay),0,0,'R',0);
				$pdf->Cell(130,5,$rows->kwtbill_remark,0,0,'L',0);
				$pdf->Cell(30,5,$rows->kwtbill_nm,0,0,'C',0);
				$pdf->Cell(30,5,'-',0,0,'C',0);
							

				$no++;
				$i++;
				$pdf->Ln(5);
				
			}
				$pdf->SetX(25);
				$pdf->setFillColor(222,222,222);
				$pdf->SetFont('Arial','B',10);
				#$pdf->Cell(8,7,'',1,0,'C',0);
				
				#$pdf->Cell(8,4,'',10,0,'C',0);
				#$pdf->Cell(40,4,'',10,0,'C',0);
				$pdf->Cell(74,4,'TOTAL PAYMENT',0,0,'R',1);
				$pdf->Cell(30,4,number_format($totpay),0,0,'R',1);
				$pdf->Cell(190,4,'',0,0,'C',1);
				
				
				
				#SUMMARY BILLING VS PAYMENT
				
							
				$pdf->SetXY(25,65);
				$pdf->setFillColor(222,222,222);
				$pdf->SetFont('Arial','u',10);
				$pdf->Cell(30,4,'Total Billing',0,0,'L',0);
				
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(2,4,':',0,0,'R',0);
				$pdf->Cell(30,4,number_format($pricesell),0,0,'R',0);
				
				$pdf->SetXY(25,69);
				#$pdf->setFillColor(222,222,222);
				$pdf->SetFont('Arial','u',10);
				$pdf->Cell(30,4,'Total Payment',0,0,'L',0);
				
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(2,4,':',0,0,'R',0);
				$pdf->Cell(30,4,number_format($totpay),0,0,'R',0);
				
				#TOTAL BALANCED
				$totbalbill = $pricesell - $totpay;
				
				
				$pdf->SetXY(25,73);
				$pdf->SetFont('Arial','u',10);
				$pdf->Cell(30,4,'Balanced',0,0,'L',0);
				
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(2,4,':',0,0,'R',0);
				$pdf->Cell(30,4,number_format($totbalbill),0,0,'R',0);
				
				
				
				
				
				#$pdf->Cell(30,4,'',10,0,'C',0);				
				$pdf->Output("hasil.pdf","I");	
		
	}
}
