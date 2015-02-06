<?=script('currency.js')?>
<?=script('calendar.js')?>
<?=script('calendar2.js')?>
<?=script('jquery.validationEngine-enx.js')?>
<?=script('jquery.validationEnginex.js')?>
<?=script('jquery.formx.js')?>
<?=script('xcek.js')?>
<?=link_tag(CSS_PATH.'calendar.css')?>
<?=link_tag(CSS_PATH.'x-forminput.css')?>
<?=link_tag(CSS_PATH.'gridtable.css')?>

<script type="text/javascript">
$(function(){
		var num=$("#total_record").val();
		var id_vendor =$("table#vendor tbody tr:first").attr('id');
		$("table#vendor tbody tr:first").addClass('select');
		var btn_edit=$("#edit")
		var btn_add=$("#add");
		
		// Mengambil data dari database dan menampilakannya di form
			/*$.getJSON('<?=site_url()?>/tendereval/crud/load/'+id_vendor, function(data) {
				$("#vendor").val(data.vendor_nm);
				$("#offe").val(data.offer_ven);
				$("#score").val(data.score_ven);
				$("#remark").val(data.remark_ven);
				$("table#vendor tbody tr#"+data.id).addClass("select");
			})*/
			
		// Mengambil id_record dan meload data dari database menggunakan ajax
		$("table#vendor tbody tr").click(function(){
				alert("tes");
				var id_vendor=$(this).attr('id');
				$("table#vendor tbody tr.select").removeClass("select");
				loadForm(id_vendor);
				$("table#vendor tbody tr#"+id_product).addClass("select");
				cancel();
		})
		
		function loadForm(id_vendor){
		$.getJSON('<?=site_url()?>/tendereval/crud/load/'+id_vendor, function(data) {
				empty_record();	
				$("#vendor").val(data.vendor_nm);
				$("#offe").val(data.offer_ven);
				$("#score").val(data.score_ven);
				$("#remark").val(data.remark_ven);
				})
		}
		

		$("#add").click(function(){
			//alert("test");
			//var data=$(".chinput").serialize();
			var vendor = $('#vendor').val();
			var offe = $('#offe ').val();
			var score = $('#score').val();
			var remark = $('#remark').val();
			var idtr = $('#id_trbgtproj').val();
			
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
					$.getJSON('<?=site_url()?>tendereval/tambah/'+vendor+'/'+offe+'/'+score+'/'+remark + '/' + idtr, function(data) {
					var row="<tr id='"+data.id_vendor+"'><td>"+data.vendor_nm+"</td><td>"+data.offer_ven+"</td><td>"+data.score_ven+"</td><td>"+data.remark_ven+"</td></tr>";
					
				
				$("table#vendor tbody").append(row)
				$("#cancel2").hide();
				btn_add.empty();
				btn_add.text('Add');
				})	
			}
			

			return false;
		})
		
		
		$("#edit").click(function(){
				var id=$("#id_vendor").val();
				var stat=$(this).text();
				if(stat=='Edit'){
				$("#frm >input").removeClass('readonly');
				$("#frm >input").attr('readonly',false);
				btn_edit.empty()
				btn_edit.text('Save');
				$("#cancel").show();
				}else{
				var data=$("#frm").serialize();
				$.getJSON('<?=site_url()?>/tendereval/crud/'+data, function(data) {
					var row="<tr id='"+data.vendor+"'><td>"+data.offe+"</td><td>"+data.score+"</td><td>"+data.remark+"</td></tr>";
				$("table#vendor tbody tr#"+data.vendor_id).empty()
				$("table#vendor tbody tr#"+data.vendor_id).append(row)
				btn_edit.empty()
				$("#cancel").hide();
				btn_edit.text('Edit');		
				cancel();
				})
				}
			
													
		})
		
		$("#cancel").click(function(){
				btn_edit.empty()
				btn_edit.append('Edit');
				$(this).hide();
				cancel();
												
		})
			$("#cancel2").click(function(){
				btn_add.empty();
				btn_add.text('Add');
				cancel();
				$("#cancel2").hide();
												
		})
	
		// 
		function empty_record(){
				$("#vendor").val('')
				$("#offe").val('')
				$("#score").val('')
				$("#remark").val('')
		}
		

		// HAPUS DATA
		$("#del").click(function(){
				alert("test");
				var id=$("#id_vendor").val();
				del(id);
		})
		
	    function del(id){
		  var x=$("table#vendor tbody tr#"+id).attr('id')
		  
		  $.getJSON('<?=site_url()?>/vendor/crud/'+id, function(data) {		
			  $("table#vendor tbody tr#"+data.vendor_id).fadeOut();
				empty_record();	
				})
		  if(x!=id){
		   alert("Please, select row");
		   }
		}
	
		$("#qty, #harga_produk").keyup(function(){
			hitung();
		})
		
		$("#refbudget").change(function(){
			$.getJSON('<?=site_url()?>/tendereval/griddata/' + $(this).val(),
				function(data){
					if(data.error == undefined){
						$("table#vendor tbody tr").empty();
						for(var x=0;x<data.length;x++){
							var row="<tr id='"+data[x].participant_id+"'><td>"+data[x].vendor_nm+"</td><td>"+data[x].offer_ven+"</td><td>"+data[x].score_ven+"</td><td>"+data[x].remark_ven+"</td></tr>";
							//alert(row);
							
							$("table#vendor tbody").append(row);							
							}
						}else{
							alert(data.error); // jika ada respon error tampilkan alert
						}	
				});
			$.getJSON('<?=site_url()?>/tendereval/getdata/' + $(this).val(),
			function(response){
				$('#nmbudget').val(response.nmbudget);
				$('#ambudget').val(numToCurr(response.amount));
				$('#id_trbgtproj').val(response.id_trbgtproj);
			});
		});		
		

		function cancel(){
				
			$("#frm >input").addClass('readonly');
			$("#frm >input").attr('readonly',true);
		}
		
		function hitung(){
			var qty=$("#qty").val();
			var harga=$("#harga_produk").val();
			var jml=eval(qty*harga);
			$("#total").val(jml);
		}
		
		$('.calculate').bind('keyup keypress',function(){
			$(this).val(numToCurr($(this).val()));
		}).numeric();
		
		
	});
