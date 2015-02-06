<?php
			//$data = $this->db->query("neraca")->row();
			
			
			
			
			require('fpdf/tanpapage.php');
			extract(PopulateForm());
			$pdf=new PDF('L','mm','A4');
			
			$data = $this->db->query("neraca '".inggris_date($tgl)."'")->row();
			$tgl = explode("-","$tgl");
			$thn = $tgl[2] - 1;
			$cek = 12;
			//die($cek);
			$tglini = $thn.$cek;
			//die($tglini);
			$initgl = $tgl[2].$tgl[1];
			// $tgl2 = date('d-m-Y');
			// $tglx = date('m',strtotime($tgl2));
			// $monthName = date("F", mktime(0, 0, 0, $tglx, 10));
			//die($monthName);
			
			
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEADER CONTENT
				$pt			= "PT BAKRIE SWSAKTI UTAMA";
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
				//$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'As Of'.' : '. indo_date($data->tgl),20,0,'L');
				$pdf->Ln(10);
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(1);
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(1);
			
			// Start Isi Tabel
			
	
			
			$pdf->SetFont('Arial','B',9);
			
			$pdf->Cell(70,0,'',10,0,'C');
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',1,0,'R');
			$pdf->Cell(18,0,'',10,0,'C');
			$pdf->Cell(50,0,'',10,0,'C');
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',1,0,'R');
			$pdf->Ln(1);
			
			$pdf->Cell(70,0,'',10,0,'C');
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',1,0,'R');
			$pdf->Cell(18,0,'',10,0,'C');
			$pdf->Cell(50,0,'',10,0,'C');
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',1,0,'R');
			$pdf->Ln(1);
			
			$pdf->Cell(70,5,'',10,0,'C');
			$pdf->Cell(30,5,'Current Year',10,0,'R');
			$pdf->Cell(22,5,'Last Year',10,0,'R');
			$pdf->Cell(18,5,'',10,0,'C');
			$pdf->Cell(50,5,'',10,0,'C');
			$pdf->Cell(30,5,'Current Year',10,0,'R');
			$pdf->Cell(22,5,'Last Year',10,0,'R');
			$pdf->Ln(5);
			
			$pdf->Cell(70,0,'',10,0,'C');
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',1,0,'R');
			$pdf->Cell(18,0,'',10,0,'C');
			$pdf->Cell(50,0,'',10,0,'C');
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',1,0,'R');
			
		
			
		//query liabilities
			$sql = "select * from db_trlbal a
				left join db_coa b on b.acc_no = a.acc_no
				where b.group_acc = 'L'";


			$cek  = $this->db->query($sql)->result();
			
			
		
			$pdf->SetFont('Arial','',9-1);
			
			$i = 1;	
			$no = 1;
			$noo = 0;
			$max = 40;	
			$pdf->Ln(4-1);
		$pdf->SetMargins(10,10,2);	
	//$pdf->SetXY(15,15);		

		#1
		$pdf->SetX(8);
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(60,5,'ASSETS ',10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Cell(20,5,'',10,0,'C');
			$pdf->Ln(5);
		#2
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(58,5,'Current Assets ',10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->Ln(5);
		#3	
			//~ $pdf->Cell(4,5,'',10,0,'L');
			//~ $pdf->SetFont('Arial','B',9);
			//~ $pdf->Cell(54,5,'Cash and Bank ',10,0,'L');
			//~ $pdf->SetFont('Arial','',9-1);
			//~ $pdf->Cell(30,5,'',10,0,'R');
			//~ $pdf->Cell(22,5,'',10,0,'C');
			//~ $pdf->Ln(4-1);
		#4	
		
		#query cash and bank
		$query = "select a.acc_no, left(a.acc_name,31) as acc_name, sum(((b.balance_base+b.db_base)-b.cr_base)) as ending,
				sum(((b.db_base)-b.cr_base)) as currentmonth,
				(select ISNULL(((balance_base+db_base)-cr_base),0) from db_trlbal c
				where acc_period=$tglini
				and c.acc_no=a.acc_no) as last_year
				from db_coa a
				inner join db_trlbal b on a.acc_no=b.acc_no
				where left(a.acc_no,1)='1' and account_neraca='1.01.01' and acc_period = $initgl
				group by  a.acc_no, a.acc_name";
		$quer = $this->db->query($query)->result();
			$i = 1;
			$totcb = 0;
			$totcbly = 0;
			$gun = 0;
			$gun5= 0;
		
		$pdf->SetX(10);
			foreach ($quer as $row) {
			$totcb = $totcb + $row->ending;
			$totcbly = $totcbly + $row->last_year;
			$pdf->Cell(4,5,'',10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(56,5,$row->acc_name,10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,5,number_format($row->ending),10,0,'R');
			$pdf->Cell(22,5,number_format($row->last_year),10,0,'R');
			$i++;
		
		$pdf->Ln(5);
		$pdf->SetX(10);
			}
			
			
			$pdf->Cell(4,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(56,5,'Subtotal',10,0,'L');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(30,5,number_format($totcb),10,0,'R');
			$pdf->Cell(22,5,number_format($totcbly),10,0,'R');
		$pdf->Ln(5);
			#$pdf->Ln(4-1);
		
		#5	
		
		#11	
		$pdf->SetX(8);
		
			$pdf->Cell(4,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(58,5,'Account Receivable ',10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,5,'',10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
		
		$pdf->Ln(5);
			
		#query account receivab
		$r = "select a.acc_no, a.acc_name, sum(((b.balance_base+b.db_base)-b.cr_base)) as ending,
			sum(((b.db_base)-b.cr_base)) as currentmonth,
			(select ISNULL(((balance_base+db_base)-cr_base),0) from db_trlbal c
			where acc_period=$tglini
			and c.acc_no=a.acc_no) as last_year
			from db_coa a
			inner join db_trlbal b on a.acc_no=b.acc_no
			where left(a.acc_no,1)='1' and account_parent='1.01.03' and acc_period = $initgl
			group by  a.acc_no, a.acc_name";
			$q = $this->db->query($r)->result();
			$totar = 0;
			$totarly = 0;
			$j = 1;
		
		$pdf->SetX(8);
		#for ($j=1;$j<=3;$j++){
		foreach ($q as $rows){
			$totar = $totar + $rows->ending;
			$totarly = $totarly + $rows->last_year; 
			$pdf->Cell(6,5,'',10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(56,5,$rows->acc_name,10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,5,number_format($rows->ending),10,0,'R');
			$pdf->Cell(22,5,number_format($rows->last_year),10,0,'R');
		
		$pdf->Ln(5);
		$pdf->SetX(8);
			$j++;
		}
		
		
			$pdf->Cell(6,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(56,5,'Subtotal',10,0,'L');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(30,5,number_format($totar),10,0,'R');
			$pdf->Cell(22,5,number_format($totarly),10,0,'R');
			$pdf->Ln(5);
			#$pdf->Ln(4-1);
		
		$pdf->SetX(8);
		
			
		#13	
		
		#16	
			$pdf->Cell(4,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(58,5,'Inventory ',10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,5,'',10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
			$pdf->Ln(4);
			
			
			
			$k=1;
			#query inventory CP
			$c = "select a.acc_no, a.acc_name, sum(((b.balance_base+b.db_base)-b.cr_base)) as ending,
			sum(((b.db_base)-b.cr_base)) as currentmonth,
				(select ISNULL(((balance_base+db_base)-cr_base),0)  from db_trlbal c
				where acc_period=$tglini
				and c.acc_no=a.acc_no) as last_year
				from db_coa a
				inner join db_trlbal b on a.acc_no=b.acc_no
				where left(a.acc_no,1)='1' and account_parent in ('1.01.04.07','1.01.04') and (b.balance_base+b.db_base)-b.cr_base <>0 and acc_period = $initgl
				group by  a.acc_no, a.acc_name";
			$x = $this->db->query($c)->result();
			$totic = 0;
			$toticly = 0;
		$pdf->SetX(6);
			#for ($k=1;$k<=3;$k++){
			foreach ($x as $roow){
				$totic = $totic + $roow->ending;
				$toticly = $toticly + $roow->last_year;
				$pdf->Cell(8,5,'',10,0,'L');
				$pdf->SetFont('Arial','',9-1);
				$pdf->Cell(56,5,$roow->acc_name,10,0,'L');
				$pdf->SetFont('Arial','',9-1);
				$pdf->Cell(30,5,number_format($roow->ending),10,0,'R');
				$pdf->Cell(22,5,number_format($roow->last_year),10,0,'R');
			$pdf->Ln(5);
			$pdf->SetX(6);
			
				$k++;
			}
		
			$pdf->Cell(8,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(56,5,'Subtotal',10,0,'L');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(30,5,number_format($totic),10,0,'R');
			$pdf->Cell(22,5,number_format($toticly),10,0,'R');
			$pdf->Ln(5);
			#$pdf->Ln(4-1);
			
	#prepaid Tax & expensess
		$pdf->SetX(8);
			$pdf->Cell(4,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(58,5,'Prepaid Tax & Expenses',10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,5,'',10,0,'R');
			$pdf->Cell(22,5,'',10,0,'C');
		
			$z = "select a.acc_no, a.acc_name, sum(((b.balance_base+b.db_base)-b.cr_base)) as ending,
			sum(((b.db_base)-b.cr_base)) as currentmonth,
				(select ISNULL(((balance_base+db_base)-cr_base),0) from db_trlbal c
				where acc_period=$tglini
				and c.acc_no=a.acc_no) as last_year
				from db_coa a
				inner join db_trlbal b on a.acc_no=b.acc_no
				where left(a.acc_no,1)='1' and account_parent='1.01.05' and acc_period = $initgl
				group by  a.acc_no, a.acc_name";
			$zx = $this->db->query($z)->result();
			$totte = 0;
			$tottely = 0;
			$k=1;
		$pdf->SetX(100);		
		$pdf->Ln(5);
		
			foreach ($zx as $roows){
			#for ($k=1;$k<=3;$k++){
			$totte = $totte + $roows->ending;
			$tottely = $tottely + $roows->last_year;
				$pdf->Cell(6,5,'',10,0,'L');
				$pdf->SetFont('Arial','',9-1);
				$pdf->Cell(54,5,$roows->acc_name,10,0,'L');
				$pdf->SetFont('Arial','',9-1);
				$pdf->Cell(30,5,number_format($roows->ending),10,0,'R');
				$pdf->Cell(22,5,number_format($roows->last_year),10,0,'R');
		
		$pdf->SetX(100);		
		$pdf->Ln(5);
				$k++;
			}
			
			$pdf->Cell(6,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(54,5,'Subtotal',10,0,'L');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(30,5,number_format($totte),10,0,'R');
			$pdf->Cell(22,5,number_format($tottely),10,0,'R');
		$pdf->SetX(100);		
		$pdf->Ln(5);
			#$pdf->Ln(4-1);
	
			$yu = "select a.acc_no, a.acc_name, sum(((b.balance_base+b.db_base)-b.cr_base)) as ending,
			sum(((b.db_base)-b.cr_base)) as currentmonth,
				(select ISNULL(((balance_base+db_base)-cr_base),0) from db_trlbal c
				where acc_period=$tglini
				and c.acc_no=a.acc_no) as last_year
				from db_coa a
				inner join db_trlbal b on a.acc_no=b.acc_no
				where left(a.acc_no,1)='1' and a.acc_no='1.01.06' and acc_period = $initgl
				group by  a.acc_no, a.acc_name";
			$tem = $this->db->query($yu)->row();
			
			#foreach ($tem as $a){
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(58,5,$tem->acc_name,10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,5,number_format($tem->ending),10,0,'R');
			$pdf->Cell(22,5,number_format($tem->last_year),10,0,'R');
			$pdf->Ln(5);
			
			#}
			
			$in = "select a.acc_no, a.acc_name, sum(((b.balance_base+b.db_base)-b.cr_base)) as ending,
			sum(((b.db_base)-b.cr_base)) as currentmonth,
				(select ISNULL(((balance_base+db_base)-cr_base),0) from db_trlbal c
				where acc_period=$tglini
				and c.acc_no=a.acc_no) as last_year
				from db_coa a
				inner join db_trlbal b on a.acc_no=b.acc_no
				where left(a.acc_no,1)='1' and a.acc_no='1.01.07' and acc_period = $initgl
				group by  a.acc_no, a.acc_name";
			$inv = $this->db->query($in)->row();
			
		#	foreach ($inv as $b){
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(58,5,$inv->acc_name,10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,5,number_format($inv->ending),10,0,'R');
			$pdf->Cell(22,5,number_format($inv->last_year),10,0,'R');
			$pdf->Ln(5);
		#}
		
			#query Fixed Asset
			$faZ = "select a.acc_no, a.acc_name, sum(((b.balance_base+b.db_base)-b.cr_base)) as ending,
			sum(((b.db_base)-b.cr_base)) as currentmonth,
				(select ISNULL(((balance_base+db_base)-cr_base),0)  from db_trlbal c
				where acc_period=$tglini
				and c.acc_no=a.acc_no)as last_year
				from db_coa a
				inner join db_trlbal b on a.acc_no=b.acc_no
				where left(a.acc_no,1)='1' and a.acc_no='1.01.08' and acc_period = $initgl
				group by  a.acc_no, a.acc_name";
			$fa = $this->db->query($faZ)->row();
				
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(58,5,$fa->acc_name,10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,5,number_format($fa->ending),10,0,'R');
			$pdf->Cell(22,5,number_format($fa->last_year),10,0,'R');
			$pdf->Ln(5);
	
			$adfaa = "select a.acc_no, a.acc_name, sum(((b.balance_base+b.db_base)-b.cr_base)) as ending,
			sum(((b.db_base)-b.cr_base)) as currentmonth,
					(select ISNULL(((balance_base+db_base)-cr_base),0) from db_trlbal c
					where acc_period=$tglini
					and c.acc_no=a.acc_no) as last_year
					from db_coa a
					inner join db_trlbal b on a.acc_no=b.acc_no
					where left(a.acc_no,1)='1' and a.acc_no='1.01.09' and acc_period = $initgl
					group by  a.acc_no, a.acc_name";
			$adfa = $this->db->query($adfaa)->row();
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(58,5,$adfa->acc_name,10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,5,number_format($adfa->ending),10,0,'R');
			$pdf->Cell(22,5,number_format($adfa->last_year),10,0,'R');
			$pdf->Ln(5);
	
			$qu = "select a.acc_no, a.acc_name, sum(((b.balance_base+b.db_base)-b.cr_base)) as ending,
			sum(((b.db_base)-b.cr_base)) as currentmonth,
				(select ISNULL(((balance_base+db_base)-cr_base),0) from db_trlbal c
				where acc_period=$tglini
				and c.acc_no=a.acc_no) as last_year
				from db_coa a
				inner join db_trlbal b on a.acc_no=b.acc_no
				where left(a.acc_no,1)='1' and a.acc_no='1.01.10' and acc_period = $initgl
				group by  a.acc_no, a.acc_name";
			$atb = $this->db->query($qu)->row();
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(58,5,$atb->acc_name,10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,5,number_format($atb->ending),10,0,'R');
			$pdf->Cell(22,5,number_format($atb->last_year),10,0,'R');
			$pdf->Ln(5);
	
			$gu = "select a.acc_no, a.acc_name, sum(((b.balance_base+b.db_base)-b.cr_base)) as ending,
			sum(((b.db_base)-b.cr_base)) as currentmonth,
				(select ISNULL(((balance_base+db_base)-cr_base),0) from db_trlbal c
				where acc_period='201112'
				and c.acc_no=a.acc_no) as last_year
				from db_coa a
				inner join db_trlbal b on a.acc_no=b.acc_no
				where left(a.acc_no,1)='1' and a.acc_no='1.01.11' and acc_period = $initgl
				group by  a.acc_no, a.acc_name";
			$aatb = $this->db->query($gu)->row();
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(58,5,$aatb->acc_name,10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,5,number_format($aatb->ending),10,0,'R');
			$pdf->Cell(22,5,number_format($aatb->last_year),10,0,'R');
			$pdf->Ln(6);
			#$pdf->Ln(4-1);
			
			$tut = "";
			
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			#$pdf->Cell(58,5,'CIP-Fixed Asset',10,0,'L');
			$pdf->Cell(58,5,'',10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			#$pdf->Cell(30,5,number_format(0),10,0,'R');
			$pdf->Cell(30,5,'',10,0,'R');
			#$pdf->Cell(22,5,number_format(0),10,0,'R');
			$pdf->Cell(22,5,'',10,0,'R');
			$pdf->Ln(8);
			#$pdf->Ln(4-1);
			
			
			
			
	
	//$pdf->SetRightMargin(60);		
		$pdf->SetXY(130,45);
			#1
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(60,5,'LIABILITIES ',10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Cell(20,5,'',10,0,'C');
		//	$pdf->Ln(5);
		#2
		//~ $pdf->SetXY(130,50+12);
			//~ $pdf->Cell(2,5,'',10,0,'L');
			//~ $pdf->SetFont('Arial','B',9);
			//~ $pdf->Cell(58,5,'Current Payable ',10,0,'L');
			//~ $pdf->SetFont('Arial','',9-1);
			//~ $pdf->Cell(30,5,'',10,0,'L');
			//~ $pdf->Cell(22,5,'',10,0,'C');
			//$pdf->Ln(5);
		#3
		$pdf->SetXY(130,50);
		
			$pdf->Cell(4,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(58,5,'Current Payable ',10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Cell(22,5,'',10,0,'C');
		$pdf->Ln(5);
		
		$pdf->SetX(130);
		
			#$setY = 48;
			$l = 1;
			$v = "select a.acc_no, a.acc_name, sum(((b.balance_base+b.db_base)-b.cr_base)*-1) as ending,
			sum(((b.db_base)-b.cr_base)) as currentmonth,
					(select ISNULL(((balance_base+db_base)-cr_base)*-1,0) from db_trlbal c
					where acc_period=$tglini
					and c.acc_no=a.acc_no) as last_year
					from db_coa a
					inner join db_trlbal b on a.acc_no=b.acc_no
					where left(a.acc_no,1)='2' and account_parent='2.01.01' and acc_period = $initgl
					group by  a.acc_no, a.acc_name ";
			$cp = $this->db->query($v)->result();
			$totcp = 0;
			$totcply = 0;
			
			#$setY = 0;
		#for ($l=1;$l<=3;$l++){
		foreach ($cp as $cpt){
			$totcp = $totcp + $cpt->ending;	
			$totcply = $totcply - $cpt->last_year;	
			$totcply2 = $totcply*-1;	
			
			$pdf->Cell(6,5,'',10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(54,5,$cpt->acc_name,10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,5,number_format($cpt->ending),10,0,'R');
			$pdf->Cell(22,5,number_format($cpt->last_year),10,0,'R');
			$pdf->Ln(5);
			//~ $setY = $setY + 3;
			$pdf->SetX(130);
			$j++;
		}
			
			
		$pdf->SetX(130);
			$pdf->Cell(6,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(54,5,'Subtotal',10,0,'L');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(30,5,number_format($totcp),10,0,'R');
			$pdf->Cell(22,5,number_format($totcply2),10,0,'R');
			#$pdf->Ln(5);
		$pdf->Ln(5);
		$pdf->SetX(128);
			
			$aex = "select a.acc_no, a.acc_name, sum(((b.balance_base+b.db_base)-b.cr_base)*-1) as ending,
			sum(((b.db_base)-b.cr_base)) as currentmonth,
					(select ISNULL(((balance_base+db_base)-cr_base)*-1,0) from db_trlbal c
					where acc_period=$tglini
					and c.acc_no=a.acc_no) as last_year
					from db_coa a
					inner join db_trlbal b on a.acc_no=b.acc_no
					where left(a.acc_no,1)='2' and a.acc_no='2.01.03' and acc_period = $initgl
					group by  a.acc_no, a.acc_name 
					";
			$ae = $this->db->query($aex)->row();
			$pdf->Cell(6,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(56,5,$ae->acc_name,10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(30,5,number_format($ae->ending),10,0,'R');
			$pdf->Cell(22,5,number_format($ae->last_year),10,0,'R');
		
		$pdf->Ln(5);
		$pdf->SetX(128);
			
			$rt = "select a.acc_no, a.acc_name, sum(((b.balance_base+b.db_base)-b.cr_base)*-1) as ending,
			sum(((b.db_base)-b.cr_base)) as currentmonth,
					(select ISNULL(((balance_base+db_base)-cr_base)*-1,0) from db_trlbal c
					where acc_period=$tglini
					and c.acc_no=a.acc_no) as last_year
					from db_coa a
					inner join db_trlbal b on a.acc_no=b.acc_no
					where left(a.acc_no,1)='2' and a.acc_no='2.01.04' and acc_period = $initgl
					group by  a.acc_no, a.acc_name ";
			$at = $this->db->query($rt)->row();
			
			$pdf->Cell(6,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(56,5,$at->acc_name,10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(30,5,number_format($at->ending),10,0,'R');
			$pdf->Cell(22,5,number_format($at->last_year),10,0,'R');
		
		$pdf->Ln(5);
		$pdf->SetX(128);
			
			#query current position of long term load
			$cpoo = "select a.acc_no, a.acc_name, sum(((b.balance_base+b.db_base)-b.cr_base)*-1) as ending,
			sum(((b.db_base)-b.cr_base)) as currentmonth,
					(select ISNULL(((balance_base+db_base)-cr_base)*-1,0) from db_trlbal c
					where acc_period=$tglini
					and c.acc_no=a.acc_no) as last_year
					from db_coa a
					inner join db_trlbal b on a.acc_no=b.acc_no
					where left(a.acc_no,1)='2' and a.acc_no='2.01.05' and acc_period = $initgl
					group by  a.acc_no, a.acc_name ";
			$cpo = $this->db->query($cpoo)->row();
								
			$pdf->Cell(6,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(56,5,$cpo->acc_name,10,0,'L');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(30,5,number_format($cpo->ending),10,0,'R');
			$pdf->Cell(22,5,number_format($cpo->last_year),10,0,'R');
			
		$pdf->Ln(5);
		$pdf->SetX(134);
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(57,5,'Customer Deposit',10,0,'L');
			
			#query Customer Deposit
			$cusp = "select a.acc_no, a.acc_name, sum(((b.balance_base+b.db_base)-b.cr_base)*-1) as ending,
			sum(((b.db_base)-b.cr_base)) as currentmonth,
					(select ISNULL(((balance_base+db_base)-cr_base)*-1,0) from db_trlbal c
					where acc_period=$tglini
					and c.acc_no=a.acc_no) as last_year
					from db_coa a
					inner join db_trlbal b on a.acc_no=b.acc_no
					where left(a.acc_no,1)='2' and account_parent='2.02' and acc_period = $initgl
					group by  a.acc_no, a.acc_name ";
			$cdp = $this->db->query($cusp)->result();
			
			
			//~ $pdf->Cell(2,5,'',10,0,'L');
		
		
			
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Cell(22,5,'',10,0,'C');
			
		$pdf->Ln(5);	
		$pdf->SetX(132);
			
			$totcdp = 0;
			$totcdply = 0;
			
			
			$l = 1;
			
		#for ($l=1;$l<=3;$l++){
		foreach ($cdp as $cdpp){
		
			$totcdp = $totcdp + $cdpp->ending;
			$totcdply = ($totcdply - $cdpp->last_year);
			$totcdply2 = $totcdply *-1;
			
			$pdf->Cell(4,5,'',10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(54,5,$cdpp->acc_name,10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,5,number_format($cdpp->ending),10,0,'R');
			$pdf->Cell(22,5,number_format($cdpp->last_year),10,0,'R');
			
		$pdf->Ln(5);	
		$pdf->SetX(132);	
			
			$j++;
		}
		
		$pdf->SetX(132);
			$pdf->Cell(4,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(54,5,'Subtotal',10,0,'L');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(30,5,number_format($totcdp),10,0,'R');
			$pdf->Cell(22,5,number_format($totcdply2),10,0,'R');
		
		$pdf->Ln(5);	
		$pdf->SetX(130);

			#query differed iNDOCME
			$hj = "select a.acc_no, a.acc_name, sum(((b.balance_base+b.db_base)-b.cr_base)*-1) as ending,
			sum(((b.db_base)-b.cr_base)) as currentmonth,
				(select ISNULL(((balance_base+db_base)-cr_base),0) from db_trlbal c
				where acc_period=$tglini
				and c.acc_no=a.acc_no) as last_year
				from db_coa a
				inner join db_trlbal b on a.acc_no=b.acc_no
				where left(a.acc_no,1)='2' and a.acc_no='2.03' and acc_period = $initgl
				group by  a.acc_no, a.acc_name ";
			$di = $this->db->query($hj)->row();
			$pdf->Cell(4,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(56,5,$di->acc_name,10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(30,5,number_format($di->ending),10,0,'R');
			$pdf->Cell(22,5,number_format($di->last_year),10,0,'R');
		
		$pdf->Ln(5);
		$pdf->SetX(134);
			
			#query Account Payable
			$jkl = "select a.acc_no, a.acc_name, sum(((b.balance_base+b.db_base)-b.cr_base)*-1) as ending,
			sum(((b.db_base)-b.cr_base)) as currentmonth,
					(select ISNULL(((balance_base+db_base)-cr_base),0) from db_trlbal c
					where acc_period=$tglini
					and c.acc_no=a.acc_no) as last_year
					from db_coa a
					inner join db_trlbal b on a.acc_no=b.acc_no
					where left(a.acc_no,1)='2' and a.acc_no='2.04' and acc_period = $initgl
					group by  a.acc_no, a.acc_name ";
			$ap = $this->db->query($jkl)->row();
			#$pdf->Cell(4,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(56,5,$ap->acc_name,10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(30,5,number_format($ap->ending),10,0,'R');
			$pdf->Cell(22,5,number_format($ap->last_year),10,0,'R');
			
		$pdf->Ln(5);
		$pdf->SetX(134);
			
			#query Equity
			$eqx = "select a.acc_no, a.acc_name, sum(((b.balance_base+b.db_base)-b.cr_base)*-1) as ending,
			sum(((b.db_base)-b.cr_base)) as currentmonth,
					(select ISNULL(((balance_base+db_base)-cr_base)*-1,0) from db_trlbal c
					where acc_period=$tglini
					and c.acc_no=a.acc_no) as last_year
					from db_coa a
					inner join db_trlbal b on a.acc_no=b.acc_no
					where left(a.acc_no,1)='3' and account_parent='3.00' and acc_period = $initgl
					group by  a.acc_no, a.acc_name 
					 ";
			
			
			#$pdf->Cell(2,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(56,5,'Equity',10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Cell(22,5,'',10,0,'C');
		
		$pdf->Ln(5);
		$pdf->SetX(130);
		
			$eqb = $this->db->query($eqx)->result();
			$toteq = 0;
			$toteqly = 0;
			
			
		$l = 1;
		$pdf->SetX(132);
		foreach ($eqb as $eq){
		#for ($l=1;$l<=3;$l++){
			$toteq = $toteq + $eq->ending;
			$toteqly = $toteqly - $eq->last_year;
			
			$pdf->Cell(4,5,'',10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(54,5,$eq->acc_name,10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,5,number_format($eq->ending),10,0,'R');
			$pdf->Cell(22,5,number_format($eq->last_year),10,0,'R');
			
		$pdf->Ln(5);
		$pdf->SetX(132);
			$j++;
		}
		
		
		$pdf->SetX(136);
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(54,5,'Subtotal',10,0,'L');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(30,5,number_format($toteq),10,0,'R');
			$pdf->Cell(22,5,number_format($toteqly),10,0,'R');$pdf->Ln(5);
			
		$pdf->Ln(3);	
		$pdf->SetX(132);
		
		
			#query retain
			$earning = "select balance_base as earning from db_trlbal 
			where acc_no='3.05'";
			
			
			$ear = $this->db->query($earning)->row();
			
			
			$ty = "select (sum(db_base)-sum(cr_base)) as ret1 from db_trlbal 
			where left(acc_no,1)=4 and acc_type=2 and acc_period<=$initgl";
			$re = $this->db->query($ty)->row();
			$tut = "select (sum(db_base)-sum(cr_base)) as ret2
			from db_trlbal where left(acc_no,1)>5 and acc_type=2 and acc_period<=$initgl";
			$re1 = $this->db->query($tut)->row();
			
			$ty2 = "select (sum(db_base)-sum(cr_base)) as ret3 from db_trlbal 
			where left(acc_no,1)=4 and acc_type=2 and acc_period<=$tglini";
			$re2 = $this->db->query($ty2)->row();
			$tut2 = "select (sum(db_base)-sum(cr_base)) as ret4
			from db_trlbal where left(acc_no,1)>5 and acc_type=2 and acc_period<=$tglini";
			$re3 = $this->db->query($tut2)->row();
			
			$current1= "select (sum(db_base)-sum(cr_base))*-1 as current1 from db_trlbal 
			where left(acc_no,1)>=4 and left(acc_no,1)<=5 and acc_type=2 and acc_period=$initgl";
			
			$current2 = $this->db->query($current1)->row();
			
			$current3 = "select (sum(db_base)-sum(cr_base)) as current3
			from db_trlbal where left(acc_no,1)>5 and acc_type=2 and acc_period=$initgl";
			$current4 = $this->db->query($current3)->row();
			
			$last_re = "select (sum(db_base)-sum(cr_base)) as last_re from db_trlbal 
			where left(acc_no,1)=4 and acc_type=2 and acc_period<$initgl and left(acc_period,4)='2013'";
			$last_re1 = $this->db->query($last_re)->row();
			$last_re2 = "select (sum(db_base)-sum(cr_base)) as last_re2
			from db_trlbal where left(acc_no,1)>5 and acc_type=2 and acc_period<$initgl and left(acc_period,4)='2013'";
			$last_re3 = $this->db->query($last_re2)->row();
			
			$sql2 = "select sum(balance_base +(db_base-cr_base)) as endbase, 
							(select sum(balance_base+(db_base-cr_base)) from db_trlbal 
							  where left(acc_no,1) > 5 and acc_type=2 and left(acc_no,1) <= 7 and acc_period=".$initgl." ) as totcost
								
							
						from db_trlbal 	where left(acc_no,1)>=4 and left(acc_no,1) <= 5 and acc_type=2 and acc_period=".$initgl."";
			
			$queri2 = $this->db->query($sql2)->row();
			$tottax = ($queri2->endbase*-1) - $queri2->totcost;
			
			$sql5 = "select sum(balance_base + (db_base-cr_base)) totaftertax 
												
					from db_trlbal where left(acc_no,1)>=8 and acc_type=2 
					
					and acc_period=".$initgl."";
			$queri5 = $this->db->query($sql5)->row();
			
			if ($initgl >= '201301') {
			//$rema2 = ($current2->current1 - $current4->current3)+($last_re1->last_re - $last_re3->last_re2);
			$rema2=$tottax - $queri5->totaftertax;
			$last_rema2 = ($last_re1->last_re - $last_re3->last_re2);
			}else{
			$rema2 = $ear->earning+($re->ret1 - $re1->ret2);
			$last_rema2 =0;
			}
			
			
			if ($initgl >= '201301') {
			$rema = $ear->earning+($re2->ret3 - $re3->ret4);
			
			}else{
			$rema = 0;
			}
			//$rema2 = $ear->earning+($re->ret1 - $re1->ret2);
			
			$nilaisementara = 14778753115;
			
//$rema2 = -5848477639.22;
			$rem = 0;
			
			#$pdf->Cell(2,5,'',10,0,'L');
		$pdf->SetX(134);
		
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(56,5,'Current Earning Of The Year',10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,5,number_format($rema2),10,0,'R');
			if ($initgl >= '201401') {
			$pdf->Cell(22,5,number_format($nilaisementara),10,0,'R');
			}else{
			$pdf->Cell(22,5,number_format($rema),10,0,'R');
			
			}
		
		$pdf->Ln(23);	
		$pdf->SetX(130);
				
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(60,0,'',10,0,'L');
			
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',1,0,'R');
		
		$pdf->Ln(1);	
		$pdf->SetX(130);
			
			$abs2 = 0;
			$gun2 = ($totcp)+($ae->ending)+($at->ending)+($cpo->ending)+($totcdp) +($ap->ending)+($di->ending)+($toteq)+ $rema2 ;
			//$gun2 = ($ap->ending) ;
			$abs2 = ((($totcply)-($ae->last_year)-($at->last_year)-($cpo->last_year)+($totcdply) +($toteqly)-$rema))*-1;
			
			$abs3 = 0;
			$abs3 = $abs3 + ($totcbly)+($totarly)+($toticly)+($tottely)+($tem->last_year)+(($fa->last_year)+($adfa->last_year));
			//$gun2 = 66010975942;
			//$gun2 = ($toteq);
			
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(60,5,'TOTAL LIABILITIES & EQUITY',10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			if ($initgl <= '201312') {
			$gun5= $gun5+ ($totcb)+($totar)+($totic)+($totte)+($tem->ending)+(($fa->ending)+($adfa->ending));
			$abs5 = 0;
			$abs5 = $abs5 + ($totcbly)+($totarly)+($toticly)+($tottely)+($tem->last_year)+(($fa->last_year)+($adfa->last_year));
			$pdf->Cell(30,5,number_format($gun5),10,0,'R');
			$pdf->Cell(22,5,number_format($abs5),10,0,'R');
			}else{
			
			$pdf->Cell(30,5,number_format($gun2),10,0,'R');
			if ($initgl >= '201401') {
			$pdf->Cell(22,5,number_format($abs3),10,0,'R');
			}else{
			$pdf->Cell(22,5,number_format($abs2),10,0,'R');
			}
			}
			
		$pdf->Ln(5);
		$pdf->SetX(130);
			
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(60,0,'',10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',1,0,'R');
		
		
		$pdf->Ln(1);
		$pdf->SetX(130);
		
			
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(60,0,'',10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',1,0,'R');
			#$pdf->Ln(5);
			
			$pdf->SetXY(10,181);
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(60,0,'',10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',1,0,'R');
			$pdf->Ln(1);

			$abs = 0;
			$abs = $abs + ($totcbly)+($totarly)+($toticly)+($tottely)+($tem->last_year)+(($fa->last_year)+($adfa->last_year));
			$gun= $gun+ ($totcb)+($totar)+($totic)+($totte)+($tem->ending)+(($fa->ending)+($adfa->ending));
			
			
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(60,5,'TOTAL ASSETS',10,0,'L');
			$pdf->SetFont('Arial','',9-1);

			$pdf->Cell(30,5,number_format($gun),10,0,'R');
			$pdf->Cell(22,5,number_format($abs),10,0,'R');

			$pdf->Ln(5);
	
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(60,0,'',10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',1,0,'R');
			$pdf->Ln(1);
			
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(60,0,'',10,0,'L');
			$pdf->SetFont('Arial','',9-1);
			$pdf->Cell(30,0,'',1,0,'R');
			$pdf->Cell(22,0,'',1,0,'R');
			$pdf->Ln(4-1);
			
		
			$pdf->Output("BalanceSheet.pdf","I");
	
