<?=script('currency.js')?>	
<script type="text/javascript">
	//var kugiri = new RegExp(",", "g");
		
	function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('proposedbgt/loaddata')?>', //request ke fungsi load data di inputAP
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

	//$(function(){
			var kugiri = new RegExp(",", "g");
			
			$(".calculate").bind('keyup keypress',function(){
				$(this).val(numToCurr($(this).val()));
						var amount = parseInt($("#am").val().replace(kugiri,""));
						var xblc = parseInt($("#xblc").val().replace(kugiri,""));
						
						if(amount > xblc) {
							alert("Pengajuan Budget Anda lebih besar dari Sisa Budget, Ulangi");
							$("[name=totalbgt]").val('');
							$("[name=totalprop]").val('');
							$("[name=amount]").val('');
							$("[name=xblc]").val('');
						}	
				
			
			});
			

				loadData('proj_id',0);
				$('#proj_id').change(function(){
					loadData('scost',$('#proj_id option:selected').val());
				});

				$('#scost').change(function(){
					loadData('sscost',$('#scost option:selected').val());
				});			
				
				$('#sscost').change(function(){
					loadData('codebgt',$('#sscost option:selected').val());
				});					
				
				$('#codebgt').change(function(){
					   
						$.getJSON('<?=site_url('proposedbgt/getgrandtotal')?>/'+$(this).val(),
							function(data){
								
								$("#totalbgt").val(numToCurr(data.tot1));
								$("#totalprop").val(numToCurr(data.tot2));
								$("#xblc").val(numToCurr(data.tot3));
								
							});
							
								
					})
					
					/*$("[name=amount]").change(function(){
						var amount = parseInt($("#am").val().replace(kugiri,""));
						var xblc = parseInt($("[name=xblc]").val().replace(kugiri,""));
						
						if(amount > xblc) {
							alert("Pengajuan Budget Anda lebih besar dari Sisa Budget, Ulangi");
							$("[name=totalbgt]").val('');
							$("[name=totalprop]").val('');
							$("[name=amount]").val('');
							$("[name=xblc]").val('');
						}	
					});*/
					
				/*$('#codebgt').change(function(){
						$.getJSON('<?=site_url('proposedbgt/gettotprop')?>/'+$(this).val(),
							function(data){
								$("#totalprop").val(numToCurr(data.totprop));
								//var totp = parseInt($("#totalprop").val().replace(kugiri,""));
								//alert(totp);
							});
							//alert(totp);
						
								
					})
					
				$('#codebgt').change(function(){
						$.getJSON('<?=site_url('proposedbgt/getgrandtotal')?>/'+$(this).val(),
							function(getgrandtotal){
								$("#xblc").val(numToCurr(getgrandtotal.tot3));
								//var totp = parseInt($("#totalprop").val().replace(kugiri,""));
								//alert(totp);
							});
							//alert(totp);
						
								
					})*/
					
</script>

<form method="post">
	<table class="dv-table" style="width:100px;background:#fafafa;padding:5px;margin-top:5px;">
		<input type="hidden" value="<?=$no_bgt?>" name="no_bgt" id="no_bgt"/>
		<input type="hidden" name="id_trbgtproj" id="id_trbgtproj"/>				
		<tr>
			<input style="width:180px" name="jobdet" class="easyui-validatebox" required="true" >
			<select style="width:120px" name="proj_id" id="proj_id"></select>
			<select style="width:120px" name="cost" id="scost"></select>
			<select style="width:120px" name="subcost" id="sscost"></select>
			<select style="width:120px" name="codebgt" id="codebgt"></select>
			<input style="width:120px" name="totalbgt" id="totalbgt" class="input" readonly="true" align="right">
			<input style="width:120px" name="totalprop" id="totalprop" class="input" readonly="true">
			<input style="width:120px" name="xblc" id="xblc" class="input" value="" readonly="true">
			<input style="width:120px" name="amount" id="am" class="calculate input" align="right">
			
		
			
		</tr>
		
	</table>
	<div style="padding:5px 0;text-align:right;padding-right:10px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="saveItem(<?php echo $_REQUEST['index'];?>)">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancelItem(<?php echo $_REQUEST['index'];?>)">Cancel</a>
	</div>
</form>

