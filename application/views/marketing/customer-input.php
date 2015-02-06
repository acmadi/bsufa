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
                        //$('#group').attr('readonly',true);
            });

function loadData(type,parentId){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('customer/loaddata')?>',
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
		loadData('group',0); 
		$('#tipeindividu').text('');
		});
	$('#individual').change(function(){
		loadData('tipeindividu',0);
		$('#group').text('');
		
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


<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css" />
<form method='post' action='<?=site_url()?>customer/InsertCustomer' id='formadd'>
<table border="0" cellpadding="2" cellspacing="2">
	
  
    <!--Customer Profile-->
    <tr>
		<td colspan="3" style=""><b>Customer Profile</b></td>
    </tr>
    <tr>
		<td>Cst.Type</td>
		<td>:</td>
		<td>
			<input type="radio" name="idfilter"  id='individual' value="1"/> Individual
			<input type="radio" name="idfilter"  id='company' value="2"/> Corporate
		</td>	
		
    </tr>
	<tr>
		
		<td >Individual.Type</td>
		<td>:</td>
		<td><select name="idgroup" id="tipeindividu" class="xinput ">
			<!--<option>&nbsp;</option>
				<option>Keluarga Bak<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>rie</option>
				<option>Kerabat Bakrie</option>
				<option>Non Keluarga/Kerabat Bakrie</option>--></select>
			</td>
		<td style="padding:0 0 0 80">Corporate.Type</td>
		<td>:</td>
		<td>
			<select name="idgroup" id="group" class="xinput"></select>
		</td>
	</tr>
	<tr>
		<td colspan='6'>&nbsp;</td>
		
	</tr>
	
	<tr>
		<td>Name</td>
		<td>:</td>
		<td><input type="text" name="customernama" id="nama" class="xinput validate[required]" ></td>
		<td style="padding:0 0 0 80">No.Fax</td>
		<td>:</td>
		<td><input type="text" name="customerfax" id="customerfax" class="xinput calculate" ></td>
	</tr>
	<tr>
		<td>Date of Birth</td>
		<td>:</td>
		<td>
			<input type="text" name="customertgllhr" id="tgl_lahir" class="xinput validate[required]" readonly="true">
			<a href="JavaScript:;" onClick="return showCalendar('tgl_lahir', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
		
		</td>
		<td style="padding:0 0 0 80">Id.Type</td>
		<td>:</td>
		<td><select name="idtipe" id="idtipe" class="xinput validate[required]">
				<option value=""></option>
				<option>KITAS</option>
				<option>KTP</option>
				<option>Passport</option>
				<option>SIM</option>
				
			</select></td>
	</tr>
	<tr>
		<td>Place of Birth</td>
		<td>:</td>
		<td>
			<select name="customertmptlhr" id="tmplhr" class="xinput validate[required]"></select>
		</td>
		<td style="padding:0 0 0 80">Id.Number</td>
		<td>:</td>
		<td><input type="text" name="idno" id="id_number" class="xinput calculate validate[required]"></td>

	</tr>
	<tr>
		<td>Religion</td>
		<td>:</td>
		<td>
			<select name="idagama" id="agama"  class="xinput validate[required]"></select>
		</td>
		<td style="padding:0 0 0 80">NPWP</td>
		<td>:</td>
		<td><input type="text" name="npwp" id="id_number" class="xinput calculate" ></td>
	</tr>
	
	<tr>
		<td>Sex</td>
		<td>:</td>
		<td>
			<input type="radio" name="idkarysek" value="1"/>Male
			<input type="radio" name="idkarysek" value="2"/>Female
		</td>
		<td style="padding:0 0 0 80">Email</td>
		<td>:</td>
		<td><input type="text" name="email" id='email' class="validate[required,custom[email]]"></td>		
	</tr>
	</tr>
	<tr>
		<td>Marital Status</td>
		<td>:</td>
		<td>
			<select name="customerstatus"  id="customerstatus" class="xinput validate[required]">
				<option value=""></option>
				<option>Menikah</option>
				<option>Pernah Menikah</option>
				<option>Belum Menikah</option>
			</select>
		</td>
		<td style="padding:0 0 0 80">Media Type</td>
		<td>:</td>
		<td>
			<select name="idtipemedia" id="tipemedia" class="xinput validate[required]">
			</select>
		</td>
	</tr>
	<tr>
		<td >Occupation</td>
		<td>:</td>
		<td>
			<select name="idprofesi"  id='profesi' class="xinput validate[required]">
			</select>
		</td>
		<td style="padding:0 0 0 80">Media Source</td>
		<td>:</td>
		<td>
			<select name="idmedia" id="media" class="xinput validate[required]">
			</select>
		</td>
	<tr>
		<td>Handphone</td>
		<td>:</td>
		<td><input type="text" name="customerhp" id="hp" class="xinput calculate validate[custom[phone],required]"></td>
		<td style="padding:0 0 0 80" >Motivies</td>
		<td>:</td>
		<td>
			<select name="idmotivie" id="motivie" class="xinput validate[required]">
			</select>
		</td>
		
	</tr>
	
	
	<tr>
		<td>Telephone</td>
		<td>:</td>
		<td><input type="text" name="customertlp" id="tlp" class="xinput calculate"></td>
		<td style="padding:0 0 0 80" >Etnis</td>
		<td>:</td>
		<td>
			<select name="idetnis" id="etnis" class="xinput validate[required]">
			</select>
		</td>
	</tr>

	
	<tr>
	
		<td >Address </td>
		<td>:</td>
		<td>
			<textarea name="customeralamat1" id="customeralamat1" class="xinput validate[required]">
			</textarea>
		</td>
		
		<td style="padding:0 0 0 80"> Mailing Address </td>
		<td>:</td>
		<td>
			<textarea name="customeralamat2" id="customeralamat2" class="xinput validate[required]">
			</textarea>
		</td>
	</tr>	
	<tr>
		<td>Country</td>
		<td>:</td>
		<td>
			<select name="idnegara" class="xinput validate[required]"id='negara'>
			</select>
		</td>
		<td style="padding:0 0 0 80">Mailing Country</td>
		<td>:</td>
		<td>
			<select name="idnegara1" class="xinput validate[required]" id='negara1'>
			</select>
		</td>
		
	</tr>
		
	<tr>
		<td>Province</td>
		<td>:</td>
		<td>
			<select name="idpropinsi" class="xinput validate[required]" id='propinsi'>
			</select>
		</td>
		<td style="padding:0 0 0 80" >Mailing Province</td>
		<td>:</td>
		<td>
			<select name="idpropinsi1" class="xinput validate[required]" id='propinsi1'>
			</select>
		</td>
	</tr>
	
	<tr>
		<td>City</td>
		<td>:</td>
		<td>
			<select name="idkota" class="xinput validate[required]" id='kota'>
			</select>
		</td>
		<td style="padding:0 0 0 80" >Mailing City</td>
		<td>:</td>
		<td>
			<select name="idkota1" class="xinput validate[required]" id='kota1'>
			</select>
		</td>
		
	</tr>
	<tr>
		<td>PostCode</td>
		<td>:</td>
		<td>
			<input name="kdpos" id='' class="xinput calculate">
			
		</td>
		<td style="padding:0 0 0 80" >Mailing PostCode</td>
		<td>:</td>
		<td>
			<input name="kdpos1" class="xinput calculate" id=''>
			
		</td>
		
	</tr>
	
	<tr>
		<td>FaceBook</td>
		<td>:</td>
		<td>
			<input name="fb" id='fb'  class="xinput validate[custom[email]]">
			
		</td>
		<td style="padding:0 0 0 80" >Twitter</td>
		<td>:</td>
		<td>
			<input name="twiter" id='twiter' class="xinput validate[custom[email]]">
			
		</td>
		
	</tr>
	<!-- End-->
	
	<!--Job Description-->
	<tr><td colspan="3" style="padding:20 0 0 0;border-bottom:solid"><b>Customer Company </b></td></tr>
	
	<tr>
		<td>Company Name</td>
		<td>:</td>
		<td><input type="text" name="custcompnm" id=""/></td>
		<td style="padding:0 0 0 80" >Telephone</td>
		<td>:</td>
		<td><input type="text" name='custcomphp' id='tlpbis' ></td>
	</tr>
	<tr>
		<td>Type Of Business</td>
		<td>:</td>
		<td>
			<select name="idbisnis" class="xinput" id='bisnis'></select>
		</td>
		<td style="padding:0 0 0 80" >No.Fax</td>
		<td>:</td>
		<td><input type="text" name='custcompfax' id='faxbis'></td>
	</tr>
	<tr>
		<td>Address</td>
		<td>:</td>
		<td>
			<textarea name="custcompalamat" class="xinput">
			</textarea>
		</td>
		<td style="padding:0 0 0 80">NPWP</td>
		<td>:</td>
		<td><input type="text" name="custcompnpwp" id="npwpbis" ></td>
	</tr>
	<!--End-->
	
	
	
	
	
	
	
	<tr><td width="150" colspan="3"></td></tr>
	<tr>
		<td colspan="3">
			<input type="submit" name="save" value="Save"/>
			<input type="reset" name="cancel" value="Cancel"/>
		</td>
	</tr>	
</table>
</form>
