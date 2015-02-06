<?=script('currency.js')?>	
<link href="<?=site_url()?>assets/css/validationEngine.jquery.css" rel="stylesheet" type="text/css">
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEngine-en.js"></script>
<link rel="stylesheet" type="text/css" href="<?=site_url()?>assets/css/jquery-ui-1.8.7.custom.css">
<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'styletable.css')?>
<?=script('jquery.easyui.min.js')?>
<?=script('currency.js')?>

<script src="<?=base_url()?>assets/js/jquery-ui.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
		
	$('.calculate').bind('keyup keypress',function(){
			
			$(this).val(numToCurr($(this).val()));
		
		});		
	
	/* sG */
	$( ".get_coaacno" ).autocomplete({
		source: function(request, response) {
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_coaacno",
				data: { term: $(".get_coaacno").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
					
				}
			});
		},
		select: function (event, ui) {
			var id 	  = ui.item.id;
			$(".get_coaname").val(id);
			
			event.preventDefault();
			var value = ui.item.value.replace(/ /g,'');
			var coa = value.split('|');
			$(".get_coaacno").val(coa[0]); 
		},
		minLength: 1
	});
	
	$( ".get_subledger" ).autocomplete({
		source: function(request, response) {
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_subledger",
				data: { term: $(".get_subledger").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		select: function (event, ui) {
			var id 	  = ui.item.id;
			$.post("<?php echo base_url(); ?>autocomplete/get_apno/"+id,{},function(obj){
				$('.get_apno').html(obj);
			});
		},
		minLength: 1
	});
	$(".get_apno").change(function(){
		var c = $(".get_apno").val();
		
		// get base_amout
		$.ajax({
			url		: '<?php echo site_url();?>autocomplete/get_baseamt',
			type	: 'post',
			data	: {'c':c},
			success	: function(data){
				$(".get_invap").val(data);
				
				//get APNO <option>
				$.ajax({
					url		: '<?php echo site_url();?>autocomplete/gettemp_apno',
					type	: 'post',
					data	: {'c':c},
					success	: function(data){
						$("#temp_apno").val(data);
					}
				});
			}
		})
	});
	
	//total_debval
	/* eG */
	
	
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
		select: function (event, ui) {
			var id 	  = ui.item.id;
			$(".get_coanamei<?=$f;?>").val(id);
			
			event.preventDefault();
			var value = ui.item.value.replace(/ /g,'');
			var coa = value.split('|');
			$(".get_coaacnoi<?=$f;?>").val(coa[0]);
		},
		minLength: 1
	});
	
	$( ".get_subledgeri<?=$f;?>" ).autocomplete({
		source: function(request, response) {
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_subledger",
				data: { term: $(".get_subledgeri<?=$f;?>").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		select: function (event, ui) {
			var id 	  = ui.item.id;
			$.post("<?php echo base_url(); ?>autocomplete/get_apno/"+id,{},function(obj){
				$('.get_apnoi<?=$f;?>').html(obj);
			});
			$(".get_invap").val("");
		},
		minLength: 1
	});
	
	});
	<?php } ?>
});
			
