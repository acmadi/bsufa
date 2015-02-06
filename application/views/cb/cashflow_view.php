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
<?php
			$this->load->library('session');
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->pt	= $session_id['id_pt'];
			$project = $this->db->query("select subproject_id,nm_subproject from db_subproject where id_pt = '".$this->pt."'")->result();
			
?>
<h2 style="margin:10px"><font color='red' size='4'>CASHFLOW<hr width="150px" align="left"></font></h2>
<form method="post" action="<?=base_url()?>cb/cetakcashflow_call/cetak" target="_blank">
<table style="margin:10px">
	<tr>
		<td>Project   : </td>
		<td>
		<select name="project">
		<option value="0">All</option>
		<?php
		foreach($project as $row){
		?>
		<option value="<?php echo $row->subproject_id; ?>"><?php echo $row->nm_subproject;?></option>
		<?php } ?>
		</select>
		</td>
		
	</tr>	
	<tr>
		<td>Periode   : </td>
		<td><input type="text" name="tgl" id="tgl" class="required" style="width:120px"></td>
		
	</tr>
	
	
	
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="klik" id="klik" value="Print"/>
		<input type="submit" name="ekspor" id="klik" value="Print to Excel"/></td>
	</tr>
	
</table>
</form>

<?
$this->load->view(ADMIN_FOOTER);
?>
