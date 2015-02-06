<html>
<head>
	<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url()?>assets/css/icon.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" />

	<!--script language="javascript" src="<?=base_url()?>assets/js/jquery-1.7.2.min.js"></script-->
	<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.edatagrid.js"></script>
	<?=script('jquery.formx.js')?>
	<?=script('currency.js')?>
</head>
<body>

<form id="formAdd" method="post" action="<?php echo base_url();?>akunting/moveaset/move/<?php echo @$data->id?>">
	<br>
	<table>
		<tr>
			<h2>FORM ADD</h2>
		</tr>
		<tr>
			<td>Kode Aset</td>
			<td> : </td>
			<td><input type="text" name="kode" style="width:205px;padding:3px;border:1px solid #cbcbcb" value="<?=@$data->kd_aset?>" readonly/></td>
		</tr>
		<tr>
			<td>Lokasi (sebelumnya)</td>
			<td> : </td>
			<td>
				<select name="" style="width:205px;padding:3px;border:1px solid #cbcbcb">
					<option></option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Lokasi (tujuan)</td>
			<td> : </td>
			<td>
				<select name="" style="width:205px;padding:3px;border:1px solid #cbcbcb">
					<option></option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Keterangan</td>
			<td> : </td>
			<td><textarea style="width:205px;padding:3px;border:1px solid #cbcbcb"></textarea></td>
		</tr>
		<tr></tr>
		<tr>
			<td><input type="submit" value="SAVE"/></td>
			<td><input type="reset" value="RESET"/></td>
		</tr>
	</table>
</form>

</body>

<script type="text/javascript">
$('#formAdd').ajaxForm({
	success:function(response){
		if(response=="sukses"){
			alert(response);
			refreshTable();
		}else{
			alert(response);
		}
	}
});
</script>

</html>