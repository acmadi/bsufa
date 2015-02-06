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
	
	


<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css" />
<form method='post' action='<?=site_url()?>customer/UpdateCustomer' id='formadd'>
<table border="0" cellpadding="2" cellspacing="2">
<input value="<?=@$data->customer_id?>" name="id" type="hidden">
    <!--Customer Profile-->
    <tr>
		<td colspan="3" style="border-bottom:solid"><b>Customer Profile</b></td>
    </tr>
    <tr>
		<td>Cst.Type</td>
		<td>:</td>
		<td><? if($data->id_filter == 1){?>
			<input type="radio" name="idfilter"  id='individual' value="1" checked> Individual
			<input type="radio" name="idfilter"  id='company' value="2"/> Corporate
		<?} else if ($data->id_filter == 2){?>
			<input type="radio" name="idfilter"  id='individual' value="1"/> Individual
			<input type="radio" name="idfilter"  id='company' value="2" checked> Corporate
		<? } ?>
		</td>	
		
    </tr>
	<tr>
		
		<td >Individual.Type</td>
		<td>:</td>
		<td><select name="idgroup" id="individu" class="xinput " value="<?=@$cust['nm_group']?>">
				<option value="<?=@$cust['group_id'] ?>" selected><?=@$cust['nm_group']?> </option>
					<? foreach($individu as $row): ?>
						<option value="<?=@$row->group_id?>"><?=@$row->nm_group?></option> 
					<? endforeach;?>
			</select>
			</td>
		<td style="padding:0 0 0 80">Corporate.Type</td>
		<td>:</td>
		<td>
			<select name="idgroup" id="corporate" class="xinput " value="<?=@$cust['nm_group']?>">
				<option value="<?=@$cust['group_id'] ?>" selected><?=@$cust['nm_group']?> </option>
				<? foreach($corporate as $row): ?>
						<option value="<?=@$row->group_id?>"><?=@$row->nm_group?></option> 
					<? endforeach;?>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan='6'>&nbsp;</td>
		
	</tr>
	
	<tr>
		<td>Name</td>
		<td>:</td>
		<td><input value="<?=@$data->customer_nama?>"text" name="customernama" id="nama" ></td>
		<td style="padding:0 0 0 80">No.Fax</td>
		<td>:</td>
		<td><input value="<?=@$data->customer_fax?>" type="text" name="customerfax" id="customerfax" class="xinput calculate" ></td>
	</tr>
	<tr>
		<td>Date of Birth</td>
		<td>:</td>
		<td>
			<input value="<?=indo_date(@$data->customer_tgl_lhr)?>"type="text" name="customertgllhr" id="tgl_lahir" class="xinput"/ readonly="true">
			<a href="JavaScript:;" onClick="return showCalendar('tgl_lahir', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
		
		</td>
		<td style="padding:0 0 0 80">Id.Type</td>
		<td>:</td>
		<td><select name="idtipe" class="xinput">
				<option selected><?=$cust['id_tipe']?></option>
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
			<select name="customertmptlhr"  id="tmplhr" class="xinput">
				<option value="<?=$cust['kota_id']?>" selected><?=@$cust['kota_nm'];?></option>
					<? foreach($kota as $row): ?>
						<option value="<?=@$row->kota_id?>"><?=@$row->kota_nm?></option> 
					<? endforeach;?>
			</select>
		</td>
		<td style="padding:0 0 0 80">Id.Number</td>
		<td>:</td>
		<td><input type="text"  name="idno" value="<?=@$data->id_no?>"id="id_number" class="xinput calculate validate[required]">
		
		</td>

	</tr>
	<tr>
		<td>Religion</td>
		<td>:</td>
		<td>
			<select name="idagama" id="agama" class="xinput">
			<option value="<?=@$cust['agama_id']?>" selected><?=@$cust['agama_nm'];?></option>
		<? foreach($agama as $row): ?><option value="<?=@$row->agama_id?>"><?=@$row->agama_nm?></option><? endforeach; ?>
			</select>
		</td>
		<td style="padding:0 0 0 80">NPWP</td>
		<td>:</td>
		<td><input   type="text" name="npwp" value="<?=$data->npwp?>" id="id_number" class="xinput calculate validate[required]"></td>
	</tr>
	
	<tr>
		<td>Sex</td>
		<td>:</td>
		<td>
			<? 
			if($data->id_karysek == '1')
			{?> <input type="radio" name="idkarysek" value="1" checked>Male
				<input type="radio" name="idkarysek" value="2" >Female <?}
			else if ($data->id_karysek == '2')
			
			{?> <input type="radio" name="idkarysek" value="1" >Male
				<input type="radio" name="idkarysek" value="2" checked>Female 
			<?}?>
			
			
		</td>
		<td style="padding:0 0 0 80">Email</td>
		<td>:</td>
		<td><input type="text" name="email" value="<?=$data->email?>" id='email' class="validate[required,custom[email]]"></td>		
	</tr>
	</tr>
	<tr>
		<td>Marital Status</td>
		<td>:</td>
		<td>
			<select name="customerstatus" class="xinput">
				<option selected><?=@$cust['customer_status']?></option>
				<option>Menikah</option>
				<option>Pernah Menikah</option>
				<option>Belum Menikah</option>
			</select>
		</td>
		<td style="padding:0 0 0 80">Media Type</td>
		<td>:</td>
		<td>
			<select name="idtipemedia" id="tipemedia" class="xinput">
			<option value="<?=@$cust['tipemedia_id']?>" selected><?=@$cust['tipemedia_nm']?></option>
			<? foreach ($tipemedia as $row):?>
			<option value="<?=@$row->tipemedia_id?>"><?=@$row->tipemedia_nm?></option>
			<? endforeach ?>
			</select>
		</td>
	</tr>
	<tr>
		<td >Occupation</td>
		<td>:</td>
		<td>
			<select name="idprofesi"  id='profesi' class="xinput">
			<option value="<?=@$cust['profesi_id']?>" selected><?=@$cust['profesi_nm']?></option>
			<? foreach ($profesi as $row):?>
			<option value="<?=@$row->profesi_id?>"><?=@$row->profesi_nm?></option>
			<? endforeach ?>
			</select>
		</td>
		<td style="padding:0 0 0 80">Media Source</td>
		<td>:</td>
		<td>
			<select name="idmedia" id="media" class="xinput">
			<option value="<?=@$cust['media_id']?>" selecteed><?=@$cust['media_nm']?></option>
			<? foreach ($media as $row):?>
			<option value="<?=@$row->media_id?>"><?=@$row->media_nm?></option>
			<? endforeach ?>
			</select>
		</td>
	<tr>
		<td>Handphone</td>
		<td>:</td>
		<td><input value="<?=@$data->customer_hp?>"  name="customerhp" id="hp" class="xinput calculate validate[custom[phone],required]"></td>
		<td style="padding:0 0 0 80" >Motivies</td>
		<td>:</td>
		<td>
			<select name="idmotivie" id="motivie" class="xinput">
			<option value="<?=@$cust['motivie_id']?>" selected><?=@$cust['motivie_nm']?></option>
			<? foreach ($motivie as $row):?>
			<option value="<?=@$row->motivie_id?>"><?=@$row->motivie_nm?></option>
			<? endforeach ?>
			</select>
		</td>
		
	</tr>
	
	
	<tr>
		<td>Telephone</td>
		<td>:</td>
		<td><input value="<?=@$data->customer_tlp?>" name="customertlp" id="tlp" class="xinput calculate"></td>
		<td style="padding:0 0 0 80" >Etnis</td>
		<td>:</td>
		<td>
			<select name="idetnis" id="etnis" class="xinput">
				<option value="<?=@$cust['etnis_id']?>" selected><?=@$cust['etnis_nm']?></option>
					<? foreach ($etnis as $row):?>
						<option value="<?=@$row->etnis_id?>"><?=@$row->etnis_nm?></option>
					<? endforeach ?>
			</select>
		</td>
	</tr>

	
	<tr>
	
		<td >Address </td>
		<td>:</td>
		<td>
			<textarea  name="customeralamat1" class="xinput"  ><?=@$data->customer_alamat1?></textarea>
		</td>
		
		<td style="padding:0 0 0 80"> Mailing Address </td>
		<td>:</td>
		<td>
			<textarea name="customeralamat2" class="xinput"><?=$data->customer_alamat2?>
			</textarea>
		</td>
	</tr>	
	<tr>
		<td>Country</td>
		<td>:</td>
		<td>
			<select name="idnegara"class="xinput" id='negara'>
				<option value="<?=@$cust['negara_id']?>" selected><?=@$cust['negara_nm']?></option>
					<? foreach ($negara as $row):?>
						<option value="<?=@$row->negara_id?>"><?=@$row->negara_nm?></option>
					<? endforeach ?>
				
			</select>
		</td>
		<td style="padding:0 0 0 80">Mailing Country</td>
		<td>:</td>
		<td>
			<select name="idnegara1"class="xinput" id='negara1'>
				<option value="<?=@$add->negara_id?>" selected><?=@$add->negara_nm?></option>
					
			</select>
		</td>
		
	</tr>
		
	<tr>
		<td>Province</td>
		<td>:</td>
		<td>
			<select name="idpropinsi"class="xinput" id='propinsi'>
				<option value="<?=@$cust['propinsi_id']?>" selected><?=@$cust['propinsi_nm']?></option>
				<? foreach ($propinsi as $row):?>
						<option value="<?=@$row->propinsi_id?>"><?=@$row->propinsi_nm?></option>
					<? endforeach ?>				
			</select>
		</td>
		<td style="padding:0 0 0 80" >Mailing Province</td>
		<td>:</td>
		<td>
			<select name="idpropinsi1"class="xinput" id='propinsi1'>
				<option value="<?=@$add->propinsi_id?>" selected><?=@$add->propinsi_nm?></option>
				<? foreach ($propinsi as $row):?>
						<option value="<?=@$row->propinsi_id?>"><?=@$row->propinsi_nm?></option>
					<? endforeach ?>
			</select>
		</td>
	</tr>
	
	<tr>
		<td>City</td>
		<td>:</td>
		<td>
			<select name="idkota"class="xinput" id='kota'>
					<option value="<?=@$cust['kota_id']?>" selected><?=@$cust['kota_nm']?></option>
						<? foreach ($kota as $row):?>
							<option value="<?=@$row->kota_id?>"><?=@$row->kota_nm?></option>
						<? endforeach ?>
			</select>
		</td>
		<td style="padding:0 0 0 80" >Mailing City</td>
		<td>:</td>
		<td>
			<select name="idkota1"class="xinput" id='kota1'>
				<option value="<?=@$add->kota_id?>" selected><?=@$add->kota_nm?></option>
					<? foreach ($kota as $row):?>
							<option value="<?=@$row->kota_id?>"><?=@$row->kota_nm?></option>
						<? endforeach ?>
			
			</select>
		</td>
		
	</tr>
	<tr>
		<td>PostCode</td>
		<td>:</td>
		<td>
			<input name="kdpos" id='' value="<?=$data->kdpos?>" class="xinput calculate">
			
		</td>
		<td style="padding:0 0 0 80" >Mailing PostCode</td>
		<td>:</td>
		<td>
			<input name="kdpos1" value="<?=$data->kdpos1?>"class="xinput calculate" id=''>
			
		</td>
		
	</tr>
	<tr>
		<td>Facebook</td>
		<td>:</td>
		<td>
			<input name="fb" id='fb' value="<?=$data->fb?>" class="xinput calculate" >
			
		</td>
		<td style="padding:0 0 0 80" >Twiter</td>
		<td>:</td>
		<td>
			<input name="twiter" value="<?=$data->twiter?>"class="xinput calculate" id='twiter'>
			
		</td>
		
	</tr>
	<!-- End-->
	
	<!--Job Description-->
	<tr><td colspan="3" style="padding:20 0 0 0;border-bottom:solid"><b>Customer Company </b></td></tr>
	<tr>
		<td>Company Name</td>
		<td>:</td>
		<td><input type="text" name="custcompnm" id="" value="<?=$data->custcomp_nm?>"></td>
		<td style="padding:0 0 0 80" >Telephone</td>
		<td>:</td>
		<td><input type="text" value="<?=$data->custcomp_hp?>" name='custcomphp' id='tlpbis' class="xinput calculate"></td>
	</tr>
	<tr>
		<td>Type Of Business</td>
		<td>:</td>
		<td>
			
			<select name="idbisnis" class="xinput" id='bisnis'>
			
			<option value="<?=@$add->bisnis_id?>" selected > <?=@$add->bisnis_nm?> </option>
					
					<? foreach ($bisnis as $row):?>
						<option value="<?=@$row->bisnis_id?>"><?=@$row->bisnis_nm?></option>
					<? endforeach ?>
			
			</select>
		</td>
		<td style="padding:0 0 0 80" >No.Fax</td>
		<td>:</td>
		<td><input type="text"  value="<?=$data->custcomp_fax?>" name='custcompfax' id='faxbis'class="xinput calculate"></td>
	</tr>
	<tr>
		<td>Address</td>
		<td>:</td>
		<td>
			<textarea name="custcompalamat" class="xinput"><?=$data->custcomp_alamat?></textarea>
		</td>
		<td style="padding:0 0 0 80">NPWP</td>
		<td>:</td>
		<td><input type="text"  value="<?=$data->custcomp_npwp?>" name="custcompnpwp" id="npwpbis" class="xinput calculate"></td>
	</tr>
	<!--End-->
	
	
	
	

	
	
	
	<tr><td width="150" colspan="3"></td></tr>
	<tr>
		<td colspan="3">
			<input type="submit" name="save" value="Update"/>
			<input type="reset" name="cancel" value="Cancel"/>
		</td>
	</tr>	
</table>
</form>
