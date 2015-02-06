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
 $(document).ready(function(){
	 $('#tr1').hide();
 
 
  
 
 })
    $('input:checkbox').change(function(){
		if($('input:checkbox[name=det_rptbgt]:checked').val() == '1' ){
		 $('#tr1').show();
	 }else{ 
		 $('#tr1').hide(); 
		
		 }
	})
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
<h2><font color='red' size='4'>Contract List <hr width="150px" align="left"></font></h2>
<form method="post" action="<?=base_url()?>project/contractlist_call/contractlist" target="_blank">
<table>
		
	
	
	
	<tr>
		<td>As Off   : </td>
		<td><input type="text" name="tgl" id="tgl"  style="width:120px"></td>		
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
