<?php
			//$data = $this->db->query("neraca")->row();
			
			
			
			
			require('fpdf/tanpapage.php');
			extract(PopulateForm());
			$pdf=new PDF('P','mm','A4');
			
			$data = $this->db->query("neraca '".inggris_date($tgl)."'")->row();
			
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEADER CONTENT
				$pt			= "GRAHA MULTI INSANI";
				$judul 		= "Balance Sheet";
				$periode	= "Periode";
	
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#TANGGAL CETAK
				$pdf->SetFont('Arial','',7);
				$pdf->SetXY(258,10);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							
				$pdf->SetXY(268,10);
				$pdf->Cell(2,4,':',4,0,'L');
								
				$pdf->SetXY(269,10);
				$pdf->Cell(10,4,$tgl,0,0,'L');
			
			#Header
				$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'As Of'.' : '. $data->tgl,20,0,'L');
				$pdf->Ln(10);
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(1);
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(3);
			
			// Start Isi Tabel
			
			
			
			$pdf->SetFont('Arial','B',8);
			
			
			
			$pdf->Cell(60,5,'Description ',10,0,'C');
			$pdf->Cell(30,5,'Balance',10,0,'C');
			$pdf->Cell(20,5,'',10,0,'C');
			$pdf->Cell(60,5,'Description',10,0,'C');
			$pdf->Cell(30,5,'Balance',10,0,'C');
			$pdf->Ln(5);
			$pdf->Cell(0,0,'',1,0,'L');
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
			
			
/*		
foreach($data as $rows){	
	/*
	$a = ($rows->balance_base + $rows->db_base) - $rows->cr_base;		
	$tot1 = $tot1 + $rows->balance_base;	
	$tot2 = $tot2 + $rows->db_base;	
	$tot3 = $tot3 + $rows->cr_base;	
	$tot4 = $tot4 + $a;	
		*/
		
		/*
		if($noo == $max){ 
			$pdf->AddPage();
			//				
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#HEADER CONTENT
				$pt			= "GRAHA MULTI INSANI";
				$judul 		= "Report Neraca";
				$periode	= "Periode";
	
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#TANGGAL CETAK
				$pdf->SetFont('Arial','',7);
				$pdf->SetXY(258,10);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							
				$pdf->SetXY(268,10);
				$pdf->Cell(2,4,':',4,0,'L');
								
				$pdf->SetXY(269,10);
				$pdf->Cell(10,4,$tgl,0,0,'L');
			
			#$month1 = date( 'F', mktime(0, 0, 0, $periode1));		
			#$month2 = date( 'F', mktime(0, 0, 0, $periode2));		
					
			#Header
				$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'As Of'.' : '. ' s/d ',20,0,'L');
				$pdf->Ln(10);
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(1);
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(3);
			
			
			$pdf->SetX(2);
			$pdf->SetFont('Arial','B',8);
		*/
		#1
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(60,5,'ASSETS ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Cell(20,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(60,5,'LIABILITIES and EQUITIES',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
		#2
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'CURRENT ASSETS ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'LIABILITIES',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
		#3	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(54,5,'Cash and Bank ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Current Liabilities',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
		#4	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Cash on Hand & Bank ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai1),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Account Payables',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
		#5	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Cash ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai2),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Account Payable',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai21),10,0,'R');
			$pdf->Ln(3);
		#6	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Bank ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai3),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'AP Trade',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai22),10,0,'R');
			$pdf->Ln(3);
			
		#7	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Bank Tabungan Negara ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai4),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Account Payable Afiliasi ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai23),10,0,'R');
			
			
			$pdf->Ln(3);
			
			#buat garis		
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Ln(1);
			
		#8	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Bank Bukopin ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai5),10,0,'R');			
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Total Account Payables',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(30,5,number_format($data->ap),10,0,'R');
			$pdf->Ln(3);

			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Ln(1);
			#End Garis
			
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Retricted Fund ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai30),10,0,'R');			
			// $pdf->Cell(22,5,'',10,0,'C');
			// $pdf->SetFont('Arial','B',7);
			// $pdf->Cell(58,5,'Total Account Payables',10,0,'L');
			// $pdf->SetFont('Arial','B',7);
			// $pdf->Cell(30,5,number_format($data->ap),10,0,'R');
			$pdf->Ln(3);
			
		#9	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Time Deposito ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai6),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Other Current Liabilities',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'R');
			$pdf->Ln(1);
		
#buat garis		
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Ln(1);
		
		
		#10	
		
			//$total_cash_bank = number_format($data->nilai2);//+number_format($data->nilai2)+number_format($data->nilai3)+number_format($data->nilai4)+number_format($data->nilai5)+number_format($data->nilai6);
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Total Cash and Bank ',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(30,5,number_format($data->totalbank),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Accrued Expenses',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai24),10,0,'R');
			$pdf->Ln(3);
			
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Ln(1);
			
		#11	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Account Receivable ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Accued Tax',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai25),10,0,'R');
			$pdf->Ln(3);
			
		#12	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Account Receivable ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai7),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'PPh FINAL',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai26),10,0,'R');
			$pdf->Ln(3);
			
		#13	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Account Receivable Affiliasi',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai8),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Customer Deposit',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai27),10,0,'R');
			$pdf->Ln(3);
			
		#14	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Account Receivable Other',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai9),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Deposit Unit Apartement',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai28),10,0,'R');
			$pdf->Ln(3);
			
			#buat garis		
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Ln(1);
			
		#15	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Total Account Receivable ',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(30,5,number_format($data->totalAR),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Total Other Current Liabilities',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(30,5,number_format($data->currentliabilities),10,0,'R');
			$pdf->Ln(3);

			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Ln(1);
			
