
<?=script('currency.js')?>
<?=script('jquery.validationEngine-enx.js')?>
<?=script('jquery.validationEnginex.js')?>
<?=script('jquery.formx.js')?>
<?#=script('jquery-1.7.2.min.js')?>
<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?=script('jquery.easyui.min.js')?>
<?=script('datagrid-detailview.js')?>
<?#=link_tag(CSS_PATH.'menuform.css')?>
<script type="text/javascript">
var kugiri = new RegExp(",", "g");
			
			$(".calculate").bind('keyup keypress',function(){
				$(this).val(numToCurr($(this).val()));
						parseInt($("#pph").val().replace(kugiri,""));
						
			});



$(function(){
		var kugiri = new RegExp(",", "g");
		$("#reftender").change(function(){
			$.getJSON('<?=site_url()?>/workinginst/getdata/' + $(this).val(),
			function(response){
				//$('#proj').val(response.project);
				$('#job').val(response.mainjob_desc);
				$('#bgt').val(response.nm_bgtproj);
				$('#amount').val(numToCurr(response.nilai_tender));
				$('#nama').val(response.nm_supplier);
				$('#alamat').val(response.alamat);
				$('#pic').val(response.kontak);
				$('#phone').val(response.telepon);
				$('#email').val('');
				$('#amcontr').val(numToCurr(response.nilai_tender));
				//$('#kontrak').val(numToCurr(response.nilai_tender));
			
			//var kontrak			= parseInt($('#kontrak').val().replace(rep_coma,""));
			//var ppnpersen	= parseInt($('#ppnpersen').val().replace(rep_coma,""));
			
			//var nilppn		= kontrak - (kontrak / 1.1) ;
			//var kontraknett = kontrak / 1.1;
			
			//$('#ppn').val(numToCurr(nilppn));
			//$('#kontraknett').val(numToCurr(kontraknett));
			
			});
			
			
			$.getJSON('<?=site_url()?>/workinginst/getproject/' + $(this).val(),
			function(response){
					//var tes = parseInt($('#tes').val(response.project);
					$('#project').val(response.subproject);	
				
				
				});
			
			
			
			
		});	
		
		var rep_coma = new RegExp(",", "g");
		
		
		
		
		
	
		$.fn.datebox.defaults.formatter = function(date) {
			var y = date.getFullYear();
			var m = date.getMonth() + 1;
			var d = date.getDate();
			return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
		};	
		
		/*$("#currency").change(function(){
			var amcontr = parseInt($('#amcontr').val().replace(kugiri,""));
			var ppn = amcontr * 0.1;
			$('#ppn').val(numToCurr(ppn));
		});	*/	

       
		$('input:radio').change(function(){	   
			if($('input:radio[name=top]:checked').val() == '1' ){
				$(".x_hide").hide();
				$("#retension").val(0);
				$("#progress").val(0);
				$("#dp").val(0);
			}else{
				$(".x_hide").show();
			}
	    });
	   
		$('#tgl_awal').datebox({  
			required:true  
		}); 
		
		$('#tgl_akhir').datebox({  
			required:true  
		});  		 	   
	   
		$('#formAdd')
		//.validationEngine()
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

			/*GRID EASY-UI*/
			$('#mr').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';
				},
				onExpandRow: function(index,row){
					var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
					var spk   = $("#spk").val();
					
								
					var nilai = parseInt($("#amount").val().replace(kugiri,""));
					
					ddv.panel({
						border:false,
						cache:true,
						href:"<?=site_url('spk/show_payform')?>/"+spk+"/"+nilai+"/?index="+index,
						onLoad:function(){
							$('#mr').datagrid('fixDetailRowHeight',index);
							$('#mr').datagrid('selectRow',index);
							$('#mr').datagrid('getRowDetail',index).find('form').form('load',row);
						}
					});
					$('#mr').datagrid('fixDetailRowHeight',index);
				}
			});
			/*END GRID*/
			
			/*ADD ROW GRID*/
			function newItemMr(){
				$('#mr').datagrid('appendRow',{isNewRecord:true});
					var index = $('#mr').datagrid('getRows').length - 1;
						$('#mr').datagrid('expandRow', index);
						$('#mr').datagrid('selectRow', index);
			}
			/*END ADD ROW GRID*/
			
			/*SAVE ROW GRID*/
			function saveItemMr(index){
			
			var row = $('#mr').datagrid('getRows')[index];
			var url = row.isNewRecord ? '<?=site_url('spk/save_payspk')?>' : '<?=site_url('spk/save_payspk')?>/'+row.id;
			$('#mr').datagrid('getRowDetail',index).find('form').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(data){
					data = eval('('+data+')');
					data.isNewRecord = false;
					$('#mr').datagrid('collapseRow',index);
					$('#mr').datagrid('updateRow',{
						index: index,
						row: data
					});
				}
			});
		}
			/*END ROW GRID*/
			
			/* CANCEL ROW GRID*/
			
			function cancelItemMr(index){
			var row = $('#mr').datagrid('getRows')[index];
				if (row.isNewRecord){
					$('#mr').datagrid('deleteRow',index);
				} else {
					$('#mr').datagrid('collapseRow',index);
				}
			}
			
			/*END CANCEL ROW GRID*/
			
			

