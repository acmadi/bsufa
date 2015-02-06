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
		$('#tgl').datebox({  
        required:true  
    });     
	$('#tgl2').datebox({  
        required:true  
    });  
      
 });
 
</script>
<?php
$session_id = $this->UserLogin->isLogin();
$q = $this->db->query("select * from db_subproject where id_pt = ".$session_id['id_pt']." ")->result();
?>

<h2><font color='red' size='4'>General Ledger <hr width="150px" align="left"></font></h2>
<form method="post" action="<?=base_url()?>gl/generalledger_call/cetakgl" target="_blank">
<table>
	<tr>
	<td>Project</td>
	<td>
	<select name="project_detail" id="project_detail">
		<option></option>
		
		<option value=0>ALL</option>
	</select>   
	</td>
	</tr>			
	<tr>
		<td>Date   : </td>
		<td><input type="text" name="tgl" id="tgl" class="required" style="width:120px">To
		<input type="text" name="tgl2" id="tgl2"  class="required" style="width:120px"></td>		
		
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
