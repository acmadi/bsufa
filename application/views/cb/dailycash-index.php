<?php

$session_id = $this->UserLogin->isLogin();
$level = $session_id['level_id'];
$grid_data = str_replace('"numberFormat"','numberFormat',$grid_data);
$grid_data = str_replace('"cellColumn"','cellColumn',$grid_data);
?>

<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-ui-1.8.2.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>

<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />

<script type="text/javascript">
$(document).ready(function() {
	$.fn.datebox.defaults.formatter = function(date) {
			var y = date.getFullYear();
			var m = date.getMonth() + 1;
			var d = date.getDate();
			return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
		};	
		
		$('#assoff').datebox({  
			required:true  
		});

	$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));			
	});

});
</script>
<?php if($strPost == 1) { ?>
<!--META HTTP-EQUIV="refresh" CONTENT="10"-->
<script language="javascript">
$("#addbutton").show();
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	grid.navButtonAdd('#pager',{
		   caption:"TAMBAH", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
				 popupForm("<?=site_url($module_url)?>" + '/add/?width='+830+'&height='+400);
		   }, 
		   position:"last"
		})
	.navButtonAdd('#pager',{
		   caption:"Edit", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url($module_url)?>" + '/detail/' + id + '/?width='+830+'&height='+400);
			 }else{
				 alert('Pilih baris yang ingin diedit');
			 }
		   }, 
		   position:"last"
		})
		.navButtonAdd('#pager',{
		   caption:"HAPUS", 
		   buttonicon:"ui-icon-trash", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
			 	var r = confirm("Hapus Data ?");
			    if (r == true) {
			    	popupForm("<?=site_url($module_url)?>" + '/deletecash/' + id + '/?width='+800+'&height='+550);  
			    }
			 }else{
				 alert('Pilih baris yang ingin dihapus');
			 }
		   }, 
		   position:"last"
		})
		.navButtonAdd('#pager',{
		   caption:"CARI", 
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
	.ui-autocomplete {
		max-height: 150px;
		overflow-y: auto;
		overflow-x: hidden;
	}
	* html .ui-autocomplete {
		height: 150px;
	}
</style>

<script type="text/javascript">
	$(document).ready(function() {
		$('#pt').change(function() {
			$.post("<?php echo base_url(); ?>cb/begincash/get_project/" + $('#pt').val(), {}, function(obj) {
                $('#project').html(obj);
            });
		});
		$('#project').change(function() {
			$.post("<?php echo base_url(); ?>cb/begincash/get_bank/" + $('#project').val(), {}, function(obj) {
                $('#bank').html(obj);
            });
		});
	});
</script>

<center>
<h3><font color='#1D5987'>PT. BAKRIE SWASAKTI UTAMA And Subsidiary</font></h>	 
<h4><font color='#1D5987'>Daily Cash & Bank Position</font></h4>	
</center> 

<div align="left" style="padding:50px">
<form name="formdata" action="<?php echo site_url('cb/dailycash')?>" method="post" id="formdata"> 
  	<table>  
	  	<!--tr>
			<td style="width: 170px;">PT</td>
			<td>
				<select name="pt" id="pt" class="mytextbox" style="width:300px;" required>
					<?php if ($this->session->userdata('sesspt') != 0) {?>
						<option value="<?php echo $ptsess->id_pt?>" selected> <?php echo $ptsess->nm_pt; ?> </option>
					<?php } ?>
					<option> Pilih PT </option>
					<?php foreach ($pt as $row) { ?>
					<option value="<?=@$row->id_pt; ?>"><?=@$row->nm_pt; ?></option>
					<? } ?>
				</select>
			</td>
		</tr-->
		<tr>
			<td>PROYEK</td>
			<td>
				<select name="project" id="project" class="mytextbox" style="width:300px;">
					<?php if ($this->session->userdata('sessproject') != 0) {?>
						<option value="<?php echo $projeksess->subproject_id?>" selected> <?php echo $projeksess->nm_subproject; ?> </option>
					<?php } ?>
					<option> PILIH PROJEK </option>

					<?php foreach ($proj as $row) { ?>
						<option value="<?=@$row->subproject_id; ?>"><?=@$row->nm_subproject; ?></option>
					<? } ?>

				</select>
			</td>
		</tr>
		<tr>
			<td>BANK</td>
			<td>
				<select name="bank" id="bank" class="mytextbox" style="width:300px;">
					<?php if ($this->session->userdata('sessbank') != 0) {?>
						<option value="<?php echo $banksess->bank_id?>" selected> <?php echo $banksess->namabank; ?> - <?php echo $banksess->nomorrek; ?> </option>
					<?php } ?>
					<option> PILIH BANK </option>
				</select>
			</td>
		</tr>
		<!--tr>
			<td style="width: 170px;">Project</td>
			<?php if ($this->session->userdata('sessproject') != 0) { ?>
				<td><input type="text" class="my-auto-complete mytextbox" value="<?php echo $projeksess->nm_subproject;?>" required/></td>
			<?php } else { ?>
				<td><input type="text" class="my-auto-complete mytextbox" required/></td>
			<?php } ?>
		<tr>
			<td>NAMA BANK</td>
			<?php if ($this->session->userdata('sessbank') != 0) { ?>
				<td><input type="text" class="mytextbox my-auto-complete-bank" value="<?php echo $banksess->namabank;?>" required/></td>
			<?php } else { ?>
				<td><input type="text" class="mytextbox my-auto-complete-bank" required/></td>
			<?php } ?>
		</tr-->	
		<tr>	
		  	<td><input type="submit" value="VIEW" id="submited" name="submit" class="mytextboxx" /></td>  
		  	</form>
		  	<td><a class="fancybox" href="#report"><button id="submit" name="submit" class="mytextboxx"> LAPORAN CASH </button></a></div></td>
	    </tr>
  	</table>

<script type="text/javascript" src="<?php echo base_url();?>assets/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jquery.fancybox.css" media="screen" />

<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox();
});

