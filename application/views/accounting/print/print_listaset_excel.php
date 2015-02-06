<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");

$q_total = "select count(kd_aset) as tot from db_aset where tgl_penerimaan <= '".inggris_date($tgl)."' ";
$total = $this->db->query($q_total)->row();

$q_listaset = "select distinct kd_aset from db_aset where tgl_penerimaan <= '".inggris_date($tgl)."' ";
$list = $this->db->query($q_listaset)->result();
?>
<table border="1">
	<thead>
		<th><b>No</b></th>
		<th><b>Kode Aset</b></th>
		<th><b>Nama Aset</b></th>
		<th><b>Penerimaan</b></th>
		<th><b>Nilai Aset</b></th>
		<th><b>Nilai Depresiasi</b></th>
		<th><b>Kategori</b></th>
		<th><b>Nilai Saat Ini</b></th>
	</thead>
	<?php $i = 1; foreach ($list as $row) { ?>
	<tr>
		<td><?php echo number_format($i); ?></td>
		<td><?php echo $row->kd_aset; ?></td>
		<?php $detail = $this->db->query("select * from db_aset where flag_aset = 1 and kd_aset = '".$row->kd_aset."' ")->row(); ?>
		<td><?php echo $detail->nm_brg; ?></td>
		<td><?php echo $detail->tgl_penerimaan; ?></td>
		<td><?php echo $detail->nilai_aset; ?></td>
		<?php $depre = $this->db->query("select distinct a.debet from db_jurnalasetdetail a join db_jurnalasetheader b on a.voucher = b.voucher where b.kodeaset = '".$row->kd_aset."'")->row(); ?>
		<td><?php echo number_format($depre->debet); ?></td>
		<?php $kat = $this->db->query("select kategori from db_kategori_aset where kd_kategori = '".$detail->kategori."' ")->row(); ?>
		<td><?php echo $kat->kategori." thn"; ?></td>
		<?php $nilai = $this->db->query("select sum(a.debet) as now from db_jurnalasetdetail a join db_jurnalasetheader b on a.voucher = b.voucher where b.kodeaset = '".$row->kd_aset."' and a.status = 1")->row(); ?>
		<td><?php echo number_format(($detail->nilai_aset)-($nilai->now)); ?></td>
	</tr>
	<?php $i++; } ?>
</table>