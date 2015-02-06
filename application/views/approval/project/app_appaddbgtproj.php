


<?php
	
	
	defined('BASEPATH') or die('Access Denied');
	
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('addbgt/saveaddbgt'), $attr);

?>

<input  type="hidden"  name='idaddbgt' id='idaddbgt' value='<?=$row->id_bgtproj_update_add?>' >
		<input  type="hidden"  name='idcostproj2' id='idcostproj2' value='<?=$row->id_costproj?>' >
		<input type="hidden"  name='kodebgtproj2' id='kodebgtproj2' value='<?=$row->kode_bgtproj?>' >
		<input  type="hidden"  name='nmbgtproj2' id='nmbgtproj2' value='<?=$row->nm_bgtproj?>' >
		<input  type="hidden"  name='nilaibgtproj2' id='nilaibgtproj2' value='<?=$row->nilai_bgtproj?>' >
		<input  type="hidden"  name='tglbgtproj2' id='tglbgtproj2' value='<?=$row->tgl_bgtproj?>' >
		<input  type="hidden"  name='inputdate2' id='inputdate2' value='<?=$row->input_date?>' >
		<input  type="hidden"  name='iddivisi2' id='iddivisi2' value='<?=$row->id_divisi?>' >
		<input  type="hidden"  name='idpt2' id='idpt2' value='<?=$row->id_pt?>' >	
		<input  type="hidden"  name='idsubproject2' id='idsubproject2' value='<?=$row->id_subproject?>' >	
		<input  type="hidden"  name='coano2' id='coano2' value='<?=$row->coa_no?>' >	
		<input  type="hidden"  name='adj2' id='adj' value='<?=$row->adj?>' >
		<input  type="hidden"  name='remark2' id='remark2' value='<?=$row->remark?>' >		

	<br><br><br><br><br><br><br>
	
			<table align='center' width='50%'  border='1' cellpading='1' cellspacing='1'>
			<tr>
				<td style="font-size:14px;background-color:black;color:#FFFFFF;">PROJECT</td>
				
				<td style="font-size:14px;background-color:#FFFF80;"><?=$row->nm_subproject?></td>
			</tr>
			<tr>
				<td style="font-size:14px;background-color:black;color:#FFFFFF;">DESCRIPTION</td>
				
				<td style="font-size:14px;background-color:#FFFF80;"><?=$row->remark?></td>
			</tr>
			<tr>
				<td style="font-size:14px;background-color:black;color:#FFFFFF;">AMOUNT</td>
				
				<td style="font-size:14px;background-color:#FFFF80;"><?=number_format($row->nilai_bgtproj)?></td>
			</tr>
			<tr>
				<td style="font-size:14px;background-color:black;color:#FFFFFF;">ACCOUNT</td>
				
				<td style="font-size:14px;background-color:#FFFF80;"><?=$row->coa_no?></td>
			</tr>
			<tr>
				<td style="font-size:14px;background-color:black;color:#FFFFFF;">CODE</td>
				
				<td style="font-size:14px;background-color:#FFFF80;"><?=$row->kode_bgtproj?></td>
			</tr>
			
			
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
		
		

		
		
