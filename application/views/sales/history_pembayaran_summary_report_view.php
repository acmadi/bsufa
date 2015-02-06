<? $this->load->view(ADMIN_HEADER) ?>
<?=link_tag(CSS_PATH.'menuform.css')?>
<?=script('jquery-1.4.2.min.js')?>


<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css"/>

<script language="javascript">
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

$(function(){
	//Keterangannya
   $('#proj').change(function(){
	   if($('#proj option:selected').val() != '')
			loadData('unit',$('#proj option:selected').val());
   });
   
   $('input:checkbox').change(function(){
		if($("input:checkbox:checked").val()==1) {
			//alert("true");
			$('#unit').empty();
			$('#unit').append($('<option></option>').val('All').text('All'));
		}else{
			loadData('unit',$('#proj option:selected').val());
		}
   });   
   
   
    
   
});
</script>



<h2><font color='red' size='4'>Historical Sales Payment Summary Report<hr width="150px" align="left"></font></h2>
<div class="printed">
<form method="post" action="<?=base_url()?>sales/report_sales/history_pembayaran_report_summary" target="_blank">
<table border="0">
	<tr>
		<td>Project</td>
		<td>:</td>
		<td>
			<select name="proj" id="proj">
				<option></option>
				<?php foreach($data['proj'] as $row):?>
					<option value="<?=$row->subproject_id?>"><?=$row->nm_subproject?></option>
				<?php endforeach; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Unit</td>
		<td>:</td>
		<td>
			<select name="unit" id="unit"></select>
		</td>
		<td><input type="checkbox" name='all' id='all' value='1' /></td>
		<td>All</td>
	</tr>
	<tr>
		<? $tgl = date("d-m-Y");?>
		<td>Date</td>
		<td>:</td>
		<td>
			<input type="text" style="width:100px" name="start_date" id="start_date" class="xinput validate[required]" readonly="true">
			<a href="JavaScript:;" onClick="return showCalendar('start_date', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
		</td>
		<td>To</td>
		<td>
			<input type="text" style="width:100px" name="end_date" id="end_date" class="xinput validate[required]" readonly="true">
			<a href="JavaScript:;" onClick="return showCalendar('end_date', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
		</td>
	</tr>
	 <tr>
		<td colspan="3">
			<input type="submit" name="klik" id="klik" value="Print"/>
			<input type="submit" name="export" id="export" value="Convert To Excel"/>
		</td>
	</tr>
</table>
</form>
</div>
<?$this->load->view(ADMIN_FOOTER)?>
