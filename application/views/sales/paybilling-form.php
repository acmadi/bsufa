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
<form method="post" action="<?=site_url('paybilling/bayar_bill')?>" name="formAdd" id="formAdd">
<h1>Penalty Installment</h1>
<input type="hidden" name="denda_id" value="<?=@$data->sp_id?>"/>
<table border="0" cellpadding="2" cellspacing="2">
	<tr>
		<td>SP Date</td>
		<td>&nbsp;:&nbsp;&nbsp;<?=@indo_date($data->tgl_sales)?></td>
		<td></td>
	</tr>
	<tr>
		<td>Booking Fee</td>
		<td>&nbsp;:&nbsp;&nbsp;<?=number_format(@$data->bf)?></td>
		<td></td>
	</tr>
	<tr>
		<td>Downing Payment</td>
		<td>&nbsp;:&nbsp;&nbsp;<?=number_format(@$data->dp)?></td>
		<td></td>
	</tr>
	<tr>
		<td>Pelunasan</td>
		<td>&nbsp;:&nbsp;&nbsp;<?=number_format(@$data->pl)?></td>
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
		<td style="padding:0 0 10 0"><input type="checkbox" name="chk[]" id="chk" class="ceklist" value ="<?=$row->id_billing?>"></td>
		<td align="center"><?=indo_date($row->due_date)?></td>
		<td style="padding:0 0 0 150"><?=number_format($row->amount)?></td>
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
