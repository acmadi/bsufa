<? $session_id = $this->UserLogin->isLogin();
	$iduser		= $session_id['id'];
   ?> 
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />

<? #tampilkan query?>
<script language="javascript">
$(function(){
	/*fungsi validasi numeric*/
	  $('.calculate').bind('keyup keypress',function(){
			$(this).val($(this).val());
		  }).numeric();
	
	//FUNGSI VALIDASI HP
	
	$.validationEngineLanguage.allRules['ajaxValidateHp'] = {
			"url": "<?=site_url('customerprospek/cekhp')?>",
	        "alertText": "Maaf!!!Nomer HP ini sudah ada yang punya",
	        "alertTextOk": "Nomer HP belum ada punya, Silahkan Lanjutkan",
	        "alertTextLoad": "* Validating, please wait"
	     };
	     
	//FUNGSI VALIDASI NAMA PROSPEK
	$.validationEngineLanguage.allRules['ajaxValidateNamaProspek'] = {
			"url": "<?=site_url('customerprospek/cekprospek')?>",
	        "alertText": "Maaf!!!Nama Prospek ini sudah ada",
	        "alertTextOk": "Nama Prospek belum ada, Silahkan Lanjutkan",
	        "alertTextLoad": "* Validating, please wait"
	     };
	
	
	
	
	
		  
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
	
	
	loadData('tipemedia',0);
	loadData('project',0);
	//loadData('sales',0);
	loadData('mod',0);
	/*DropDown Menu*/
	
	$('#tipemedia').change(function(){
			loadData('media',$('#tipemedia option:selected').val());
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
	
	



<? /*$data=$this->mstmodel->group();*/ ?>


<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css" />
<form method='post' action='<?=site_url()?>customerprospek/InsertProspekCustomer' id='formadd'>
<input type='hidden' value='<?=$sales->id_kary?>' name='sales'>

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
		<td><select name="idgroup" id="individu" class="xinput ">
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
			<select name="idgroup" id="corporate" class="xinput"></select>
		</td>
	</tr>
	<tr>
		<td >Media Type</td>
		<td>:</td>
		<td>
			<select name="idtipemedia" id="tipemedia" class="xinput validate[required]">
			</select>
		</td>
		
		
		
	</tr>
	<tr>
		
		
		<td >Media Source</td>
		<td>:</td>
		<td>
			<select name="idmedia" id="media" class="xinput validate[required]">
			</select>
		</td>
		
		
		
		<td style="padding:0 0 0 80" >Handphone</td>
		<td>:</td>
		<td><input type="text" name="customerhp" id="hp" class="xinput calculate validate[custom[phone],maxSize[12],minSize[5],ajax[ajaxValidateHp]]" class="validate[required]"></td>
	
	</tr>
	
	<tr>
		
		<td>Venue</td>
		<td>:</td>
		<td><input type="text" name="venue"  id='venue' class="xinput validate[required]" ></td>
		
		
		<td style="padding:0 0 0 80">Email</td>
		<td>:</td>
		<td><input type="text" name="email" id='email' class="validate[required,custom[email]]"></td>	
		
	</tr>
	<tr>
		<td>Customer Prospect</td>
		<td>:</td>
		<td><input type="text" name="customernama" id='nama' class="xinput validate[required,,maxSize[12],minSize[3],ajax[ajaxValidateNamaProspek]]" ></td>
		
		<td style="padding:0 0 0 80"> Sales </td>
		<td>:</td>
		<td><input type="text" name="tes" value="<?=$sales->nama?>" readonly ></td>
	
	</tr>
	
	<tr>
		<td>Registration Date</td>
		<td>:</td>
		<td>
			<input type="text" name="regdate" id="tgl_lahir" value="<?=$tgl = date("d-m-Y");  ?>" readonly="true">
			
		</td>
		<td style="padding:0 0 0 80">Manager of Duty</td>
		<td>:</td>
		<td><select type="text" name="mod" id="mod" class="xinput validate[required]"  readonly="true"> </select></td>
		
	</tr>
	<tr>
		<td>Project Interest</td>
		<td>:</td>
		<td><select  name="project" id="project" class="xinput validate[required]" ></select></td>
		<td style="padding:0 0 0 80">Shift of Duty</td>
		<td>:</td>
		<td><select name="shift" id="idtipe" class="xinput validate[required]">
				<option value=""></option>
				<option>I</option>
				<option>II</option>
				<option>Long Shift</option>
			</select></td>
	
	
	</tr>

	<tr>
		<td >Term of Payment</td>
		<td>:</td>
		<td><select name="top" id="idtipe" class="xinput validate[required]">
				<option value=""></option>
				<option>Cash</option>
				<option>KPA</option>
				<option>Angsuran</option>
			</select></td>
	</tr>
	
	
	
	
	
	
	
	
	
	
	<tr><td width="150" colspan="3"></td></tr>
	<tr>
		<td colspan="3">
			<input type="submit" name="save" value="Save"/>
			<input type="reset" name="cancel" value="Cancel"/>
		</td>
	</tr>	
</table>
</form>
