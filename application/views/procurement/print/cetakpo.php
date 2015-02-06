<?php
	#die('tes');
	
	// nm_supp,alamat,kota,telepon,fax,kontak,no_po,tgl_po,
// c.divisi_nm as dipisi,reff_pr,b.matauang as curr,nm_brg,qty,satuan,harga_sat,harga_tot,
// disc,discnilai

	$rows = $this->db->query("sp_printpo '".$id."'")->row();
	//var_dump($rows);
	
	include_once( APPPATH."libraries/translate_currency.php");
	require('fpdf/tanpapage.php');
	$pdf=new PDF('P','mm','A4');
	$pdf->SetMargins(2,10,2);
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',14);
	$pdf->SetMargins(2,10,2);
		
						
	#HEADER 
	
	$project	= "GRAHA MULTI INSANI";
	$angka		= "100000000000000";
	$contractor	= $rows->nm_supp;
	
	$alamat		= $rows->alamat;
	$kota		= $rows->kota;
	$tlp		= $rows->telepon;
	$fax		= $rows->fax;
	$up			= $rows->kontak;
	$date_po	= $rows->tgl_po;
	
	
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
			
	$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
	$pdf->SetFont('Arial','B',12);
	$pdf->SetX(25);
	$pdf->Cell(0,10,'PT. GRAHA MULTI INSANI',20,0,'L');
	$pdf->Ln(8);
	
	$pdf->SetFont('Arial','',8);
	
	$pdf->SetX(25);
	$pdf->Cell(0,3,'JL. MAYJEND SUTOYO NO. 52',20,0,'L');
	$pdf->Ln(3);
	
	// $pdf->SetX(25);
	// $pdf->Cell(0,3,'NO. 52 RT. 01O RW. OO3',20,0,'L');
	// $pdf->Ln(3);
	
	$pdf->SetX(25);
	$pdf->Cell(0,3,'MANTRIJERON YOGYAKARTA',20,0,'L');
	$pdf->Ln(3);
	
	$pdf->SetX(25);
	$pdf->Cell(0,3,'Telp : (0274) 376032   Fax : (0274) 381443',20,0,'L');
	$pdf->Ln(3);
	
	$pdf->SetX(25);
	$pdf->Cell(0,3,'NPWP. 02.672.152.2-541.xxx',20,0,'L');
	$pdf->Ln(15);
	
	$pdf->SetFont('Arial','U'.'B',18);
	$pdf->SetX(5);
	$pdf->Cell(0,3,'PURCHASE ORDER',20,0,'C');
	$pdf->Ln(10);
	
	
	#SUPPLIER
	$pdf->SetFont('Arial','B',10);
	$pdf->SetX(5);
	$pdf->Cell(90,4,'To :','L'.'T'.'R',0,'L');
	$pdf->Ln(4);
	
	$pdf->SetFont('Arial','',6);
	$pdf->SetX(5);
	$pdf->Cell(90,4,$contractor,'L'.'R',0,'L');
	$pdf->Ln(4);
	
	$pdf->SetX(5);
	$pdf->Cell(90,4,$alamat,'L'.'R',0,'L');
	$pdf->Ln(4);
	
	$pdf->SetX(5);
	$pdf->Cell(90,4,$kota,'L'.'R',0,'L');
	$pdf->Ln(4);
	
	$pdf->SetX(5);
	$pdf->Cell(90,4,'Tlp. '.$tlp.'   Fax. '.$fax,'L'.'R',0,'L');
	$pdf->Ln(4);
	
	$pdf->SetX(5);
	$pdf->Cell(90,4,'UP. '.$up,'L'.'B'.'R',0,'L');
	$pdf->Ln(4);
	
	
	$pdf->SetXY(125,55);
	$pdf->Cell(15,4,'No. PO','L'.'T',0,'L');
	$pdf->Cell(3,4,':','T',0,'L');
	$pdf->Cell(62,4,$rows->no_po,'T'.'R',0,'L');
	$pdf->Ln(4);
	
	$pdf->SetXY(125,59);
	$pdf->Cell(15,4,'Tgl. PO','L',0,'L');
	$pdf->Cell(3,4,':',20,0,'L');
	$pdf->Cell(62,4,indo_date($date_po),'R',0,'L');
	$pdf->Ln(4);
	
	$pdf->SetXY(125,63);
	$pdf->Cell(15,4,'Divisi','L',0,'L');
	$pdf->Cell(3,4,':',20,0,'L');
	$pdf->Cell(62,4,$rows->dipisi,'R',0,'L');
	$pdf->Ln(4);
	
	$pdf->SetXY(125,67);
	$pdf->Cell(15,4,'Reff. PR','L',0,'L');
	$pdf->Cell(3,4,':',20,0,'L');
	$pdf->Cell(62,4,$rows->reff_pr,'R',0,'L');
	$pdf->Ln(4);
	
	$pdf->SetXY(125,71);
	$pdf->Cell(15,4,'Currency','L',0,'L');
	$pdf->Cell(3,4,':',20,0,'L');
	$pdf->Cell(62,4,$rows->curr,'R',0,'L');
	$pdf->Ln(4);
	
	$pdf->SetXY(125,75);
	$pdf->Cell(80,4,'','L'.'B'.'R',0,'L');
	$pdf->Ln(4);
	
	$pdf->SetXY(5,81);
	$pdf->Cell(12,5,'Remark : ','L'.'T'.'B',0,'L');
	$pdf->Cell(188,5,$rows->ket_po,'T'.'B'.'R',0,'L');
	$pdf->Ln(3);
	
	$pdf->SetXY(5,87);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(6,5,'No.',1,0,'C');
	$pdf->Cell(102,5,'Description',1,0,'C');
	$pdf->Cell(20,5,'Measure',1,0,'C');
	$pdf->Cell(25,5,'Price',1,0,'C');
	$pdf->Cell(12,5,'Qty',1,0,'C');
	
	$pdf->Cell(10,5,'Disc.',1,0,'C');
	$pdf->Cell(25,5,'Total Price',1,0,'C');
	
	
	
	$pdf->Ln(5);
			$i = 1;	
			$no = 0;
			$max = 45;	
			$tot = 0;
	// select nm_supp,alamat,kota,telepon,fax,kontak,no_po,tgl_po,
