<?php
//query for this report
$q_total = "select count(kd_aset) as tot from db_aset where tgl_penerimaan <= '".inggris_date($tgl)."' and flag_aset = 1 ";
$total = $this->db->query($q_total)->row();

$q_listaset = "select distinct kd_aset from db_aset where tgl_penerimaan <= '".inggris_date($tgl)."' and flag_aset = 1 ";
$list = $this->db->query($q_listaset)->result();

require('fpdf/tanpapage.php');
$pdf=new PDF('P','mm','A4');

$pdf->SetMargins(8,5,10);
$pdf->AliasNbPages();	
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->setFillColor(222,222,222);

$periode	= "Periode";
	
#CETAK TANGGAL
	$tglcetak  = date("d-m-Y");
#TANGGAL CETAK
	$pdf->SetFont('Arial','',6);
	$pdf->SetXY(258,10);
	$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
				
	$pdf->SetXY(268,10);
	$pdf->Cell(2,4,':',4,0,'L');
					
	$pdf->SetXY(269,10);
	$pdf->Cell(10,4,'',0,0,'L');

#Header
	#$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
	$pdf->SetFont('Arial','B',18);
	$pt = "PT. Bakrie Swasakti Utama";
	$pdf->SetX(25);
	$pdf->Cell(0,10,$pt,20,0,'L');

	$pdf->SetFont('Arial','B',12);
	
	$pdf->SetXY(25,16);
	$pdf->Cell(10,5,@$judul,0,0,'L');
	$pdf->SetFont('Arial','B',11);
	$pdf->Ln(5);
	$pdf->Cell(40,5,'List Aset (Total)',0,0,'L');
	$pdf->Cell(10,5,':',0,0,'L');
	$pdf->Cell(0,5,number_format($total->tot),0,0,'L');
	$pdf->Ln(5);
	$pdf->Cell(40,5,'As Off',0,0,'L');
	$pdf->Cell(10,5,':',0,0,'L');
	$pdf->Cell(0,5,$tgl,0,0,'L');
	
	$pdf->Ln(10);
	$pdf->Cell(0,0,'',1,0,'L');

	$pdf->Ln(5);
	$pdf->Cell(0,0,'Daftar Aset',0,0,'L');

	$pdf->Ln(5);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(8,5,'No',1,0,'C',0);
	$pdf->Cell(30,5,'Kode Aset',1,0,'C',0);
	$pdf->Cell(40,5,'Nama Aset',1,0,'C',0);
	$pdf->Cell(30,5,'Penerimaan',1,0,'C',0);
	$pdf->Cell(25,5,'Nilai Aset',1,0,'C',0);
	$pdf->Cell(25,5,'Nilai Depresiasi',1,0,'C',0);
	$pdf->Cell(15,5,'Kategori',1,0,'C',0);
	$pdf->Cell(25,5,'Nilai Saat Ini',1,0,'C',0);

	$i = 1;
	foreach ($list as $row) {
		$pdf->Ln(5);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(8,5,number_format($i),'L'.'B',0,'C',0);
		$pdf->Cell(30,5,$row->kd_aset,'L'.'B',0,'C',0);
		$detail = $this->db->query("select * from db_aset where flag_aset = 1 and kd_aset = '".$row->kd_aset."' ")->row();
		$pdf->Cell(40,5,$detail->nm_brg,'L'.'B',0,'L',0);
		$pdf->Cell(30,5,indo_date($detail->tgl_penerimaan),'L'.'B',0,'C',0);
		$pdf->Cell(25,5,number_format($detail->nilai_aset),'L'.'B',0,'R',0);

		$depre = $this->db->query("select distinct a.debet from db_jurnalasetdetail a join db_jurnalasetheader b on a.voucher = b.voucher where b.kodeaset = '".$row->kd_aset."'")->row();
		$pdf->Cell(25,5,number_format($depre->debet),'L'.'B',0,'R',0);

		$kat = $this->db->query("select kategori from db_kategori_aset where kd_kategori = '".$detail->kategori."' ")->row();
		$pdf->Cell(15,5,$kat->kategori." thn",'L'.'B',0,'C',0);

		$nilai = $this->db->query("select sum(a.debet) as now from db_jurnalasetdetail a join db_jurnalasetheader b on a.voucher = b.voucher where b.kodeaset = '".$row->kd_aset."' and a.status = 1")->row();
		$pdf->Cell(25,5,number_format(($detail->nilai_aset)-($nilai->now)),'L'.'B'.'R',0,'R',0);
		$i++;
	}
	

$pdf->Output("LIST_ASET.pdf","I");

?>