<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<table border="1">
	<tr>
		<td>No</td>
		<td>No AP</td>
		<td width="500">Description</td>
		<td>Due Date</td>
		<td>Amount</td>
	</tr>
	<?php if ($detail == 0) {
			//$total = $total + $row->mbal_amt;
		} else {
	 $i = 1; foreach ($detail as $row) {?>
	<tr>
		<td><?php echo $i;?></td>
		<td><?php echo $row->doc_no;?></td>
		<td width="500"><?php echo $row->descs;?></td>
		<td><?php echo $row->due_date;?></td>
		<td><?php echo number_format(($row->base_amt) - ($row->trx_amt),2);?></td>
	</tr>
	<? $i++; }
} ?>
	<tr>
		<td colspan="4"> GRAND TOTAL </td>
		<?php if ($detail == 0) {?>
				<td><?php echo '0';?></td>
			<?php } else { ?>
		<td><?php echo number_format($hutang->mbal_amt,2);?></td>
		<?php } ?>
	</tr>
</table>