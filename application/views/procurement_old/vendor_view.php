

<? $this->load->view(ADMIN_HEADER) ?>
<?=link_tag(CSS_PATH.'menuform.css')?>
<?=script('jquery-1.4.2.min.js')?>


<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css"/>
<script type="text/javascript">

 function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('procurement/print_vendor/loaddata')?>', //request ke fungsi load data di inputAP
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 $('#'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#'+type).append('<option>--Pilih--</option>'); // buat pilihan awal pada combobox
			 for(var x=0;x<data.length;x++){
				// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); // hilangkan text loading
		  }else{
			 alert(data.error); // jika ada respon error tampilkan alert
			 $('#proj').text('');
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }

$(function(){ 
	loadData('proj',0);	
	$('#proj').change( 
		function(){
			if($('#ven option:selected').val() != '')
				loadData('ven',$('#proj option:selected').val());				
		}
	);
	$('#all').change(function(){
		$('#proj').text('');
		$('#proj').append('<option>ALL</option>'); 
		$('#ven').hide();
	});
		
});



</script>


<h2><font color='red' size='4'>Vendor Report<hr width="150px" align="left"></font></h2>
<div class="printed">
<form method="post" action="<?=site_url('procurement/print_vendor/print_vendorpdf')?>" target="_blank">

<table>
	
	<tr>
		<? $tgl = date("d-m-Y");?>
		
		<td>Periode PO Date</td>
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
	
	
	<tr><td><input type="submit" name="save" value="Print" style="width:100px"/></td></tr>
	</table>
	


</form>
	
</div>
<?php
$this->load->view(ADMIN_FOOTER);
?>


