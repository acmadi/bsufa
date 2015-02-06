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
		<td>Nama Tenant</td>
		<td>Kode Tenant</td>
		<td>Keterangan</td>
		<td>Invoice No.</td>
		<td>Tanggal</td>
		<td>Rental</td>
		<td>Materai</td>
		<td>PPN</td>
		<td>Jumlah</td>
	</tr>
	

<?php 

extract(PopulateForm());
$start_date = inggris_date($startdate);
$end_date	= inggris_date($enddate);

$data1 = $this->db->query("SP_listinvoice '".$subproject."','".$start_date."','".$end_date."',".$checkbox."");
			
$data = $data1->result();

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
		<td><?=$row->nm_subproject?></td>
		<td><?=$row->customer_nama?></td>
		<td><?=$row->kd_tenant?></td>		
		<td><?=$row->description?></td>
		<td><?=$row->no_invoice?></td>
		<td><?=indo_date($row->tgl_invoice)?></td>
		<td><?=number_format($row->base_amount)?></td>
		<td><?=number_format($row->stamp)?></td>
		<td><?=number_format($row->tax_amount)?></td>
		<td><?=number_format($row->trx_amount)?></td>
	</tr>	
<?php endforeach ?>
	
</table>
