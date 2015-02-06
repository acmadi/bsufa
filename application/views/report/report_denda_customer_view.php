<?php $this->load->view(ADMIN_HEADER) ?>
<?php
$session_id = $this->UserLogin->isLogin();
$divisi = $session_id['divisi_id'];
?>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css"/>
<script type="text/javascript">
   function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('denda_customer/loaddata')?>', //request ke fungsi load data di inputAP
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 $('#'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#'+type).append('<option>-Pilih data-</option>'); // buat pilihan awal pada combobox
			 for(var x=0;x<data.length;x++){
				// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); // hilangkan text loading
		  }else{
			 alert(data.error); // jika ada respon error tampilkan alert
			 $('#customer_denda').text('');
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }

   function loadData2(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('denda_customer/loaddata')?>', //request ke fungsi load data di inputAP
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 $('#'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#'+type).append('<option>All</option>'); // buat pilihan awal pada combobox
			 for(var x=0;x<data.length;x++){
				// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); // hilangkan text loading
		  }else{
			 alert(data.error); // jika ada respon error tampilkan alert
			 $('#customer_denda').text('');
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }

$(function(){ 
	loadData('project_denda',0);	
	$('#project_denda').change( 
		function(){
			if($('#customer_denda option:selected').val() != '')
				loadData('customer_denda',$('#project_denda option:selected').val());				
		}
	);
	$('#customer_denda').change( 
		function(){
			if($('#denda_unit option:selected').val() != '')
				loadData('denda_unit',$('#customer_denda option:selected').val());				
		}
	);
	
	$('#denda_unit').change(function(){
		if($('#periode option:selected').val() != ''){
			loadData2('periode',$('#denda_unit option:selected').val());
		 }
	});
			
	
});
</script>
<h2>Penalty Customer<hr width="150px" align="left"></h2>
<div class="printed">
<form method="post"  action="<?=base_url()?>print/print_denda_customer" target="_blank">
<table border="0">
	<tr>
		<td>Project</td>
		<td>:</td>
		<td>
			<select name="project" id="project_denda" style="width:150px">
			</select>
		</td>
	</tr>   
	<tr>
		<td>Customer</td>
		<td>:</td>
		<td>
			<select name="customer" id="customer_denda" style="width:150px">
			</select>			
		</td>
	</tr>
	<tr>
		<td>Unit</td>
		<td>:</td>
		<td>
			<select name="unit" id="denda_unit" style="width:150px">
			</select>
		</td>
	</tr>
	<tr>
		<td>Periode</td>
		<td>:</td>
		<td>
			<select name="periode" id="periode" style="width:150px">
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<input type="submit" name="klik" id="klik" value="Print"/>
		</td>
	</tr>
</table>
</form>
</div>
<?$this->load->view(ADMIN_FOOTER)?>