</script>

<h2>Tender Evaluation</h2>

<div id="x-input">
<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('tendereval/save'), $attr);
?>
	
    <fieldset>
		 <div class="x1">	
			<label for="start">Date</label><input type="text" name="tgl" value="<?=gettgl();?>" id="date" class="validate[required]" readonly="true" placeholder=""/>
			<!--a href="JavaScript:;" onClick="return showCalendar('date', 'dd-mm-y');" title="Pilih Tanggal" > 
			<img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/>
			</a-->
			<br/>
			<!--label for="name">Division</label><select name="divisi_id" id="divisi_id" class="validate[required]">
			<option value=""></option>
			<?php foreach($divisi as $row): ?>
			<option value="<?=$row->divisi_id?>"><?=$row->divisi_nm?></option>
			<?php endforeach ?>
			</select><br/-->  
			<label for="name">Budget.reff</label><select name="refbudget" id="refbudget" class="validate[required]">
			<option value=""></option>
			<?php foreach($refbudget as $row): ?>
			<option value="<?=$row->id_trbgtproj?>"><?=$row->no_trbgtproj?></option>
			<?php endforeach ?>
			</select><br/>
			<label for="name">Budget.nm</label><input type="text" name="nmbudget" id="nmbudget" class="validate[required]"/><br/>  
			<label for="name">Budget.Amount</label><input type="text" name="ambudget" id="ambudget" class="calculate input validate[required]" maxlength="20" readonly="true"/><br/>  
			
		</div>
		
	</fieldset>
 </div> 
 <!-- Grid Form  -->
<div id="content">
	<h2>Participant</h2>
	<!-- Cek Barang -->
	<table width="800px">
		<thead>
			<th style="width:150px">Name</th>
			<th style="width:150px">Offering</th>
			<th style="width:150px">Score</th>
			<th style="width:150px">Remark</th>
		</thead>
		<tbody>
			<tr>
				<td width="150px"><select name="vendor" id="vendor" class="rounded-corners validate[required]" readonly="true">
					<option value=""></option>
					<?php foreach($tendwin as $row): ?>
					<option value="<?=$row->vendor_id?>"><?=$row->vendor_nm?></option>
					<?php endforeach ?></select>
				</td>
				<td width="150px"><input type="text" name="offe" id="offe" class="chinput calculate rounded-corners validate[required]" maxlength="20" readonly="true"/></td>
				<td width="150px"><input type="text" name="score" id="score" class="chinput rounded-corners validate[required]" readonly="true"/></td>
				<td width="150px"><textarea name="remark" id="remark" class=" chinput rounded-corners validate[required]" readonly="true"></textarea></td>
			</tr>
		</tbody>
	</table>

	<!--button type='button' class='button rounded-corners' id='edit'>Edit</button>
	<button type='button' class='button rounded-corners' id='cancel' style='display:none;'>Cancel</button-->
	<div class='right'>
		<button type='button' class='button rounded-corners' id='add'>Add</button>
		<button type='button' class='button rounded-corners' id='cancel2' style='display:none;'>Cancel</button>
		<!--button type='button' class='button rounded-corners' id='del'>Hapus</button-->		
	</div><input type='hidden' size='15' name='total_record' id='total_record' >
	<hr/>
	<div class="terms">
		<table id="vendor" width="800px">
			<tbody></tbody>
		</table>
	</div><br/><br/>
	<div class="x1"> 
		<label for="name">Job</label><input type="text" name="jobnm" id="jobnm" /><br/>
		<label for="name">Tender Winner</label>
		<select name="tendwin" id="tendwin" class="validate[required]">
			<option></option>
			<?php foreach($tendwin as $row): ?>
			<option value="<?=$row->vendor_id?>"><?=$row->vendor_nm?></option>
			<?php endforeach ?>		
		</select>
	</div>	
</div>	<br/><br/>	
	<div class="x2"> 
		<input type="submit" value="Save" name="save"/>
		<input type="reset" value="Close" name="close" id="close"/>
	</div>
<?=form_close()?>
		
	
