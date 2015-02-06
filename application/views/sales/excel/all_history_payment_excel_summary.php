<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");


?>


<table border="1">
	<tr>
		<td>No</td>
		<td>Project</td>
		<td>Unit</td>
		<td>Customer</td>
		<td>Sqm</td>
		<td>Sp Date</td>
		<td>Harga Jual</td>
		<td>Paid</td>
	</tr>
	
<?php 

$session_id = $this->UserLogin->isLogin();
$pt = $session_id['id_pt'];

extract(PopulateForm());

	$start = inggris_date($start_date);
	$end	= inggris_date($end_date);

$data = $this->db->query("SP_history_payment_summary ".$proj.",".$pt.",'".$start."','".$end."'")->result();
//$data = $this->db->query("SP_history_payment ".$proj.",".$pt.",'".inggris_date($start_date)."','".inggris_date($end_date)."'")->result();
$i= 0; 
$tot = 0;
foreach($data as $row): 
$tot = $tot + $row->kwtbill_pay;
$i++;
?>



	<tr>
		<td><?=$i?></td>
		<td><?=$row->nm_subproject?></td>
		<td><?=$row->unit_no?></td>
		<td><?=$row->customer_nama?></td>
		<td><?=$row->bangunan?></td>
		<td><?=indo_date($row->tgl_sales)?></td>
		<td><?=number_format($row->selling_price)?></td>
		<td><?=number_format($row->kwtbill_pay)?></td>
	</tr>	
<?php endforeach; ?>
	<tr>
		<td colspan="7">Total</td>
		<td><?=number_format($tot)?></td>
	</tr>
</table>
