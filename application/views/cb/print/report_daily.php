<?php
	
	
		$sql = "select distinct id_pt,nm_pt from view_daily order by id_pt asc";
		$cekdata = $this->db->query($sql)->result();

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
			$pdf->Cell(50,5,'','L'.'T'.'R',0,'C',0);
			$pdf->Cell(20,5,'','L'.'T'.'R',0,'C',0);
			$pdf->Cell(23,5,'','L'.'T'.'R',0,'C',0);
			$pdf->Cell(46,5,'Mutasi',1,0,'C',0);
			$pdf->Cell(23,5,'','L'.'T'.'R',0,'C',0);
			$pdf->Cell(20,5,'','L'.'T'.'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(8,5,'No','L'.'B'.'R',0,'C',0);
			$pdf->Cell(50,5,'Kind Of Bank Account','L'.'B'.'R',0,'C',0);
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
			$tot1 = 0;$tot2 = 0;$tot3 = 0;$tot4 = 0;
			foreach ($cekdata as $row) {
				//$pdf->Cell(8,5,'','L'.'R',0,'C',0);
				$pdf->SetFont('Arial','B',7);
				$pdf->Cell(58,5,'PT. '.$row->nm_pt,'1',0,'L',0);
				$pdf->SetFont('Arial','',7);
				$pdf->Cell(20,5,'','L'.'R',0,'C',0);
				$pdf->Cell(23,5,'','L'.'R',0,'C',0);
				$pdf->Cell(23,5,'','L'.'R',0,'C',0);
				$pdf->Cell(23,5,'','L'.'R',0,'C',0);
				$pdf->Cell(23,5,'','L'.'R',0,'C',0);
				$pdf->Cell(20,5,'','L'.'R',0,'C',0);
				$pdf->Ln(5);

				
				$proj = $this->db->query("select distinct id_project,nm_subproject from view_daily where id_pt = ".$row->id_pt." order by id_project asc")->result();
				foreach ($proj as $key) {
					$pdf->Cell(8,5,$no,1,0,'C',0);
					$pdf->Cell(50,5,$key->nm_subproject,1,0,'L',0);
					$pdf->Cell(20,5,'','L'.'B'.'R',0,'C',0);
					$pdf->Cell(23,5,'','L'.'B'.'R',0,'C',0);
					$pdf->Cell(23,5,'','L'.'B'.'R',0,'C',0);
					$pdf->Cell(23,5,'','L'.'B'.'R',0,'C',0);
					$pdf->Cell(23,5,'','L'.'B'.'R',0,'C',0);
					$pdf->Cell(20,5,'','L'.'B'.'R',0,'C',0);
					$pdf->Ln(5);

					$bank = $this->db->query("select distinct bank_id,namabank,nomorrek from view_daily where id_pt = ".$row->id_pt." and id_project = ".$key->id_project." order by namabank asc")->result();
					foreach ($bank as $rowb) {
						$querybegin = $this->db->query("select id_dailycash,begin_amount from db_dailycash where id_pt = ".$row->id_pt." and id_project = ".$key->id_project." and bank_id = ".$rowb->bank_id." ")->row();
						$querysumm = $this->db->query("select sum(debet) as d, sum(credit) as c from db_dailycashdet where id_dailycash = ".$querybegin->id_dailycash." and tgl <= '".inggris_date($tanggal)." 00:00:00' and flag_hapus = 0")->row();
						$outstand = $querybegin->begin_amount + $querysumm->d - $querysumm->c;
						$pdf->Cell(8,5,'','L'.'R',0,'C',0);
						$pdf->Cell(50,5,$rowb->namabank,'L'.'R',0,'L',0);
						$pdf->Cell(20,5,$rowb->nomorrek,'L'.'R',0,'C',0);
						$pdf->Cell(23,5,number_format($querybegin->begin_amount),'L'.'R',0,'R',0);
						$pdf->Cell(23,5,number_format($querysumm->d),'L'.'R',0,'R',0);
						$pdf->Cell(23,5,number_format($querysumm->c),'L'.'R',0,'R',0);
						$pdf->Cell(23,5,number_format($outstand),'L'.'R',0,'R',0);
						$pdf->Cell(20,5,'','L'.'R',0,'C',0);
						$pdf->Ln(5);

						$w = $w + $querybegin->begin_amount;
						$x = $x + $querysumm->d;
						$y = $y + $querysumm->c;
						$z = $z + $outstand;	
					}
					$pdf->Cell(8,5,'',1,0,'C',1);
					$pdf->Cell(70,5,'Saldo Total Per Project',1,0,'L',1);
					$pdf->Cell(23,5,number_format($w),1,0,'R',1);
					$pdf->Cell(23,5,number_format($x),1,0,'R',1);
					$pdf->Cell(23,5,number_format($y),1,0,'R',1);
					$pdf->Cell(23,5,number_format($z),1,0,'R',1);
					$pdf->Cell(20,5,'Per Project',1,0,'C',1);
					$pdf->Ln(5);
					$no++;

					$a = $a + $w;
					$b = $b + $x;
					$c = $c + $y;
					$d = $d + $z;
				}
				$pdf->Cell(8,5,'',1,0,'C',1);
				$pdf->Cell(70,5,'Saldo Total Per PT',1,0,'L',1);
				$pdf->Cell(23,5,number_format($a),1,0,'R',1);
				$pdf->Cell(23,5,number_format($b),1,0,'R',1);
				$pdf->Cell(23,5,number_format($c),1,0,'R',1);
				$pdf->Cell(23,5,number_format($d),1,0,'R',1);
				$pdf->Cell(20,5,'Per PT',1,0,'C',1);
				$pdf->Ln(5);
				$no++;

				$tot1 = $tot1 + $a;
				$tot2 = $tot2 + $b;
				$tot3 = $tot3 + $c;
				$tot4 = $tot4 + $d;
			}
			
			//untuk grand total
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(78,5,'Grand Total',1,0,'C',1);
			$pdf->Cell(23,5,number_format($tot1),1,0,'R',1);
			$pdf->Cell(23,5,number_format($tot2),1,0,'R',1);
			$pdf->Cell(23,5,number_format($tot3),1,0,'R',1);
			$pdf->Cell(23,5,number_format($tot4),1,0,'R',1);
			$pdf->Cell(20,5,'',1,0,'C',1);
			$pdf->Ln(5);

			$pdf->SetFont('Arial','',6);
			$pdf->SetXY(180,270);
			$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
			$pdf->Cell(2,4,':',4,0,'L');
			$pdf->Cell(2,4,date("Y-m-d"),4,0,'L');
			$pdf->Output("DAILY_CASH_REPORT_ALL.pdf","I");	;
	
