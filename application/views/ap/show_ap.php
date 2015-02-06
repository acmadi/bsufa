<?=script('currency.js')?>	
<script type="text/javascript">
	//var kugiri = new RegExp(",", "g");
		
	function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('apinvoice/loaddatacoa')?>', //request ke fungsi load data di inputAP
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 var acc_no = $("#xacc_no").val();
			 var gl_id = $("#gl_id").val();
			 $('#'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#'+type).append('<option>'+acc_no+'</option>'); // buat pilihan awal pada combobox
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
			var kugiri = new RegExp(",", "g");
			
			$(".calculate").bind('keyup keypress',function(){
				$(this).val(numToCurr($(this).val()));
						var amount = parseInt($("#am").val().replace(kugiri,""));
						var amount = parseInt($("#am2").val().replace(kugiri,""));
			});
			

				loadData('acc_no',0);
				$('#acc_no').change(function(){
				var des = ($("#rem").val());
				$('#descs').val(des);
				$('#am').val(0);
				$('#am2').val(0);
				
				$.getJSON('<?=site_url('apinvoice/getaccname')?>/'+$(this).val(),
							function(data){
								
								$("#acc_name").val(data.acc_name);
							});
				
				// $('#am').attr('readOnly',true);
				// $('#am2').attr('readOnly',true);
				// $('#descs').attr('readOnly',true);
				
				$('#am').bind('keyup keypress',function(){
								//alert('tes');
							$('#am2').attr('readOnly',true);
							});	
							
				$('#am2').bind('keyup keypress',function(){
								//alert('tes');
							$('#am').attr('readOnly',true);
							});	

				});                    
				
			});					
					
					
</script>

<form method="post" >
	<table class="dv-table" style="width:100%;background:#fafafa;padding:5px;margin-top:5px;">
		<input type="hidden" value="<?=$no_bgt?>" name="no_bgt" id="no_bgt"/>		
		<!--<input type="hidden" value="<?=$rem?>" name="rem" id="rem"/>		-->
		<input type="hidden" value="" name="xacc_no" id="xacc_no"/>		
		<input type="hidden" value="" name="gl_id" id="gl_id"/>		
			
		<tr>
			
			<td><select style="width:180px" name="acc_no" id="acc_no"></select></td>
			<td><input style="width:180px" name="acc_name"  id="acc_name" readonly="true"></td>
			<td><input style="width:180px" name="descs"  id="descs" readonly="true"></td>
			<td><input style="width:100px" name="debet" id="am" class="calculate input" ></td>
			<td><input style="width:100px" name="credit" id="am2" class="calculate input"></td>
		
		
			
		</tr>
		
	</table>
	<div style="padding:5px 0;text-align:right;padding-right:10px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="saveItem(<?php echo $_REQUEST['index'];?>)">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancelItem(<?php echo $_REQUEST['index'];?>)">Cancel</a>
	</div>

</form>

