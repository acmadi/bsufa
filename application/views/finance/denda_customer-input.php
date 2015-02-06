<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuformx.css" type="text/css" />
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.css" type="text/css" />
<script type="text/javascript">
   function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('denda_customer/loaddata')?>', //request ke fungsi load data di inputAP
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 $('#combobox_'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#combobox_'+type).append('<option>-Pilih data-</option>'); // buat pilihan awal pada combobox
			 for(var x=0;x<data.length;x++){
				// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
			 	$('#combobox_'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); // hilangkan text loading
		  }else{
			 alert(data.error); // jika ada respon error tampilkan alert
			 $('#combobox_customer').text('');
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }

$(function(){ 
	loadData('project',0); 	 
	$(document).ready(function(){
		$('#sell').attr('readonly',true);
	});
		
    /*var arr = [ "one", "two", "three", "four", "five" ];
    var obj = { one:1, two:2, three:3, four:4, five:5 };

    jQuery.each(arr, function() {
      $("#" + this).text("Mine is " + this + ".");
       return (this != "three"); // will stop running after "three"
   });

    jQuery.each(obj, function(i, val) {
      $("#" + i).append(document.createTextNode(" - " + val));
    });*/

		
		
	$('#combobox_project').change( 
		function(){
			if($('#combobox_customer option:selected').val() != '')
				loadData('customer',$('#combobox_project option:selected').val());				
		}
	);
	
	$('#combobox_customer').change(function(){
			if($('#combobox_unit option:selected').val() !='')
				loadData('unit',$('#combobox_customer option:selected').val());
		/*var idcust = $('#combobox_customer option:selected').val();
		var idproject = $('#combobox_project option:selected').val();
		$.getJSON('<?=site_url('denda_customer/cekdata')?>/'+idcust+'/'+idproject,
			function(response){
				$('#unit').val(response.lot_no);
				$('#sell').val('1,000,000');
			}
		);*/
	});
	
	$('#combobox_unit').change(function(){
		var id_unit = $('#combobox_unit option:selected').val();
		$.getJSON('<?=site_url('denda_customer/cekdata')?>/'+ id_unit,
			function(response){
				$('#hidesell').val(numToCurr(response.price_sales));
			});
	});
	   	
	$('#top').change(function(){
		var top = $('#top').val();
		var tgl_mulai = $('#tgl_mulai').val();
		var sell = $('#sell').val();
		$.post("<?=site_url('denda_customer/cek_data')?>",
		{'top':top,'tgl_mulai':tgl_mulai,'sell':sell},
		function(response){
			//alert(response);
		});
	});
	
	$('#persen').change(function(){
		var rep_coma = new RegExp(",", "g");
		var a = parseInt($('#sell').val().replace(rep_coma,""));
		var b = parseInt($('#persen').val());
		var c = a * b/100;
		$('#amount').val(numToCurr(c));	
	});

	$('#top').bind('keyup keypress',function(){
		var rep_coma = new RegExp(",", "g");
		var a = parseInt($('#top').val());
		var b = parseInt($('#amount').val().replace(rep_coma,""));
		var c = b / a;
		$('#mnth_pay').val(numToCurr(c));
	});	

	//pilih paid/sell
	$('input[name=price]').change(function(){
		$('#periode').empty();
		$('#periode').append('<option></option>');
		for(var x=1;x<=3;x++){
			 $('#periode').append($('<option></option>').val(x).text('Periode '+x));
		}		
		if($('input:radio[name=price]:checked').val() == 'sell') {
		  $('#sell').attr('readonly',true);
		  $('#sell').val($('#hidesell').val());
		}else{
		  $('#sell').attr('readonly',false);
		  $('#sell').val('0');
		}
	});

	
	$('#periode').change(function(){
      $.post('<?=site_url('denda_customer/cekperiode')?>',
		{customer: $('#combobox_customer option:selected').val(),
		 unit: $('#combobox_unit option:selected').val(),
		 periode:$('#periode option:selected').val()},
		function(response){
			alert(response);
		});

	});

	$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
	 }).numeric();	

	 //Proses Form
	$('#formAdd')
	.validationEngine()
	.ajaxForm({
		success:function(response){
			//alert(response);
			//$('#btnReset').click();
			if(response=='sukses'){
				alert(response);
				refreshTable();
			}else{
				alert(response);
			}
		}
	});		
			 
	$('#btnClose').click(function(){
		$.validationEngine.closePrompt(".formError",true)
		refreshTable();
	});
	
});
</script>

