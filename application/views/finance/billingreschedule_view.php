<style>
.th{
padding:5px;
color:white;
text-align:center
}
.td{
border:1px solid lightgray;
padding:3px;
}
.mybox{
background:none;
padding:2px;
border:none
}
</style>
<?=script('currency.js')?>
<script>
function calculate(val,id){
$(id).val(numToCurr(val));
}
function sync(val,id){
var n = 0;
var tot = $('#tot').val();
for(b=1;b<=tot;b++){
n = n+parseInt($('#amount'+b).val().replace(/,/g,''));
}
$(id).val(numToCurr(val));
var b = parseInt(<?php echo $val*$jml;?>);
$('#totout').val(numToCurr(b-n));
}
$('.bunga').hide();
$('#cek_bunga').click(function(){
if($(this).is(':checked')){
$('.bunga').show();
}else{
$('.bunga').hide();
}
});
</script>
<?php
	function tambah_bulan($tgl,$i){
	 //$tgl = "2013-01-23";// pendefinisian tanggal awal
	return date('Y-m-d', strtotime('+'.$i.' months', strtotime($tgl)));
	}
?>
<?php if($val_dp==0){?>
Total Outstanding (IDR) : <input type="text" class="mybox" value="<?php echo number_format($val*$jml);?>">
Total Balance (IDR) : <input type="text" class="mybox" name="totout" id="totout" value="0">
Include Bunga : <input type="checkbox" id="cek_bunga">
<table cellspacing=0 style="width:100%">
<tr style="background:dimgray;color:white;">
	<th class="th" style="width:30px">No</td>
	<th class="th" style="width:180px">Keterangan</td>
	<th class="th" style="width:180px">Due Date</td>
	<th class="th">Amount (IDR)</th>
</tr>
<input type="hidden" id="tot" value="<?php echo $jml;?>">
<?php for($i=1;$i<=$jml;$i++){?>
<tr>
	<td class="td"><?php echo $i;?></td>
	<td class="td"><input type="text" id="pel<?php echo $i;?>" value="Cicilan Pelunasan Ke <?php echo $i;?>"name="pel<?php echo $i;?>" style="border:none;background:none" readonly="true"></td>
	<td class="td"><input type="text" class="mybox" name="due_date<?php echo $i;?>" id="due_date<?php echo $i;?>" value="<?php echo tambah_bulan($start,$i-1);?>" style="width:100%"></td>
	<td class="td" style="text-align:right"><input type="text" class="mybox" name="amount<?php echo $i;?>" id="amount<?php echo $i;?>" value="<?php echo number_format($val);?>" onkeyup="sync($(this).val(),amount<?php echo  $i;?>)" style="text-align:right;width:100%"></td>
</tr>
<tr>
	<td colspan=3 class="td bunga"><input type="text" value="Bunga Pelunasan Ke <?php echo $i;?>" id="bung<?php echo $i;?>" name="bung<?php echo $i;?>" style="border:none;background:none" readonly="true"></td>
	<td class="td bunga" style="text-align:right"><input type="text" class="mybox" value="0" name="bunga<?php echo $i;?>" id="bunga<?php echo $i;?>" onkeyup="calculate($(this).val(),bunga<?php echo $i;?>)" style="text-align:right;width:100%"></td>
</tr>
<?php } ?>
</table>
<?php }else{ ?>
<script>
function sync_dp(){
var jml = $('#jml').val();
if($('#pay_dp').val()!=''){
var ndp = parseInt($('#pay_dp').val());
}else{
var ndp = 0;
}
if(ndp>jml){
alert('Melebihi Jumlah Row');
$('#pay_dp').val(0)
}else{
	for(a=1;a<=jml;a++){
	if(a<=ndp){
	$('#pel'+a).val('Cicilan DP '+a);
	$('#bung'+a).val('Bunga DP '+a);
	$('#row'+a).css('background','#CCF3CF');
	}else{
	x = a-ndp;
	$('#pel'+a).val('Peluanasan Ke '+x);
	$('#bung'+a).val('Bunga Pelunasan Ke '+x);
	$('#row'+a).css('background','pink');
	}
	$('#rowb'+a).css('background','#EBF5FD');
	}
}
}
</script>
<table border=0>
<tr>
<td>Jumlah DP </td>
<td>: </td>
<td><input type="text" id="pay_dp" name="pay_dp" onkeyup="sync_dp();"></td>
</tr>
<input type="hidden" id="jml" value="<?php echo $jml;?>">
</table>
Total Outstanding (IDR) : <input type="text" class="mybox" value="<?php echo number_format($val*$jml);?>">
Total Balance (IDR) : <input type="text" class="mybox" name="totout" id="totout" value="0">
Include Bunga : <input type="checkbox" id="cek_bunga">
<table cellspacing=0 style="width:100%">
<tr style="background:dimgray;color:white;">
	<th class="th" style="width:30px">No</td>
	<th class="th" style="width:180px">Keterangan</td>
	<th class="th" style="width:180px">Due Date</td>
	<th class="th">Amount (IDR)</th>
</tr>
<input type="hidden" id="tot" name="totdp" value="<?php echo $jml;?>">
<?php for($i=1;$i<=$jml;$i++){?>
<tr id="row<?php echo $i;?>">
	<td class="td"><?php echo $i;?></td>
	<td class="td"><input type="text" id="pel<?php echo $i;?>" name="pel<?php echo $i;?>" style="border:none;background:none" readonly="true"></td>
	<td class="td"><input type="text" class="mybox" name="due_date<?php echo $i;?>" id="due_date<?php echo $i;?>" value="<?php echo tambah_bulan($start,$i-1);?>" style="width:100%"></td>
	<td class="td" style="text-align:right"><input type="text" class="mybox" name="amount<?php echo $i;?>" id="amount<?php echo $i;?>" value="<?php echo number_format($val);?>" onkeyup="sync($(this).val(),amount<?php echo  $i;?>)" style="text-align:right;width:100%"></td>
</tr>
<tr id="rowb<?php echo $i;?>">
	<td colspan=3 class="td bunga"><input type="text" id="bung<?php echo $i;?>" name="bung<?php echo $i;?>" style="border:none;background:none" readonly="true"></td>
	<td class="td bunga" style="text-align:right"><input type="text" class="mybox" value="0" name="bunga<?php echo $i;?>" id="bunga<?php echo $i;?>" onkeyup="calculate($(this).val(),bunga<?php echo $i;?>)" style="text-align:right;width:100%"></td>
</tr>
<?php } ?>
<?php } ?>
<br>