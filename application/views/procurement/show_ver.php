<?=script('currency.js')?>	

<script type="text/javascript">

$(function(){
	
	
  $("#kd").change(function(){	
	 var idpr = $("#idpr").val(); 
	 var kode = $(this).val();  
    $.post('<?=site_url('prverifikasi/cekven')?>', 
		{idpr: idpr, kode: kode},
		function(data){
		  if(data.error == undefined){ 
			 $('#ven').empty();
			 $('#ven').append('<option></option>'); 
			 for(var x=0;x<data.length;x++){
			 	$('#ven').append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text('');
		  }else{
			 alert(data.error); 
		  }
		},'json'
      ); 
   });


	var kugiri = new RegExp(",", "g");

	$(".calculate").bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
	});
	
	$("[name=diskon]").bind('keyup keypress',function(){
		var satuan = parseInt($('[name=satuan]').val().replace(kugiri,""));
		var diskon = parseInt($('[name=diskon]').val().replace(kugiri,""));
		
		var total = satuan - diskon;
		$("[name=total]").val(numToCurr(total));
	});
	
	$("#ven").change(function(){
		$.getJSON('<?=site_url('prverifikasi/getver_ven')?>/'+$(this).val(),
			function(data){
				var qty = parseInt($("[name=qty]").val());
				$("[name=hrg]").val(numToCurr(data.harga_sat));
				$("[name=disc]").val(numToCurr(data.discnilai));
				
				var subtotal = parseInt(data.harga_sat - data.discnilai);
				var total = subtotal * qty;
				
				$("[name=subtotal]").val(numToCurr(subtotal));
				$("[name=total]").val(numToCurr(total));
				
			});
		
	});
});
	

</script>

<form method="post">
	<table class="dv-table" style="width:100%;background:#fafafa;padding:5px;margin-top:5px;">
		<tr>
			<input type="hidden" value="<?=$idpr?>" name="idpr" id="idpr"/>
			
			<td>
				
				<input name="kd" id="kd" readonly="true"></input>
			</td>
			<td><input name="kode"  id="kode" readonly="true" style="width:110px"></input></td>
			<td><input name="satuan"  readonly="true" style="width:50px"></input></td>
			<td>
				<select name="ven" id="ven" style="width:110px">
					<option></option>
					<?php foreach($pven as $row): ?>
						<option value="<?=$row->id_pnwrven?>"><?=$row->nm_supp?></option>
					<?php endforeach; ?>
				</select>
			</td>
			
<!--
			<th field="kd" width="80px">Kode Barang</th>				
					<th field="kode" width="110px">Barang Verifikasi</th>				
					<th field="qty" width="40px">Qty</th>
					<th field="satuan" width="50px">Satuan</th>
					<th field="ven" width="120px">Vendor Winner</th>
					<th field="hrg" width="100px">Harga Satuan</th>
					<th field="disc" width="100px">Diskon</th>
					<th field="subtotal" width="100px">Subtotal</th>
					<th field="total" width="100px">Total</th>
-->
			
<!--
			<td><input name="kd" readonly="true" class="input" style="width:80px"></input></td>
			<td><input name="kode" readonly="true" class="input" style="width:110px"></input></td>
			<td><input name="qty" readonly="true" style="width:40px"></input></td>
			<td><input name="satuan" readonly="true" style="width:50px"></input></td>
			<td><input name="ven" readonly="true" style="width:120px"></input></td>
			
-->
			
			<td><input name="hrg" readonly="true" class="input" style="width:100px"></input></td>
			<td><input name="qty"  readonly="true" style="width:40px"></input></td>
			<td><input name="subtotal" readonly="true" style="width:100px"></input></td>
			<td><input name="disc" readonly="true" style="width:100px"></input></td>
			<td><input name="total" readonly="true" style="width:100px"></input></td>

		</tr>
		
	</table>
	<div style="padding:5px 0;text-align:right;padding-right:30px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="saveItem(<?php echo $_REQUEST['index'];?>)">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancelItem(<?php echo $_REQUEST['index'];?>)">Cancel</a>
	</div>
</form>

