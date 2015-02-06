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
         
    
    
		

    
    
      
 });
 
</script>
<h2><font color='red' size='4'>Outstanding Voucher <hr width="150px" align="left"></font></h2>
<form method="post" action="<?=base_url()?>cb/cetakoutvc_call/cetakoutvc" target="_blank">
<table>
	<tr>
	<td>Project</td>
	<td>
	<select name="project_detail" id="project_detail">
		<option></option>
		<option value=0>ALL</option>
		<?php
		$sql = $this->db->query("select * from project where judul = 'N'")->result();
		foreach($sql As $row){?>
		<option value="<?php echo $row->kd_project;?>"><?php echo $row->nm_project;?></option>
		<?php } ?>
	</select>   
	</td>
	</tr><tr>
	<td>Bank</td>
	<td>
	<select name="bank" id="bank">
		<option></option>
		<option value=0>ALL</option>
		<?php
		$sqls = $this->db->query("select * from db_bank where id_pt = '11'")->result();
		//var_dump($sql);exit;
		foreach($sqls As $row){?>
		<option value="<?php echo $row->bank_id;?>"><?php echo $row->bank_nm;?> | <?php echo $row->bank_acc;?></option>
		<?php } ?>
	</select>   
	</td>
	</tr>
	
	<tr>
		<td>As Off   : </td>
		<td><input type="text" name="tgl" id="tgl" class="required" style="width:120px"></td>
		
	</tr>
	
	
	
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="klik" id="klik" value="Print"/>
		<input type="submit" name="klik" id="klik" value="Print to Excel"/></td>
	</tr>
	
</table>
</form>

<?
$this->load->view(ADMIN_FOOTER);
?>
