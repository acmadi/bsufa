<link href="<?=site_url()?>assets/css/validationEngine.jquery.css" rel="stylesheet" type="text/css">
<link href="<?=site_url()?>assets/css/csstableg.css" rel="stylesheet" type="text/css">
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
<form action="<?=site_url()?>project/mastervendorgmi/edityes" method="post"  id="formAdd">
<table>
	<tr>
		<td colspan='3' style='border-bottom:solid'><font color='red'><b>INPUT VENDORS MASTER</b></font></td>
	</tr>
	
	
	
	<tr id="trnama">
		<td>Nama Supplier</td>
		<td>:</td>
		<td>
			<input type="text" name="nm_supplier1" id="nm_supplier1" value="<?=@$ed->nm_supplier?>"  size="49" />
		</td>
	</tr>
	<tr id="trproject">
		<td>Project</td>
		<td width=8>:</td>
		<td width=300>
			<input type="text" readonly="true" style="background-color:#879293"  name="combobox_project" id="combobox_project" value="<?=@$ed->nm_project?>"  size="50" />
			
		</td>
	</tr>
	<tr id="trkategori">
		<td>Kategori</td>
		<td>:</td>
		<td>
			<input type="text" readonly="true" style="background-color:#879293" name="kelusaha" id="kelusaha" value="<?=@$ed->kdkel_usaha?>"  size="50" />
			
		</td>	
	</tr>
	<tr id="trnpwp">
		<td>NPWP</td>
		<td>:</td>
		<td><input type="text" name="npwp"  class="validate[required]" id="npwp" value="<?=@$ed->npwp?>"  size="49" /></td>
	</tr>
	<tr id="trakte">
		<td>Akte</td>
		<td>:</td>
		<td><input type="text" style="text-transform : uppercase" name="akte" id="akte" value="<?=@$ed->akte?>"  size="49"  /></td>
	</tr>
	<tr id="trkontak">
		<td>Kontak</td>
		<td>:</td>
		<td><input type="text" style="text-transform : uppercase" name="kontak" id="kontak" value="<?=@$ed->kontak?>"   size="49"  /></td>
	</tr>
	<tr id="tralamat">
		<td>Alamat</td>
		<td>:</td>
		<td><textarea class="validate[required]" style="text-transform : uppercase" name="alamat" id="alamat" cols=45><?=@$ed->alamat?></textarea></td>
	</tr>
	<tr id="trkota">
		<td>Kota</td>
		<td>:</td>
		<td><input type="text" class="validate[required]" style="text-transform : uppercase" name="kota" id="kota" value="<?=@$ed->kota?>"  size="49"  /></td>
	</tr>
	<tr id="trkodepos">
		<td>Kode Pos</td>
		<td>:</td>
		<td><input type="text" name="kodepos" id="kodepos" maxlength="8" size="49" value="<?=@$ed->kodepos?>" class="validate[custom[integer],length[5]]"/></td>
	</tr>
	<tr id="trtelepon">
		<td>Telepon</td>
		<td>:</td>
		<td><input type="text" name="telepon" id="telepon" class="" value="<?=@$ed->telepon?>"  size="49" /></td>
	</tr>
	<tr id="trfax">
		<td>Fax</td>
		<td>:</td>
		<td><input type="text" name="fax" id="fax" class="" value="<?=@$ed->fax?>"  size="49" /></td>
	</tr>
	<tr><td width ='250' colspan='3' style='border-bottom:solid'>&nbsp;</td></tr>

	<tr id="simpanall">
		<td width ='250' colspan='3' style='border-bottom:solid'> 
			<input type="hidden" name="kd_supp_gb1" id="kd_supp_gb" size="2" />
			<input type="hidden" name="kd_supplier1" value="<?=@$ed->kd_supplier?>" size="2" />
			<input type="submit" name="simpan" value="Simpan" />
			<input type="reset"  value="Batal" id="buttonID"/>
		</td>
	</tr>
</table>
</form>
</body>
