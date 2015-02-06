<?php
	#die('tes');
	$rows = $this->db->query("sp_printmrr")->row();
	
	include_once( APPPATH."libraries/translate_currency.php");
	require('fpdf/tanpapage.php');
	$pdf=new PDF('P','mm','A4');
	$pdf->SetMargins(2,10,2);
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',14);
	$pdf->SetMargins(2,10,2);
		
						
	#HEADER 
	$judul 		= "MATERIAL RECEIVING REPORT";
	$periode	= "As Off";
	$date		= "24 January 2012";
	$project	= "XXX";
	$angka		= "100000000000000";
	$contractor	= $rows->nm_supp;
	
	$alamat		= $rows->alamat;
	$kota		= $rows->kota;
	$tlp		= $rows->telepon;
	$fax		= $rows->fax;
	$up			= $rows->kontak;
	$date_mrr	= $rows->Reff_Tgl;
	
	$bilangan 	= UcFirst(toRupiah(11200000000));
	
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
			
	#$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
	$pdf->SetFont('Arial','B',12);
	$pdf->SetX(25);
	$pdf->Cell(0,10,'PT. GRAHA MULTI INSANI',20,0,'L');
	$pdf->Ln(8);
	
	$pdf->SetFont('Arial','',8);
	
	$pdf->SetX(25);
	$pdf->Cell(0,3,'Komplek Apartemen Taman Rasuna',20,0,'L');
	$pdf->Ln(3);
	
	$pdf->SetX(25);
	$pdf->Cell(0,3,'Jl. HR Rasuna Said - Kuningan',20,0,'L');
	$pdf->Ln(3);
	
	$pdf->SetX(25);
	$pdf->Cell(0,3,'Jakarta Selatan (12960)',20,0,'L');
	$pdf->Ln(3);
	
	$pdf->SetX(25);
	$pdf->Cell(0,3,'Telp : (021)8305011   Fax : (021) 8305012',20,0,'L');
	$pdf->Ln(3);
	
	$pdf->SetX(25);
	$pdf->Cell(0,3,'NPWP. 01.260.283.7.xxxx',20,0,'L');
	$pdf->Ln(15);
	
	$pdf->SetFont('Arial','U'.'B',18);
	$pdf->SetX(5);
	$pdf->Cell(0,3,$judul,20,0,'C');
	$pdf->Ln(10);
	
	
	#SUPPLIER
	$pdf->SetFont('Arial','B',10);
	$pdf->SetX(5);
	$pdf->Cell(80,4,'Supplier','L'.'T'.'R',0,'L');
	$pdf->Ln(4);
	
	$pdf->SetFont('Arial','',8);
	$pdf->SetX(5);
	$pdf->Cell(80,4,$contractor,'L'.'R',0,'L');
	$pdf->Ln(4);
	
	$pdf->SetX(5);
	$pdf->Cell(80,4,$alamat,'L'.'R',0,'L');
	$pdf->Ln(4);
	
	$pdf->SetX(5);
	$pdf->Cell(80,4,$kota,'L'.'R',0,'L');
	$pdf->Ln(4);
	
	$pdf->SetX(5);
	$pdf->Cell(80,4,'Tlp. '.$tlp.'   Fax. '.$fax,'L'.'R',0,'L');
	$pdf->Ln(4);
	
	$pdf->SetX(5);
	$pdf->Cell(80,4,'','L'.'B'.'R',0,'L');
	$pdf->Ln(4);
	
	
	$pdf->SetXY(125,55);
	$pdf->Cell(15,4,'No PR.','L'.'T',0,'L');
	$pdf->Cell(3,4,':','T',0,'L');
	$pdf->Cell(62,4,$rows->reff_pr,'T'.'R',0,'L');
	$pdf->Ln(4);
	
	$pdf->SetXY(125,59);
	$pdf->Cell(15,4,'Date','L',0,'L');
	$pdf->Cell(3,4,':',20,0,'L');
	$pdf->Cell(62,4,$date_mrr,'R',0,'L');
	$pdf->Ln(4);
	
	$pdf->SetXY(125,63);
	$pdf->Cell(15,4,'Divisi','L',0,'L');
	$pdf->Cell(3,4,':',20,0,'L');
	$pdf->Cell(62,4,$rows->divisi_nm,'R',0,'L');
	$pdf->Ln(4);
	
	$pdf->SetXY(125,67);
	$pdf->Cell(15,4,'No PO.','L',0,'L');
	$pdf->Cell(3,4,':',20,0,'L');
	$pdf->Cell(62,4,$rows->no_po,'R',0,'L');
	$pdf->Ln(4);
	
	$pdf->SetXY(125,71);
	$pdf->Cell(15,4,'','L',0,'L');
	$pdf->Cell(3,4,'',20,0,'L');
	$pdf->Cell(62,4,'','R',0,'L');
	$pdf->Ln(4);
	
	$pdf->SetXY(125,75);
	$pdf->Cell(80,4,'','L'.'B'.'R',0,'L');
	$pdf->Ln(8);
	
	
	
	$pdf->SetX(5);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(6,8,'No.',1,0,'C');
	$pdf->Cell(66,4,'Q T Y',1,0,'C');
	$pdf->Cell(12,8,'Unit',1,0,'C');
	$pdf->Cell(55,8,'Description',1,0,'C');
	$pdf->Cell(20,8,'S/N. Part',1,0,'C');
	$pdf->Cell(41,8,'Remark',1,0,'C');
	
	
	$pdf->SetXY(11,87);
	$pdf->SetFont('Arial','B',7);
	$pdf->Cell(22,4,'P O',1,0,'C');
	$pdf->Cell(22,4,'Received',1,0,'C');
	$pdf->Cell(22,4,'O S',1,0,'C');
	$pdf->Ln(4);
	
	$i = 1;	
			$no = 0;
			$max = 45;	
			$tot = 0;
	$dt = $this->db->join('barangpod b','b.brgpod_id = a.brgpod_id')
				   ->join('barangpoh c ','c.brgpoh_id = a.brgpoh_id')
				   ->join('db_divisi d','d.divisi_id = c.divisi_id')
				   ->join('pemasokmaster e','e.kd_supplier = c.kd_supp')
				   ->where('no_po','PO-BSU/1201/0015')
				   ->get('barangpomsk a')->result();
	// $hargasat = number_format($dt->harga_sat);
	// $discnilai = number_format($dt->discnilai);
	// $hargatot = number_format($dt->harga_tot);
	//for($i=1; $i<= 8; $i++){
	// select *
