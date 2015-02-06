<?php
$this->load->view(ADMIN_HEADER);
?>
<?=link_tag(CSS_PATH.'menuform.css')?>
<?=script('jquery-1.4.2.min.js')?>
<script type="text/javascript">
$(document).ready(function(){
	
	$('#all').change(function(){
		alert('tes');
		$('#view').text('');
		$('#view').append('<option>ALL</option>'); 
		
	});
});



</script>

<h2><font color='red' size='4'>Status Unit grove Condotel<hr width="150px" align="left"></font></h2>

<div style="padding:10 0 0 10">
	<form method="post" action="<?=site_url('sales/viewunitgrove_status/view_unitgrove')?>">

<table>
	<tr>
		<td>View</td>
			<td>:</td>
				<td>
				<select name='view' id='view' class='xinput'>
					<option align="center">--Pilih--</option>
					<option value="All" align="center">All</option>
					<option value="EAST / PODIUM / POOL">EAST / PODIUM / POOL</option>
					<option value="WEST / CITY">WEST / CITY</option>
				</select>
				</td>
	<tr><td>&nbsp;</td></tr>
	<tr><td><input type="submit" name="save" value="View" style="width:100px"/></td></tr>
	</table>
	


</form>
	
</div>
<?php
$this->load->view(ADMIN_FOOTER);
?>