</script>			
<style>
.button-click{
	background: #FF7C26;
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
<form id="formAdd" method="post" action='<?=site_url('adjustment/saveheader')?>'>
	<?php $tgl = date('d-m-Y'); ?>
	<body>
	<table  border="0">
				<tr>
				<td colspan=3><h2>Memorial Journal</h2></td>
				</tr><tr>
				<td colspan=3>&nbsp</td>
				</tr>
				<tr>
					<td>Journal No.</td>
					<td>:</td>
					<td><input type="text" name="voucher" id="voucher" class="validate[required] xinput mytextbox" value="<?=$nogl?>" style="width:110px;background-color:#EFFC94" readonly="true" size="30" /></td>
				</tr>
				<tr>
					<td>Date</td>
					<td>:</td>
					<td><input id="voucher_date" name="voucher_date" class="easyui-datebox readonly mytextbox" value="<?=$tgl?>" size="30" style="width:110px;background-color:#EFFC94" readonly="true"></input></td>	
				</tr>
				<tr>
				<td>Project</td>
				<td>:</td>
				<td>
					<select name="project_detail" id="project_detail" class="val_project_detail mytextbox">
					<option>-</option>
					<? foreach($project_detail as $row): ?>
					<option value="<?=@$row->subproject_id?>"><?=@$row->nm_subproject?></option> 
					<? endforeach;?>
					</select>  
				</td>	
				</tr>
				<tr>
					<td>descs</td>
					<td>:</td>
					<!-- td><input type="text" name="remark" id="remark" class="val_descs" value="<?=@$data->remark?>"  size="80" /></td-->
					<td><input type="text" name="remark" id="remark" class="val_descs mytextbox"  size="120" class="validate[required text-input"/></td>
				</tr>
			</table>
	<hr>
	<br>

		<div style="height:290px;overflow:auto">
		<table cellspacing=0 cellpadding=0 width="100%" border="0" class="datatable">
			<tr>
				<td><input type="hidden" id="temp_apno"></td>
			</tr>
			<tr height="25px">
				<th align="center">Account No</th>
				<th align="center">Account Name </th>
				<th align="center">Sub Ledger</th>
				<th align="center">AP No</th>
				<th align="center">Invoice AP</th>
				<th align="center">Debet</th>
				<th align="center">Credit</th>
			</tr>
						
				<tbody id="itemlist"></tbody>
				
				<tr>
					<td align="center"><input style="" type="text" name="ac_no"   	  id="ac_no"      class="mytextbox_small get_coaacno "></td>
					<td align="center"><input style="" type="text" name="ac_name" 	  id="ac_name"    class="mytextbox_big get_coaname"></td>
					<td align="center"><input style="" type="text" name="sub_ledger"  id="sub_ledger" class="mytextbox_big get_subledger"/></td>
					<td align="center">
						<select name="ap_no" id="ap_no" class="mytextbox_medium get_apno">
							<option>Pilih No AP</option>
						</select>
					</td>
					<td align="center"><input style="" type="text" name="inv_ap"      id="inv_ap"     class="mytextbox_medium get_invap" align="right"/></td>
					<td align="center"><input style="" type="text" name="deb_val"     id="deb_val"    class="mytextbox_small get_debval" align="right" value=0 /></td>
					<td align="center"><input style="" type="text" name="cred_val"    id="cred_val"   class="mytextbox_small get_credval" align="right" value=0 /></td>
					<td>&nbsp;</td>
				</tr>
		</table>
		</div>
		<table>
			<tr>
				<td colspan="2"> <b>GRAND TOTAL </b></td>
				<td><input type="text" id="total_debet" style="text-align:right;background-color:#EFFC94" class="mytextbox calculate" readonly></td>
				<td><input type="text" id="total_credit" style="text-align:right;background-color:#EFFC94" class="mytextbox calculate" readonly></td>
			</tr>
		</table>
		<div style="margin-top:10px">
			<span class="hideByproses">
			<input type="button" name="tombol" value="Save" class="saving button-click"/>
			<input type="button" name="tombol" value="Close" class="button-click"/>
			</span>
			<span id="loading_proses"></span>
		</div>
	</form>
	
	<script type="text/javascript">
		$(document).ready(function() {
		
			/* Total & jumlah Debetz */
			$('.get_debval').bind('keyup keypress',function(event) { $(this).val(numToCurr($(this).val()));

				var debval  = $(".get_debval").map(function(){ return $(this).val();}).toArray(); console.log(debval);
				var total_debval = 0;
				for (var i = 0; i < debval.length; i++) {
					total_debval += parseInt(debval[i].replace(/,/g,''));
				}
				$("#total_debet").val(numToCurr(total_debval));
			});
			
			/* Total & jumlah KRediTz */
			$('.get_credval').bind('keyup keypress',function(event) { $(this).val(numToCurr($(this).val()));
				
				var credval  = $(".get_credval").map(function(){ return $(this).val();}).toArray(); console.log(credval);
				var total_credval = 0;
				for (var i = 0; i < credval.length; i++) {
					total_credval += parseInt(credval[i].replace(/,/g,''));
				}
				$("#total_credit").val(numToCurr(total_credval));
			});		

		});
	</script>
	
	<script type="text/javascript"> 
				
		function clear(){
			$("#ac_no").val("");
			$("#ac_name").val("");
			$("#sub_ledger").val("");
			$("#ap_no").val("");
			$("#temp_apno").val("");
			$("#inv_ap").val("");
			$("#deb_val").val(0);
			$("#cred_val").val(0);
		}
		
		$("tbody#itemlist").on("click","#hapus",function(){
			$(this).parent().parent().remove();
		});
			
			// enter invoice_ap
			var num = 0;
			$('#cred_val').on('keypress', function(e) { 
			if(e.keyCode==13){
				e.preventDefault();
				var ac_no 	 	= $("#ac_no").val();
				var ac_name 	= $("#ac_name").val();
				var sub_ledger 	= $("#sub_ledger").val();
				
				var ap_no	 	= $("#ap_no").val();	 //id(value)
				var ap_no_op	= $("#temp_apno").val(); //option
				$.post("<?php echo base_url(); ?>autocomplete/get_apno/",{},function(obj){ $('.get_apno').html(obj);});
				
				var inv_ap 	 	= $("#inv_ap").val();
				var deb_val  	= $("#deb_val").val();
				var cred_val 	= $("#cred_val").val();
				
				var items = "";
				num++;
				
				items += "<tr id='get_mycoa'>"; 
				items += "<td><input type='text' name='item[ac_no][]'		id='item[ac_no][]'   	class='get_coaacnoi"+num+" mytextbox_small' value='"+ ac_no+ "'   width=''autocomplete='off'></td>";
				items += "<td><input type='text' name='item[ac_name][]'    	id='item[ac_name][]'    class='get_coanamei"+num+" mytextbox_big' value='"+ ac_name +"'></td>";
				items += "<td><input type='text' name='item[sub_ledger][]'  id='item[sub_ledger][]' class='get_subledgeri"+num+" mytextbox_big' value='"+ sub_ledger +"'></td>";
				items += "<td><select name='ap_no' id='item[ap_no][]' class='mytextbox_medium get_apnoi"+num+"'><option value="+ ap_no +">"+ ap_no_op +"</option></select></td>";
				items += "<td><input type='text' name='item[inv_ap][]' 		id='item[inv_ap][]' 		class='mytextbox_medium' value='"+ inv_ap +"' ></td>";
				items += "<td><input type='text' name='item[deb_val][]' 	id='item[deb_val][]'    class='mytextbox_small get_debval' value='"+ deb_val +"'></td>";
				items += "<td><input type='text' name='item[cred_val][]' 	id='item[cred_val][]'   class='mytextbox_small get_credval' value='"+ cred_val +"'></td>";
				items += "<td><a href='javascript:void(0);' id='hapus'><img src='<?=site_url('assets/img/attributes_delete_icon.png')?>' /></a></td>";
				items += "</tr>";
				
				$("#ac_no").focus();
				
				if ($("tbody#itemlist tr").length == 0)
				{
					$("#itemlist").append(items);
					clear();
				}else{
					var callback = checkList(ac_no);
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
			console.log($(ac_no).val());
		
			$("#itemlist tr").each(function(index){
				var input = $(this).find("input[type='hidden']:first");
				if (input.val() == $(ac_no).val()){
					cb = false;
				}
			});
			return cb;
		}
	</script>
	
</div>
