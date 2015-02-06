<?php
require('fpdf/tanpapage.php');
$pdf=new PDF('P','mm','Legal');
$pdf->SetMargins(4,10,4);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',18);
$pdf->SetXY(0,40);
$pdf->Cell(0,10,'PENAWARAN SEWA',20,0,'C');
$pdf->Ln(8);
$pdf->Cell(0,10,$row->nm_subproject,20,0,'C');
$pdf->Ln(20);

//~ $pdf->SetFont('Arial','',9);
						//~ $pdf->Cell(20,10,'No Reff',0,0,'L');

$pdf->SetFont('Arial','',10);						//~ $pdf->Cell(20,10,'To  ',0,0,'L');

//$pdf->SetX(0);
$pdf->SetXY(0,80);
$pdf->Cell(30,5,'No Reff',0,0,'L');
$pdf->Cell(30,5,': '.$row->no_loo,0,0,'L');
$pdf->Ln(5);

$pdf->SetX(0);
$pdf->Cell(30,5,'Tanggal',0,0,'L');
$pdf->Cell(30,5,':'.indo_date($row->tgl_loo),0,0,'L');
$pdf->Ln(10);

//$pdf->SetX(0);
$pdf->SetXY(0,95);
$pdf->Cell(30,5,'Nama',0,0,'L');
$pdf->Cell(30,5,':'.$row->customer_nama,0,0,'L');
$pdf->Ln(5);

$pdf->SetX(0);
$pdf->Cell(30,5,'Trade Name',0,0,'L');
$pdf->Cell(30,5,':'.$row->trade_name,0,0,'L');
$pdf->Ln(5);		

$pdf->SetX(0);
$pdf->Cell(30,5,'Alamat',0,0,'L');
$pdf->Cell(30,5,':'.$row->customer_alamat1,0,0,'L');
$pdf->Ln(5);

$pdf->SetX(0);
$pdf->Cell(30,5,'No Telp',0,0,'L');
$pdf->Cell(30,5,':'.$row->customer_tlp,0,0,'L');
$pdf->Ln(10);

//$pdf->SetX(0);
$pdf->SetXY(0,120);
$pdf->Cell(40,5,'Peruntukan Sewa',0,0,'L');
$pdf->Cell(30,5,'OFFICE',0,0,'L');
$pdf->Cell(30,5,'RETAIL',0,0,'L');

#TAMPIL  CENTANG
if($row->fungsi == 1){
	$pdf->SetXY(35,120);
	$pdf->Cell(5,5,'X',1,1,'L');
}ELSE {
	$pdf->SetXY(65,120);
	$pdf->Cell(5,5,'X',1,1,'L');
}

$pdf->SetXY(35,120);
$pdf->Cell(5,5,'',1,1,'L');

$pdf->SetXY(65,120);
$pdf->Cell(5,5,'',1,1,'L');
//~ $pdf->Cell(30,5,'',1,1,'L');
$pdf->Ln(5);

$pdf->SetFont('Arial','B'.'U',10);
//$pdf->SetX(0);	
$pdf->SetXY(10,130);															
$pdf->Cell(50,5,'Area Sewa',0,0,'L');
$pdf->Cell(80,5,'Harga Sewa',0,0,'L');
$pdf->Cell(85,5,'Service Charge',0,0,'L');
$pdf->Cell(70,5,'Security Deposit',0,0,'L');																
$pdf->Ln(5);

$pdf->SetFont('Arial','',10);
$pdf->SetX(2);																

$pdf->Cell(20,5,'Lantai',0,0,'L');
$pdf->Cell(30,5,': '.$row->lantai,0,0,'L');
$pdf->Cell(40,5,'Harga Sewa per Meter',0,0,'L');
$pdf->Cell(5,5,': Rp. ',0,0,'L');
$pdf->Cell(25,5,number_format($row->hrg_meter),0,0,'R');

$pdf->SetX(132);																
$pdf->Cell(45,5,'Service Charge per Meter',0,0,'L');
$pdf->Cell(5,5,': Rp. ',0,0,'L');															
//$pdf->Cell(25,5,number_format($row->sc_psm),0,0,'R');

$pdf->SetX(218);																
$pdf->Cell(30,5,'Sewa',0,0,'L');																															
$pdf->Cell(5,5,': Rp. ',0,0,'L');															
$pdf->Cell(25,5,number_format($row->depo_ls),0,0,'R');


$pdf->Ln(5);

$pdf->SetX(2);																
$pdf->Cell(20,5,'Luas Area',0,0,'L');
$pdf->Cell(30,5,': '.$row->luas.' M2',0,0,'L');
$pdf->Cell(40,5,'Harga Sewa per Bulan',0,0,'L');
$pdf->Cell(5,5,': Rp. ',0,0,'L');
$pdf->Cell(25,5,number_format($row->hrg_bln),0,0,'R');

