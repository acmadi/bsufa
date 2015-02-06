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
      $.post('<?=site_url('contractactiv/loaddata')?>',
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


	
	loadData('penyewa',0);
	

	/*fungsi validasi numeric*/
	  
	  var kugiri = new RegExp(",", "g");
	  var rep_coma = new RegExp(",", "g");
	  $('.calculate').bind('keyup keypress',function(){
			//$(this).val($(this).val());
		  $(this).val(numToCurr($(this).val()));
			
			var biayasewa = parseInt($('#biaya_sewa').val().replace(rep_coma,""));
			var period = parseInt($('#period').val().replace(rep_coma,""));
			
			
			var totsewa = period * biayasewa;
			

			$('#totsewa').val(numToCurr(totsewa));
			
			
		  
		  }).numeric();


/*event hide form*/
	$('#penyewa').change(function(){
		
		//~ alert('tes');
		$.getJSON('<?=site_url('contractactiv/tampil')?>/'+$(this).val(),
				function(data){
					    		    
					    
					    
					    $('#nama').val(data.customer_nama);
						$('#alamat').val(data.customer_alamat1);
						$('#pic').val(data.pic);
						$('#tlp').val(data.customer_tlp);
					    
					   
				});
		 
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


<!--
<link rel="stylesheet" href="<?#=base_url()?>assets/css/menuform.css" type="text/css" />
-->
<form method='post' action='<?=site_url()?>contractactiv/InputActiv' id='formadd'>
<table border="0" cellpadding="2" cellspacing="2">
	
  
    <!--Customer Profile-->
    <tr>
		<td colspan="3" style=""><font color='#FF0000'><b><u>ENTRY CONFIRMATION LETTER</u></b></font></td>
    </tr>
    
    <tr>
		<td>No Konfirmasi</td>
		<td>:</td>
		<td>
			<!--<input name='no_activation' id='no_activation' value=<?=$sql->noactiv?> style='width:220;background-color:#FFFF00' readonly>-->
			<input name='no_activation' id='no_activation' value="" style='width:220;background-color:#FFFF00' readonly>
		</td>	

    </tr>
    
    <tr>
		
		<td>Tgl Sewa</td>
		<td>:</td>
		
			<td><input  name='tglmulai' id='tglmulai'style='width:80;' readonly >
				<a href="JavaScript:;" onClick="return showCalendar('tglmulai', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
			</td>
		
			
	</tr>

    
    

	<tr>
		
		<td>Penyewa</td>
		<td>:</td>
		<td><select  name='penyewa' id='penyewa' style='width:150' readonly>	</select></td>
			

	</tr>
	
			
	<tr>
		<td >Jenis Kegiatan</td>
		<td>:</td>
		<td>
			<select  name='kegiatan' id='kegiatan'  style='width:150' >
				<option></option>
				<option>Foto dan Shooting</option>
				<option>Umbul umbul dan Billboard</option>
			</select>
		</td>

			<td>PIC</td>
			<td>:</td>
			<td><input name='pic' id='pic' style='background-color:#80FFFF;width:150' readonly>	</select></td>
	</tr>
		
	
	<tr>
		
		<td >Periode Sewa</td>
		<td>:</td>
		<td><select  name='period' id='period' style='width:40' readonly>
				<?$x=0;while($x<=60){?>
				<option><?=$x;$x++;?></option>
				<?}?></select> Hari</td>
		
					<td >Tlp.</td>
					<td>:</td>
					<td><input name='tlp' id='tlp' style='width:100;text-align:right;background-color:#80FFFF'  readonly ></td>

		
	</tr>
	<tr>
		<td >Biaya Sewa</td>
		<td>:</td>
		<td><input name='biaya_sewa' id='biaya_sewa' style='width:100;text-align:right'  class='validate[required] calculate' >/Hari</td>
				
				<td >Alamat </td>
				<td>:</td>
				<td><input  name='alamat' id='alamat'  style='background-color:#80FFFF;width:300'  readonly ></td>
	
	</tr>
	

	<tr>
		<td >Total Sewa</td>
		<td>:</td>
		<td><input name='totsewa' id='totsewa' style='width:100;text-align:right;background-color:#FF80FF'  readonly></td>
	
	</tr>
	
	
	
	

	<tr id='tr14'>
		<td colspan="3">
			<input type="submit" name="save" value="Save"/>
			<input type="reset" name="cancel" value="Cancel"/>
		</td>
	</tr>	
</table>
</form>
