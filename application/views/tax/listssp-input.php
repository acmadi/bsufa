<script language="javascript" src="<?=base_url()?>assets/js/tabcontent.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/tabcontent.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/demos.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.ui.all.css" type="text/css" />
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<!--script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script-->
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuku.css" type="text/css" />
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script><link rel="stylesheet" href="<?=base_url()?>assets/css/menuformx.css" type="text/css" />

<script language="javascript">
//FUNGSI LOAD DATA
function loadData(type,parentId){
	$('#loading').text('Loading '+type.replace('_','/')+' data...');
    $.post('<?=site_url('listssp/loaddata')?>',
	{data_type: type, parent_id: parentId},
	function(data){	 
		 if(data.error == undefined){ 
			$('#'+type).empty();
			$('#'+type).append($('<option></option>').val('').text(''));
			for(var x=0;x<data.length;x++){
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text('');
		  }else{
			 alert(data.error);
			 //$('#cb_karycutials').text('');
		  }
		},'json' 
      );      
   }	
$(function(){
	/*fungsi validasi numeric*/
	$('#namawp').change(function(){
		$.getJSON('<?=site_url('listssp/datax')?>/'+$(this).val(),
			function(datax){
				/*$('#kdakun').val(data.kd_akunpajak);
				$('#kdjns').val(data.kd_jenissetor);*/
				//alert("tes");
				$('#npwp').val(datax.npwp_wp);
				$('#alamatwp').val(datax.alamat_wp);
			});
	});
	
	
	$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
	 }).numeric();	

	//loadData(kdakun,0)
	//Dropdown tipe input
	$('#kdakun').change(function(){
		loadData('jnskode',$('#kdakun option:selected').val());
		//alert($('#kdakun option:selected').val());
		$('#uraianpem').val(data.jenissetoran);
		/*$.getJSON('<?=site_url('listssp/data')?>/'+$(this).val(),
			function(data){
				$('#kdakun').val(data.kd_akunpajak);
				$('#kdjns').val(data.kd_jenissetor);
				$('#uraianpem').val(data.jenissetoran);		*/				   
		});
		
	
	$('#jnskode').change(function(){
		$('#uraianpem').empty();
		//$('#kdakun').empty();
		$.getJSON('<?=site_url('listssp/data')?>/'+$(this).val(),
			function(data){
				//alert("tes");
				/*$('#kdakun').val(data.kd_akunpajak);
				$('#kdjns').val(data.kd_jenissetor);*/
				//alert(data.id);
				//	alert(data.jenissetoran);
					//alert(data.kd_jenissetor);
				$('#uraianpem').val(data.jenissetoran);
			});
	});
	
	
	 //Proses Form
	$('#formAdd')
	.validationEngine()
	.ajaxForm({
		success:function(response){
			//alert(response);
			//$('#btnReset').click();
			if(response=='sukses'){
				alert(response);
				refreshTable();
			}else{
				alert(response);
			}
		}
	});		
			 
	$('#btnClose').click(function(){
		$.validationEngine.closePrompt(".formError",true)
		refreshTable();
	});	
	

});
</script>

<form method="post" action="<?=site_url()?>listssp/insertSSP" id="formAdd">
	<ul id="countrytabs" class="shadetabs">
	<li><a href="#"  id="showfix" rel="country1" selected>Input Surat Setoran Pajak</a></li>
	</ul>

