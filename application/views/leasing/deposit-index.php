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
			 popupForm(moduleURL + '/add/?width='+750+'&height='+200);
		   }, 
		   position:"last"
		})
		.navButtonAdd('#pager',{
		   caption:"Edit", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm(moduleURL + '/update/' + id + '/?width='+750+'&height='+200);
			 }else{
				 alert('Pilih baris yang ingin diedit');
			 }
		   }, 
		   position:"last"
		})
		// .navButtonAdd('#pager',{
		   // caption:"Closing", 
		   // buttonicon:"ui-icon-pencil", 
		   // onClickButton: function(){ 
		// //	 var id = getSelectedID();
		// //	 if(id){
				 // popupForm(moduleURL + '/close/' + '/?width='+750+'&height='+200);
		// //	 }else{
		// //		 alert('Pilih baris yang ingin diedit');
		// //	 }
		   // }, 
		   // position:"last"
		// })
		
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

function cellColumn(cellVal,opts,element){
	if(element.status == 1)
		var newVal = '<span class="customBg" style="background-color:#C1FFC1">'+cellVal+'</span>';
		else if(element.status == 2)
		var newVal = '<span class="customBg" style="background-color:#FFD5D5">'+cellVal+'</span>';
		else if(element.status == 3)
		var newVal = '<span class="customBg" style="background-color:#808080">'+cellVal+'</span>';
	else var newVal = cellVal;
	return newVal;
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
