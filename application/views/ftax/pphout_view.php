<?
$this->load->view(ADMIN_HEADER);
?>
<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<!--link rel="stylesheet" href="<?=base_url()?>assets/css/icon.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" /-->

<!--script language="javascript" src="<?=base_url()?>assets/js/jquery-1.7.2.min.js"></script-->
<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.edatagrid.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>


<script type="text/javascript">

       




$(function(){
	//FUNGSI LOAD DATA
	//~ $('#project').hide();
	$('input:checkbox').change(function(){
		if($("input:checkbox:checked").val()==1) {
			$('#project').hide();
			}else { $('#project').show();};
		
	});
	
	     $.fn.datebox.defaults.formatter = function(date) {
                        var y = date.getFullYear();
                        var m = date.getMonth() + 1;
                        var d = date.getDate();
                        return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
            };
		$('#startdate').datebox({  
        required:true  
    });  
         $('#enddate').datebox({  
         required:true
    });
	
	
	$('#pt').change(function(){ 
	var id = $(this).val();
	//alert(id);
	$.post('<?php echo site_url();?>accounting/request/get_project/'+id,{},function(obj){
	$('#project').html(obj);
	});
});
	
	

});


</script>



<h2 style="margin:10px">Report PPh Payment<hr width="90px" align="left"></h2>
<div class="printed">
<form action="<?=base_url()?>ftax/pphout/print_pph" id="formAdd" method="POST" target="_blank">
	<?php
		$tgl = date('d-m-Y');
	?>
		<table border="0" style="margin:10px">
			<tr>
				<td>PPh</td>
				<td>:</td>
				<td >
				<!--input type="checkbox" name='cek' id='cek' value='1' -->
				<select name="pph" id="pph">
				<option value="0">Belum Dibayar</option>
				<option value="1">Sudah DIbayar</option>
				</select>
				</td>
			</tr>
			
			
			<!--tr>
				<td>PROJECT</td>
				<td>:</td>
				<td >
					<select name="project" id="project" style="width:120px">
				<option></option>

			</select>
				</td>
			</tr-->
			
			<tr>
				<td colspan='2'>Start Date</td>
				<td><input type="text" name="startdate" id="startdate" class="required" style="width:120px"></td>
				<td style="padding-left:10px">End Date</td>
				<td><input type="text" name="enddate" id="enddate" class="required" style="width:120px"></td>
			</tr>
			
			<tr>
				<td colspan="3"><input type="submit" name="klik" value="Print"/><input type="submit" name="convert" value="Print to Excel"/></td>
				
			</tr>
			
			
		</table>		
</form>
</div>
<?$this->load->view(ADMIN_FOOTER)?>
