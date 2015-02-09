<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=pettycash.xls");
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
		<td>No</td>
		<td>Tanggal</td>
		<td>Nomor</td>
		<td>Keterangan</td>
		<td>Debit</td>
		<td>Kredit</td>
		<td>Saldo</td>
	</tr>

<?php
extract(PopulateForm());
$session_id = $this->UserLogin->isLogin();
$pt = $session_id['id_pt'];
			
	$i = 1;
	
	$que = "select * from db_pettyclaim 
					where claim_date between '".inggris_date($tgl1)."' and '".inggris_date($tgl2)."'  order by pettycash_id";
			$query = $this->db->query($que)->result();		
		foreach($query as $row){ 
		
		
		?>
			<tr>
				<td><?=$i?></td>
				<td><?=indo_date($row->claim_date)?></td>
				<td><?=$row->claim_no?></td>
				<td><?=$row->petty_desc?></td>
				<td><?=number_format($row->debet)?></td>
				<td><?=number_format($row->credit)?></td>
				<td><?=number_format($row->saldo)?></td>
			</tr>
			
			
		<?php 
		}
		?>

	