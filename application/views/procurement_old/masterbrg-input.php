<?=link_tag(CSS_PATH.'x-forminput.css')?>
<h2>Input Purchase Request</h2>

<div id="x-input">
 <form action="<?=site_url('masterbrg/save')?>" method="post">
    <fieldset>
			<label>Kode</label><input type="text" name="kode" value="<?=$no_brg?>" readonly="true"/><br />
								
			<label>Nama Barang</label><input type="text" name="brg"/><br/>
			<label>Satuan</label><select name="satuan" id="satuan">
									<option></option>
									<?php foreach($satuan as $row):?>
									<option value="<?=$row->satuan?>"><?=$row->satuan?></option>
									<?php endforeach;?>
								 </select><br/>
			
			<label>Jenis Barang</label><select name="jnsbrg" id="jnsbrg">
									<option></option>
									<?php foreach($jnsbrg as $row):?>
									<option value="<?=$row->jnsbrg_id?>"><?=$row->jnsbrg_nama?></option>
									<?php endforeach;?>
								 </select><br/>
			
			<br/>
			<input type="submit" value="Save" /> <input type="reset" value="Cancel" />
    </fieldset>
 </form>
   
</div>
