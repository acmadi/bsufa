


<?php
	
	
	defined('BASEPATH') or die('Access Denied');
	
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('reclassbgt/savereclass'), $attr);

?>
	<input  type="hidden"  name='idreclass' id='idreclass' value='<?=$sql1->id_reclass?>' >
		<input  type="hidden"  name='idcostproj' id='idcostproj' value='<?=$sql1->id_costproj?>' >
		<input type="hidden"  name='kodebgtproj' id='kodebgtproj' value='<?=$sql1->kode_bgtproj?>' >
		<input  type="hidden"  name='nmbgtproj' id='nmbgtproj' value='<?=$sql1->nm_bgtproj?>' >
		<input  type="hidden"  name='nilaibgtproj' id='nilaibgtproj' value='<?=$sql1->nilai_bgtproj?>' >
		<input  type="hidden"  name='tglbgtproj' id='tglbgtproj' value='<?=$sql1->tgl_bgtproj?>' >
		<input  type="hidden"  name='inputdate' id='inputdate' value='<?=$sql1->input_date?>' >
		<input  type="hidden"  name='iddivisi' id='iddivisi' value='<?=$sql1->id_divisi?>' >
		<input  type="hidden"  name='idpt' id='idpt' value='<?=$sql1->id_pt?>' >	
		<input  type="hidden"  name='idsubproject' id='idsubproject' value='<?=$sql1->id_subproject?>' >	
		<input  type="hidden"  name='coano' id='coano' value='<?=$sql1->coa_no?>' >	
		<input  type="hidden"  name='adj' id='adj' value='<?=$sql1->adj?>' >
		<input  type="hidden"  name='remark' id='remark' value='<?=$sql1->remark?>' >		
		
		<input  type="hidden"  name='idcostproj2' id='idcostproj2' value='<?=$sql2->id_costproj?>' >
		<input type="hidden"  name='kodebgtproj2' id='kodebgtproj2' value='<?=$sql2->kode_bgtproj?>' >
		<input  type="hidden"  name='nmbgtproj2' id='nmbgtproj2' value='<?=$sql2->nm_bgtproj?>' >
		<input  type="hidden"  name='nilaibgtproj2' id='nilaibgtproj2' value='<?=$sql2->nilai_bgtproj?>' >
		<input  type="hidden"  name='tglbgtproj2' id='tglbgtproj2' value='<?=$sql2->tgl_bgtproj?>' >
		<input  type="hidden"  name='inputdate2' id='inputdate2' value='<?=$sql2->input_date?>' >
		<input  type="hidden"  name='iddivisi2' id='iddivisi2' value='<?=$sql2->id_divisi?>' >
		<input  type="hidden"  name='idpt2' id='idpt2' value='<?=$sql2->id_pt?>' >	
		<input  type="hidden"  name='idsubproject2' id='idsubproject2' value='<?=$sql2->id_subproject?>' >	
		<input  type="hidden"  name='coano2' id='coano2' value='<?=$sql2->coa_no?>' >	
		<input  type="hidden"  name='adj2' id='adj' value='<?=$sql2->adj?>' >
		<input  type="hidden"  name='remark2' id='remark2' value='<?=$sql2->remark?>' >		
	<br><br><br><br><br><br><br>
	
			<table align='center' width='50%'  border='1' cellpading='1' cellspacing='1'>
			<tr>
				<td style="font-size:14px;background-color:black;color:#FFFFFF;">Reclass Description</td>
				<td style="font-size:14px;background-color:black;color:#FFFFFF;">Balance Budget</td>
				<td style="font-size:14px;background-color:black;color:#FFFFFF;">Reclass Amount</td>
				<td style="font-size:14px;background-color:black;color:#FFFFFF;">Balance Reclass</td>
			</tr>
			
			<?foreach($view as $row):?>
			<tr>
				<td style="font-size:14px;font-color:white;" width=40%><?=$row->remark?></td>
				<?$balance = ($row->nil1 - $row->nil2)?>
				<td align="right" width=20%><?=number_format($balance)?></td>
				<td align="right" width=20%><?=number_format($row->nilai_bgtproj)?></td>
				<?$blc = $balance + $row->nilai_bgtproj?>
				<td align="right" width=20%><?=number_format($blc)?></td>
			</tr>
			<?endforeach?>
		</table>
		<table align='center' width='50%'>
		<tr>
				<td>
				<label><button type='submit' name='klik' value='1'>Approved</label>
				<label><button type='submit' name='batal' value='1'>Declined</label>
				</td>
			</tr>
		</table>

	<?=form_close()?>
		
		

		
		