function field(){
	//document.getElementById('ptreport').disabled = false;
	document.getElementById('projected').disabled = false;
	document.getElementById('banked').disabled = false;
	if (document.getElementById('all').checked) {
		//document.getElementById('ptreport').disabled = true;
		document.getElementById('projected').disabled = true;
		document.getElementById('banked').disabled = true;
		//document.getElementById('ptreport').value = '';
		document.getElementById('projected').value = '';
		document.getElementById('banked').value = '';
	} else {
		//document.getElementById('ptreport').disabled = false;
		document.getElementById('projected').disabled = false;
		document.getElementById('banked').disabled = false;
	}
}
</script>
<br>
<!--div id="addbutton" style ="margin-left:5px;">
	<?php if ($strPost == 1 && $cashsess != null) {?>
		<a class="fancybox" href="#formadd"><button id="submit" name="submit" class="mytextboxx"> Add </button></a>  
	<?php } else { ?>
		<a onClick="alert('Belum Ada Nilai Beginning');"><button id="submit" name="submit" class="mytextboxx"> Add </button></a>
	<?php } ?>
</div-->
<br>
<div>
	<table id="mytable" class="scroll"></table>
	<div id="pager"></div>
</div>
</div>

<div id="report" style="width:550px; height:300px; display: none;">

<script type="text/javascript">
	$(document).ready(function() {
		/*$('#pted').change(function() {
			$.post("<?php echo base_url(); ?>cb/begincash/get_project/" + $('#pted').val(), {}, function(obj) {
                $('#projected').html(obj);
            });
		});*/
		$('#projected').change(function() {
			$.post("<?php echo base_url(); ?>cb/begincash/get_bank/" + $('#projected').val(), {}, function(obj) {
                $('#banked').html(obj);
            });
		});
	});
</script>

