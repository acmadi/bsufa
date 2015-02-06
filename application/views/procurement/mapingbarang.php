<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?#=script('jquery-1.7.2.min.js')?>
<?=script('jquery.easyui.min.js')?>


<script type="text/javascript">
$(function(){
	
});
</script>





 <form action="" method="post">
	<input type="hidden" name="idpr" value="<?=$data->id_pr?>"/>
		<table>
			<tr>
				<td>Budget Name</td>
				<td colspan="3"><input type="text" name="bgtnm" value="<?=$data->description?>" id="bgtnm" size="40" readonly="true"/></td>
			</tr>
			<tr>
				<td>Tgl. PR</td>
				<td><input type="text" name="tglpr" id="tglpr" value="<?=gettgl(); ?>" readonly="true"/></td>
				<td>Amount</td>
				<td><input type="text" name="amountpr" id="amountpr" readonly="true" value="<?=number_format($data->amount)?>" style="text-align:right"/></td>
			</tr>
			<tr>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>No. PR</td>
				<td><input type="text" name="nopr" id="nopr" value="<?=$data->no_pr?>" style="width:200px" readonly="true"/></td>
			</tr>
			<tr>
				<td>Divisi</td>
				<td><input type="text" name="divisipr" value="<?=$data->divisi_nm?>" id="divisipr" readonly="true"/></td>
				<td>User Requestor</td>
				<td><input type="text" name="reqpr" id="reqpr" value="<?=$nama?>" readonly="true"/></td>
			</tr>		
			<tr>
				<td>Keterangan</td>
				<td colspan= "3">
				<input type="text" name="ketpr" value="<?=$data->ket_pr?>" id="ketpr" readonly="true" class="xinput validate[required]" >
				</td>
			</tr>
			</table>	


<div class="easyui-tabs" style="width:900px;height:350px;">
	<div title="Detail Barang PR" style="padding:10px;">
	</div>
	<div title="Penawaran Vendor" style="padding:10px;">
	</div>
</div>





