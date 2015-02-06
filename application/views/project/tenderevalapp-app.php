<?=link_tag(CSS_PATH.'menuform.css')?>
<?=script('jquery.validationEngine-enx.js')?>
<?=script('jquery.validationEnginex.js')?>
<?=script('jquery.formx.js')?>
<?=script('jquery.numeric.js')?>
<?=script('currency.js')?>

<script type="text/javascript">
	$(function(){		
		$('#formAdd')
		.validationEngine()
		.ajaxForm({
			success:function(response){
				if(response=='sukses'){
					alert(response);
					refreshTable();
				}else{
					alert(response);
				}
			}
		});			
		

	});
</script>


<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('tenderevalapp/save'), $attr);
?>


<input type="hidden" name="idtender" value="<?=$data->id_tendeva?>" />
<input type="hidden" id="id_trbgtproj" name="id_trbgtproj"/>
<label>Date</label><input type="text" value="<?=gettgl();?>" disabled="disabled"/><br/>
<label>Budget.reff</label><input type="text" value="<?=$data->no_trbgtproj?>" disabled="disabled" style="width:250px"/><br/>
<label>Tender Amount</label><input type="text" value="<?=number_format($data->nilai_tender)?>" disabled="disabled"/></br>
<label>Job</label><input type="text" value="<?=$data->job?>" disabled="disabled"/></br>
<label for="name">Tender Winner</label><input type="text" value="<?=$data->vendor_nm?>" disabled="disabled"/></br></div>	 
 <!-- Grid Form  -->

<div id="content">
	<table width="600px">
		<thead>
			<th style="width:20px" align="center">No</th>
			<th style="width:80px" align="left">Detail Job</th>
			<th style="width:30px" align="center">QTY</th>
			<th style="width:30px" align="center">Unit</th>
			<th style="width:60px" align="right">Price</th>
			<th style="width:60px" align="right">Total Price</th>
		</thead>
		<tbody>
			<tr>
				<?php
				$i = 0; 
				foreach($detailjob as $row):
				$i++;
				?>
					<tr>
						<td align="center"><?=$i?></td>
						<td align="left"><?=$row->detail_job;?></td>
						<td align="center"><?=$row->qty;?></td>
						<td align="center"><?=$row->unit;?></td>
						<td align="right"><?=number_format($row->price)?></td>
						<td align="right"><?=number_format($row->total_price)?></td>
					</tr>
				<?php endforeach; ?>
			</tr>
			<tr>
				<td colspan="6">
					<input type="submit" value="Approve" name="app"/>
					<input type="submit" value="Unapprove" name="app"/>				
				</td>
			</tr>
		</tbody>
	</table>	

<?=form_close()?>
		
	

