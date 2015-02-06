<?php
class print_kartu_piutang_lease extends controller{
	function kartu_piutang($id){
	
				//var_dump($id);
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
			
			$pdf=new PDF('P','mm','letter');
			
			$pdf->SetMargins(10,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			
			#HEAD COLOUM 1
			$head_judul 	= "KARTU PIUTANG PER CUSTOMER";
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
					$head_top	= "Invoice No";
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
				//tutup						
				// $pdf->SetXY(25,55);
				// $pdf->SetFont('Arial','u',10);
				// $pdf->Cell(30,4,'Total Billing',0,0,'L',0);
				
				// $pdf->SetFont('Arial','',10);
				// $pdf->Cell(2,4,':',0,0,'R',0);
				// $pdf->Cell(30,4,number_format($pricesell),0,0,'R',0);
				
				// $pdf->SetXY(25,60);
				// #$pdf->setFillColor(222,222,222);
				// $pdf->SetFont('Arial','u',10);
				// $pdf->Cell(30,4,'Total Payment',0,0,'L',0);
				
				// $pdf->SetFont('Arial','',10);
				// $pdf->Cell(2,4,':',0,0,'R',0);
				// $pdf->Cell(30,4,number_format($sumtotalbilling->pay_amount),0,0,'R',0);
				
				// #TOTAL BALANCED
				// $totbalbill = $pricesell - $sumtotalbilling->pay_amount;
				
				// $pdf->SetXY(25,65);
				// #$pdf->setFillColor(222,222,222);
				// $pdf->SetFont('Arial','u',10);
				// $pdf->Cell(30,4,'Balanced',0,0,'L',0);
				
				// $pdf->SetFont('Arial','',10);
				// $pdf->Cell(2,4,':',0,0,'R',0);
				// $pdf->Cell(30,4,number_format($totbalbill),0,0,'R',0);
				
				// #HITUNG PERSEN
				
				// $persen = ($sumtotalbilling->pay_amount/$pricesell) * 100;
				
				// $pdf->SetXY(25,70);
				// #$pdf->setFillColor(222,222,222);
				// $pdf->SetFont('Arial','u',10);
				// $pdf->Cell(30,4,'Payment (%)',0,0,'L',0);
				
				// $pdf->SetFont('Arial','',10);
				// $pdf->Cell(2,4,':',0,0,'R',0);
				// $pdf->Cell(30,4,number_format($persen).' %',0,0,'R',0);						
				// tutup				
				#end pindah		
										
										
				
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
			// $cek = $this->db->join('db_unit','unit_id = id_unit','left')
						 // ->join('db_customer','customer_id = id_customer','left')
						 // ->join('db_billing','sp_id = id_sp','left')
						 // ->join('db_paygroup','paygroup_id = id_paygroup')
						 // ->join('db_paytipe','paytipe_id = id_paytipe')
						 // ->where('id_sp',$id)
						 // ->order_by('due_date','ASC')
						 // ->get('db_sp')->result();
			#$cek = $this->db->join			 
			
			$query2 = $this->db->query("ViewCustomerleasedetail " .$id."");
			$cek	= $query2->result();	
			
			
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
	
	$sumamount=($row->trx_amount + $row->stamp);
	
	#TOTAL BILLING
	$totbill = $totbill + ($sumamount);
	
	$sumbilling = $this->db->select('sum(kwitansi_pay) as pay_amount')
							->where('invoice_no',$row->no_invoice) 
							->where_not_in('id_flag',10)
							->get('db_kuitansi')->row();
	
	$no++;			
			#select count(id_paygroup) from db_billing where id_sp = 3 and id_paygroup = 2
			// $dt = $this->db->select('count(id_paygroup) as id')
				   // ->where('id_sp',$row->id_sp)
				   // ->where('id_paygroup',2)
				   // ->get('db_billing')->row();

				
				$os = $sumamount - $sumbilling->pay_amount;
	
		
				if($row->tgl_payment == NULL) $row->tgl_payment = "-";
				else $row->tgl_payment = indo_date($row->tgl_payment);
	
				$subamount = $subamount + ceil($row->trx_amount);
				$subpay = $subpay + $sumbilling->pay_amount;
				$subos = $subos + $os;
				#TOTAL PAYMENT
				$totpay = $totpay + ($sumbilling->pay_amount);
					
				$pdf->SetX(25);
				
				$pdf->Cell(8,6,$i,1,0,'C',0);
				if ($row->id_kontrak==1551){
				$pdf->Cell(30,6,$row->kwitansi_nm,1,0,'L',0);
				}else{
				$pdf->Cell(30,6,$row->no_invoice,1,0,'L',0);
				}
				$pdf->Cell(18,6,$duedate,1,0,'C',0);
				$pdf->Cell(18,6,$row->tgl_payment,1,0,'C',0);
				$pdf->Cell(30,6,number_format($sumamount),1,0,'R',0);
				$pdf->Cell(30,6,number_format($sumbilling->pay_amount),1,0,'R',0);
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
				
				
				$pdf->Output("hasil.pdf","I");	
		
	}
}
