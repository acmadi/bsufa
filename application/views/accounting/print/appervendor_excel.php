<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<style type="text/css">
.text{
  mso-number-format:"\@";/*force text*/
}
</style>
<table border="1">
	<tr>
		<td><b>NO</b></td>
		<td><b>SUPPLIER</b></td>
		<td><b>NO AP</b></td>
		<td><b>TANGGAL</b></td>
		<td><b>URAIAN</b></td>
		<td><b>AMOUNT</b></td>
		<td><b>AMOUNT</b></td>
		
		
	</tr>



<?php
extract(PopulateForm());
ini_set('memory_limit','512M');
if($project==0){
$oo = $this->db->query("select a.vendor_acct,b.nm_supplier from db_apinvoice a 
	join pemasokmaster b on a.vendor_acct = b.kd_supplier
	where a.due_date >= '".inggris_date($startdate)."' and due_date <= '".inggris_date($enddate)."'
	group by a.vendor_acct,b.nm_supplier");
}else{
$oo = $this->db->query("select a.vendor_acct,b.nm_supplier from db_apinvoice a 
	join pemasokmaster b on a.vendor_acct = b.kd_supplier
	where (a.due_date >= '".inggris_date($startdate)."' and due_date <= '".inggris_date($enddate)."') and a.project_no = '$project'
	group by a.vendor_acct,b.nm_supplier");
}
$dd = $oo->result();

#$mining = $this->db->query("sp_appervendor '".$tanggal."'")->row();
//~ var_dump($data);exit();
$i = 0;
//~ $tot1 = 0;
//~ $tot2 = 0;
//~ $tot3 = 0;
//~ $tot4 = 0;
//~ $tot5 = 0;
//~ $tot6 = 0;
//~ $tot7 = 0;
//~ $tot8 = 0;
//~ $tot9 = 0;
//~ $tot10 = 0;
#foreach($mining as $row):
//~ $i++;
//~ $persen = round(($row->paid / $row->selling_price) * 100);
//~ $persen2 =$persen.'%';
//~ $overdue = $row->aging30 + $row->aging60 + $row->aging90 + $row->agingover;
//~ $os = $row->selling_price - $row->paid;
//~ $tot1 = $tot1 + $row->selling_price;
//~ $tot2 = $tot2 + $row->paid;
//~ $tot3 = $tot3 + $persen;
//~ $tot4 = $tot4 + $row->notdue;
//~ $tot5 = $tot5 + $overdue;
//~ $tot6 = $tot6 + $row->aging30;
//~ $tot7 = $tot7 + $row->aging60;
//~ $tot8 = $tot8 + $row->aging90;
//~ $tot9 = $tot9 + $row->agingover;
//~ $tot10 = $tot10 + $os;
//~ $ab = 0;
//~ $note = $ab.$row->customer_tlp;
//~ $nope = $ab.$row->customer_hp;
#$sql = $this->db->query("sp_appervendor")->row();

foreach($dd as $row):

$i++;
?>
	<tr>
		<td><?=$i?></td>
		<td><?=$row->supplier?></td>
		<td><?=$row->nomorap?></td>
		<td><?=$row->project?></td>
		
		<td><?=$row->noinvoice?></td>
		<td><?=$row->tgl_inv?></td>
		<td><?=$row->jatuhtempo?></td>
		
		<td><?=$row->uraian?></td>
		
		<td><?=number_format($row->nilai)?></td>
		<td><?=number_format($row->nilaibayar)?></td>
		<td><?=number_format($row->nilaiadj)?></td>
		<td><?=number_format($row->sisa)?></td>
		<td><?=number_format($row->dpp_pph)?></td>
		<td><?=number_format($row->pph23)?></td>
		<td><?=number_format($row->dpp_ppn)?></td>
		<td><?=number_format($row->ppn)?></td>
	</tr>
<?php endforeach ?>
	
