
<?
$this->load->view(ADMIN_HEADER);
?>

<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/icon.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" />

<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.7.2.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.edatagrid.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>

<script language="javascript">
function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      //$.post('<?=site_url('denda_customer/loaddata')?>', //request ke fungsi load data di inputAP
      $.post('<?=site_url('reporcustomeraddress/loaddata')?>', //request ke fungsi load data di inputAP
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 $('#'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#'+type).append('<option></option>'); // buat pilihan awal pada combobox
			// $('#'+type).append('<option>ALL</option>'); // buat pilihan awal pada combobox
			 for(var x=0;x<data.length;x++){
				// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); // hilangkan text loading
		  }else{
			 alert(data.error); // jika ada respon error tampilkan alert
			 $('#subproject').text('');
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }

$(function(){ 
	loadData('subproject',0);	
	$('#subproject').change( 
	
		function(){
			if($('#unit option:selected').val() != '')
				loadData('unit',$('#subproject option:selected').val());				
		}
	);
		$('#kat').change( 
		function(){
			var a = $('#kat').val();
			//alert(a);
			//~ if($('#tipe option:selected').val() != '')
				//~ loadData('tipe',$('#tipe option:selected').val());		
				$.getJSON('<?=site_url('reporcustomeraddress/gettype')?>/'+ a,
							function(data){
								$('#tipe').empty(); 
							$('#tipe').append('<option></option>'); // buat pilihan awal pada combobox
							 for(var x=0;x<data.length;x++){
								// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
								$('#tipe').append($('<option></option>').val(data[x].id).text(data[x].nama));
							 }	
							},'json');
								
							
	
	});
				
		$('#tipe').change(function(){
			proj = $('#tipe option:selected').text();
			$('#nmtype').val(proj);
		});

		
	
	$('#all').change(function(){
		$('#view').text('');
		$('#view').append('<option>ALL</option>'); 
		
	});
	 $('input:checkbox').change(function(){
		if($('input:checkbox[name=cek]:checked').val() == '1' ){
				
		 $('#kategori').hide();
		 $('#tp').hide();
	 }else{ 
		 $('#kategori').show(); 
		 $('#tp').show(); 
		
		 }
	})
	
});
</script>


			


</script>

<h2><font color='red' size='4'>Report Customer Address<hr width="150px" align="left"></font></h2>
<div class="printed">
<form method="post" action="<?=site_url('reporcustomeraddress/print_customeraddress')?>" target="_blank">

<table>
	
	
	 
	<tr>
		<td>Project</td>
		<td>:</td>
		<td colspan="4">
			<select name="proj" id="subproject" class="xinput" style="width:150px">

			</select>
		</td>
	</tr>
	<tr>
		<td>Unit</td>
			<td>:</td>
				<td><select name='unit' id='unit' class='xinput'></select></td>
	
	</tr>
	
	<tr>
		<td>All Customer </td>
		<td>:</td>
		<input type="hidden" name="cek" id="cek" value="0">
		<td><input type="checkbox" name='cek' id='cek' value='1' ></td>
	</tr>   
	<!--
	<tr id='kategori'>
		<td>Kategory</td>
		<td>:</td>
<input type="hidden" id="nmtype" name="nmtype" >
		<td colspan="4">
			<select name="kat" id="kat" class="xinput" style="width:150px">
			</select>
		</td>
	</tr>
	
	<tr id='tp'>
		<td>Type</td>
		<td>:</td>
		<td colspan="4">
			<select name="tipe" id="tipe" class="xinput" style="width:150px"></select>
		</td>
	</tr>-->
	
	<tr>
<!--
		<? $tgl = date("d-m-Y");?>
		<td>Date</td>
		<td>:</td>
		<td>
			<input type="text" name="start_date" id="start_date" class="required" style="width:120px">
		</td>
		<td>To</td>
		<td>
			<input type="text" name="end_date" id="end_date" class="required" style="width:120px">
		</td>
	</tr>
-->
	<tr>
	<td>
	<!--<input type="submit" name="save" value="Print" style="width:100px"/>-->
	
	<input type="submit" name="klik" id="klik" value="Print"/>
	<input type="submit" name="export" id="export" value="Print to Excel"/>
	
	</td>
	</tr>
	</table>
	


</form>
	
</div>
<?php
$this->load->view(ADMIN_FOOTER);
?>


