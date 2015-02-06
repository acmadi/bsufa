


<form >
<table>
	<tr>
		<td colspan='3'><font color='red'><b>PERSONAL DATA</b></font></td>
		<td colspan='3'>&nbsp;</td>
	</tr>
	<tr>
		<td>NIP</td>
			<td>:</td>
			<td><input type="text" name="nip"  value="<?=@$data->id_kary?>" size="30" readonly ></td>
			
		<td>Kelamin</td>
			<td>:</td>
			<td>
				<input  name="karysek"  value="<?=@$join_all['karysek_nm']?>"  readonly> 
				
		</td>
	</tr>
	<tr>
		<td>Nama</td>
			<td>:</td>
			<td><input type="text" name="nama"  value="<?=@$data->nama?>"  size="30" readonly></td>
		<td>Agama</td>
			<td>:</td>
			<td><input name="agama" value="<?=@$join_all['agama_nm']?>" readonly>				
			</td>
	</tr>
	<tr>
		<td>Divisi</td>
		<td>:</td>
		<td>
				<input  name="divisi" value="<?=@$join_all['divisi_nm']?>" readonly></td>
		<td>Tgl. Lahir</td>
			<td>:</td>
			<td><input type="text" name="tgl_lhr" id="tgl_lhr" value="<?=@$data->ttl?>"  size="15" readonly></td>
	
	</tr>
	<tr>
		<td>Jabatan</td>
		<td>:</td>
		<td>
			<input  name="karyjab" value="<?=@$join_all['karyjab_nm']?>" readonly></td>
		</td>
		<td>Tmp. Lahir</td>
			<td>:</td>
			<td><input type="text" name="tmpt_lhr"  value="<?=@$data->tmpt_ttl?>"  size="15" readonly></td>
	
		
	</tr>
	<tr>
		<td>Level</td>
			<td>:</td>
			<td>
				<input  name="karylvl" value="<?=@$join_all['karylvl_nm']?>" readonly></td>
		<td>Alamat</td>
			<td>:</td>
			<td><input  name="alamat"  value="<?=@$data->alamat?>"  size="50" readonly></td>
	
	</tr>
	
	<tr>
		<td>Tgl. Join</td>
			<td>:</td>
			<td><input type="text" name="join" id="join" value="<?=@$data->tgl_join?>"  size="30" readonly></td>
		<td>No. HP</td>
			<td>:</td>
			<td><input type="text" name="hp" id="hp" value="<?=@$data->hp2?>"  size="30" readonly></td>
	
	</tr>
	<tr>
		<td>Status</td>
		<td>:</td>
		<td>
				<input  name="karystat" value="<?=@$join_all['karystat_nm']?>" readonly>
		</td>
		<td>Email </td>
			<td>:</td>
			<td><input type="text" name="mail" id="mail_id" value="<?=@$data->email?>"  size="30" readonly></td>
	</tr>
	<tr>
		<td>Gol. Darah</td>
		<td>:</td>
		<td>
				<input  name="karydrh" value="<?=@$join_all['karydrh_nm']?>" readonly>
		</select></td>
		<td>Keluarga</td>
		<td>:</td>
		<td>
				<input  name="karykk" value="<?=@$join_all['karykk_nm']?>" readonly>
		</td>	
	</tr>	
	<td>Keterangan</td>
			<td>:</td>
			<td>
			
				<input  name="karyket" value="<?=@$join_all['karyket_nm']?>" readonly></td>
	
	<tr>
		<td colspan='3'><font color='red'><b>FORMAL EDUCATION</b></font></td>
		<td colspan='3'>&nbsp;</td>
	</tr>
	
	<tr>
		<td>Strata</td>
			<td>:</td>
			<td>
			
				<input  name="pndd" value="<?=@$join_all['pndd_nm']?>" readonly></td>
		
		<td>Jurusan</td>
			<td>:</td>
			<td>
			
				<input  name="pnddjur" value="<?=@$join_all['pnddjur_nm']?>" readonly>
				</td>
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
			
				
			<td><input name="pas_nm" type="text" value="<?=@$kl->pas_nm?>"readonly ></td>

			
		<td>Tgl. Lahir</td>
			<td>:</td>

			<td><input name="pas_lhr" type="text" value="<?=@$kl->pas_lhr?>" readonly></td>

	
	<tr>
		<td>Anak I</td>
			<td>:</td>

			<td><input name="ank1" type="text" value="<?=@$kl->ank1?>" readonly ></td>

		<td>Tgl. Lahir</td>
			<td>:</td>

			<td><input name="ank1_lhr" type="text" value="<?=@$kl->ank1_lhr?>"readonly></td>

	</tr>
	<tr>
		<td>Anak II</td>
			<td>:</td>

			<td><input name="ank2" type="text" value="<?=@$kl->ank2?>" readonly ></td>

		
		<td>Tgl. Lahir</td>
			<td>:</td>

			<td><input name="ank2_lhr" type="text" value="<?=@$kl->ank2_lhr?>" size='10' readonly ></td>

	</tr>
	<tr>
		<td>Anak III</td>
			<td>:</td>
		
			<td><input name="ank3" type="text" value="<?=@$kl->ank3?>" readonly ></td>
			
		<td>Tgl. Lahir</td>
			<td>:</td>
			
			<td><input name="ank3_lhr" type="text" value="<?=@$kl->ank3_lhr?>" size='10'readonly></td>
			
	</tr>
	<tr>
		<td>Anak IV</td>
			<td>:</td>
			
			<td><input name="ank4" type="text" value="<?=@$kl->ank4?>" readonly></td>
		
		<td>Tgl. Lahir</td>
			<td>:</td>
			
			<td><input name="ank4_lhr" type="text" value="<?=@$kl->ank4_lhr?>" size='10' readonly></td>
		
	</tr>			
	
	
	<tr>
		<td colspan='3'><font color='red'><b>Emergency Contact</b></font></td>
		<td colspan='3'>&nbsp;</td>
		
	</tr>
	
	<tr>
		<td>Nama</td>
			<td>:</td>
						
			<td><input name="emrg_nm" type="text" value="<?=@$kl->emrg_nm?>" readonly></td>
			
		<td>Alamat</td>
			<td>:</td>
			
			<td><input name="emrg_addr" type="text" value="<?=@$kl->emrg_addr?>" size='50'readonly></td>
			
	<tr>
		<td>Hub. Klrg</td>
			<td>:</td>
				<td><input name="emrg_rlt" type="text" value="<?=@$kl->emrg_rlt?>"readonly></td>
			<td>HP 1</td>
			<td>:</td>
			<td><input name="emrg_hp1" type="text" value="<?=@$kl->emrg_hp1?>" size="15"readonly></td>
		</tr>
	<tr>
		<td colspan='3'></td>
		<td>HP 2</td>
		<td>:</td>
			<td><input name="emrg_hp2" type="text" value="<?=@$kl->emrg_hp2?>" size="15"readonly></td>
		</tr>
	
		<td colspan='3'><font color='red'><b>Other Info</b></font></td>
		<td colspan='3'>&nbsp;</td>
	</tr>
	
	<tr>
		<td>Bank </td>
			<td>:</td>
			<td><input type="text" name="bank_nm" id="bank_id" value="<?=@$data->bank_nm?>"  size="30" readonly /></td>
		<td>No. Rek </td>
			<td>:</td>
			<td><input type="text" name="bank_acc" id="acc_id" value="<?=@$data->bank_acc?>"  size="30" readonly></td>
	</tr>
	<tr>
		<td>NPWP</td>
			<td>:</td>
			<td><input type="text" name="no_npwp" id="bank_id" value="<?=@$data->no_npwp?>"  size="30" readonly></td>
		<td>Jamsostek </td>
			<td>:</td>
			<td><input type="text" name="no_jamso" id="acc_id" value="<?=@$data->no_jamso?>"  size="30" readonly></td>
	</tr>
	
	
			
	<tr>
	
	
		<td></td>
		<td></td>
		<td>
			<input type="hidden" name="no_urut" value="<?=@$data->no_urut?>" />
			
		</td>
	</tr>
</table>
</form>
