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

<form id="formAdd" method="post" action="<?php echo base_url();?>akunting/locaset/updateloc/<?php echo @$data->id_lokasi?>">
	<br>
	<table>
		<tr>
			<h2>FORM EDIT</h2>
		</tr>
		<tr>
			<td>Kode Lokasi</td>
			<td> : </td>
			<td><input type="text" name="kd_lokasi" style="width:205px;padding:3px;border:1px solid #cbcbcb" value="<?=@$data->kd_lokasi?>" required/></td>
		</tr>
		<tr>
			<td>Lokasi</td>
			<td> : </td>
			<td><input type="text" name="lokasi" style="width:205px;padding:3px;border:1px solid #cbcbcb" value="<?=@$data->lokasi?>" required/></td>
		</tr>
		<tr>
			<td>Detail</td>
			<td> : </td>
			<td><textarea name="detail" style="width:205px;padding:3px;border:1px solid #cbcbcb" required><?php echo @$data->detail?></textarea></td>
		</tr>
		<tr></tr>
		<tr>
			<td><input type="submit" value="UPDATE"/></td>
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