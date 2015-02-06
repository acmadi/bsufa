<?php

$session_id = $this->UserLogin->isLogin();
$level = $session_id['level_id'];
$grid_data = str_replace('"numberFormat"','numberFormat',$grid_data);
$grid_data = str_replace('"cellColumn"','cellColumn',$grid_data);
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
<?php if($strPost == 1) { ?>
<script language="javascript">
$("#addbutton").show();
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	grid.navButtonAdd('#pager',{
		   caption:"Input No Pajak", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url($module_url)?>" + '/nopaj/' + id + '/?width='+600+'&height='+240);
			 }else{
				 alert('Pilih baris yang ingin diview');
			 }
		   }, 
		   position:"last"
		})
	
		.navButtonAdd('#pager',{
		   caption:"Search", 
		   buttonicon:"ui-icon-search", 
		   onClickButton: function(){ 
			 grid.jqGrid('searchGrid');
		   }, 
		   position:"last"
		})
});

function cellColumn(cellVal,opts,element){
	if(element.flag_id == 1)
		var newVal = '<span class="customBg" style="background-color:#C1FFC1">'+cellVal+'</span>';
		else if(element.flag_id == 0)
		var newVal = '<span class="customBg" style="background-color:#FFD5D5">'+cellVal+'</span>';
	else var newVal = cellVal;
	return newVal;
}

function numberFormat(cellVal,opts,element){
	if(element.flag_id == 0)
		var newVal = '<span class="customBg" style="background-color:#FFD5D5">'+numToCurr(element.amount)+'</span>';
	else if(element.flag_id == 1)
		var newVal = '<span class="customBg" style="background-color:#C1FFC1">'+numToCurr(element.amount)+'</span>';
	return newVal;
}
</script>
<?php } else {?>
<script type="text/javascript">
$(document).ready(function() {
	$("#addbutton").hide();
});


</script>
<?php } ?>
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
<h4><font color='#1D5987'>Generate Faktur Pajak Masukan</font></h4>	
</center> 

<div align="left" style="padding:50px">

<script language="javascript">
    $(document).ready(function() {
        $("#pt").change(function() {
            $.post("<?php echo base_url(); ?>cb/dailycash/get_project/" + $('#pt').val(), {}, function(obj) {
                $('#subproject').html(obj);
            });
        });
        $("#subproject").change(function() {
            $.post("<?php echo base_url(); ?>cb/dailycash/get_bank/" + $('#subproject').val(), {}, function(obj) {
                $('#bank').html(obj);
			
			});
        });
    });
	
	
</script>
<form action="<?php echo site_url('generatefpajak')?>" method="post" enctype="multipart/form-data" role="form"> 		
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
			<td style="width: 170px;">Project</td>
			<td>
				<select name="subproject" id="subproject" class="mytextbox">
					<?php if($this->session->userdata('sessproject') != ''){
							$query = $this->db->query("select kd_project,nm_project from project where kd_project = ".$this->session->userdata('sessproject')." ")->row();
							?>
							<option value="<?php echo $query->kd_project;?>" selected> <?php echo $query->nm_project;?> </option>
					<?php } ?>
					<option> Pilih Project </option>
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
		  	<td><input type="submit" value="VIEW" id="submit" name="submit" class="mytextboxx" /></td>  
	    </tr>
  	</table>  
</form>
<br>

<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox();
});
</script>


<br>
<div>
	<table id="mytable" class="scroll"></table>
	<div id="pager"></div>
</div>
<br>
<!--div id="addbutton" style ="margin-left:5px;">
	
		<a class="fancybox" href="#formadd"><button id="submit" name="submit" class="mytextboxx"> GENERATE </button></a>  

</div-->
</div>





<!--div id="formadd" style="width:830px; height:150px; display: none;">
<form method="post" action="<?php echo base_url();?>generatefpajak/savenum">
	<table border=1>
		<tr>
			<h3>Input Range Nomor Pajak</h3>
		</tr>
		<tr>
			<td>Nomor Faktur Pajak</td>
			<td> : </td>
			<td><input type="text" class="mytextbox" name="no1"/> S/D <input type="text" class="mytextbox" name="no2"/></td>
			
			<input type="hidden" class="mytextbox" name="pro" value='<?=$projeksess->subproject_id;?>'/>
			<input type="hidden" class="mytextbox" name="star"value='<?=$startdates;?>'/>
			<input type="hidden" class="mytextbox" name="en" value='<?=$enddates;?>'/>
			
			
		</tr>
		
			<td><input type="submit" value="Save" class="mytextboxx"></td>
			<td><input type="reset" value="Reset" class="mytextboxx"></td>
		</tr>
	</table>
</form>
</div-->