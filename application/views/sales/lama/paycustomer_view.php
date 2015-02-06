<? $this->load->view(ADMIN_HEADER) ?>
<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.4.2.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css"/>
<script type="text/javascript">
	$(function(){
		/*$('#klik').click(function(){
			window.open();
		});*/
	});
 function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      //$.post('<?=site_url('denda_customer/loaddata')?>', //request ke fungsi load data di inputAP
      $.post('<?=site_url('sales/paycustomer/loaddata')?>', //request ke fungsi load data di inputAP
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
		$('#unit').change( 
		function(){
			if($('#unit option:selected').val() != '')
				loadData('customername',$('#unit option:selected').val());				
		}
	);
		$('#customername').change( 
		function(){
			if($('#customername').val() != '')
				loadData('customername',$('#customername').val());				
		}
	);



});



</script>



<h2>Payment Bill<hr width="150px" align="left"></h2>
<div class="printed">
<!--<form method="post" action="<?=base_url()?>print/print_summary_budget" target="_blank">-->
<form method="post" action="<?=base_url()?>sales/paybill" target="_blank">
<table>
	<tr>
		<td>Project</td>
		<td>:</td>
		<td colspan="4">
			<select name="subproject" id="subproject" class="xinput"></select>
		</td>
	</tr>
	<tr>
		<td>Unit</td>
			<td>:</td>
				<td><select name='unit' id='unit' class='xinput'></select></td>
	
	</tr>
	<tr>
		<td>Customer Name</td>
			<td>:</td>
				<td><input name='customername' id='customername' class='xinput' ></td>
	
	</tr>
	
	<tr>
		<td>Mobile Phone</td>
			<td>:</td>
				<td><input name='hp' id='hp' class='xinput'></td>
	
	</tr>
	
	<tr>
		<td colspan='3'>Address</td>
	</tr>
	<tr>
		<td colspan='4'><textarea name='alamat' ></textarea></td>
	</tr>
<tr><td style="padding:20 0 0 0;border-bottom:solid"><b>List Of Billing </b></td></tr>
</table>	
	
	<table cellpadding='0' border='1' cellspacing='1' width='1000px'>
			<tr>
				<td style='width:50px' align='center'>No</td>
					<td style='width:150px' align='center'>Term Of Payment</td>
						<td style='width:100px' align='center'>Due Date</td>
							<td style='width:100px'align='center'>Pay Date</td>
								<td style='width:150px'align='center'>Due Amount</td>
									<td style='width:200px'align='center'>Pay Amount</td>
										<td style='width:150px' align='center'>OS</td>
											<td style='width:100px' align='center'>Status</td>
												<td style='width:50px' align='center'>Pay</td>
						
			</tr>
			
			<tr>
				<td style='width:50px' align='center'>No</td>
					<td style='width:150px'>Term Of Payment</td>
						<td style='width:100px'>Due Date</td>
							<td style='width:100px'>Pay Date</td>
								<td style='width:150px'>Due Amount</td>
									<td style='width:200px'>Pay Amount</td>
										<td style='width:150px'>OS</td>
											<td style='width:100px'>Status</td>
												<td style='width:50px'>Pay</td>
						
			</tr>
			
		

	</table>
	<input type="submit" name="save" value="Pay Bill"/>
	<input type="reset" name="cancel" value="Cancel"/>	

</form>
</div>
<?$this->load->view(ADMIN_FOOTER)?>
