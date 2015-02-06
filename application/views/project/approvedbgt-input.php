<?=link_tag(CSS_PATH.'menuform.css')?>
<h2>Proposed Budget</h2>

<div id="x-input">
 <form action="" method="post">
    <fieldset>
       <label for="date">Proposed Date</label><input type="text" name="tgl1" value="<?=@$data->tgl_proposed?>" readonly="true" placeholder=""/><br/>  
       <label for="date">Approved Date</label><input type="text" name="tgl2" value="<?php gettgl(); ?>" readonly="true" placeholder=""/><br/>  
	   <label for="total budget">Budget Name</label><input type="text" name="desc" value="" readonly="true" placeholder=""/><br/>
	
	   <div id="headermenu"> 
			<div class="header_2"><span>Current Budget</span><span>All Budget Project</span></div> 
			<label for="month">Actual Budget</label><input type="text" name=""/><input type="text" name=""/><br/>
			<label for="month">Balanced Budget</label><input type="text" name="blcbgt" id="blcbgt"/><input type="text" name=""/><br/><br/>
			<label for="month">Remark</label><textarea name="remark" id="remark" class=""></textarea><br/><br/><br/>
			<label for="month">Proposed</label><input type="text" name=""/><br/>
			<label for="month">Approved</label><input type="text" name=""/><br/><br/>
			<label for="month">Remark</label><textarea name=""></textarea>
       </div><br/><br/>
       <input type="submit" value="Save" /> <input type="reset" value="Cancel" />
    </fieldset>
 </form>
   
</div>
