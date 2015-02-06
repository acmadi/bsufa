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
});
</script>

<form id="formAdd" method="post" action="<?php echo base_url();?>akunting/moveaset/move">
	<br>
	<table>
		<tr>
			<h2>FORM ADD</h2>
		</tr>
		<tr>
			<td>Kode Aset</td>
			<td> : </td>
			<td><select name="kode" id="kode" style="width:205px;padding:3px;border:1px solid #cbcbcb" required>
				<option value=""> PILIH KODE </option>
				<?php
					foreach ($kdaset as $row) {?>
						<option value="<?php echo $row->kd_aset?>">  <?php echo $row->kd_aset?> </option>
					<?php }
				?>
				</select>
			</td>
			<td></td>
			<td>Nama Aset</td>
			<td> : </td>
			<td><input type="text" name="nama" id="nama" style="width:205px;padding:3px;border:1px solid #cbcbcb" required readonly/></td>
		</tr>
		<tr>
			<td>Lokasi Saat Ini</td>
			<td> : </td>
			<td><input type="text" name="lokasi" id="lokasi" style="width:205px;padding:3px;border:1px solid #cbcbcb" required readonly/></td>
			<input type="hidden" name="kd_lokasi" id="kd_lokasi" style="width:205px;padding:3px;border:1px solid #cbcbcb" required readonly/>
		</tr>
		<tr>
			<td>Lokasi Pemindahan Aset</td>
			<td> : </td>
			<td><select name="lokasi_after" style="width:205px;padding:3px;border:1px solid #cbcbcb">
				<option> PILIH LOKASI </option>
				<?php
					foreach ($loka as $row) {?>
						<option value="<?php echo $row->kd_lokasi?>">  <?php echo $row->kd_lokasi." | ".$row->lokasi?> </option>
					<?php }
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Tanggal Pemindahan</td>
			<td> : </td>
			<td><input type="text" name="tgl" id="tgl" style="width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
		</tr>
		<tr>
			<td>Keterangan</td>
			<td> : </td>
			<td><textarea name="remark" style="width:205px;padding:3px;border:1px solid #cbcbcb"></textarea></td>
		</tr>
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

$('#kode').change(function() {
	var c = $('#kode').val();
	$.ajax({
		url		: '<?=site_url();?>akunting/moveaset/get_aset',
		type	: 'post',
		data	: {'c':c},
		success	: function(data){
			$("#nama").val(data)
			
		}
	});
	$.ajax({
		url		: '<?=site_url();?>akunting/moveaset/get_lokasi',
		type	: 'post',
		data	: {'c':c},
		success	: function(data){
			$("#lokasi").val(data)
			
		}
	});
	$.ajax({
		url		: '<?=site_url();?>akunting/moveaset/get_kode_lokasi',
		type	: 'post',
		data	: {'c':c},
		success	: function(data){
			$("#kd_lokasi").val(data)
			
		}
	});
});
</script>

</html>