<div style="border:1px solid gray; width:750px; margin-bottom: 1em; padding: 10px">
	<div id="country1" class="tabcontent">
	<table border="0" cellpadding="2" cellspacing="2">
    <!--Customer Profile-->
		<tr><td colspan="3" style="padding:20 0 0 0;border-bottom:solid" colspan = '4'><b>Wajib Pajak</b></td></tr>
		<tr>
			<td>Nama*</td>
			<td>:</td>
			<td>
				<select name="namawp" id="namawp" class="xinput validate[required]">
				<option></option>
				<?php foreach($namawp as $row): ?>
				<option value="<?=$row->nama_wp ?>"><?=$row->nama_wp ?></option>
				<?php endforeach; ?>
			</select>
		</td>
		
		<td rowspan='2' colspan='2'>Address*</td>
			<td rowspan='2' colspan='2'>:</td>
			<td rowspan='2' >
				<textarea name="alamatwp" id="alamatwp"  style='width:300px' class="xinput validate[required]" >
				</textarea>
			</td>
			</tr>
		<tr>
			<td>NPWP*</td>
			<td>:</td>
			<td>
				<input name="npwp" id="npwp" style='width:150px' class="validate[required]" >
		</td>
		</tr>
		
					
		<tr>
			<td colspan="3" style="padding:20 0 0 0;border-bottom:solid" colspan = '4'><b>NOP</b>
			</td>
		</tr>
		<tr>
			<td>NOP*</td>
			<td>:</td>
			
				<td colspan ='3'><input type="text" name="nop" id="nop" style='width:150px' >
				</td>
		</td>
		
		</tr>
		<tr>
			<td>Alamat NOP*</td>
			<td>:</td>
			<td colspan ='7'>
				<textarea name="alamatnop" id="alamatnop" style='width:600px' >
				</textarea>
			</td>
		</tr>	
		<tr>
			<td colspan="3" style="padding:20 0 0 0;border-bottom:solid" colspan ='4'><b>Detil SSP</b></td>
		</tr>
		
		
		
		<tr>
			<td>Kode Akun Pajak*</td>
			<td>:</td>
			
				<td>
				<select name="kdakun" id="kdakun" class="xinput validate[required]">
				<option></option>
				<?php foreach($akunpjk as $row): ?>
				<option value=<?=$row->id_akunpajak ?>><?=$row->kd_akunpajak ?>&nbsp;-&nbsp;<?=$row->uraian_akunpajak ?></option>
				<?php endforeach; ?>
			</select>
				
				
				</td>
			
			
			<td colspan='2'>Bulan Masa Pajak*</td>
			<td colspan='2'>:</td>
			<td>
				<select name="blnmspjk"  id="blnmspjk" class="xinput validate[required]" style="width:100px">
				<option></option>
				<option value ='Januari'>Januari</option>
				<option value ='Februari'>Februari</option>
				<option value ='Maret'>Maret</option>
				<option value ='April'>April</option>
				<option value ='Mei'>Mei</option>
				<option value ='Juni'>Juni</option> 
				<option value ='Juli'>Juli</option>
				<option value ='Agustus'>Agustus</option>
				<option value ='September'>September</option>
				<option value ='Oktober'>Oktober</option>
				<option value ='November'>November</option>
				<option value ='Desember'>Desember</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Kode jenis setoran*</td>
			<td>:</td>
			<td>
				<select name ="jnskode" id="jnskode" style="width:100px"></select>
				
				
				<!--input type="text" name="kdjns" id="kdjns" style='width:150px' class="validate[required]"-->
			</td>
			<td colspan='2'>Tahun Masa Pajak*</td>
			<td colspan='2'>:</td>
			<td><input type="text" name="thnmspjk" id="thnmspjk" style='width:150px' class="input validate[required]">
				<!--select name="thnmspjk"  id="thnmspjk" class="xinput" style="width:100px">
				<option>Pilih Tahun</option>
				<option value ='2012'>2012</option>
				<option value ='2013'>2013</option>
				<option value ='2014'>2014</option>
				<option value ='2015'>2015</option>
				<option value ='2016'>2016</option>
				<option value ='2017'>2017</option>
				<option value ='2018'>2018</option>
				<option value ='2019'>2019</option>
				
				</select-->
			</td>
		</tr>
		<tr>
			<td>Uraian Pembayaran*</td>
			<td>:</td>
			<td colspan ='7'>
				<textarea name="uraianpem" id="uraianpem" style='width:600px' class="xinput validate[required]">
				</textarea>
			</td>
			
		</tr>
		<tr>
			<td>Nomor Ketetapan*</td>
			<td>:</td>
			<td><input type="text" name="noketap" id="noketap" style='width:150px' ></td>
			<td colspan='2'>Tempat tertanda WP*</td>
			<td colspan='2'>:</td>
			<td>
				<input type="text" name="tempatttdwp" id="tempatttdwp" style='width:150px' class="validate[required]">
			</td>
			
			
		</tr>		
		<tr>
			<td>Jumlah Pembayaran*</td>
			<td>:</td>
			<td><input type="text" name="jupem" id="jupem" style='width:150px' class="input validate[required]"></td>
			<td colspan='2'>Tanggal tertanda WP*</td>
			<td colspan='2'>:</td>
			<td>
				<?php $tgl=date('Y-m-d');?>
				<input type="text" name="tglttdwp" id="tglttdwp" value="" class="xinput" readonly>
			<a href="JavaScript:;" onClick="return showCalendar('tglttdwp', 'dd-mm-y');" title="Pilih Tanggal" >
			<img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
			</td>
		</tr>		
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan='2'>Nama Jelas</td>
			<td colspan='2'>:</td>
			<td>
				<input type="text" name="nmjls" id="nmjls" value="" class="xinput validate[required]">
			</td>
		</tr>		
		
							
	</table>
	<input type="submit"  id="save" value="save"/>
		
	</div>

	
</div>

<!--input type="button" name="batal" id="batal" value="batal"/-->
<!--input type="submit" name="simpan" value="Simpan"/-->
</form>




<script type="text/javascript">
var countries=new ddtabcontent("countrytabs")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()
</script>
