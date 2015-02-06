<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.form.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />

<link rel="stylesheet" href="<?=base_url()?>assets/css/menuku.css" type="text/css" />


<? #tampilkan query?>
<script language="javascript">

$(function(){
$(document).ready(function(){
                        //~ $('#tr1').hide();
                        //~ $('#tr2').hide();
                        //~ $('#tr3').hide();
                        //~ $('#tr4').hide();
                        //~ $('#tr5').hide();
                        //~ $('#tr6').hide();
                        //~ $('#tr7').hide();
                        //~ $('#tr8').hide();
                        //~ $('#tr9').hide();
                        //~ $('#tr10').hide();
                        //~ $('#tr11').hide();
                        //~ $('#tr12').hide();
                        //~ $('#tr13').hide();
                        //~ $('#tr14').hide();
                        
            });

function loadData(type,parentId){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('statuscont/loaddata')?>',
		{data_type: type, parent_id: parentId},
		function(data){
		 
		   if(data.error == undefined){ 
			 $('#'+type).empty();
			 $('#'+type).append($('<option></option>').val('').text(''));
			 for(var x=0;x<data.length;x++){
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text('');
		  }else{
			 alert(data.error);
			 //$('#cb_karycutials').text('');
		  }
		},'json' 
      );      
   }


	
	loadData('noref',0);
	

	/*DropDown Menu*/
	$('#proj').change(function(){
			loadData('sub',$('#proj option:selected').val());
		});
	
	
	
		
	/*event hide form*/
	$('#noref').change(function(){
		
		//~ alert('tes');
		$.getJSON('<?=site_url('statuscont/tampil')?>/'+$(this).val(),
				function(data){
					    $('#nounit').val(data.nounit);
					    
					   
				});
		 
		 });

	/*fungsi validasi numeric*/
	  
	  var kugiri = new RegExp(",", "g");
	  var rep_coma = new RegExp(",", "g");
	  $('.calculate').bind('keyup keypress',function(){
			//$(this).val($(this).val());
		  $(this).val(numToCurr($(this).val()));
			
			parseInt($("#price_meter").val().replace(kugiri,""));
		  
		  }).numeric();




/*validation form*/
$(function(){
		$('#formadd')
		.validationEngine()
		.ajaxForm({
			success:function(response){
				if(response == 4){
					alert("Data Berhasil Disimpan");
					refreshTable();
				}else{
				    alert(response);
				 }
			
		}
		});	
	});		
		
});
</script>




<? /*$data=$this->mstmodel->group();*/ ?>


<!--
<link rel="stylesheet" href="<?#=base_url()?>assets/css/menuform.css" type="text/css" />
-->
<form method='post' action='<?=site_url()?>statuscont/UpdateLoo' id='formadd'>
<table border="0" cellpadding="2" cellspacing="2">
	
  
    <!--Customer Profile-->
    <tr>
		<td colspan="3" style=""><font color='#FF0000'><b><u>ENTRY CONTRACT ROUTING</u></b></font></td>
    </tr>
    <tr>
		
		
		<td >Date Routing</td>
		<td>:</td>
		<td><input  name='tgl' id='tgl'style='width:80;background-color:#C0C0C0' readonly >
			<a href="JavaScript:;" onClick="return showCalendar('tgl', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
		</td>
		
		
    </tr>
			
		
    
	<tr >
		
		<td>No.LOO</td>
		<td>:</td>
		<td>
			<select name='noref' id='noref' style='background-color:#FFFF00;width:150'></select>
		</td>	
		
		
			
	</tr>
	
	<tr id='tr2'>
		<td >Tenant</td>
		<td>:</td>
		<td><input  name='nounit' id='nounit' style='background-color:#FFFF00;width:150' readonly ></td>
		
			
			
	</tr>
	
	<tr>
		
		<td>Status</td>
		<td>:</td>
		<td><select name='tenant' id='tenant' style='width:150' readonly>
			<option value='0'></option>
			<option value='1'>Process On Legal</option>
			<option value='2'>Done</option>
			<option value='3'>Pending</option>
			<option value='4'>Void</option>
			
		</select></td>
			
			
	</tr>
	
	
	
	<tr>
		<td ><b><u>Keterangan</td></u></b>
			
	</tr>
	
	<tr>
		<td colspan='6'><textarea style='width:350'></textarea></td>
		
	</tr>
	
	

	<tr id='tr14'>
		<td colspan="3">
			<input type="submit" name="save" value="Save"/>
			<input type="reset" name="cancel" value="Cancel"/>
		</td>
	</tr>	
</table>
</form>
