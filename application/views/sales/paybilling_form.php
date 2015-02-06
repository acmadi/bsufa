<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css" />
<script type="text/javascript">
$(function(){
	$('#chkall').click(function(){
		$('.ceklist').attr('checked',this.checked);
	});

	$(".ceklist").click(function(){
		if($(".ceklist").length == $(".ceklist:checked").length) {
			$("#chkall").attr("checked", "checked");
		}else{
			$("#chkall").removeAttr("checked");
		}
	});	
	
	$(".cekcek").change(function(){
	});
	
});      
</script>
<?php
//var_dump($data_cust->denda_nilai."-".$nil_cil->cicilan_jml);exit;
$balance = $data_cust->denda_nilai - $nil_cil->cicilan_jml;
if($balance < 0 ) $balance = 0;
?>


<form method="post" action="<?=site_url('denda_customer/bayar_denda')?>" name="formAdd" id="formAdd">
<h1>Penalty Installment</h1>
<input type="hidden" name="denda_id" value="<?=$data_cust->denda_id?>"/>
<table border="0" cellpadding="2" cellspacing="2">
	<tr>
		<td>Customer Name</td>
		<td>&nbsp;:&nbsp;&nbsp;<?=@$data_cust->customer_nama?></td>
		<td></td>
	</tr>
	<tr>
		<td>Paid Amount</td>
		<td>&nbsp;:&nbsp;&nbsp;<?=number_format(@$data_cust->denda_nilai)?></td>
		<td></td>
	</tr>
	<tr>
		<td>Balance Amount</td>
		<td>&nbsp;:&nbsp;&nbsp;<?=number_format($balance)?></td>
		<td></td>
	</tr>
	<tr>
		<td style="padding:30 0 0 0;border-bottom:solid"><input type="checkbox" name="chkall" id="chkall"/><b>Select All</b></td>
		<td style="padding:30 0 0 20;border-bottom:solid"><b>Date</b></td>
		<td style="padding:30 0 0 100;border-bottom:solid"><b>Amount</b></td>
		<td style="padding:30 0 0 80;border-bottom:solid"><b>Paid</b></td>
		
	</tr>
	
	<?php 
	$i = 0;
	foreach($cicilan as $row): 
	$i = $i+ 1;
	$nid = 'X'.$i;
	?>
	<tr>
		<td style="padding:0 0 10 0"><input type="checkbox" name="chk[]" id="chk" class="ceklist" value ="<?=$row->cicilan_id?>"></td>
		<td align="center"><?=indo_date($row->cicilan_tgl)?></td>
		<td style="padding:0 0 0 150"><?=number_format($row->cicilan_jml)?></td>
		<td style="padding:0 0 0 150">
			<input type="text" name="paid_date[]" id="<?=$nid?>" class="cekcek" style="width:85px" readonly="true"/>
			<a href="JavaScript:;" onClick="return showCalendar('<?=$nid?>', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>			
		</td>
	</tr>	
	<?php endforeach; ?>
	<tr>
		<td width ='250' colspan='6' style='border-bottom:solid'>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3"><input type="submit" name="pay" value="Pay"/></td>
	</tr>
</table>
</form>