$pdf->SetX(132);																
$pdf->Cell(45,5,'Service Charge per Bulan',0,0,'L');																														
$pdf->Cell(5,5,': Rp. ',0,0,'L');															
//$pdf->Cell(25,5,number_format($row->sc_bln),0,0,'R');

$pdf->SetX(218);																
$pdf->Cell(30,5,'Service Charge',0,0,'L');																																																														
$pdf->Cell(5,5,': Rp. ',0,0,'L');															
$pdf->Cell(25,5,number_format($row->depo_sc),0,0,'R');


$pdf->Ln(5);		

$pdf->SetX(2);																
$pdf->Cell(20,5,'Masa Area',0,0,'L');
$pdf->Cell(30,5,': '.$row->periode.' Bulan',0,0,'L');
$pdf->Cell(40,5,'Total Nilai Sewa',0,0,'L');
$pdf->Cell(5,5,': Rp. ',0,0,'L');															
$pdf->Cell(25,5,number_format($row->hrg_tot),0,0,'R');

$pdf->SetX(218);																
$pdf->Cell(30,5,'Telepon',0,0,'L');
$pdf->Cell(5,5,': Rp. ',0,0,'L');															
$pdf->Cell(25,5,number_format($row->depo_tlp),0,0,'R');																																																																																					

$pdf->Ln(10);

$pdf->SetFont('Arial','B'.'U',10);
//$pdf->SetX(0);	
$pdf->SetXY(10,160);															
$pdf->Cell(30,5,'Cara Pembayaran',0,0,'L');				

$pdf->Ln(5);
$pdf->SetX(2);
$pdf->SetFont('Arial','',10);
$pdf->Cell(30,5,'- Pembayaran Awal, Sewa dibayar dimuka dan Security Deposit.',0,0,'L');
$pdf->Ln(5);
$pdf->SetX(2);
$pdf->Cell(30,5,'- Biaya sewa dibayarkan setiap 6 bulan, dimuka setelah ditandatanganinya Surat Penawaran ini.',0,0,'L');
$pdf->Ln(5);
$pdf->SetX(2);
$pdf->Cell(30,5,'- Biaya service charga dibayarkan setiap '.$row->periode.' bulan dimuka dimulai stelah ditandatanganinya Surat Penawaran ini.',0,0,'L');																
$pdf->Ln(5);
$pdf->SetX(2);
$pdf->Cell(30,5,'- Semua pembayaran dilakukan secara transfer ke rekening Bank ... No Rek ... atas nama PT. Bakrie Swasakti Utama',0,0,'L');																
		
#Approval 
$pdf->SetFont('Arial','B',10);
$pdf->SetXY(10,235);
$pdf->Cell(50,8,"Disiapkan Oleh:",1,1,'L');
$pdf->SetXY(60,235);
$pdf->Cell(120,8,"Disetujui Oleh:",1,1,'L');

$pdf->SetXY(10,243);
//~ $pdf->Ln(5);
$pdf->Cell(50,35,"",1,1,'C');
$pdf->SetXY(60,243);
//~ $pdf->Ln(5);
$pdf->Cell(60,35,"",1,1,'C');
$pdf->SetXY(120,243);
//~ $pdf->Ln(5);
$pdf->Cell(60,35,"",1,1,'C');

$pdf->SetFont('Arial','',10);				
$pdf->SetXY(10,278);
$pdf->Cell(50,5,"Commercial Leasing Staff",'L'.'R'.'T',1,'C');

$pdf->SetXY(60,278);
$pdf->Cell(60,5,"Chief Marketing Officer",'L'.'R'.'T',1,'C');

$pdf->SetXY(120,278);
$pdf->Cell(60,5,$row->customer_nama,'L'.'R'.'T',1,'C');


$pdf->SetXY(10,282);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,5,"PT. Bakrie Swasakti Utama",'L'.'R'.'B',1,'C');

$pdf->SetXY(60,282);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(60,5,"PT. Bakrie Swasakti Utama",'L'.'R'.'B',1,'C');

$pdf->SetXY(120,282);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(60,5,"Penyewa",'L'.'R'.'B',1,'C');

//~ $pdf->SetXY(55,183);
//~ $pdf->Cell(45,5,"Name:",1,1,'L');
//~ $pdf->SetXY(101,183);
//~ $pdf->Cell(45,5,"BUDGET CONTROL",1,1,'C');
//~ $pdf->SetXY(146,183);
//~ $pdf->Cell(45,5,"CHIEF FINANCE OFFICER",1,1,'C');
//~ $pdf->SetXY(192,183);
//~ $pdf->Cell(45,5,"DIRECTOR",1,1,'C');
#$url= "reprint/Proposed Budget".$cekdata['last_id'].".pdf";
$pdf->Output();
//~ redirect();
