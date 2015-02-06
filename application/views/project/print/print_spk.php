<?php
			#die('tes');
			require('fpdf/tanpapage.php');
			include_once( APPPATH."libraries/translate_currency.php");
			extract(PopulateForm());
			$pdf=new PDF('P','mm','A4');
			$rows = $this->db->query("sp_print_spk ".$id_kontrak."")->row();
							 
			
			//SELECT no_spk, no_kontrak, nm_subproject, vendor_nm, job, start_date, end_date, contract_amount 
			 
							 
			$pdf->SetMargins(8,10,8);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			#HEAD
			#HEADER CONTENT
			#$pdf->Image(site_url().'assets/images/bakrie.JPG',10,8,20);	
				
			#CETAK TANGGAL
				#$tgl  = date("d-m-Y");
			#TANGGAL CETAK
				
			#	$pdf->Cell(10,4,$tgl,0,0,'L');
			
				#Header
			$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
			$pdf->SetX(25);
				
			// Start diatas tabel
			
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(110,3,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(25,3,'',10,0,'L');
			$pdf->Cell(2,3,'',10,0,'L');
			$pdf->Cell(30,3,'Lantai Dasar, Podium Utara, Apartemen Taman Rasuna.',10,0,'R');
			$pdf->Ln(3);
			
			$pdf->SetFont('Arial','',7);
			$pdf->SetX(25);
			$pdf->Cell(110,3,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(25,3,'',10,0,'L');
			$pdf->Cell(2,3,'',10,0,'L');
			$pdf->Cell(30,3,'Komplek Rasuna Epicentrum',10,0,'R');
			$pdf->Ln(3);
			
			$pdf->SetFont('Arial','',7);
			$pdf->SetX(25);
			$pdf->Cell(110,3,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(25,3,'',10,0,'L');
			$pdf->Cell(2,3,'',10,0,'L');
			$pdf->Cell(30,3,'Jl. HR Rasuna Said Jakarta 12960 - Indonesia',10,0,'R');
			$pdf->Ln(3);
			
			$pdf->SetFont('Arial','',7);
			$pdf->SetX(25);
			$pdf->Cell(110,3,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(25,3,'',10,0,'L');
			$pdf->Cell(2,3,'',10,0,'L');
			$pdf->Cell(30,3,'Tel. +62-21 8305011 Fax. +62-21 8305012 9392310',10,0,'R');
			$pdf->Ln(3);
			
			$pdf->SetFont('Arial','',7);
			$pdf->SetX(25);
			$pdf->Cell(110,3,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(25,3,'',10,0,'L');
			$pdf->Cell(2,3,'',10,0,'L');
			$pdf->Cell(30,3,'wwww.awana-yogyakarta.com',10,0,'R');
			$pdf->Ln(3);
			
		
			
			$pdf->Ln(15);
			$pdf->SetFont('Arial','',9);
			$pdf->SetX(20);
			$pdf->Cell(110,5,'',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(20);
			$pdf->Cell(110,5,'Ref. No. : '.$rows->no_spk,10,0,'L');
			$pdf->Ln(6);
			
			$pdf->SetFont('Arial','',9);
			$pdf->SetX(20);
			$pdf->Cell(110,5,'Kepada Yth.',10,0,'L');
			$pdf->Ln(5);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','B'.'U',9);
			$pdf->Cell(110,5,$rows->nm_supplier,10,0,'L');
			$pdf->Ln(5);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(110,5,$rows->alamat,10,0,'L');
			$pdf->Ln(5);
			
			#$pdf->SetX(20);
			#$pdf->SetFont('Arial','',9);
			#$pdf->Cell(110,5,'a',10,0,'L');
			#$pdf->Ln(3);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(10,5,'Telp.',10,0,'L');
			$pdf->Cell(3,5,':',10,0,'L');
			$pdf->Cell(20,5,$rows->telepon,10,0,'L');
				
			
			$pdf->Ln(10);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','U'.'B',12);
			
			$perihal = 'Perihal : Perintah Kerja '.$rows->mainjob_desc;
			$pdf->Cell(170,5,substr($perihal,0,70),10,0,'C');
			$pdf->Ln(5);
			
			$pdf->Cell(170,5,substr($perihal,70,140),10,0,'C');
			$pdf->Ln(5);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(170,5,'PT. '.$rows->nm_pt,10,0,'C');
			$pdf->Ln(12);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(170,3,'Dengan Hormat,',10,0,'L');
			$pdf->Ln(5);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(170,3,'Berikut kami perintahkan kepada:',10,0,'L');
			$pdf->Ln(5);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(170,3,$rows->nm_supplier,10,0,'C');
			$pdf->Ln(8);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','U'.'B',10);
			$pdf->Cell(170,5,'Untuk melaksanakan :',10,0,'L');
			$pdf->Ln(5);
			
			if($rows->currency == 'IDR'){
				$baris1 = 'Pekerjaan '.$rows->mainjob_desc.', dengan nilai pekerjaan sebesar Rp. '.number_format($rows->contract_amount) .' ( '.ucwords(toRupiah($rows->contract_amount)).' Rupiah), Termasuk PPN. ';
			
						if (strlen($baris1) > 105){
								
							$pdf->SetX(20);
							$pdf->SetFont('Arial','',10);
							$pdf->Cell(200,5,substr($baris1,0,110),10,0,'L');
							$pdf->Ln(5);
							$pdf->SetX(20);
							$pdf->Cell(200,5,substr($baris1,110,200),10,0,'L');
						} 
						else {
							$pdf->SetX(20);
							$pdf->SetFont('Arial','',10);
							$pdf->Cell(190,5,substr($baris1,0,105),10,0,'L');
							}
			}
			else{
				$baris1 = 'Pekerjaan '.$rows->mainjob_desc.', dengan nilai pekerjaan sebesar $'.number_format($rows->contract_amount) .' ( '.ucwords(toRupiah($rows->contract_amount)).' USD), Termasuk PPN. ';
			
						if (strlen($baris1) > 105){
								
							$pdf->SetX(20);
							$pdf->SetFont('Arial','',10);
							$pdf->Cell(200,5,substr($baris1,0,110),10,0,'L');
							$pdf->Ln(5);
							$pdf->SetX(20);
							$pdf->Cell(200,5,substr($baris1,110,200),10,0,'L');
						} 
						else {
							$pdf->SetX(20);
							$pdf->SetFont('Arial','',10);
							$pdf->Cell(190,5,substr($baris1,0,105),10,0,'L');
							}
			}
			
			
			
			
			$pdf->Ln(10);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','U'.'B',10);
			$pdf->Cell(170,5,'Cara Pembayaran:',10,0,'L');
			$pdf->Ln(5);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',10);
			
			$row = $this->db->where('nospk',$rows->no_spk)
							->order_by('id_payspk','asc')
							->get('db_payspk')->result();
			
			foreach($row as $query){
			
				$persen = $query->persen;
				$tipespk = $query->tipe_payspk;
				$ket	= $query->ket_spk;
				
				if ($tipespk == 1){ $tahap = 'DP';}
				elseif($tipespk == 2){ $tahap = 'Progress';}
				elseif($tipespk == 3){ $tahap = 'Retensi';}		
				
				$pdf->SetX(20);
				$pdf->Cell(20,5,'- '.$tahap,10,0,'L');
				#IF($query->tipe_payspk == 1){
				#$pdf->Cell(100,5,"DP (".$rows->dptype.")",10,0,'L');
				$pdf->Cell(100,5,$persen.' % '.$ket,10,0,'L');
				
			
				
					
			
			#$pdf->Cell(5,5,'Rp.',10,0,'L');
			#$pdf->Cell(30,5,number_format($rows->dp_amount),10,0,'R');
			$pdf->Ln(5);
			}
			
			
			###hitung persen dan nilai progress
			#$progress = 100 - ($rows->dp + $rows->retensi);
			#$progress_amount = ($rows->contract_amount - $rows->dp_amount) - $rows->retensi_amount;
			
			#END
			#$pdf->SetX(20);
			#$pdf->SetFont('Arial','',10);
			#$pdf->Cell(10,5,'-',10,0,'C');
			#$pdf->Cell(100,5,'Progress Sebesar '$progress.'%',10,0,'L');
			#$pdf->Cell(5,5,'Rp.',10,0,'L');
			#$pdf->Cell(30,5,#number_format($progress_amount).'',10,0,'R');
			#$pdf->Ln(5);
			
			#$pdf->SetX(20);
			#$pdf->SetFont('Arial','',10);
			#$pdf->Cell(10,5,'-',10,0,'C');
			#$pdf->Cell(100,5,'Retensi Sebesar '.#$rows->retensi.'%',10,0,'L');
			#$pdf->Cell(5,5,'Rp.',10,0,'L');
			#$pdf->Cell(30,5,#number_format($rows->retensi_amount),10,0,'R');
			$pdf->Ln(10);
			
						
			$pdf->SetX(20);
			$pdf->SetFont('Arial','U'.'B',10);
			$pdf->Cell(170,5,'Lingkup Pekerjaan:',10,0,'L');
			$pdf->Ln(5);
			
			
			
			
			/*$sql = "SELECT 
			i.job job
			FROM db_kontrak a
			LEFT JOIN db_tendeva b ON b.id_tendeva = a.id_tendeva
			LEFT JOIN db_mainjob c ON c.mainjob_id = b.id_mainjob
			LEFT JOIN pemasokmaster f ON f.kd_supp_gb = b.id_vendor
			LEFT JOIN pt g ON g.id_pt = b.id_pt
			LEFT JOIN db_detailjob h ON h.id_kontrak = a.id_kontrak
			LEFT JOIN db_trbgtproj i ON i.no_trbgtproj = c.no_trbgtproj
			where a.id_kontrak = '$rows->id_kontrak' 
			GROUP BY i.job";


			$cek  = $this->db->query($sql)->result();
			
			
			foreach($cek as $row){*/
			/*
			$text1 = "
			1. tes 
			2. tes
			
			";
			*/
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(200,4,$rows->lingkup);
			#$pdf->MultiCell(200,0,$rows->lingkup,10,0,'L');	
			
			/*
			$pdf->Cell(10,5,'-',10,0,'C');
			$pdf->Cell(170,5,'',10,0,'L');
			*/
			
			$pdf->Ln(5);
		#}
		
			
			#$pdf->Ln(4);
			$pdf->SetX(20);
			$pdf->SetFont('Arial','U'.'B',10);
			$pdf->Cell(170,5,'Jangka Waktu Pelaksanaan:',10,0,'L');
			$pdf->Ln(5);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',10);
			$pdf->MultiCell(150,4,$rows->jadwal);
			
			$pdf->Ln(5);
			/*
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(170,3,'Waktu pelaksanaan '.$rows->d1.' ('.ucwords(toRupiah($rows->d1)).') '.'Hari, setelah instruksi kerja diterima.',10,0,'L');
			$pdf->Ln(5);
			*/
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(170,3,'Demikian kami sampaikan instruksi kerja ini, atas perhatian dan kerjasamanya kami ucapkan terima kasih.',10,0,'L');
			
			$pdf->Ln(10); 
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','u',10);
			$pdf->Cell(30,3,'Hormat Kami,',10,0,'L');
			$pdf->Cell(60,3,'',10,0,'L');
			$pdf->Cell(170,3,'Menyetujui,',10,0,'L');
			$pdf->Ln(4);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(30,3,'PT. '.$rows->nm_pt,10,0,'L');
			$pdf->Cell(60,3,'',10,0,'L');
			$pdf->Cell(60,3,$rows->nm_supplier,10,0,'L');
			
			$pdf->Ln(28);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','U',10);
			$pdf->Cell(30,3,$rows->sign_1,10,0,'L');
			$pdf->Cell(60,3,'',10,0,'L');
			$pdf->Cell(60,3,$rows->sign_2,10,0,'L');
			
			$pdf->Ln(5);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(30,3,$rows->sign1_level,10,0,'L');
			$pdf->Cell(60,3,'',10,0,'L');
			$pdf->Cell(60,3,$rows->sign2_level,10,0,'L');
			
			$pdf->Ln(7);
			$pdf->SetX(20);
			$pdf->SetFont('Arial','U',10);
			$pdf->Cell(30,3,'Tembusan',10,0,'L');
			$pdf->Ln(4);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(4,3,'1.',10,0,'L');
			$pdf->Cell(30,3,'BOD',10,0,'L');
			$pdf->Ln(4);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(4,3,'2.',10,0,'L');
			$pdf->Cell(30,3,'File',10,0,'L');
			$pdf->Ln(4);
			
		
			$pdf->Output("hasil.pdf","I");

?>


<?


/*ini file asli Mis
			#die('tes');
			require('fpdf/tanpapage.php');
/* Ini file asli MIs			
			
			include_once( APPPATH."libraries/translate_currency.php");
			extract(PopulateForm());
			$pdf=new PDF('P','mm','A4');
			$rows = $this->db->query("sp_print_spk ".$id_kontrak."")->row();
							 
			//SELECT no_spk, no_kontrak, nm_subproject, vendor_nm, job, start_date, end_date, contract_amount 
			 
							 
			$pdf->SetMargins(8,10,8);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			#HEAD
			#HEADER CONTENT
			#$pdf->Image(site_url().'assets/images/bakrie.JPG',10,8,20);	
				
			#CETAK TANGGAL
				#$tgl  = date("d-m-Y");
			#TANGGAL CETAK
				
			#	$pdf->Cell(10,4,$tgl,0,0,'L');
			
				#Header
			$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
			$pdf->SetX(25);
				
			// Start diatas tabel
			
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(110,3,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(25,3,'',10,0,'L');
			$pdf->Cell(2,3,'',10,0,'L');
			$pdf->Cell(30,3,'Lantai Dasar, Podium Utara, Apartemen Taman Rasuna.',10,0,'R');
			$pdf->Ln(3);
			
			$pdf->SetFont('Arial','',7);
			$pdf->SetX(25);
			$pdf->Cell(110,3,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(25,3,'',10,0,'L');
			$pdf->Cell(2,3,'',10,0,'L');
			$pdf->Cell(30,3,'Komplek Rasuna Epicentrum',10,0,'R');
			$pdf->Ln(3);
			
			$pdf->SetFont('Arial','',7);
			$pdf->SetX(25);
			$pdf->Cell(110,3,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(25,3,'',10,0,'L');
			$pdf->Cell(2,3,'',10,0,'L');
			$pdf->Cell(30,3,'Jl. HR Rasuna Said Jakarta 12960 - Indonesia',10,0,'R');
			$pdf->Ln(3);
			
			$pdf->SetFont('Arial','',7);
			$pdf->SetX(25);
			$pdf->Cell(110,3,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(25,3,'',10,0,'L');
			$pdf->Cell(2,3,'',10,0,'L');
			$pdf->Cell(30,3,'Tel. +62-21 8305011 Fax. +62-21 8305012 9392310',10,0,'R');
			$pdf->Ln(3);
			
			$pdf->SetFont('Arial','',7);
			$pdf->SetX(25);
			$pdf->Cell(110,3,'',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(25,3,'',10,0,'L');
			$pdf->Cell(2,3,'',10,0,'L');
			$pdf->Cell(30,3,'wwww.awana-yogyakarta.com',10,0,'R');
			$pdf->Ln(3);
			
		
			
			$pdf->Ln(15);
			$pdf->SetFont('Arial','',9);
			$pdf->SetX(20);
			$pdf->Cell(110,5,'',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(20);
			$pdf->Cell(110,5,'Ref. No. : '.$rows->no_spk,10,0,'L');
			$pdf->Ln(6);
			
			$pdf->SetFont('Arial','',9);
			$pdf->SetX(20);
			$pdf->Cell(110,5,'Kepada Yth.',10,0,'L');
			$pdf->Ln(5);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','B'.'U',9);
			$pdf->Cell(110,5,$rows->nm_supplier,10,0,'L');
			$pdf->Ln(5);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(110,5,$rows->alamat,10,0,'L');
			$pdf->Ln(5);
			
			#$pdf->SetX(20);
			#$pdf->SetFont('Arial','',9);
			#$pdf->Cell(110,5,'a',10,0,'L');
			#$pdf->Ln(3);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(10,5,'Telp.',10,0,'L');
			$pdf->Cell(3,5,':',10,0,'L');
			$pdf->Cell(20,5,$rows->telepon,10,0,'L');
				
			
			$pdf->Ln(10);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','U'.'B',12);
			$pdf->Cell(170,3,'Perihal : Perintah Kerja '.$rows->mainjob_desc,10,0,'C');
			$pdf->Ln(5);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(170,3,$rows->nm_pt,10,0,'C');
			$pdf->Ln(12);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(170,3,'Dengan Hormat,',10,0,'L');
			$pdf->Ln(5);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(170,3,'Berikut kami perintahkan kepada:',10,0,'L');
			$pdf->Ln(10);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(170,3,$rows->nm_supplier,10,0,'C');
			$pdf->Ln(15);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','U'.'B',10);
			$pdf->Cell(170,5,'Untuk melaksanakan :',10,0,'L');
			$pdf->Ln(5);
			
			$baris1 = 'Pekerjaan '.$rows->mainjob_desc.', dengan nilai pekerjaan sebesar Rp. '.number_format($rows->contract_amount) .' ( '.ucwords(toRupiah($rows->contract_amount)).' Rupiah )';
			
			if (strlen($baris1) > 105){
					
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(200,5,substr($baris1,0,105),10,0,'L');
			$pdf->Ln(5);
			$pdf->SetX(20);
			$pdf->Cell(200,5,substr($baris1,105,220),10,0,'L');
			
		} else {
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(190,5,substr($baris1,0,105),10,0,'L');
			
		}
			$pdf->Ln(10);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','U'.'B',10);
			$pdf->Cell(170,5,'Cara Pembayaran:',10,0,'L');
			$pdf->Ln(5);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(10,5,'-',10,0,'C');
			$pdf->Cell(100,5,$rows->dp.'%, Pembayaran tahap I, Down Payment Sebesar',10,0,'L');
			$pdf->Cell(5,5,'Rp.',10,0,'L');
			$pdf->Cell(30,5,number_format($rows->dp_amount),10,0,'R');
			$pdf->Ln(5);
			
			###hitung persen dan nilai progress
			$progress = 100 - ($rows->dp + $rows->retensi);
			$progress_amount = ($rows->contract_amount - $rows->dp_amount) - $rows->retensi_amount;
			
			#END
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(10,5,'-',10,0,'C');
			$pdf->Cell(100,5,$progress.'%, Pembayaran tahap II, Monthly Progress Sebesar',10,0,'L');
			$pdf->Cell(5,5,'Rp.',10,0,'L');
			$pdf->Cell(30,5,number_format($progress_amount).'',10,0,'R');
			$pdf->Ln(5);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(10,5,'-',10,0,'C');
			$pdf->Cell(100,5,$rows->retensi.'%, Pembayaran tahap III, Retensi Sebesar',10,0,'L');
			$pdf->Cell(5,5,'Rp.',10,0,'L');
			$pdf->Cell(30,5,number_format($rows->retensi_amount),10,0,'R');
			$pdf->Ln(10);
			
						
			$pdf->SetX(20);
			$pdf->SetFont('Arial','U'.'B',10);
			$pdf->Cell(170,5,'Lingkup Pekerjaan:',10,0,'L');
			$pdf->Ln(5);
			
			
			/*$sql = "SELECT 
			i.job job
			FROM db_kontrak a
			LEFT JOIN db_tendeva b ON b.id_tendeva = a.id_tendeva
			LEFT JOIN db_mainjob c ON c.mainjob_id = b.id_mainjob
			LEFT JOIN pemasokmaster f ON f.kd_supp_gb = b.id_vendor
			LEFT JOIN pt g ON g.id_pt = b.id_pt
			LEFT JOIN db_detailjob h ON h.id_kontrak = a.id_kontrak
			LEFT JOIN db_trbgtproj i ON i.no_trbgtproj = c.no_trbgtproj
			where a.id_kontrak = '$rows->id_kontrak' 
			GROUP BY i.job";


			$cek  = $this->db->query($sql)->result();
			
			
			foreach($cek as $row){
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(10,5,'-',10,0,'C');
			$pdf->Cell(170,5,'',10,0,'L');
			$pdf->Ln(5);
		#}
		
			
			$pdf->Ln(4);
			$pdf->SetX(20);
			$pdf->SetFont('Arial','U'.'B',10);
			$pdf->Cell(170,5,'Jangka Waktu Pelaksanaan:',10,0,'L');
			$pdf->Ln(5);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(170,3,'Waktu pelaksanaan '.$rows->d1.' ('.ucwords(toRupiah($rows->d1)).') '.'Hari, setelah instruksi kerja diterima.',10,0,'L');
			$pdf->Ln(5);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(170,3,'Demikian kami sampaikan instruksi kerja ini, atas perhatian dan kerjasamanya kami ucapkan terima kasih.',10,0,'L');
			$pdf->Ln(20); 
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','u',10);
			$pdf->Cell(30,3,'Hormat Kami,',10,0,'L');
			$pdf->Cell(60,3,'',10,0,'L');
			$pdf->Cell(170,3,'Menyetujui,',10,0,'L');
			$pdf->Ln(4);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(30,3,'PT. '. $rows->nm_pt,10,0,'L');
			$pdf->Cell(60,3,'',10,0,'L');
			$pdf->Cell(60,3,$rows->nm_supplier,10,0,'L');
			
			$pdf->Ln(25);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','U',10);
			$pdf->Cell(30,3,$rows->sign_1,10,0,'L');
			$pdf->Cell(60,3,'',10,0,'L');
			$pdf->Cell(60,3,$rows->sign_2,10,0,'L');
			
			$pdf->Ln(5);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(30,3,$rows->sign1_level,10,0,'L');
			$pdf->Cell(60,3,'',10,0,'L');
			$pdf->Cell(60,3,$rows->sign2_level,10,0,'L');
			
			$pdf->Ln(7);
			$pdf->SetX(20);
			$pdf->SetFont('Arial','U',10);
			$pdf->Cell(30,3,'Tembusan',10,0,'L');
			$pdf->Ln(4);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(4,3,'1.',10,0,'L');
			$pdf->Cell(30,3,'BOD',10,0,'L');
			$pdf->Ln(4);
			
			$pdf->SetX(20);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(4,3,'2.',10,0,'L');
			$pdf->Cell(30,3,'File',10,0,'L');
			$pdf->Ln(4);
			
		
			$pdf->Output("hasil.pdf","I");
*/

?>
