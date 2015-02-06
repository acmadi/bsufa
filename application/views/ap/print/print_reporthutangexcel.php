<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=kartu_hutang.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border=1>
<tr>
	<td>No</td>
	<td>A/P</td>
	<td>Doc No</td>
	<td>Date</td>
	<td>Description</td>
	<td>Debet</td>
	<td>Credit</td>
	<td>Saldo</td>
</tr>
<?php
extract(PopulateForm());
			$oo = $this->db->query("sp_kartuhutang '".$pt."','".$project."','".inggris_date($startdate)."','".inggris_date($enddate)."'");
			$dd = $oo->result();
			$no = 1;
$td = 0;
$tc = 0;
$ts = 0;
foreach($dd as $row){?>
<tr>
	<td><?php echo $no;?></td>
	<td><?php echo $row->doc_no;?></td>
	<td><?php echo ' ';?></td>
	<td><?php echo $row->due_date;?></td>
	<td><?php echo $row->descs;?></td>
	<td><?php echo ' ';?></td>
	<td><?php echo $row->base_amt;?></td>
	<td><?php echo $row->base_amt;?></td>
</tr>
<?php
	$cb = $this->db->query("sp_getcashbook ".$row->apinvoice_id."")->row();
if(!empty($cb)){ ?>
<tr>
	<td><?php echo ' ';?></td>
	<td><?php echo $row->doc_no;?></td>
	<td><?php echo $cb->voucher;?></td>
	<td><?php echo $cb->payment_date;?></td>
	<td><?php echo $cb->descs;?></td>
	<td><?php echo $cb->amount;?></td>
	<td><?php echo ' ';?></td>
	<td><?php echo '0';?></td>
</tr>
<tr>
	<td colspan=5 align="center">Sub Total</td>
	<td><?php echo $cb->amount;?></td>
	<td><?php echo $row->base_amt;?></td>
	<td><?php echo '0';?></td>
</tr>
<?php 
$td = $td+$cb->amount;
$tc = $tc+$row->base_amount;
$ts = $ts+0;
}else{ ?>
<tr>
	<td colspan=5 align="center">Sub Total</td>
	<td><?php echo ' ';?></td>
	<td><?php echo $row->base_amt;?></td>
	<td><?php echo $row->base_amt;?></td>
</tr>
<?php 
$td = $td+0;
$tc = $tc+$row->base_amt;
$ts = $ts+$row->base_amt;
} ?>
<?php $no++; } ?>
<tr>
	<td colspan=5 align="center">Grand Total</td>
	<td><?php echo $td;?></td>
	<td><?php echo $tc;?></td>
	<td><?php echo $ts;?></td>
</tr>
</table>