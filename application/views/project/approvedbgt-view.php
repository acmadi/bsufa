<?=script('calendar.js')?>
<?=script('calendar2.js')?>
<?=script('jquery.numeric.js')?>
<?=script('currency.js')?>
<?=link_tag(CSS_PATH.'calendar.css')?>
<?=link_tag(CSS_PATH.'x-forminput.css')?>
<?php
#var_dump($allbgt);exit;
?>
<script type="text/javascript">
	$(function(){
		$('#bgt').change(function(){
			var proj = $('#proj option:selected').val();
			$.getJSON('<?=site_url('proposedbgt/cekdata')?>/' + $(this).val() + '/' + proj,
				function(response){
					$('#totbgt').val(response.totbgt);
					$('#actual').val(response.actual);
					$('#blc').val(response.blc);
					$('#allbgt').val(response.allbgt);
					$('#allactual').val(response.allactual);
					$('#allblc').val(response.allblc);
				})
		})
		
			
		$('.calculate').bind('keyup keypress',function(){
			$(this).val(numToCurr($(this).val()));
		}).numeric();

	});
</script>
<h2>Proposed Budget</h2>

<div id="x-input">
 <form action="" method="post">
    <fieldset>
       <label for="date">Proposed Date</label><input type="text" name="tgl1" value="<?=indo_date(@$data->tgl_proposed)?>" readonly="true" placeholder=""/><br/>  
       <label for="date">Approved Date</label><input type="text" name="tgl2" value="<?php gettgl(); ?>" readonly="true" placeholder=""/><br/>  
	   <label for="total budget">Budget Name</label><input type="text" name="bgt" value="<?=@$data->kd_bgtproj?>" readonly="true" placeholder=""/><br/>
	
	   <div id="headermenu"> 
			<div class="header_2"><span>Current Budget</span><span>All Budget Project</span></div> 
			<label for="month">Actual Budget</label><input type="text" name="" value="<?=number_format($xbgt->actual)?>" class="input" readonly="true"/><input type="text" name="" value="<?=number_format($allbgt->actual)?>" class="input" readonly="true"/><br/><br/>
			<label for="month">Remark</label><textarea name="remark" id="remark" class=""><?=@$data->remark1?></textarea><br/><br/><br/>
			<label for="month">Proposed</label><input type="text" name="proposed" value="<?=number_format(@$data->nilai_proposed)?>" class="input" readonly="true"/><br/>
			<label for="month">Approved</label><input type="text" name="approved" id="approved" class="calculate input"/><br/><br/>
			<label for="month">Remark</label><textarea name="remark" id="remark"></textarea>
       </div><br/><br/>
    </fieldset>
 </form>
   
</div>
