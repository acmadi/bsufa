<?
$this->load->view(ADMIN_HEADER);
?>
<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<!--link rel="stylesheet" href="<?=base_url()?>assets/css/icon.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" /-->

<!--script language="javascript" src="<?=base_url()?>assets/js/jquery-1.7.2.min.js"></script-->
<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>

<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.css" />
<script src="<?=base_url()?>assets/js/jquery-ui-1.8.2.min.js"></script>


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
	
	
	$('#pts').change(function(){ 
	var id = $(this).val();
	//alert(id);
	$.post('<?php echo site_url();?>ap/kartuhutang/get_project/'+id,{},function(obj){
	$('#project').html(obj);
	});
});
	
	
	

});


</script>



<h2 style="margin:10px">Report Kartu Hutang<hr width="90px" align="left"></h2>

<script>
$(document).ready(function(){
	$( ".autocomplete-vendor" ).autocomplete({
		source: function(request, response) {
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_vendor",
				data: { term: $(".autocomplete-vendor").val().replace(/ /g,'')},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		select: function (event, ui) {
			var id = ui.item.id;
			$("#idvendor").val(id);
		},
		minLength: 1
	});
});
</script>


<div class="printed">
<form action="<?=base_url()?>ap/apinvoice/print_kartuhutang" id="formAdd" method="POST" target="_blank">
	<?php
		$tgl = date('d-m-Y');
	?>
		<table border="0" style="margin:10px">
			<tr>
				<td>Project</td>
				<td>:</td>
				<td >
					<select name="project" id="project" style="width:120px">
				<option value="0">All</option>
				<?php 
				$q = $this->db->query("select * from project where pt_project = 11 and judul = 'N'")->result();
				foreach($q as $rows){?>
				<option value="<?php echo $rows->kd_project;?>"><?php echo $rows->nm_project;?></option>
				<?php } ?>
			</select>
				</td>
			</tr>
			<tr>
				<td>Vendor</td>
				<td>:</td>
				<td><input type="text" class="autocomplete-vendor" style="width:120px;"></td>
		<input type="hidden" name="vendor" id="idvendor">

				<!--td>:</td>
				<td >
					<select name="vendor" id="vendor" style="width:120px">
				<option value="0">All</option>
				<?php
				$query = $this->db->query("select * from pemasokmaster")->result();
				foreach($query as $row){?>
				<option value="<?php echo $row->kd_supplier;?>"><?php echo $row->nm_supplier;?></option>
				<?php } ?>
			</select>
				</td-->
			</tr>
			<tr>
				<td colspan='2'>Start Date</td>
				<td><input type="text" name="startdate" id="startdate" class="required" style="width:120px"></td>
				<td>End Date</td>
				<td><input type="text" name="enddate" id="enddate" class="required" style="width:120px"></td>
			</tr>
			
			<tr>
				<td colspan="3"><input type="submit" name="klik" value="Print"/><input type="submit" name="convert" value="Print to Excel"/></td>
				
			</tr>
			
			
		</table>		
</form>
</div>
<?$this->load->view(ADMIN_FOOTER)?>
