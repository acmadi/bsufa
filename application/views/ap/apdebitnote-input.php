<?=script('currency.js')?>	
<link href="<?=site_url()?>assets/css/validationEngine.jquery.css" rel="stylesheet" type="text/css">
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEngine-en.js"></script>
<link rel="stylesheet" type="text/css" href="<?=site_url()?>assets/css/jquery-ui-1.8.7.custom.css">
<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'styletable.css')?>
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
$(document).ready(function(){
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
		var c = confirm('Apakah Anda yakin?');
		if(c==false){
			return false;
		}
		var header		 = $(".header_nilai").map(function(){ return $(this).val();	}).get();
		var detail	     = $(".detail_nilai").map(function(){ return $(this).val();	}).get();
		$("#loading_proses").html('<b><i>sedang proses!!</i></b><br><img src="<?php echo site_url(); ?>assets/images/loadingAnimation.gif"/>');
		$(".hideByproses").hide();
		
		$.ajax({
			url		: '<?=site_url();?>creditnote/save_creditnote',
			type	: 'post',
			data	: {'header':header,
					   'detail':detail
			},
			success	: function(data){
				$("#no_cn").val(data);
				$("#loading_proses").html('');
				$(".hideByproses").show();
				alert("Success");
			}
		});
		
	});
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
	
	<form action="<?=site_url();?>creditnote/save_creditnote"  method="post">
		<div >
			<table  border="0" width="50%" align="left">
				<tr>
					<td>No. Credit Note</td>
					<td>:</td>
					<td><input type="text" name="no_cn" id="no_cn" class="validate[required] xinput mytextbox" style="background-color:#EFFC94" readonly="true" size="30" /></td>
				</tr>
				<tr>
					<td>Creditor A/C</td>
					<td>:</td>
					<td><input type="text" name="creditor_ac" id="creditor_ac" class="get_creditorac"  size="30" /></td>
					    <input type="hidden" class="id_creditorac header_nilai"> <!-- kd_supplier -->
				</tr>
				<tr>
					<td>Credit Date</td>
					<td>:</td>
					<td>
						<input type="text" name="credit_date" id="credit_date" class="validate[required] xinput header_nilai" size="30" />
						<a href="JavaScript:;" onClick="return showCalendar('credit_date', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
					</td> 
				</tr>
			</table>
			
			<table  border="0" width="50%">
				<tr>
					<td>Reff No.</td>
					<td>:</td>
					<td><input type="text" name="ref_no" id="ref_no" class="validate[required] xinput header_nilai"  size="30" /></td>
				</tr>
				<tr>
					<td>Description</td>
					<td>:</td>
					<td><input type="text" name="description" id="description" class="validate[required] xinput header_nilai" size="30" /></td>
				</tr>
				<tr>
					<td>Amount</td>
					<td>:</td>
					<td><input type="text" name="amount" id="amount" class="validate[required] xinput header_nilai"  size="30" /></td>
				</tr>
			</table>
			<hr>
			<br>
		</div>
		
		<table class="" width="100%" style="font-family:Verdana;font-size:11px;font-style:normal">
			<tr bgcolor="#FFCC99" height="35px">
				<th <?=$w1?>>AC No</th>
				<th <?=$w2?>>Description</th>
				<th <?=$w3?>>Flag</th>
				<th <?=$w4?>>Ammount</th>
				<th <?=$w5?>>Tax</th>
				<th bgcolor="#EBF5FB" <?=$w6?>>&nbsp;</th>
			</tr>
		</table>
		
		<div style="height:290px;overflow:auto">
		
		<table class="" width="100%" style="font-family:Verdana;font-size:11px;font-style:normal">
			<tbody id="itemlist"></tbody>
		</table>
		<table class="" width="100%" style="font-family:Verdana;font-size:11px;font-style:normal">
			<tr>
				<td <?=$w1?>><input style="" type="text" name="ac_no"   id="ac_no"    class="detail_nilai" size="29"></td>
				<td <?=$w2?>><input style="" type="text" name="desc"    id="desc"     class="detail_nilai" size="30"></td>
				<td <?=$w3?>><input style="" type="text" name="flag"    id="flag"     class="detail_nilai" size="29" align="right"/></td>
				<td <?=$w4?>><input style="" type="text" name="amounts" id="amounts"  class="detail_nilai" size="30" align="right"/></td>
				<td <?=$w5?>><input style="" type="text" name="tax"     id="tax"      class="detail_nilai" size="20" align="right"/></td>
				<td <?=$w6?>>&nbsp;</td>
			</tr>
		</table>
		
		</div>
				
		<div style="margin-top:10px">
			<span class="hideByproses">
			<input type="button" name="tombol" value="Save" class="saving button-click"/>
			<input type="button" name="tombol" value="Close" class="button-click"/>
			</span>
			<span id="loading_proses"></span>
		</div>
	</form>
	
	<script type="text/javascript"> 
				
		function clear(){
			$("#ac_no").val("");
			$("#desc").val("");
			$("#flag").val("");
			$("#amounts").val("");
			$("#tax").val("");
		}
		
		$("tbody#itemlist").on("click","#hapus",function(){
			$(this).parent().parent().remove();
		});
			
			// enter invoice_ap
			$('#tax').on('keypress', function(e) { 
			if(e.keyCode==13){
				e.preventDefault();
				var ac_no 	 = $("#ac_no").val();
				var desc 	 = $("#desc").val();
				var flag 	 = $("#flag").val();
				var amounts	 = $("#amounts").val();
				var tax 	 = $("#tax").val();
				
				var items = "";
				
				items += "<tr >"; 
				items += "<td <?=$w1?>><input readonly='true' type='text' name='item[ac_no][]'   id='item[ac_no][]'   class='detail_nilai' value='"+ ac_no+ "'  width='' size='29'></td>";
				items += "<td <?=$w2?>><input readonly='true' type='text' name='item[desc][]'    id='item[desc][]'    class='detail_nilai' value='"+ desc +"'   width='' size='30'></td>";
				items += "<td <?=$w3?>><input readonly='true' type='text' name='item[flag][]'    id='item[flag][]'    class='detail_nilai' value='"+ flag +"'   width='' size='29'></td>";
				items += "<td <?=$w4?>><input readonly='true' type='text' name='item[amounts][]' id='item[amounts][]' class='detail_nilai' value='"+ amounts +"' width='' size='30'></td>";
				items += "<td <?=$w5?>><input readonly='true' type='text' name='item[tax][]' 	 id='item[tax][]'     class='detail_nilai' value='"+ tax +"' 	  width='' size='20'></td>";
				items += "<td <?=$w6?>><a href='javascript:void(0);' id='hapus'><img src='<?=site_url('assets/img/attributes_delete_icon.png')?>' /></a></td>";
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