// c.divisi_nm as dipisi,reff_pr,b.matauang as curr,nm_brg,qty,satuan,harga_sat,harga_tot,
// disc,discnilai,ket_po
// from db_barangpoh a
// join db_barangpod b on b.brgpoh_id = a.brgpoh_id
// join db_divisi c on c.divisi_id = a.divisi_id
// join pemasokmaster d on d.kd_supplier = a.kd_supp
// where a.brgpoh_id = 3
	
	
	$dt = $this->db->select('nm_supp,alamat,kota,telepon,fax,kontak,no_po,tgl_po,
							 c.divisi_nm as dipisi,reff_pr,b.matauang as curr,nm_brg,qty,satuan,harga_sat,harga_tot,
							 disc,discnilai,ket_po,ppn_nilai,discvnilai,pejabat1,jabatan1')
				   ->join('db_barangpod b','b.brgpoh_id = a.brgpoh_id')
				   ->join('db_divisi c ','c.divisi_id = a.divisi_id')
				   ->join('pemasok d','d.kd_supplier = a.kd_supp')
				   ->where('a.BrgPOH_ID',$id)
				   ->get('db_barangpoh a')->result();
	// $hargasat = number_format($dt->harga_sat);
	// $discnilai = number_format($dt->discnilai);
	// $hargatot = number_format($dt->harga_tot);
	//for($i=1; $i<= 8; $i++){
		$grandtot = 0;
		
	foreach($dt as $row){
	$tot = $tot + $row->harga_tot;	
						$pdf->setX(5);
						$pdf->SetFont('Arial','',7);
						$pdf->Cell(6,5,$i,1,0,'C');
						$pdf->Cell(102,5,$row->nm_brg,1,0,'L');
						$pdf->Cell(20,5,$row->satuan,1,0,'C');
						$pdf->Cell(25,5,number_format($row->harga_sat),1,0,'R');
						$pdf->Cell(12,5,$row->qty,1,0,'C');
															
						
						#hitung totel harga
						$totdisc = $row->qty * $row->discnilai;
						
						$pdf->Cell(10,5,number_format($totdisc),1,0,'R');
						#hitung totel harga
						$totharga = ($row->qty * $row->harga_sat) - $totdisc;
						
						$grandtot = $grandtot + $totharga;
									
						$pdf->Cell(25,5,number_format($totharga),1,0,'R');
						$pdf->Ln(5);
						$i++;
						$no++;
				}
				
				
		$pdf->Ln(1);
		
		$pdf->SetFont('Arial','B',7);
		$pdf->SetX(5);
		//~ $pdf->Cell(140,4,'','L'.'T'.'R',0,'R');
		//~ $pdf->Cell(35,4,'Subtotal','L'.'T'.'R',0,'R');
		//~ $pdf->Cell(25,4,number_format($totharga),'L'.'T'.'R',0,'R');
		//~ $pdf->Ln(4);
		
		//~ $pdf->SetX(5);
		//~ $pdf->Cell(140,4,'','L'.'R',0,'R');
		//~ $pdf->Cell(35,4,'Discount','L'.'R',0,'R');
		//~ 
				//~ 
		//~ $pdf->Cell(25,4,number_format($row->discnilai),'L'.'R',0,'R');
		//~ $pdf->Ln(4);
		
		#hitung harga setelah discount
		//$totsedisc = $grandtot - $row->discnilai;
		$totsedisc = $grandtot;
		#hitung nilai PPN
		$ppn	= ($grandtot * 1.1) - $grandtot;
		$ppn=0;
		
		$pdf->SetX(5);
		$pdf->Cell(140,4,'','L'.'R',0,'R');
		$pdf->Cell(35,4,'Grand Total','L'.'T'.'R',0,'R');
		$pdf->Cell(25,4,number_format($grandtot),1,0,'R');
		$pdf->Ln(4);
		
		$pdf->SetX(5);
		$pdf->Cell(140,4,'','L'.'R',0,'R');
		$pdf->Cell(35,4,'PPN','L'.'T'.'R',0,'R');
		$pdf->Cell(25,4,number_format($ppn),1,0,'R');
		$pdf->Ln(4);
		
		$grandtotppn = $grandtot + $ppn;
		//$grandtotppn = $grandtot;
		
		$pdf->SetX(5);
		$pdf->Cell(140,4,'','L'.'B'.'R',0,'R');
		$pdf->Cell(35,4,'Grand Total (Incl.Tax)','L'.'B'.'R',0,'R');
		$pdf->Cell(25,4,number_format($grandtotppn),1,0,'R');
		$pdf->Ln(4);
	
		$bilangan 	= UcFirst(toRupiah($grandtotppn));
	
		$pdf->Ln(1);
		$pdf->SetX(5);
		$pdf->Cell(15,6,'Terbilang : ',20,0,'L');
		$pdf->Cell(185,6,'#'.$bilangan.' Rupiah'.'#',1,0,'L');
		$pdf->Ln(6);
		
		$pdf->Ln(1);
		$pdf->SetX(5);
		$pdf->SetFont('Arial','',6);
		$pdf->Cell(15,5,'Keterangan : ',20,0,'L');
		
		$pdf->Ln(5);
		$pdf->SetX(5);
		$pdf->Cell(80,5,'1. Barang tidak bisa diterima tanpa mencantumkan nomer PO di Kwitansi/Invoice','L'.'T'.'R',0,'L');
		$pdf->SetFont('Arial','B','8');
		$pdf->Cell(120,5,'Acknowledge By, ',20,0,'C');
		
		
		$pdf->Ln(5);
		$pdf->SetX(5);
		$pdf->SetFont('Arial','',6);
		$pdf->Cell(80,5,'2. Barang yang dikirim harus sama dengan sepesifikasi yang ada di PO','L'.'R',0,'L');
		
		$pdf->Ln(5);
		$pdf->SetX(5);
		$pdf->Cell(80,5,'3. Pembayaran 14 hari setelah barang diterima','L'.'B'.'R',0,'L');
		
		$pdf->Ln(10);
		$pdf->SetX(85);
		$pdf->SetFont('Arial','U','8');
		$pdf->Cell(120,5,$row->pejabat1,20,0,'C');
		
		$pdf->Ln(3);
		$pdf->SetX(85);
		$pdf->SetFont('Arial','B','8');
		$pdf->Cell(120,5,$row->jabatan1,20,0,'C');
		
		
	
	#APPROVAL
	/*$pdf->SetXY(5,150);
	$pdf->Cell(40,5,'Prepared By :',1,0,'L');
	$pdf->Cell(80,5,'Approved By :',1,0,'L');
	
	$pdf->SetXY(5,155);
	$pdf->Cell(40,30,'',1,0,'L');
	$pdf->Cell(80,30,'',1,0,'L');*/
	
	
	
	
	

	#$pdf->Output("history.pdf","I");		
	$pdf->Output("PurchaseOrder.pdf","I");
#redirect($url);

