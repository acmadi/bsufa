<?php
	
		$session_id = $this->UserLogin->isLogin();
		$sql = "select id_pt,nm_pt,id_project,nm_subproject from view_daily where id_pt = ".$session_id['id_pt']." ";
		$cekdata = $this->db->query($sql)->row();

			require('fpdf/tanpapage.php');
			extract(PopulateForm());
			$pdf=new PDF('P','mm','A4');
			
			$pdf->SetMargins(10,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(120,255,255);
			
			#HEAD

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
			
			#Header
				$pdf->SetFont('Arial','B',12);
	
				$pdf->SetX(60);
				$pdf->Cell(0,10,'PT. BAKRIE SWASAKTI UTAMA And Subsidiary',20,0,'L');
			
				$pdf->SetFont('Arial','B',11);
				
				$pdf->SetXY(75,16);
				$pdf->Cell(0,10,'Daily Cash & Bank Position Report',20,0,'L');

				$pdf->SetFont('Arial','B',11);

				$pdf->SetXY(88,22);
				$pdf->Cell(0,10,'As Of '.$tgl,20,0,'L');
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
								
			$pdf->Ln(10);
			// Start Isi Tabel

			$pdf->SetFont('Arial','',7);

			//table header
			$pdf->Cell(8,5,'','L'.'T'.'R',0,'C',0);
			$pdf->Cell(15,5,'','L'.'T'.'R',0,'C',0);
			$pdf->Cell(40,5,'','L'.'T'.'R',0,'C',0);
			$pdf->Cell(20,5,'','L'.'T'.'R',0,'C',0);
			$pdf->Cell(23,5,'','L'.'T'.'R',0,'C',0);
			$pdf->Cell(46,5,'Mutasi',1,0,'C',0);
			$pdf->Cell(23,5,'','L'.'T'.'R',0,'C',0);
			$pdf->Cell(20,5,'','L'.'T'.'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(8,5,'No','L'.'B'.'R',0,'C',0);
			$pdf->Cell(15,5,'Date','L'.'B'.'R',0,'C',0);
			$pdf->Cell(40,5,'Kind Of Bank Account','L'.'B'.'R',0,'C',0);
			$pdf->Cell(20,5,'Account Number','L'.'B'.'R',0,'C',0);
			$pdf->Cell(23,5,'Beginning Balance','L'.'B'.'R',0,'C',0);
			$pdf->Cell(23,5,'Debet','L'.'B'.'R',0,'C',0);
			$pdf->Cell(23,5,'Credit','L'.'B'.'R',0,'C',0);
			$pdf->Cell(23,5,'Ending Balance','L'.'B'.'R',0,'C',0);
			$pdf->Cell(20,5,'Remarks','L'.'B'.'R',0,'C',0);
			$pdf->Ln(5);
			//end table header

			//data from database
			$no = 1;
			$a = 0;$b = 0;$c = 0;$d = 0;
			$w = 0;$x = 0;$y = 0;$z = 0;

			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(63,5,'PT. '.$cekdata->nm_pt,'1',0,'L',0);
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(20,5,'','L'.'R',0,'C',0);
			$pdf->Cell(23,5,'','L'.'R',0,'C',0);
			$pdf->Cell(23,5,'','L'.'R',0,'C',0);
			$pdf->Cell(23,5,'','L'.'R',0,'C',0);
			$pdf->Cell(23,5,'','L'.'R',0,'C',0);
			$pdf->Cell(20,5,'','L'.'R',0,'C',0);
			$pdf->Ln(5);

			if ($projekid == 0) {
				$proj = $this->db->query("select distinct id_project,nm_subproject from view_daily where id_pt = ".$cekdata->id_pt." order by id_project asc")->result();
			} else {
				$proj = $this->db->query("select distinct id_project,nm_subproject from view_daily where id_pt = ".$cekdata->id_pt." and id_project = ".$projekid." order by id_project asc")->result();
			}
			
			$g1 = 0;$g2 = 0;$g3 = 0;$g4 = 0;
			foreach ($proj as $key) {
				$pdf->Cell(8,5,$no,1,0,'C',0);
				$pdf->Cell(55,5,$key->nm_subproject,1,0,'L',0);
				$pdf->Cell(20,5,'','L'.'B'.'R',0,'C',0);
				$pdf->Cell(23,5,'','L'.'B'.'R',0,'C',0);
				$pdf->Cell(23,5,'','L'.'B'.'R',0,'C',0);
				$pdf->Cell(23,5,'','L'.'B'.'R',0,'C',0);
				$pdf->Cell(23,5,'','L'.'B'.'R',0,'C',0);
				$pdf->Cell(20,5,'','L'.'B'.'R',0,'C',0);
				$pdf->Ln(5);

				$tot1 = 0;$tot2 = 0;$tot3 = 0;$tot4 = 0;
				if ($bankid == 0 and $projekid == 0) {
					$bank = $this->db->query("select distinct id_dailycash,bank_id,namabank,nomorrek from view_daily where id_pt = ".$cekdata->id_pt." and id_project = ".$key->id_project." order by namabank asc")->result();
				} elseif ($bankid == 0 and $projekid != 0) {
					$bank = $this->db->query("select distinct id_dailycash,bank_id,namabank,nomorrek from view_daily where id_pt = ".$cekdata->id_pt." and id_project = ".$projekid." order by namabank asc")->result();
				} else {
					$bank = $this->db->query("select distinct id_dailycash,bank_id,namabank,nomorrek from view_daily where id_pt = ".$cekdata->id_pt." and id_project = ".$key->id_project." and bank_id = ".$bankid." order by namabank asc")->result();
				}

				//var_dump($bank);exit();
				
				foreach ($bank as $rowb) {

					$pdf->Cell(8,5,'','L'.'B'.'R',0,'C',0);
					$pdf->Cell(55,5,$rowb->namabank,'L'.'B'.'R',0,'L',0);
					$pdf->Cell(20,5,$rowb->nomorrek,'L'.'B'.'R',0,'C',0);
					$pdf->Cell(23,5,'','L'.'B'.'R',0,'C',0);
					$pdf->Cell(23,5,'','L'.'B'.'R',0,'C',0);
					$pdf->Cell(23,5,'','L'.'B'.'R',0,'C',0);
					$pdf->Cell(23,5,'','L'.'B'.'R',0,'C',0);
					$pdf->Cell(20,5,'','L'.'B'.'R',0,'C',0);
					$pdf->Ln(5);

					$begin = $this->db->query("select begin_amount from db_dailycash where id_dailycash = ".$rowb->id_dailycash."")->row();
					$start = $begin->begin_amount;

					$end = 0;
					$deb = 0;
					$cred = 0;
					$transact = $this->db->query("select * from db_dailycashdet where id_dailycash = ".$rowb->id_dailycash." and tgl <= '".inggris_date($tanggal)." 00:00:00' and flag_hapus = 0")->result();
					foreach ($transact as $hasil) {
						$pdf->Cell(8,5,'','L'.'B'.'R',0,'C',0);
						$pdf->Cell(15,5,indo_date($hasil->tgl),'L'.'B'.'R',0,'L',0);
						$pdf->Cell(40,5,' | ','L'.'B'.'R',0,'C',0);
						$pdf->Cell(20,5,' | ','L'.'B'.'R',0,'C',0);
						$pdf->Cell(23,5,number_format($start),'L'.'B'.'R',0,'R',0);
						$pdf->Cell(23,5,number_format($hasil->debet),'L'.'B'.'R',0,'R',0);
						$pdf->Cell(23,5,number_format($hasil->credit),'L'.'B'.'R',0,'R',0);
						$start = $start + $hasil->debet - $hasil->credit;
						$pdf->Cell(23,5,number_format($start),'L'.'B'.'R',0,'R',0);
						$pdf->Cell(20,5,$hasil->remark,'L'.'B'.'R',0,'C',0);
						$pdf->Ln(5);

						$deb = $deb + $hasil->debet;
						$cred = $cred + $hasil->credit;
					}

					$end = $start;	

					$pdf->Cell(8,5,'',1,0,'C',1);
					$pdf->Cell(75,5,'Saldo Total',1,0,'L',1);
					$pdf->Cell(23,5,number_format($begin->begin_amount),1,0,'R',1);
					$pdf->Cell(23,5,number_format($deb),1,0,'R',1);
					$pdf->Cell(23,5,number_format($cred),1,0,'R',1);
					$pdf->Cell(23,5,number_format($end),1,0,'R',1);
					$pdf->Cell(20,5,'Per Bank',1,0,'C',1);
					$pdf->Ln(5);
					$no++;

					$tot1 = $tot1 + $begin->begin_amount;
					$tot2 = $tot2 + $deb;
					$tot3 = $tot3 + $cred;
					$tot4 = $tot4 + $end;
				}
				$pdf->Cell(8,5,'',1,0,'C',1);
				$pdf->Cell(75,5,'Saldo Total Per Project',1,0,'L',1);
				$pdf->Cell(23,5,number_format($tot1),1,0,'R',1);
				$pdf->Cell(23,5,number_format($tot2),1,0,'R',1);
				$pdf->Cell(23,5,number_format($tot3),1,0,'R',1);
				$pdf->Cell(23,5,number_format($tot4),1,0,'R',1);
				$pdf->Cell(20,5,'Per Project',1,0,'C',1);
				$pdf->Ln(5);
				$no++;

				$g1 = $g1 + $tot1;
				$g2 = $g2 + $tot2;
				$g3 = $g3 + $tot3;
				$g4 = $g4 + $tot4;
			}

			
			//untuk grand total
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(83,5,'Saldo Total',1,0,'C',1);
			$pdf->Cell(23,5,number_format($g1),1,0,'R',1);
			$pdf->Cell(23,5,number_format($g2),1,0,'R',1);
			$pdf->Cell(23,5,number_format($g3),1,0,'R',1);
			$pdf->Cell(23,5,number_format($g4),1,0,'R',1);
			$pdf->Cell(20,5,'',1,0,'C',1);
			$pdf->Ln(5);

			$pdf->SetFont('Arial','',6);
			$pdf->SetXY(180,270);
			$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
			$pdf->Cell(2,4,':',4,0,'L');
			$pdf->Cell(2,4,date("Y-m-d"),4,0,'L');
			$pdf->Output("DAILY_CASH_REPORT_DETAIL.pdf","I");	;
	
