<?=script('currency.js')?>
<?=script('calendar.js')?>
<?=script('calendar2.js')?>
<?=script('jquery.validationEngine-enx.js')?>
<?=script('jquery.validationEnginex.js')?>
<?=script('jquery.formx.js')?>
<?=script('xcek.js')?>
<?=link_tag(CSS_PATH.'calendar.css')?>
<?=link_tag(CSS_PATH.'x-forminput.css')?>
<h2>Update Project Budget</h2>
<script type="text/javascript">
   function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('updateprojbgt/loaddata')?>', //request ke fungsi load data di inputAP
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 $('#'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#'+type).append('<option></option>'); // buat pilihan awal pada combobox
			 for(var x=0;x<data.length;x++){
				// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); // hilangkan text loading
		  }else{
			 alert(data.error); // jika ada respon error tampilkan alert
			 //$('#combobox_customer').text('');
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }
   
   
$(function(){
	loadData('project_id',0);
	var kugiri = new RegExp(",", "g");
	
	$('#project_id').change(function(){
		loadData('cost',$('#project_id option:selected').val());
	});
	
	$('#cost').change(function(){
		loadData('subcost',$('#cost option:selected').val());
	});		
	
	$('#subcost').change(function(){
		var project_id = $('#project_id option:selected').val()
		var cost = $('#cost option:selected').val()
		var subcost = $('#subcost option:selected').val()
		$.post('<?=site_url('proposedbgt/tampildata')?>',
			{'project':project_id,'cost':cost,'subcost':subcost},
				function(data){
					if(data.error == undefined){
						$('#bgt').empty(); // kosongkan dahulu combobox yang ingin diisi datanya
						$('#bgt').append('<option></option>'); // buat pilihan awal pada combobox
						//alert(data.length);
						for(var x=0;x<data.length;x++){
							// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
							$('#bgt').append($('<option></option>').val(data[x].id).text(data[x].nama));
						}
					}else{
							alert(data.error); // jika ada respon error tampilkan alert
					}				
				},'json');
		});
	
	$('#bln').change(function(){
			var thn = $('#thn').val();
			var bgt = $('#bgt').val();
			$.getJSON('<?=site_url('updateprojbgt/tampildata')?>/' + $(this).val() + '/' + thn + '/' +  bgt ,
				function(response){
					if(response=='data kosong'){
						alert("Data Kosong");
					}else{
						$('#original').val(numToCurr(response.nilai));						
					}
				})
	});		
	
	

	$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
		var original = parseInt($('#original').val().replace(kugiri,""));
		var amount  = parseInt($('#amount').val().replace(kugiri,""));
		//alert($('#cal option:selected').val());
		if($('#cal option:selected').val()=="tambah"){
			var current = original + amount;
		}else if($('#cal option:selected').val()=="kurang"){
			var current = original - amount;
		}
		
		$('#current').val(numToCurr(current));
		
	})
	
			
		
	
});
 
	
</script>
<div id="x-input">
<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('updateprojbgt/saveadj'), $attr);
?>
    <fieldset>
		<?php $tgl = date("d-m-Y");?>
	  <div class="x1">
		   <label for="date">Date</label><input type="text" name="tgl" id="tgl" readonly="true" value="<?=$tgl?>" placeholder=""/>
				<!--a href="JavaScript:;" onClick="return showCalendar('tgl', 'dd-mm-y');" title="Pilih Tanggal" > 
					<img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/>
				</a-->       
		   <br/>  
		   <label for="name">Project Name</label>
				<select name="project_id" id="project_id" style="width:150px">
				</select><br/>         
		   <label for="total budget">Structure Cost</label>
				<select name="cost" id="cost" style="width:150px"></select><br/>		
		   <label for="substruk">Sub Structure</label>
				<select name="subcost" id="subcost" style="width:150px"></select><br/>
		   <label for="total budget">Budget Name</label>
				<select name="bgt" id="bgt" style="width:150px">
				</select><br/>
 				
	</div>

	<div class="x1">
	   <label for="start">Year</label>
			<select name="thn" id="thn">
					<option></option>
				<?php for($i = 2012 ;$i <= 2020; $i++): ?>
					<option><?=$i?></option>
				<?php endfor; ?>
			</select><br/>
	   <label for="month">Month</label>
			<select name="bln" id="bln">
				<?php for($i = 0 ;$i <= 12; $i++): ?>
					<option value="<?=$i?>"><?=$bln[$i]?></option>
				<?php endfor; ?>
			</select><br/>		
	   <label for="start">Type Adj</label>
			<select name="cal" id="cal">
				<option></option>
				<option value="tambah">Penambahan</option>
				<option value="kurang">Pengurangan</option>			
			</select><br/>
	   <label for="start">Amount Adj</label><input type="text" name="amount" id="amount" class="calculate input" maxlength="20" placeholder=""/><br/>			
	   <label for="start">Original Bgt</label><input type="text" name="original" id="original"  class="input" readonly="true" placeholder=""/><br/>
	   <label for="start">Current Bgt</label><input type="text" name="current"  id="current" class="input" placeholder=""/><br/>			
	   <!--label for="start">All Month</label><input type="checkbox" name=""  placeholder=""/><br/><br/-->	   

	</div>
	   <!--div id="headermenu"> 
			<div class="header_1"><span>Month</span><span>Previous Budget</span><span>Adjustment Value</span><span>Current Budget</span></div> 
			<label for="month">January</label><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/>
			<label for="month">Febuary</label><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/>
			<label for="month">March</label><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/>
			<label for="month">April</label><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/>
			<label for="month">Mai</label><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/>
			<label for="month">June</label><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/>
			<label for="month">July</label><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/>
			<label for="month">August</label><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/>
			<label for="month">September</label><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/>
			<label for="month">October</label><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/>
			<label for="month">November</label><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/>
			<label for="month">December</label><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/><input type="text" name=""  placeholder=""/>

       </div>	<br/-->
		<div class="x1">
			<input type="submit" value="Save" /> <input type="reset" value="Cancel" />	
		</div>
    </fieldset>
<?=form_close()?>
   
</div>
