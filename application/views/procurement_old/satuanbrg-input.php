<?=link_tag(CSS_PATH.'x-forminput.css')?>
<h2>Input Satuan</h2>

<div id="x-input">
 <form action="<?=site_url('satuanbrg/save')?>" method="post">
    <fieldset>
			<label>Satuan</label><input type="text" name="satuan"/><br/>
			<label>Remark</label><input type="text" name="pembagi"/><br/>
			<input type="submit" value="Save" /> <input type="reset" value="Cancel" />
    </fieldset>
 </form>
   
</div>
