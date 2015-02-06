<html>
<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/icon.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" />

<!--script language="javascript" src="<?=base_url()?>assets/js/jquery-1.7.2.min.js"></script-->
<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.edatagrid.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>



<script language="javascript">
	$(function(){
		$.validationEngineLanguage.allRules['ajaxValidateNip'] = {
			"url": "<?=site_url('tblkary/ceknip')?>",
	        "alertText": "*This name is already taken",
	        "alertTextOk": "This name is avaliable",
	        "alertTextLoad": "* Validating, please wait"
	     };
	     
		$('#formAdd')
		.validationEngine()
		.ajaxForm({
			success:function(response){
				alert(response);
				refreshTable();
				//$('#btnReset').click();
			}
		});
		
		$("#kode-search").click(function(){
					$("#kode-dialog").dialog({
						title:"Cari Kode buku", 
						resizable:false, 
						width:500, 
						height:250,
						show: 'drop',
						hide: 'scale',
						modal:true,
						close:function(){
							$(this).dialog('destroy');
						}
					});
					$("#tkodebuku").jqGrid({
					//url: 'json.php', //URL Tujuan Yg Mengenerate data Json nya
				//	datatype: "json", //Datatype yg di gunakan
					mtype: 'GET',
					colNames: ['Kode buku', 'Nama buku'],
					colModel: [
						    {name:'id', index:'id', width: 40, align:'center', sortable: true},
						    {name:'nama', index:'nama', align:'left', sortable: true}
						],
					rownumbers:true,
					rowNum:5,
					rowList:[5,10,15], 
					pager: '#pkodebuku',
					viewrecords: true,
					sortname: 'id',
					sortorder: "asc",
					width: 470,
					height: 'auto',
					caption: '&nbsp;',
					ondblClickRow: function(rowid) {
						var v = $("#tkodebuku").getRowData(rowid);
						id = v['id'];
						nama = v['nama'];
						$("#kode").val(id);
						$("#nama").val(id+' - '+nama);
						$("#kode-dialog").dialog('close');
					}
				      });
				      //$("#pkodebarang_left .navtable").empty();
				      //$("#tkodebarang").navGrid('#pkodebarang',{edit:false, add:false, del:false});
				      $("#tkodebuku").jqGrid('navGrid','#pkodebuku',{view:false,edit:false,add:false,del:false});
				      return false;
				});			
	});
	
	$('#cc').combogrid({  
        panelWidth:450,  
        value:'006',  
       
        idField:'acc_no',  
        textField:'acc_no',  
        url:'masterbank/loadcoa',  
        columns:[[  
            {field:'acc_no',title:'Acc No',width:150},  
            {field:'acc_name',title:'Name',width:250},  

        ]]  
    });  
	

</script>
<body>
	<form name="form1" id="form1" method="post" action="">
<table>
	<tr>
		<td colspan='3'><font color='red'><b>INPUT BANK MASTER</b></font></td>
		<td colspan='3'>&nbsp;</td>
	</tr>
	<tr>
		<td>Bank Name</td>
			<td>:</td>
			<td><input type="text" name="bank_nm" id="bank_nm" class="validate[required] xinput" xinput" value="<?=@$data->bank_nm?>" class="validate[required]" size="30" /></td>
	</tr>
	
	<tr>
		<td>Bank Branch</td>
			<td>:</td>
			<td><input type="text" name="bank_cabang" class="validate[required] xinput" id="bank_cabang" value="<?=@$data->bank_cabang?>"  size="30" /></td>
	</tr>
	<tr>
		<td>Account</td>
			<td>:</td>
			<td><input type="text" name="bank_acc" class="validate[required] xinput" id="bank_acc" value="<?=@$data->bank_acc?>"  size="30" /></td>
	</tr>
	<tr>
		<td>Acc No</td>
			<td>:</td>
			<td><select id="cc" name="bank_coa" size="80" ></select> </td>
			
	</tr>
	<tr>
		<td>Acc No2</td>
			<td>:</td>
			<td><input type="text" name="bank_acc2" class="validate[required] xinput" id="bank_acc2"   size="30" />
			<button id="kode-search" class="tombol">&nbsp;</button>
			</td>
			
	</tr>
	<tr>
		<td>Remark</td>
			<td>:</td>
			<td><input type="text" name="remark" class="validate[required] xinput" id="remark" value="<?=@$data->remark?>"  size="30" /></td>
	</tr>
	<tr>	
		<td></td>
		<td></td>
		<td>
			<!--<input type="hidden" name="bank_id" value="<?=@$data->bank_id?>" />
			<input type="hidden" name="kary_id" value="<?=@$kl->kary_id?>" />
			
			<input type="submit" name="submit" id="submit" value="Simpan" />
			<input type="button" id="btnClose" value="Batal" />-->
		</td>
	</tr>
	</table>
</form>
	<div id="result">
		<?php
			if(isset($_POST["submit"]))
			{
				echo "Nama Barang : ".$_POST["nama"]."<br />";
				echo "Qty Barang : ".$_POST["qty"]."<br />";
				echo "Harga Barang : ".$_POST["harga"]."<br />";
			}
		?>
	</div>
		
		<!-- Untuk Dialog yg akan munculkan dari Tombol Search Kode -->
		<div id="kode-dialog" class="" style="display: none; font-size: 10pt">
			<table id="tkodebuku" class="scroll" cellpadding="0" cellspacing="0"></table> 
			<div id="pkodebuku" class='ui-widget-header ui-corner-bl ui-corner-br' style="margin-top:0px;"></div>
		</div>
			</body>
</html>
