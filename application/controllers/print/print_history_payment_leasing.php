<?php
class print_history_payment_leasing extends controller{
	
	
		
	function history_payment($id){
				$query = $this->db->query("ViewCustomerlease " .$id."");
			$data	= $query->result();	
									
					$row 		= $query->row();
					#var_dump($row);
					$name		= $row->customer_nama;
					$project	= $row->nm_subproject;
					#var_dump($project);
					$head_pt	= "BAKRIE SWASAKTI UTAMA";
					$nosp		= $row->no_kontrak_sewa;
					$salesdate	= $row->tgl_loo;
					$salesdate	= indo_date($salesdate);#$city		= $row->kota_nm;
					$unitno		= $row->nounit;
					$unitview	= 'TOWER A';
					$tanah		= $row->luas;
					$bangunan	= $row->luas;
					$custnama	= $row->customer_nama;
					$hp			= $row->customer_hp;
					$alamat		= $row->customer_alamat1;
					$pricelist	= $row->hrg_tot;
					$discount	= 0;
					$discount2	= 0;
					$pricesell	= $row->hrg_tot;
					$salesname	='';
					$paytipe    = '-';
					$priceman   = $row->hrg_tot;
					
					$paytipe	=  '-';
					$priceman	=  '0';
					#$discamount = $row->discamount;
					#var_dump($paytipe);exit;
					$dp			= $pricesell * (30/100);
					$dp			= number_format($dp);
					
					$pl			= $pricesell * (70/100);
					$pl			= number_format($pl);
					
					$pricelist	= $row->hrg_tot;
					$pricelist	= number_format($pricelist);
					
					
					#$pricesell	= number_format($pricesell);
					
					
					
					
					$hodate		= $row->tgl_loo;
					$hodate		= indo_date($hodate);
					
					#$date		= indo_date($date);
					
					#$project	= $row->nm_subproject;
					#$status		= $row->csfustat_nm;
					#$tipecs		= $row->cstipe_nm;
					#$desc		= $row->csdesc_nm;
					#$note		= $row->note;

			
			$tgl  = date("d-m-Y");
				
			require('fpdf/tanpapage.php');
			
			$pdf=new PDF('L','mm','legal');
			
			$pdf->SetMargins(10,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			
			#HEAD COLOUM 1
			$head_judul 	= "HISTORICAL PAYMENT";
			$head_spdate = "Contract Date";
			$head_spno = "Contract No";
			$head_nounit ="Unit Number";
			$head_view ="Unit View";
			#$head_sqm ="Land & Building (Sqm)";
			$head_nama = "Customer Name";
			$head_hp ="Mobile Phone Number";
			$head_address ="Address:";
			#var_dump($project);exit;
			$project=="BAKRIE SWASAKTI UTAMA";
			$head_sqm = "Nett / SGA";
			$tanah = 0;
			

				
				#HEAD COLOUM 2
	
				$head_discount	=	"Discount Amount (Rp)";
				$discamount = 0;
					
				
				$head_pricelist	=	"Price List";
				$head_pricesell	=	"Selling Price";
				$head_dp		=	"DP 30%";
				$head_pl		=	"PL 70%";
				#$head_hodate	=	"Hand Over Schedule";
				
					#HEAD TABLE
					$head_no	= "NO";
					$head_top	= "Description";
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
							
							
				$pdf->SetXY(25,41);
				$pdf->Cell(30,4,$head_nounit,0,0,'L',0);
				
					$pdf->SetXY(70,41);
					$pdf->Cell(8,4,':',4,0,'L');
				
						$pdf->SetXY(72,38);
						$pdf->Cell(0,10,$unitno,20,0,'L');
					
				$sumtotalbilling = $this->db->select('sum(pay_amount) as pay_amount')
							->where('no_kontrak',$row->no_kontrak) 
							->where_not_in('id_flag',10)
							->get('db_invoice')->row();
										
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
				$pdf->Cell(30,4,number_format($sumtotalbilling->pay_amount),0,0,'R',0);
				
				#TOTAL BALANCED
				$totbalbill = $pricesell - $sumtotalbilling->pay_amount;
				
				$pdf->SetXY(25,65);
				#$pdf->setFillColor(222,222,222);
				$pdf->SetFont('Arial','u',10);
				$pdf->Cell(30,4,'Balanced',0,0,'L',0);
				
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(2,4,':',0,0,'R',0);
				$pdf->Cell(30,4,number_format($totbalbill),0,0,'R',0);
				
				#HITUNG PERSEN
				
				$persen = ($sumtotalbilling->pay_amount/$pricesell) * 100;
				
				$pdf->SetXY(25,70);
				#$pdf->setFillColor(222,222,222);
				$pdf->SetFont('Arial','u',10);
				$pdf->Cell(30,4,'Payment (%)',0,0,'L',0);
				
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(2,4,':',0,0,'R',0);
				$pdf->Cell(30,4,number_format($persen).' %',0,0,'R',0);						
										
				#end pindah		
										
										
				
				$pdf->SetXY(25,45);
				$pdf->Cell(30,4,$head_nama,0,0,'L',0);
					
					$pdf->SetXY(70,45);
					$pdf->Cell(8,4,':',4,0,'L');
					
						$pdf->SetXY(72,42);
						$pdf->Cell(0,10,$custnama,20,0,'L');
						
			 #pindah
				
				// $sumtotalbilling = $this->db->select('sum(pay_amount) as pay_amount')
							// ->where('id_sp',$id) 
							// ->where_not_in('id_flag',10)
							// ->get('db_billing')->row();
				
							
				// $pdf->SetXY(25,65);
				// $pdf->setFillColor(222,222,222);
				// $pdf->SetFont('Arial','u',10);
				// $pdf->Cell(30,4,'Total Billing',0,0,'L',0);
				
				// $pdf->SetFont('Arial','',10);
				// $pdf->Cell(2,4,':',0,0,'R',0);
				// $pdf->Cell(30,4,number_format($pricesell),0,0,'R',0);
				
				// $pdf->SetXY(25,69);
				// #$pdf->setFillColor(222,222,222);
				// $pdf->SetFont('Arial','u',10);
				// $pdf->Cell(30,4,'Total Payment',0,0,'L',0);
				
				// $pdf->SetFont('Arial','',10);
				// $pdf->Cell(2,4,':',0,0,'R',0);
				// $pdf->Cell(30,4,number_format($sumtotalbilling->pay_amount),0,0,'R',0);
				
				// #TOTAL BALANCED
				// $totbalbill = $pricesell - $sumtotalbilling->pay_amount;
				
				
				// $pdf->SetXY(25,73);
				// $pdf->SetFont('Arial','u',10);
				// $pdf->Cell(30,4,'Balanced',0,0,'L',0);
				
				// $pdf->SetFont('Arial','',10);
				// $pdf->Cell(2,4,':',0,0,'R',0);
				// $pdf->Cell(30,4,number_format($totbalbill),0,0,'R',0);
			
			
						
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
			$dt = $this->db->select('kwitansi_id,kwitansi_sisa,invoice_no,base_amount,due_date,trx_type,due_date,kwitansi_paydate,kwitansi_pay,kwitansi_remark,kwitansi_nm')
						   ->join('db_invoice','no_invoice = invoice_no','left')
						   ->join('db_kontrak_sewa','no_kontrak = id_kontrak','left')
						   ->order_by('invoice_no','ASC')
						   ->where('id_kontrak',$id)
						   ->where('isnull(db_kuitansi.id_flag,0) !=',10)
						   ->get('db_kuitansi')->result();
						   
						   
			// $cekdp = $this->db->select('id_billing')
							// ->order_by('id_billing','ASC')
							// ->where('id_paygroup',2)
							// ->where('id_sp',$id)
							// ->get('db_billing')->row();

			// $cekpl = $this->db->select('id_billing')
							// ->order_by('id_billing','ASC')
							// ->where('id_paygroup',3)
							// ->where('id_sp',$id)
							// ->get('db_billing')->row();
#			var_dump($dt);
			$jumpay = 0;		
			
			// if(empty($cekdp->id_billing)){
			
			
			// $y = $cekpl->id_billing;	
			// $n = 1;
			// $k = 1;   
			// foreach($dt as $rows){								   
				
				// $duedate = indo_date($rows->due_date);
				
				
				// if($rows->id_paygroup==3){
					// if($rows->id_paygroup != 2) $n = "";
					// if($rows->id_billing==$y){
						// if($k < 1) $k = 1;
						// else $k = $k;
					// }else{
						// $k++;
						// $y = $rows->id_billing;
					// }
					// $y = $y;
									
				// }else{
					// $n ="";
					// $k = "";
				// }
				
				// #TOTAL PAYMENT
				// $totpay = $totpay + ($rows->kwtbill_pay);
				// $desc = $rows->kwtbill_remark . " ". $rows->kwtbill_descs;

				
				
				
				// $sisa = $rows->amount - $rows->kwtbill_sisa;
				// $pdf->SetX(25);
				// $pdf->Cell(8,5,$i,0,0,'C',0);
				// $pdf->Cell(30,5,$rows->paygroup_nm.' '.$n.$k,0,0,'L',0);
				// $pdf->Cell(18,5,$duedate,0,0,'C',0);
				// $pdf->Cell(18,5,indo_date($rows->kwtbill_paydate),0,0,'C',0);
				// $pdf->Cell(30,5,number_format($rows->kwtbill_pay),0,0,'R',0);
				// //$pdf->Cell(130,5,$rows->kwtbill_remark,0,0,'L',0);
				// $pdf->Cell(130,5,$desc,0,0,'L',0);
				// $pdf->Cell(30,5,$rows->kwtbill_nm,0,0,'C',0);
				// $pdf->Cell(30,5,'-',0,0,'C',0);
							

				// $no++;
				// $i++;
				// $pdf->Ln(5);
				
			// }
			// }else{
			// $x = $cekdp->id_billing;				
			// $y = $cekpl->id_billing;	
			$n = 1;
			$k = 1;   
			foreach($dt as $rows){								   
				
				$duedate = indo_date($rows->due_date);
				
				
				// if($rows->id_paygroup==2){
					// if($rows->id_paygroup != 3) $k= "";
					// if($rows->id_billing==$x){
						// if($n < 1) $n = 1;
						// else $n = $n;
					// }else{
						// $n++;
						// $x = $rows->id_billing;
					// }
					// $x = $x;
					
					// #$n = $this->cek_lunas($id);
					// /*if($rowcek->id <= 1){
						// $n="";
					// }else{
						// $n = "1";
					// }$n++;*/
					// #var_dump($rows->id_billing);
					
				// }elseif($rows->id_paygroup==3){
					// if($rows->id_paygroup != 2) $n = "";
					// if($rows->id_billing==$y){
						// if($k < 1) $k = 1;
						// else $k = $k;
					// }else{
						// $k++;
						// $y = $rows->id_billing;
					// }
					// $y = $y;
									
				// }else{
					// $n ="";
					// $k = "";
				// }
				
				#TOTAL PAYMENT
				$totpay = $totpay + ($rows->kwitansi_pay);
				//$desc = $rows->kwtbill_remark . " ". $rows->kwtbill_descs;
				$desc = $rows->kwitansi_remark;

				
				
				
				$sisa = $rows->base_amount - $rows->kwitansi_sisa;
				$pdf->SetX(25);
				$pdf->Cell(8,5,$i,0,0,'C',0);
				$pdf->Cell(30,5,$rows->trx_type,0,0,'L',0);
				$pdf->Cell(18,5,$duedate,0,0,'C',0);
				$pdf->Cell(18,5,indo_date($rows->kwitansi_paydate),0,0,'C',0);
				$pdf->Cell(30,5,number_format($rows->kwitansi_pay),0,0,'R',0);
				//$pdf->Cell(130,5,$rows->kwtbill_remark,0,0,'L',0);
				$pdf->Cell(130,5,$desc,0,0,'L',0);
				$pdf->Cell(30,5,$rows->kwitansi_nm,0,0,'C',0);
				$pdf->Cell(30,5,'-',0,0,'C',0);
							

				$no++;
				$i++;
				$pdf->Ln(5);
				
			}
		//	}
				$pdf->SetX(25);
				$pdf->setFillColor(222,222,222);
				$pdf->SetFont('Arial','B',10);
				#$pdf->Cell(8,7,'',1,0,'C',0);
				
				#$pdf->Cell(8,4,'',10,0,'C',0);
				#$pdf->Cell(40,4,'',10,0,'C',0);
				$pdf->Cell(74,4,'TOTAL PAYMENT',0,0,'R',1);
				$pdf->Cell(30,4,number_format($totpay),0,0,'R',1);
				$pdf->Cell(190,4,'',0,0,'C',1);				
				
								
				#$pdf->Cell(30,4,'',10,0,'C',0);				
				$pdf->Output("hasil.pdf","I");	
		
	}
}