<form method="post" target="_blank" action="<?php echo base_url();?>cb/dailycash/reportdata">
	<table border=1>
		<tr>
			<h3>LAPORAN CASH</h3>
		</tr>
		<tr>
			<td>AS OFF</td>
			<td> : </td>
			<td><input type="text" name="date" id="assoff" class="mytextbox"/></td>
		</tr>
		<tr>
			<td>ALL REPORT</td>
			<td> : </td>
			<td><input type="checkbox" id="all" name="cek" value="1" onclick="field()"/></td>
		</tr>
		<input type="hidden" name="pted" value="">
		<!--tr>
			<td>NAMA PT</td>
			<td> : </td>
			<td>
				<select name="pted" id="pted" class="mytextbox" style="width:300px;">
					<option value=''> Pilih PT </option>
					<?php foreach ($pt as $row) { ?>
					<option value="<?=@$row->id_pt; ?>"><?=@$row->nm_pt; ?></option>
					<? } ?>
				</select>
			</td>
		</tr-->
		<tr>
			<td>PROYEK</td>
			<td> : </td>
			<td>
				<select name="projected" id="projected" class="mytextbox" style="width:300px;">
					<option> PILIH PROJEK </option>

					<?php foreach ($proj as $row) { ?>
						<option value="<?=@$row->subproject_id; ?>"><?=@$row->nm_subproject; ?></option>
					<? } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>BANK</td>
			<td> : </td>
			<td>
				<select name="banked" id="banked" class="mytextbox" style="width:300px;">
					<option> PILIH BANK </option>
				</select>
			</td>
		</tr>
		<tr>
			<td><input type="submit" value="LAPORAN" class="mytextboxx"/></td>
			<td><input type="reset" value="Reset" class="mytextboxx"/></td>
		</tr>
	</table>
</form>
</div>

<div id="formadd" style="width:830px; height:400px; display: none;">
<form method="post" id="formadd" action="<?php echo base_url();?>cb/dailycash/savecash">
	<script type="text/javascript">
		$(document).ready(function() {
			$('#reset').trigger('click');
		});
	</script>
	<table border=1>
		<tr>
			<h3>FORM ADD</h3>
		</tr>
		<tr>
			<td>PT</td>
			<td> : </td>
			<td><input type="text" class="mytextbox calculate" value="<?=$ptsess->nm_pt?>" readonly disabled/></td>
			<input type="hidden" name="pt" value="<?=$ptsess->id_pt?>">
		</tr>
		<tr>
			<td>Project</td>
			<td> : </td>
			<td><input type="text" class="mytextbox calculate" value="<?=$projeksess->nm_subproject?>" readonly disabled/></td>
			<input type="hidden" name="project" value="<?=$projeksess->subproject_id?>">
		</tr>
		<tr>			
			<td>Bank </td>
			<td> : </td>
			<td><input type="text" class="mytextbox calculate" value="<?=$banksess->namabank." - ".$banksess->nomorrek;?>" readonly disabled/></td>	
			<input type="hidden" name="bank" value="<?=$banksess->bank_id?>">			
		</tr>
		<tr>
			<td>Saldo Rekening</td>
			<td> : </td>
			<td><input type="text" style="text-align:right;" class="mytextbox calculate" value="<?=number_format($cashsess->end_amount)?>" readonly/></td>
		</tr>
		<tr>
			<td>Debet</td>
			<td> : </td>
			<td><input type="text" style="text-align:right;" name="debet" id="debet" class="mytextbox calculate" value="0" required/></td>
			<td>Credit</td>
			<td> : </td>
			<td><input type="text" style="text-align:right;" name="credit" id="credit" class="mytextbox calculate" value="0" required/></td>
		</tr>
		<tr>
			<td>Keterangan</td>
			<td> : </td>
			<td colpan=4><textarea style="width:100%;" name="remark" class="mytextbox" required></textarea></td>
		</tr>
		<tr>
			<td><input type="submit" value="Save" class="mytextboxx" onclick="trigcoy()"></td>
			<td><input type="reset" value="Reset" id="reset" class="mytextboxx"></td>
		</tr>
	</table>
</form>
</div>


