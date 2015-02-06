<?#=script('jquery.tabs.js')?>
<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?=script('jquery.easyui.min.js')?>
<?=script('jquery.edatagrid.js')?>
<?=script('currency.js')?>
<?=script('jquery.numeric.js')?>
<link href="<?=site_url()?>assets/css/validationEngine.jquery.css" rel="stylesheet" type="text/css">
<!--<script language="javascript" src="<?=site_url()?>assets/js/jquery-1.6.minx.js"></script>-->
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.formx.js"></script>
<?=script('datagrid-detailview.js')?>
<?=script('currency.js')?>

<? #tampilkan query?>
<script language="javascript">

$(function(){
$(document).ready(function(){
                        //~ $('#tr1').hide();
                        //~ $('#tr2').hide();
                        //~ $('#tr3').hide();
                        //~ $('#tr4').hide();
                        //~ $('#tr5').hide();
                        //~ $('#tr6').hide();
                        //~ $('#tr7').hide();
                        //~ $('#tr8').hide();
                        //~ $('#tr9').hide();
                        //~ $('#tr10').hide();
                        //~ $('#tr11').hide();
                        //~ $('#tr12').hide();
                        //~ $('#tr13').hide();
                        //~ $('#tr14').hide();
	$('#billdate').datebox({  
                                                required:true  
                                });
                        
            });

function loadData(type,parentId){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('leaseunit/loaddata')?>',
		{data_type: type, parent_id: parentId},
		function(data){
		 
		   if(data.error == undefined){ 
			 $('#'+type).empty();
			 $('#'+type).append($('<option></option>').val('').text(''));
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


	
	loadData('proj',0);
	loadData('floor',0);
	

	/*DropDown Menu*/
	$('#proj').change(function(){
			loadData('sub',$('#proj option:selected').val());
		});
	
	
	
		
	/*event hide form*/
	$('#sub').change(function(){
		
		//~ alert('tes');
		$.getJSON('<?=site_url('leaseunit/tampil')?>/'+$(this).val(),
				function(data){
					    $('#totarea').val(data.tot_luas_sewa);
						$('#leasarea').val(data.luas);
						$('#ablearea').val(data.sisa_luas);
						 
					    
					   
				});
		 
		 });
		 

	/*fungsi validasi numeric*/
	  
	  var kugiri = new RegExp(",", "g");
	  var rep_coma = new RegExp(",", "g");
	  $('.calculate').bind('keyup keypress',function(){
			//$(this).val($(this).val());
		  $(this).val(numToCurr($(this).val()));
			
			parseInt($("#price_meter").val().replace(kugiri,""));
		  
		  }).numeric();




/*validation form*/
$(function(){
		$('#formadd')
		.validationEngine()
		.ajaxForm({
			success:function(response){
				if(response == 4){
					alert("Data Berhasil Disimpan");
					refreshTable();
				}else{
				    alert(response);
				 }
			
		}
		});	
	});		
		
});
</script>




<? /*$data=$this->mstmodel->group();*/ ?>


<!--
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css" />
-->
<form method='post' action='<?=site_url()?>tenant/terminate' id='formadd'>
<table border="0" cellpadding="2" cellspacing="2">
	
  
    <!--Customer Profile-->
    <tr>
		<td colspan="3" style=""><font color='#FF0000'><b><u>Terminate Tenant</u></b></font></td>
    </tr>
    <tr>
		<td>ID</td>
		<td>:</td>
		<td>
		<input  name='idbill' id='idbill' value="<?=@$data->customer_id?>" maxlength='10' style='background-color:#FFFF00;width:80' readonly >
		</td>			
    </tr>
	 <tr>
		<td>Customer Name</td>
		<td>:</td>
		<td>
		<input  name='idbill' id='idbill'  size="50" value="<?=@$data->customer_nama?>"  style='background-color:#FFFF00' readonly >
		</td>			
    </tr>
	<tr>		
		<td>Terminate Date</td>
		<td>:</td>
		<td>	<input id="terminatedate" name="terminatedate"  class="easyui-datebox"  size="30"></input> 
		</td>
	</tr>
	
	<tr>
		<td>Description</td>
		<td>:</td>
		<td>
		<input type="text" size="60" name="descs" id="descs"  class="xinput validate[required]"class="xinput">
		</td>
	</tr>

	<tr>
		<td colspan="3">
			<input type="submit" name="save" value="Save"/>
			<input type="reset" name="cancel" value="Cancel"/>
		</td>
	</tr>	
</table>
</form>
