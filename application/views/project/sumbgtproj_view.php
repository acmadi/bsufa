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
 
	/*$('#klik').click(function(){
		var tanggal = $('#kaping').val();
		
		
		alert(tanggal);
		
		//if($('#tgl').val()==''){		
		//		alert('Tanggal Belum di isi');
		//	}else{ alert('lanjutkan');}

    })*/
 
			
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
<h2><font color='red' size='4'>Summary Project Cost<hr width="150px" align="left"></font></h2>
<form method="post" action="<?=base_url()?>project/sumbudgetproject_call/sumbgtproj" target="_blank">
<table>
		
	<tr id="tr1">
		<td>Project Option</td>
		<td><select name="proj_rptbgt" id="proj_rptbgt" class="required" >
			<option></option>
			<?foreach ($proj as $row):?>
			<option value="<?=$row->subproject_id?>"><?=$row->nm_subproject?></option>
			<?endforeach?>
		</td>		
	</tr>
	
	
	
	<tr>
		
		<?#foreach($proj as $row){ echo $row->nm_subproject;}?>
		
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
