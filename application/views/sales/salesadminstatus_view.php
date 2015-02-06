<?php
$this->load->view(ADMIN_HEADER);
?>
<?=link_tag(CSS_PATH.'menuform.css')?>
<?=script('jquery-1.4.2.min.js')?>
<script type="text/javascript">
 function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      //$.post('<?=site_url('denda_customer/loaddata')?>', //request ke fungsi load data di inputAP
      $.post('<?=site_url('sales/viewsalesadmin_status/loaddata')?>', //request ke fungsi load data di inputAP
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 $('#'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#'+type).append('<option>--Pilih--</option>'); // buat pilihan awal pada combobox
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
			if($('#view option:selected').val() != '')
				loadData('view',$('#subproject option:selected').val());				
		}
	);
		$('#view').change( 
		function(){
			if($('#unit option:selected').val() != '')
				loadData('customername',$('#view option:selected').val());				
		}
	);
	
	$('#all').change(function(){
		$('#view').text('');
		$('#view').append('<option>ALL</option>'); 
		
	});
});



</script>



<div style="padding:10 0 0 10">
	<form method="post" action="<?=site_url('sales/viewsalesadmin_status/view_salesadmin')?>">
	
<table>
	<tr>
		<td>Project</td>
		<td>:</td>
		<td colspan="4">
			<select name="proj" id="subproject" class="xinput"></select>
		</td>
	</tr>
	<tr>
		<td>View</td>
			<td>:</td>
				<td>
				<select name='view' id='view' class='xinput'>
				</select>
				</td><td><input type="checkbox" id="all"></td><td>All</td>

	
	</tr>
	<tr><td><input type="submit" name="save" value="View" style="width:100px"/></td></tr>
	</table>
	


</form>
	</form>
</div>
<?php
$this->load->view(ADMIN_FOOTER);
?>
