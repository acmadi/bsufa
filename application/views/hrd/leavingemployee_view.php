
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
      $.post('<?=site_url('hrdreport/loaddata')?>', //request ke fungsi load data di inputAP
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
			 $('#div').text('');
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }

$(function(){ 
	loadData('div',0);	
	$('#div').change( 
		function(){
			if($('#div option:selected').val() != '')
				loadData('kary',$('#div option:selected').val());				
		}
	);
		
				
		$('#tipe').change(function(){
			proj = $('#tipe option:selected').text();
			$('#nmtype').val(proj);
		});

		
	
	$('#all').change(function(){
		$('#view').text('');
		$('#view').append('<option>ALL</option>'); 
		
	});
	
	// $('#tgl1').datebox({  
        // required:true  
    // });     
		// $('#tgl2').datebox({  
        // required:true  
    // });  
});
</script>


			


</script>

<h2><font color='red' size='4'>Leaving per Employee<hr width="150px" align="left"></font></h2>
<div class="printed">
<form method="post" action="<?=site_url('hrdreport/print_leaving')?>" target="_blank">

<table>
	<tr>
		<td>Divisi</td>
		<td>:</td>
		<td colspan="4">
			<select name="div" id="div" class="xinput" style="width:150px">

			</select>
		</td>
	</tr>
	
	<tr>
		<td>Nama Karyawan</td>
		<td>:</td>
<input type="hidden" id="nmtype" name="nmtype" >
		<td colspan="4">
			<select name="kary" id="kary" class="xinput" style="width:150px">

			</select>
		</td>
	</tr>
	
	<tr>
		<td>Periode</td>
		<td>:</td>
		<td colspan='3'><select name="tgl1" id="tgl1" class="xinput" style="width:150px">
				<option></option>
			<? for($a = 2010;$a <= 2020;$a++){ ?>
				<option value="<?=$a; ?>"><?=$a; ?></option>
				
			<?  } ?>
			</select>

			</td>		
	</tr>
	
	
	<tr><td><input type="submit" name="save" value="Print" style="width:100px"/></td></tr>
	</table>
	


</form>
	
</div>
<?php
$this->load->view(ADMIN_FOOTER);
?>


