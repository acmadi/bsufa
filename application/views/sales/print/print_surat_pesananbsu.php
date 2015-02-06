<?php
	//die($idnama);
			require('fpdf/tanpapage.php');
			include_once( APPPATH."libraries/translate_currency.php"); 
			
			#Cetak SP
			/*$sql = "select TOP 1 sp_id,subproject_id,nm_subproject,unit_no,no_sp,customer_nama,
					customer_alamat1,id_no,customer_tlp,customer_hp,customer_alamat2,
					tanah,paytipe_nm,amount_bf,
					selling_price,nama,bf,dp,pl,bfdate,pldate,dpdate
					from db_sp a
					LEFT JOIN db_unit_yogya b on(a.id_unit = b.unit_id)
					LEFT JOIN db_customer c on(a.id_customer = c.customer_id)
					LEFT JOIN db_subproject d on(a.id_subproject = d.subproject_id)
					LEFT JOIN db_paytipe e on(a.id_paytipe = e.paytipe_id)
					LEFT JOIN db_kary f on(a.id_sales = f.id_kary)
					order by a.sp_id DESC
			";	*/		 
			#var_dump($idnama);exit;
			
			$rows = $this->db->query("sp_print_suratpesananbdm'".$idnama."'")->row();#$this->db->query($sql)->row();
			//die($rows->sp_id);
			#Variable di surat pesanan
			$idsp = $rows->sp_id;
			
			$project = $rows->nm_subproject;
			$idproject = $rows->subproject_id;
			$nama = $rows->customer_nama;
			#$fax = $rows->customer_fax;
			#var_dump($project);
			$identitasnm = $rows->identitas_nm;
			$unit = $rows->unit_no;
			$nosp = $rows->no_sp;
			#Ambil Lantai11203
			if($idproject == 11204){
				if(strlen($unit) == 6 ){
								$lantai = substr($unit,3,1);
								$unit_type = $rows->unit_type;
				}else{
								$lantai = substr($unit,3,2);
								$unit_type = $rows->unit_type;
				}
							        }
			elseif($idproject == 11214) {
				if(strlen($unit) == 5 ){
								$lantai = substr($unit,2,1);
								$unit_type = $rows->unit_type;
				}else{
								$lantai = substr($unit,2,2);
								$unit_type = $rows->unit_type;
				}
									     } 
			elseif($idproject == 11224) {
				if(strlen($unit) == 7 ){				
								$lantai = substr($unit,4,1);
								$unit_type = $rows->unit_type;
				}elseif (strlen($unit) == 8 ){
							$lantai = substr($unit,4,1);
								$unit_type = $rows->unit_type;
				}else{
								$lantai = substr($unit,4,2);
								$unit_type = $rows->unit_type;
				}
									     } 
			else {
					$lantai = substr($unit,1,2);
					$unit_type = $rows->unit_type;
				 }
							        
			#var_dump($lantai);
			$kode = substr($unit,0,2);
			$alamat1 = $rows->customer_alamat1;
			$alamat2 = $rows->customer_alamat2;			
			$identitas = $rows->id_no;
			$tlp = $rows->customer_tlp;
			$hp = $rows->customer_hp;
			$luas = $rows->tanah;
			$luasbangun = $rows->bangunan;
			#var_dump($luasbangun);
			$hargajual = number_format($rows->selling_price);
			$crabyar = $rows->paytipe_nm;
			$bfdate = indo_date($rows->bfdate);
			$tglsales = indo_date($rows->tgl_sales);
			#var_dump($crabyar);
			
			#Nominal
			$harganominal = toRupiah(replace_numeric($hargajual));
					
			
			
			#kondisi Beda Project
			if($idproject == 41011){ $tipeproject ="UNIT RUMAH";
										$tipeprojdet ="RUMAH";
										$tempat ="Perumahan";
										$luasan ="Luas Tanah / Luas Bangunan";
										#$note ="Pemecahan menjadi Sertifikat Hak Milik atas UNIT RUMAH";
										}
			elseif ($idproject == 11203)  { $tipeproject ="UNIT KANTOR";
										$tipeprojdet ="KANTOR";
										$tempat ="KANTOR";
										$luasan ="Luas Tanah / Luas Bangunan";
										}	
											
											else{ 	$tipeproject ="UNIT APARTEMEN";
													$tipeprojdet = "APARTEMEN";
													$tempat = "Apartemen";
													$luasan ="Luas Semi Gross";}
													#$note ='Ijin Layak Huni atau Ijin Penggunaan Bangunan ("IPB") induk';
			
			
			#Sisa Pelunasan
			$dtpel = $this->db->where('id_sp',$idsp)
							  ->where('id_paygroup',3)
							  ->order_by('id_billing','ASC')
							  ->get('db_billing')->row();
			
			$pldate = indo_date($rows->pldate);
			$dpdate = indo_date($rows->dpdate);
			$sales = $rows->nama;
			$bf = number_format($rows->bf);
			$dp = number_format($rows->dp);
			$pl = number_format($rows->pl);	
			
			/*Pengambilan Bank*/
			$dtbank = $this->db->where('id_subproject',$idproject)
							  // ->where('remark','A/R')
							   ->get('db_bank')->row();
			
			/*Pengecekan Lantai*/
			#if($project=='4102'){
			#	$lantai = substr($unit,5,2);
			#}else{
			#	$lantai = "-";
			#}
			
			/*Cek Cara Bayar*/
			if($crabyar == "Tunai"){
				$tunai = "X";
				$tahap = "";
				$kpa = "";
			}elseif($crabyar == "Tunai Bertahap"){
				$tunai = "";
				$tahap = "X";
				$kpa = "";
			}else{
				$tunai = "";
				$tahap = "";
				$kpa = "X";				
			}			
						
			
							  			
			#Akhir Variable SP#
							
			$pdf=new PDF('P','mm','LEGAL');
			
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage(); 
			//$pdf->SetFont('Arial','B',12);
			$title1 = $project;
			$title2 = 'SURAT PESANAN UNIT  '.$unit.'  ("'.$tipeproject.'")';
			//$sk = 'No. : '.$nosp.'/SP/BSU';
			
			if ($idproject == 11203){
			
			 $sk = 'No. : '.substr($nosp,6,5).'/SP/LS-RE/BSU';
			 }elseif ($idproject == 11224){
			
			 $sk = 'No. : '.substr($nosp,6,5).'/SP/GV-RE/BSU';
			}elseif ($idproject == 11214){
			
			 $sk = 'No. : '.substr($nosp,6,5).'/SP/GV-RE/BSU';
			}elseif ($idproject == 11204){
			
			 $sk = 'No. : '.substr($nosp,6,5).'/SP/GV-RE/BSU';
			}elseif ($idproject == 11202){
			
			 $sk = 'No. : '.substr($nosp,6,5).'/SP/LS-RE/BSU';
			}
			// else{
			// $sk = 'No. : '.substr($nosp,6,4).'/SP/TW-RE/BDM';
			// }
			//$idsp			
			$pdf->SetFont('Arial','B',12);
			$pdf->SetXY(2,16);
			//$pdf->Cell(0,10,$idsp,20,0,'L');
			$pdf->Cell(0,10,$title1,20,0,'L');
			$pdf->SetFont('Arial','B',11);
			$pdf->SetXY(70,16);
			$pdf->Cell(0,10,$title2,20,0,'L');
			$pdf->SetFont('Arial','B',10);
			$pdf->SetXY(90,22);
			$pdf->Cell(0,10,$sk,20,0,'L');

			$y_axis_initial = 38;
			$y_axis = 0;
			
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(2);
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(9,0,'Yang bertanda tangan dibawah ini :',10,0,'L');
			$pdf->Ln(4);
			$pdf->Cell(40,0,'Nama',10,0,'L');
			$pdf->Cell(9,0,':',10,0,'L');
			$pdf->Cell(9,0,$nama,10,0,'L');
			$pdf->Ln(4);
			$pdf->Cell(40,0,'Alamat Identitas',10,0,'L');
			$pdf->Cell(9,0,':',10,0,'L');
			$pdf->Cell(9,0,$alamat1,10,0,'L');
			$pdf->Ln(8);
			$pdf->Cell(40,0,'No. Identitas ('.$identitasnm.')',10,0,'L');
			$pdf->Cell(9,0,':',10,0,'L');
			$pdf->Cell(9,0,$identitas,10,0,'L');
			$pdf->Ln(4);
			$pdf->Cell(40,0,'Telepon',10,0,'L');
			$pdf->Cell(9,0,':',10,0,'L');
			$pdf->Cell(9,0,$tlp,10,0,'L');
			$pdf->Ln(4);
			$pdf->Cell(40,0,'Hand Phone',10,0,'L');
			$pdf->Cell(9,0,':',10,0,'L');
			$pdf->Cell(9,0,$hp,10,0,'L');
			$pdf->Ln(4);
			$pdf->Cell(40,0,'Facsimile',10,0,'L');
			$pdf->Cell(9,0,':',10,0,'L');
			$pdf->Cell(9,0,'',10,0,'L');
			$pdf->Ln(4);
			$pdf->Cell(40,0,'Alamat Korespondensi',10,0,'L');
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(5,0,':',7,0,'L');
			$pdf->Cell(9,0,$alamat2,10,0,'L');
			$pdf->SetFont('Arial','',10);
			
		
			$a = "PEMESAN";
			$pdf->SetFont('Arial','',10);
			$pdf->Ln(8);
			$pdf->Cell(35,0,'(selanjutnya disebut ',10,0,'L');
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(15,0,'"'.$a.'"',10,0,'L');
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(10,0,')',10,0,'R');
			
			$pdf->SetFont('Arial','',9);
			
			/*
			$text = '
			dengan ini menyatakan sepakat dan setuju untuk memesan UNIT APARTEMEN di THE GROVE SUITES ("APARTEMENT")
			dari PT. BAKRIE SWASAKTI UTAMA yang berkedudukan di Jakarta ("PENERIMA PESANAN") dan PEMESAN wajib tunduk
			pada Syarat-syarat dan Ketentuan-ketentuan pemesanan sebagaimana ketentuan SURAT PESANAN (terlampir).

    ';
    //The first param should be the width of text area
    //0 value will make the FPDF automate the width
    //The second param is the line spacing for this paragraph
    //The third param is the text
    //$pdf->MultiCell(0,0.5,);
			
	$pdf->MultiCell(200,0,$text,10,0,'L');	
				*/
			
			
			if($idproject == 41011){	
				$pdf->Ln(4);
				$pdf->Cell(40,0,'dengan ini menyatakan sepakat dan setuju untuk  memesan '.$tipeproject.'  di '.$project.' ("'.$tipeprojdet.'")dari PT. BAKRIE SWASAKTI UTAMA',10,0,'L');	
			
			#end header
				$pdf->Ln(4);
				$pdf->Cell(40,0,'yang berkedudukan di Jakarta ("PENERIMA PESANAN") dan PEMESAN  wajib tunduk  pada Syarat-syarat dan  Ketentuan-ketentuan Pemesanan  ',10,0,'L');	
			
				$pdf->Ln(4);
				$pdf->Cell(40,0,'sebagaimana ketentuan SURAT PESANAN  (terlampir).',10,0,'L');}
					else{ 	$pdf->Ln(4);
							$pdf->Cell(40,0,'dengan ini menyatakan sepakat dan setuju untuk memesan '.$tipeproject.' di '.$project.' ("'.$tipeprojdet.'") dari PT. BAKRIE ',10,0,'L');	
			
							#end header
							$pdf->Ln(4);
							$pdf->Cell(40,0,'SWASAKTI UTAMA  yang berkedudukan  di Jakarta  ("PENERIMA PESANAN")  dan   PEMESAN   wajib  tunduk  pada Syarat-syarat dan  Ketentuan-  ',10,0,'L');	
			
							$pdf->Ln(4);
							$pdf->Cell(40,0,'ketentuan Pemesanan sebagaimana ketentuan SURAT PESANAN  (terlampir).',10,0,'L');}

						
			
			$pdf->Ln(7);
			$pdf->Cell(40,0,$tipeproject.' yang  dipesan oleh  PEMESAN  yang terletak di  Kel. Karet Kuningan, Kec. Setiabudi, Kotamadya Jakarta Selatan dengan',10,0,'L');	
			$pdf->Ln(4);
			$pdf->Cell(40,0,'uraian sebagai berikut :',10,0,'L');	
			
			if($idproject == 11203){
			$pdf->Ln(4);
			$pdf->Cell(45,0,'Peruntukan',10,0,'L');
			$pdf->Cell(9,0,':',10,0,'L');
			$pdf->Cell(9,0,'Kantor',10,0,'L');
			$pdf->Ln(4);
			$pdf->Cell(45,0,$tempat,10,0,'L');
			$pdf->Cell(9,0,':',10,0,'L');
			$pdf->Cell(9,0,$project,10,0,'L');
			$pdf->Ln(4);}
			else {
			$pdf->Ln(4);
			$pdf->Cell(45,0,'Peruntukan',10,0,'L');
			$pdf->Cell(9,0,':',10,0,'L');
			$pdf->Cell(9,0,'Apartemen',10,0,'L');
			$pdf->Ln(4);
			$pdf->Cell(45,0,$tempat,10,0,'L');
			$pdf->Cell(9,0,':',10,0,'L');
			$pdf->Cell(9,0,$project,10,0,'L');
			$pdf->Ln(4);}
			
			#LUASAN
			
			if($idproject == 41011){
						$pdf->Cell(45,0,'Luas Tanah / Luas Bangunan',10,0,'L');
						$pdf->Cell(9,0,':',10,0,'L');
						$pdf->Cell(23,0,$luas.' M2 / '.$luasbangun.' M2',10,0,'L');}
							else { 
									$pdf->Cell(45,0,'Lantai',10,0,'L');
									$pdf->Cell(9,0,':',10,0,'L');
									$pdf->Cell(6,0,$lantai,10,0,'L');
									$pdf->Cell(7,0,'Tipe',10,0,'L');
									$pdf->Cell(4,0,':',10,0,'L');
									$pdf->Cell(4,0,$unit_type,10,0,'L');
								}
			$pdf->Ln(4);
			if($idproject == 41011){
			
					$pdf->Cell(45,0,'Harga Jual (Incl. PPN )',10,0,'L');
					$pdf->Cell(9,0,':',10,0,'L');
					$pdf->Cell(30,0,'Rp. '.$hargajual,10,0,'L');
					$pdf->SetFont('Arial','',6);
					$pdf->Cell(40,0,'('.$harganominal.' rupiah)',10,0,'L');
					$pdf->SetFont('Arial','',9);	
						}else{
							$pdf->Cell(45,0,'Luas Semi Gross',10,0,'L');
							$pdf->Cell(9,0,':',10,0,'L');
							$pdf->Cell(23,0,$luasbangun.' M2',10,0,'L');}
							
			
			$pdf->Ln(4);
			if($idproject == 41011){
			
			#awal cara bayar
					
			$pdf->Cell(45,0,'Cara Pembayaran',10,0,'L');
			$pdf->Cell(9,0,':',10,0,'L');
			$pdf->Cell(6,0,'[ '.$tunai.' ] ',10,0,'L');
			$pdf->Cell(40,0,'Tunai',10,0,'L');
			$pdf->Cell(6,0,'[ '.$tahap.' ]',10,0,'L');
			$pdf->Cell(40,0,'Bertahap',10,0,'L');
			$pdf->Cell(6,0,'[ '.$kpa.' ]',10,0,'L');
			$pdf->Cell(40,0,'Kredit Lembaga Keuangan',10,0,'L');}
					else{
						$pdf->Cell(45,0,'Harga Jual (Incl. PPN )',10,0,'L');
						$pdf->Cell(9,0,':',10,0,'L');
						$pdf->Cell(30,0,'Rp. '.$hargajual,10,0,'L');
						$pdf->SetFont('Arial','',6);
						$pdf->Cell(40,0,'('.$harganominal.' rupiah)',10,0,'L');
						$pdf->SetFont('Arial','',9);
							$pdf->Ln(4);
							$pdf->Cell(45,0,'Cara Pembayaran',10,0,'L');
							$pdf->Cell(9,0,':',10,0,'L');
							$pdf->Cell(6,0,'[ '.$tunai.' ] ',10,0,'L');
							$pdf->Cell(40,0,'Tunai',10,0,'L');
							$pdf->Cell(6,0,'[ '.$tahap.' ]',10,0,'L');
							$pdf->Cell(40,0,'Bertahap',10,0,'L');
							$pdf->Cell(6,0,'[ '.$kpa.' ]',10,0,'L');
							$pdf->Cell(40,0,'Kredit Lembaga Keuangan',10,0,'L');}
					
			
			#akhir cara bayar
			$pdf->Ln(7);
			$pdf->Cell(30,0,'PEMESAN berkewajiban untuk membayar Harga Jual dengan cara pembayaran sebagai berikut :',10,0,'L');
			
			$pdf->Ln(4);
			
			$pdf->Cell(9,6,'No.',10,0,'L',0);
			$pdf->Cell(21,6,'KETERANGAN',10,0,'L',0);
			$pdf->Cell(21,6,'',10,0,'L',0);
			$pdf->Cell(45,6,'TANGGAL JATUH TEMPO',10,0,'L',0);
			$pdf->Cell(45,6,'',10,0,'C',0);
			$pdf->Cell(15,6,'JUMLAH',10,0,'R',0);
			
			$pdf->Ln();
			
			$pdf->Cell(9,0,'',1,0,'L',1);
			$pdf->Cell(21,0,'',1,0,'L',1);
			$pdf->Cell(21,0,'',1,0,'L',1);
			$pdf->Cell(45,0,'',1,0,'L',1);
			$pdf->Cell(45,0,'',1,0,'C',1);
			$pdf->Cell(56,0,'',1,0,'R',1);
		$pdf->Ln(2);
		
			$pdf->Cell(9,6,'1.',10,0,'L',0);
			$pdf->Cell(30,6,'Uang Tanda jadi',10,0,'L',0);
			$pdf->Cell(12,6,':',10,0,'L',0);
			$pdf->Cell(45,6,$bfdate,10,0,'L',0);
			$pdf->Cell(45,6,'Rp.',10,0,'C',0);
			$pdf->Cell(15,6,$bf,10,0,'R',0);
			$pdf->Cell(45,6,'('.ucwords(toRupiah($rows->bf)).' Rupiah)',10,0,'L',0);
		$pdf->Ln(4);
		
			$pdf->Cell(9,6,'2.',10,0,'L',0);
			$pdf->Cell(30,6,'Uang Muka',10,0,'L',0);
			$pdf->Cell(12,6,':',10,0,'L',0);
			$pdf->Cell(45,6,'Berdasarkan BILLING SCHEDULE terlampir',10,0,'L',0);
			#$pdf->Cell(45,6,'Rp.',10,0,'C',0);
			#$pdf->Cell(15,6,$dp,10,0,'R',0);
		$pdf->Ln(4);
		
			$pdf->Cell(9,6,'3.',10,0,'L',0);
			$pdf->Cell(30,6,'Sisa Pelunasan',10,0,'L',0);
			$pdf->Cell(12,6,':',10,0,'L',0);
			$pdf->Cell(45,6,'Berdasarkan BILLING SCHEDULE terlampir',10,0,'L',0);
			#$pdf->Cell(45,6,'Rp.',10,0,'C',0);
			#$pdf->Cell(15,6,$pl,10,0,'R',0);
			
		
			##Cek nilai untuk angsuran###
			$xdt = $this->db->select('count(id_billing) as angsur')
							   ->where('id_paygroup',3)
							   ->where('id_sp',$idsp)
							   ->get('db_billing')->row();
			#$tgl = substr($pldate,0,2);
			#		var_dump($tgl);				   
			##End nilai angsuran###
			if($crabyar == "Tunai Bertahap"){
					#Tanggal Angsuran
					$tgl = substr($pldate,0,2);
					#End
					$pdf->Ln(4);
					$pdf->Cell(9,6,'',10,0,'L',0);
					$pdf->Cell(30,6,'Diangsur Selama',10,0,'L',0);
					$pdf->Cell(12,6,':',10,0,'L',0);
					$pdf->Cell(45,6,$xdt->angsur.' Bulan berturut-turut pada setiap tanggal :',10,0,'L',0);
					$pdf->Cell(45,6,$tgl,10,0,'C',0);
					$pdf->Cell(15,6,'',10,0,'R',0);
					$pdf->Ln(4);
		
						$pdf->Cell(9,6,'',10,0,'L',0);
						$pdf->Cell(30,6,'Angsuran Per Bulan',10,0,'L',0);
						$pdf->Cell(12,6,':',10,0,'L',0);
						$pdf->Cell(45,6,'Rp. '.number_format($dtpel->amount),10,0,'L',0);
						$pdf->Cell(45,6,'',10,0,'C',0);
						$pdf->Cell(15,6,'',10,0,'R',0);}
			
			
			$pdf->Ln(7);
			$pdf->Cell(55,6,'Rekening PENERIMA PESANAN :',10,0,'L',0);
			$pdf->Cell(20,6,'Bank',10,0,'L',0);
			$pdf->Cell(12,6,':',10,0,'L',0);
			$pdf->Cell(12,6,$dtbank->bank_nm,10,0,'L',0);
			
			$pdf->Ln(4);
			$pdf->Cell(55,6,'',10,0,'L',0);
			$pdf->Cell(20,6,'Cabang',10,0,'L',0);
			$pdf->Cell(12,6,':',10,0,'L',0);
			$pdf->Cell(12,6,$dtbank->bank_cabang,10,0,'L',0);
			
			$pdf->Ln(4);
			$pdf->Cell(55,6,'',10,0,'L',0);
			$pdf->Cell(20,6,'No. Rekening',10,0,'L',0);
			$pdf->Cell(12,6,':',10,0,'L',0);
			$pdf->Cell(12,6,$dtbank->bank_acc,10,0,'L',0);
			
		
			
			if($idproject == 41011){
					$pdf->Ln(4);
					$pdf->Cell(55,6,'PENERIMA PESANAN dengan ini berjanji dan mengikatkan diri untuk menyelesaikan pembangunan UNIT RUMAH selama 12 (dua belas) bulan  ',10,0,'L',0);
					$pdf->Ln(4);
					$pdf->Cell(55,6,'sejak tanggal Pelunasan UANG MUKA ("TANGGAL SELESAI PEMBANGUNAN")',10,0,'L',0);}
			elseif($idproject == 11203){
					$pdf->Ln(4);
					$pdf->Cell(55,6,'PENERIMA PESANAN dengan ini berjanji dan mengikatkan diri untuk menyelesaikan pembangunan UNIT KANTOR selama 12 (dua belas) bulan  ',10,0,'L',0);
					$pdf->Ln(4);
					$pdf->Cell(55,6,'sejak tanggal Pelunasan UANG MUKA ("TANGGAL SELESAI PEMBANGUNAN")',10,0,'L',0);}
						else {
								$pdf->Ln(4);
								$pdf->Cell(55,6,'PENERIMA  PESANAN  dengan   ini  berjanji  dan  mengikatkan  diri untuk  menyelesaikan  pembangunan    UNIT  APARTEMEN   pada  tanggal  ',10,0,'L',0);
								$pdf->Ln(4);
								if ($idproject == 3102){
								$pdf->Cell(55,6,'30 April 2014 ("TANGGAL SELESAI PEMBANGUNAN").',10,0,'L',0);
								}else{
								$pdf->Cell(55,6,'31 Desember 2014 ("TANGGAL SELESAI PEMBANGUNAN").',10,0,'L',0);
								}
								}
			
			$pdf->Ln(7);
			$pdf->Cell(55,6,'Harga Jual termasuk:',10,0,'L',0);
			
			$pdf->Ln(4);
			$pdf->Cell(4,6,'-',10,0,'L',0);
			$pdf->Cell(110,6,'Pajak Pertambahan Nilai ("PPN")',10,0,'L',0);
			$pdf->Cell(4,6,'-',10,0,'L',0);
			$pdf->Cell(12,6,'Jaringan air bersih',10,0,'L',0);
			
			if($idproject == 41011){
			$pdf->Ln(4);
			$pdf->Cell(4,6,'-',10,0,'L',0);
			$pdf->Cell(110,6,'Pemecahan menjadi Sertipikat Hak Guna Bangunan atas UNIT RUMAH',10,0,'L',0);
			$pdf->Cell(4,6,'-',10,0,'L',0);
			$pdf->Cell(12,6,'Jaringan telepon',10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(4,6,'',10,0,'L',0);
			$pdf->Cell(110,6,'',10,0,'L',0);
			$pdf->Cell(4,6,'-',10,0,'L',0);
			$pdf->Cell(12,6,'Jaringan listrik',10,0,'L',0);}
				else{
						$pdf->Ln(4);
						$pdf->Cell(4,6,'-',10,0,'L',0);	
						$pdf->Cell(110,6,'Ijin Mendirikan Bangunan ("IMB") Induk',10,0,'L',0);
						$pdf->Cell(4,6,'-',10,0,'L',0);
						$pdf->Cell(12,6,'Jaringan telepon',10,0,'L',0);
						$pdf->Ln(4);
						$pdf->Cell(4,6,'-',10,0,'L',0);
						$pdf->Cell(110,6,'Ijin Layak Huni atau Ijin Penggunaan Bangunan ("IPB") Induk',10,0,'L',0);
						$pdf->Cell(4,6,'-',10,0,'L',0);
						$pdf->Cell(12,6,'Jaringan listrik',10,0,'L',0);
						$pdf->Ln(4);
						$pdf->Cell(4,6,'-',10,0,'L',0);
						$pdf->Cell(110,6,'Pemecahan Sertipikat Hak Milik atas Satuan Rumah Susun ("SHMSRS")',10,0,'L',0);}
			
		
			
			
			
			
			#if($idproject == 41012){
			#		}
					#$pdf->Cell(4,6,'',10,0,'L',0);
			#$pdf->Cell(12,6,'',10,0,'L',0);
			
			$pdf->Ln(7);
			$pdf->Cell(55,6,'Harga Jual atas '.$tipeproject.' belum termasuk :',10,0,'L',0);
			
			
			$pdf->Ln(4);
			$pdf->Cell(4,6,'-',10,0,'L',0);
			$pdf->Cell(100,6,'Perjanjian Pengikatan Jual Beli ("PPJB") dihadapan Notaris.',10,0,'L',0);
			
			
			if($idproject == 41011){
					$pdf->Cell(4,6,'-',10,0,'L',0);
					$pdf->Cell(12,6,'Pengecekan Sertipikat Hak Guna Bangunan atas UNIT RUMAH',10,0,'L',0);}
						else{
							$pdf->Cell(4,6,'-',10,0,'L',0);
							$pdf->Cell(12,6,'Pengecekan SHMSRS',10,0,'L',0);}
			
			
			
			if($idproject == 41011){
					$pdf->Ln(4);
					$pdf->Cell(4,6,'-',10,0,'L',0);
					$pdf->Cell(100,6,'Ijin Mendirikan Bangunan ("IMB")',10,0,'L',0);}
						else{
								$pdf->Ln(4);
								$pdf->Cell(4,6,'-',10,0,'L',0);
								$pdf->Cell(100,6,'Bea Perolehan Hak atas Tanah dan Bangunan',10,0,'L',0);}
								
			$pdf->Cell(4,6,'-',10,0,'L',0);
			$pdf->Cell(12,6,'Pajak-pajak yang ditentukan oleh Pemerintah Republik Indonesia',10,0,'L',0);
			
			$pdf->Ln(4);
			$pdf->Cell(4,6,'-',10,0,'L',0);
			$pdf->Cell(100,6,'Akta Jual Beli ("AJB") di hadapan Notaris/PPAT',10,0,'L',0);
			$pdf->Cell(4,6,'-',10,0,'L',0);
			$pdf->Cell(12,6,'Biaya-biaya lain yang ditentukan di dalam PPJB',10,0,'L',0);
			
			if($idproject == 41011){
					$pdf->Ln(4);
					$pdf->Cell(4,6,'-',10,0,'L',0);
					$pdf->Cell(100,6,'Biaya Balik nama Sertipikat Hak Guna Bangunan ke atas nama PEMESAN',10,0,'L',0);}
					else {
						$pdf->Ln(4);
						$pdf->Cell(4,6,'-',10,0,'L',0);
						$pdf->Cell(100,6,'Biaya Balik nama SHMSRS ke atas nama PEMESAN',10,0,'L',0);}
			
			$pdf->Ln(4);
			$pdf->Cell(4,6,'-',10,0,'L',0);
			$pdf->Cell(100,6,"Pajak Bumi & Bangunan ('PBB')",10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(4,6,'-',10,0,'L',0);
			$pdf->Cell(110,6,"Pajak Penjualan atas Barang Mewah ('PpnBM')",10,0,'L',0);
			
			$pdf->Ln(7);
			$pdf->Cell(55,6,'Dengan ditandatanganinya SURAT PESANAN ini, maka   PEMESAN   mengakui   dan   menyetujui   segala  Syarat-syarat,  ketentuan-ketentuan  ',10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(55,6,'sebagaimana terlampir yang ditetapkan dalam SURAT PESANAN ini.',10,0,'L',0);
		
			
			$pdf->Ln(7);
			$pdf->Cell(55,6,'Jakarta, '.indo_date($tglsales),10,0,'L',0);
			
			$pdf->Ln(7);
			$pdf->Cell(60,6,'Penerima Pesanan',10,0,'L',0);
			$pdf->Cell(60,6,'PEMESAN',10,0,'L',0);
			$pdf->Cell(60,6,'Sales',10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(60,6,'PT. BAKRIE SWASAKTI UTAMA',10,0,'L',0);
			
			$pdf->Ln(30);
			
		//	$pdf->Cell(60,6,'Reynold Marnaek',10,0,'L',0);
			#$pdf->Cell(60,6,'Andre R Makalam',10,0,'L',0);
			//$pdf->Cell(60,6,'Indra Gunawan',10,0,'L',0);
			$pdf->Cell(60,6,'Dodi P. Siregar',10,0,'L',0);
			//$pdf->Cell(60,6,'Ferry S. Supandji',10,0,'L',0);
			$pdf->Cell(60,6,substr($nama,0,29),10,0,'L',0);
			$pdf->Cell(60,6,$sales,10,0,'L',0);
			
			$pdf->Ln(5);

			$pdf->SetX(61);
					
			$pdf->Cell(60,6,substr($nama,29,27),10,0,'L',0);
			//$pdf->Cell(60,6,substr($nama,27,27),10,0,'L',0);
			
			$pdf->Ln(4);
			$pdf->Cell(60,6,'SYARAT-SYARAT & KETENTUAN-KETENTUAN PEMESANAN dan BILLING SCHEDULE terlampir sebagai satu kesatuan dan bagian integral yang',10,0,'L',0);
			
			$pdf->Ln(4);
			$pdf->Cell(60,6,'tidak terpisahkan dari SURAT PESANAN ini.',10,0,'L',0);
			
		
			$pdf->Ln(4);
			$pdf->Cell(15,6,'Putih',10,0,'L',0);
			$pdf->Cell(9,6,':',10,0,'L',0);
			$pdf->Cell(15,6,'PEMESAN',10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(15,6,'Kuning',10,0,'L',0);
			$pdf->Cell(9,6,':',10,0,'L',0);
			$pdf->Cell(15,6,'Finance',10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(15,6,'Hijau',10,0,'L',0);
			$pdf->Cell(9,6,':',10,0,'L',0);
			$pdf->Cell(15,6,'Legal',10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(15,6,'Biru',10,0,'L',0);
			$pdf->Cell(9,6,':',10,0,'L',0);
			$pdf->Cell(15,6,'Sales',10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(15,6,'Merah',10,0,'L',0);
			$pdf->Cell(9,6,':',10,0,'L',0);
			$pdf->Cell(15,6,'Administrasi',10,0,'L',0);
			 $pdf->Ln(7);
   /* $pdf->SetFont('Arial','B'.'U',9);
	$pdf->Cell(0,10,'SYARAT-SYARAT KETENTUAN-KETENTUAN PEMESANAN:',20,0,'L');
	$pdf->Ln(4);
    	$pdf->SetFont('Arial','',7);
			#end header
			//$pdf->AddPage();

    //You may set the margin (optional)
    //The first param is the left margin
    //The second param is the top margin
    //The third param is the right margin
    //The fourth param is the bottom margin
   // $pdf->SetMargins(1,1,1,1);
$pdf->SetX(2);
				//$pdf->Ln(16);
			 $text1 = '
1. Besarnya HARGA JUAL dan tahapan pembayaran yang wajib dilakukan oleh PEMESAN kepada PENERIMA PESANAN adalah sebagaimana ketentuan SURAT PESANAN.
2. PEMESAN wajib melunasi setiap pembayaran dengan jumlah yang telah ditentukan (tidak kurang dan tanpa otongan apapun) dan tepat waktu, baik untuk
    pembelian secara tunai, bertahap atau angsuran melalui pihak ketiga termasuk Lembaga Keuangan.
3. Apabila PEMESAN telah membayar Uang Tanda Jadi sebelum menandatangani PPJB, PEMESAN ternyata tidak atau terlambat melaksanakan kewajiban pembayaran
    berikutnya karena sebab atau alasan apapun juga, maka dengan lampaunya waktu saja sudah cukup membuktikan bahwa PEMESAN atas kehendaknya
    sendiri mengundurkan diri sebagai PEMESAN. Dengan demikian Surat Pesanan berakhir tanpa diperlukan pemberitahuan terlebih dahulu serta seluruh pembayaran
    yang telah dibayar oleh PEMESAN tidak dapat ditarik kembali (dikembalikan) karena sebab atau alasan apapun sehingga menjadi hak PENERIMA PESANAN sepenuhnya.
4. Semua pembayaran yang dilakukan oleh PEMESAN kepada PENERIMA PESANAN berdasarkan SURAT PESANAN harus dibayarkan ke REKENING BANK PENERIMA
    PESANAN sebagaimana ketentuan SURAT PESANAN atau ke rekening lainnya sebagaimana yang ditentukan dan diberitahukan oleh PENERIMA PESANAN
    kemudian. Bukti transfer wajib dikirim langsung atau melalui facsimile kepada PENERIMA PESANAN, keterlambatan pembayaran ataupun akibat lainnya yang
    mungkin timbul disebabkan karena kesalahan transfer melalui bank menjadi tanggung jawab PEMESAN.
5. Bila terdapat penolakan cek atau bilyet giro dari bank yang bersangkutan, maka PEMESAN dikenakan denda sebesar Rp. 100.000,- (seratus ribu rupiah) setiap kali
    penolakan dan wajib segera dibayarkan kepada PENERIMA PESANAN.
6. Mengenai penggunaan fasilitas kredit dari Lembaga Keuangan :
    a. PEMESAN wajib membayar Uang Muka dalam jumlah dan cara pembayaran sebagaimana tercantum dalam Surat Pesanan sekalipun PEMESAN belum
    b. PEMESAN bertanggung jawab penuh atas seluruh proses, persyaratan, dan administrasi yang disyaratkan oleh Lembaga Keuangan sehingga segala
        memperoleh persetujuan atas permohonan fasilitas kredit dari Lembaga Keuangan.
        akibat dan resiko yang berkaitan dengan penolakan permohonan fasilitas kredit kepada PEMESAN merupakan beban tanggung jawab PEMESAN
        sepenuhnya serta tidak dapat dikaitkan dan dibebankan kepada PENERIMA PESANAN karena sebab atau alasan apapun.
    c. Pembayaran sisa HARGA JUAL sebagaimana ketentuan SURAT PESANAN wajib dibayarkan oleh PEMESAN sesuai dengan ketentuan yang disepakati oleh
        dan antara LEMBAGA KEUANGAN dan PENERIMA PESANAN;
    d. PEMESAN wajib memberitahukan PENERIMA PESANAN mengenai perolehan persetujuan fasilitas kredit dari LEMBAGA KEUANGAN dan pelaksanaan akad
        kredit antara PEMESAN dan LEMBAGA KEUANGAN sehubungan dengan pembelian UNIT APARTEMEN;
    e. Apabila LEMBAGA KEUANGAN tidak memberikan persetujuan fasilitas kredit kepada PEMESAN, atau PEMESAN dan LEMBAGA KEUANGAN tidak menandatangani
        akad kredit selambat-lambatnya 15 (lima belas) hari kalender terhitung sejak pembayaran Uang Muka sebagaimana ketentuan SURAT PESANAN, maka
        PEMESAN diberikan kesempatan dalam jangka waktu 15 (lima belas) hari kalender sejak terlampauinya jangka waktu pelunasan sisa HARGA JUAL sebagaimana
        ketentuan SURAT PESANAN tersebut untuk melakukan pelunasan sendiri atas sisa HARGA JUAL secara tunai keras dan apabila dalam jangka waktu tersebut,
        PEMESAN tidak melunasi HARGA JUAL, maka PENERIMA PESANAN berhak mengakhiri SURAT PESANAN, serta seluruh pembayaran yang telah dibayar
        oleh PEMESAN tidak dapat ditarik kembali (dikembalikan) karena sebab atau alasan apapun dan menjadi hak PENERIMA PESANAN sepenuhnya.
    f. Apabila pemberian fasilitas kredit yang diberikan oleh LEMBAGA KEUANGAN kepada PEMESAN tidak sesuai dengan jumlah pelunasan sisa HARGA JUAL
        sebagaimana ketentuan SURAT PESANAN, maka PEMESAN wajib menambah Uang Muka kepada PENERIMA PESANAN secara tunai keras;
7. Mengenai Denda Keterlambatan :
    a. Apabila PEMESAN dengan alasan apapun terlambat atau kurang membayar sisa HARGA JUAL sebagaimana ketentuan SURAT PESANAN, maupun pembayaran
        lainnya berdasarkan SURAT PESANAN, pada tanggal jatuh tempo yang telah ditentukan sebagaimana ketentuan SURAT PESANAN, maka PEMESAN dikenakan
        denda keterlambatan pembayaran sebesar 1‰ (satu permil) perhari dari jumlah yang harus dibayar, denda mana wajib dibayar oleh PEMESAN terhitung 1 (satu)
        hari kalender sejak jatuh temponya pembayaran sampai dengan tanggal seluruh jumlah pembayaran tersebut beserta dendanya dibayar lunas (selanjutnya disebut
        "DENDA PEMESAN").
    b. Perhitungan DENDA PEMESAN akan dikenakan secara pro rata sesuai dengan jumlah hari terlambat membayar dengan perhitungan 30 (tiga puluh) hari kalender
        untuk setiap bulan.
    c. Apabila PEMESAN lalai memenuhi kewajiban pembayaran HARGA JUAL dan/atau DENDA PEMESAN sampai dengan 30 (tiga puluh) hari kalender terhitung dari tanggal
        yang seharusnya dibayarkan, maka PENERIMA PESANAN berhak memutuskan SURAT PESANAN ini, serta setiap dan seluruh pembayaran yang
		      telah diterima oleh PENERIMA PESANAN adalah menjadi hak PENERIMA PESANAN, tanpa adanya kewajiban pengembalian kepada PEMESAN.
	    d. Ketentuan mengenai denda keterlambatan penyelesaian pembangunan dan penyerahan fisik UNIT APARTEMEN akan diatur lebih lanjut dalam PPJB.
8. Mengenai Pemutusan :
    Dalam hal pengakhiran Surat Pesanan karena alasan dan sebab apapun, PENERIMA PESANAN dan PEMESAN sepakat untuk tidak memberlakukan
	  ketentuan Pasal 1266 dan Pasal 1267 Kitab Undang-undang Hukum Perdata.
9. Mengenai Pengalihan :
    a. Sebelum penandatanganan AJB, PEMESAN dapat mengalihkan seluruh atau sebagian hak atas UNIT APARTEMEN setelah PEMESAN menandatangani PPJB
    b. Apabila hal tersebut dilanggar, maka untuk setiap pengalihan hak dan kewajiban dianggap tidak sah dan segala akibat (konsekuensi hukum) yang timbul,
        dan telah memenuhi pembayaran minimal sebesar 35% (tiga puluh lima persen) dari HARGA JUAL, serta memperoleh persetujuan tertulis dari PENERIMA PESANAN.
        termasuk namun tidak terbatas karena ketentuan perpajakan, sepenuhnya menjadi beban dan tanggung jawab PEMESAN.
    c. Pengalihan hak dan kewajiban untuk yang pertama kalinya, PEMESAN tidak dikenakan biaya administrasi, tetapi terhadap pengalihan hak dan kewajiban yang
        kedua kali dan selanjutnya akan dikenakan biaya administrasi sebesar 2,5% (dua koma lima perseratus) dari HARGA JUAL dan untuk pengalihan dari PEMESAN
        kepada ayah, ibu, anak, suami, istri, atau pengalihan karena pewarisan dikenakan biaya adminstrasi sebesar Rp. 1.000.000,- (satu juta rupiah).
    d. Biaya-biaya yang timbul sehubungan dengan pengalihan hak dan kewajiban kepada pihak ketiga sepenuhnya menjadi tanggungan PEMESAN.
10. Mengenai Serah Terima :
    a. PENERIMA PESANAN dengan ini berjanji dan mengikatkan diri untuk menyelesaikan pembangunan UNIT APARTEMEN pada tanggal 31 Maret 2009 ( "TANGGAL
        SELESAI PEMBANGUNAN")
    b. Yang dimaksudkan dengan penyelesaian pembangunan APARTEMENT dan UNIT APARTEMEN adalah bahwa APARTEMEN dan UNIT APARTEMEN tersebut secara
        teknis telah diselesaikan pembangunannya, berada dalam keadaan baik dan layak huni, serta Izin Layak Huni atau Izin Penggunaan Bangunan dari Gubernur telah
        dimohonkan/diproses.
    c. PENERIMA PESANAN akan menyerahkan fisik UNIT APARTEMEN kepada PEMESAN selambat-lambatnya 180 (seratus delapan puluh) hari kerja terhitung sejak TANGGAL
        SELESAI PEMBANGUNAN serta ILH atau IPB yang dibutuhkan telah terbit dari instansi pemerintah yang berwenang ("PERKIRAAN TANGGAL SERAH TERIMA")
        , dengan ketentuan PEMESAN tidak lalai dalam memenuhi kewajiban-kewajibannya berdasarkan SURAT PESANAN, termasuk tetapi tidak terbatas pada pelunasan
        HARGA JUAL.
    d. Bilamana oleh sebab apapun, kecuali oleh sebab-sebab sebagaimana ketentuan Force Majeure dalam PPJB ternyata PENERIMA PESANAN tidak dapat menyerahkan
        UNIT APARTEMEN setelah PERKIRAAN TANGGAL SERAH TERIMA, maka PENERIMA PESANAN dikenakan denda keterlambatan sebesar 1‰ (satu permil) perhari
        dari pembayaran HARGA JUAL yang telah diterima oleh PENERIMA PESANAN dengan jumlah denda maksimal sebesar 3% (tiga persen) dari pembayaran HARGA
        JUAL yang telah diterima oleh PENERIMA PESANAN ("DENDA PENERIMA PESANAN").
    e. Apabila dalam jangka waktu 14 (empat belas) hari kalender setelah tanggal PEMBERITAHUAN SERAH TERIMA dikirimkan, tetapi PEMESAN tidak menandatangani
        Berita Acara Serah Terima atas UNIT APARTEMEN (selanjutnya disebut "BAST") karena sebab/alasan apapun, maka PEMESAN menyetujui bahwa penyerahan UNIT
        APARTEMEN telah dilakukan terhitung pada hari kalender ke 15 (lima belas) setelah tanggal PEMBERITAHUAN SERAH TERIMA dikirimkan kepada PEMESAN, dan
        dalam hal demikian bukti pengiriman surat PEMBERITAHUAN SERAH TERIMA sudah merupakan bukti sah dilakukannya serah terima atas UNIT APARTEMEN, maka
        dalam hal demikian bukti pengiriman surat PEMBERITAHUAN SERAH TERIMA sudah merupakan bukti sah dilakukannya serah terima atas UNIT APARTEMEN, maka
        resiko-resiko atas UNIT APARTEMEN beralih kepada PEMESAN, dan PENERIMA PESANAN tidak mempunyai tanggung jawab lagi terhadap UNIT APARTEMEN.
11. a. UNIT APARTEMEN yang telah dipesan tidak dapat ditukar dengan unit lain, kecuali mendapat persetujuan tertulis dari PENERIMA PESANAN.
    b. PENERIMA PESANAN bertanggung jawab menyelesaikan UNIT APARTEMEN dalam kondisi baik dan layak huni.
    c. PEMESAN wajib menggunakan / memanfaatkan UNIT APARTEMEN sesuai dengan peruntukannya, yakni untuk hunian (APARTEMEN).
12. Perubahan Konstruksi, Tata Letak dan Design :
    a. Dalam hal sepanjang masa pembangunan, bilamana terjadi perubahan pada UNIT APARTEMEN yang menyebabkan tata letak, design dan/atau luas UNIT
        APARTEMEN berubah atau ditiadakan, termasuk dalam hal perubahan rencana APARTEMEN itu mengakibatkan perubahan letak , misalnya lift dan escalator
        yang semula berada di muka atau di samping UNIT PESANAN atau untuk kepentingan bersama lainnya, maka PENERIMA PESANAN akan memberitahukan kepada
        PEMESAN dan PEMESAN diberikan pilihan untuk tetap pada UNIT APARTEMEN semula atau menerima unit pesanan lainnya sebagai pengganti (jika unit pengganti masih
        tersedia), dan PEMESAN dan PENERIMA PESANAN sepakat untuk memperhitungkan kemudian atau menyesuaikan Harga Jual UNIT APARTEMEN atau unit pengganti.
    b. Apabila PEMESAN tidak menyetujui untuk tetap pada UNIT APARTEMEN semula atau penggantinya, maka PENERIMA PESANAN akan mengembalikan pembayaran
        Harga Jual yang telah diterima oleh PENERIMA PESANAN tanpa disertai bunga, denda maupun segala bentuk ganti rugi lainnya, setelah dikurangi dengan
13. PEMESAN wajib menandatangani PPJB selambat-lambatnya 60 (enam puluh) hari kalender terhitung sejak tanggal Surat Pesanan, apabila dengan alasan apapun
      pajak-pajak dan kewajiban lain (apabila ada).
      juga PEMESAN tidak/belum menandatangani PPJB, maka PEMESAN tidak diperbolehkan melakukan serah terima fisik UNIT APARTEMEN, mengalihkan hak dan
      kewajiban kepada pihak lain, menandatangani AJB atas UNIT APARTEMEN dan PENERIMA PESANAN berhak mengakhiri Surat Pesanan secara sepihak serta seluruh
      pembayaran yang telah diterima oleh PENERIMA PESANAN tidak dapat ditarik kembali (dikembalikan) karena sebab atau alasan apapun, dan sehingga menjadi hak
      sepenuhnya PENERIMA PESANAN.
14. Hal-hal yang tidak atau belum cukup diatur dalam Surat Pesanan ini akan diatur lebih lanjut dalam PPJB dan perjanjian-perjanjian lain yang dibuat sehubungan dengan
      UNIT APARTEMEN.
     
Demikianlah dengan maksud untuk terikat oleh hukum setelah Surat Pesanan ini dibaca dengan seksama dan dimengerti serta disetujui isinya, maka PEMESAN dan
PENERIMA PESANAN menandatangani Surat Pesanan ini.*/
    
  
    //The first param should be the width of text area
    //0 value will make the FPDF automate the width
    //The second param is the line spacing for this paragraph
    //The third param is the text
#$pdf->MultiCell(200,4,$text1);
#start tabel
 $url= "reprint/sp".$idsp.".pdf";
 $pdf->Output($url);
//$pdf->Output("sp.pdf","I");
 redirect($url);
			
#$pdf->Output("hasil.pdf","I");
