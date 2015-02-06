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

<form id="formAdd" method="post" action="<?php echo base_url();?>akunting/fixaset/updatefix/<?php echo @$data->id_aset?>">
	<br>
	<table>
		<tr>
			<h2>FORM EDIT</h2>
		</tr>
		<tr>
			<td>Kode Aset</td>
			<td> : </td>
			<td><input type="text" name="kd_aset" style="width:205px;padding:3px;border:1px solid #cbcbcb" value="<?php echo @$data->kd_aset?>" required/></td>
			<td></td>
			<td>Lokasi Aset</td>
			<td> : </td>
			<td><select name="lokasi" style="width:205px;padding:3px;border:1px solid #cbcbcb" required>
				<option></option>
				<option> PILIH LOKASI </option>
				<?php $loka = $this->db->query("select * from db_lokasi_aset order by kd_lokasi asc")->result();
					foreach ($loka as $row) {?>
						<option value="<?php echo $row->kd_lokasi?>">  <?php echo $row->kd_lokasi." | ".$row->lokasi?> </option>
					<?php }
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Nama Aset</td>
			<td> : </td>
			<td><input type="text" name="nama" style="width:205px;padding:3px;border:1px solid #cbcbcb" value="<?php echo @$data->nm_brg?>" required/></td>
			<td></td>
			<td>Kategori Aset</td>
			<td> : </td>
			<td><select name="kategori" style="width:205px;padding:3px;border:1px solid #cbcbcb" required>
				<option></option>
				<option> PILIH KATEGORI </option>
				<?php $kat = $this->db->query("select * from db_kategori_aset order by kategori asc")->result();
					foreach ($kat as $row) {?>
						<option value="<?php echo $row->kd_kategori?>">  <?php echo $row->kd_kategori." | ".$row->kategori?> </option>
					<?php }
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Tanggal Penerimaan</td>
			<td> : </td>
			<td><input type="text" name="tgl" id="tgl" style="width:205px;padding:3px;border:1px solid #cbcbcb" value="<?php echo @$data->tgl_penerimaan?>" required/></td>
			<td></td>
			<td>Keterangan</td>
			<td> : </td>
			<td><textarea name="remark" style="width:205px;padding:3px;border:1px solid #cbcbcb" required><?php echo @$data->remark?></textarea></td>
		</tr>
		<tr>
			<td>Nilai Aset</td>
			<td> : </td>
			<td><input type="text" name="nilai" class="calculate" style="text-align:right;width:205px;padding:3px;border:1px solid #cbcbcb" value="<?php echo number_format(@$data->nilai_aset)?>"/></td>
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