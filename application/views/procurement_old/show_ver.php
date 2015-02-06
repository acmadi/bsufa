<?=script('currency.js')?>	

<script type="text/javascript">

$(function(){
	
  var row = $('#ver').datagrid('getRows')[<?php echo $_REQUEST['index'];?>];
   //alert(row.kd);

  $("[name=kd]").change(function(){	
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
	var amountpr = parseInt($("#amountpr").val().replace(kugiri,""));
	//alert(amountpr);

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
	
				if(total > amountpr){
					alert("Jumlah lebih besar dari budget, Silahkan input Vendor lagi");
					$("[name=hrg]").val('');
					$("[name=disc]").val('');
					$("[name=subtotal]").val('');
					$("[name=total]").val('');
				}else{
					$("[name=subtotal]").val(numToCurr(subtotal));
					$("[name=total]").val(numToCurr(total));

				}
		
	
				
			});
		
	});
});
	

</script>

<form method="post">
	<table class="dv-table" style="width:100%;background:#fafafa;padding:5px;margin-top:5px;">
		<tr>
			<input type="hidden" value="<?=$idpr?>" name="idpr" id="idpr"/>
			
			<td>
				<!--select name="kd" id="kd">
					<option></option>
					<?php foreach($brg as $row):?>
					<option><?=$row->kd_brg_ver?></option>		
					<?php endforeach; ?>
				</select-->
				<input name="kd" readonly="true"></input>
			</td>
			<td><input name="kode"  readonly="true" style="width:110px"></td>
			<td><input name="qty"  readonly="true" style="width:40px"></input></td>
			<td><input name="satuan"  readonly="true" style="width:50px"></input></td>
			<td>
				<select name="ven" id="ven" style="width:110px">
					<option></option>
					<?php foreach($pven as $row): ?>
						<option value="<?=$row->id_pnwrven?>"><?=$row->nm_supp?>(<?=$row->kd_brg_ver?>)</option>
					<?php endforeach; ?>
				</select>
			</td>
			<td><input name="hrg" readonly="true" class="input" style="width:100px"></input></td>
			<td><input name="disc" readonly="true" style="width:100px"></input></td>
			<td><input name="subtotal" readonly="true" style="width:100px"></input></td>
			<td><input name="total" readonly="true" style="width:100px"></input></td>

		</tr>
		
	</table>
	<div style="padding:5px 0;text-align:right;padding-right:30px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="saveItem(<?php echo $_REQUEST['index'];?>)">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancelItem(<?php echo $_REQUEST['index'];?>)">Cancel</a>
	</div>
</form>

