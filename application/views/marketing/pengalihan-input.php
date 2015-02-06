
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />


<? #tampilkan query?>
<script language="javascript">
 function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      //$.post('<?=site_url('denda_customer/loaddata')?>', //request ke fungsi load data di inputAP
      $.post('<?=site_url('pengalihan/loaddata')?>', //request ke fungsi load data di inputAP
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
			 $('#project').text('');
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }

  

/*validation form*/
$(function(){
loadData('project',0);	
	$('#project').change( 
		function(){
			if($('#unit option:selected').val() != '')
				loadData('unit',$('#project option:selected').val());				
		}
	);
	
	
	$('#unit').change(function(){
		$.getJSON('<?=site_url('pengalihan/data')?>/'+$(this).val(),
			function(data){
				
				/*$('#kdakun').val(data.kd_akunpajak);
				$('#kdjns').val(data.kd_jenissetor);*/
				//alert(data.id);
					// alert(data.jenissetoran);
					// alert(data.kd_jenissetor);
				$('#namapemiliklama').val(data.customer_nama);
				$('#alamatsurat').val(data.customer_alamat1);
				$('#telp').val(data.customer_tlp);
				$('#idcust').val(data.customer_id);
				$('#nosp').val(data.sp_id);
			});
	});

	$('#namapemilikbaru').change(function(){
		$.getJSON('<?=site_url('pengalihan/datax')?>/'+$(this).val(),
			function(data){
			//	alert('tes');
			
				$('#alamatsurat1').val(data.customer_alamat1);
				$('#telp1').val(data.customer_tlp);
			});
	});
	
	
	

		$('#formadd')
		.validationEngine()
		.ajaxForm({
			success:function(response){
				if(response == 4){
					alert("Data Berhasil Disimpan");
					refreshTable();
				}else{
				    alert(response);
				 }
			
		}
		});	
	});		
		



	
	
</script>
	
	<!--select name="project" id="project" class="xinput">
				<option></option>
				<?php// foreach($project as $row): ?>
				<option value="<?//=$row->subproject_id ?>"><?//=$row->nm_subproject ?></option>
				<?php// endforeach; ?>
		</select-->


<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css" />
<form method='post' action='<?=site_url()?>pengalihan/insertpengalihan' id='formadd'>
<table border="0" cellpadding="2" cellspacing="2">

    <!--Pengalihan Customer-->
	<tr>
		<td colspan='6'>&nbsp;</td>
		
	</tr>
	<tr>
		<td>Proyek</td>
		<td>:</td>
		<td colspan="1">
		<select name="project" id="project" class="xinput"></select>
		</td>
		<td>Unit</td>
		<td>:</td>
		<td>
		<select type="text" name="unit" id="unit" class="xinput"></select>
		</td>
	
	</tr>
    <tr>
		<td colspan="3" style="border-bottom:solid"><b>Customer Lama</b></td>
    </tr>
    
	<tr>
		<tr>
		<td>Nama Pemilik Lama</td>
		
			<td>:</td>
				<td><input type="text" name='namapemiliklama' id='namapemiliklama' class='xinput' readonly /></td>
			<td >Alamat Surat </td>
		<td>:</td>
		<td colspan='2'><textarea name='alamatsurat' id="alamatsurat" style="width:100px" readonly></textarea></td>
		
	</tr>
			
			
	<tr>
		<td>Telephone</td>
		<td>:</td>
		<td><input type="text" name='telp' id='telp' class='xinput' readonly></td>
       
		
	</tr>
	<tr>
		<td colspan="3" style="border-bottom:solid"><b>Customer Baru</b></td>
    </tr>
	
	<tr>
		<td>Nama Pemilik Baru</td>
		<td>:</td>
		<td>
        <input type="text" id="namapemilikbaru" name="namapemilikbaru" />
        <!--select name="namapemilikbaru" id="namapemilikbaru" >
							<option></option>
							<?php // foreach($pengalihancust as $row): ?>
							<option value="<?//=$row->customer_nama  ?>"><?//=$row->customer_nama ?></option>
							<?php // endforeach; ?>
		</select--></td>	
		<td >Alamat Surat </td>
		<input type="hidden" name="idcust" id="idcust">
		<input type="hidden" name="nosp" id="nosp">
		<td>:</td>
		<td><textarea  name="alamatsurat1" class="xinput"  rowspan="2" ></textarea></td>
		
	</tr>	
	<tr>
		<td>Telephone</td>
		<td>:</td>
		<td><input type="text"   name="telp1" id="telp1" class="xinput calculate"></td>
		 <td>Saksi BSU</td>
		<td>:</td>
		<td><input type="text" name='saksibsu' id='saksibsu' class='xinput'></td>	
	</tr>
	<td>Biaya ADM</td>
		<td>:</td>
		<td><input type="text"  name="biayaadm" id="biayaadm" ></td>
        	 <td>Saksi Penjual</td>
		<td>:</td>
		<td><input type="text" name='saksipnj' id='saksipnj' class='xinput'></td>	
		
	</tr>
	<tr>
			<td>Pajak Pengalihan</td>
			<td>:</td>
		<td><input type="text" name="pajakpengalihan" id="pajakpengalihan" ></td>
	<tr>	
		<td>Tanggal Pengalihan</td>
		<td>:</td>
		<td>
			<input name="tanggalpengalihan" readonly="true" id="tanggalpengalihan" class="xinput" type="text"  size='10'>
			<a href="JavaScript:;" onClick="return showCalendar('tanggalpengalihan', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
			</td>
	
	</tr>

	
	<!-- End-->
	
	
	
	
	<tr><td width="150" colspan="3"></td></tr>
	<tr>
		<td colspan="3">
			<input type="submit" name="save" value="Save"/>
			<input type="reset" name="cancel" value="Cancel"/>
		</td>
	</tr>	
</table>
</form>
