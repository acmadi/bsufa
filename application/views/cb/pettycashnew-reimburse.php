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

<script type="text/javascript">
$(document).ready(function() {
	$.fn.datebox.defaults.formatter = function(date) {
        var y = date.getFullYear();
        var m = date.getMonth() + 1;
        var d = date.getDate();
        return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
    };
	$('#tgl').datebox({  
        required:true  
    });
    $('#tgl2').datebox({  
        required:true  
    });  
});
</script>

<form id="formAdd" action="<?php echo base_url();?>pettycashnew/reimbursin" method="post">
	<br>
	<table>
		<tr>
			<h2>REIMBURSE</h2>
		</tr>
		<tr>
			<td>FROM</td>
			<td> : </td>
			<td><input type="text" id="tgl" name="from" style="width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
			<td>TO</td>
			<td> : </td>
			<td><input type="text" id="tgl2" name="to" style="width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
		</tr>
		<tr>
			<td><input type="submit" value="Reimburse"/></td>
			<td><input type="reset" value="Reset"/></td>
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