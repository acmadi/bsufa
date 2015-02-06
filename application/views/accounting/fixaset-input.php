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

<script type="text/javascript">
$(document).ready(function() {
    function hitung(){
    	var qty = parseInt($("#qty").val());
        var satuan = parseInt($("#satuan").val().replace(/,/g,''));
        var total = (satuan * qty);
        $("#total").val(numToCurr(total));	
    }

    $("#qty").keyup(function() {
    	hitung();
    });
});
</script>

<script type="text/javascript">
$(function() {
	$( ".auto-complete-coa" ).autocomplete({
		source: function(request, response) {
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_coa",
				data: { term: $(".auto-complete-coa").val().replace(/ /g,'')},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		select: function (event, ui) {
			var id = ui.item.id;
			$(".coa-name").val(id);
		},
		minLength: 1
	});

	$( ".auto-complete-coa1" ).autocomplete({
		source: function(request, response) {
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_coa",
				data: { term: $(".auto-complete-coa1").val().replace(/ /g,'')},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		select: function (event, ui) {
			var id = ui.item.id;
			$(".coa-name1").val(id);
		},
		minLength: 1
	});
});
</script>

<form id="formAdd" method="post" action="<?php echo base_url();?>akunting/fixaset/savefix">
	<br>
	<table>
		<tr>
			<h2>FORM ADD</h2>
		</tr>
		<tr>
			<td>Kode Aset</td>
			<td> : </td>
			<td><input type="text" name="kd_aset" style="width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
			<td></td>
			<td>Lokasi Aset</td>
			<td> : </td>
			<td><select name="lokasi" style="width:205px;padding:3px;border:1px solid #cbcbcb">
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
			<td>Nama Aset</td>
			<td> : </td>
			<td><input type="text" name="nama" style="width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
			<td></td>
			<td>Kategori Aset</td>
			<td> : </td>
			<td><select name="kategori" style="width:205px;padding:3px;border:1px solid #cbcbcb">
				<option> PILIH KATEGORI </option>
				<?php
					foreach ($kat as $row) {?>
						<option value="<?php echo $row->kd_kategori?>">  <?php echo $row->kd_kategori." | ".$row->kategori?> </option>
					<?php }
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Harga Satuan</td>
			<td> : </td>
			<td><input type="text" name="satuan" id="satuan" class="calculate" style="text-align:right;width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
			<td></td>
			<td>Qty</td>
			<td> : </td>
			<td><input type="number" name="qty" id="qty" min="0" value="0" class="calculate" style="text-align:right;width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
		</tr>
		<tr>
			<td>Tanggal Penerimaan</td>
			<td> : </td>
			<td><input type="text" name="tgl" id="tgl" style="width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
			<td></td>
			<td>Keterangan</td>
			<td> : </td>
			<td><textarea name="remark" style="width:205px;padding:3px;border:1px solid #cbcbcb"></textarea></td>
		</tr>
		<tr>
			<td>Nilai Aset</td>
			<td> : </td>
			<td><input type="text" name="nilai" id="total" style="text-align:right;width:205px;padding:3px;border:1px solid #cbcbcb" readonly/></td>
		</tr>
		<tr>
			<td>COA 1</td>
			<td> : </td>
			<td><input type="text" name="coa1" class="auto-complete-coa" style="width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
			<td></td>
			<td>COA 2</td>
			<td> : </td>
			<td><input type="text" name="coa2" class="auto-complete-coa1" style="width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
		</tr>
		<tr>
			<td>COA Name 1</td>
			<td> : </td>
			<td><input type="text" name="" class="coa-name" style="width:205px;padding:3px;border:1px solid #cbcbcb" readonly/></td>
			<td></td>
			<td>COA Name 2</td>
			<td> : </td>
			<td><input type="text" name="" class="coa-name1" style="width:205px;padding:3px;border:1px solid #cbcbcb" readonly/></td>
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