</script>


<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('spk/save'), $attr);
?>
<div class="easyui-tabs" style="width:800px;height:350px;">
	<div title="Working Instruction" style="padding:10px;">
		<table border="0" width="750px">
			<td><input  type="hidden" style="width:150px" name="project"  id="project" ></td>
			<tr>
				<td  style="width:150px">Date</td><td><input type="text" name="tgl" value="<?=gettgl()?>" id="tgl" readonly="true" style="width:95px"/></td>
			</tr>
			<tr>
				<td>SPK.No</td><td><input type="text" name="spk" id="spk" style="width:220px" value="<?=$nospk?>" readonly="true"/></td>
			</tr>
			<tr>
				<td>Tender Reff</td>
				<td>
					<select name="reftender" id="reftender" style="width:220px">
						<option></option>
						<?php foreach($tender as $row): ?>
						<option value="<?=$row->id_tendeva?>"><?=$row->no_tendeva?></option>
						<?php endforeach; ?>
					</select>	
				</td>
			</tr>
			<!--tr>
				<td>Project.Nm</td>
				<td><input type="text" name="proj" id="proj" readonly="true"/></td>
			</tr-->
			<tr>
				<td>Mainjob</td>
				<td><input type="text" name="job" id="job" style="width:600px" readonly="true"/></td>
			</tr>
			<!--tr>
				<td>Budget.Nm</td>
				<td><input type="text" name="bgt" id="bgt" readonly="true"/></td>
			</tr-->	
			<tr>
				<td>Contract (Incl.Tax)</td>
				<td><input type="text" class="input" style="width:150px" name="amount" value="0" id="amount" readonly="true"/></td>
			</tr>
			<tr>
				<td>Start Date</td>
				<td><input type="text" name="tgl_awal" id="tgl_awal" readonly="true"/></td>
			</tr>
			<tr>
				<td>End Date</td>
				<td><input type="text" name="tgl_akhir" id="tgl_akhir" readonly="true"/></td>
			</tr>
																			
		</table> 
	</div>
	
	<div title="Payment" style="padding:10px;">	
			<table border="0" width="400">
			<tr>
					<td style="width:80px">Currency</td>
					<td>
						<select name="currency" id="currency" style="width:60px">
							<option></option>
							<option>IDR</option>
							<option>USD</option>
						</select>					
					</td colspan="3">
			</tr>
			
			
			
			
			<tr>
					<td>PPH</td>
					
					<td><input name="pph" id="pph" class="calculate input" style="width:30" value="0"> %</td>
			</tr>
			
			
						
			</table>
			
			<table id="mr" title="Payment Scheme" style="width:700px;height:250px"
				url="<?#=site_url('proposedbgt/get_mr')?>"
				toolbar="#toolbar2" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					
					<th field="top" width="25">Term Of Payment</th>
					<th field="persen" width="15" editor="numberbox">%</th>
					<th field="keterangan" width="70">Description</th>
				</tr>
			</thead>
		</table>
		<div id="toolbar2">
			<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItemMr()">Add</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyItemMr()">Delete</a>
		</div>
	</div>  
	<div title="Description" style="padding:10px;">	
		<table>
			<tr>
				<td><u>LINGKUP PEKERJAAN</td>
				
			</tr>
			<tr>
				<td ><textarea style="width:500px;height:100px" name='lingkup' id='lingkup'></textarea></tr>
			</tr>
			<tr>
				<td><u>JANGKA WAKTU PELAKSANAAN</td>
				
			</tr>
			<tr>
				<td colspan="6"><textarea style="width:500px;height:100px" name='jadwal' id='jadwal'></textarea></tr>
			</tr>
		
		</table>
	
	
	</div>
	
	<div title="Contractor" style="padding:10px;">	
			<table border="0" width="750">
				<tr>
					<td  style="width:95px">Name</td>
					<td><input type="text" name="nama" id="nama" readonly="true"/style="width:250px"></td>
				</tr>
				<tr>
					<td>Address</td>
					<td><input type="text" name="alamat" id="alamat" readonly="true"  style="width:500px"/></td>
				</tr>
				<tr>
					<td>PIC</td>
					<td><input type="text" name="pic" id="pic" readonly="true"  style="width:250px"/></td>
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
					<td colspan="2" ><b>Pihak I</b></td>
				</tr>
				<tr>
					<td style="width:95px">Name</td>
					<td><input type="text" name="nm1" id="nm1" style="width:250px"></td>
				</tr>
				<tr>
					<td>Position</td>
					<td>
						<select name="position1">
							<option>Direktur</option>
							<option>Project Manager</option>
						</select>						
					</td>
				</tr>
				<tr>
					<td colspan="2"><b>Pihak II</b></td>
				</tr>
				<tr>
					<td>Name</td>
					<td><input type="text" name="nm2" id="nm2" style="width:250px"/></td>
				</tr>
				<tr>
					<td>Position</td>
					<td>
						<select name="position2">
						<option>Direktur</option>
						<option>Project Manager</option>
						</select>
					</td>
				</tr>
			</table>		  
	</div>
</div>
	<input type="submit" name="save" id="save" value="Save"/>
	<input type="button" name="close" id="close" value="Close"/>
<?=form_close()?>
   
