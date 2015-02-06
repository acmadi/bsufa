<?
$this->load->view(ADMIN_HEADER);
?>

<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />

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
		$('#tgl1').datebox({  
        required:true  
    });     
		$('#tgl2').datebox({  
        required:true  
    });  
      
 });
 
</script>
<h2><font color='red' size='4'>General Ledger <hr width="150px" align="left"></font></h2>
<form method="post" action="<?=base_url()?>gl/generalledgeracc_call/cetakgl" target="_blank">
<table>
	<tr>
	<td>Project</td>
	<td>
	<select name="project_detail" id="project_detail">
		<option></option>
		<!--<option value=41011>AWANA TOWN HOUSE</option>
		<option value=41012>AWANA CONDOTEL</option>
		<option value=41013>HADININGRAT TERRACE</option>
		<option value=1>INFRASTRUKTUR KAWASAN</option>
		<option value=0>ALL</option>-->
		<? //foreach ($project as $row) { ?>
		<option value="0">All</option>
		<? //} ?>
	</select>   
	</td>
	</tr>		
	<tr>
		<td>Date   : </td>
		<td colspan='3'><input type="text" name="tgl1" id="tgl1" class="required" style="width:120px">To
		<input type="text" name="tgl2" id="tgl2"  class="required" style="width:120px"></td>		
	</tr>
	<tr>
	<td>Account No   : </td>
	<td colspan = '3'>
		<select name="acc_no" id="acc_no">
		<option velue = '0'>--choose--</option>
		<? foreach ($account as $row) { ?>
		<option value=<?=$row->acc_no; ?>><?=$row->acc_name; ?></option>
		<? } ?>
		</select>
		<!--input type="text" name="acc_no" id="acc_no"  style="width:120px"--> 
	
	
	To
	
		<select name="acc_no2" id="acc_no2">
		<option velue = '0'>--choose--</option>
		<? foreach ($account as $row) { ?>
		<option value=<?=$row->acc_no; ?>><?=$row->acc_name; ?></option>
		<? } ?>
		</select>
	<!--input type="text" name="acc_no2" id="acc_no2"  style="width:120px"-->
	
	</td>
	</tr>
	
	
	
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="klik" id="klik" value="Print"/>
		<input type="submit" name="ekspor" id="ekspor" value="Print to Excel"/></td>
	</tr>
	
</table>
</form>

<?
$this->load->view(ADMIN_FOOTER);
?>
