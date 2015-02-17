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
		
		

 });



function generateGrid(gridData,moduleURL,width,height){
	return $('#mytable').jqGrid(gridData)
		.navGrid('#pager',{edit:false,add:false,del:false,search:false})
		.navButtonAdd('#pager',{
		   caption:"Add", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			 popupForm("<?=site_url()?>"  + 'ap/apinvoice/add/?width='+1100+'&height='+600);
			// myWindow=window.open("<?=site_url()?>" + '/apinvoice-input/' , '_parent' , '/?width='+750+'&height='+700);
		   }, 
		   position:"last"
		})
		
		.navButtonAdd('#pager',{
		   caption:"Man", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
		   
			 popupForm(moduleURL + '/tam/?width='+1080+'&height='+450);
			// myWindow=window.open("<?=site_url()?>" + '/apinvoice-input/' , '_parent' , '/?width='+750+'&height='+700);
		   }, 
		   position:"last"
		})
		
		/*
		.navButtonAdd('#pager',{
		   caption:"Appr", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm(moduleURL + '/update/' + id + '/?width='+1000+'&height='+550);	
			 }else{
				 alert('Pilih baris yang ingin di Approved');
			 }
		   }, 
		   position:"last"
		})
*/ 
		.navButtonAdd('#pager',{
		   caption:"AP Cust", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
				popupForm(moduleURL + '/apcust/?width='+1100+'&height='+550);	
		   }, 
		   position:"last"
		})
		
		.navButtonAdd('#pager',{
		   caption:"Multi", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
				popupForm("<?=site_url()?>"  + 'ap/apinvoice/apmulti/?width='+1100+'&height='+600);	
		   }, 
		   position:"last"
		})
		
		.navButtonAdd('#pager',{
		   caption:"Print", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 window.open("<?=site_url($module_url)?>" + '/print_slip/' + id + '/?width='+900+'&height='+500);
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
				 popupForm(moduleURL + '/viewss/' + id + '/?width='+1000+'&height='+550);	
			 }else{
				 alert('Pilih baris yang ingin diedit');
			 }
		   }, 
		   position:"last"
		})
		

		
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
		var newVal = '<span class="customBg" style="background-color:yellow">'+cellVal+'</span>';
	else var newVal = cellVal;
	return newVal;
}

</script>

<style>
.customBg{
	display:block;
	margin-height:-4px;
	margin-left:-2px;
	height: 17px;
	padding: 5px;
}
.customBg2{
	display:block;
	margin-height:-2px;
	margin-left:-2px;
	height: 14px;
	padding: 4px;
}
</style>
<div align="center" style="overflow:auto">
	<table id="mytable" class="scroll"></table>
	<div id="pager"></div>
</div>
<br>
<br>
<div style="left">
<table >
		<tr>
			<td style="background-color:white;width:130px;height:25px" align="center">NOT APPROVED</td>
			<td style="background-color:#00FF00;;width:130px;height:25px">APPROVED</td>
			<td style="background-color:#FFD5D5;width:130px;height:25px" >CASH PLANNING</td>
			<td style="background-color:#808080;;width:130px;height:25px">PAID</td>
			
		
			
		</tr>
</table>




</div>

