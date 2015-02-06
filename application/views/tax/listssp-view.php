

<form method="post" action="<?=site_url()?>listssp/insertSSP" id="formadd">
	<input type="hidden" name="code" id="code" value="<?=$data->listssp_id?>"/>

	<div style="border:1px solid gray; width:750px; margin-bottom: 1em; padding: 10px">
	<div id="country1" class="tabcontent">
	<table border="0" cellpadding="2" cellspacing="2">
    <!--Customer Profile-->
  
			

		<tr><td colspan="3" style="padding:20 0 0 0;border-bottom:solid" colspan = '4'><b>Wajib Pajak</b></td></tr>
		<tr>
			<td>Nama*</td>
			<td>:</td>
			<td>
				<input name="namawp" id="namawp" style='width:150px' value ="<?=$data->namawp?>" readonly>
		</td>
		
		<td rowspan='2' colspan='2'>Address*</td>
			<td rowspan='2' colspan='2'>:</td>
			<td rowspan='2' >
				<textarea name="alamatwp" id="alamatwp"  style='width:300px' readonly><?=$data->alamatwp?>
				</textarea>
			</td>
			</tr>
		<tr>
			<td>NPWP*</td>
			<td>:</td>
			<td>
				<input name="npwp" id="npwp" style='width:150px' value ="<?=$data->npwp?>" readonly>
		</td>
		</tr>
		
					
		<tr>
			<td colspan="3" style="padding:20 0 0 0;border-bottom:solid" colspan = '4'><b>NOP</b>
			</td>
		</tr>
		<tr>
			<td>NOP*</td>
			<td>:</td>
			
				<td colspan ='3'><input type="text" name="nop" id="nop" style='width:150px' value ="<?=$data->nop?>" readonly>
				</td>
		</td>
		
		</tr>
		<tr>
			<td>Alamat NOP*</td>
			<td>:</td>
			<td colspan ='7'>
				<textarea name="alamatnop" id="alamatnop" style='width:600px' readonly><?=$data->alamat_nop?>
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
				<input type="text" name="kdakun" id="kdakun" style='width:150px' value ="<?=$data->kd_akunpajak?>" readonly>
				</td>
			
			
			<td colspan='2'>Bulan Masa Pajak*</td>
			<td colspan='2'>:</td>
			<td>
				<input type="text" name="blnmspjk" id="blnmspjk" style='width:150px' value ="<?=$data->bln_masapajak?>" readonly>
				
			</td>
		</tr>
		<tr>
			<td>Kode jenis setoran*</td>
			<td>:</td>
			<td><input type="text" name="kdjns" id="kdjns" style='width:150px' class="validate[required]" value ="<?=$data->kd_jenissetor?>" readonly></td>
			<td colspan='2'>Tahun Masa Pajak*</td>
			<td colspan='2'>:</td>
			<td>
				
				<input type="text" name="thnmspjk" id="thnmspjk" style='width:150px' value ="<?=$data->thn_masapajak?>" readonly>
				
			</td>
		</tr>
		<tr>
			<td>Uraian Pembayaran*</td>
			<td>:</td>
			<td colspan ='7'>
				<textarea name="uraianpem" id="uraianpem" style='width:600px' class="xinput validate[required]" readonly><?=$data->jenissetoran?>
				</textarea>
			</td>
			
		</tr>
		<tr>
			<td>Nomor Ketetapan*</td>
			<td>:</td>
			<td><input type="text" name="noketap" id="noketap" style='width:150px' class="validate[required]" value ="<?=$data->no_ketetapan?>" readonly></td>
			<td colspan='2'>Tempat tertanda WP*</td>
			<td colspan='2'>:</td>
			<td>
				<input type="text" name="tempatttdwp" id="tempatttdwp" style='width:150px' class="validate[required]" value ="<?=$data->tmpt_ttdwp?>" readonly>
			</td>
			
			
		</tr>		
		<tr>
			<td>Jumlah Pembayaran*</td>
			<td>:</td>
			<td><input type="text" name="jupem" id="jupem" style='width:150px' class="input validate[required] calculate" value ="<?=$data->jml_byr?>" readonly></td>
			<td colspan='2'>Tanggal tertanda WP*</td>
			<td colspan='2'>:</td>
			<td>
				<input type="text" name="tglttdwp" id="tglttdwp" value="" class="xinput validate[required] datepicker" readonly value ="<?=$data->tgl_ttdwp?>" readonly>
			</td>
		</tr>		
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan='2'>Nama Jelas</td>
			<td colspan='2'>:</td>
			<td>
				<input type="text" name="nmjls" id="nmjls" value="" class="xinput validate[required]" value ="<?=$data->nm_ttdwp?>" readonly>
			</td>
		</tr>		
		
							
	</table>
	

	
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