#End Garis

			#buat garis		
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Ln(1);
			
		#16	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Inventory ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Total Current Liabilities',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(30,5,number_format($data->totcurrentliabilities),10,0,'R');
			$pdf->Ln(3);
			
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Ln(1);
			
#End Garis
			
		#17	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Inventory ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai10),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Long Term Liabilities',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'R');
			$pdf->Ln(3);
			
			
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Ln(1);
			
		#18	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Inventory CIP ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai11),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Total Long Term Liabilities',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(30,5,'0',10,0,'R');
			$pdf->Ln(3);
			
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Ln(1);
			
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Ln(1);
			
		#19	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Land ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai12),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Total LIABILITIES',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->totcurrentliabilities),10,0,'R');
			$pdf->Ln(3);
			
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Ln(1);
			
		#20	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Contraction In ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai13),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'EQUITIES',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'R');
			$pdf->Ln(3);
			
#buat garis		
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Ln(1);
			
		#21	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Total Inventory ',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(30,5,number_format($data->totalinventory),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Equity',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai29),10,0,'R');
			$pdf->Ln(3);
			
		$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Ln(1);
#End Garis
			
		#22	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Other Current Assets ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Current Earning of The Year',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->RE),10,0,'R');
			$pdf->Ln(3);
			
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Ln(1);
			
		#23	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Prepaid Tax & Expenses ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai14),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Total EQUITIES',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(30,5,number_format($data->totequity),10,0,'R');
			$pdf->Ln(3);
			
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Ln(1);
			
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Ln(1);
			
		#24	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Prepaid Tax ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai15),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Total LIABILITIES and EQUITIES',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(30,5,number_format($data->totliabilities),10,0,'R');
			$pdf->Ln(3);
			
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Ln(1);
			
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Prepaid Expenses',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai31),10,0,'R');
			// $pdf->Cell(22,5,'',10,0,'C');
			// $pdf->SetFont('Arial','B',7);
			// $pdf->Cell(58,5,'Total LIABILITIES and EQUITIES',10,0,'L');
			// $pdf->SetFont('Arial','B',7);
			// $pdf->Cell(30,5,number_format($data->totliabilities),10,0,'R');
			$pdf->Ln(3);
			
			
		#25	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Temporary Advance ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai16),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
			#buat garis		
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Ln(1);
			
		#26	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Total Other Current Assets ',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(30,5,number_format($data->currentasset),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Ln(1);
			
			#End Garis
			
			#buat garis		
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Ln(1);
			
		#27	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Total CURRENT ASSETS ',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(30,5,number_format($data->totcurrentasset),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Ln(1);
			
			#End Garis
			
		#28	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'FIXED ASSETS ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
		#29	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Historical Value ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
		#30	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Fixed Asset ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai17),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
		#6	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Aset Takberujud ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai18),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
			#buat garis		
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Ln(1);
			
		#6	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Total Historical Value ',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(30,5,number_format($data->fixedasset),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Ln(1);
			
			#End Garis
			
		#6	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Accumulated Depreciation ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
		#6	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Akumulasi Depresiasi Fixed Asset ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai19),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
		#6	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Amortization Aset Takberujud  ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->nilai20),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
		#6	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Total Accumulated Depreciation ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,number_format($data->depresiasi),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
			#buat garis		
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Ln(1);
			
		#6	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Total FIXED ASSETS ',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(30,5,number_format($data->totfixedasset),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Ln(1);
			
			#End Garis
			
		#6	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'OTHER ASSETS ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
			
			#buat garis		
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Ln(1);
		#6	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Total OTHER ASSETS ',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(30,5,'0',10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Ln(1);
			
			#End Garis
			
			#buat garis		
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Ln(1);
			
		#6	
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'Total ASSETS ',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(30,5,number_format($data->totasset),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,5,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->Ln(3);
			$pdf->Cell(2,0,'',10,0,'L');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',10,0,'C');
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(58,0,' ',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(30,0,'',10,0,'R');
			$pdf->Ln(1);
			
			#End Garis
			
			
			$pdf->Ln(10);
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(1);
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(3);
			
			
			
			
			
			
				//$pdf->Cell(0,0,'',1,0,'L');
			
/*
			$noo = 0;
	
			
		}
	$a = ($rows->balance_base + $rows->db_base) - $rows->cr_base; 
	
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(60,5,$rows->acc_name,10,0,'L');
			$pdf->Cell(30,5,$rows->balance_base,10,0,'R');
			$pdf->Cell(20,5,'',10,0,'C');
			
			
			//row Liabilitis 
			foreach($cek as $row){
				
			$pdf->Cell(60,5,$row->acc_name,10,0,'L');
			$pdf->Cell(30,5,$row->balance_base,10,0,'R');
			
			$i++;
			$no++;
			$noo++;
		
		}
			$pdf->Ln(5);		
			$i++;
			$no++;
			$noo++;
		
	}
	* */
			$pdf->SetFont('Arial','B',7);
	  	/*
			//$pdf->Cell(30,5,'',1,0,'L',1);
			$pdf->Cell(92,5,'Subtotal',1,0,'R',1);
			$pdf->Cell(31,5,number_format($tot1),1,0,'R',1);
			$pdf->Cell(25,5,number_format($tot2),1,0,'R',1);
			$pdf->Cell(25,5,number_format($tot3),1,0,'R',1);
			$pdf->Cell(31,5,number_format($tot4),1,0,'R',1);
			* 
			* */
			$pdf->Output("hasil.pdf","I");	;
	
