<?
$this->load->view(ADMIN_HEADER);
?>

<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/icon.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" />

<!--script language="javascript" src="<?=base_url()?>assets/js/jquery-1.7.2.min.js"></script-->
<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.edatagrid.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>

<script type="text/javascript">
$(function(){
            $.fn.datebox.defaults.formatter = function(date) {
                        var y = date.getFullYear();
                        var m = date.getMonth() + 1;
                        var d = date.getDate();
                        return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
            };
		$('#tgl').datebox({  
        required:true  
    }); 
 });
 
</script>

<script type="text/javascript">
$(document).ready(function() {
	$("#con").change(function() {
        $.post("<?php echo base_url(); ?>ap/cetakhutang/get_project/" + $('#con').val(), {}, function(obj) {
            $('#pro').html(obj);
        });
    });
    $("#pro").change(function() {
        $.post("<?php echo base_url(); ?>ap/cetakhutang/get_vendor/" + $('#pro').val(), {}, function(obj) {
            $('#ven').html(obj);
        });
    });
});
</script>

<script language="javascript" src="<?=site_url()?>assets/jquery-ui.js"></script>

<script type="text/javascript">
$(function() {
$( "#tgl1" ).datepicker({
	changeMonth: true,
	changeYear: true,
	dateFormat : 'yy-mm-dd',	 
	onClose: function( selectedDate ) {
		$( "#tgl2" ).datepicker( "option", "minDate", selectedDate );
	}
});
$( "#tgl2" ).datepicker({
	changeMonth: true,
	changeYear: true,
	dateFormat : 'yy-mm-dd',	 
	onClose: function( selectedDate ) {
		$( "#tgl1" ).datepicker( "option", "maxDate", selectedDate );
	}
});
});
</script>

<script type="text/javascript">
function myf(){
	document.getElementById("tgl1").disabled = false;
	document.getElementById("tgl2").disabled = false;
    if ( document.getElementById('cek').checked === true ) {
       document.getElementById("tgl1").disabled = true;
       document.getElementById("tgl1").value = '';
       document.getElementById("tgl2").disabled = true;
       document.getElementById("tgl2").value = '';
    }
}
</script>

<h2><font color='red' size='4'>Kartu Hutang Vendor <hr width="150px" align="left"></font></h2>
<form id="formID" method="post" action="<?=base_url()?>ap/cetakhutang/cetakhtg" target="blank">
<table>
	<tr>
		<td>CONSOLE : </td>
		<td><select name="console" class="required" id="con">
			<option value=""> PILIH CONSOLE</option>
			<?php
			foreach ($project as $row) {
				echo "<option value=".$row->kd_project."> ".$row->nm_project." </option>";
			}
			?>
		</select></td>
	</tr>
	<tr>
		<td>Project : </td>
		<td><select name="project" class="required" id="pro">
			<option value="" selected> PILIH PROJECT</option>
		</select></td>
	</tr>	
	<tr>
		<td>Vendor : </td>
		<td><select name="vendor" class="required" id="ven">
			<option selected> PILIH VENDOR </option>
		</select></td>
		
	</tr>	
	<tr>
		<td>ALL Periode : </td>
		<td><input type="checkbox" id="cek" onchange="myf()"/></td>
	</tr>
	<tr>
		<td>As Off : </td>
		<td><input type="text" id="tgl" name="awal"/></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="klik" id="klik" value="Print"/>
		<input type="submit" name="export" id="export" value="Export to Excel"/></td>
	</tr>
	
</table>
</form>

<?
$this->load->view(ADMIN_FOOTER);
?>
