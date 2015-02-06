<? $this->load->view(ADMIN_HEADER) ?>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css"/>
<script type="text/javascript">
	$(function(){
		$(document).ready(function(){
			$('#thn').append('<option></option>');
			for(var i = 2013;i < 2021;i++){
				$('#thn').append($('<option></option>').val(i).text(i));
			}
		});
		
		function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('trans_budget/loaddata')?>', //request ke fungsi load data di inputAP
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 $('#'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#'+type).append('<option>-Choose data-</option>'); // buat pilihan awal pada combobox
			 for(var x=0;x<data.length;x++){
				// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); // hilangkan text loading
		  }else{
			 alert(data.error); // jika ada respon error tampilkan alert
			 $('#'+type).text('');
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }
		
		$('#thn').change(function(){
	   loadData('code',$('#thn option:selected').val())
		});	  
		
	});
</script>
<h2>Adjustment Budget<hr width="110px" align="left"></h2>
<div class="printed">
<form method="post" action="<?=base_url()?>print/print_adjustment_account" id="formAdd" target="_blank">
   <table border="0">
	<tr>
		<td>Budget Year</td>
		<td>:</td>
		<td>
			<select name="thn" id="thn" style="width:120px"></select>
		</td>
	</tr>   
<!--
	   <tr>
	        <?php
				#$tgl = date('d-m-Y');
	        ?>
			<td>As Off</td>
			<td>:</td>
			<td>
				<input type="text" name="tgl1" id="tgl1" value="<?#=$tgl?>"  style="width:100px" readonly="true">
				<a href="JavaScript:;" onClick="return showCalendar('tgl1', 'dd-mm-y');" title="Pilih Tanggal" > 
				<img src="<?#=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>			
			</td>
	   </tr>
-->
	   <tr>
		   <td>Description Budget</td>
		   <td>:</td>
		   <td>
				<select name="code" id="code" style="width:120px"></select>
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


