<?php
$session_id = $this->UserLogin->isLogin();
$grid_data = str_replace('"numberFormat"','numberFormat',$grid_data);
$grid_data = str_replace('"cellColumn"','cellColumn',$grid_data);
?>

<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	grid.navButtonAdd('#pager',{
		   caption:"Search", 
		   buttonicon:"ui-icon-search", 
		   onClickButton: function(){ 
			 grid.jqGrid('searchGrid');
		   }, 
		   position:"last"
		})
		
	function cellColumn(cellVal,opts,element){
	if(element.status == 1)
		var newVal = '<span class="customBg" style="background-color:#C1FFC1">'+cellVal+'</span>';
		else if(element.status == 2)
		var newVal = '<span class="customBg" style="background-color:#FFD5D5">'+cellVal+'</span>';
	else var newVal = cellVal;
	return newVal;
}
	/*.navButtonAdd('#pager',{
		   caption:"Print", 
		   buttonicon:"ui-icon-print", 
		   onClickButton: function(){ 
			 var field = $('select[name=field] option:selected').val();
			 var oper = $('select[name=op] option:selected').val();
			 var str = $('input.vdata').val();
			 var url = '<?=site_url('print/tblkary')?>'
			 if(field)
			 //?field='+field+'&oper='+oper+'&str='+str;
			 //alert(url);
			 url+= '?field='+field+'&oper='+oper+'&str='+str;
			 window.open(url);
		   }, 
		   position:"last"
		})*/
});



function generateGrid(gridData,moduleURL,width,height){
	return $('#mytable').jqGrid(gridData)
		.navGrid('#pager',{edit:false,add:false,del:false,search:false})
		.navButtonAdd('#pager',{
		   caption:"Add", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			 popupForm(moduleURL + '/add/?width='+1100+'&height='+530);
			// myWindow=window.open("<?=site_url()?>" + '/datagrid2/' , '_parent' , '/?width='+750+'&height='+700);
		   }, 
		   position:"last"
		})
		.navButtonAdd('#pager',{
		   caption:"Approved", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm(moduleURL + '/update/' + id + '/?width='+1000+'&height='+550);
				//refreshTable();

	
			 }else{
				 alert('Pilih baris yang ingin di Approve');
			 }
		   }, 
		   position:"last"
		})
		.navButtonAdd('#pager',{
		   caption:"Print", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 window.open("<?=site_url($module_url)?>" + '/print_slip/' + id + '/?width='+800+'&height='+250);
			 }else{
				 alert('Pilih data yang akan di Print');
			 }
		   }, 
		   position:"last"
		})		
		
		.navButtonAdd('#pager',{
		   caption:"Edit", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm(moduleURL + '/view/' + id + '/?width='+1000+'&height='+550);
				//refreshTable();

	
			 }else{
				 alert('Pilih baris yang ingin di Edit');
			 }
		   }, 
		   position:"last"
		})
		// .navButtonAdd('#pager',{
		   // caption:"View", 
		   // buttonicon:"ui-icon-search", 
		   // onClickButton: function(){ 
			 // var id = getSelectedID();
			 // if(id){
				 // popupForm(moduleURL + '/view/' + id + '/?width='+750+'&height='+525);
			 // }else{
				 // alert('Pilih Karyawan yang ingin diview');
			 // }
		   // }, 
		   // position:"last"
		// });
		/*.navButtonAdd('#pager',{
		   caption:"Hapus", 
		   buttonicon:"ui-icon-trash", 
		   onClickButton: function(){ 
			 if(confirm('Hapus data ini?')){
				 var id = getSelectedID(); 
				 if(id){	
					 $.get(moduleURL + '/delete/' + id,
						function(response){
							if(response == 'success'){
								refreshTable();
							}else{
								alert('Hapus data gagal');
							}
						}
					 );
				 }else{
					 alert('Pilih Data yang ingin diedit');
				 }
			 }
		   }, 
		   position:"last"
		});*/
}
function getSelectedID(){
	var selRow = $('#mytable').getGridParam('selrow');
	if(selRow != ''){
		var id = false;
		$.each($("#mytable").getRowData(selRow),function(key,value){
			if(id == false)
				id = value;
		});		 
		return id;
	}else{
		return false;
	}
}
function popupForm(moduleURL){
	$('#popupForm').attr('href',moduleURL).click();
}
function refreshTable(){
	$('#mytable').trigger('reloadGrid');
	tb_remove();
}

</script>
<style>
.customBg{
	display:block;
	margin-height:-2px;
	margin-left:-2px;
	height: 14px;
	padding: 4px;
}
.customBg2{
	display:block;
	margin-height:-2px;
	margin-left:-2px;
	height: 14px;
	padding: 4px;
}
</style>
<div align="center">
	<table id="mytable" class="scroll"></table>
	<div id="pager"></div>
</div>
<br>
<br>
<div style="left">
<table >
		<tr>
			<td style="background-color:white;width:130px;height:25px" align="center">NOT APPROVED</td>
			<td style="background-color:#C1FFC1;;width:130px;height:25px">APPROVED</td>
		</tr>
</table>




</div>
