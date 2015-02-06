<!--script type="text/javascript" src="<?php echo site_url();?>assets/js/jquery-1.8.2.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script-->
<script type="text/javascript" src="<?php echo site_url();?>assets/js/jquery-ui.js"></script>
<?=script('jquery.formx.js')?>
<?=script('currency.js')?>
<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" />
<script type="text/javascript">
	$(document).ready(function() {
		$.fn.datebox.defaults.formatter = function(date) {
			var y = date.getFullYear();
			var m = date.getMonth() + 1;
			var d = date.getDate();
			return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
		};	
		
		$('#inv_date').datebox({  
			required:true  
		});

		$('#ap_date').datebox({  
			required:true  
		});

		$('.calculate').bind('keyup keypress',function(){
			$(this).val(numToCurr($(this).val()));
		});

		//autocomplete customer
		$( ".auto-complete-cus" ).autocomplete({
			source: function(request, response) {
					$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_cus",
					data: { term: $(".auto-complete-cus").val().replace(/ /g,''),idprojek: $("#idproject").val()},
					dataType: "json",
					type: "POST",
					success: function(data){
						response(data);
					}
				});
			},
			select: function (event, ui) {
				var id = ui.item.id;
				$(".id-complete-cus").val(id);
			},
			minLength: 1
		});

		$("#idproject").change(function(){
				var v = $("#idproject").val();
				$(".idpro").val(v);
		});
		$(".auto-complete-cus").bind("keyup click blur focus",function(){
			var idp = $(".idpro").val();
			var idc = $(".id-complete-cus").val();
			$.post("<?php echo base_url(); ?>ap/apinvoice/get_unitcus/"+idp+"/"+idc,{},function(obj){
				$('#pilih_unit').html(obj);
			});
		});
		$("#pilih_unit").change(function(){
			var c = $("#pilih_unit").val();
			$.post("<?php echo base_url(); ?>ap/apinvoice/get_billingcus/"+c,{},function(obj){
				$('#billing_cus').html(obj);
			});
		});
		
		$('#billing_cus').change(function(){
			var c = $('#billing_cus').val();
			$.ajax({
				url		: '<?=site_url();?>ap/apinvoice/get_bankname',
				type	: 'post',
				data	: {'c':c},
				success	: function(data){
					$("#bank_nama").val(data)
					
				}
			});
			$.ajax({
				url		: '<?=site_url();?>ap/apinvoice/get_paid',
				type	: 'post',
				data	: {'c':c},
				success	: function(data){
					$("#paid").val(data)
					
				}
			});
		});
		//end autocomplete customer

		$('#invamt').bind('keyup keypress',function(){
			$('#total').val(numToCurr($('#invamt').val()));
			/*var a = parseInt($('#paid').val());
			var b = parseInt($('#invamt').val());
			var c = a + b;
			if (c > ) {
				alert("");
			};*/
		});
		
	});
</script>

