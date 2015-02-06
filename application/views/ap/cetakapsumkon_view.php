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
		$('#tgl').datebox({  
        required:true  
    });  
    
     
    
         
       //FUNGSI LOAD DATA
           $('input:checkbox').change(function(){
                        if($("input:checkbox:checked").val()== 1) {
                               
                                 $('#category').hide();
                                 $('#proj').hide();
                                //setTimeout('location.reload(true);',1);
								//$('#check').val(1);
                                  // $('#trxtype').empty();
                                  //$('#trxtype').append('<option></option>'); 
                                   
                                   
                             }else {
								// setTimeout('location.reload(true);',1);
								  $('#category').show();
								  $('#proj').show();}
               
   });
   
      //FUNGSI LOAD DATA
     //     $('input:check2').change(function(){
    //                    if($("input:check2:checked").val()== 2) {
     //                                 alert('tes');   
     //                            $('#category').hide();
                                //setTimeout('location.reload(true);',1);
								//$('#check').val(1);
                                  // $('#trxtype').empty();
                                  //$('#trxtype').append('<option></option>'); 
                                   
                                   
          //                   }else {
							 //setTimeout('location.reload(true);',1);
			//					  $('#category').show();}
		//		}				});
    
      
 });
 
</script>

<h2><font color='red' size='4'>Summary Aging A/P Consolidated<hr width="150px" align="left"></font></h2>
<form method="post" action="<?=base_url()?>ap/cetakapsumkon_call/cetakapsumkon" target="_blank">
<table>
	
	<tr id="proj">
		<td>Project :&nbsp;</td>
		<td><select name="proj" style="width:120px">
		<option></option>
		<?php foreach($proj as $row):?>
		<option value="<?=@$row->subproject_id?>"><?=@$row->nm_subproject?></option>
		<?endforeach;?>
		
		</select></td>
	</tr>	

	<tr id="category">
		<td>A/P Category</td>
		<td><select name="category" style="width:120px">
		<option></option>
		<?php foreach($category as $row):?>
		<option value="<?=@$row->id_kelusaha?>"><?=@$row->nm_kelusaha?></option>
		<?endforeach;?>
		
		</select></td>
	</tr>
		<tr>
		<td>All</td>
		<td><input type="checkbox" name="checkbox" id="check" value='1' ></td>
		
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
