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
   
   
   
   
 
   
});


</script>



<h2><font color='red' size='4'>PAYMENT CUSTOMER REPORT<hr width="150px" align="left"></font></h2>
<div class="printed">
<form method="post" action="<?=base_url()?>sales/report_salespayment/salespayment_report" target="_blank">
<table border="0">
	<tr>
		<td>Project Name</td>
		<td>:</td>
		<td>
			<select name="subproject" id="subproject" style="width:100px">
				
			</select>
		</td>
	</tr> 
	
	    <tr>
		<td>Periode</td>
		<td>:</td>
		<td>
			<input type="text" style="width:100px" name="start_date" id="start_date" class="xinput validate[required]" readonly="true">
			<a href="JavaScript:;" onClick="return showCalendar('start_date', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
		
		</td>
		<td>To</td>
		<td>:</td>
		<td>
			<input type="text" style="width:100px" name="end_date" id="end_date" class="xinput validate[required]" readonly="true">
			<a href="JavaScript:;" onClick="return showCalendar('end_date', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
				
			</select>
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
