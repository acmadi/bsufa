<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<table border="1">
	<tr>
		<td>No</td>
		<td>Unit No</td>
		<td>Customer</td>
		<td>Tgl SP</td>
		<td>Harga (Include VAT)</td>
		<td>Harga (Exclude VAT)</td>
		<td>Payment</td>
		<td>Persen</td>
		<td>Sales Executive</td>
		<td>Sales Manager</td>
		<td>Sales Dept Head</td>
		<td>Sales Div Head</td>
		<td>Customer Service</td>
		<td>Administrasi</td>
		<td>PIC</td>
		<td>Sales</td>

	</tr>
	

<?php 

extract(PopulateForm());
	$data = $this->db->query("sp_reportkomisi ".$id."")
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
		<td><?=$row->unit_no?></td>
		<td><?=$row->customer_nama?></td>
		<td><?=indo_date($row->tgl_sales)?></td>
		<td><?=number_format($row->selling_price)?></td>		
		<td><?=number_format($row->exclude)?></td>
		<td><?=number_format($row->payment)?></td>
		<td><?=number_format($row->persen)?></td>
		<td><?=number_format($row->sales)?></td>
		<td><?=number_format($row->manager)?></td>
		<td><?=number_format($row->dept_head)?></td>
		<td><?=number_format($row->div_head)?></td>
		<td><?=number_format($row->cs)?></td>
		<td><?=number_format($row->admin)?></td>
		<td><?=$row->PIC?></td>
		<td><?=$row->nama_sales?></td>
		
		

	</tr>	
<?php endforeach ?>
	
</table>
