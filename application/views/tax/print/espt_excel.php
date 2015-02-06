<?php
//die('excel');
extract(PopulateForm());
$ty = "SELECT db_fakturspajak.tipe, apinvoice_id, no_fakturpajak, date_fakturpajak,nilai_fakturpajak, ttd_fakturpajak,kontak, doc_no, nm_supplier,alamat,descs,trx_amt, npwp, dpp_ppn, (dpp_ppn * 10)/100 as ppn
				FROM db_fakturpajak
				LEFT JOIN db_apinvoice ON no_ap = doc_no
				LEFT JOIN pemasok ON vendor_acct = kd_supplier
				where db_fakturpajak.tipe ='".$tipe."' AND db_fakturpajak.date_fakturpajak BETWEEN '".inggris_date($startdate)."' AND '".inggris_date($enddate)."'";

$data = $this->db->query($ty)->result();

//var_dump($data);


$startdate = $startdate;
$enddate = $enddate;
$date =date('Y-m-d');
$month =date("M",strtotime($date))."(".date("m",strtotime($date)).")";
$filename = "DATA EFILLING VAT ".$startdate." UNTIL ".$enddate.".xls ";
header("Content-type: application/octet-stream");
#header("Content-Disposition: attachment; filename=DATA.xls");
header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\"");
header("Pragma: no-cache");
header("Expires: 0");

?>
<style type="text/css">
.text{
  mso-number-format:"\@";/*force text*/
}
</style>
<table border="1">
	<tr>
		<td><b>No</b></td>
		<td><b>Kode Pajak</b></td>
		<td><b>Kode Transaksi</b></td>
		<td><b>Kode Status</b></td>
		<td><b>Kode Dokumen</b></td>
		<td><b>Flag VAT</b></td>
		<td><b>NPWP / Nomor Paspor</b></td>
		<td><b>Nama Lawan Transaksi</b></td>
		<td><b>Nomor Faktur / Dokumen</b></td>
		<td><b>Jenis Dokumen</b></td>
		<td><b>Nomor Faktur Pengganti / Retur</b></td>
		<td><b>Jenis Dokumen Dokumen Pengganti / Retur</b></td>
		<td><b>Tanggal Faktur / Dokumen</b></td>
		<td><b>Tanggal SSP</b></td>
		
		<td><b>Masa Pajak</b></td>
		<td><b>Tahun Pajak</b></td>
		<td><b>Pembetulan</b></td>
		<td><b>DPP</b></td>
		<td><b>PPN</b></td>
		<td><b>PPnBM</b></td>
		
		
	</tr>

<?php

$i = 0;



$session_id = $this->UserLogin->isLogin();
$pt = $session_id['id_pt'];


//var_dump($data);exit();
foreach($data as $row):

$i++;
?>
	<tr>
		<td><?=$i?></td>
		<td><?=$row->tipe?></td>
		<td></td>
		<td></td>
		<td></td>
		<td>0</td>
		<td><?=$row->npwp?></td>
		<td><?=$row->nm_supplier?></td>
		<td><?=$row->no_fakturpajak?></td>
		<td>0</td>
		<td></td>
		<td></td>
		<td><?=indo_date($row->date_fakturpajak)?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><?=$row->dpp_ppn?></td>
		<td><?=$row->ppn?></td>
		<td></td>
		
		
		
		
	
	</tr>
<?php endforeach ?>
	
</table>