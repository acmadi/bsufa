<?=script('currency.js')?>
<?=link_tag(CSS_PATH.'x-forminput.css')?>
<?=link_tag(CSS_PATH.'gridtable.css')?>

<script type="text/javascript">	
	$(function(){
		var btn_add=$("#add");
		var rep_coma = new RegExp(",", "g");
		
		function empty_record(){
			$('#detjob').val('')
			$('#qty').val('')
			$('#unit').val('')
			$('#price').val('')
			$('#tot_price').val('')
		}
		


		$("#add").click(function(){
			var idten = $('#idten').val();
			var detjob = $('#detjob').val();
			var qty = $('#qty').val();
			var unit = $('#unit').val();
			var price = $('#price').val();
			var tot_price = $('#tot_price').val();
			
			var stat_add=$(this).text();
			if(stat_add=='Add'){
				btn_add.empty();
				btn_add.text('Save');
				empty_record();
				$(".chinput").removeClass('readonly');
				$(".chinput").attr('readonly',false);
				$("#cancel2").show();
			}else{
					//alert(data);
					$.getJSON('<?=site_url()?>tendereval/tambahjob/'+idten+'/'+detjob+'/'+qty+'/'+unit + '/' + price + '/' + tot_price, function(data) {
					var row="<tr id='"+data.id_tendeva+"'><td>"+data.detail_job+"</td><td>"+data.qty+"</td><td>"+data.unit+"</td><td>"+data.price+"</td><td>"+data.total_price+"</td></tr>";
				//alert(row);	
				$("table#vendor tbody").append(row);
				$("#cancel2").hide();
				btn_add.empty();
				btn_add.text('Add');
				})	
			}
			

			return false;
		})
				
		$('#price').bind('keyup keypress',function(){
			var price = parseInt($('#price').val().replace(rep_coma,""));
			var qty =  parseInt($('#qty').val());
			
			var totprice = price  * qty;
			
			$('#tot_price').val(numToCurr(totprice));
		});
		
		$('.calculate').bind('keyup keypress',function(){
			$(this).val(numToCurr($(this).val()));
		}).numeric();
	});
</script>





<label>Date</label><input type="text" name="" value="<?=gettgl();?>" readonly="true"/><br/>
<label>Job</label><input type="text" name="" value="<?=@$data->job?>" readonly="true"/><br/>
<label>Tender Amount</label><input type="text" name="amount" value="<?=number_format($data->nego_ven)?>" class="input" readonly="true"/><br/>


<!-- Grid Form  -->
<div id="content">
	<h2>Detail Job</h2>
	<!-- Cek Barang -->
	<table width="800px">
		<thead>
			<th style="width:100px">Product</th>
			<th style="width:30px">QTY</th>
			<th style="width:30px">Unit</th>
			<th style="width:80px">Price</th>
			<th style="width:80px">Total Price</th>
		</thead>
		<tbody>
			<tr>
				<input type="hidden" name="idten" id="idten" value="<?=@$data->id_tendeva?>"/>
				<td width="100px"><input type="text" name="detjob" id="detjob" class="chinput rounded-corners validate[required]" maxlength="20" readonly="true"/></td>
				<td width="30px"><input type="text" name="qty" id="qty" class="chinput rounded-corners validate[required]" maxlength="20" readonly="true"/></td>
				<td width="30px">
					<select name="unit" id="unit">
						<?php foreach($satuan as $row): ?>
							  <option><?=$row->satuan?></option>
						<?php endforeach; ?>
					</select>
				</td>
				<td width="80px"><input type="text" name="price" id="price" class="chinput calculate input rounded-corners validate[required]" readonly="true"/></td>
				<td width="80px"><input type="text" name="tot_price" id="tot_price" class="chinput input calculate rounded-corners validate[required]" readonly="true"/></td>
			</tr>
		</tbody>
	</table>


	<div class='right'>
		<button type='button' class='button rounded-corners' id='add'>Add</button>
		<button type='button' class='button rounded-corners' id='cancel2' style='display:none;'>Cancel</button>
		<!--button type='button' class='button rounded-corners' id='del'>Hapus</button-->		
	</div><input type='hidden' size='15' name='total_record' id='total_record' >
	<hr/>
	<div class="terms">
		<table id="vendor" width="800px">
			<tbody>
				<?php foreach($tender as $row):?>
					<tr id="XD<?=$row->id_detailjob?>">
						<td width="100px"><?=$row->detail_job?></td>
						<td width="30px"><?=$row->qty?></td>
						<td width="30px"><?=$row->unit?></td>
						<td width="80px"><?=$row->price?></td>
						<td width="80px"><?=$row->total_price?></td>
					</tr>
				<?php endforeach;?>				
			</tbody>
		</table>
	</div><br/><br/>
</div>	<br/><br/>	
	<div class="x2"> 
		<input type="submit" value="Save" name="save"/>
		<input type="reset" value="Close" name="close" id="close"/>
	</div>
<?=form_close()?>

