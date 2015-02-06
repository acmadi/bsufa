<?#=script('jquery.tabs.js')?>
<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?=script('jquery.easyui.min.js')?>
<?=script('jquery.edatagrid.js')?>
<?=script('currency.js')?>
<?=script('jquery.numeric.js')?>
<link href="<?=site_url()?>assets/css/validationEngine.jquery.css" rel="stylesheet" type="text/css">
<!--<script language="javascript" src="<?=site_url()?>assets/js/jquery-1.6.minx.js"></script>-->
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.formx.js"></script>
<?=script('datagrid-detailview.js')?>

<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.css" />
<?=script('currency.js')?>
<script src="<?=base_url()?>assets/js/jquery-ui-1.8.2.min.js"></script>
<script type="text/javascript">
$('#tab').bind('keyup click',function(){
	var d2 = parseInt($('#acc_debet_2').val().replace(/,/g,''));
	if($('#acc_debet_3').val().replace(/,/g,'')!=''){
	var d3 = parseInt($('#acc_debet_3').val().replace(/,/g,''));
	}else{
	var d3 = 0;
	}
	var td = d2+d3;
	var c1 = parseInt($('#acc_credit_1').val().replace(/,/g,''));
	if($('#acc_credit_4').val().replace(/,/g,'')!=''){
	var c4 = parseInt($('#acc_credit_4').val().replace(/,/g,''));
	}else{
	var c4 = 0;
	}
	var tc = c1+c4;
	$('#total_debet').val(numToCurr(td));
	$('#total_credit').val(numToCurr(tc));
});
$(function(){	
	
	$(".get_addcoaacno").autocomplete({
		source: function(request, response) { 
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_coaacno",
				data: { term: $(".get_addcoaacno").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		select: function (event, ui) {
			var id 	  = ui.item.id;
			$(".auto-add_name").val(id);
			
			event.preventDefault();
			var value = ui.item.value.replace(/ /g,'');
			var coa = value.split('|');
			$(".get_addcoaacno").val(coa[0]);
		},
		minLength: 1
	});
	
	$(".get_addcoaacno1").autocomplete({
		source: function(request, response) { 
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_coaacno",
				data: { term: $(".get_addcoaacno1").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		select: function (event, ui) {
			var id 	  = ui.item.id;
			$(".auto-add_name1").val(id);
			
			event.preventDefault();
			var value = ui.item.value.replace(/ /g,'');
			var coa = value.split('|');
			$(".get_addcoaacno1").val(coa[0]);
		},
		minLength: 1
	});
	
	$(".get_addcoaacno2").autocomplete({
		source: function(request, response) { 
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_coaacno",
				data: { term: $(".get_addcoaacno2").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		select: function (event, ui) {
			var id 	  = ui.item.id;
			$(".auto-add_name2").val(id);
			
			event.preventDefault();
			var value = ui.item.value.replace(/ /g,'');
			var coa = value.split('|');
			$(".get_addcoaacno2").val(coa[0]);
		},
		minLength: 1
	});
	
	$(".get_addcoaacno3").autocomplete({
		source: function(request, response) { 
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_coaacno",
				data: { term: $(".get_addcoaacno3").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		select: function (event, ui) {
			var id 	  = ui.item.id;
			$(".auto-add_name3").val(id);
			
			event.preventDefault();
			var value = ui.item.value.replace(/ /g,'');
			var coa = value.split('|');
			$(".get_addcoaacno3").val(coa[0]);
		},
		minLength: 1
	});
	
	$(".get_addcoaacno4").autocomplete({
		source: function(request, response) { 
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_coaacno",
				data: { term: $(".get_addcoaacno4").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		select: function (event, ui) {
			var id 	  = ui.item.id;
			$(".auto-add_name4").val(id);
			
			event.preventDefault();
			var value = ui.item.value.replace(/ /g,'');
			var coa = value.split('|');
			$(".get_addcoaacno4").val(coa[0]);
		},
		minLength: 1
	});
	
	// digunakan untuk autocomplete yang setelah di enter rownya
	<?php for($f=1; $f<=100; $f++){ ?>
	$("tbody#itemlist").on("keyup","#get_mycoa",function(){
		var c = $(".get_coaacnoi<?=$f;?>").val();
		$( ".get_coaacnoi<?=$f;?>" ).autocomplete({
			source: function(request, response) {
					$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_coaacno",
					data: { term: c},
					dataType: "json",
					type: "POST",
					success: function(data){
						response(data);
					}
				});
			},
			minLength: 1
		});
	});
	<?php } ?>
});

	</script>
<script type="text/javascript">	

		
	$(function(){		
	
	$.fn.datebox.defaults.formatter = function(date) {
			var y = date.getFullYear();
			var m = date.getMonth() + 1;
			var d = date.getDate();
			return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
		};	
		
		$('#inv_date').datebox({  
                                                required:true  
                                });
		$('#receipt_date').datebox({  
                                                required:true  
								});
		$('#due_date').datebox({  
                                                required:true  
								});
												
		var rep_coma = new RegExp(",", "g");
		});
		
		var rep_coma = new RegExp(",", "g");
		$('.calculate').bind('keyup keypress',function(){
			
			$(this).val(numToCurr($(this).val()));
			
			});	
		
		$("#vendor").change(function(){
	//alert('tes');
			$.getJSON('<?=site_url()?>/apinvoice/jnsusaha/' + $(this).val(),
			function(jnsusaha){				
				$('#jns').val(jnsusaha.jns_usaha);	
			});
		});	

$('#ppn').click(function(){
	if($("#ppn").is(":checked")){
	var amount = $('#amount').val().replace(/,/g,'');
	var ppn_val = amount*10/110;
	
	$('#dpp_ppn').val(numToCurr(amount-ppn_val));
	var dpp_ppn = $('#dpp_ppn').val();
	$('#r3').show();
	$('#acc_dr_3').val('2.01.04.07');
	$('#acc_name_3').val('PPN Keluaran');
	$('#acc_debet_3').val(numToCurr(ppn_val));
	$('#acc_debet_2').val(numToCurr(amount-ppn_val));
	if($('#pph').is(':checked')){
	$('#dpp_pph').val($('#dpp_ppn').val());
	var dpp_pph = $('#dpp_pph').val().replace(/,/g,'');
	var amount = $('#amount').val().replace(/,/g,'');
	var pph_val = $('#pph_val').val();
	
	var val_pph = dpp_pph*pph_val/100;
	//alert(amount+' '+pph_val+' '+val_pph);
	$('#nett').val(numToCurr(amount-val_pph));
	}
	}else{
	$('#r3').hide();
	$('#acc_dr_3').val('');
	$('#acc_name_3').val('');
	$('#acc_debet_3').val('');
	$('#acc_debet_2').val($('#amount').val());
	$('#dpp_ppn').val('');
	$('#dpp_pph').val($('#amount').val());
	if($('#pph').is(':checked')){
	var amount = $('#amount').val().replace(/,/g,'');
	var val_ppn = $('#amount').val().replace(/,/g,'');
	var pph_val = $('#pph_val').val();
	var dpp_pph = $('#dpp_pph').val().replace(/,/g,'');
	var x = amount-(dpp_pph*pph_val/100);
	
	//alert(x);
	$('#nett').val(numToCurr(x));
	}
	}
	var nett = $('#nett').val();
	$('#acc_credit_1').val(nett);
});
$('#r1').hide();
$('#r2').hide();
$('#r3').hide();
$('#r4').hide();
$('#amount').keyup(function(){
var amount = $(this).val();
$('#r1').show();
$('#r2').show();
$('#nett').val(amount);
$('#acc_credit_1').val(numToCurr(amount));
$('#acc_debet_2').val(numToCurr(amount));
});
$('#pph').click(function(){
	if($("#pph").is(":checked")){
	$('#r4').show();
	$('#pph_type').prop('disabled',false);
	$('#pph_val').prop('disabled',false);
	$('#dpp_pph').prop('disabled',false);
	var  x = parseInt($('#amount').val().replace(/,/g,''))*10/110;
	var amount = $('#amount').val();
	var y = parseInt($('#amount').val().replace(/,/g,''))-x;
	if($("#ppn").is(":checked")){
		$('#dpp_pph').val(numToCurr(y));
		$('#nett').val(amount);
	}else{
	$('#dpp_pph').val(numToCurr(amount));
	$('#nett').val(amount);
	}
	}else{
	$('#r4').hide();
	var amount = $('#amount').val();
	$('#acc_dr_4').val('');
	$('#acc_name_4').val('');
	$('#acc_debet_4').val('');
	$('#acc_credit_4').val('');
	$('#pph_type').prop('disabled',true);
	$('#pph_val').prop('disabled',true);
	$('#dpp_pph').prop('disabled',true);
	$('#dpp_pph').val('');
	$('#pph_type').val('');
	$('#pph_val').val('');
	if($("#ppn").is(":checked")){
		//$('#dpp_pph').val(numToCurr(y));
		$('#nett').val(amount);
	}else{
	//$('#dpp_pph').val(numToCurr(amount));
	$('#nett').val(amount);
	}
	var nett = $('#nett').val();
	$('#acc_credit_1').val(nett);
	}
});	
 $(function(){
 
	
		$('.calculate').bind('keyup keypress',function(){
			var rep_coma = new RegExp(",", "g");
			$(this).val(numToCurr($(this).val()));			
			
			});	

			$('#formAdd')
		//.validationEngine()
		.ajaxForm({
			success:function(response){
				//alert(response);
				if(response=="sukses"){
					alert(response);
					refreshTable();
				}else{
					alert(response);
				}
			}
		});			
});  	 
$('#pph_type').prop('disabled',true);
$('#pph_val').prop('disabled',true);
$('#dpp_pph').prop('disabled',true);

$('#pph_val').keyup(function(){
	var dpp_pph = $('#dpp_pph').val().replace(/,/g,'');
	var pph_val = $('#pph_val').val();
	$('#acc_credit_4').val(numToCurr(dpp_pph*pph_val/100));
	var a = $('#acc_credit_4').val().replace(/,/g,'');
	var amt = $('#amount').val().replace(/,/g,'');
	//$('#acc_credit_1').val(numToCurr(amt-a.replace(/,/g,'')));
	$('#acc_credit_1').val(numToCurr(amt-a));
	//if($('#ppn').is(':checked')){
	//$('#nett').val(numToCurr(parseInt($('#amount').val().replace(/,/g,'')-(dpp_pph*10/110))));
	//}else{
	$('#nett').val(numToCurr(parseInt($('#amount').val().replace(/,/g,'')-(dpp_pph*pph_val/100))));
	//}
});

$('#pph_type').change(function(){
	var id = $(this).val();
	//alert(id);
	$.getJSON('<?php echo base_url();?>ap/apinvoice/getcoaname/'+id,
	function(get){
	$('#acc_dr_4').val(get.acc_no);
	$('#acc_name_4').val(get.acc_name);
	});  
});

$('#category').change(function(){
var no_coa = $(this).val();
$.getJSON('<?php echo base_url();?>ap/apinvoice/getapname/'+no_coa,
function(data){
	$('#acc_dr_1').val(data.acc_no);
	$('#acc_name_1').val(data.acc_name);
});
});
		</script>

<form method="post" action="<?=site_url('ap/apinvoice/saveheader4')?>" id="formAdd">
<body>	
	<table id="tab">
	<tr>
		<h2>AP INVOICE MANUAL</h2>		
	</tr>
	<tr>
		<td>AP</td>
			<td>&nbsp;</td>
			<td><input type="text" name="doc_ref" id="doc_ref"  class="validate[required] xinput"  value=""  class="validate[required]" readonly="true" style="width:205px;padding:3px;border:1px solid #cbcbcb;color:#cbcbcb;background:#cbcbcb" size="30" value="123" />
			<!--input type="hidden" name="doc_no" id="doc_no"  class="validate[required] xinput" value="<?=$noap?>"  readonly="true" size="30" /--></td>
			<td>Invoice No</td>
			<td>&nbsp;</td>
			<td><input type="text" name="inv_no" id="inv_no"  value="" class="validate[required]" size="30" style="width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
			<td>DPP PPN</td>
			<td>&nbsp;</td>
			<td><input type="text" class="calculate" name="dpp_ppn" id="dpp_ppn" style="text-align:right;width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
	</tr>

	<tr>
		<td>Receipt Date</td>
			<td>&nbsp;</td>
			<td>
			<input id="receipt_date" name="receipt_date" style="width:214px;padding:3px;border:1px solid #cbcbcb" size="30"></input>
			</td>
			<td>Invoice Date </td>
			<td>&nbsp;</td>
			<td>
			<input id="inv_date" name="inv_date" value="" size="30"  style="width:214px;padding:3px;border:1px solid #cbcbcb"></input>
			</td>
			<td>Pph</td>
			<td>&nbsp;</td>
			<td><input type="checkbox" id="pph"/></td>
	</tr>
	<tr>
	<td>Vendor Name</td>
			<td>&nbsp;</td>
			<td> <select name="vendor" id="vendor"  style="width:214px;padding:3px;border:1px solid #cbcbcb">
						
                                                            <? foreach($vendor as $row): ?>
                                                            <option value="<?=@$row->kd_supp_gb?>"><?=@$row->nm_supplier?></option> 
                                                            <? endforeach;?>
                        </select>  
			      
	</td>	
	<td>Due Date</td>
			<td>&nbsp;</td>
			<td>
				<select name="due_date" style="width:214px;padding:3px;border:1px solid #cbcbcb">
				<option value="10">10 Days</option>
				<option value="30" selected>30 Days</option>
				<option value="14">14 Days</option>
				<option value="6">6 Days</option>
			</select>            </td>
	<td>Pph Type</td>
	<td>&nbsp;</td>
			<td><select name="pph_type" id="pph_type" style="width:214px;padding:3px;border:1px solid #cbcbcb">
				<option value="">-</option>
				<? 
				$Ph_SQL = " select * from db_coa where acc_name like '%pph%' and acc_no like '2%'";
				$pphPajak = $this->db->query($Ph_SQL)->result();
				foreach($pphPajak as $row){ ?>
							<option value="<?php echo $row->id_coa; ?>"><?php echo $row->acc_name; ?></option> 
				<?php } ?>
			</select></td>
	</tr>
	<td>Project</td>
			<td>&nbsp;</td>
			<td> <select name="project" id="project" style="width:214px;padding:3px;border:1px solid #cbcbcb">
						<option>-</option>
                                                            <? 
															$sproject = $this->db->query("select * from project where pt_project=11 and judul='N' order by nm_project")->result();
															foreach($sproject as $row): ?>
                                                            <option value="<?php echo $row->kd_project?>"><?php echo $row->nm_project?></option> 
                                                            <? endforeach;?>
                        </select>  			      
	</td>
	<td>Invoice Amount</td>		
			<td>&nbsp;</td>
			<td><input type="text" class="input calculate"  name="amount" id="amount" class="calculate input validate[required]" value="" size="30"  style="width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
	<td>PPh (%)</td>
			<td>&nbsp;</td>
			<td><input type="text" name="pph_val" id="pph_val" style="text-align:right;width:205px;padding:3px;border:1px solid #cbcbcb"/>%</option>
			</select></td>
	<tr>	<td>AP Category</td>
			<td>&nbsp;</td>
			<td>
			<!--input type="text" name="category" id="category" class="validate[required] xinput" xinput" value="<?=@$data->category?>" style="width:180px;background-color:#EFFC94" readonly="true" size="30" /-->
			<select name="category" id="category" style="border:1px solid #cbcbcb;width:214px;padding:3px">
			<option>-- Choose --</option>
			<?php 
			$ap_category =  $this->db->query("select * from db_coa where acc_name like '%ap trade%' and id_pt='11'")->result();
			foreach($ap_category as  $row){?>
			<option value="<?php echo $row->acc_no;?>"><?php echo $row->acc_name;?></option>
			<?php } ?>
			</select>
			<input type="hidden" id="ap_name">
			</td>
			<td>Ppn</td>
			<td>&nbsp;</td>
			<td><input type="checkbox" id="ppn"/></td>
			<td>Dpp PPh</td>
			<td>&nbsp;</td>
			<td><input type="text" name="dpp_pph" id="dpp_pph" class="calculate" style="text-align:right;width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
	
	</tr>
	<tr>
			<td>Remark</td>
			<td>&nbsp;</td>
			<td><textarea name="remark" id="remark" class="validate[required] xinput"  size="65"  style="width:205px;padding:3px;border:1px solid #cbcbcb"/></textarea></td>		
			
			<td colspan=3>&nbsp;</td>
			<td>Total</td>
			<td>&nbsp;</td>
			<td><input type="text" name="nett" id="nett" readonly="true" class="calculate" style="background:#E8E8E8;text-align:right;width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
	</tr>

	<tr>
			<td colspan=6 style="padding-top:5px">
			<input type="submit" value="Save" id="save"/>
			<input type="reset" value="Cancel" id="cancel"/>
			</td>
	</tr>
</table>

<div id="jurnal" style="width:100%;height:334px;margin-top:5px;overflow:auto">
<table class="datatable" style="width:100%">
	<tr height="25px" style="background:gray;color:white">
		<th align="center">COA</th>
		<th align="center">Account Name</th>
		<th align="center">Debet</th>
		<th align="center">Kredit</th>
	</tr>
	<tr id="r1">
		<td align="center"><input type="text" name="acc_dr_1" id="acc_dr_1" class="get_addcoaacno1 mytextbox" style="width:100%"></td>
		<td align="center"><input type="text" name="acc_name_1" id="acc_name_1" class="auto-add_name1 mytextbox" style="width:100%"></td>
		<td align="right"><input type="text" name="acc_debet_1" id="acc_debet_1" style="text-align:right;width:100%" class="mytextbox calculate" value=0></td>
		<td align="center"><input type="text" name="acc_credit_1" id="acc_credit_1" style="text-align:right;width:100%" class="mytextbox calculate"></td>
	</tr>
	<tr id="r2">
		<td align="center"><input type="text" name="acc_dr_2" id="acc_dr_2" class="get_addcoaacno2 mytextbox" style="width:100%"></td>
		<td align="center"><input type="text" name="acc_name_2" id="acc_name_2" class="auto-add_name2 mytextbox" style="width:100%"></td>
		<td align="right"><input type="text" name="acc_debet_2" id="acc_debet_2" style="text-align:right;width:100%" class="mytextbox calculate"></td>
		<td align="center"><input type="text" name="acc_credit_2" id="acc_credit_2" style="text-align:right;width:100%" class="mytextbox calculate" value=0></td>
	</tr>
	<tr id="r3">
		<td align="center"><input type="text" name="acc_dr_3" id="acc_dr_3" class="get_addcoaacno3 mytextbox" style="width:100%"></td>
		<td align="center"><input type="text" name="acc_name_3" id="acc_name_3" class="auto-add_name3 mytextbox" style="width:100%"></td>
		<td align="right"><input type="text" name="acc_debet_3" id="acc_debet_3" style="text-align:right;width:100%" class="mytextbox calculate"></td>
		<td align="center"><input type="text" name="acc_credit_3" id="acc_credit_3" style="text-align:right;width:100%" class="mytextbox calculate" value=0></td>
	</tr>
	<tr id="r4">
		<td align="center"><input type="text" name="acc_dr_4" id="acc_dr_4" class="get_addcoaacno4 mytextbox" style="width:100%"></td>
		<td align="center"><input type="text" name="acc_name_4" id="acc_name_4" class="auto-add_name4 mytextbox" style="width:100%"></td>
		<td align="right"><input type="text" name="acc_debet_4" id="acc_debet_4" style="text-align:right;width:100%" class="mytextbox calculate" value=0></td>
		<td align="center"><input type="text" name="acc_credit_4" id="acc_credit_4" style="text-align:right;width:100%" class="mytextbox calculate"></td>
	</tr>

	<tbody id="itemlist"></tbody>
	<tr height="25px">
		<td align="center"><input type="text" id="acc_dr" class="get_addcoaacno mytextbox" style="width:100%"></td>
		<td align="center"><input type="text" id="acc_name" class="auto-add_name mytextbox" style="width:100%"></td>
		<td align="right"><input type="text" id="acc_debet" style="text-align:right;width:100%" class="mytextbox calculate"></td>
		<td align="center"><input type="text" id="acc_credit" style="text-align:right;width:100%" class="mytextbox calculate"></td>
	</tr>
	<tr height="25px">
		<td align="center" colspan=2>&nbsp;</td>
		<td align="right"><input type="text" id="total_debet" style="text-align:right;background:lightgray;width:100%" class="mytextbox calculate"></td>
		<td align="center"><input type="text" id="total_credit" style="text-align:right;background:lightgray;width:100%" class="mytextbox calculate"></td>
	</tr>
		<!--tr>
		<td align="center" colspan=2>&nbsp;</td>
		<td align="right"><input type="text" id="acc_debet_5" style="text-align:right;background:#D2E6F5" class="mytextbox calculate"></td>
		<td align="center"><input type="text" id="acc_credit_5" style="text-align:right;background:#D2E6F5" class="mytextbox calculate"></td>
	</tr-->
</table>

<script type="text/javascript"> 
	function clear(){
		$("#acc_dr").val("");
		$("#acc_name").val("");
		$("#acc_debet").val("");
		$("#acc_credit").val("");
	}
	
	
	$("tbody#itemlist").on("click","#hapus",function(){
		$(this).parent().parent().remove();
		var debval  = $(".getdeb_value").map(function(){ return $(this).val();}).toArray(); console.log(debval);
		var total_debval = 0;
		for (var i = 0; i < debval.length; i++) {
			total_debval += parseInt(debval[i].replace(/,/g,''));
		}
		
		var credval  = $(".getcred_value").map(function(){ return $(this).val();}).toArray(); console.log(credval);
		var total_credval = 0;
		for (var i = 0; i < credval.length; i++) {
			total_credval += parseInt(credval[i].replace(/,/g,''));
		}
		
		
	});
		
		// enter invoice_ap
		var num = 0;
		//var sd = $("#total_debet").val().replace(/,/g,'');
		//var sc = $("#total_credit").val().replace(/,/g,'');
		$('#acc_credit').on('keypress', function(e) { 
		var a = 1;
		if(e.keyCode==13){
			e.preventDefault();
			var acc_dr 	 = $("#acc_dr").val();
			var acc_name 	 = $("#acc_name").val();

			var acc_debet 	 = $("#acc_debet").val().replace(/,/g,'');
			if (acc_debet == '') { acc_debet = 0; } else {acc_debet = parseInt($("#acc_debet").val().replace(/,/g,''));};

			var acc_credit	 = $("#acc_credit").val().replace(/,/g,'');
			if (acc_credit == '') {acc_credit = 0;} else {acc_credit = parseInt($("#acc_credit").val().replace(/,/g,''));};
			
		
			var items = "";
			var sd = parseInt($("#total_debet").val().replace(/,/g,''));
			var sc = parseInt($("#total_credit").val().replace(/,/g,''));
			var total1 = sd+acc_debet;
			var total2 = sc+acc_credit;
			
			//alert(sd+" "+sc);
			$("#total_debet").val(numToCurr(total1));
			$("#total_credit").val(numToCurr(total2));
			num++;
			a++;
			
			items += "<tr id='get_mycoa' height='25px'>"; 
			items += "<td align='center'><input type='text' name='item[acc_dr][]'   	 id='item[acc_dr][]'   		class='detail_nilai get_coaacnoi"+num+" mytextbox' value='"+ acc_dr+ "'   width=''autocomplete='off'></td>";
			items += "<td align='center'><input type='text' name='item[acc_name][]'    id='item[acc_name][]'    class='detail_nilai mytextbox' value='"+ acc_name +"'    width='' ></td>";
			items += "<td align='right'><input type='text' name='item[acc_debet][]'   style='text-align:right' id='item[acc_debet][]'   class='detail_nilai mytextbox getdeb_value' value='"+ numToCurr(acc_debet) +"'    width='' ></td>";
			items += "<td align='center'><input type='text' name='item[acc_credit][]' style='text-align:right' id='item[acc_credit][]' 	class='detail_nilai mytextbox getcred_value' value='"+ numToCurr(acc_credit) +"' width=''></td>";
			items += "<td><a href='javascript:void(0);' id='hapus'><img src='<?=site_url('assets/img/attributes_delete_icon.png')?>' /></a></td>";
			items += "</tr>";
			var sa = $('#sa').val();
			$('#sa').val(parseInt(sa)+1);
			$("#acc_dr").focus();
			
			if ($("tbody#itemlist tr").length == 0)
			{
				$("#itemlist").append(items);
				clear();
			}else{
				var callback = checkList(acc_dr);
				if(callback === true){ 
					$("#itemlist").append(items);
					clear();
					return false;
				}
			}
			
		}
		
	});
		
	function checkList(val){ 
		var cb = true;
		console.log($(acc_dr).val());
	
		$("#itemlist tr").each(function(index){
			var input = $(this).find("input[type='hidden']:first");
			if (input.val() == $(acc_dr).val()){
				cb = false;
			}
		});
		return cb;
	}

</script>
</div>			
</body>
</form>