// from barangpomsk a 
// left join barangpod b on b.brgpod_id = a.brgpod_id
// left join barangpoh c on c.brgpoh_id = a.brgpoh_id
// left join db_divisi d on d.divisi_id = c.divisi_id
// left join pemasokmaster e on e.kd_supplier = c.kd_supp
// where no_po = 'PO-BSU/1201/0015'
	
	foreach($dt as $row){
	
	//for($i=1; $i<= 8; $i++){
	$qtyos = $row->qtyPO - $row->qtyMsk;
						$pdf->setX(5);
						$pdf->SetFont('Arial','',6);
						$pdf->Cell(6,4,$i,1,0,'C');
						$pdf->Cell(22,4,number_format($row->qtyPO),1,0,'C');
						$pdf->Cell(22,4,number_format($row->qtyMsk),1,0,'C');
						$pdf->Cell(22,4,number_format($qtyos),1,0,'C');
						$pdf->Cell(12,4,$row->satuan,1,0,'C');
						$pdf->Cell(55,4,$row->nm_brg,1,0,'L');
						$pdf->Cell(20,4,'',1,0,'C');
						$pdf->Cell(41,4,$row->no_mrr,1,0,'L');
						$pdf->Ln(4);
						$i++;
						$no++;
				}
				
				
		$pdf->Ln(1);
		
		$pdf->SetFont('Arial','B',7);
		$pdf->SetX(5);
		$pdf->Cell(67,4,'Approved By.','L'.'T'.'R',0,'C');
		$pdf->Cell(66,4,'','L'.'T'.'R',0,'L');
		$pdf->Cell(67,4,'Received By,','L'.'T'.'R',0,'C');
		$pdf->Ln(4);
		
		$pdf->SetX(5);
		$pdf->Cell(67,20,'','L'.'R',0,'C');
		$pdf->Cell(66,20,'','L'.'R',0,'L');
		$pdf->Cell(67,20,'','L'.'R',0,'C');
		$pdf->Ln(20);
		
		$pdf->SetX(5);
		$pdf->Cell(67,4,'Date',1,0,'L');
		$pdf->Cell(66,4,'',1,0,'L');
		$pdf->Cell(67,4,'Date',1,0,'C');
		$pdf->Ln(4);
		
		$pdf->Ln(4);
		
		
	
	
	
	

	#$pdf->Output("history.pdf","I");		
	$pdf->Output("kontrakstatus.pdf","I");
#redirect($url);

