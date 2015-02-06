<?=script('currency.js')?>	
<script type="text/javascript">
	//var kugiri = new RegExp(",", "g");
		
	function loadData(type,parentId){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('contractlease/loaddata')?>',
		{data_type: type, parent_id: parentId},
		function(data){
		 
		   if(data.error == undefined){ 
		    var trxtype = $("#xacc_no").val();
			 $('#'+type).empty();
			 $('#'+type).append('<option>'+trxtype+'</option>');
			 for(var x=0;x<data.length;x++){
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text('');
		  }else{
			 alert(data.error);
			 //$('#cb_karycutials').text('');
		  }
		},'json' 
      );      
   }

	$(function(){
			var kugiri = new RegExp(",", "g");
			
			$(".calculate").bind('keyup keypress',function(){
				$(this).val(numToCurr($(this).val()));
						//var amount = parseInt($("#am").val().replace(kugiri,""));
						var amount = parseInt($("#am2").val().replace(kugiri,""));
			});
			

				loadData('thp_bayar',0);
				loadData('tax',0);
				$('#thp_bayar').change(function(){
				var des = ($("#kode").val());
				//$('#kodedet').val(des);
				$('#persen').val(0);
				$('#fix_amount').val(0);
				$('#intvl').val(0);
				$('#freq').val(0);
				
				$.getJSON('<?=site_url('contractlease/getdescs')?>/'+$(this).val(),
							function(data){
								
								$("#xacc_no").val(data.deskripsi);
							});
				
				// $('#am').attr('readOnly',true);
				// $('#am2').attr('readOnly',true);
				// $('#descs').attr('readOnly',true);
				
				// $('#am').bind('keyup keypress',function(){
								// //alert('tes');
							// $('#am2').attr('readOnly',true);
							// });	
							
				// $('#am2').bind('keyup keypress',function(){
								// //alert('tes');
							// $('#am').attr('readOnly',true);
							// });	

				});                    
				
			});					
					
					
</script>

<form method="post" >
	<table class="dv-table" style="width:100%;background:#fafafa;padding:5px;margin-top:5px;">
		<input type="hidden" value="<?#=$no_bgt?>" name="no_bgt" id="no_bgt"/>		
		<input type="hidden" value="<?#=$rem?>" name="rem" id="rem"/>		
		<input type="hidden" value="<?#=$amo1?>" name="amo1" id="amo1"/>
	<input type="hidden" value="" name="xacc_no" id="xacc_no"/>		
	<input type="hidden" value="0" name="kodedet" id="kodedet"/>		
		<input type="hidden" type="text" value="0" name="pp_id" id="pp_id"/>
			
		<tr>
			
			<td><select style="width:180px" name="thp_bayar" id="thp_bayar"></select></td>
<!--
			<td><input style="width:180px" name="descs"  id="descs" readonly="true"></td>
-->
			<td><input style="width:40px" name="freq"  id="freq" class="calculate input"></td>
			<td><input style="width:40px" name="intvl"  id="intvl" class="calculate input"></td>
			<!--<td><input style="width:100px" name="intvl_type"  id="intvl_type"></td>-->
<!--
			<td>
			<select style="width:100px" name="intvl_type" id="intvl_type">
			<option></option>
			<option value='Day'>Day</option>
			<option value='Month'>Month</option>
			<option value='Year'>Year</option>
			</select>
			</td>
-->
			<td><input style="width:40px" name="persen" id="persen" class="calculate input" maxlength='3' ></td>
			<td><input style="width:100px" name="fix_amount" id="fix_amount" class="calculate input"></td>
			<td><select style="width:100px" name="tax" id="tax" >
			
			
			<!--<option value='0'>No Tax</option>
			<option value='ppn'>PPN</option>
			<option value='pph5'>Pph 5%</option>
			<option value='pph4'>Pph 4%</option>-->
			</select></td>
			<td><input type="radio" name="stamp"  id='office' value="1"/> Yes
				<input type="radio" name="stamp"  id='retail' value="2"/> No</td>
		
		
			
		</tr>
		
	</table>
	<div style="padding:5px 0;text-align:right;padding-right:10px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="saveItem(<?php echo $_REQUEST['index'];?>)">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancelItem(<?php echo $_REQUEST['index'];?>)">Cancel</a>
	</div>

</form>

