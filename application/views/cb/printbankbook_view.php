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
		$('#tgl1').datebox({  
        required:true  
    });  
		$('#tgl2').datebox({  
        required:true  
    });  
         
    
    $('#all').change(function(){
		$('#view').text('');
		$('#view').append('<option>ALL</option>'); 
		
	});
		

    
    
      
 });
 
</script>
<h2><font color='red' size='4'>Bank Book Report <hr width="150px" align="left"></font></h2>
<form method="post" action="<?=base_url()?>cb/printbankbook_call/cetakbankbook" target="_blank">
<table>
		
	<tr>
		<td>Kode Bank</td>
		
		<td>
			
				<select name='code' id='code' class='required'>
					<option value=0></option>
	<?		foreach($bank as $row){  ?>
			
			<option value="<?=$row->bank_coa ?>"><?=$row->bank_nm ?></option>
		<? } ?>
 				</select></td>
				
	</tr>
	
	<tr>
		<td>As Off   : </td>
		<td><input type="text" name="tgl1" id="tgl1" class="required" style="width:120px">&nbsp;/&nbsp;<input type="text" name="tgl2" id="tgl2" class="required" style="width:120px"></td>
		
	</tr>
	
	
	
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="klik" id="klik" value="Print"/>
		</td>
	</tr>
	
</table>
</form>

<?
$this->load->view(ADMIN_FOOTER);
?>