<form method="post" action="<?=site_url('denda_customer/insert_denda')?>" id="formAdd"> 
<h1>Penalty Customer</h1>
<input type="hidden" name="hidesell" id="hidesell"/>
<table border="0" cellspacing="2" cellpadding="2">
	<tr>
		<td>Project</td>
		<td>:</td>
		<td colspan="4">
			<select name="project" id="combobox_project" class="xinput"></select>
		</td>
	</tr>
	<tr>
		<td>Customer</td>
		<td>:</td>
		<td colspan="4">
			<select name="customer_id" id="combobox_customer" class="xinput validate[required]"></select>
		</td>
	</tr>
	<tr>
		<td>Unit</td>
		<td>:</td>
		<td colspan="4">
			<select name ="unit" id="combobox_unit" class="xinput validate[required]">
			</select>
		</td>
	</tr>
	<tr>
		<td>Sold Amount</td>
		<td>:</td>
		<td colspan="4">
			Net Selling<input type="radio" name="price" value="sell" id="p1"/>
			Payment<input type="radio" name="price" value="paid" id="p2"/>
		</td>
	</tr>
	<tr>
		<td>Amount</td>
		<td>:</td>
		<td colspan="4"><input type="text" name="sell" id="sell" class="xinput calculate validate[required]" maxlength="15"/></td>
	</tr>
	<tr>
		<td colspan="3" style="padding:15 0 0 0"><div style='border-bottom:solid;width:180'><b>Proposed penalty customer</b></div></td>
		<td colspan="3" style="padding:15 0 0 10"><div style='border-bottom:solid;width:180'><b>customer penalty payments</b></div></td>
	</tr>
	<tr>
		<td>IOM Date</td>
		<td>:</td>
		<td>
			<input type="text" name="iom_date" id="iom_date" class="xinput validate[required]" readonly="true"/>
			<a href="JavaScript:;" onClick="return showCalendar('iom_date', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
		</td>
		<td style="padding:0 0 0 10">Start Date Payment</td>
		<td>:</td>
		<td colspan="4">
			<input type="text" name="tgl_mulai" id="tgl_mulai" class="xinput" readonly="true"/>
			<a href="JavaScript:;" onClick="return showCalendar('tgl_mulai', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>		
		</td>
	</tr>
	<tr>
		<td>IOM No.</td>
		<td>:</td>
		<td><input type="text" name="iom_no" id="iom_no" class="xinput validate[required]"/></td>		    
		<td style="padding:0 0 0 10">Penalty Persentase</td>
		<td>:</td>
		<td><input type="text" name="persen" id="persen" style="width:40px" maxlength="3" class="xinput calculate validate[required]" maxlength="15"/><b>%</b></td>
	</tr>
	<tr>
		<td>Periode</td>
		<td>:</td>
		<td>
			<select name="periode" id="periode" class="xinput validate[required]">
				<!--<option></option>
				<option>Periode I</option>
				<option>Periode II</option>
				<option>Periode III</option>-->
			</select>
		</td>		    
		<td style="padding:0 0 0 10">Term Of Payment</td>
		<td>:</td>
		<td><input type="text" name="top" id="top" style="width:40px" maxlength="3" class="validate[required,custom[integer]]"/> <b>X</b></td>
	</tr>		
	<tr>
	    <td colspan="3"></td>
		<td style="padding:0 0 0 10">Penalty Amount</td>
		<td>:</td>
		<td><input type="text" name="amount" id="amount" class="xinput calculate validate[required]" maxlength="15" readonly="true"/></td>	
	</tr>
	<tr>
	    <td colspan="3"></td>
		<td style="padding:0 0 0 10">Month Payment</td>
		<td>:</td>
		<td><input type="text" name="mnth_pay" id="mnth_pay"  class="xinput" maxlength="15" readonly="true"/></td>
	</tr>
	<tr>
		<td width ='250' colspan='6' style='border-bottom:solid'>&nbsp;</td>	
	</tr>
	<tr>
		<td colspan="6" style='border-bottom:solid'>
			<input type="submit" name="save" value="Save"/>
			<input type="reset" name="cancel" value="Cancel"/>
		</td>
	</tr>	
</table>
</form>
