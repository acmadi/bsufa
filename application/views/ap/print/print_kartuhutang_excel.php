<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<table border="1">
	<tr>
		<td>No</td>
		<td>No. A/P</td>
		<td>Date</td>
		<td>Vendor</td>
		<td>Invoice</td>
		<td>Invoice Date</td>
		<td>Invoice Due Date</td>
		<td>Description</td>
		<td>DPP</td>
		<td>PPN</td>
		<td>PPH</td>
		<td>Total</td>
	</tr>
	

<?php 

extract(PopulateForm());
$data = $this->db->query("sp_InvoiceAP '".$vendor."','".$project_detail."','".$checkbox."','".inggris_date($startdate)."','".inggris_date($enddate)."'")->result();

$i= 0; 
$total = 0;
foreach($data as $row): 
$i++;
//$persen = ($row->pay / $row->selling_price) * 100;

	
$totel = $row->mbase_amt + $row->mtax_amt - $row->mtax_deduct_amt;
			$total = $total + $totel;
?>
	<tr>
		<td><?=$i?></td>
		<td><?=$row->doc_no?></td>
		<td><?=indo_date($row->doc_date)?></td>		
		<td><?=$row->nm_supplier?></td>
		<td><?=$row->inv_no?></td>
		<td><?=indo_date($row->inv_date)?></td>
		<td><?=indo_date($row->due_date)?></td>
		<td><?=$row->descs?></td>
		<td><?=number_format($row->mbase_amt)?></td>
		<td><?=number_format($row->mtax_amt)?></td>
		<td><?=number_format($row->mtax_deduct_amt)?></td>
		<td><?=number_format($total)?></td>
	</tr>	
<?php endforeach ?>
	
</table>
