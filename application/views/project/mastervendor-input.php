<?// $this->load->view(ADMIN_HEADER) ?>
<?php
$id = $lastid->kd_supplier;
$no = $id + 1; 
?>
<link href="<?=site_url()?>assets/css/validationEngine.jquery.css" rel="stylesheet" type="text/css">
<!--<script language="javascript" src="<?=site_url()?>assets/js/jquery-1.6.minx.js"></script>-->
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<script language="javascript" src="<?=base_url()?>assets/js/jquery.maskedinput.js" type="text/javascript"></script>
<script language="javascript">
$(function(){
		 $(document).ready(function(){
			 $('#kd_supplier1').hide();
			 $('#simpanall').hide();
			 $('#trnpwp').hide();
			 $('#trakte').hide();
			 $('#tralamat').hide();
			 $('#trkota').hide();
			 $('#trkodepos').hide();
			 $('#trtelepon').hide();
			 $('#trfax').hide();
			 $('#trkontak').hide();
			 $('#trproject').hide();
			 $('#trkategori').hide();
			 $('#colJenis').hide();
			 $('#trnama').hide();
		 });
		 $('select[name=kd_supplier1]').change(function(){
			 var tgl = $('#tgl_input').val();
			 $.getJSON('<?=site_url('mastervendor/data3')?>/'+$(this).val(),
				function(data3){
					$('#nm_supplier1').val(data3.nm_supplier);
					$('#kd_supp_gb').val(data3.kd_supp_gb);
					$('#npwp').val(data3.npwp);
					$('#akte').val(data3.akte);
					$('#kontak').val(data3.kontak);
					$('#alamat').val(data3.alamat);
					$('#kota').val(data3.kota);
					$('#kodepos').val(data3.kodepos);
					$('#telepon').val(data3.telepon);
					$('#fax').val(data3.fax);
				}
			 );
		 });
		 $('select[name=kelusaha]').change(function(){
			$.getJSON('<?=site_url('mastervendor/data4')?>/'+$(this).val(),
				function(data4){
					$('#kel_usaha').val(data4.kel_usaha);
				}
			);
		 });
		  $('select[name=status]').change(function(){
			if($('#status option:selected').val()=='BARU'){
				//menghapus inputan
				$('#npwp').val("");
				$('#akte').val("");
				$('#alamat').val("");
				$('#kota').val("");
				$('#kodepos').val("");
				$('#telepon').val("");
				$('#fax').val("");
				$('#kontak').val("");
				$('#nm_supplier').val("");
				//hide or show inputan				
				$('#kd_supplier1').hide();
				$('#nm_supplier').show();
				$('#trnpwp').show();
				$('#trakte').show();
				$('#tralamat').show();
				$('#trkota').show();
				$('#trkodepos').show();
				$('#trtelepon').show();
				$('#trfax').show();
				$('#trkontak').show();
				$('#trproject').show();
				$('#trkategori').show();
				$('#colJenis').show();
				$('#trnama').show();				
				$('#simpanmaster').show();
				$('#simpanall').hide();
				//attribut inputan
				$('#kd_supplier1').attr("disabled",true);
				$('#nm_supplier').attr("disabled",false);
				$('#colJenis').show();
				$('#npwp').attr("disabled",false);
				$('#npwp').attr("readonly",false);
				$('#akte').attr("readonly",false);
				$('#alamat').attr("readonly",false);
				$('#kota').attr("readonly",false);
				$('#kodepos').attr("readonly",false);
				$('#telepon').attr("readonly",false);
				$('#fax').attr("readonly",false);
				$('#kontak').attr("readonly",false);
			}else
			if($('#status option:selected').val()=='LAMA'){
				$('#nm_supplier').hide();
				$('#kd_supplier1').show();
				$('#trnpwp').show();
				$('#trakte').show();
				$('#tralamat').show();
				$('#trkota').show();
				$('#trkodepos').show();
				$('#trtelepon').show();
				$('#trfax').show();
				$('#trkontak').show();
				$('#trproject').show();
				$('#trkategori').show();
				$('#colJenis').show();
				$('#trnama').show();
				$('#simpanmaster').hide();
				$('#simpanall').show();
				$('#kd_supplier1').attr("disabled",false);
				$('#nm_supplier').attr("disabled",true);
				$('#colJenis').hide();
				$('#npwp').attr("readonly",true);
				$('#akte').attr("readonly",true);
				$('#alamat').attr("readonly",true);
				$('#kota').attr("readonly",true);
				$('#kodepos').attr("readonly",false);
				$('#telepon').attr("readonly",false);
				$('#fax').attr("readonly",true);
				$('#kontak').attr("readonly",true);
				
			}else{
				alert('Pilih Status');
			}
	  });
});
</script>
<script language="javascript">
   function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('mastervendor/loaddata')?>', //request ke fungsi load data di inputAP
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 $('#combobox_'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#combobox_'+type).append('<option>-Pilih data-</option>'); // buat pilihan awal pada combobox
			 for(var x=0;x<data.length;x++){
				// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
			 	$('#combobox_'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); // hilangkan text loading
		  }else{
			 alert(data.error); // jika ada respon error tampilkan alert
			 $('#combobox_kelusaha').text('');
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }
   $(function(){
	   // pertama kali halaman di-load, maka ambil seluruh data 
	   loadData('project',0); 	
	   // fungsi yang dipanggil ketika isi dari combobox project dipilih 
	   $('#combobox_project').change( 
	   
			function(){
				// apabila nilai pilihan tidak kosong, load data kelompok usaha
				if($('#combobox_project option:selected').val() != '')
					loadData('kelusaha',$('#combobox_project option:selected').val());
				
			}
	   );
	  $('#combobox_kelusaha').change( 
	   
			function(){
				// apabila nilai pilihan tidak kosong, load data kelompok usaha
				if($('#combobox_kelusaha option:selected').val() != '')
					loadData('pemasokmaster',$('#combobox_kelusaha option:selected').val());
				
			}
	   );
   });
</script>
<script language="javascript">
	$(function(){
		$(document).ready(function(){
		//$.mask.definitions['~'] = "[+-]";
		$('#npwp').mask("99.999.999.9-999.999",{completed:function(){alert("No. NPWP Lengkap!");}});

		$('#formAdd')
		.validationEngine()
		.ajaxForm({
			success:function(response){
				alert(response);
				refreshTable();
				//$('#buttonID').click();
			}
		});
	});});
</script>
<body>
<form action="<?=site_url()?>mastervendor/save" method="post"  id="formAdd">
<table>
	<tr>
		<td colspan='3' style='border-bottom:solid'><font color='red'><b>INPUT VENDORS MASTER</b></font></td>
	</tr>
	<tr>
		<td>Tanggal</td>
		<td>:</td>
		<td><?php $tgl=date("Y-m-d")?>
			<input type="text" name="tgl_input" readonly="true" value="<?=$tgl?>" id="tgl_input" style="width:150px"/>
			<!--<input type="text" name="tgl_input" readonly="true" value="<?=@$data->tgl_input?>" id="tgl_input" style="width:150px"/>
			<a href="JavaScript:;" onClick="return showCalendar('tgl_input', 'y-mm-dd');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a></td>-->
	</tr>
	<tr>
		<td width="117">Status Penagih</td>
		<td>:</td>
		<td><select name="status" id="status" style="width:150px">
				<option>Pilih Status Penagih</option>
				<option value="BARU" >Penagih Baru</option>
				<option value="LAMA">Penagih Lama</option>
			</select>
		</td>
	</tr>
	<tr id="colJenis">
		<td>Jenis Penagih</td>
		<td>:</td>
		<td><select name="opt1" id="opt1" style="width:150px">
				<option value="PT">PT</option>
				<option value="CV">CV</option>
				<option value="">PERSONAL</option>
			</select>
		</td>
	</tr>
	<tr id="trnama">
		<td>Nama Penagih</td>
		<td>:</td>
		<td>
			<input type="text" disabled="disabled" onfocus="true" style="text-transform : uppercase"  class="validate[required]" name="nm_supplier" id="nm_supplier"  value="<?=@$data->nm_supplier?>"  size="21"   />
			<select name="kd_supplier1" disabled="disabled"  style="width:150px" id="kd_supplier1" class="validate[required]">
				<option value="pilih">-Pilih Penagih Lama-</option>
					<?php foreach ($nm_supplier as $row):?>
						<option value=<?php echo $row->kd_supplier?>>
									  <?php echo $row->nm_supplier;?>
						</option>
					<?php endforeach ?>
			</select>
			<input type="hidden" readonly="true" name="nm_supplier1" id="nm_supplier1" value="<?=@$data->nm_supplier?>"  size="21" />
		</td>
	</tr>
	<tr id="trproject">
		<td>Project</td>
		<td width=8>:</td>
		<td width=300>
			<select size=1 name="project"  id="combobox_project" value="combobox_project" style="width:150px"></select>
		</td>
	</tr>
	<tr id="trkategori">
		<td>Kategori</td>
		<td>:</td>
		<td>
			<select name="kelusaha" id="combobox_kelusaha" style="width:150px"></select>
			<input type="hidden" readonly="true" name="kel_usaha" id="kel_usaha" value="<?=@$data->kel_usaha?>"  size="21" />
		</td>	
	</tr>
	<tr id="trnpwp">
		<td>NPWP</td>
		<td>:</td>
		<td><input type="text" name="npwp" id="npwp" value="<?=@$data->npwp?>"  size="21" /></td>
	</tr>
	<tr id="trakte">
		<td>Akte</td>
		<td>:</td>
		<td><input type="text" style="text-transform : uppercase" name="akte" id="akte" value="<?=@$data->akte?>"  size="21"  /></td>
	</tr>
	<tr id="trkontak">
		<td>Kontak</td>
		<td>:</td>
		<td><input type="text" style="text-transform : uppercase" name="kontak" id="kontak" value="<?=@$data->kontak?>"   size="21"  /></td>
	</tr>
	<tr id="tralamat">
		<td>Alamat</td>
		<td>:</td>
		<td><textarea class="validate[required]" style="text-transform : uppercase" name="alamat" id="alamat" cols=16><?=@$data->alamat?></textarea></td>
	</tr>
	<tr id="trkota">
		<td>Kota</td>
		<td>:</td>
		<td><input type="text" class="validate[required]" style="text-transform : uppercase" name="kota" id="kota" value="<?=@$data->kota?>"  size="21"  /></td>
	</tr>
	<tr id="trkodepos">
		<td>Kode Pos</td>
		<td>:</td>
		<td><input type="text" name="kodepos" id="kodepos" maxlength="8" size="21" value="<?=@$data->kodepos?>" class="validate[custom[integer],length[5]]"/></td>
	</tr>
	<tr id="trtelepon">
		<td>Telepon</td>
		<td>:</td>
		<td><input type="text" name="telepon" id="telepon" class="" value="<?=@$data->telepon?>"  size="21" /></td>
	</tr>
	<tr id="trfax">
		<td>Fax</td>
		<td>:</td>
		<td><input type="text" name="fax" id="fax" class="" value="<?=@$data->fax?>"  size="21" /></td>
	</tr>
	<tr><td width ='250' colspan='3' style='border-bottom:solid'>&nbsp;</td></tr>
	<tr id="simpanmaster">
		<td width ='250' colspan='3' style='border-bottom:solid'> 
			<input type="hidden" name="kd_supp_gb" value="<?=$no?>" size="2" />
			<input type="hidden" name="kd_supplier" value="<?=$no?>" size="2" />
			<input type="submit" name="simpan" value="Simpan" />
			<input type="reset"  value="Batal"  id="buttonID"/>
		</td>
	</tr>
	<tr id="simpanall">
		<td width ='250' colspan='3' style='border-bottom:solid'> 
			<input type="hidden" name="kd_supp_gb1" id="kd_supp_gb" size="2" />
			<input type="hidden" name="kd_supplier1" value="<?=@$data->kd_supplier?>" size="2" />
			<input type="submit" name="simpan" value="Simpan" />
			<input type="reset"  value="Batal" id="buttonID"/>
		</td>
	</tr>
</table>
</form>
</body>
<?//$this->load->view(ADMIN_FOOTER)?>
