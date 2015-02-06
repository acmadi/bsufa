<?php
	//die($idnama);
			require('fpdf/tanpapage.php');
			include_once( APPPATH."libraries/translate_currency.php"); 
			
			$status=1;
			$tgl='01/01/1900';
			$no_reminder='NULL';
			
			$session_id = $this->UserLogin->isLogin();
			$this->pt_id = $session_id['id_pt'];
			$pt = $this->pt_id;
			
			$rows = $this->db->query("sp_printreminder '".$id_sp."',".$status.",'".$reminder_date."','".$tgl."','".$no_reminder."'")->row();#$this->db->query($sql)->row();
	
			
							
			$pdf=new PDF('P','mm','A4');
			
			$pdf->SetMargins(15,10,4);
			$pdf->AliasNbPages();	
			$pdf->AddPage(); 
			//$pdf->SetFont('Arial','B',12);
			
			$y_axis_initial = 42;
			$pdf->SetY($y_axis_initial);
			//$idsp			
			$pdf->SetFont('Arial','',10);
			//$pdf->SetXY(2,16);
			//$pdf->Cell(0,10,$idsp,20,0,'L');
			$pdf->Cell(40,0,'No Surat',10,0,'L');
			$pdf->Cell(9,0,':',10,0,'L');
			$pdf->Cell(9,0,$rows->reminder_no,10,0,'L');
			$pdf->Ln(4);
			$pdf->Cell(40,0,'Tgl. Surat',10,0,'L');
			$pdf->Cell(9,0,':',10,0,'L');
			$pdf->Cell(9,0,'Jakarta '.indo_date($rows->reminder_date).'',10,0,'L');
		


			$y_axis_initial2 = 60;
			//$y_axis = 0;
			
			$pdf->SetY($y_axis_initial2);
			//$pdf->SetX(2);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(40,0,'Kepada Yth.',10,0,'L');
			$pdf->Ln(4);
			$pdf->Cell(40,0,$rows->customer_nama,10,0,'L');
			//$pdf->Cell(9,0,':',10,0,'L');
			//$pdf->Cell(9,0,$nama,10,0,'L');
			$pdf->Ln(4);
			$pdf->Cell(40,0,'Pemesan '.$rows->project_no.'  atas unit : '.$rows->unit_no.'',10,0,'L');
			// $pdf->Cell(9,0,':',10,0,'L');
			// $pdf->Cell(9,0,$alamat1,10,0,'L');
			$pdf->Ln(4);
			$pdf->Cell(40,0,substr($rows->customer_alamat1,0,100),10,0,'L');
			//$pdf->Cell(50,10,substr($row->descs,0,40),"L"."R",0,'L',0);
			// $pdf->Ln(4);
			
					
			// $pdf->Cell(40,0,substr($rows->customer_alamat1,100,100),10,0,'L');
			if ($pt==44){
			$pdf->Ln(4);
			$pdf->Cell(40,0,'',10,0,'L');
			}else{
			$pdf->Ln(4);
			$pdf->Cell(40,0,$rows->kota_nm,10,0,'L');			
			}
			
		

			$pdf->SetFont('Arial','',10);
			$pdf->Ln(12);
			$pdf->Cell(35,0,'Perihal : Pemberitahuan Pertama Pembayaran Pemesanan  '.$rows->project_no.' : '.$rows->unit_no.'',10,0,'L');
			//$pdf->SetFont('Arial','',10);
			//$pdf->Cell(15,0,'Pemberitahuan Pertama Pembayaran Pemesanan  '.$rows->project_no.' : '.$rows->unit_no.'',10,0,'L');
			$pdf->SetFont('Arial','',10);
			//$pdf->Cell(10,0,')',10,0,'R');
			
			$pdf->SetFont('Arial','',10);
			$pdf->Ln(8);
			
			$pdf->Ln(4);
							$pdf->Cell(35,0,'Dengan Hormat  ',10,0,'L');	
							$pdf->Ln(4);
							$pdf->Cell(40,0,'Sehubungan dengan perihal tersebut diatas, bersama ini kami sampaikan bahwa PT. '.$rows->project.'',10,0,'L');	
			
							#end header
							$pdf->Ln(4);
							$pdf->Cell(40,0,'dan Bapak/Ibu telah menandatangani Surat Pesanan sebagaimana tersebut dibawah ini :',10,0,'L');	
			
							// $pdf->Ln(4);
							// $pdf->Cell(40,0,'Pemesanan sebagaimana ketentuan SURAT PESANAN  (terlampir).',10,0,'L');

						
			
			$pdf->Ln(4);

			
			
			$pdf->Ln(4);
			$pdf->Cell(45,0,'No Surat Pesanan',10,0,'L');
			$pdf->Cell(9,0,':',10,0,'L');
			$pdf->Cell(9,0,$rows->sp_no,10,0,'L');
			$pdf->Ln(4);
			$pdf->Cell(45,0,'Tanggal Surat Pesanan',10,0,'L');
			$pdf->Cell(9,0,':',10,0,'L');
			$pdf->Cell(9,0,indo_date($rows->sp_date),10,0,'L');
			$pdf->Ln(4);
			
			#LUASAN			
	
			$pdf->Ln(4);
							$pdf->Cell(45,0,'Harga Unit (Incl. PPN )',10,0,'L');
							$pdf->Cell(9,0,':',10,0,'L');
							$pdf->Cell(23,0,number_format($rows->selling_price),10,0,'L');
							
			
			$pdf->Ln(4);
		
						$pdf->Cell(45,0,'Total Pembayaran',10,0,'L');
						$pdf->Cell(9,0,':',10,0,'L');
						$pdf->Cell(30,0,number_format($rows->payment),10,0,'L');
						// $pdf->SetFont('Arial','',10);
						// $pdf->Cell(40,0,'('.$harganominal.' rupiah)',10,0,'L');
						$pdf->SetFont('Arial','',10);
							$pdf->Ln(4);
							$pdf->Cell(45,0,'Sisa Pembayaran',10,0,'L');
							$pdf->Cell(9,0,':',10,0,'L');
							$pdf->Cell(6,0,number_format($rows->balance),10,0,'L');
							$pdf->Ln(4);
							$pdf->Cell(45,0,'O/S Jatuh Tempo',10,0,'L');
							$pdf->Cell(9,0,':',10,0,'L');
							$pdf->Cell(6,0,number_format($rows->os),10,0,'L');
					
			

			
			$pdf->Ln(4);
			
			$pdf->Cell(31,6,'Harga Unit.',10,0,'R',0);
			$pdf->Cell(21,6,'',10,0,'L',0);
			$pdf->Cell(31,6,'Pembayaran',10,0,'R',0);
			$pdf->Cell(12,6,'',10,0,'L',0);
			$pdf->Cell(45,6,'Sisa Pembayaran',10,0,'R',0);
			$pdf->Cell(30,6,'',10,0,'C',0);
			$pdf->Cell(15,6,'Outstanding Jatuh Tempo',10,0,'R',0);
			
			$pdf->Ln();
			
			$pdf->Cell(9,0,'',1,0,'L',1);
			
			$pdf->Cell(21,0,'',1,0,'L',1);
			$pdf->Cell(21,0,'',1,0,'L',1);
			$pdf->Cell(45,0,'',1,0,'L',1);
			$pdf->Cell(45,0,'',1,0,'C',1);
			$pdf->Cell(56,0,'',1,0,'R',1);
			
			$pdf->Ln(4);
			$pdf->Cell(31,0,number_format($rows->selling_price),10,0,'R',0);
			$pdf->Cell(21,6,'',10,0,'L',0);
			$pdf->Cell(31,0,number_format($rows->payment),10,0,'R',0);
			$pdf->Cell(12,0,'',10,0,'R',0);
			$pdf->Cell(45,0,number_format($rows->balance),10,0,'R',0);
			$pdf->Cell(30,0,'',10,0,'C',0);
			$pdf->Cell(15,0,number_format($rows->os),10,0,'R',0);
		$pdf->Ln(2);
		
			$pdf->Ln(4);
			$pdf->Cell(55,6,'Berdasarkan hal - hal diatas, kami berharap Bapak/Ibu dapat melaksanakan kewajiban yang  telah  jatuh tempo',10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(55,6,'sesuai    Surat     Pesanan,    dalam    jangka    waktu 7  (Tujuh)      hari     kerja      sejak     tanggal    surat    ini.',10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(55,6,'Untuk keperluan pembayaran dan informasi lebih lanjut, Bapak/Ibu  dapat menghubungi Departemen Collection',10,0,'L',0);
			$pdf->Ln(4);
			if ($pt==44){
			$pdf->Cell(55,6,'PT. '.$rows->project.'       No.Telp :      021-29426666         Contact Person :         Sdri.    Taty     Ext.   159',10,0,'L',0);
			}else{
			$pdf->Cell(55,6,'PT. '.$rows->project.' No.Telp : 021-29426666 Contact Person : Sdr. Aris  Ext. 158 atau Sdr. Erwan Ext.128',10,0,'L',0);
			}
			$pdf->Ln(4);
			$pdf->Cell(55,6,'beralamat    di   Kompleks    Rasuna     Epicentrum,   Epiwalk    Lt.6   Jl. HR.   Rasuna   Said   pada   hari   kerja',10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(55,6,'Senin s/d Jumat, pukul 08.30 s/d 17.00 WIB.',10,0,'L',0);
			
								
					
			$pdf->Ln(7);
			$pdf->Cell(55,6,'Demikian kami sampaikan, apabila pada saat surat ini diterima Bapak/Ibu telah melakukan pembayaran, Mohon',10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(55,6,'surat    ini    diabaikan.    Atas    perhatian  dan   kerjasama  Bapak / Ibu,     Kami     mengucapkan  terima  kasih',10,0,'L',0);
				
			$pdf->Ln(7);
			$pdf->Cell(60,6,'Hormat Kami,',10,0,'L',0);
			// $pdf->Cell(60,6,'PEMESAN',10,0,'L',0);
			// $pdf->Cell(60,6,'Sales',10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(60,6,'PT. '.$rows->project.'',10,0,'L',0);
			
			$pdf->Ln(30);
			if ($pt==44){
			$pdf->Cell(60,6,'Susamto',10,0,'L',0);
			$pdf->Ln(5);
			$pdf->Cell(28,0,'',1,0,'L',1);
			$pdf->Ln(1);
			$pdf->Cell(60,6,'Fin & Acc Manager',10,0,'L',0);
			}else{
			$pdf->Cell(60,6,'Sovialisma, MDS',10,0,'L',0);
			$pdf->Ln(5);
			$pdf->Cell(28,0,'',1,0,'L',1);
			$pdf->Ln(1);
			$pdf->Cell(60,6,'Coll Strata Dept Head',10,0,'L',0);
			}
			
			$pdf->Ln(5);

		
		
			$pdf->Ln(4);
			$pdf->Cell(15,6,'CC',10,0,'L',0);
			$pdf->Cell(9,6,':',10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(15,6,'1. Divisi Legal',10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(15,6,'2. Divisi Accounting & Tax',10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(15,6,'3. Divisi Marketing',10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(15,6,'4. Arsip',10,0,'L',0);
			 $pdf->Ln(7);
   
 $url= "reprint/reminder".$idsp.".pdf";
 $pdf->Output($url);

 redirect($url);
			

