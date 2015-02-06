<?=script('currency.js')?>	
<script type="text/javascript">
	//var kugiri = new RegExp(",", "g");
		
	function loadData(type,parentId){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('loo/loaddata')?>',
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
			

			//	loadData('unitno',0);
				loadData('project2',0);
				
				$('#project2').change(function(){
				loadData('unitno',$('#project2 option:selected').val());
				});
				
				$('#unitno').change(function(){				
				
				$.getJSON('<?=site_url('loo/getluas')?>/'+$(this).val(),
							function(data){
								
								$("#luas").val(data.luas);
								$("#harga").val(data.harga_meter);
							});	

				});                    
				
			});					
					
					
</script>

<form method="post" >
	<table class="dv-table" style="width:100%;background:#fafafa;padding:5px;margin-top:5px;">
		<input type="text" value="<?=$contract?>" name="no_bgt" id="no_bgt"/>		
		<input type="hidden" value="<?#=$rem?>" name="rem" id="rem"/>		
		<input type="hidden" value="<?#=$amo1?>" name="amo1" id="amo1"/>
		<input type="hidden" value="" name="xacc_no" id="xacc_no"/>		
		<input type="hidden" value="0" name="kodedet" id="kodedet"/>		
		<input type="hidden" type="text" value="0" name="pp_id" id="pp_id"/>
			
		<tr>			
			<td><select style="width:100px" name="project2" id="project2"></select></td>
			<td><select style="width:100px" name="unitno" id="unitno"></select></td>
			<td><input style="width:100px" name="luas"  id="luas" ></td>
			<td><input style="width:100px" name="harga"  id="harga" ></td>			
		</tr>
		
	</table>
	<div style="padding:5px 0;text-align:right;padding-right:10px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="saveItem(<?php echo $_REQUEST['index'];?>)">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancelItem(<?php echo $_REQUEST['index'];?>)">Cancel</a>
	</div>

</form>

