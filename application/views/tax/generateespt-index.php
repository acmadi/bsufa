<?php

$session_id = $this->UserLogin->isLogin();
$level = $session_id['level_id'];

?>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />


<script type="text/javascript">
$(document).ready(function() {
	$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));			
	});
});
</script>

<style>
	.customBg{
		display:block;
		margin-height:-2px;
		margin-left:-2px;
		height: 14px;
		padding: 4px;
	}
	.customBg2{
		display:block;
		margin-height:-2px;
		margin-left:-2px;
		height: 14px;
		padding: 4px;
	}

	.mytextbox {
		font: 12px Arial, Helvetica, sans-serif;
	    border: 1px solid #008B8B;
	    padding: 5px;
	   
	}
	.mytextboxx {
	font: 14px Arial, Helvetica, sans-serif;

		width: 90px;
		height: 42px;
	border: 1px solid #EFFC94;
		background: #B9B9B9;
		color: #5D781D;  
	}

	td {
		
		padding: 6px 5px 2px 5px;
		border: 0px solid #DEDEDE;
		text-transform: uppercase;
		font: normal 11px Arial, Helvetica, sans-serif;
		color: #5D781D;1px solid #D6DDE6;
	   
	}
</style>

<center>
<h3><font color='#1D5987'>PT. BAKRIE SWASAKTI UTAMA</font></h>	 
<h4><font color='#1D5987'>Generate ESPT</font></h4>	
</center> 

<div align="left" style="padding:50px">

<script language="javascript">
    $(document).ready(function() {
        $("#pt").change(function() {
            $.post("<?php echo base_url(); ?>cb/dailycash/get_project/" + $('#pt').val(), {}, function(obj) {
                $('#subproject').html(obj);
            });
        });
        
	
	
</script>
<form action="<?php echo site_url('generateespt/gen')?>" method="post" enctype="multipart/form-data" role="form"> 		
  	<table>  
	  	<tr>
			<td style="width: 170px;">PT</td>
			<td>
				<select name="pt" id="pt" class="mytextbox">
					<option> Pilih PT </option>
					<?php 
						if($this->session->userdata('sesspt') != ''){
							$query = $this->db->query("select id_pt,nm_pt from pt where id_pt = ".$this->session->userdata('sesspt')." ")->row();
							?>
							<option value="<?php echo $query->id_pt;?>" selected> <?php echo $query->nm_pt;?> </option>
					<?php } 
					foreach ($pt as $row) {  ?>
					<option value="<?=@$row->id_pt; ?>"><?=@$row->nm_pt; ?></option>
					<? } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td style="width: 170px;">TIPE</td>
			<td>
				<select name="tipe" id="tipe" class="mytextbox">
					<option value=""> Pilih PT </option>
					<option value="B" selected> PPN Masukan </option>
					<option value="A"> PPN Keluaran </option>
					
				</select>
			</td>
		</tr>
		
			<tr>			
			<td style="width: 170px;">Periode </td>
			<td>
			
			
			<input type="text" name="startdate" id="startdate" style="width:190px" class="xinput validate[required] mytextbox" readonly="true" value="<?php echo @$this->session->userdata('sessstart'); ?>">
			<a href="JavaScript:;" onClick="return showCalendar('startdate', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" width="20px" height="20px" alt="s"/></a>
	
			
			&nbsp;&nbsp;&nbsp;&nbsp; s/d &nbsp;&nbsp;&nbsp;&nbsp;
			
			
			
			<input type="text" name="enddate" id="enddate" style="width:190px" class="xinput validate[required]  mytextbox" readonly="true" value="<?php echo @$this->session->userdata('sessend'); ?>">
			<a class="enddates" href="JavaScript:;" onClick="return showCalendar('enddate', 'dd-mm-y');" title="Pilih Tanggal" > <img width="20px" height="20px"  class="click_date" src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
		
			
			</td>			
		</tr>		
		  	<td><input type="submit" value="GENERATE" id="submit" name="submit" class="mytextboxx" /></td>  
	    </tr>
  	</table>  
</form>
<br>

</div>

