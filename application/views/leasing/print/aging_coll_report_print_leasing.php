<?php
	extract(PopulateForm());
	$session_id = $this->UserLogin->isLogin();
	$pt = $session_id['id_pt'];
	$data_pt = $this->mstmodel->get_nama_pt($pt);
	$nama_pt = "PT. \t".$data_pt['ket'];
			
	$start_date = inggris_date($start_date);
	#$end_date	= inggris_date($end_date);
			
	#$rows = $this->db->query("SoldUnit ");
	#$data = $rows->result();
	#var_dump ($asdate);
	require('fpdf/classreport.php');
	$pdf=new PDF('L','mm','A4');
	$pdf->SetMargins(2,10,2);
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',14);
	$pdf->SetMargins(2,10,2);
		
						
	#HEADER CONTENT
	$judul 		= "AGING AR COLLECTION REPORT";
	$periode	= "Periode";
	
			
	#PROJECT NAME
	if($subproject == 11103){ $project = 'ROP';}
	elseif($subproject == 11104){ $project = 'WB2';}
	elseif($subproject == 11106){ $project = 'WB1';}
	elseif($subproject == 11202){ $project = 'Bakrie Tower';}
	elseif($subproject == 11204){ $project = 'Media Walk';}
	elseif($subproject == 11203){ $project = 'Life Style & Entertainment Center';}
	elseif($subproject == 11207){ $project = 'HRC Stage 2';}
	elseif($subproject == 11208){ $project = 'Concert Hall & Office Tower';}
	elseif($subproject == 11110){ $project = 'Tower 18';}
	elseif($subproject == 11101){ $project = 'TRA)';}
	elseif($subproject == 1111){ $project = 'The 18TH Rasuna Res. North Tower';}
	elseif($subproject == 11202){ $project = 'RE - Bakrie Tower';}
	elseif($subproject == 11224){ $project = 'RE - The Grove Suites';}
	elseif($subproject == 11214){ $project = 'RE - The Grove Masterpiece';}
	elseif($subproject == 11204){ $project = 'RE - The Grove Empyreal';}
	elseif($subproject == 3104){ $project = 'The Wave "Reef" (Tower 24)';}
	elseif($subproject == 3102){ $project = 'OCEA CONDOTEL';}
	elseif($subproject == 3101){ $project = 'The Wave "Coral" (Tower 22)';}
	elseif($subproject == 3103){ $project = 'The Wave "Sand" (Tower 23 )';}
	elseif($subproject == '') { $project = 'ALL';} 
	
	
	
	#CETAK TANGGAL
	$tgl  = date("d-m-Y");
	#TANGGAL CETAK
			$pdf->SetFont('Arial','',6);
			$pdf->SetXY(258,10);
			$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							
			$pdf->SetXY(268,10);
			$pdf->Cell(2,4,':',4,0,'L');
								
			$pdf->SetXY(269,10);
			$pdf->Cell(10,4,$tgl,0,0,'L');
			
	#$month1 = date( 'F', mktime(0, 0, 0, $periode1));		
	#$month2 = date( 'F', mktime(0, 0, 0, $periode2));		
					
	#Header
	#$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
	$pdf->SetFont('Arial','B',12);
	
	$pdf->SetX(25);
	$pdf->Cell(0,10,$nama_pt,20,0,'L');
			
	$pdf->SetFont('Arial','',10);
	#$pdf->SetFont('Arial','B',12);		
	$pdf->SetXY(25,16);
	$pdf->Cell(0,10,$judul.' - '.$project,20,0,'L');
	
	#die('tes');
	
	#FUNGSI UBAH TANGGAL
	$mon 	= substr($tgl,3,2);
	$year	= substr($tgl,6,4);
	
	$month = date( 'F', mktime(0, 0, 0, $mon));
	
	$pdf->SetXY(25,20);
	//$pdf->Cell(0,10,'As Off : '.$month.' '.$year,20,0,'L');
	$pdf->Cell(0,10,'As Off : '.$start_date,20,0,'L');
	
	
	#HEADER TABLE
	#$pdf->ln(8);
	
	$pdf->SetXY(3,35);
	$pdf->SetFont('Arial','',6);
	$pdf->Cell(5,4,'No',1,0,'C',0);
	$pdf->Cell(15,4,'Unit No',1,0,'C',0);
	$pdf->Cell(40,4,'Customer Name',1,0,'C',0);
	//$pdf->Cell(15,4,'Payment Type',1,0,'C',0);
	$pdf->Cell(12,4,'LOO Date',1,0,'C',0);
	$pdf->Cell(12,4,'Sqm.Nett',1,0,'C',0);
	$pdf->Cell(12,4,'Sqm.SGA',1,0,'C',0);
	$pdf->Cell(20,4,'Billing (Ppn)',1,0,'C',0);
	$pdf->Cell(20,4,'Paid',1,0,'C',0);
	$pdf->Cell(5,4,'%',1,0,'C',0);
	
	$pdf->Cell(20,4,'Not Due',1,0,'C',0);
	$pdf->Cell(20,4,'Over Due',1,0,'C',0);
	$pdf->Cell(20,4,'0 - 30 Days',1,0,'C',0);
	$pdf->Cell(20,4,'31 - 60 Days',1,0,'C',0);
	$pdf->Cell(20,4,'61 - 90 Days',1,0,'C',0);
	$pdf->Cell(20,4,' > 90 Days',1,0,'C',0);
	$pdf->Cell(25,4,'TOTAL OUTSTANDING',1,0,'C',0);
	$pdf->Ln(5);
		
		$rows = $this->db->query("UnitSales ".$pt."");
		$data = $rows->result();
		#var_dump($data);
	
	
	#KONDISI ALL PROJECT
	if(@$cek == '1'){
	
	#MENGITUNG & UPDATE HARI
	foreach($data as $row){
	
	$idsp = $row->sp_id;
	
	
	// $sql = $this->db->select('datediff(day, due_date,getdate()) as jumlahhari,id_billing')
							// ->where('id_sp',$idsp)
							// ->get('db_billing')
							// ->result();
		// #var_dump($sql);
		// foreach($sql as $rows){
			// $hari = $rows->jumlahhari;
			// $idbilling = $rows->id_billing;
			
			// #var_dump($hari);
			// $update = $this->db->set('hari_sisa',$hari)
						// ->where('id_sp',$idsp)
						// ->where('id_billing',$idbilling)
						// ->update('db_billing');
					// }
}
	
	
	#NEXT HEADER PAGE
	$y_axis =0;
	$row_height = 4;
	$y_axis = $y_axis + $row_height;
	
	$max=34;
	$no=1;
	$i = 1;
	
	
	$totssqm =0;
	$totsga =0;
	$totsellprice =0;
	$totcoll =0;
	$totnotdue =0;
	$totaging30 =0;
	$totaging60 =0;
	$totaging90 =0;
	$totagingover =0;
	#$overdue =0;
	$totos	=0;
	
	$rows = $this->db->query("AgingbyALLProject '".$pt."','".$start_date."','".$duapuluh."'");
	$data = $rows->result();
	
	#ROW DATA
	foreach($data as $row){
	#$pdf->SetX(3);		
	#$pdf->SetFont('Arial','',5);
	$idsp 	  = $row->sp_id;
	
	
	#var_dump($idsp);
	#$query = $this->db->query("AgingDays '".$idsp."'");
	#$pdf->Cell(10,4,$query->jumlahhari,0,0,'L');
	#$hari = $query->jumlahhari;
	#var_dump($query);
				#HEADER NEXT PAGE
				if($no == $max){
				$pdf->AddPage();
				$pdf->SetFont('Arial','B',12);
	
					$pdf->SetX(25);
					$pdf->Cell(0,10,$nama_pt,20,0,'L');
			
					$pdf->SetFont('Arial','',10);
		
					$pdf->SetXY(25,16);
					$pdf->Cell(0,10,$judul.' - '.$project,20,0,'L');
	
					#FUNGSI UBAH TANGGAL
					$mon 	= substr($tgl,3,2);
					$year	= substr($tgl,6,4);
	
					$month = date( 'F', mktime(0, 0, 0, $mon));
	
					$pdf->SetXY(25,20);
					$pdf->Cell(0,10,'As Off : '.$month.' '.$year,20,0,'L');
	
					#TANGGAL CETAK
					$pdf->SetFont('Arial','',6);
					$pdf->SetXY(258,10);
					$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							
					$pdf->SetXY(268,10);
					$pdf->Cell(2,4,':',4,0,'L');
								
					$pdf->SetXY(269,10);
					$pdf->Cell(10,4,$tgl,0,0,'L');
					#HEADER TABLE
					
	
							$y_axis_initial = 35;
							$y_axis = 0;
							#$pdf->SetFont('Arial','',8);
							#$pdf->setFillColor(222,222,222);
							$pdf->SetY($y_axis_initial);
							$pdf->SetX(3);
							$pdf->SetFont('Arial','',6);
							$pdf->Cell(5,4,'No',1,0,'C',0);
							$pdf->Cell(15,4,'Unit No',1,0,'C',0);
							$pdf->Cell(40,4,'Customer Name',1,0,'C',0);
							//$pdf->Cell(15,4,'Payment Type',1,0,'C',0);
							$pdf->Cell(12,4,'LOO Date',1,0,'C',0);
							$pdf->Cell(12,4,'Sqm.Nett',1,0,'C',0);
							$pdf->Cell(12,4,'Sqm.SGA',1,0,'C',0);
							$pdf->Cell(20,4,'Billing (Ppn)',1,0,'C',0);
							$pdf->Cell(20,4,'Paid',1,0,'C',0);
							$pdf->Cell(5,4,'%',1,0,'C',0);
							$pdf->Cell(20,4,'Not Due',1,0,'C',0);
							$pdf->Cell(20,4,'Over Due',1,0,'C',0);
							$pdf->Cell(20,4,'0 - 30 Days',1,0,'C',0);
							$pdf->Cell(20,4,'31 - 60 Days',1,0,'C',0);
							$pdf->Cell(20,4,'61 - 90 Days',1,0,'C',0);
							$pdf->Cell(20,4,' > 90 Days',1,0,'C',0);
							$pdf->Cell(25,4,'TOTAL OUTSTANDING',1,0,'C',0);
							$pdf->Ln(5);
			
								$no=0;
								
							#$pdf->SetXY(269,10);
							#$pdf->Cell(10,4,$tgl,0,0,'L');
						}
	
			#NILAI COLLECTION
			// $sql = $this->db->select('sum(isnull(pay_amount,0)) as payamount')
							// ->where('id_sp',$idsp)
							// ->get('db_billing')
							// ->row();	
							
			// $sql = $this->db->select('sum(isnull(kwtbill_pay,0)) as payamount')
							// ->where('id_bill in', '(select id_billing from db_billing where id_sp = '.$idsp.')', false)
						// //	->where('id_sp',$idsp)
						    // ->where('isnull(id_flag,0) !=',10)
							// ->get('db_kwtbill')
							// ->row();						
							

			$sql1 = $this->db->select('due_date')
							->where('id_sp',$idsp)
							->get('db_billing')
							->row();
			
			
			
			// #AGING 0 > (not due)
			// $sql2 = "select sum(amount) - sum(isnull(pay_amount,0)) as notdue from db_billing 
							// join db_sp on sp_id = id_sp
					// join db_customer on id_customer = customer_id
					// where id_sp = '$idsp' and hari_sisa < 0
					// ";
					// $rows = $this->db->query($sql2)->row();
					// $notdue = $rows->notdue;
					// #var_dump($aging30);
			
			
			// #AGING 0 - 30
			// $sql3 = "select sum(amount) - sum(isnull(pay_amount,0)) as aging30 from db_billing 
							// join db_sp on sp_id = id_sp
					// join db_customer on id_customer = customer_id
					// where id_sp = '$idsp' and hari_sisa between 1 and 30
					// ";
					// $rows = $this->db->query($sql3)->row();
					// $aging30 = $rows->aging30;
					// #var_dump($aging30);
					
			// #AGING 31 - 60
			// $sql4 = "select sum(amount) - sum(isnull(pay_amount,0)) as aging60 from db_billing 
							// join db_sp on sp_id = id_sp
					// join db_customer on id_customer = customer_id
					// where id_sp = '$idsp' and hari_sisa between 31 and 60
					// ";
					// $rows = $this->db->query($sql4)->row();
					// $aging60 = $rows->aging60;
					// #var_dump($aging30);			
						
			// #AGING 61 - 90
			// $sql5 = "select sum(amount) - sum(isnull(pay_amount,0)) as aging90 from db_billing 
							// join db_sp on sp_id = id_sp
					// join db_customer on id_customer = customer_id
					// where id_sp = '$idsp' and hari_sisa between 61 and 90
					// ";
					// $rows = $this->db->query($sql5)->row();
					// $aging90 = $rows->aging90;
					// #var_dump($aging30);
					
			// #AGING > 90
			// $sql6 = "select sum(amount) - sum(isnull(pay_amount,0)) as agingover from db_billing 
							// join db_sp on sp_id = id_sp
					// join db_customer on id_customer = customer_id
					// where id_sp = '$idsp' and hari_sisa > 90
					// ";
					// $rows = $this->db->query($sql6)->row();
					// $agingover = $rows->agingover;
					// #var_dump($aging30);
			
			#AGING > 120
			#$sql7 = "select sum(amount) - sum(isnull(pay_amount,0)) as overdue from db_billing 
			#				join db_sp on sp_id = id_sp
			#		join db_customer on id_customer = customer_id
			#		where id_sp = '$idsp' and hari_sisa between 91 and 120
			#		";
			#		$rows = $this->db->query($sql7)->row();
			#		$overdue = $rows->overdue;
			
			
			
			#HITUNG PERSEN
			$sellprice = $row->selling_price;
			$payamount = $row->payamount;
			$persen	= ($payamount/$sellprice)*100;
					
					#TOT SELL PRICE
					$totsellprice 	= $totsellprice + $sellprice;
					$totssqm 		= $totssqm + ($row->tanah);
					$totsga 		= $totsga + ($row->bangunan);
	
					$totcoll 		= $totcoll + ($row->payamount);
					$totnotdue 		= $totnotdue + ($row->notdue);
					$totaging30		= $totaging30 + ($row->aging30);
					$totaging60 	= $totaging60 +  ($row->aging60);
					$totaging90 	= $totaging90 +  ($row->aging90);
					$totagingover 	= $totagingover + ($row->agingover);
					$totoverdue		=  $totaging30 + $totaging60 + $totaging90 + $totagingover ;
					
					
			#OVERDUE
			$overdue =  ($row->aging30) +  ($row->aging60) +  ($row->aging90) + ($row->agingover);
			
			
			#var_dump($sql);
			$pdf->SetFont('Arial','',5);
			$pdf->SetX(3);
			$pdf->Cell(5,4,$i,0,0,'C');
			$pdf->Cell(15,4,$row->unit_no,0,0,'L');
			$pdf->Cell(40,4,$row->customer_nama,0,0,'L');
			//$pdf->Cell(15,4,$row->paytipe_nm,0,0,'L');
			#$pdf->Cell(20,10,'To '.$month2,0,0,'L');
			$tglsales = indo_date($row->tgl_sales);
			$pdf->Cell(12,4,$tglsales,0,0,'C');
			$pdf->Cell(12,4,$row->tanah,0,0,'C');
			$pdf->Cell(12,4,$row->bangunan,0,0,'C');
			$pdf->Cell(20,4,number_format($row->selling_price),0,0,'R');
			$pdf->Cell(20,4,number_format($row->payamount),0,0,'R');
			$pdf->Cell(5,4,number_format($persen),0,0,'R');
			$pdf->Cell(20,4,number_format($row->notdue),0,0,'R');
			$pdf->Cell(20,4,number_format($overdue),0,0,'R');
			$pdf->Cell(20,4,number_format($row->aging30),0,0,'R');
			$pdf->Cell(20,4,number_format($row->aging60),0,0,'R');
			$pdf->Cell(20,4,number_format($row->aging90),0,0,'R');
			$pdf->Cell(20,4,number_format($row->agingover),0,0,'R');
			
			#TOTAL OS
			$os = ($row->selling_price) - ($row->payamount);
			$pdf->Cell(25,4,number_format($os),0,0,'R');
			
			$totos			= $totos + $os;
			
			$no++;	
			$i++;
			$pdf->Ln();
	
	}	
	
				#TOTAL SELLING PRICE
				$pdf->SetX(3);
				$pdf->setFillColor(222,222,222);
				$pdf->SetFont('Arial','B',5);
				$pdf->Cell(57,4,'TOTAL',0,0,'R',1);
				$pdf->Cell(12,4,number_format($totssqm),0,0,'C',1);
				$pdf->Cell(12,4,number_format($totsga),0,0,'C',1);
				$pdf->Cell(20,4,number_format($totsellprice),0,0,'R',1);
				$pdf->Cell(20,4,number_format($totcoll),0,0,'R',1);
				$pdf->Cell(5,4,'',0,0,'C',1);
				$pdf->Cell(20,4,number_format($totnotdue),0,0,'R',1);
				$pdf->Cell(20,4,number_format($totoverdue),0,0,'R',1);
				$pdf->Cell(20,4,number_format($totaging30),0,0,'R',1);
				$pdf->Cell(20,4,number_format($totaging60),0,0,'R',1);
				$pdf->Cell(20,4,number_format($totaging90),0,0,'R',1);
				$pdf->Cell(20,4,number_format($totagingover),0,0,'R',1);
				$pdf->Cell(25,4,number_format($totos),0,0,'R',1);
				
		
				$pdf->Output("history.pdf","I");
				
}
	
	
	
	
	
	
	#KONDISI PER PROJECT		
	
	
	else {
		
		#MENGITUNG & UPDATE HARI
	foreach($data as $row){
	
	$idsp = $row->sp_id;
	#$idsubproject = $row->id_subproject;
	#$customer = $row->id_customer;
	#var_dump($idsubproject);
	
	// $sql = $this->db->select('datediff(day, due_date,getdate()) as jumlahhari,id_billing')
							// ->where('id_sp',$idsp)
							// ->get('db_billing')
							// ->result();
		// #var_dump($sql);
		// foreach($sql as $rows){
			// $hari = $rows->jumlahhari;
			// $idbilling = $rows->id_billing;
			
			// #var_dump($hari);
			// $update = $this->db->set('hari_sisa',$hari)
						// ->where('id_sp',$idsp)
						// ->where('id_billing',$idbilling)
						// ->update('db_billing');
					// }
}
	
	
	#NEXT HEADER PAGE
	$y_axis =0;
	$row_height = 4;
	$y_axis = $y_axis + $row_height;
	
	$max=34;
	$no=1;
	$i = 1;
	
	
	$totssqm =0;
	$totsga =0;
	$totsellprice =0;
	$totcoll =0;
	$totnotdue =0;
	$totaging30 =0;
	$totaging60 =0;
	$totaging90 =0;
	$totagingover =0;
	$totoverdue =0;
	$totos	=0;
	
	
	
	
	
		#QUERY DATA BASE ON PROJECT
		//$rows = $this->db->query("UnitSalesProject '".$subproject."'");
		$rows = $this->db->query("AgingbyProject_leasing '".$subproject."','".$start_date."'");
		$data = $rows->result();
	
	#ROW DATA
	foreach($data as $row){
	#$pdf->SetX(3);		
	#$pdf->SetFont('Arial','',5);
	$idsp 	  = $row->sp_id;
	#$customer = $row->id_customer;
	#var_dump
	
	#var_dump($idsp);
	#$query = $this->db->query("AgingDays '".$idsp."'");
	#$pdf->Cell(10,4,$query->jumlahhari,0,0,'L');
	#$hari = $query->jumlahhari;
	#var_dump($query);
				#HEADER NEXT PAGE
				if($no == $max){
				$pdf->AddPage();
				$pdf->SetFont('Arial','B',12);
	
					$pdf->SetX(25);
					$pdf->Cell(0,10,$nama_pt,20,0,'L');
			
					$pdf->SetFont('Arial','',10);
		
					$pdf->SetXY(25,16);
					$pdf->Cell(0,10,$judul.' - '.$project,20,0,'L');
	
					#FUNGSI UBAH TANGGAL
					$mon 	= substr($tgl,3,2);
					$year	= substr($tgl,6,4);
	
					$month = date( 'F', mktime(0, 0, 0, $mon));
	
					$pdf->SetXY(25,20);
					$pdf->Cell(0,10,'As Off : '.$month.' '.$year,20,0,'L');
	
					#TANGGAL CETAK
					$pdf->SetFont('Arial','',6);
					$pdf->SetXY(258,10);
					$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							
					$pdf->SetXY(268,10);
					$pdf->Cell(2,4,':',4,0,'L');
								
					$pdf->SetXY(269,10);
					$pdf->Cell(10,4,$tgl,0,0,'L');
					#HEADER TABLE
					
	
							$y_axis_initial = 35;
							$y_axis = 0;
							#$pdf->SetFont('Arial','',8);
							#$pdf->setFillColor(222,222,222);
							$pdf->SetY($y_axis_initial);
							$pdf->SetX(3);
							$pdf->SetFont('Arial','',6);
							$pdf->Cell(5,4,'No',1,0,'C',0);
							$pdf->Cell(15,4,'Unit No',1,0,'C',0);
							$pdf->Cell(40,4,'Customer Name',1,0,'C',0);
							//$pdf->Cell(15,4,'Payment Type',1,0,'C',0);
							$pdf->Cell(12,4,'LOODate',1,0,'C',0);
							$pdf->Cell(12,4,'Sqm.Nett',1,0,'C',0);
							$pdf->Cell(12,4,'Sqm.SGA',1,0,'C',0);
							$pdf->Cell(20,4,'Billing (Ppn)',1,0,'C',0);
							$pdf->Cell(20,4,'Collection',1,0,'C',0);
							//$pdf->Cell(5,4,'%',1,0,'C',0);
							$pdf->Cell(20,4,'Not Due',1,0,'C',0);
							$pdf->Cell(20,4,'Over Due',1,0,'C',0);
							$pdf->Cell(20,4,'0 - 30 Days',1,0,'C',0);
							$pdf->Cell(20,4,'31 - 60 Days',1,0,'C',0);
							$pdf->Cell(20,4,'61 - 90 Days',1,0,'C',0);
							$pdf->Cell(20,4,' > 90 Days',1,0,'C',0);
						
							$pdf->Cell(25,4,'TOTAL OUTSTANDING',1,0,'C',0);
							$pdf->Ln(5);
			
								$no=0;
								
							#$pdf->SetXY(269,10);
							#$pdf->Cell(10,4,$tgl,0,0,'L');
						}
	
			#NILAI COLLECTION
			// $sql = $this->db->select('sum(isnull(pay_amount,0)) as payamount')
							// ->where('id_sp',$idsp)
							// ->get('db_billing')
							// ->row();
	
			$sql1 = $this->db->select('due_date')
							->where('id_sp',$idsp)
							->get('db_billing')
							->row();
			
			
			
			// #AGING 0 > (not due)
			// $sql2 = "select sum(amount) - sum(isnull(pay_amount,0)) as notdue from db_billing 
							// join db_sp on sp_id = id_sp
					// join db_customer on id_customer = customer_id
					// where id_sp = '$idsp' and hari_sisa < 0
					// ";
					// $rows = $this->db->query($sql2)->row();
					// $notdue = $rows->notdue;
					// #var_dump($aging30);
			
			
			// #AGING 0 - 30
			// $sql3 = "select sum(amount) - sum(isnull(pay_amount,0)) as aging30 from db_billing 
							// join db_sp on sp_id = id_sp
					// join db_customer on id_customer = customer_id
					// where id_sp = '$idsp' and hari_sisa between 1 and 30
					// ";
					// $rows = $this->db->query($sql3)->row();
					// $aging30 = $rows->aging30;
					// #var_dump($aging30);
					
			// #AGING 31 - 60
			// $sql4 = "select sum(amount) - sum(isnull(pay_amount,0)) as aging60 from db_billing 
							// join db_sp on sp_id = id_sp
					// join db_customer on id_customer = customer_id
					// where id_sp = '$idsp' and hari_sisa between 31 and 60
					// ";
					// $rows = $this->db->query($sql4)->row();
					// $aging60 = $rows->aging60;
					// #var_dump($aging30);			
						
			// #AGING 61 - 90
			// $sql5 = "select sum(amount) - sum(isnull(pay_amount,0)) as aging90 from db_billing 
							// join db_sp on sp_id = id_sp
					// join db_customer on id_customer = customer_id
					// where id_sp = '$idsp' and hari_sisa between 61 and 90
					// ";
					// $rows = $this->db->query($sql5)->row();
					// $aging90 = $rows->aging90;
					// #var_dump($aging30);
					
			// #AGING > 90
			// $sql6 = "select sum(amount) - sum(isnull(pay_amount,0)) as agingover from db_billing 
							// join db_sp on sp_id = id_sp
					// join db_customer on id_customer = customer_id
					// where id_sp = '$idsp' and hari_sisa > 90
					// ";
					// $rows = $this->db->query($sql6)->row();
					// $agingover = $rows->agingover;
					#var_dump($aging30);
			
			#AGING > 120
			#$sql7 = "select sum(amount) - sum(isnull(pay_amount,0)) as overdue from db_billing 
			#				join db_sp on sp_id = id_sp
			#		join db_customer on id_customer = customer_id
			#		where id_sp = '$idsp' and hari_sisa between 91 and 120
			#		";
			#		$rows = $this->db->query($sql7)->row();
			#		$overdue = $rows->overdue;
			
			
			
			#HITUNG PERSEN
			$sellprice = $row->billing;
			
			$payamount = $row->payamount;
			//$persen	= ($payamount/$sellprice)*100;
					
					#TOT SELL PRICE
					$totsellprice 	= $totsellprice + $sellprice;
					$totssqm 		= $totssqm + ($row->tanah);
					$totsga 		= $totsga + ($row->bangunan);
	
					$totcoll 		= $totcoll + ($row->payamount);
					$totnotdue 		= $totnotdue + ($row->notdue);
					$totaging30		= $totaging30 + ($row->aging30);
					$totaging60 	= $totaging60 + ($row->aging60);
					$totaging90 	= $totaging90 + ($row->aging90);
					$totagingover 	= $totagingover + ($row->agingover);
					$totoverdue		=  $totaging30 + $totaging60 + $totaging90 + $totagingover ;
					
			
			#OVERDUE
			
			$overdue = $row->aging30 + $row->aging60 + $row->aging90 + $row->agingover;
			$collection = $row->payamount;
			
			#var_dump($sql);
			$pdf->SetFont('Arial','',5);
			$pdf->SetX(3);
			$pdf->Cell(5,4,$i,0,0,'C');
			$pdf->Cell(15,4,$row->unit_no,0,0,'L');
			$pdf->Cell(40,4,$row->customer_nama,0,0,'L');
			//$pdf->Cell(15,4,$row->paytipe_nm,0,0,'L');
			#$pdf->Cell(20,10,'To '.$month2,0,0,'L');
			$tglsales = indo_date($row->tgl_sales);
			$pdf->Cell(12,4,$tglsales,0,0,'C');
			$pdf->Cell(12,4,$row->tanah,0,0,'C');
			$pdf->Cell(12,4,$row->bangunan,0,0,'C');
			$pdf->Cell(20,4,number_format($row->billing),0,0,'R');
			$pdf->Cell(20,4,number_format($collection),0,0,'R');
			//$pdf->Cell(5,4,'',0,0,'R');
			$pdf->Cell(20,4,number_format($row->notdue),0,0,'R');
			$pdf->Cell(20,4,number_format($overdue),0,0,'R');
			$pdf->Cell(20,4,number_format($row->aging30),0,0,'R');
			$pdf->Cell(20,4,number_format($row->aging60),0,0,'R');
			$pdf->Cell(20,4,number_format($row->aging90),0,0,'R');
			$pdf->Cell(20,4,number_format($row->agingover),0,0,'R');
		
			#TOTAL OS
			$os = ($row->billing) - ($row->payamount);
			$pdf->Cell(25,4,number_format($os),0,0,'R');
			
			$totos			= $totos + $os;
			
			$no++;	
			$i++;
			$pdf->Ln();
	
	}	
	
				#TOTAL SELLING PRICE
				$pdf->SetX(3);
				$pdf->setFillColor(222,222,222);
				$pdf->SetFont('Arial','B',5);
				$pdf->Cell(57+15,4,'TOTAL',0,0,'R',1);
				$pdf->Cell(12,4,number_format($totssqm),0,0,'C',1);
				$pdf->Cell(12,4,number_format($totsga),0,0,'C',1);
				$pdf->Cell(20,4,number_format($totsellprice),0,0,'R',1);
				$pdf->Cell(20,4,number_format($totcoll),0,0,'R',1);
				$pdf->Cell(5,4,'',0,0,'C',1);
				$pdf->Cell(20,4,number_format($totnotdue),0,0,'R',1);
				$pdf->Cell(20,4,number_format($totoverdue),0,0,'R',1);
				$pdf->Cell(20,4,number_format($totaging30),0,0,'R',1);
				$pdf->Cell(20,4,number_format($totaging60),0,0,'R',1);
				$pdf->Cell(20,4,number_format($totaging90),0,0,'R',1);
				$pdf->Cell(20,4,number_format($totagingover),0,0,'R',1);
				
				$pdf->Cell(25,4,number_format($totos),0,0,'R',1);
				

		
		
		
		
		$pdf->Output("history.pdf","I");
	
	
	
}		
			
