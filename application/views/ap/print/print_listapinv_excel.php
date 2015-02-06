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
		<td>PPHTB</td>
		<td>PPN</td>
		<td>PPH</td>
		<td>Total</td>
	</tr>
	
<?php 

extract(PopulateForm());
//$data = $this->db->query("sp_InvoiceAP '".$vendor."','".$project_detail."','".$checkbox."','".inggris_date($startdate)."','".inggris_date($enddate)."'")->result();

if($vendor==0){
$data = $this->db->query("select a.pphtb,a.doc_no,a.doc_date,b.nm_supplier,a.inv_no,CASE WHEN a.inv_date IS NULL THEN '-' ELSE CONVERT(varchar(50), a.inv_date, 121) END AS inv_date,CASE WHEN a.due_date IS NULL THEN '-' ELSE CONVERT(varchar(50), a.due_date, 121) END AS due_date,a.descs,a.base_amt
						from db_apinvoice a 
						join pemasokmaster b on b.kd_supplier = a.vendor_acct")->result();
}else{
$data = $this->db->query("select a.pphtb,a.doc_no,a.doc_date,b.nm_supplier,a.inv_no,CASE WHEN a.inv_date IS NULL THEN '-' ELSE CONVERT(varchar(50), a.inv_date, 121) END AS inv_date,CASE WHEN a.due_date IS NULL THEN '-' ELSE CONVERT(varchar(50), a.due_date, 121) END AS due_date,a.descs,a.base_amt
						from db_apinvoice a 
						join pemasokmaster b on b.kd_supplier = a.vendor_acct where a.vendor_acct = '$vendor'")->result();
}

$i= 0; 
$tot8 = 0;
$tpphtb = 0;
foreach($data as $row): 
//$persen = ($row->pay / $row->selling_price) * 100;
$tpphtb = $tpphtb+$row->pphtb;
$tot1 = 0;
$tot2 = 0;
$tot3 = 0;
$tot8 = $tot8 + $row->base_amt;
$i++;
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
		<td><?=number_format($row->pphtb)?></td>
		<td><?=number_format($row->base_amt)?></td>
		<td><?php echo ""; ?></td>
		<td><?=number_format($tot8)?></td>
	</tr>

<?php endforeach ?>
	
</table>
