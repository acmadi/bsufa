<?
$this->load->view(ADMIN_HEADER);
?>
<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/icon.css" type="text/css" />
<!--link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" />

<!--script language="javascript" src="<?=base_url()?>assets/js/jquery-1.7.2.min.js"></script-->
<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>

<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.css" />
<script src="<?=base_url()?>assets/js/jquery-ui-1.8.2.min.js"></script>

<script type="text/javascript">
$(function(){
            $.fn.datebox.defaults.formatter = function(date) {
                        var y = date.getFullYear();
                        var m = date.getMonth() + 1;
                        var d = date.getDate();
                        return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
            };
		  
         $('#enddate').datebox({  
         required:true
    });
    
    
		
            //FUNGSI LOAD DATA
           $('input:checkbox').change(function(){
                        if($("input:checkbox:checked").val()== 1) {
                                    
                                 $('#vendor').hide();
                                //setTimeout('location.reload(true);',1);
								//$('#check').val(1);
                                  // $('#trxtype').empty();
                                  //$('#trxtype').append('<option></option>'); 
                                   
                                   
                             }else {
			//					 setTimeout('location.reload(true);',1);
								  $('#vendor').show();}
               
   });

    
    
      
 });
 
</script>
<h2><font color='red' size='4'>Payment AP Vendor<hr width="150px" align="left"></font></h2>

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

<form method="post" action="<?=base_url()?>ap/cetakappay_call/cetakappay" target="_blank">
<table>
	<tr>
	<td>Project</td>
	<td>
	<select name="project_detail" id="project_detail">
		<option></option>
		<!--option value=41011>AWANA TOWN HOUSE</option>
		<option value=41012>AWANA CONDOTEL</option>
		<option value=41013>SARDJITO</option-->
		<!--option value=1>INFRASTRUKTUR KAWASAN</option-->
		<option value=0>ALL</option>
		<?php foreach($project as $row){?>
		<option value="<?php echo $row->subproject_id;?>"><?php echo $row->nm_subproject;?></option>
		<?php } ?>	
	</select>   
	</td>
	</tr>
	<tr id="vendor">
		<td>Vendor Nm.</td>
		<td><input type="text" class="autocomplete-vendor" style="width:120px;"></td>
		<input type="hidden" name="vendor" id="idvendor">

		<!--td><select name="vendor" style="width:120px">
		<option></option>
		<?php foreach($vendor as $row):?>
		<option value="<?=@$row->kd_supp_gb?>"><?=@$row->nm_supplier?></option>
		<?endforeach;?>
		
		</select></td-->
	</tr>
	<tr>
		<td>All Vendor</td>
		<td><input type="hidden" name="checkbox" value="0" /> <input type="checkbox" name="checkbox" value="1" /></td>
		
	</tr>
	
	<tr>
		<td>As Off</td>
		<input type="hidden" name="startdate" id="startdate" value="01-01-2005">
		<!--td>End Date</td-->
		<td><input type="text" name="enddate" id="enddate" class="required" style="width:120px"></td>
	</tr>
	
	
	
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="klik" id="klik" value="Print"/>
		<input type="submit" name="export" id="export" value="Print to Excel"/></td>
	</tr>
	
</table>
</form>

<?
$this->load->view(ADMIN_FOOTER);
?>
