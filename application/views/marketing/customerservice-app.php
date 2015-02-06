



<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>







<script language="javascript">
$(function(){
	
	//FUNGSI LOAD DATA
	function loadData(type,parentId){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('customerservice/loaddata')?>',
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
	
	loadData('status',0);
	
	loadData('fuby',0);
	
	
	
	
	});
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
	

</script>



<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/tabcontent.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuformx.css" type="text/css" />
<script language="javascript" src="<?=base_url()?>assets/js/tabcontent.js"></script>
<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="country1" class="selected">Complaint Customer</a></li>
<li><a href="#" rel="country2">Last Follow Up</a></li>
<li><a href="#" rel="country3">Next Follow Up</a></li>

</ul>

<div style="border:1px solid gray; width:700px; margin-bottom: 1em; padding: 10px">

<div id="country1" class="tabcontent">

	<table border="0" cellpadding="2" cellspacing="2">
	
  
    <!--Customer Complaint-->
    <tr>
		<td colspan="3" style=""><b>Customer Complaint</b></td>
    </tr>
    <tr>
		<td>Date</td>
		<td>:</td>
		<td><?
		
		$tgl = $cs['tgl_complaint'];
		$tgl = indo_date($tgl);?>
		<?=@$tgl;?></td>
		
		<td>Complaint Type</td>
		<td>:</td>
		<td><?=@$cs['cstipe_nm']?></td>
		
			
	</tr>
	<tr>
		<td>Customer Name</td>
		<td>:</td>
		<td><?=@$cs['customer_nama'];?></td>
		
		<td>Complaint Description</td>
		<td>:</td>
		<td><?=@$cs['csdesc_nm']?>		</td>
	</tr>	
	<tr>
		<td>Phone</td>
		<td>:</td>
		<td><?=@$cs['customer_hp'];?></td>
		
		<td>Complaint Disposition</td>
		<td>:</td>
		<td><?=@$cs['divisi_nm']?>
		</td>
	</tr>
	<tr>
		<td>Address</td>
		<td>:</td>
		<td colspan='4'><?=@$cs['customer_alamat1']?>
		</td>
	</tr>
	<tr>
		<td>City</td>
		<td>:</td>
		<td><?=@$cs['kota_nm']?>
		</td>
	</tr>
	<tr>
		<td>Project</td>
		<td>:</td>
		<td><?=@$cs['nm_subproject'];?></td>
	</tr>
	
	<tr>
		<td>Note</td>
		<td>:</td>
		<td colspan ='6'><?=@$cs['note']?></td>
	
	</tr>

		
	</table>
</div>



<div id="country2" class="tabcontent">
	
		<table border="0" cellpadding="2" cellspacing="2">
	
		
		<tr>
			<td ><span class='teks'>Follow Up.Date</span></td>
			<td>:</td>
			<td><?=@$followup['fu_tgl']?></td>
		</tr>
		<tr>
			<td ><span class='teks'>Follow Up.By</span></td>
			<td>:</td>
			<td><?=@$followup['fumedia_nm']?></td>
		</tr>
		<tr>
			<td><span class='teks'>Complaint Status</span></td>
			<td>:</td>
			<td><font color='red'><?=@$followup['csfustat_nm']?></font></td>
		</tr>
		<tr>
			<td><span class='teks'>Next Follow Up.Date</span></td>
			<td>:</td>
			<td><?$nextdate = $followup['tobefu_tgl'];
				  $nextdate = indo_date($nextdate);?>
				  <?=@$nextdate;?></td>
	  	</tr>
		
		<tr>
			<td ><span class='teks'>Note.</span></td>
			<td colspan ='2'>:</td>
			<td><font align='left'><?=@$followup['catatan']?></font></td>
		</tr>
		
		<tr>
			<td colspan ='3'></td>
		</tr>
		
	
	</table>
</div>

<div id="country3" class="tabcontent">
<form method='post' action='<?=site_url()?>customerservice/InputCSFollowup' id='formadd'>
<input  type='hidden' name='customer' value="<?=@$cs['id_customer'];?>">
<? $tes =@$followup['flag_id'];
  if ($tes == 3){ 
	  
	  
	  ?><font color=red><? echo 'SORRY COMPLAINT HAS DONE'; ?></font> <?} 
	  
	  else {?>	

<table border="0" cellpadding="2" cellspacing="2">

		
		<tr>
			<td >Follow Up.Date</td>
			<td>:</td>
			<td>
				<input type="text" name="fudate"  value="<?=$tgl = date("d-m-Y");  ?>" style='width:75px' readonly>
			</td>
		</tr>
		<tr>
			<td >Follow Up.By</td>
			<td>:</td>
			<td>
				<select name="fuby" id='fuby' class='validate[required]' style='width:150px'></select>
			</td>
		</tr>
		<tr>
			<td>Complaint Status</td>
			<td>:</td>
			<td><select name="status" id="status" style='width:150px'></select></td>
		</tr>
		<tr>
			<td>Next Follow Up.Date</td>
			<td>:</td>
			<td>
			<input type="text" name="nextfudate" id="nextfudate"  readonly="true" style='width:75px'>
			<a href="JavaScript:;" onClick="return showCalendar('nextfudate', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
			</td>
		</tr>
		
		<tr>
			<td >Note.</td>
			<td colspan ='2'>:</td>
		</tr>
		
		<tr>
			<td colspan ='3'><textarea name='note' style='width:400px'></textarea></td>
		</tr>
		<tr>
		<td colspan="3">
			<input type="submit" name="save" value="Save"/>
			<input type="reset" name="cancel" value="Cancel"/>
		</td>
	</tr>	
	</table>
	</form>
	
</div>


<? } ?>


<script type="text/javascript">

var countries=new ddtabcontent("countrytabs")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>
