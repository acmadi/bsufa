<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css" />

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
	});
	//Mempercantik Button dengan Jquery UI
	// $("#kode-search").button({icons: {primary: "ui-icon-search"}, text: false });
	
	// /* End */
	 
	// $("#kode-search").click(function(){
	// $("#kode-dialog").dialog({
	// title:"Cari Kode buku",
	// resizable:false,
	// width:500,
	// height:250,
	// show: 'drop',
	// hide: 'scale',
	// modal:true,
	// close:function(){
	// $(this).dialog('destroy');
	// }
	// });
	// $("#tkodebuku").jqGrid({
	// url: 'json.php', //URL Tujuan Yg Mengenerate data Json nya
	// datatype: "json", //Datatype yg di gunakan
	// mtype: 'GET',
	// colNames: ['Kode buku', 'Nama buku'],
	// colModel: [
	// {name:'id', index:'id', width: 40, align:'center', sortable: true},
	// {name:'nama', index:'nama', align:'left', sortable: true}
	// ],
	// rownumbers:true,
	// rowNum:5,
	// rowList:[5,10,15],
	// pager: '#pkodebuku',
	// viewrecords: true,
	// sortname: 'id',
	// sortorder: "asc",
	// width: 470,
	// height: 'auto',
	// caption: '&nbsp;',
	// ondblClickRow: function(rowid) { //Event Double Click Row Table Untuk Select Data
	// var v = $("#tkodebuku").getRowData(rowid);
	// id = v['id'];
	// nama = v['nama'];
	// $("#kode").val(id);
	// $("#nama").val(id+' - '+nama);
	// $("#kode-dialog").dialog('close');
	// }
	// });
	// //$("#pkodebarang_left .navtable").empty();
	// //$("#tkodebarang").navGrid('#pkodebarang',{edit:false, add:false, del:false});
	// $("#tkodebuku").jqGrid('navGrid','#pkodebuku',{view:false,edit:false,add:false,del:false});
	// return false;
	// });
	// });

</script>

<form id="formAdd" action="<?=site_url()?>trxtype/input" method="post" >
<table>
	<tr>
		<td colspan='3'><font color='red'><b>INPUT TRANSAKSI TYPE</b></font></td>
		<td colspan='3'>&nbsp;</td>
	</tr>
	<tr>
		<td>Trx Type</td>
			<td>:</td>
			<td><input type="text" name="trx_type" id="trx_type" class="validate[required] xinput" xinput" value="<?=@$data->trx_type?>" class="validate[required]" size="30" /></td>
	</tr>
	<tr>
		<td>Description</td>
			<td>:</td>
			<td><input type="text" name="descs" id="descs" class="validate[required] xinput" xinput" value="<?=@$data->descs?>" class="validate[required]" size="30" /></td>
	</tr>
	<tr>
	<td>Mode</td>
			<td>:</td>
	<td>
	<select name='select'>
	<option value='D'>Debet</option>
	<option value='C'>Credit</option>
	</select>
	</td>
	</tr>
	<tr>
	
	
		<td></td>
		<td></td>
		<td>
			<input type="hidden" name="trxtype_id" value="<?=@$data->trxtype_id?>" />
					
			<input type="submit" value="Simpan" />
			<input type="button" id="btnClose" value="Batal" />
		</td>
	</tr>
	</table>
</form>

