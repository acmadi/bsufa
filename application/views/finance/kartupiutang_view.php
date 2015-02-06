<?
$this->load->view(ADMIN_HEADER);
?>

<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/icon.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" />

<!--script language="javascript" src="<?=base_url()?>assets/js/jquery-1.7.2.min.js"></script-->
<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.edatagrid.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>

<script type="text/javascript">


 function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      //$.post('<?=site_url('denda_customer/loaddata')?>', //request ke fungsi load data di inputAP
      $.post('<?=site_url('finance/kartupiutang_call/loaddata')?>', //request ke fungsi load data di inputAP
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 $('#'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#'+type).append('<option></option>'); // buat pilihan awal pada combobox
			 //alert(data.length);
			 for(var x=0;x<data.length;x++){
				// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); // hilangkan text loading
		  }else{
			 alert(data.error); // jika ada respon error tampilkan alert
			 //$('#subproject').text('');
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }




$(function(){
            $.fn.datebox.defaults.formatter = function(date) {
                        var y = date.getFullYear();
                        var m = date.getMonth() + 1;
                        var d = date.getDate();
                        return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
            };
		$('#tgl1').datebox({  
        required:true  
    });     
		$('#tgl2').datebox({  
        required:true  
    });  
	
	loadData('subproject',0);	
	
	$('#subproject').change( 
		function(){
			if($('#unit option:selected').val() != '')
				loadData('unit',$('#subproject option:selected').val());				
		}
	);
      
 });
 
</script>
<h2><font color='red' size='4'>Laporan Kartu Piutang <hr width="150px" align="left"></font></h2>
<form method="post" action="<?=base_url()?>finance/kartupiutang_call/cetakkartupiutang" target="_blank">
<table>

	<tr>
		<td>Project</td>
			<td>:</td>
				<td>
					<select name="subproject" id="subproject" class="xinput"></select>
				</td>
	</tr>
	<tr>
		<td>KD Tenant</td>
			<td>:</td>
				<td><select name='unit' id='unit' class='xinput'></select></td>
	</tr>
		
	<tr>
		<td>Periode</td>
		<td>:</td>
		<td colspan='3'><input type="text" name="tgl1" id="tgl1" class="required" style="width:120px">To
		<input type="text" name="tgl2" id="tgl2"  class="required" style="width:120px"></td>		
	</tr>
		
	
	
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><input type="submit" name="klik" id="klik" value="Print"/>
		<!--<input type="submit" name="klik" id="klik" value="Print to Excel"/>-->
		</td>
	</tr>
	
</table>
</form>

<?
$this->load->view(ADMIN_FOOTER);
?>
