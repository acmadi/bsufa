<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<table border="1">
	<tr>
		<td>No</td>
		<td>Voucher</td>
		<td>Date</td>
		<td>Vendor</td>
		<td>Invoice</td>
		<td>Invoice Date</td>
		<td>Description</td>
		<td>Amount</td>
		<td>Bank Name</td>
		<td>Paid By</td>
	</tr>
	

<?php 

extract(PopulateForm());
$session = $this->UserLogin->isLogin();
$data = $this->db->query("sp_PaymentAP '".$project_detail."','".$vendor."','".$checkbox."','".inggris_date($startdate)."','".inggris_date($enddate)."',".$session['id_pt'].",0")
							 ->result();

$i= 0; 
foreach($data as $row): 
$i++;
//$persen = ($row->pay / $row->selling_price) * 100;
?>
	<tr>
		<td><?=$i?></td>
		<td><?=$row->voucher?></td>
		<td><?=indo_date($row->trans_date)?></td>		
		<td><?=$row->nm_supplier?></td>
		<td><?=$row->doc_no?></td>
		<td><?=indo_date($row->doc_date)?></td>
		<td><?=$row->descs?></td>
		<td><?=number_format($row->amount)?></td>
		<td><?=$row->bank_nm?></td>
		<td><?=$row->paidby?></td>
		
	</tr>	
<?php endforeach ?>
	
</table>
