<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.4.2.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.number_format.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/validationEngine.jquery.css" type="text/css" />
<script type="text/javascript">
   function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('sales/sales_status/loaddata')?>', //request ke fungsi load data di inputAP
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
	
	$('#bayarku').change(function(){
			loadData('lunas',$('#bayarku option:selected').val());
	});

	$('#lunas').change(function(){
			var unit = $('#unit').val();
			var paytipe = $('#bayarku').val();
			var paytipepl =  $('#lunas').val();
	
			$.post("<?=site_url('sales/sales_status/cekprice')?>",
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
				setTimeout("location.reload(true);",1500);
			}else{
				alert(response);
			}
		}
		});		
});	
</script>

<div id="wrapform">
	<form method="post" action="<?=site_url('sales/sales_status/updatestatus')?>" id="formAdd">
		<input type="hidden" name="unit" id="unit" value="<?=$cek->unit_id?>"/>
		<?php $tgl = date("Y-m-d");?>
		<input type="hidden" name="tgl" id="tgl" value="<?=$tgl?>"/> 
		<table border="0" cellspacing="2" cellpadding="2">
			<tr>
				<td colspan="3"><b>Information Unit</b></td>
			
			</tr>		
			<tr>
				<td width="47">Unit</td>
				<td width="27">:</td>
				<td width="40"><span><?=$cek->unit_no?></span></td>
					</tr>
			<tr>
				<td>View</td>
				<td>:</td>
				<td><span><?=$cek->view_unit?></span></td>
				</tr>			
			<tr>
				<td>Floor</td>
				<td>:</td>
				<td><span><?=$cek->tanah?></span></td>
					</tr>
			<tr>
				<td>Nett Sqm</td>
				<td>:</td>
				<td><span><?=$cek->tanah?>&nbsp;m2</span></td>				
					</tr>
			<tr>
				<td>Semigross Sqm</td>
				<td>:</td>
				<td colspan="4"><span><?=$cek->bangunan?>&nbsp;m2</span></td>				
			</tr>			
								
			<tr>
				<td>Status</td>
				<td>:</td>
				<td colspan="4"><span><?=$cek->unitstatus_nm?>&nbsp;</span></td>				
			</tr>
			
				
		</table>
	</form>	
</div>
