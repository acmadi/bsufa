



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
      $.post('<?=site_url('customerprospek/loaddata')?>',
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
	
	loadData('fuby',0);
	loadData('prospekstatus',0);
	
	
	
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
<li><a href="#" rel="country1" class="selected">Profile Prospect Customer</a></li>
<li><a href="#" rel="country2">Last Follow Up</a></li>
<li><a href="#" rel="country3">Next Follow Up</a></li>

</ul>

<div style="border:1px solid gray; width:700px; margin-bottom: 1em; padding: 10px">

<div id="country1" class="tabcontent">

	<table border="0" cellpadding="2" cellspacing="2">
	
		<tr>
			<td><span class='teks'>Cst.Type</span></td>
			<td>:</td>
			<td><?=@$cust['filter_nm']?></td>	
			<td style="padding:0 0 0 80" ><span class='teks'>Handphone</span></td>
			<td>:</td>
			<td><?=@$cust['customer_hp']?></td>
		</tr>
		
		<tr>
			<td ><span class='teks'>Category</span></td>
			<td>:</td>
			<td ><?=@$cust['nm_group']?></td>
			<td style="padding:0 0 0 80"><span class='teks'>Email</span></td>
			<td>:</td>
			<td><?=@$cust['email']?></td>
		</tr>
	
		<tr>
			<td ><span class='teks'>Media Type</span></td>
			<td>:</td>
			<td><?=@$cust['tipemedia_nm']?></td>
				
			<td style="padding:0 0 0 80"><span class='teks'>Sales</span></td>
			<td>:</td>
			<td><?=@$add->nama?></td>
		</tr>

		<tr>
			<td  ><span class='teks'>Media Source</span></td>
			<td>:</td>
			<td><?=@$cust['media_nm']?></td>
			
			
			<td style="padding:0 0 0 80"><span class='teks'>Manager of Duty</span></td>
			<td>:</td>
			<td><?=@$mod->nama?></td>	
		</tr>
	
		<tr>
			
			<td><span class='teks'>Venue</span></td>
			<td>:</td>
			<td><?=@$add->venue?></td>
			
			
			<td style="padding:0 0 0 80"><span class='teks'>Shift of Duty</span></td>
			<td>:</td>
			<td><?=@$mod->shift?></td>
		</tr>
	
		<tr>
			<td><span class='teks'>Customer Prospect</span></td>
			<td>:</td>
			<td><?=@$cust['customer_nama']?></td>
			
			
			<td style="padding:0 0 0 80"><span class='teks'>Term of Payment</span></td>
			<td>:</td>
			<td><?=@$mod->payment?></td>
		</tr>
	
		<tr>
			<td><span class='teks'>Registration Date</span></td>
			<td>:</td>
			<td>
				<?$reg =$add->regdate;
				$reg   = indo_date($reg);?>
				<?=@$reg?>
			</td>
			
			
		</tr>

		<tr>
			<td><span class='teks'>Project Interest</span></td>
			<td>:</td>
			<td><?=@$mod->nm_subproject?></td>
			
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
			<td><span class='teks'>Prospect Status</span></td>
			<td>:</td>
			<td><font color='red'><?=@$followup['prospectstat_nm']?></font></td>
		</tr>
		<tr>
			<td><span class='teks'>Next Follow Up.Date</span></td>
			<td>:</td>
			<td><?=@$followup['tobefu_tgl']?></td>
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
<form method='post' action='<?=site_url()?>customerprospek/InputProspekFollowup' id='formadd'>
<input  type='hidden' name='customer' value="<?=@$data->customer_id?>">
<? $tes =@$followup['followup_nm'];
  if ($tes == 4){ 
	  
	  
	  ?><font color=red><? echo 'SORRY HAS PURCHASED'; ?></font> <?} 
	  
	  else {?>	

<table border="0" cellpadding="2" cellspacing="2">

		
		<tr>
			<td >Follow Up.Date</td>
			<td>:</td>
			<td>
				<input type="text" name="fudate"  value="<?=$tgl = date("d-m-Y");  ?>" readonly>
			</td>
		</tr>
		<tr>
			<td >Follow Up.By</td>
			<td>:</td>
			<td>
				<select name="fuby" id='fuby' class='validate[required]'></select>
			</td>
		</tr>
		<tr>
			<td>Prospect Status</td>
			<td>:</td>
			<td><select name="prospekstatus" id="prospekstatus"></select></td>
		</tr>
		<tr>
			<td>Next Follow Up.Date</td>
			<td>:</td>
			<td>
			<input type="text" name="nextfudate" id="nextfudate"  readonly="true">
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
