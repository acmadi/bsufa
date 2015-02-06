<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css" />

<script language="javascript">
	$(function(){
		$.validationEngineLanguage.allRules['ajaxValidateNip'] = {
			"url": "<?=site_url('tblkary/ceknip')?>",
	        "alertText": "*This name is already taken",
	        "alertTextOk": "This name is avaliable",
	        "alertTextLoad": "* Validating, please wait"
	     };
	     
		$('#formAdd')
		.validationEngine()
		.ajaxForm({
			success:function(response){
				alert(response);
				refreshTable();
				//$('#btnReset').click();
			}
		});
	});
</script>

<form id="formAdd" action="<?=site_url()?>tblkary/input" method="post" >
<table>
	<tr>
		<td colspan='3'><font color='red'><b>PERSONAL DATA</b></font></td>
		<td colspan='3'>&nbsp;</td>
	</tr>
	<tr>
		<td>NIP</td>
			<td>:</td>
			<td><input type="text" name="nip" id="nip" class="validate[custom[integer],maxSize[8],minSize[8],ajax[ajaxValidateNip] xinput" value="<?=@$data->id_kary?>" class="validate[required]" size="30" /></td>
			
		<td>Kelamin</td>
			<td>:</td>
			<td>
			<select name="karysek" id="karysek_id" class="xinput">
				<? if($karysek): ?>
				<? foreach($karysek as $sek): ?>
					<option value="<?=$sek->karysek_id?>" <? if($sek->karysek_id == @$data->id_karysek) echo 'selected';?>> <?=$sek->karysek_nm?> </option>
				<? endforeach;?>
				<? endif;?>
			</select>
			</select></td>
	</tr>
	<tr>
		<td>Nama</td>
			<td>:</td>
			<td><input type="text" name="nama" class="validate[required] xinput" id="nama" value="<?=@$data->nama?>"  size="30" /></td>
		<td>Agama</td>
			<td>:</td>
			<td>
			<select name="agama" id="agama_id" class="xinput">
				<? if($agama): ?>
				<? foreach($agama as $agm): ?>
					<option value="<?=$agm->agama_id?>" <? if($agm->agama_id == @$data->id_agama) echo 'selected';?>> <?=$agm->agama_nm?> </option>
				<? endforeach;?>
				<? endif;?>
			</select>
			</select></td>
	
	</tr>
	<tr>
		<td>Divisi</td>
		<td>:</td>
		<td>
		<select name="divisi" id="divisi_id" class="xinput">
				<? if($divisi): ?>
				<? foreach($divisi as $div): ?>
					<option value="<?=$div->divisi_id?>" <? if($div->divisi_id == @$data->id_divisi) echo 'selected';?>> <?=$div->divisi_nm?> </option>
				<? endforeach;?>
				<? endif;?>
		</select>
		</select></td>
		<td>Tgl. Lahir</td>
			<td>:</td>
			<td>
			<input type="text" class="xinput" readonly="true" name="tgl_lhr" id="tgl_lhr" value="<?=@$data->ttl?>"  size="15" />
			<a href="JavaScript:;" onClick="return showCalendar('tgl_lhr', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
			</td>
	
	</tr>
	<tr>
		<td>Jabatan</td>
		<td>:</td>
		<td>
		<select name="karyjab" id="karyjab_id" class="xinput">
				<? if($karyjab): ?>
				<? foreach($karyjab as $jabat): ?>
					<option value="<?=$jabat->karyjab_id?>" <? if($jabat->karyjab_id == @$data->id_karyjab) echo 'selected';?>> <?=$jabat->karyjab_nm?> </option>
				<? endforeach;?>
				<? endif;?>
		</select>
		</select></td>
		<td>Tmp. Lahir</td>
			<td>:</td>
			<td><input type="text" name="tmpt_lhr" id="tmpt_lhr" value="<?=@$data->tmpt_ttl?>"  size="15" class="xinput"/></td>
	
		
	</tr>
	<tr>
		<td>Level</td>
			<td>:</td>
			<td>
			<select name="karylvl" id="karylvl_id" class="xinput">
				<? if($karylvl): ?>
				<? foreach($karylvl as $lvl): ?>
					<option value="<?=$lvl->karylvl_id?>" <? if($lvl->karylvl_id == @$data->id_karylvl) echo 'selected';?>> <?=$lvl->karylvl_nm?> </option>
				<? endforeach;?>
				<? endif;?>
			</select>
			</select></td>
		<td>Alamat</td>
			<td>:</td>
			<td><input  name="alamat" class="xinput" id="alamat" value="<?=@$data->alamat?>"  size="50"></td>
	
	</tr>
	
	<tr>
		<td>Tgl. Join</td>
			<td>:</td>
			<td>
			<input type="text" name="join" readonly="true" id="join" class="xinput validate[required]" value="<?=@indo_date($data->tgl_join)?>"  size="30" >
			<a href="JavaScript:;" onClick="return showCalendar('join', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
			</td>
		<td>No. HP</td>
			<td>:</td>
			<td><input type="text" name="hp" class="xinput" id="hp" value="<?=@$data->hp2?>"  size="30" /></td>
	
	</tr>
	<tr>
		<td>Status</td>
		<td>:</td>
		<td>
		<select name="karystat" id="karystat_id" class="xinput">
				<? if($karystat): ?>
				<? foreach($karystat as $karyst): ?>
					<option value="<?=$karyst->karystat_id?>" <? if($karyst->karystat_id == @$data->id_karystat) echo 'selected';?>> <?=$karyst->karystat_nm?> </option>
				<? endforeach;?>
				<? endif;?>
		</select>
		</select></td>
		<td>Email </td>
			<td>:</td>
			<td><input type="text" name="mail" id="mail_id" class="xinput" value="<?=@$data->email?>"  size="30" /></td>
	</tr>
	<tr>
		<td>Gol. Darah</td>
		<td>:</td>
		<td>
		<select name="karydrh" id="karydrh_id" class="xinput">
				<? if($karydrh): ?>
				<? foreach($karydrh as $darah): ?>
					<option value="<?=$darah->karydrh_id?>" <? if($darah->karydrh_id == @$data->id_karydrh) echo 'selected';?>> <?=$darah->karydrh_nm?> </option>
				<? endforeach;?>
				<? endif;?>
		</select>
		</select></td>
		<td>Keluarga</td>
		<td>:</td>
		<td>
		<select name="karykk" id="karykk_id" class="xinput">
				<? if($karykk): ?>
				<? foreach($karykk as $kk): ?>
					<option value="<?=$kk->karykk_id?>" <? if($kk->karykk_id == @$data->id_karykk) echo 'selected';?>> <?=$kk->karykk_nm?> </option>
				<? endforeach;?>
				<? endif;?>
		</select>
		</select></td>	
	</tr>	
	<td>Keterangan</td>
			<td>:</td>
			<td>
			<select name="karyket" id="karyket_id" class="xinput">
				<? if($karyket): ?>
				<? foreach($karyket as $ket): ?>
					<option value="<?=$ket->karyket_id?>" <? if($ket->karyket_id == @$data->id_karyket) echo 'selected';?>> <?=$ket->karyket_nm?> </option>
				<? endforeach;?>
				<? endif;?>
			</select>
			</select></td>
	
	<tr>
		<td colspan='3'><font color='red'><b>FORMAL EDUCATION</b></font></td>
		<td colspan='3'>&nbsp;</td>
	</tr>
	
	<tr>
		<td>Strata</td>
			<td>:</td>
			<td>
			<select name="pndd" id="pndd_id" class="xinput">
				<? if($pndd): ?>
				<? foreach($pndd as $edu): ?>
					<option value="<?=$edu->pndd_id?>" <? if($edu->pndd_id == @$data->id_pndd) echo 'selected';?>> <?=$edu->pndd_nm?> </option>
				<? endforeach;?>
				<? endif;?>
			</select>
			</select></td>
		
		<td>Jurusan</td>
			<td>:</td>
			<td>
			<select name="pnddjur" id="pnddjur_id" class="xinput">
				<? if($jurusan): ?>
				<? foreach($jurusan as $ju): ?>
					<option value="<?=$ju->pnddjur_id?>" <? if($ju->pnddjur_id == @$data->id_pnddjur) echo 'selected';?>> <?=$ju->pnddjur_nm?> </option>
				<? endforeach;?>
				<? endif;?>
			</select>
			</select></td>
	</tr>
	
	
	<tr>
		<td colspan='3'><font color='red'><b>Family Data</b></font></td>
		<td colspan='3'>&nbsp;</td>
	
	<?php 	if($karyklrg): 
				foreach($karyklrg as $kl):	
				
				 endforeach;
			endif; ?>	
	</tr>
	
	<tr>
		<td>Suami/Istri</td>
			<td>:</td>
			<td><input name="pas_nm" type="text" value="<?=@$kl->pas_nm?>" class="xinput"></td>

			
		<td>Tgl. Lahir</td>
			<td>:</td>

			<td>
			<input name="pas_lhr" id="pas_lhr" readonly="true" type="text" class="xinput" value="<?=@$kl->pas_lhr?>" size='10'>
			<a href="JavaScript:;" onClick="return showCalendar('pas_lhr', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
			</td>

	
	<tr>
		<td>Anak I</td>
			<td>:</td>

			<td><input name="ank1" type="text" value="<?=@$kl->ank1?>" class="xinput"></td>

		<td>Tgl. Lahir</td>
			<td>:</td>

			<td>
			<input name="ank1_lhr" readonly="true" id="ank1_lhr" class="xinput" type="text" value="<?=@$kl->ank1_lhr?>" size='10'>
			<a href="JavaScript:;" onClick="return showCalendar('ank1_lhr', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
			</td>

	</tr>
	<tr>
		<td>Anak II</td>
			<td>:</td>

			<td><input name="ank2" type="text" class="xinput" values="<?=@$kl->ank2?>"></td>

		
		<td>Tgl. Lahir</td>
			<td>:</td>
			<td>
			<input name="ank2_lhr" type="text" readonly="true" class="xinput" value="<?=@$kl->ank2_lhr?>" size='10'>
			<a href="JavaScript:;" onClick="return showCalendar('ank2_lhr', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
			</td>

	</tr>
	<tr>
		<td>Anak III</td>
			<td>:</td>
		
			<td><input name="ank3" type="text" class="xinput" value="<?=@$kl->ank3?>"></td>
			
		<td>Tgl. Lahir</td>
			<td>:</td>
			
			<td>
			<input name="ank3_lhr" readonly="true" type="text" class="xinput" value="<?=@$kl->ank3_lhr?>" size='10'>
			<a href="JavaScript:;" onClick="return showCalendar('ank3_lhr', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
			</td>
			
	</tr>
	<tr>
		<td>Anak IV</td>
			<td>:</td>
			
			<td><input name="ank4" type="text" class="xinput" value="<?=@$kl->ank4?>"></td>
		
		<td>Tgl. Lahir</td>
			<td>:</td>
			
			<td>
			<input name="ank4_lhr" type="text" readonly="true" class="xinput" value="<?=@$kl->ank4_lhr?>" size='10'>
			<a href="JavaScript:;" onClick="return showCalendar('ank4_lhr', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
			</td>
		
	</tr>			
	
	
	<tr>
		<td colspan='3'><font color='red'><b>Emergency Contact</b></font></td>
		<td colspan='3'>&nbsp;</td>
		
	</tr>
	
	<tr>
		<td>Nama</td>
			<td>:</td>
						
			<td><input name="emrg_nm" type="text" class="xinput" value="<?=@$kl->emrg_nm?>"></td>
			
		<td>Alamat</td>
			<td>:</td>
			
			<td><input name="emrg_addr" type="text" class="xinput" value="<?=@$kl->emrg_addr?>" size='50'></td>
			
	<tr>
		<td>Hub. Klrg</td>
			<td>:</td>
				<td><input name="emrg_rlt" type="text" class="xinput" value="<?=@$kl->emrg_rlt?>"></td>
			<td>HP 1</td>
			<td>:</td>
			<td><input name="emrg_hp1" type="text" class="xinput" value="<?=@$kl->emrg_hp1?>" size="15"></td>
		</tr>
	<tr>
		<td colspan='3'></td>
		<td>HP 2</td>
		<td>:</td>
			<td><input name="emrg_hp2" type="text" value="<?=@$kl->emrg_hp2?>" class="xinput" size="15"></td>
		</tr>
	
		<td colspan='3'><font color='red'><b>Other Info</b></font></td>
		<td colspan='3'>&nbsp;</td>
	</tr>
	
	<tr>
		<td>Bank </td>
			<td>:</td>
			<td><input type="text" name="bank_nm" class="xinput" id="bank_id" value="<?=@$data->bank_nm?>"  size="30" /></td>
		<td>No. Rek </td>
			<td>:</td>
			<td><input type="text" name="bank_acc" id="acc_id" class="xinput" value="<?=@$data->bank_acc?>"  size="30" /></td>
	</tr>
	<tr>
		<td>NPWP</td>
			<td>:</td>
			<td><input type="text" name="no_npwp" class="xinput" id="bank_id" value="<?=@$data->no_npwp?>"  size="30" /></td>
		<td>Jamsostek </td>
			<td>:</td>
			<td><input type="text" name="no_jamso" id="acc_id" class="xinput" value="<?=@$data->no_jamso?>"  size="30" /></td>
	</tr>
	
	
			
	<tr>
	
	
		<td></td>
		<td></td>
		<td>
			<input type="hidden" name="no_urut" value="<?=@$data->no_urut?>" />
			<input type="hidden" name="kary_id" value="<?=@$kl->kary_id?>" />
			
			<input type="submit" value="Simpan" />
			<input type="button" id="btnClose" value="Batal" />
		</td>
	</tr>
</table>
</form>
