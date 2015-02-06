<? $this->load->view(ADMIN_HEADER) ?>
<?=link_tag(CSS_PATH.'menuform.css')?>
<?=script('jquery-1.4.2.min.js')?>


<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css"/>

<script language="javascript">
$(function(){
	//FUNGSI LOAD DATA
	function loadData(type,parentId){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('view_report/report_view/loaddata')?>',
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
   //loadData('sales',0);
   loadData('subproject',0);
   
	$('input:checkbox').change(function(){
		if($("input:checkbox:checked").val()==1) {
			$('#yea').hide();
			}else { $('#yea').show();};
		
	});

});
</script>



<h2><font color='red' size='4'>Projection Report<hr width="150px" align="left"></font></h2>
<div class="printed">
<form method="post" action="<?=base_url()?>sales/projection_sales_report/sales_report" target="_blank">
<table border="0">
	<tr>
		<td>PROJECT OPTION</td>
		<td>:</td>
		<td>
			<select name="subproject" id="subproject" style="width:100px">
				
			</select>
		</td>
	</tr> 
	<!--<tr>
		<td>Detail </td>
		<td>:</td>
		<input type="hidden" name="cek" id="cek" value="0">
		<td><input type="checkbox" name='cek' id='cek' value='1' ></td>
	</tr>  
	<tr id='yea'>
		<td>Tahun</td>
		<td>:</td>
		<td>
			<select name="thn" id="thn">
				<?php FOR($i = 2012; $i < 2021; $i++): ?>
					<option><?=$i?></option>
				<?php ENDFOR; ?>
			</select>
		</td>
	</tr>-->  
	 <tr>
		<td colspan="3">
			<input type="submit" name="klik" id="klik" value="Print"/>
<!--
			<input type="submit" name="convert" id="convert" value="Convert Excel"/>
-->
		</td>
	</tr>
</table>
</form>
</div>
<?$this->load->view(ADMIN_FOOTER)?>
