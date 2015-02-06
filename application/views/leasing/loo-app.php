<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.form.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />

<link rel="stylesheet" href="<?=base_url()?>assets/css/menuku.css" type="text/css" />


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
                        
            });

function loadData(type,parentId){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('loo/loaddata')?>',
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


	
	//~ loadData('proj',0);
	//~ loadData('tenant',0);
	

	/*DropDown Menu*/
	$('#proj').change(function(){
			loadData('nounit',$('#proj option:selected').val());
		});
	
	
	
		
	/*event hide form*/
	$('#tenant').change(function(){
		
		//~ alert('tes');
		$.getJSON('<?=site_url('loo/tampil')?>/'+$(this).val(),
				function(data){
					    $('#tlp').val(data.customer_tlp);
						$('#alamat').val(data.customer_alamat1);
					    
					   
				});
		 
		 });
		 
		 $('#nounit').change(function(){
		
		//~ alert('tes');
		$.getJSON('<?=site_url('loo/tampilluas')?>/'+$(this).val(),
				function(data){
					    $('#luasunit').val(data.luas);

					    
					   
				});
		 
		 });

	/*fungsi validasi numeric*/
	  
	  var kugiri = new RegExp(",", "g");
	  var rep_coma = new RegExp(",", "g");
	  $('.calculate').bind('keyup keypress',function(){
			//$(this).val($(this).val());
		  $(this).val(numToCurr($(this).val()));
			
			var psm = parseInt($('#psm').val().replace(rep_coma,""));
			var period = parseInt($('#period').val().replace(rep_coma,""));
			var luasunit = ($('#luasunit').val());
			
			var totlease = (psm * luasunit)*period;
			var lpm = psm * luasunit;

			$('#totlease').val(numToCurr(totlease));
			$('#lpm').val(numToCurr(lpm));
			
			//var scpsm = parseInt($('#sc_psm').val().replace(rep_coma,""));
		//	var scbln = scpsm * luasunit;
			//$('#sc_bln').val(numToCurr(scbln));
			
			//parseInt($("#price_meter").val().replace(kugiri,""));
		  
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
<link rel="stylesheet" href="<?#=base_url()?>assets/css/menuform.css" type="text/css" />
-->
<form method='post' action='<?=site_url()?>loo/UpdateLoo' id='formadd'>
<table border="0" cellpadding="2" cellspacing="2">
	<? $today = date('d-M-Y');?>
	<input value="<?=@$data->id?>" name="id" id='cek1'type="hidden">
	<input value="<?=@$data->status?>" name="status"  id='cek2'type="hidden">
  
    <!--Customer Profile-->
    
    <tr>
		<td colspan="3" style=""><font color='#FF0000'><b><u>EDIT LOO</u></b></font></td>
    </tr>
    
    <tr>
			<td >Tgl</td>
			<td>:</td>
			<td colspan="6"><b><input  name='tgl' id='tgl'style='width:100;text-align:center;background-color:#C0C0C0' value=<?=$today?> readonly ></b></td>
	
    </tr>
    
    
    
    <tr>
	<td >NO LOO</td>
		<td >:</td>
		<td  ><input name='noref' id='noref' style='width:150;background-color:#FF8080' readonly value=<?=$data->no_loo?>></td>
	
	
		
		
			<td>Function Leased</td>
			<td>:</td>
			<td>
				<input type="radio" name="function"  id='office' value="1"/> Office
				<input type="radio" name="function"  id='retail' value="2"/> Retail
			</td>	
		
    </tr>
			
		
    
	<tr >
			
		<td>Project</td>
		<td>:</td>
		<td>
			<select name='proj' id='proj' style='width:150'>
			<option value=<?=$data->id_project?>><?=$data->nm_subproject?></option>
			<?foreach($data1 as $pro):?>
				<option value=<?=$pro->id_project?>><?=$pro->nm_subproject?></option>
				
			<?endforeach?>
			
			
			</select>
		</td>
		
		
		
			<td>Lease Period</td>
			<td>:</td>
			<td><select  name='period' id='period' style='background-color:#80FF00;width:40' readonly>
				<option><?=$data->periode?></option>
				<?$x=1;while($x<=60){?>
				<option><?=$x;$x++;?></option>
				<?}?>
			
			
			</select>Month</td>
			
				<!--<td >Service Charge per Meter</td>
				<td>:</td>
				<td><input name='sc_psm' id='sc_psm' style='width:100;text-align:right'  value =<?=number_format($data->sc_psm)?> class='validate[required] calculate' ></td>	
		-->
			
		
	</tr>
	
	<tr id='tr2'>
		<td >No Unit</td>
		<td>:</td>
		<td><select  name='nounit' id='nounit' style='width:80'  class='validate[required]' >
			<option value=<?=$data->idunit?>><?=$data->nounit?></option>
		</select></td>
		
			<td >Lease per SQM</td>
			<td>:</td>
			<td><input name='psm' id='psm' style='width:100;text-align:right'  class='validate[required] calculate' value=<?=number_format($data->hrg_meter)?> ></td>
			<!--
				<td >Service Charge per Month</td>
				<td>:</td>
				<td><input name='sc_bln' id='sc_bln' value=<?=number_format($data->sc_bln)?> style='width:100;text-align:right;background-color:#80FFFF' readonly ></td>
			-->
			
	</tr>
	
	<tr>
		<td>Area</td>
		<td>:</td>
		<td><input name='luasunit' id='luasunit' style='width:60;background-color:#80FF00'  value=<?=$data->luas?> readonly>Sqm</td>
			
			<td >Lease per Month </td>
			<td>:</td>
			<td><input  name='lpm' id='lpm'  style='background-color:#80FF00;width:100;text-align:right;'  readonly value=<?=number_format($data->hrg_bln)?>></td>
			
				<td >Deposit Leased</td>
				<td>:</td>
				<td><input name='depoleas' id='psm' style='width:100;text-align:right'  class='validate[required] calculate' value=<?=number_format($data->depo_ls)?> ></td>
				
				
	</tr>
	
	
	<tr>
		
		<td>Tenant</td>
		<td>:</td>
		<td><select name='tenant' id='tenant' style='width:150' readonly>
			<option value=<?=$data->customer_id?>><?=$data->customer_nama?></option>
			<?foreach($data2 as $row):?>
			<option value=<?=$row->customer_id?>><?=$row->customer_nama?></option>
			<?endforeach?>
		
		</select></td>
			<td >Total Leased</td>
				<td>:</td>
				<td><input  name='totlease' id='totlease'  style='background-color:#80FF00;width:100;text-align:right;'  readonly value=<?=number_format($data->hrg_tot)?> ></td>
				
					
					
				<td >Deposit Service Charge</td>
				<td>:</td>
				<td><input name='deposc' id='deposc' style='width:100;text-align:right'  class='validate[required] calculate' value=<?=number_format($data->depo_sc)?> ></td>
					
			
			
	</tr>
	
	<tr>
		
		<td>No.Tlp</td>
		<td>:</td>
		<td colspan='4'><input name='tlp' id='tlp' style='background-color:#FFFF00;width:80' value=<?=$row->customer_hp?> readonly></td>
		
				<td >Deposit Tlp</td>
					<td>:</td>
					<td><input name='depotlp' id='depotlp' style='width:100;text-align:right'  class='validate[required] calculate' value=<?=number_format($data->depo_tlp)?> ></td>
				
	</tr>
	
	<tr>
		<td colspan='3'><b><u>Alamat</td></u></b>
			
	</tr>
	
	<tr>
		<td colspan='6'>
			<textarea name='alamat' id='alamat' style='width:250;background-color:#FFFF00' readonly><?=$row->customer_alamat1?></textarea></td>
		<td><input type="hidden" name='luasunit' id='luasunit' style='background-color:#FFFF00;width:80' readonly></td>
	</tr>
	
	

	<tr id='tr14'>
		<td colspan="3">
			<input type="submit" name="save" value="Save"/>
			<input type="reset" name="cancel" value="Cancel"/>
		</td>
	</tr>	
</table>
</form>
