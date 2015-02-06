<?=script('currency.js')?>	
<link href="<?=site_url()?>assets/css/validationEngine.jquery.css" rel="stylesheet" type="text/css">
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEngine-en.js"></script>
<link rel="stylesheet" type="text/css" href="<?=site_url()?>assets/css/jquery-ui-1.8.7.custom.css">
<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'styletable.css')?>
<?=link_tag(CSS_PATH.'table.css')?>
<?=script('jquery.easyui.min.js')?>

<script src="<?=base_url()?>assets/js/jquery-ui.min.js"></script>

<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />

<? 	$w1 = "style='width:20%'"; 
	$w2 = "style='width:20%'"; 
	$w3 = "style='width:20%'"; 
	$w4 = "style='width:20%'"; 
	$w5 = "style='width:15%'";
	$w6 = "style='width:5%'";	?>


<script type="text/javascript">
function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      //$.post('<?=site_url('denda_customer/loaddata')?>', //request ke fungsi load data di inputAP
      $.post('<?=site_url('ap/apdebitnote/loaddata')?>', //request ke fungsi load data di inputAP
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 $('#'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#'+type).append('<option>Select Here</option>'); // buat pilihan awal pada combobox
			// $('#'+type).append('<option>ALL</option>'); // buat pilihan awal pada combobox
			 for(var x=0;x<data.length;x++){
				// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); // hilangkan text loading
		  }else{
			 alert(data.error); // jika ada respon error tampilkan alert
			 $('#subproject1').text('');
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }
  
$(function(){ 
	
	
	loadData('subproject1',0);	
	
	
	
	
	
	
	$('#subproject1').change( 
	
		function(){
			if($('#ap option:selected').val() != '')
				loadData('ap',$('#subproject1 option:selected').val());				
		}
	);

	$('#ap').change(function(){
				$.getJSON('<?=site_url('ap/apdebitnote/getdetsupp')?>/'+$(this).val(),
							function(data){
								
								$("#cont").val(data.kontak);
								$("#ph").val(data.telepon);
								

							});

				
				});
});	
$(document).ready(function(){
	$('#kelua').hide();
	
	$( ".get_creditorac" ).autocomplete({
		source: function(request, response) {
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_apcn",
				data: { term: $(".get_creditorac").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		select: function (event, ui) {
			var id = ui.item.id;
			$(".id_creditorac").val(id);
		},
		minLength: 1
	});
	
	$(".saving").click(function(){
		var c = confirm('Proces this Supplier?');
		if(c==false){
			return false;
		}
		
		$("#loading_proses").html('<b><i>sedang proses!!</i></b><br><img src="<?php echo site_url(); ?>assets/images/loadingAnimation.gif"/>');
		$(".hideByproses").hide();
		
		var subproject1 = $("#subproject1").val();
		var id_sub = $("#ap").val();
		
	
		
		$.ajax({
			url		: '<?=site_url();?>ap/apdebitnote/show_debitnote',
			type	: 'post',
			dataType: "json",
			data	: {'subproject1':subproject1,
					   'id_sub':id_sub
			},
			success	: function(data){
				//alert(data.apinvoice_id);
				//$("#vendo").val(data.apinvoice_id);
				
				//alert("Success");
				$("#loading_proses").html('');
				$(".hideByproses").show();
				$('#kelua').show();
			}
		});
		
	});
});
			
</script>	

<style>
.button-click{
	background: #5edb66;
	padding: 5px 10px;
	border-radius: 2px;
	-moz-border-radius: 2px;
	-webkit-border-radius:2px;
	border: 0px;
	color: #FFF;
	width:100px;
	cursor:pointer;
}
</style>	
<div class="box box-primary">	
	
<div class="box-header">
	<h3 class="box-title">AP Debit Note</h3>
</div>
<div class="box-body">
	<form action="<?=site_url();?>creditnote/save_creditnote"  method="post">
	<table class="table-hover">		
		<tr>
		<td>Project</td>
			<td>:</td>
				<td>
					<select class="form-control" style="width:280px" name='subproject1' id='subproject1' placeholder="Select Here">
						
					</select>
				</td>
		
		<td>Received Date</td>
			<td>:</td>
			<td><input type="text" name="r_date" id="r_date" placeholder="Click to show Calendar" readonly="true" style="text-align:center" id="credit_date" class="validate[required] xinput form-control" size="30"  onClick="return showCalendar('r_date', 'dd-mm-y');" title="Pilih Tanggal"/>
						
		<td>Reff. Number</td>
			<td>:</td>
				<td><input class="form-control" name='r_num' id='r_num'></td>
				
	</tr>
	<tr>
		<td>Supplier Name</td>
			<td>:</td>
				<td><select class="form-control" style="width:280px" name='ap' id='ap' placeholder="Select Here">
						
					</select></td>
		<td>Supplier Contact</td>
			<td>:</td>
				<td><input class="form-control" name='cont' id='cont' readonly="true"></td>
		<td>Amount</td>
			<td>:</td>
				<td><input type="text"  class="form-control" name='amount1' id='amount1' style='text-align:right;background-color:yellow;' ><div style="color:red;font-size:10px;"><b>*Input Amount from Debit Note Here</b></div></td>
	</tr>		
	
	<tr>
		<td>Supplier Phone</td>
			<td>:</td>
				<td><input class="form-control" name='ph' id='ph' readonly="true"></td>
	</tr>		
		
		
	
	
	</table>
	<br>
	<div id="kelua" class="kelua">
		<table border="0" >
				<tr> 
					<td>No</td>
					<td>AP</td>
					<td>AP Date</td>
					<td>OS Amount</td>
					<td>OS</td>
					<td>Alocation Amount</td>
					<td>Balance</td>
					<td>Pay</td>
				</tr>
			<tr>	
			<td>No</td>
					<td><input type="text" name="vendo" id="vendo"></td>
					<td>2</td>
					<td>3</td>
					<td>4</td>
					<td>5</td>
					<td>6</td>
					<td>7</td>
			<tr>
			</table>
	</div>
	
	
	<div style="margin-top:10px">
			<span class="hideByproses">
			<input type="button" name="tombol" value="Proses" class="saving button-click"/>
			
			</span>
			<span id="loading_proses"></span>
	</div>
	</form>
</div>
</div>	

