<?=script('jquery.numeric.js')?>
<?=script('currency.js')?>
<?=link_tag(CSS_PATH.'menuform.css')?>


<script type="text/javascript">
   function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('updateprojbgt/loaddata')?>', //request ke fungsi load data di inputAP
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 $('#'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#'+type).append('<option></option>'); // buat pilihan awal pada combobox
			 for(var x=0;x<data.length;x++){
				// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); // hilangkan text loading
		  }else{
			 alert(data.error); // jika ada respon error tampilkan alert
			 //$('#combobox_customer').text('');
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }

	$(function(){
		loadData('project_id',0);
		$('#project_id').change(function(){
			loadData('cost',$('#project_id option:selected').val());
		});
		
		$('#cost').change(function(){
			loadData('subcost',$('#cost option:selected').val());
		});		
		
		
		$('#subcost').change(function(){
			var project_id = $('#project_id option:selected').val()
			var cost = $('#cost option:selected').val()
			var subcost = $('#subcost option:selected').val()
			$.post('<?=site_url('proposedbgt/tampildata')?>',
				{'project':project_id,'cost':cost,'subcost':subcost},
					function(data){
						if(data.error == undefined){
							$('#bgt').empty(); // kosongkan dahulu combobox yang ingin diisi datanya
							$('#bgt').append('<option></option>'); // buat pilihan awal pada combobox
							//alert(data.length);
							for(var x=0;x<data.length;x++){
								// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
								$('#bgt').append($('<option></option>').val(data[x].id).text(data[x].nama));
							}
						}else{
							alert(data.error); // jika ada respon error tampilkan alert
						}				
				},'json');
		});
		
		$('#bgt').change(function(){
			var proj  = $('#project_id option:selected').val();
			var cost  = $('#cost option:selected').val();
			var subcost = $('#subcost option:selected').val();
			$.getJSON('<?=site_url('proposedbgt/cekdata')?>/' + $(this).val() + '/' + proj + '/' 
			+ cost + '/' + subcost,
				function(response){
					$('#totbgt').val(response.totbgt);
					$('#actual').val(response.actual);
					$('#blc').val(response.blc);
					$('#allbgt').val(response.allbgt);
					$('#allactual').val(response.allactual);
					$('#allblc').val(response.allblc);
					$('#desc').val(response.desc);
					$('#ket').val(response.ket);
				})
		})
		
			
		$('.calculate').bind('keyup keypress',function(){
			$(this).val(numToCurr($(this).val()));
		}).numeric();
		
		
		/*Cek data*/
		$('#formAdd').validationEngine({
				beforeSuccess: function(){
					var kugiri = new RegExp(",", "g");
					var amount = parseInt($('#amount').val().replace(kugiri,""));
					var blc = parseInt($('#blc').val().replace(kugiri,""));
					
					if(amount > blc){
						alert('Amount proposed budget greater than balance annual budget');
						return true;
					}else{
						setTimeout("location.reload(true);",1500);
						return false;						
					}
				},
				
				success: function(){
					$('#formAdd').ajaxSubmit({
						success: function(data){
							alert(String(data).replace(/<\/?[^>]+>/gi, ''));
							refreshTable();
						}
					});
					return false;
				}
		});
	
		

	});
</script>
<?php
/*$attr = array('class' => 'block-content form', 'id' => 'formAdd','target','_blank');
echo form_open(site_url('project/slip_bgtproj/cekpdf'), $attr);
*/?>
<form method="post" action="<?=site_url('project/slip_bgtproj')?>" id="formAdd" target="_blank">
<h2>Proposed Budget</h2>
	<input type="hidden" name="desc" id="desc"/>
	   <?php $tgl = date('d-m-Y'); ?>
       <label for="date">Proposed Date</label><input type="text" name="tgl" style="width:100px" value="<?=$tgl?>" id="tgl" readonly="true" placeholder=""/>
 		</a>
       <br/>  
      <table>
		<tr>
			<td>Project Name</td>
			<td><select name="project_id" id="project_id" style="width:150px"></select></td>
			<td>Total Budget</td>
			<td><input type="text" name="totbgt" id="totbgt" class="input" style="background-color:grey" readonly="true"/></td>
		</tr>         
		<tr>
			<td>Structure Cost</td>
			<td><select name="cost" id="cost" style="width:150px"></select></td>
			<td>Actual Budget</td>
			<td><input type="text" name="actual" id="actual" class="input" style="background-color:grey" readonly="true"/></td>
		</tr>		
		<tr>
			<td>Sub Structure</td>
			<td><select name="subcost" id="subcost" style="width:150px"></select></td>
			<td>Balanced Budget</td>
			<td><input type="text" name="blc" id="blc" class="input" style="background-color:grey" readonly="true"/></td>
		</tr>
	   <tr> 
			<td>Budget Name</td>
			<td><select name="bgt" id="bgt" style="width:150px"></select></td>
			<td>Proposed. Amount</td>
			<td><input type="text" name="amount" id="amount" class="calculate input validate[required]" maxlength="20"/></td>
		</tr>
	   <tr> 
			<td>Budget Type</td>
			<td><input type="text" name="ket" id="ket" style="background-color:grey" readonly="true"></td>
			<td>Remark</td>
			<td><textarea name="remark" id="remark"></textarea></td>
		</tr>
		<tr>
			<td colspan="3"><input type="submit" name="save" value="Proposed" /> <input type="reset" name="reset" value="Cancel" /></td>
		  </tr>
	  </table>
</form>
<?#=form_close()?>
   
