<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuku.css" type="text/css" />


<? #tampilkan query?>
<script language="javascript">
$(function(){
	/*fungsi validasi numeric*/
	  $('.calculate').bind('keyup keypress',function(){
			$(this).val($(this).val());
		  }).numeric();
		  
	//FUNGSI LOAD DATA
	function loadData(type,parentId){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('customer/loaddata')?>',
		{data_type: type, parent_id: parentId},
		function(data){
		 
		   if(data.error == undefined){ 
			 $('#'+type).empty();
			 $('#'+type).append('<option></option>');
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

	
	
//FUNGSI JQUERY DOCUEMENT	/*fungsi validasi numeric*/
	  $('.calculate').bind('keyup keypress',function(){
			$(this).val($(this).val());
		  }).numeric();
$(document).ready(function(){
	
		if($('input:radio[name=idfilter]:checked').val() == '1' ){
				$('#corporate').attr('disabled',true);
				$('#corporate').text('');
				
		}
		else{
				$('#individu').attr('disabled',true);
				$('#individu').text('');
			}
	
	})
	//FUNGSI RADIO BUTTON
		$('input[name=idfilter]').change(function(){
		
			if($('input:radio[name=idfilter]:checked').val() == '1' ){
				
					$('#corporate').attr('disabled',true);
					$('#individu').attr('disabled',false);
					loadData('individu',0)
				
				}
				else{
					$('#individu').attr('disabled',true);
					$('#corporate').attr('disabled',false);
					$('#individu').text('');
					loadData('corporate',0)
				}
		});
	
	
	/*DropDown Menu*/
	$('#negara').change(function(){
			loadData('propinsi',$('#negara option:selected').val());
		});
	$('#propinsi').change(function(){
			loadData('kota',$('#propinsi option:selected').val());
		});
	$('#tipemedia').change(function(){
			loadData('media',$('#tipemedia option:selected').val());
		});
	
	$('#negara1').change(function(){
			loadData('propinsi1',$('#negara1 option:selected').val());
		});
	$('#propinsi1').change(function(){
			loadData('kota1',$('#propinsi1 option:selected').val());
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
	
	
	
});
	
	
	
	
	
</script>
	
	


<!--
<link rel="stylesheet" href="<?#=base_url()?>assets/css/menuform.css" type="text/css" />
-->
<form method='post' action='<?=site_url()?>customer/UpdateCustomer' id='formadd'>
<table border="0" cellpadding="2" cellspacing="2">
	
  
    <!--Customer Profile-->
    <tr>
		<td colspan="3" style=""><font color='#FF0000'><b><u>ENTRY TENANT</u></b></font></td>
    </tr>
    <tr>
		<td>Cst.Type</td>
		<td>:</td>
		<td>
			<input type="radio" name="idfilter"  id='individual' value="1"/> Individual
			<input type="radio" name="idfilter"  id='company' value="2"/> Corporate
		</td>	
		
    </tr>
	<tr id='tr1'>
		
		<td >Individual.Type</td>
		<td>:</td>
		<td><select name="idgroup" id="tipeindividu" class="xinput " style='width:150' ></td>
		
			
		
	</tr>
	<tr id='tr2'>
		<td>Corporate.Type</td>
		<td>:</td>
		<td><select name="idgroup" id="group" class="xinput" style='width:150'></select></td>
		
			<td>P I C</td>
			<td>:</td>
			<td><input type="text" name="pic" id="pic"  style='width:150'> </td>
			
	</tr>
	<tr id='tr11'>
		<td >Trade Name</td>
		<td>:</td>
		<td><input name="tradename" id="tradename" class="xinput " style='width:150' ></td>
		
			<td>Telephone</td>
			<td>:</td>
			<td><input type="text" name="customertlp" id="tlp" class="calculate" style='width:150'> </td>
			
				<td >NPWP</td>
				<td>:</td>
				<td><input type="text" name="npwp" id="id_number" class="xinput calculate" ></td>
	</tr>
	<tr id='tr3'>
		<td>Name</td>
		<td>:</td>
		<td><input type="text" name="customernama" id="nama" class="xinput validate[required]" ></td>

			<td>Country</td>
			<td>:</td>
			<td>
				<select name="idnegara" class="xinput validate[required]"id='negara' style='width:150'>
				</select>
			</td>
		
				<td >No.Fax</td>
				<td>:</td>
				<td><input type="text" name="customerfax" id="customerfax" class="xinput calculate" ></td>
	</tr>
	<tr id='tr4'>
		<td>Date of Birth</td>
		<td>:</td>
		<td>
			<input type="text" name="customertgllhr" id="tgl_lahir" class="validate[required]" readonly="true" style='width:80;background-color:#C0C0C0'>
			<a href="JavaScript:;" onClick="return showCalendar('tgl_lahir', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
		
		</td>
			<td>Province</td>
			<td>:</td>
			<td><select name="idpropinsi" class="xinput validate[required]" id='propinsi' style='width:150'></select></td>
		
				<td>Id.Type</td>
				<td>:</td>
				<td><select name="idtipe" id="idtipe" class="xinput validate[required]">
						<option value=""></option>
						<option>KITAS</option>
						<option>KTP</option>
						<option>Passport</option>
						<option>SIM</option>
						
					</select></td>
	</tr>
	<tr id='tr5'>
		<td>Place of Birth</td>
		<td>:</td>
		<td>
			<select name="customertmptlhr" id="tmplhr" class="validate[required]" style='width:150'></select>
		</td>
		
		<td>City</td>
		<td>:</td>
		<td>
			<select name="idkota" class="xinput validate[required]" id='kota' style='width:150'>
			</select>
		</td>
		<td >Id.Number</td>
		<td>:</td>
		<td><input type="text" name="idno" id="id_number" class="xinput calculate validate[required]"></td>

	</tr>
	<tr id='tr6'>
		<td>Religion</td>
		<td>:</td>
		<td>
			<select name="idagama" id="agama"  class="validate[required]" style='width:80'></select>
		</td>
		<td>PostCode</td>
		<td>:</td>
		<td>
			<input name="kdpos" id='' class="xinput calculate">
			
		</td>
		
				<td  >Etnis</td>
				<td>:</td>
				<td><select name="idetnis" id="etnis" class="xinput validate[required]" style='width:150'></select>	</td>
		
	</tr>
	
	<tr id='tr7'>
		<td>Sex</td>
		<td>:</td>
		<td>
			<input type="radio" name="idkarysek" value="1"/>Male
			<input type="radio" name="idkarysek" value="2"/>Female
		</td>
			<td>FaceBook</td>
			<td>:</td>
			<td>
				<input name="fb" id='fb'  class="xinput validate[custom[email]]">
				
			</td>
				<td >Email</td>
				<td>:</td>
				<td><input type="text" name="email" id='email' class="validate[required,custom[email]]"></td>		
	</tr>
	
	<tr id='tr8'>
		<td>Marital Status</td>
		<td>:</td>
		<td>
			<select name="customerstatus"  id="customerstatus" class="validate[required]" style='width:150'>
				<option value=""></option>
				<option>Menikah</option>
				<option>Pernah Menikah</option>
				<option>Belum Menikah</option>
			</select>
		</td>
			<td >Media Type</td>
			<td>:</td>
			<td>
				<select name="idtipemedia" id="tipemedia" class="xinput validate[required]" style='width:150'>
				</select>
			</td>
				<td >Twitter</td>
				<td>:</td>
				<td>
					<input name="twiter" id='twiter' class="xinput validate[custom[email]]">
					
				</td>
	</tr>
	<tr id='tr9'>
		<td >Occupation</td>
		<td>:</td>
		<td>
			<select name="idprofesi"  id='profesi' class="validate[required]" style='width:150'>
			</select>
		</td>
		<td >Media Source</td>
		<td>:</td>
		<td>
			<select name="idmedia" id="media" class="xinput validate[required]">
			</select>
		</td>
		
			<td>Motivies</td>
			<td>:</td>
			<td>
				<select name="idmotivie" id="motivie" class="xinput validate[required]" style='width:150'>
				</select>
			</td>
	<tr id='tr10'>
		<td>Handphone</td>
		<td>:</td>
		<td><input type="text" name="customerhp" id="hp" class="calculate validate[custom[phone],required]" style='width:150'></td>
			
		
	</tr>
	
	
	

	<tr id='tr12'>
		<td colspan='3'><u>Address</u> </td>
		<td colspan='3'><u>Mailing Address</u> </td>
		<td colspan='3'><u>NPWP Address</u> </td>
	</tr>
	<tr id='tr13'>
	
		<td colspan='3'>
			<textarea name="customeralamat1" id="customeralamat1" class="validate[required]" style='width:250;background-color:#80FF80' >
			</textarea>
		</td>
		
		
		<td colspan='3'>
			<textarea name="customeralamat2" id="customeralamat2" class="xinput validate[required]" style='width:250;background-color:#FFFF00'>
			</textarea>
		</td>
		
		<td colspan='3'>
			<textarea name="alamatnpwp" id="alamatnpwp" class="xinput validate[required]" style='width:250;background-color:#0080FF'>
			</textarea>
		</td>
	</tr>	
	
	

	<tr id='tr14'>
		<td colspan="3">
			<input type="submit" name="save" value="Save"/>
			<input type="reset" name="cancel" value="Cancel"/>
		</td>
	</tr>	
</table>
</form>
