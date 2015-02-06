<?php //var_dump($data);?>
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

<? 	
	$w1 = "style='width:25%'"; 
	$w2 = "style='width:30%'"; 
	$w3 = "style='width:15%'"; 
	$w4 = "style='width:15%'"; 
	$w5 = "style='width:10%'";
	$w6 = "style='width:5%'";	
?>

<?php
	/* Query Row Detail*/
	$sql_rd = "select * from db_apcndetail where id_dbapcnheader = '".$data->id_apcnheader."'";
	$row_rd = $this->db->query($sql_rd)->result();
?>
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
		minLength: 1
	});
	
	/* autocomplete get value edit */
	<?php $f=1; foreach($row_rd as $p):?>
	$( ".get_coaacno<?=$f?>" ).autocomplete({
		source: function(request, response) {
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_coaacno",
				data: { term: $(".get_coaacno<?=$f?>").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 1
	});
	<?php $f++; endforeach;?>
	
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
			url		: '<?=site_url();?>creditnote/update_creditnote',
			type	: 'post',
			data	: {'id'    :<?=@$data->id_apcnheader;?>,
					   'header':header,
					   'detail':detail
			},
			success	: function(data){
				alert(data);
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
.border-one{
	border-bottom:ridge;
	border-left:ridge;
	border-right:ridge;
	border-top:ridge;
	border-right-width:3px;
	border-left-width:3px;
	
}
</style>	
	
	<form action="<?=site_url();?>creditnote/save_creditnote"  method="post">
		<div >
			<table  border="0" width="50%" align="left">
				<tr>
					<td>No. Credit Note</td>
					<td>:</td>
					<td><input type="text" name="no_cn" id="no_cn" class="validate[required] xinput header_nilai" style="background-color:#EFFC94" readonly="true" size="30" value="<?=@$data->no_cn;?>"/></td>
				</tr>
				<tr>
					<td>Creditor A/C</td>
					<td>:</td>
					<td><input type="text" name="creditor_ac" id="creditor_ac" class="get_creditorac header_nilai"  size="30" value="<?=@$data->nm_supplier;?>"/></td>
					    <input type="hidden" class="id_creditorac header_nilai" value="<?=@$data->kd_supplier;?>"> <!-- kd_supplier -->
				</tr>
				<tr>
					<td>Credit Date</td>
					<td>:</td>
					<td>
						<input type="text" name="credit_date" id="credit_date" class="validate[required] xinput header_nilai" size="30" value="<?=@$data->date_cn;?>" />
						<a href="JavaScript:;" onClick="return showCalendar('credit_date', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
					</td> 
				</tr>
			</table>
			
			<table  border="0" width="50%">
				<tr>
					<td>Reff No.</td>
					<td>:</td>
					<td><input type="text" name="ref_no" id="ref_no" class="validate[required] xinput header_nilai"  size="30" value="<?=@$data->ref_cn;?>" /></td>
				</tr>
				<tr>
					<td>Description</td>
					<td>:</td>
					<td><input type="text" name="description" id="description" class="validate[required] xinput header_nilai" size="30" value="<?=@$data->description;?>" /></td>
				</tr>
				<tr>
					<td>Amount</td>
					<td>:</td>
					<td><input type="text" name="amount" id="amount" class="validate[required] xinput header_nilai"  size="30" value="<?=@$data->amount;?>"/></td>
				</tr>
			</table>
			<hr>
			<br>
		</div>
		<table cellspacing=0 cellpadding=0 width="100%" style="font-family:Verdana;font-size:10px;font-style:normal">
			<tr bgcolor="#FFCC99" height="35px">
				<th class="border-one" <?=$w1?>>AC No</th>
				<th class="border-one" <?=$w2?>>Description</th>
				<th class="border-one" <?=$w3?>>Flag</th>
				<th class="border-one" <?=$w4?>>Ammount</th>
				<th class="border-one" <?=$w5?>>Tax</th>
				<th bgcolor="#EBF5FB" <?=$w6?>>&nbsp;</th>
			</tr>
			
			<?php			
			$n=1;
			foreach($row_rd as $r):
			?>
			<tr id="datalist">
				<td align="center" <?=$w1?>><input style="" type="text"   name="ac_no"   id="" class="detail_nilai get_coaacno<?=$n;?> border-one" size="40" value="<?=$r->ac_no;?>"></td>
				<td align="center" <?=$w2?>><input style="" type="text"   name="desc"    id="" class="detail_nilai border-one" size="49" value="<?=$r->description;?>"></td>
				<td align="center" <?=$w3?>><input style="" type="text"   name="flag"    id="" class="detail_nilai border-one" size="22" align="right" value="<?=$r->flag;?>"/></td>
				<td align="center" <?=$w4?>><input style="" type="text"   name="amounts" id="" class="detail_nilai border-one" size="22" align="right" value="<?=$r->amount;?>"/></td>
				<td align="center" <?=$w5?>><input style="" type="text"   name="tax"     id="" class="detail_nilai border-one" size="13" align="right" value="<?=$r->tax;?>"/></td>
				<td <?=$w6?>><a href='javascript:void(0);' id='get_deleteid' myvalue="<?=$r->id_dbapcndetail;?>"><img src='<?=site_url('assets/img/attributes_delete_icon.png')?>' /></a></td>
			</tr>
			<?php $n++;endforeach;?>
			
			<tbody id="itemlist"></tbody>
			
			<tr>
				<td align="center" <?=$w1?>><input style="" type="text" name="ac_no"   id="ac_no"    class="get_coaacno border-one" size="40"></td>
				<td align="center" <?=$w2?>><input style="" type="text" name="desc"    id="desc"     class="border-one" size="49"></td>
				<td align="center" <?=$w3?>><input style="" type="text" name="flag"    id="flag"     class="border-one" size="22" align="right"/></td>
				<td align="center" <?=$w4?>><input style="" type="text" name="amounts" id="amounts"  class="border-one" size="22" align="right"/></td>
				<td align="center" <?=$w5?>><input style="" type="text" name="tax"     id="tax"      class="border-one" size="13" align="right"/></td>
				<td <?=$w6?>>&nbsp;</td>
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
		
		$("tr#datalist").on("click","#get_deleteid",function(){
			var a = confirm('hapus data ?');
			if(a==false){
				return false;
			}else{
				$(this).parent().parent().hide();
				var c = this.getAttribute("myvalue");
				$.ajax({
					url		: '<?php echo site_url();?>creditnote/delete_detail',
					type	: 'post',
					data	: {'c':c},
					success	: function(data){}
				});
			}
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
				items += "<td <?=$w1?>><input type='text' name='item[ac_no][]'   id='item[ac_no][]'   class='detail_nilai get_coaacno2 border-one' value='"+ ac_no+ "'   width='' size='40' autocomplete='off'></td>";
				items += "<td <?=$w2?>><input type='text' name='item[desc][]'    id='item[desc][]'    class='detail_nilai border-one' value='"+ desc +"'    width='' size='49'></td>";
				items += "<td <?=$w3?>><input type='text' name='item[flag][]'    id='item[flag][]'    class='detail_nilai border-one' value='"+ flag +"'    width='' size='22'></td>";
				items += "<td <?=$w4?>><input type='text' name='item[amounts][]' id='item[amounts][]' class='detail_nilai border-one' value='"+ amounts +"' width='' size='22'></td>";
				items += "<td <?=$w5?>><input type='text' name='item[tax][]' 	 id='item[tax][]'     class='detail_nilai border-one' value='"+ tax +"' 	width='' size='13'></td>";
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
