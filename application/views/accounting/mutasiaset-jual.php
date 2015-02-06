<html>
<head>
	<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" />
	<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>


	<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.css" />
	<script src="<?=base_url()?>assets/js/jquery-ui-1.8.2.min.js"></script>


	<?=script('jquery.formx.js')?>
	<?=link_tag(CSS_PATH.'demo.css')?>
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
});
</script>

	<br>
	<form action="#" method="post">
		<table>
			<tr>
				<h2>FORM ADD</h2>
			</tr>
			<tr>
				<td>Kode Aset</td>
				<td> : </td>
				<td><input type="text" name="kd_aset" style="width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
				<td></td>
				<td>Nama Aset</td>
				<td> : </td>
				<td><input type="text" name="" style="width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
			</tr>
			<tr>
				<td>Jumlah Aset</td>
				<td> : </td>
				<td><input type="text" name="" style="width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
				<td></td>
				<td>Harga Satuan Aset</td>
				<td> : </td>
				<td><input type="text" name="" style="width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
			</tr>
			<tr>
				<td>Lokasi Aset</td>
				<td> : </td>
				<td><input type="text" name="" style="width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
				<td></td>
				<td>Harga Total Aset</td>
				<td> : </td>
				<td><input type="text" name="" style="width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
			</tr>
			<tr>
				<td>Tanggal Jual</td>
				<td> : </td>
				<td><input type="text" name="" id="tgl" style="width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
			</tr>
			<tr>
				<td>Kepada</td>
				<td> : </td>
				<td><input type="text" name="" style="width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
				<td></td>
				<td>Amount</td>
				<td> : </td>
				<td><input type="text" name="" class="calculate" value="0" style="width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td> : </td>
				<td><textarea name="" style="width:205px;padding:3px;border:1px solid #cbcbcb"></textarea></td>
			</tr>
			<tr>
				<td colspan="2"> <input type="submit" value="Save"/> </td>
				<td colspan="2"> <input type="reset" value="Reset"/> </td>
			</tr>
		</table>
	</form>

</body>
<script type="text/javascript">
$('.calculate').bind('keyup keypress',function(){
	$(this).val(numToCurr($(this).val()));			
});

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