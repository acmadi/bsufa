<?=link_tag(CSS_PATH.'x-forminput.css')?>
<h2>Addendum</h2>

<div id="x-input">
 <form action="" method="post">
    <fieldset>
		<label for="name">Contract.No</label><input type="text" name="contract" value="<?=$data->no_kontrak?>" style="width:200px" readonly="true"/><br/> 		 
		<label for="name">Contract.date</label><input type="text" name="tgl_kontrak" value="<?=indo_date($data->start_date)?>" readonly="true"/><br/> 		 
		<label for="name">Contract.Amount</label><input type="text" name="" value="<?=number_format($data->contract_amount)?>" readonly="true"/><br/> 		 
		<label for="name">Job</label><input type="text" name=""/><br/><br/> 	 		 
		<label for="name">Date</label><input type="text" name="tgl_adendum" value="<?=gettgl();?>" readonly="true"/><br/> 		 
		<label for="name">Addendum.No</label><input type="text" name="no_add" value="" readonly="true"/><br/> 		 
		<label for="name">Addendum.Amount</label><input type="text" name=""/><br/> 		 
		<label for="name">Job</label><input type="text" name=""/><br/><br/>
	   <div id="headermenu"> 
			<table border="0" cellspacing="2" cellpadding = "2">
				<thead>
					<tr>
						<th>No</th>
						<th>Detail</th>
						<th>Qty</th>
						<th>Unit</th>
						<th>Amount</th>
						<th>Progress</th>
						<th>Amount</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 0;
						foreach($job as $row): 
						$i++;
					?>
					<tr>
						<td><?=$i?></td>
						<td><?=$row->detail_job?></td>
						<td><?=$row->qty?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
       </div>		 		 
		 
       <input type="submit" value="Save" /> <input type="reset" value="Cancel" />
    </fieldset>
 </form>
   
</div>
