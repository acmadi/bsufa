<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.4.2.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.number_format.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/validationEngine.jquery.css" type="text/css" />
<script type="text/javascript">
   $(document).ready(function(){
	   $('.hide').hide();
   });
   
   
   function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('sales/viewalokasiunit_status/loaddata')?>', //request ke fungsi load data di inputAP
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){
			 $('#'+type).empty(); 
			 $('#'+type).append('<option></option>'); 
			 for(var x=0;x<data.length;x++){
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); 
		  }else{
			 alert(data.error); 
			 $('#lunas').text('');
		  }
		},'json'  
      );
       
   }
   
$(function(){
	$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
	 }).numeric();	
	
	loadData('bayarku',0);
	loadData('type',0); 
	loadData('sales',0); 
	loadData('sales2',0); 
	
	$(document).ready(function(){
		$('.kethide').hide();
		$('.hide_x').hide();		
		$('.hide_y').hide();	
	});
	
	$('#bayarku').change(function(){
			loadData('lunas',$('#bayarku option:selected').val());
	});

	$('#lunas').change(function(){
			var unit = $('#unit').val();
			var paytipe = $('#bayarku').val();
			var paytipepl =  $('#lunas').val();
	
			$.post("<?=site_url('sales/viewalokasiunit_status/cekprice')?>",
			{'unit':unit,'paytipe':paytipe,'paytipepl':paytipepl},
			function(response){
				$('#price').text(response);
			})	
	});

	$('#type').change(function(){
			loadData('custnm',$('#type option:selected').val());
	});
	


	//Proses Form
	$('#formAdd')
		.validationEngine()
		.ajaxForm({
		success:function(response){
			if(response=='sukses'){
				alert(response);
				setTimeout("location.reload(true);",2);
			}else{
				alert(response);
			}
		}
		});		


	$('#aksi').change(function(){
		 if($('#aksi option:selected').val()=='2'){
			 	$('.kethide').hide();
			 	$('.hide_x').show();
				$('.hide_y').hide();
		}else if($('#aksi option:selected').val()=='5'){
				$('.kethide').hide();
				$('.hide_x').hide();
				$('.hide_y').show();
		}    
		else{
				$('.kethide').show();
				$('.hide_x').hide();
		}    
	});
	
	$('#cancel').click(function(){
		setTimeout("location.reload(true);",2);
	});

});	

</script>

<div id="wrapform">
	<form method="post" action="<?=site_url('sales/viewsalesadminunit_status/updatestatus')?>" id="formAdd">
		<input type="hidden" name="unit" id="unit" value="<?=$cek->unit_id?>"/>
		<?php $tgl = date("Y-m-d");?>
		<input type="hidden" name="tgl" id="tgl" value="<?=$tgl?>"/> 
		<table id="tabel" border="0" cellspacing="2" cellpadding="2" width="750" height="450">
			<tr>
				<td colspan="3" align="center"><img src="<?=$cek->unit_pic?>" height="150" width="120"></td>
				
			</tr>		
			<tr>
			<tr>
				<td style="border-bottom:doted" colspan="3"><hr></td>
				
			</tr>		
			<tr>
				<td colspan="3"><b>Information Unit</b></td>
			
			</tr>	
			
				
			<tr>
				<td width="47">Unit</td>
				<td width="27">:</td>
				<td width="40"><span><?=$cek->unit_no?></span></td>
				<td class="hide_x">Customer Type</td>
				<td class="hide_x">:</td>
				<td class="hide_x"><span><select name="type" id="type" style="width:150px" class="validate[required]"></select></span></td>
				
			</tr>
			<tr>
				<td>View</td>
				<td>:</td>
				<td><span><?=$cek->view_unit?></span></td>
				<td class="hide_x">Customer Name</td>
				<td class="hide_x">:</td>
				<td class="hide_x"><select name="custnm" id="custnm" style="width:150px"></select></td>			
				<!--<td class="hide_y">Customer Name</td>
				<td class="hide_y">:</td>
				<td class="hide_y"><input type="text" name="cust" id="cust" style="width:150px" /></td>	-->
			</tr>
			
			
				
			</tr>			
			<tr>
				<td>Floor</td>
				<td>:</td>
				<td><span><?=substr($cek->unit_no,3,2)?></span></td> <!--Floor diganti utk Bintaro-->
				<td width="85" class="hide_x">Sales Name</td>
				<td width="6" class="hide_x">:</td>
				<td width="25" class="hide_x"><select name="sales" id="sales" style="width:150px"></select></td>	
				<td width="85" class="hide_y">Sales Name</td>
				<td width="6" class="hide_y">:</td>
				<td width="25" class="hide_y"><select name="sales2" id="sales2" style="width:150px" class="xinput validate[required]>"></select></td>		
			</tr>
			<tr>
				<td>Nett Sqm</td>
				<td>:</td>
				<td><span><?=$cek->tanah?>&nbsp;m2</span></td>				
				<td width="85" class="hide_x">Reserved Amount</td>
				<td width="6" class="hide_x">:</td>
				<td width="25" class="hide_x"><input type="text" name="amount" id="amount" style="text-align:right" class="calculate" maxlength="12px"/></td>	
			</tr>
			<tr>
				<td>Semigross Sqm</td>
				<td>:</td>
				<td colspan="4"><span><?=$cek->bangunan?>&nbsp;m2</span></td>				
			</tr>			
			<tr>
				<td>Pricelist</td>
				<td>:</td>
				<td ><span>Rp&nbsp;&nbsp;<?=number_format($cek->pricelist_ppn)?></span></td>				
			</tr>						
			<tr>
				<td>Status</td>
				<td>:</td>
				<td ><span><?=$cek->unitstatus_nm?>&nbsp;</span></td>				
			</tr>
			<tr>
				<td>Action</td>
				<td>:</td>
				<td >
					<select name="aksi" id="aksi" style="width:100px">
					<option>- Pilih -</option>
					<option value="5">Blok Unit</option>
					<option value="2">Reserved</option>
					<!--<option value="5">Proses Dealing</option>-->
					
					
					</select>
				</td>				
			</tr>
			<tr>
				<td class="hide_x">Keterangan</td>
				<td class="hide_x">:</td>
				<td colspan="4">
					
					<td class="hide_x"><textarea name="ket" width="50" height="40"></textarea></td>		
				</td>				
			</tr>
			
			
			<!--<tr>
				<td colspan="6" style="padding:20 0 0 0"><b>Pricelist</b></td>
			</tr>
			<tr>
				<td>Cara bayar</td>
				<td>:</td>
				<td colspan="4">
					<select name="bayar" id="bayarku" style="width:100px"></select>
				</td>				
			</tr>
			<tr>
				<td>Pelunasan</td>
				<td>:</td>
				<td colspan="4">
					<select name="lunas" id="lunas" style="width:100px"></select>				
				</td>				
			</tr>			
			<tr>
				<td>Price List</td>
				<td>:</td>
				<td colspan="4"><span id="price"></span></td>				
			</tr>	-->	
			<tr>
				<td colspan="6" style="padding:20 0 0 0">
					<input type="submit" name="proses" value="Proses"/>
					<input type="button" id="cancel" value="Cancel"/>
				</td>
			</tr>	
		</table>
	</form>	
</div>
