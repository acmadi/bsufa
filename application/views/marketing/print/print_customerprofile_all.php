<?php

		
			require('fpdf/classreport.php');
			extract(PopulateForm());
			//~ if ($kat == 1){
					//~ $kate = 'id_motivie';
					//~ $kaka = 'Motivies';
					//~ 
			//~ }elseif($kat == 2){
					//~ $kate = 'db_customer.id_karysek';
					//~ $kaka = 'Gender';	
			//~ }elseif($kat == 3){
					//~ $kate = 'db_customer.id_agama';	
					//~ $kaka = 'Religion';
			//~ }elseif($kat == 4){
					//~ $kate = 'db_customer.id_profesi';
					//~ $kaka = 'Occupation';	
			//~ }elseif($kat == 5){
					//~ $kate = 'db_customer.id_negara';
					//~ $kaka = 'Natioanality';	
			//~ }elseif($kat == 6){
					//~ $kate = 'db_customer.id_etnis';
					//~ $kaka = 'Etnic';	
			//~ }elseif($kat == 7){
					//~ $kate = 'id_media';
					//~ $kaka = 'Source';	
			//~ }
				//~ 
				//~ $que = ("select unit_no,tgl_sales,customer_nama,nama,customer_hp,customer_alamat1,kdpos1,customer_tlp,
					//~ customer_fax,customer_tgl_lhr,datediff(yyyy,customer_tgl_lhr, getdate())'umur' 
					//~ from db_sp
					//~ left join db_customer on id_customer = customer_id
					//~ left join db_unit_yogya on id_unit = unit_id
					//~ left join db_kary on db_kary.id_kary = db_sp.id_sales
					//~ left join db_motivie on id_motivie = motivie_id
					//~ left join db_karysek on db_customer.id_karysek = db_karysek.karysek_id
					//~ left Join db_agama on db_customer.id_agama = db_agama.agama_id
					//~ left join db_profesi on id_profesi = profesi_id 
					//~ left join db_negara on id_negara = NEGARA_ID
					//~ LEFT JOIN DB_etnis on id_etnis = etnis_id
					//~ left join db_media on id_media = media_id where $kate = $tipe and db_unit_yogya.id_subproject = $proj");
				//~ $res = $this->db->query($que)->result();
				//~ #var_dump($res);
				
				$session_id = $this->UserLogin->isLogin();
			$session_cus = $this->input->post('subproject');
			$pt = $session_id['id_pt'];
			
			//var_dump($pt);
			
			if($pt == 44){
				$sql = 	"SELECT customer_id,unit_no,customer_nama,customer_alamat2,customer_hp FROM db_sp a
					JOIN db_customer b ON a.id_customer = b.customer_id
					JOIN db_unit_yogya ON id_unit = unit_id
					WHERE ISNULL(a.id_flag,0) <> 10 AND a.id_subproject = $proj
					ORDER BY customer_nama";
			$rw = $this->db->query($sql)->result();
			}elseif($pt == 11){
				$sql = 	"SELECT customer_id,unit_no,customer_nama,customer_alamat2,customer_hp FROM db_sp a
					JOIN db_customer b ON a.id_customer = b.customer_id
					JOIN db_unit_bdm ON id_unit = unit_id and  a.id_subproject=db_unit_bdm.id_subproject
					WHERE ISNULL(a.id_flag,0) <> 10  AND a.id_subproject = $proj
					ORDER BY customer_nama";
			$rw = $this->db->query($sql)->result();
			}
			
			


			
			
			$pdf=new PDF('L','mm','A4');
			
			$pdf->SetMargins(6,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEADER CONTENT
			if($pt == 44){
				$pt			= "Graha Multi Insani";
			}elseif($pt == 11){
				$pt			= "Bakrie Swasakti Utama";
			}
				$judul 		= "Customer Report";
				$periode	= "Periode";
	
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
			if($pt == 44){
				$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				//$pdf->SetFont('Arial','B',18);
			}elseif($pt == 11){
				//$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				
			}
				
				$pdf->SetFont('Arial','B',18);
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				// if($proj == 41011){
					// $proje = 'AWANA TOWN HOUSE';
			// }elseif($proj == 41012){
					// $proje = 'AWANA CONDOTEL';
			// }elseif($proj == 11224){
					// $proje = 'RE - The Grove Suites';
			// }
			
				$proje = 'ALL';
				$pdf->SetFont('Arial','',9);
				$pdf->Cell(0,10,'PROJECT : '.$proje,20,0,'L');
				$pdf->SetXY(25,26);
				$pdf->Cell(10,10,'AS OF : '.$tgl,20,0,'L');
		
			$pdf->SetXY(5,35);
			
			//~ $pdf->Cell(5,5,'Category',10,0,'L',0);
			//~ $pdf->Cell(8,5,':',10,0,'C',0);
			//~ $pdf->Cell(20,5,$kaka,10,0,'L',0);
			//~ $pdf->SetXY(25,36);
			//~ $pdf->Cell(25,5,'Sort By',10,0,'L',0);
			//~ $pdf->Cell(8,5,':',10,0,'C',0);
			//~ $pdf->Cell(20,5,$nmtype,10,0,'L',0);
			//~ 
			//~ $pdf->Ln(10);
				//~ 
				//~ $pdf->Cell(0,0,'',1,0,'L');
			// Start Isi Tabel	
			$pdf->SetFont('Arial','B',7);
			$pdf->Ln(4);
			$pdf->Cell(8,5,'No',1,0,'C',1);
			$pdf->Cell(20,5,'Unit',1,0,'C',1);
			#$pdf->Cell(20,5,'Sales Date',1,0,'C',1);
			$pdf->Cell(50,5,'Customer',1,0,'C',1);
			//~ $pdf->Cell(20,5,'Birth Date',1,0,'C',1);
			//~ $pdf->Cell(15,5,'Telp',1,0,'C',1);
			$pdf->Cell(125,5,'Alamat',1,0,'C',1);
			//~ $pdf->Cell(15,5,'Mail Post',1,0,'C',1);
			$pdf->Cell(20,5,'Handphone',1,0,'C',1);
			//~ $pdf->Cell(15,5,'Fax',1,0,'C',1);
			//~ $pdf->Cell(10,5,'Umur',1,0,'C',1);
			//~ $pdf->Cell(35,5,'Sales',1,0,'C',1);
			//~ 
			
		
			$pdf->SetFont('Arial','',6);
			
			$i = 1;	
			$no = 1;
			$noo = 0;
			$max = 25;	
			$pdf->Ln(5);
			
					
			
	#for($i = 1;$i <= 200; $i++){
	foreach ($rw as $row){
		if($noo == $max){ 
			$pdf->AddPage();
			//				
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#HEADER CONTENT
				$pt			= "Graha Multi Insani";
				$judul 		= "Customer Report";
				$periode	= "Periode";
				
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
				$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				// if($proj == 41011){
					// $proje = 'AWANA TOWN HOUSE';
			// }elseif($proj == 41012){
					// $proje = 'AWANA CONDOTEL';
			// }
				$proje = 'ALL';
				$pdf->SetFont('Arial','',9);
				$pdf->Cell(0,10,'PROJECT : '.$proje,20,0,'L');
				$pdf->SetXY(25,26);
				$pdf->Cell(10,10,'AS OF : '.$tgl,20,0,'L');
				
				$pdf->SetXY(5,35);
			//~ $pdf->SetXY(25,30);
			//~ 
			//~ $pdf->Cell(25,5,'Category',10,0,'L',0);
			//~ $pdf->Cell(8,5,':',10,0,'C',0);
			//~ $pdf->Cell(20,5,$kaka,10,0,'L',0);
			//~ $pdf->SetXY(25,36);
			//~ $pdf->Cell(25,5,'Sort By',10,0,'L',0);
			//~ $pdf->Cell(8,5,':',10,0,'C',0);
			//~ $pdf->Cell(20,5,$nmtype,10,0,'L',0);
			
			//~ $pdf->Ln(10);
				//~ 
				//~ $pdf->Cell(0,0,'',1,0,'L');
			// Start Isi Tabel	
			$pdf->SetFont('Arial','B',7);
			$pdf->Ln(4);
			$pdf->Cell(8,5,'No',1,0,'C',1);
			$pdf->Cell(20,5,'Unit',1,0,'C',1);
			//~ $pdf->Cell(20,5,'Sales Date',1,0,'C',1);
			$pdf->Cell(50,5,'Customer',1,0,'C',1);
			//~ $pdf->Cell(20,5,'Birth Date',1,0,'C',1);
			//~ $pdf->Cell(15,5,'Telp',1,0,'C',1);
			$pdf->Cell(125,5,'Alamat',1,0,'C',1);
			//~ $pdf->Cell(15,5,'Mail Post',1,0,'C',1);
			$pdf->Cell(20,5,'Handphone',1,0,'C',1);
			//~ $pdf->Cell(15,5,'Fax',1,0,'C',1);
			//~ $pdf->Cell(10,5,'Umur',1,0,'C',1);
			//~ $pdf->Cell(35,5,'Sales',1,0,'C',1);
			//~ 
			
			$pdf->Ln(5);
			$noo = 0;
	
			
		}
	$a = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa4";
		//~ $tgl_lhr = indo_date($row->customer_tgl_lhr);
			//~ if($tgl_lhr == '01-01-1970'){
				//~ $tgl_lhr = '-';
				//~ 
			//~ }
	
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(8,5,$no,1,0,'C',0);
			#$pdf->Cell(65,5,substr($a,0,54),1,0,'L',0);
			$pdf->Cell(20,5,$row->unit_no,1,0,'C',0);
			//~ $pdf->Cell(20,5,indo_date($row->tgl_sales),1,0,'C',0);
			$pdf->Cell(50,5,$row->customer_nama,1,0,'L',0);
			//~ $pdf->Cell(20,5,$tgl_lhr,1,0,'C',0);
			//~ $pdf->Cell(15,5,$row->customer_tlp,1,0,'L',0);
			$pdf->Cell(125,5,$row->customer_alamat2,1,0,'L',0);
			//~ $pdf->Cell(15,5,$row->kdpos1,1,0,'C',0);
			$pdf->Cell(20,5,$row->customer_hp,1,0,'L',0);
			//~ $pdf->Cell(15,5,$row->customer_fax,1,0,'L',0);
			//~ $pdf->Cell(10,5,$row->umur,1,0,'C',0);
			//~ $pdf->Cell(35,5,$row->nama,1,0,'L',0);
		//~ 
			$pdf->Ln(5);		
			$i++;
			$no++;
			$noo++;
		
	}
			$pdf->SetFont('Arial','B',6);
	  	
			//$pdf->Cell(8,5,$no,1,0,'C',0);
			//~ $pdf->Cell(73,5,'GRAND TOTAL',1,0,'C',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'L',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'C',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'C',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'C',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'C',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'R',1);
		
			$pdf->Output("hasil.pdf","I");	;
	
