<?php
			
			
			
			require('fpdf/tanpapage.php');
			extract(PopulateForm());
			$pdf=new PDF('P','mm','A4');
			
			$data = $this->db->query("neraca '".inggris_date($tgl)."'")->row();
			$tgl = explode("-","$tgl");
			$thn = $tgl[2] - 1;
			$year = $tgl[2];
			$month = $tgl[1];
			$cek = 12;
			//die($month);
			$tglini = $thn.$cek;
			//die($tglini);
			$initgl = $tgl[2].$tgl[1];
			
			$pdf->SetMargins(10,10,10);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			//die(inggris_date($tgl));
			#HEAD
			#HEADER CONTENT
				$pt			= "PT BAKRIE SWASAKTI UTAMA";
				$judul 		= "Cash Flow";
				$periode	= "Periode";
	
			#CETAK TANGGAL
				//$tgl  = date("d-m-Y");
				//$tglx = date('Y',strtotime($tgl));
			#TANGGAL CETAK
				$pdf->SetFont('Arial','',7);
				$pdf->SetXY(258,10);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							
				$pdf->SetXY(268,10);
				$pdf->Cell(2,4,':',4,0,'L');
								
				$pdf->SetXY(269,10);
				$pdf->Cell(10,4,$tgl,0,0,'L');
			
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
				$pdf->Cell(0,10,'As Of'.' : '. $initgl,20,0,'L');
				$pdf->Ln(10);
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(1);
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(3);
			$pdf->SetX(25);
			// Start Isi Tabel
			
			
			
			$pdf->SetFont('Arial','B',8);				
			
		//query liabilities
			$sql = "select * from db_trlbal a
				left join db_coa b on b.acc_no = a.acc_no
				where b.group_acc = 'L'";

			$cek  = $this->db->query($sql)->result();		
			
		
			$pdf->SetFont('Arial','',7);
			
			$i = 1;	
			$no = 1;
			$noo = 0;
			$max = 40;	
			$pdf->Ln(5);
			$tot1 = 0;
			$tot2 = 0;
			$tot3 = 0;
			$tot4 = 0;
			

		#1
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(60,7,'DESCRIPTION',1,0,'C');
			$pdf->Cell(30,7,'Current Month',1,0,'C');
			$pdf->Cell(30,7,'Year To Date',1,0,'C');
			$pdf->Ln(7);
		#2
			
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(60,5,'A. CASH INFLOW OPERATING',1,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',1,0,'L');
			$pdf->Cell(30,5,'',1,0,'C');
			
			$pdf->Ln(5);
		#3	
		#query 
	//	for ($i = 0;$i < 2;$i++){
	
			$ac = "select isnull(sum(amount),0) as amount, (select isnull(sum(amount),0) as amount  from db_cashheader 
					  inner join db_cashflow on cashflow_id=cash_in
					  where year(trans_date)=".$year." and month(trans_date)<=".$month." and cash_in=2) as last_amount from db_cashheader 
					  inner join db_cashflow on cashflow_id=cash_in
					  where year(trans_date)=".$year." and month(trans_date)=".$month." and cash_in=2";
			$condotel = $this->db->query($ac)->row();
			
			$at = "select isnull(sum(amount),0) as amount, (select isnull(sum(amount),0) as amount  from db_cashheader 
					  inner join db_cashflow on cashflow_id=cash_in
					  where year(trans_date)=".$year." and month(trans_date)<=".$month." and cash_in=3) as last_amount from db_cashheader 
					  inner join db_cashflow on cashflow_id=cash_in
					  where year(trans_date)=".$year." and month(trans_date)=".$month." and cash_in=3";
			$townhouse = $this->db->query($at)->row();
		
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(60,3,'Collection Town House',1,'L'.'R','L');
			$pdf->Cell(30,3,number_format($townhouse->amount),1,0,'R');
			$pdf->Cell(30,3,number_format($townhouse->last_amount),1,0,'C');
			$pdf->Ln(3);
			$pdf->Cell(60,3,'Collection Condotel',1,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,3,number_format($condotel->amount),1,0,'R');
			$pdf->Cell(30,3,number_format($condotel->last_amount),1,0,'C');
			
			$pdf->Ln(3);
		//}
		#4	
			
			$total_collection=$townhouse->amount+$condotel->amount;
			$total_lastcollection=$townhouse->last_amount+$condotel->last_amount;
			
			$link=$pdf->AddLink();
			//$pdf->Write(5,'aquí',$link);
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(60,4,'Total Cash Inflow Operating',1,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->SetLink($link); 
			$pdf->Cell(30,4,number_format($total_collection),1,0,'R');
			$pdf->Cell(30,4,number_format($total_lastcollection),1,0,'C');
			
			$pdf->Ln(5);
				$pdf->SetFont('Arial','B',7);
			$pdf->Cell(60,5,'B. CASH OUTFLOW OPERATING',1,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',1,0,'L');
			$pdf->Cell(30,5,'',1,0,'C');
			
			$pdf->Ln(5);
		#3	
		#query 
		//for ($i = 0;$i < 11;$i++){
		
			$Contruction = "select sum(debit) as amount, (select isnull(sum(amount),0) as amount  from db_cashheader 
						        inner join db_cashflow on cashflow_id=cash_in
					            where year(trans_date)=".$year." and month(trans_date)<=".$month." and cash_in=143) as last_amount from db_gldetail where year(trans_date)=$tgl[2] and month(trans_date)=$tgl[1] and acc_no='2.01.01.01.01' and module='CB'";
			$Contruction2 = $this->db->query($Contruction)->row();
			
			$infra =  "select isnull(sum(amount),0) as amount, (select isnull(sum(amount),0) as amount  from db_cashheader 
						        inner join db_cashflow on cashflow_id=cash_in
					            where year(trans_date)=".$year." and month(trans_date)<=".$month." and cash_in=142) as last_amount from db_cashheader 
					  inner join db_cashflow on cashflow_id=cash_in
					  where year(trans_date)=".$year." and month(trans_date)=".$month." and cash_in=142";
			$infra2 = $this->db->query($infra)->row();
			
			$consultant = "select sum(debit) as amount, (select isnull(sum(amount),0) as amount  from db_cashheader 
						        inner join db_cashflow on cashflow_id=cash_in
					            where year(trans_date)=".$year." and month(trans_date)<=".$month." and cash_in=144) as last_amount from db_gldetail where year(trans_date)=$tgl[2] and month(trans_date)=$tgl[1] and acc_no='2.01.01.01.02' and module='CB'";
			$consultant2 = $this->db->query($consultant)->row();
			
			$personal = "select isnull(sum(amount),0) as amount, (select isnull(sum(amount),0) as amount  from db_cashheader 
						        inner join db_cashflow on cashflow_id=cash_in
					            where year(trans_date)=".$year." and month(trans_date)<=".$month." and cash_in=21) as last_amount from db_cashheader 
								inner join db_cashflow on cashflow_id=cash_in
								where year(trans_date)=".$year." and month(trans_date)=".$month." and cash_in=21";
			$personal2 = $this->db->query($personal)->row();
			
			$marketing =  "select isnull(sum(amount),0) as amount, (select isnull(sum(amount),0) as amount  from db_cashheader 
						        inner join db_cashflow on cashflow_id=cash_in
					            where year(trans_date)=".$year." and month(trans_date)<=".$month." and cash_in=10) as last_amount from db_cashheader 
								inner join db_cashflow on cashflow_id=cash_in
								where year(trans_date)=".$year." and month(trans_date)=".$month." and cash_in=10";
			$marketing2 = $this->db->query($marketing)->row();
			
			$general = "select isnull(sum(amount),0) as amount, (select isnull(sum(amount),0) as amount  from db_cashheader 
						        inner join db_cashflow on cashflow_id=cash_in
					            where year(trans_date)=".$year." and month(trans_date)<=".$month." and cash_in=19) as last_amount from db_cashheader 
								inner join db_cashflow on cashflow_id=cash_in
								where year(trans_date)=".$year." and month(trans_date)=".$month." and cash_in=19";
			$general2 = $this->db->query($general)->row();
			
			$other = "select isnull(sum(amount),0) as amount, (select isnull(sum(amount),0) as amount  from db_cashheader 
						   inner join db_cashflow on cashflow_id=cash_in
					       where year(trans_date)=".$year." and month(trans_date)<=".$month." and cash_in=146) as last_amount from db_cashheader 
					       inner join db_cashflow on cashflow_id=cash_in
					       where year(trans_date)=".$year." and month(trans_date)=".$month." and cash_in=146";
			$other2 = $this->db->query($other)->row();
			
			$legal = "select isnull(sum(amount),0) as amount, (select isnull(sum(amount),0) as amount  from db_cashheader 
						   inner join db_cashflow on cashflow_id=cash_in
					       where year(trans_date)=".$year." and month(trans_date)<=".$month." and cash_in=145) as last_amount from db_cashheader 
					       inner join db_cashflow on cashflow_id=cash_in
					       where year(trans_date)=".$year." and month(trans_date)=".$month." and cash_in=145";
			$legal2 = $this->db->query($legal)->row();
			
			$capex = "select isnull(sum(amount),0) as amount, (select isnull(sum(amount),0) as amount  from db_cashheader 
						   inner join db_cashflow on cashflow_id=cash_in
					       where year(trans_date)=".$year." and month(trans_date)<=".$month." and cash_in=148) as last_amount from db_cashheader 
					       inner join db_cashflow on cashflow_id=cash_in
					       where year(trans_date)=".$year." and month(trans_date)=".$month." and cash_in=148";
			$capex2 = $this->db->query($capex)->row();
			
			
			
			
			
			
					
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(60,3,'Personal Expenses ',1,0,'L');
			$pdf->Cell(30,3,number_format($personal2->amount),1,0,'R');
			$pdf->Cell(30,3,number_format($personal2->last_amount),1,0,'C');
			$pdf->Ln(3);
			$pdf->Cell(60,3,'Marketing Expenses',1,0,'L');
			$pdf->Cell(30,3,number_format($marketing2->amount),1,0,'R');
			$pdf->Cell(30,3,number_format($marketing2->last_amount),1,0,'C');
			$pdf->Ln(3);
			$pdf->Cell(60,3,'General & Administration Expense',1,0,'L');
			$pdf->Cell(30,3,number_format($general2->amount),1,0,'R');
			$pdf->Cell(30,3,number_format($general2->last_amount),1,0,'C');
			$pdf->Ln(3);
			$pdf->Cell(60,3,'Development Cost',1,0,'L');
			$pdf->Cell(30,3,'',1,0,'R');
			$pdf->Cell(30,3,'',1,0,'C');
			$pdf->Ln(3);
			$pdf->Cell(60,3,'Contruction Progress ',1,0,'L');
			$pdf->Cell(30,3,number_format($Contruction2->amount),1,0,'R');
			$pdf->Cell(30,3,number_format($Contruction2->last_amount),1,0,'C');
			$pdf->Ln(3);
			$pdf->Cell(60,3,'Infrastruktur',1,0,'L');
			$pdf->Cell(30,3,number_format($infra2->amount),1,0,'R');
			$pdf->Cell(30,3,number_format($infra2->last_amount),1,0,'C');
			$pdf->Ln(3);
			$pdf->Cell(60,3,'Soft Cost & Legal',1,0,'L');
			$pdf->Cell(30,3,number_format($consultant2->amount),1,0,'R');
			$pdf->Cell(30,3,number_format($consultant2->last_amount),1,0,'C');
			$pdf->Ln(3);
			$pdf->Cell(60,3,'Legal & Permit',1,0,'L');
			$pdf->Cell(30,3,number_format($legal2->amount),1,0,'R');
			$pdf->Cell(30,3,number_format($legal2->last_amount),1,0,'C');
			$pdf->Ln(3);
			$pdf->Cell(60,3,'Capex',1,0,'L');
			$pdf->Cell(30,3,number_format($capex2->amount),1,0,'R');
			$pdf->Cell(30,3,number_format($capex2->last_amount),1,0,'C');
			$pdf->Ln(3);
			$pdf->Cell(60,3,'Others',1,0,'L');			
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,3,number_format($other2->amount),1,0,'R');
			$pdf->Cell(30,3,number_format($other2->last_amount),1,0,'C');
			
			$pdf->Ln(3);
		//}
		#4
			//$total2 = 
			$total_outflow_operating= $Contruction2->amount+$infra2->amount +$consultant2->amount+$personal2->amount+$marketing2->amount+$general2->amount+$other2->amount;
			$total_outflow_operating_last= $Contruction2->last_amount+$infra2->last_amount +$consultant2->last_amount+$personal2->last_amount+$marketing2->last_amount+$general2->last_amount+$other2->last_amount;

			
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(60,4,'Total Cash Outflow Operating',1,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,4,number_format($total_outflow_operating),1,0,'R');
			$pdf->Cell(30,4,number_format($total_outflow_operating_last),1,0,'C');
			
			$pdf->Ln(5);
			
			$net_operating = $total_collection - $total_outflow_operating;
			$net_operating_last = $total_lastcollection - $total_outflow_operating_last;
		#5	
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(60,4,'NET  OPERATING CASH FLOW',1,0,'L',1);
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,4,number_format($net_operating),1,0,'R',1);
			$pdf->Cell(30,4,number_format($net_operating_last),1,0,'C',1);
			
			$pdf->Ln(5);
	  
	  
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(60,5,'C. CASH INFLOW NON OPERATING',1,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',1,0,'L');
			$pdf->Cell(30,5,'',1,0,'C');
			
			$pdf->Ln(5);
		#3	
		#query 
		//for ($i = 0;$i < 3;$i++){
		
		$jasa_giro = "select sum(db_gldetail.credit) as amount, (select isnull(sum(amount),0) as amount  from db_cashheader 
						   inner join db_cashflow on cashflow_id=cash_in
					       where year(trans_date)=".$year." and month(trans_date)<=".$month." and cash_in=127) as last_amount from db_gldetail inner join db_glheader
								on db_gldetail.voucher=db_glheader.voucher
								where year(db_gldetail.trans_date)=$tgl[2] and month(db_gldetail.trans_date)=$tgl[1] and acc_no in ('7.01.01.01','7.01.01.02') and status=1";
		$jasa_giro2 = $this->db->query($jasa_giro)->row();
		
		$deposit_break = "select isnull(sum(amount),0) as amount, (select isnull(sum(amount),0) as amount  from db_cashheader 
						   inner join db_cashflow on cashflow_id=cash_in
					       where year(trans_date)=".$year." and month(trans_date)<=".$month." and cash_in=149) as last_amount  from db_cashheader 
					  inner join db_cashflow on cashflow_id=cash_in
					  where year(trans_date)=".$year." and month(trans_date)=".$month." and cash_in=149";
		$deposit_break2 = $this->db->query($deposit_break)->row();
		
		
		$kpa = "select sum(db_gldetail.credit) as amount from db_gldetail inner join db_glheader
								on db_gldetail.voucher=db_glheader.voucher
								where year(db_gldetail.trans_date)=$tgl[2] and month(db_gldetail.trans_date)=$tgl[1] and acc_no in ('1.01.01.02.99.01','1.01.01.02.99.02','1.01.01.02.99.03') and status=1";
		$kpa2 = $this->db->query($kpa)->row();
		
		$kpa_last = "select sum(db_gldetail.credit) as amount from db_gldetail inner join db_glheader
								on db_gldetail.voucher=db_glheader.voucher
								where year(db_gldetail.trans_date)=$tgl[2] and month(db_gldetail.trans_date)=$tgl[1] and acc_no in ('1.01.01.02.99.01','1.01.01.02.99.02','1.01.01.02.99.03') and status=1";
		$kpa_last2 = $this->db->query($kpa_last)->row();
		
		$other_outflow = "select isnull(sum(amount),0) as amount, (select isnull(sum(amount),0) as amount  from db_cashheader 
						   inner join db_cashflow on cashflow_id=cash_in
					       where year(trans_date)=".$year." and month(trans_date)<=".$month." and cash_in=76) as last_amount  from db_cashheader 
					  inner join db_cashflow on cashflow_id=cash_in
					  where year(trans_date)=".$year." and month(trans_date)=".$month." and cash_in=76";
		$other_outflow2 = $this->db->query($other_outflow)->row();
		
		
		
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(60,3,'Interest Of TD, Jasa Giro',1,0,'L');
			$pdf->Cell(30,3,number_format($jasa_giro2->amount),1,0,'R');
			$pdf->Cell(30,3,number_format($jasa_giro2->last_amount),1,0,'C');
			$pdf->Ln(3);
			$pdf->Cell(60,3,'Time Deposit Break',1,0,'L');
			$pdf->Cell(30,3,number_format($deposit_break2->amount),1,0,'R');
			$pdf->Cell(30,3,number_format($deposit_break2->last_amount),1,0,'C');
			$pdf->Ln(3);
			$pdf->Cell(60,3,'KPA Break',1,0,'L');
			$pdf->Cell(30,3,number_format($kpa2->amount),1,0,'R');
			$pdf->Cell(30,3,number_format($kpa_last2->amount),1,0,'C');
			$pdf->Ln(3);
			// $pdf->Cell(60,3,'BSU',1,0,'L');
			// $pdf->Cell(30,3,'',1,0,'R');
			// $pdf->Cell(30,3,'',1,0,'C');
			// $pdf->Ln(3);
			// $pdf->Cell(60,3,'BDM',1,0,'L');
			// $pdf->Cell(30,3,'',1,0,'R');
			// $pdf->Cell(30,3,'',1,0,'C');
			// $pdf->Ln(3);
			$pdf->Cell(60,3,'Others',1,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,3,number_format($other_outflow2->amount),1,0,'R');
			$pdf->Cell(30,3,number_format($other_outflow2->last_amount),1,0,'C');
			
			$pdf->Ln(3);
		//}
		#4
			$total_inflow_nonoperating = $jasa_giro2->amount+$kpa2->amount+$other_outflow2->amount;
			$total_inflow_nonoperating_last = $jasa_giro2->last_amount+$kpa_last2->amount+$other_outflow2->last_amount;
			
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(60,4,'Total Cash Inflow non Operating',1,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,4,number_format($total_inflow_nonoperating),1,0,'R');
			$pdf->Cell(30,4,number_format($total_inflow_nonoperating_last),1,0,'C');
			
			$pdf->Ln(5);
				$pdf->SetFont('Arial','B',7);
			$pdf->Cell(60,5,'D. CASH OUTFLOW NON OPERATING',1,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',1,0,'L');
			$pdf->Cell(30,5,'',1,0,'C');
			
			$pdf->Ln(5);
		#3	
		#query 
		//for ($i = 0;$i < 11;$i++){
		
		$provisi = "select sum(db_gldetail.debit) as amount, (select isnull(sum(amount),0) as amount  from db_cashheader 
						   inner join db_cashflow on cashflow_id=cash_in
					       where year(trans_date)=".$year." and month(trans_date)<=".$month." and cash_in=137) as last_amount from db_gldetail inner join db_glheader
					on db_gldetail.voucher=db_glheader.voucher 
					where year(db_gldetail.trans_date)=$tgl[2] and month(db_gldetail.trans_date)=$tgl[1] 
					and acc_no in ('7.02.02') and db_glheader.status=1 and db_gldetail.module='CB'";
		
		$provisi2 = $this->db->query($provisi)->row();
		
		$deposit_kpa = "select isnull(sum(amount),0) as amount, (select isnull(sum(amount),0) as amount  from db_cashheader 
						   inner join db_cashflow on cashflow_id=cash_in
					       where year(trans_date)=".$year." and month(trans_date)<=".$month." and cash_in=87) as last_amount  from db_cashheader 
					  inner join db_cashflow on cashflow_id=cash_in
					  where year(trans_date)=".$year." and month(trans_date)=".$month." and cash_in=87";
		$deposit_kpa2 = $this->db->query($deposit_kpa)->row();
		
		$bank_kpa = "select isnull(sum(amount),0) as amount, (select isnull(sum(amount),0) as amount  from db_cashheader 
						   inner join db_cashflow on cashflow_id=cash_in
					       where year(trans_date)=".$year." and month(trans_date)<=".$month." and cash_in=116) as last_amount  from db_cashheader 
					  inner join db_cashflow on cashflow_id=cash_in
					  where year(trans_date)=".$year." and month(trans_date)=".$month." and cash_in=116";
		$bank_kpa2 = $this->db->query($bank_kpa)->row();
		
		$bsu = "select isnull(sum(amount),0) as amount, (select isnull(sum(amount),0) as amount  from db_cashheader 
						   inner join db_cashflow on cashflow_id=cash_in
					       where year(trans_date)=".$year." and month(trans_date)<=".$month." and cash_in=147) as last_amount from db_cashheader 
					  inner join db_cashflow on cashflow_id=cash_in
					  where year(trans_date)=".$year." and month(trans_date)=".$month." and cash_in=147";
		$bsu2 = $this->db->query($bsu)->row();
		
		$bdm = "select isnull(sum(amount),0) as amount, (select isnull(sum(amount),0) as amount  from db_cashheader 
						   inner join db_cashflow on cashflow_id=cash_in
					       where year(trans_date)=".$year." and month(trans_date)<=".$month." and cash_in=69) as last_amount from db_cashheader 
					  inner join db_cashflow on cashflow_id=cash_in
					  where year(trans_date)=".$year." and month(trans_date)=".$month." and cash_in=69";
		$bdm2 = $this->db->query($bdm)->row();
		
		$cancel = "select isnull(sum(amount),0) as amount, (select isnull(sum(amount),0) as amount  from db_cashheader 
						   inner join db_cashflow on cashflow_id=cash_in
					       where year(trans_date)=".$year." and month(trans_date)<=".$month." and cash_in=70) as last_amount from db_cashheader 
					  inner join db_cashflow on cashflow_id=cash_in
					  where year(trans_date)=".$year." and month(trans_date)=".$month." and cash_in=70";
		$cancel2 = $this->db->query($cancel)->row();
		
		$other_out_nonoperating = "select isnull(sum(amount),0) as amount, (select isnull(sum(amount),0) as amount  from db_cashheader 
						   inner join db_cashflow on cashflow_id=cash_in
					       where year(trans_date)=".$year." and month(trans_date)<=".$month." and cash_in=141) as last_amount from db_cashheader 
					  inner join db_cashflow on cashflow_id=cash_in
					  where year(trans_date)=".$year." and month(trans_date)=".$month." and cash_in=141";
		$other_out_nonoperating2 = $this->db->query($other_out_nonoperating)->row();
		
		
		
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(60,3,'Bank Charges/Provisi',1,0,'L');
			$pdf->Cell(30,3,number_format($provisi2->amount),1,0,'R');
			$pdf->Cell(30,3,number_format($provisi2->last_amount),1,0,'C');
			$pdf->Ln(3);
			$pdf->Cell(60,3,'Time Deposit Placement',1,0,'L');
			$pdf->Cell(30,3,number_format($deposit_kpa2->amount),1,0,'R');
			$pdf->Cell(30,3,number_format($deposit_kpa2->last_amount),1,0,'C');
			$pdf->Ln(3);
			$pdf->Cell(60,3,'Bank KPA Placement',1,0,'L');
			$pdf->Cell(30,3,number_format($bank_kpa2->amount),1,0,'R');
			$pdf->Cell(30,3,number_format($bank_kpa2->last_amount),1,0,'C');
			$pdf->Ln(3);
			$pdf->Cell(60,3,'BSU',1,0,'L');
			$pdf->Cell(30,3,number_format($bsu2->amount),1,0,'R');
			$pdf->Cell(30,3,number_format($bsu2->last_amount),1,0,'C');
			$pdf->Ln(3);
			$pdf->Cell(60,3,'BDM',1,0,'L');
			$pdf->Cell(30,3,number_format($bdm2->amount),1,0,'R');
			$pdf->Cell(30,3,number_format($bdm2->last_amount),1,0,'C');
			$pdf->Ln(3);
			$pdf->Cell(60,3,'Cancelation Unit',1,0,'L');
			$pdf->Cell(30,3,number_format($cancel2->amount),1,0,'R');
			$pdf->Cell(30,3,number_format($cancel2->last_amount),1,0,'C');
			$pdf->Ln(3);
			$pdf->Cell(60,3,'Others',1,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,3,number_format($other_out_nonoperating2->amount),1,0,'R');
			$pdf->Cell(30,3,number_format($other_out_nonoperating2->last_amount),1,0,'C');
			
			$pdf->Ln(3);
		//}
		#4	
			$Total_outflow_nonoperating= $provisi2->amount+ $bsu2->amount+ $other_out_nonoperating2->amount;
			$Total_outflow_nonoperating_last= $provisi2->last_amount+ $bsu2->last_amount+ $other_out_nonoperating2->last_amount+$deposit_kpa2->last_amount+$bank_kpa2->last_amount+$bdm2->last_amount+$cancel2->last_amount;
			
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(60,4,'Total Cash Outflow non Operating',1,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,4,number_format($Total_outflow_nonoperating),1,0,'R');
			$pdf->Cell(30,4,number_format($Total_outflow_nonoperating_last),1,0,'C');
			
			$pdf->Ln(5);
		#5	
			$total_net_nonoperating = $total_inflow_nonoperating-$Total_outflow_nonoperating;
			$total_net_nonoperating_last = $total_inflow_nonoperating_last-$Total_outflow_nonoperating_last;
			
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(60,4,'NET  NON OPERATING CASH FLOW',1,0,'L',1);
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,4,number_format($total_net_nonoperating) ,1,0,'R',1);
			$pdf->Cell(30,4,number_format($total_net_nonoperating_last),1,0,'C',1);
			
			$total_netcashflow = $total_net_nonoperating+$net_operating;
			$total_netcashflow_last = $total_net_nonoperating_last+$net_operating_last;
			
			$pdf->Ln(5);
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(60,4,'E. NET CASH FLOW',1,0,'L',1);
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,4,number_format($total_netcashflow),1,0,'R',1);
			$pdf->Cell(30,4,number_format($total_netcashflow_last),1,0,'C',1);
			
			$beginning_balance=10379322296;
			$ending_balance = $beginning_balance-$total_netcashflow;
			$ending_balance_last = $beginning_balance+$total_netcashflow;
			
			$pdf->Ln(5);
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(60,4,'F. BEGINNING BALANCE',1,0,'L',1);
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,4,number_format($beginning_balance),1,0,'R',1);
			$pdf->Cell(30,4,0,1,0,'C',1);
			
			$pdf->Ln(5);
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(60,4,'G. ENDING BALANCE',1,0,'L',1);
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,4,number_format($ending_balance_last),1,0,'R',1);
			$pdf->Cell(30,4,number_format($ending_balance),1,0,'C',1);
			
			// $pdf->Ln(5);
			
				// $pdf->SetFont('Arial','B',7);
			// $pdf->Cell(60,5,'Restricted Fund',1,0,'L');
			// $pdf->SetFont('Arial','',7);
			// $pdf->Cell(30,5,'',1,0,'L');
			// $pdf->Cell(30,5,'',1,0,'C');
			
			// $pdf->Ln(5);
		// #3	
		// #query 
		// //for ($i = 0;$i < 11;$i++){
		
			// $pdf->SetFont('Arial','',7);
			// $pdf->Cell(60,3,'Rekening KPA BNI',1,0,'L');
			// $pdf->Cell(30,3,'',1,0,'R');
			// $pdf->Cell(30,3,'',1,0,'C');
			// $pdf->Ln(3);
			// $pdf->Cell(60,3,'TD Bank BTN',1,0,'L');
			// $pdf->SetFont('Arial','',7);
			// $pdf->Cell(30,3,'',1,0,'R');
			// $pdf->Cell(30,3,'',1,0,'C');
			
			// $pdf->Ln(3);
		// //}
		// #4	
			
			// $pdf->SetFont('Arial','B',7);
			// $pdf->Cell(60,4,'Cash Bank & Restricted Fund',1,0,'L');
			// $pdf->SetFont('Arial','',7);
			// $pdf->Cell(30,4,number_format($data->nilai1),1,0,'R');
			// $pdf->Cell(30,4,number_format($data->nilai1),1,0,'C');
			
			$pdf->Ln(5);
			
			$pdf->Output("hasil.pdf","I");	;
	
