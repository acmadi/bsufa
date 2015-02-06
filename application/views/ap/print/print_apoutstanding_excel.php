<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<table border="1">
	<tr>
		<th>No</td>
		<th>AP</td>
		<th>Date</td>
		<th>Descs</td>
		<th>Amount</td>
	</tr>
	

<?php 

extract(PopulateForm());
$data = $this->db->query("sp_apoutstanding '".inggris_date($startdate)."','".inggris_date($enddate)."'")->result();

$no = 0; 
$tot = 0;
foreach($data as $row){ 
$tot = $tot + (int)$row->base_amt;
?>
<tr>
	<td><?php echo $no;?></td>
	<td><?php echo $row->doc_no;?></td>
	<td><?php echo indo_date($row->due_date);?></td>
	<td><?php echo $row->descs;?></td>
	<td><?php echo 'Rp '.number_format($row->base_amt);?></td>
</tr>
<?php $no++; } ?>
<tr>
	<td colspan=4 align="center">Total</td>
	<td><?php echo 'Rp '.number_format($row->base_amt);?></td>
</tr>
</table>
