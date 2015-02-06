<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<table border="1">
	<tr>
		<td>No</td>
		<td>Unit</td>
		<td>Voucher No</td>
		<td>Kwitansi No</td>
		<td>Date</td>
		<td>Description</td>
		<td>Stored Bank</td>
		<td>Amount</td>
	</tr>
	
<?php 

$session_id = $this->UserLogin->isLogin();
$pt = $session_id['id_pt'];

extract(PopulateForm());
$data = $this->db->query("SP_history_payment ".$proj.",".$pt.",'".inggris_date($start_date)."','".inggris_date($end_date)."'")->result();
$i= 0; 
$tot = 0;
foreach($data as $row): 
$tot = $tot + $row->kwtbill_pay;
$i++;
?>
	<tr>
		<td><?=$i?></td>
		<td><?=$row->unit_no?></td>
		<td><?='GV'.$row->kwtbill_no?></td>
		<td><?='KG'.$row->kwtbill_no?></td>
		<td><?=indo_date($row->kwtbill_paydate)?></td>
		<td><?=$row->kwtbill_remark?></td>
		<td><?=$row->kwtbill_nm?></td>
		<td><?=$row->kwtbill_pay?></td>
	</tr>	
<?php endforeach; ?>
	<tr>
		<td colspan="7">Total</td>
		<td><?=$tot?></td>
	</tr>
</table>
