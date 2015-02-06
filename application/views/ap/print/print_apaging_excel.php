<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<table border="1">
	<tr>
		<td>No</td>
		<td>Vendor</td>
		<td>Total</td>
		<td>0-30</td>
		<td>31-60</td>
		<td>61-90</td>
		<td>91-180</td>
		<td>>180</td>

	</tr>
	

<?php 

extract(PopulateForm());
$data = $this->db->query("sp_AgingSummaryAP '".inggris_date($tgl)."'")
							 ->result();

$i= 0; 
$total = 0;
foreach($data as $row): 
$i++;
//$persen = ($row->pay / $row->selling_price) * 100;

	
// $totel = $row->mbase_amt + $row->mtax_amt - $row->mtax_deduct_amt;
			// $total = $total + $totel;
?>
	<tr>
		<td><?=$i?></td>
		<td><?=$row->nm_Supplier?></td>
		<td><?=number_format($row->total)?></td>		
		<td><?=number_format($row->satu)?></td>
		<td><?=number_format($row->dua)?></td>
		<td><?=number_format($row->tiga)?></td>
		<td><?=number_format($row->empat)?></td>
		<td><?=number_format($row->lima)?></td>
		
		

	</tr>	
<?php endforeach ?>
	
</table>
