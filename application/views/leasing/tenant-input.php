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
$(document).ready(function(){
                        $('#tr1').hide();
                        $('#tr2').hide();
                        $('#tr3').hide();
                        $('#tr4').hide();
                        $('#tr5').hide();
                        $('#tr6').hide();
                        $('#tr7').hide();
                        $('#tr8').hide();
                        $('#tr9').hide();
                        $('#tr10').hide();
                        $('#tr11').hide();
                        $('#tr12').hide();
                        $('#tr13').hide();
                        $('#tr14').hide();
                        
                        
                        
            });

function loadData(type,parentId){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('tenant/loaddata')?>',
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


	
	//~ loadData('agama',0);
	//~ loadData('hubungan',0);
	//~ loadData('motivie',0); 
	//~ loadData('negara',0);
	//~ loadData('profesi',0);
	//~ loadData('tmplhr',0);
	//~ loadData('tipemedia',0);
	//~ loadData('bisnis',0);
	//~ loadData('etnis',0);
	//~ loadData('negara1',0);

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
	
	
		
	/*event hide form*/
	$('#company').change(function(){
		
           /*kosongkan field*/		
			//~ $('#group').text('');
			$('#group').text('');
			$('#pic').val('');
			$('#tradename').val('');
			$('#tlp').val('');
			$('#npwp ').val('');
			$('#nama ').val('');
			$('#negara ').text('');
			$('#fax ').val('');
			$('#tgllahir ').val(''); 
			$('#propinsi ').text(''); 
			$('#idtipe ').text(''); 
			$('#tmplhr ').text(''); 
			$('#kota').text(''); 
			$('#idno').val(''); 
			$('#agama').text(''); 
			$('#kdpos').val(''); 
			$('#etnis ').text(''); 
			$('#sek ').val(''); 
			$('#fb ').val('');
			$('#email ').val('');
			$('#customerstatus ').text('');
			$('#tipemedia ').text('');
			$('#twiter ').val('');
			$('#profesi ').text('');
			$('#media ').text('');
			$('#motivie').text('');
			$('#hp').val('');
			$('#alamat1').val('');
			$('#alamat2').val('');
			$('#alamatnpwp').val('');
			
				loadData('group2',0); 
				loadData('agama',0);
				loadData('hubungan',0);
				loadData('motivie',0); 
				loadData('negara',0);
				loadData('profesi',0);
				loadData('tmplhr',0);
				loadData('tipemedia',0);
				loadData('bisnis',0);
				loadData('etnis',0);
				loadData('negara1',0);
				loadData('customerstatus',0);
				loadData('idtipe',0);
				


		
		$('#tr1').hide();
		$('#tr2').show();
		
		$('#tr3').show();
        $('#tr4').hide();
        $('#tr5').hide();
        $('#tr6').hide();
        $('#tr7').hide();
        $('#tr8').hide();
        $('#tr9').hide();
        $('#tr10').show();
        $('#tr11').show();
        $('#tr12').show();
        $('#tr13').show();
        $('#tr14').show();
        
        
		
		
		
		});
	$('#individual').change(function(){
		
			/*kosongkan field*/
				//~ $('#tipeindividu').text('');
				$('#group').text('');
				$('#group2').text('');
				$('#pic').val('');
				$('#tradename').val('');
				$('#tlp').val('');
				$('#npwp ').val('');
				$('#nama ').val('');
				$('#negara ').text('');
				$('#fax ').val('');
				$('#tgllahir ').val(''); 
				$('#propinsi ').text(''); 
				$('#idtipe ').text(''); 
				$('#tmplhr ').text(''); 
				$('#kota').text(''); 
				$('#idno').val(''); 
				$('#agama').text(''); 
				$('#kdpos').val(''); 
				$('#etnis ').text(''); 
				$('#sek ').val(''); 
				$('#fb ').val('');
				$('#email ').val('');
				$('#customerstatus ').text('');
				$('#tipemedia ').text('');
				$('#twiter ').val('');
				$('#profesi ').text('');
				$('#media ').text('');
				$('#motivie').text('');
				$('#hp').val('');
				$('#alamat1').val('');
				$('#alamat2').val('');
				$('#alamatnpwp').val('');
		
					loadData('agama',0);
					loadData('hubungan',0);
					loadData('motivie',0); 
					loadData('negara',0);
					loadData('profesi',0);
					loadData('tmplhr',0);
					loadData('tipemedia',0);
					loadData('bisnis',0);
					loadData('etnis',0);
					loadData('negara1',0);
					loadData('customerstatus',0);
					loadData('idtipe',0);
					loadData('group',0);

		
		$('#tr1').show();
		$('#tr2').hide();
		
        $('#tr3').show();
        $('#tr4').show();
        $('#tr5').show();
        $('#tr6').show();
        $('#tr7').show();
        $('#tr8').show();
        $('#tr9').show();
        $('#tr10').show();
        $('#tr11').show();
        $('#tr12').show();
        $('#tr13').show();
		$('#tr14').show();
		
		});


	/*fungsi validasi numeric*/
	  $('.calculate').bind('keyup keypress',function(){
			$(this).val($(this).val());
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
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css" />
-->
<form method='post' action='<?=site_url()?>tenant/InsertTenant' id='formadd'>
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
		<td><select name="group" id="group" class="xinput " style='width:150' ></td>
		
			
		
	</tr>
	<tr id='tr2'>
		<td>Corporate.Type</td>
		<td>:</td>
		<td><select name="group" id="group2" class="xinput" style='width:150'></select></td>
		
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
			<td><input type="text" name="tlp" id="tlp" class="calculate" style='width:150'> </td>
			
				<td >NPWP</td>
				<td>:</td>
				<td><input type="text" name="npwp" id="npwp" class="xinput calculate" ></td>
	</tr>
	<tr id='tr3'>
		<td>Name</td>
		<td>:</td>
		<td><input type="text" name="nama" id="nama" class="xinput validate[required]" ></td>

			<td>Country</td>
			<td>:</td>
			<td>
				<select name="negara" class="xinput validate[required]"id='negara' style='width:150'>
				</select>
			</td>
		
				<td >No.Fax</td>
				<td>:</td>
				<td><input type="text" name="fax" id="fax" class="xinput calculate" ></td>
	</tr>
	<tr id='tr4'>
		<td>Date of Birth</td>
		<td>:</td>
		<td>
			<input type="text" name="tgllahir" id="tgllahir" class="validate[required]" readonly="true" style='width:80;background-color:#C0C0C0'>
			<a href="JavaScript:;" onClick="return showCalendar('tgllahir', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
		
		</td>
			<td>Province</td>
			<td>:</td>
			<td><select name="propinsi" class="xinput validate[required]" id='propinsi' style='width:150'></select></td>
		
				<td>Id.Type</td>
				<td>:</td>
				<td><select name="idtipe" id="idtipe" class="xinput validate[required]">
						
						
					</select></td>
	</tr>
	<tr id='tr5'>
		<td>Place of Birth</td>
		<td>:</td>
		<td>
			<select name="tmplhr" id="tmplhr" class="validate[required]" style='width:150'></select>
		</td>
		
		<td>City</td>
		<td>:</td>
		<td>
			<select name="kota" class="xinput validate[required]" id='kota' style='width:150'>
			</select>
		</td>
		<td >Id.Number</td>
		<td>:</td>
		<td><input type="text" name="idno" id="idno" class="xinput calculate validate[required]"></td>

	</tr>
	<tr id='tr6'>
		<td>Religion</td>
		<td>:</td>
		<td>
			<select name="agama" id="agama"  class="validate[required]" style='width:80'></select>
		</td>
		<td>PostCode</td>
		<td>:</td>
		<td>
			<input name="kdpos" id='kdpos' class="xinput calculate">
			
		</td>
		
				<td>Etnis</td>
				<td>:</td>
				<td><select name="etnis" id="etnis" class="xinput validate[required]" style='width:150'></select>	</td>
		
	</tr>
	
	<tr id='tr7'>
		<td>Sex</td>
		<td>:</td>
		<td>
			<input type="radio" name="sek" id="sek" value="1"/>Male
			<input type="radio" name="sek" id="sek" value="2"/>Female
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
				
				
			</select>
		</td>
			<td >Media Type</td>
			<td>:</td>
			<td>
				<select name="tipemedia" id="tipemedia" class="xinput validate[required]" style='width:150'>
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
			<select name="profesi"  id='profesi' class="validate[required]" style='width:150'>
			</select>
		</td>
		<td >Media Source</td>
		<td>:</td>
		<td>
			<select name="media" id="media" class="xinput validate[required]">
			</select>
		</td>
		
			<td>Motivies</td>
			<td>:</td>
			<td>
				<select name="motivie" id="motivie" class="xinput validate[required]" style='width:150'>
				</select>
			</td>
	<tr id='tr10'>
		<td>Handphone</td>
		<td>:</td>
		<td><input type="text" name="hp" id="hp" class="calculate validate[custom[phone],required]" style='width:150'></td>
			
		
	</tr>
	
	
	

	<tr id='tr12'>
		<td colspan='3'><u>Address</u> </td>
		<td colspan='3'><u>Mailing Address</u> </td>
		<td colspan='3'><u>NPWP Address</u> </td>
	</tr>
	<tr id='tr13'>
	
		<td colspan='3'>
			<textarea name="alamat1" id="alamat1" class="validate[required]" style='width:250;background-color:#80FF80' >
			</textarea>
		</td>
		
		
		<td colspan='3'>
			<textarea name="alamat2" id="alamat2" class="xinput validate[required]" style='width:250;background-color:#FFFF00'>
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
