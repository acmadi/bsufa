<?#=script('jquery-1.4.2.min.js')?>
<?=script('currency.js')?>
<?=script('jquery.validationEngine-enx.js')?>
<?=script('jquery.validationEnginex.js')?>
<?=script('jquery.formx.js')?>
<?#=script('jquery-1.7.2.min.js')?>
<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?=script('jquery.easyui.min.js')?>
<?#=link_tag(CSS_PATH.'menuform.css')?>
<script type="text/javascript">
$(function(){
		var kugiri = new RegExp(",", "g");
		$("#reftender").change(function(){
			$.getJSON('<?=site_url()?>/workinginst/getdata/' + $(this).val(),
			function(response){
				$('#proj').val(response.nm_subproject);
				$('#job').val(response.job);
				$('#bgt').val(response.nm_bgtproj);
				$('#amount').val(numToCurr(response.nilai_proposed));
				$('#nama').val(response.vendor_nm);
				$('#alamat').val(response.address);
				$('#pic').val(response.vendor_cont_name);
				$('#phone').val(response.vendor_hp);
				$('#email').val(response.vendor_email);
				$('#amcontr').val(numToCurr(response.nilai_tender));
			});
		});	
		
	
		$.fn.datebox.defaults.formatter = function(date) {
			var y = date.getFullYear();
			var m = date.getMonth() + 1;
			var d = date.getDate();
			return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
		};	
		
		$("#currency").change(function(){
			var amcontr = parseInt($('#amcontr').val().replace(kugiri,""));
			var ppn = amcontr * 0.1;
			$('#ppn').val(numToCurr(ppn));
		});		

       $("#pph").bind("keyup keypress",function(){
		   var amcontr = parseInt($("#amcontr").val().replace(kugiri,""));
		   var pph = parseInt($('#pph').val().replace(kugiri,""))/100;
		   var bfcontr = amcontr - (amcontr * pph);
		   
		   var dp = amcontr * 0.2;//parseInt($("#dp").val());
		   var progress = amcontr * 0.75;//parseInt($("#progress").val());
		   var retension = amcontr * 0.05;//parseInt($("#progress").val());
		   
		   $("#dp").val(numToCurr(dp));
		   $("#progress").val(numToCurr(progress));
		   $("#retension").val(numToCurr(retension));
		   $("#bfcontr").val(numToCurr(bfcontr))
		   
		   
		   
	   });
	   
		$('#tgl_awal').datebox({  
			required:true  
		}); 
		
		$('#tgl_akhir').datebox({  
			required:true  
		});  		 	   
	   
		$('#formAdd')
		.validationEngine()
		.ajaxForm({
			success:function(response){
				if(response=='sukses'){
					alert(response);
					refreshTable();
				}else{
					alert(response);
				}
			}
		});			   
	   
		
});

</script>


<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('workinginst/save'), $attr);
?>
<div class="easyui-tabs" style="width:900px;height:450px;">
	<div title="Working Instruction" style="padding:10px;">
		<table border="0" width="750px">
			<tr>
				<td>Date</td><td><input type="text" name="tgl" value="<?=gettgl()?>" id="tgl" readonly="true" style="width:95px"/></td>
			</tr>
			<tr>
				<td>SPK.No</td><td><input type="text" name="spk" id="spk" style="width:250px" value="<?=$nospk?>" readonly="true"/></td>
			</tr>
			<tr>
				<td>Tender Reff</td>
				<td>
					<select name="reftender" id="reftender">
						<option></option>
						<?php foreach($tender as $row): ?>
						<option value="<?=$row->id_tendeva?>"><?=$row->no_tendeva?></option>
						<?php endforeach; ?>
					</select>	
				</td>
			</tr>
			<tr>
				<td>Project.Nm</td>
				<td><input type="text" name="proj" id="proj" readonly="true"/></td>
			</tr>
			<tr>
				<td>Job</td>
				<td><input type="text" name="job" id="job" readonly="true"/></td>
			</tr>
			<tr>
				<td>Budget.Nm</td>
				<td><input type="text" name="bgt" id="bgt" readonly="true"/></td>
			</tr>	
			<tr>
				<td>Budget.Amount</td>
				<td><input type="text" class="input" name="amount" id="amount" readonly="true"/></td>
			</tr>
			<tr>
				<td>Start Date</td>
				<td><input type="text" name="tgl_awal" id="tgl_awal"/></td>
			</tr>
			<tr>
				<td>End Date</td>
				<td><input type="text" name="tgl_akhir" id="tgl_akhir"/></td>
			</tr>																	
		</table> 
	</div>
	
	<div title="Payment" style="padding:10px;">	
			<table border="0" width="400">
				<tr>
					<td>Currency</td>
					<td>
						<select name="currency" id="currency">
							<option></option>
							<option>IDR</option>
							<option>USD</option>
						</select>					
					</td>
				</tr>
				<tr>
					<td>Contract (Incl.Tax)</td>
					<td><input type="text" name="amcontr" id="amcontr" class="input" readonly="true"/></td>
				</tr>
				<tr>
					<td>PPN</td>
					<td><input type="text" name="ppn" id="ppn" class="input" readonly="true"/></td>
				</tr>
				<tr>
					<td>PPH</td>
					<td><input type="text" name="pph" id="pph" class="input" maxlength="1"/></td>
				</tr>
				<tr>
					<td>Contract (Excl.Tax)</td>
					<td><input type="text" name="bfcontr" class="input" id="bfcontr" readonly="true"/></td>
				</tr>
				<tr>
					<td>DP</td>
					<td><input type="text" name="dp" id="dp" readonly="true" class="input" readonly="true"/></td>
				</tr>
				<tr>
					<td>Progress</td>
					<td><input type="text" name="progress" id="progress" class="input" readonly="true"/></td>
				</tr>
				<tr>
					<td>Retension</td>
					<td><input type="text" name="retension" id="retension" class="input" readonly="true"/></td>
				</tr>				
			</table>

	</div>  
	
	<div title="Contractor" style="padding:10px;">	
			<table border="0" width="750">
				<tr>
					<td>Name</td>
					<td><input type="text" name="nama" id="nama" readonly="true"/></td>
				</tr>
				<tr>
					<td>Address</td>
					<td><input type="text" name="alamat" id="alamat" readonly="true"/></td>
				</tr>
				<tr>
					<td>PIC</td>
					<td><input type="text" name="pic" id="pic" readonly="true"/></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td><input type="text" name="phone" id="phone" readonly="true"></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input type="text" name="email" id="email" readonly="true"></td>
				</tr>
			</table>
	</div>
	
	<div title="Signing" style="padding:10px;">
			<table border="0" width="750">
				<tr>
					<td colspan="2"><b>Pihak I</b></td>
				</tr>
				<tr>
					<td>Name</td>
					<td><input type="text" name="nm1" id="nm1"></td>
				</tr>
				<tr>
					<td>Position</td>
					<td>
						<select name="position1">
							<option>DIRECTOR</option>
							<option>PROJECT MANAGER</option>
						</select>						
					</td>
				</tr>
				<tr>
					<td colspan="2"><b>Pihak II</b></td>
				</tr>
				<tr>
					<td>Name</td>
					<td><input type="text" name="nm2" id="nm2"/></td>
				</tr>
				<tr>
					<td>Position</td>
					<td>
						<select name="position2">
						<option>DIRECTOR</option>
						<option>PROJECT MANAGER</option>
						</select>
					</td>
				</tr>
			</table>		  
	</div>
</div>
	<input type="submit" name="save" id="save" value="Save"/>
	<input type="button" name="close" id="close" value="Close"/>
<?=form_close()?>
   