<form method="post" action="<?php echo base_url();?>ap/apinvoice/savecustomer">
	<table>

		<tr>
			<h2>AP INVOICE Customer</h2>
		</tr>

		<tr>
			<td>Project</td>
			<td>&nbsp;</td>
			<td><select name="idproject" id="idproject" style="width:214px;padding:3px;border:1px solid #cbcbcb">
				<option> -- Pilih Project -- </option>
				<?php foreach ($project as $row) {?>
					<option value="<?php echo $row->subproject_id;?>"> <?php echo $row->nm_subproject;?> </option>
				<?php } ?>
			</select></td>
			<td>Invoice NO</td>
			<td>&nbsp;</td>
			<td><input type="text" name="inv_no" style="width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
			<td>Pph</td>
			<td>&nbsp;</td>
			<td><input type="checkbox" id="cekpph" onclick="fieldpph()"/></td>
		</tr>

		<tr>
			<!--td>Tipe</td>
			<td>&nbsp;</td>
			<td><input type="text" style="width:205px;padding:3px;border:1px solid #cbcbcb" value="Customer" readonly/></td-->
			<td>Invoice Date</td>
			<td>&nbsp;</td>
			<td><input type="text" name="inv_date" id="inv_date" style="width:214px"/></td>
			<td>Pph Type</td>
			<td>&nbsp;</td>
			<td><select name="pph_type" id="pph_type" style="width:214px;padding:3px;border:1px solid #cbcbcb">
				<option selected> -- Pilih PPH -- </option>
				<?php
					foreach ($pph as $row) {
						echo "<option value=".$row->id_coa."> ".$row->acc_name." </option>";
					}
				?>
			</select></td>
		</tr>

		<tr>
			<td>AP Date</td>
			<td>&nbsp;</td>
			<td><input type="text" name="ap_date" id="ap_date" style="width:214px"/></td>
			<td>Due date</td>
			<td>&nbsp;</td>
			<td><select name="due" style="width:214px;padding:3px;border:1px solid #cbcbcb">
				<option value="10">10 Days</option>
				<option value="30">30 Days</option>
				<option value="14">14 Days</option>
				<option value="6">6 Days</option>
			</select></td>
			<td>PPH Value</td>
			<td>&nbsp;</td>
			<td><input type="number" step="any" name="pph_value" id="pph_value" style="text-align:right;width:205px;padding:3px;border:1px solid #cbcbcb"/> % </option>
			</select></td>
		</tr>

		<tr>
			<td>Nama Customer</td>
			<td>&nbsp;</td>
			<td><input type="text" class="auto-complete-cus" style="width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
			<input type="hidden" name="id-complete-cus" class="id-complete-cus">
			<input type="hidden" class="idpro"/>
			<td>Invoice Amount</td>
			<td>&nbsp;</td>
			<td><input type="text" name="inv_amount" id="invamt" class="calculate" style="text-align:right;width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
			<td>DPP PPH</td>
			<td>&nbsp;</td>
			<td><input type="text" name="dpp_pph" id="dpp_pph" class="calculate" style="text-align:right;width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
		</tr>

		<script type="text/javascript">
			$(document).ready(function() {
				document.getElementById('dpp_ppn').disabled = true;
				document.getElementById('pph_type').disabled = true;
				document.getElementById('pph_value').disabled = true;
				document.getElementById('dpp_pph').disabled = true;
			});
			function fieldppn() {
				if (document.getElementById('cekppn').checked) {
		            document.getElementById('dpp_ppn').disabled = false;
		            var invppn = parseInt($('#invamt').val().replace(/,/g,''));
		            var pn = invppn*10/110;
		            var totalnett = invppn - pn;
		            $('#dpp_ppn').val(numToCurr(pn));
		            $('#total').val(numToCurr(invppn));
		        } else {
		        	document.getElementById('dpp_ppn').disabled = true;
		        	var invppn = parseInt($('#invamt').val().replace(/,/g,''));
		        	$('#total').val(numToCurr(invppn));
		        	$('#dpp_ppn').val('');
		        }
			}

			function fieldpph(){
				if (document.getElementById('cekpph').checked) {
					document.getElementById('pph_type').disabled = false;
					document.getElementById('pph_value').disabled = false;
					document.getElementById('dpp_pph').disabled = false;
					var invppn = parseInt($('#invamt').val().replace(/,/g,''));
					if (document.getElementById('cekppn').checked == true) {
						var pn = invppn*10/110;
						var ph = invppn - pn;
						$('#dpp_pph').val(numToCurr(ph));
					} else {
						$('#dpp_pph').val(numToCurr(invppn));
					}
				} else {
					document.getElementById('pph_type').disabled = true;
					document.getElementById('pph_value').disabled = true;
					document.getElementById('dpp_pph').disabled = true;	
					$('#dpp_pph').val('');
					$('#pph_value').val('');
				}
			}
		</script>

		<tr>
			<td>Unit</td>
			<td>&nbsp;</td>
			<td><select name="unit" id="pilih_unit" style="width:214px;padding:3px;border:1px solid #cbcbcb">
				<option value=""> -- Pilih Unit -- </option>
			</select></td>
			<td>Ppn</td>
			<td>&nbsp;</td>
			<td><input type="checkbox" id="cekppn" onclick="fieldppn()"/></td>
			<td>Total Nett</td>
			<td>&nbsp;</td>
			<td><input type="text" name="total" id="total"  style="text-align:right;background-color : #D7DF01;width:205px;padding:3px;border:1px solid #cbcbcb" readonly/></td>
		
		</tr>

		<tr>
			<td>Billing</td>
			<td>&nbsp;</td>
			<td><select name="billing" id="billing_cus" style="width:214px;padding:3px;border:1px solid #cbcbcb">
				<option value=""> -- Pilih Billing -- </option>
			</select></td>
			<td>Dpp Ppn</td>
			<td>&nbsp;</td>
			<td><input type="text" name="dpp_ppn" id="dpp_ppn" style="text-align:right;width:205px;padding:3px;border:1px solid #cbcbcb" readonly/></td>
			
		</tr>
		<tr>
			<td>Paid</td>
			<td>&nbsp;</td>
			<td><input type="text" name="paid" id="paid" style="text-align:right;width:205px;padding:3px;border:1px solid #cbcbcb" readonly/></td>
		</tr>
		<tr>
			<td>Bank Name</td>
			<td>&nbsp;</td>
			<td rowspan=2><textarea width="100%" name="bank_nama" id="bank_nama" style="height:44px;width:205px;padding:3px;border:1px solid #cbcbcb"></textarea></td>
			<td>Remark</td>
			<td>&nbsp;</td>
			<td rowspan=2><textarea width="100%" name="remark" id="remark" style="height:44px;width:205px;padding:3px;border:1px solid #cbcbcb"></textarea></td>
			
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan=3></td>
			
		</tr>

		<tr>
			<td colspan=3>&nbsp;</td>
			
		</tr>

		<tr>
			<td><input type="button" id="jurnalcustomer" value="View Jurnal"/></td>
		</tr>

		<script type="text/javascript">
			$('#jurnalcustomer').click(function() {
				if($("#cekppn").prop('checked') == true){
					var ppn = $("#dpp_ppn").val();
				}else{
					var ppn = "0";
				}
				if($("#cekpph").prop('checked') == true){
					var othpph = $("#pph_type").val()+"-+-+-"+$("#dpp_pph").val();
					var percen_pph = $("#pph_value").val();
					var dpp_pph = $("#dpp_pph").val();
				}else{
					var othpph = "0";
					var percen_pph = "0";
				}
				var suppl  = $(".auto-complete-cus").val();
				var kredit = $("#invamt").val();
				$("custjurnal_view").load('<?php echo site_url();?>ap/apinvoice/customerjurnal_view/'+suppl.replace(/ /g,'++--++')+'/'+kredit+'/'+ppn+'/'+othpph+'/'+percen_pph+'/'+dpp_pph+'');
			});
		</script>

		<tr colspan=2>
			<td><input type="submit" value="Save"/></td>
			<td><input type="reset" value="Reset"/></td>
		</tr>

	</table>

	<custjurnal_view></custjurnal_view>
</form>