<?=link_tag(CSS_PATH.'menuformx.css')?>
<?//=script('jquery-1.4.2.min.js')?>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />

<script type="text/javascript">
function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      //$.post('<?=site_url('denda_customer/loaddata')?>', //request ke fungsi load data di inputAP
      $.post('<?=site_url('unidentified/loaddata')?>', //request ke fungsi load data di inputAP
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 $('#'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#'+type).append('<option></option>'); // buat pilihan awal pada combobox
			 //alert(data.length);
			 for(var x=0;x<data.length;x++){
				// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); // hilangkan text loading
		  }else{
			 alert(data.error); // jika ada respon error tampilkan alert
			 //$('#subproject').text('');
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }



$(function(){
		$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
	 }).numeric();
	 
	 loadData('subproject',0);	
	//  loadData('bank',0);
	  
	  $('#subproject').change( 
		function(){
			if($('#bank option:selected').val() != '')
				loadData('bank',$('#subproject option:selected').val());				
		}
	);
	 
});
</script>

<form method="post" action="<?=site_url('unidentified/simpan')?>">
	<table>
		<tr>
		<td>Project</td>
			<td>:</td>
				<td>
					<select name="subproject" id="subproject" class="xinput"></select>
				</td>		
		</tr>
		<tr>
			<td>Date</td>
			<td>:</td>
			<td>
				<input type="text" style="width:100px" name="tgl" id="tgl" class="xinput validate[required]" readonly="true" class="xinput">
				<a href="JavaScript:;" onClick="return showCalendar('tgl', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>			
			</td>
		</tr>	
		<tr>	
			<td>Paytipe</td>
			<td>:</td>
			<td>
				<select name="paytipe" class="xinput">
					<option></option>
					<?php foreach($tipe as $row):?>
						<option value="<?=$row->paysource_id?>">
							<?=$row->paysource_nm?>
						</option>
					<?php endforeach?>	
				</select>
			</td>
		</tr>
		<tr>	
			<td>Bank</td>
			<td>:</td>
			<td>
				<select name="bank" id="bank" class="xinput"></select>
				<!--<select name="bank" class="xinput">
					<option></option>
					<?php foreach($bank as $row):?>
						<option value="<?=$row->bank_id?>">
						<?php
						  $session_id = $this->UserLogin->isLogin();
						  $user = $session_id['username'];
						  $pt = $session_id['id_pt'];?>
						  <? if($pt == 44){?>
							<?=$row->bank_nm?>
						<?}ELSE{?>
								<?=$row->remark?>
							<? } ?>	
						</option>
					<?php endforeach?>	
				</select>-->
			</td>
		</tr>
		<tr>	
			<td>Reference</td>
			<td>:</td>
			<td><input type="text" name="ref" class="xinput"/></td>
		</tr>
		<tr>	
			<td>Amount</td>
			<td>:</td>
			<td><input type="text" name="amount" class="calculate input"/></td>
		</tr>
		<tr>
			<td colspan='3'><input type="submit" name="save" value="Save"/></td>
		</tr>
	</table>
</form>
