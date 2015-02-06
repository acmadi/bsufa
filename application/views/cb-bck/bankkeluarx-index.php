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
		
		

		
		// .navButtonAdd('#pager',{
		   // caption:"View", 
		   // buttonicon:"ui-icon-pencil", 
		   // onClickButton: function(){ 
			 // var id = getSelectedID();
			 // if(id){
				 // popupForm("<?=site_url($module_url)?>" + '/view/' + id + '/?width='+980+'&height='+350);
			 // }else{
				 // alert('Pilih baris yang ingin diedit2');
			 // }
		   // }, 
		   // position:"last"
		// })		
		
		// .navButtonAdd('#pager',{
		   // caption:"Tambah", 
		   // buttonicon:"ui-icon-plus", 
		   // onClickButton: function(){ 
			 // popupForm("<?=site_url($module_url)?>" + '/add/?width='+900+'&height='+400);
		   // }, 
		   // position:"last"
		// })
	// .navButtonAdd('#pager',{
		   // caption:"tes", 
		   // buttonicon:"ui-icon-plus", 
		   // onClickButton: function(){ 
			 // popupForm("<?=site_url($module_url)?>" + '/tes/?width='+900+'&height='+400);
		   // }, 
		   // position:"last"
		// })
	
 });



function generateGrid(gridData,moduleURL,width,height){
	return $('#mytable').jqGrid(gridData)
		.navGrid('#pager',{edit:false,add:false,del:false,search:false})
		.navButtonAdd('#pager',{
		   caption:"Payment", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
		    var id = getSelectedID();
			 if(id){
				 popupForm('<?php echo site_url();?>bankkeluarx/payment/' + id + '/?width='+900+'&height='+250);	
			 }else{
				 alert('Pilih data yang akan Payment');
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
				 window.open('<?php echo site_url();?>bankkeluarx/print_slip/' + id + '/?width='+900+'&height='+500);
			 }else{
				 alert('Pilih data yang akan di Print');
			 }
		   }, 
		   position:"last"
		})		
		.navButtonAdd('#pager',{
		   caption:"Payment Date", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url()?>" + 'bankkeluarx/pyd/' + id + '/?width='+900+'&height='+250);
			 }else{
				 alert('Pilih baris yang ingin di View');
			 }
		   }, 
		   position:"last"
		})
		.navButtonAdd('#pager',{
		   caption:"Paid Date", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url()?>" + 'bankkeluarx/paid/' + id + '/?width='+900+'&height='+250);	
			 }else{
				 alert('Pilih baris yang ingin di View');
			 }
		   }, 
		   position:"last"
		})
		/*.navButtonAdd('#pager',{
		   caption:"Approved", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm(moduleURL + '/approve/' + id + '/?width='+900+'&height='+250);	
			 }else{
				 alert('Pilih baris yang ingin di View');
			 }
		   }, 
		   position:"last"
		})*/
		

		
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
		var newVal = '<span class="customBg" style="background-color:#FF6600">'+cellVal+'</span>';
	else var newVal = cellVal;
	return newVal;
}

/*function cellColumn(cellVal,opts,element){
	var id = element.id_plan;
	//alert(id);
	$.getJSON('<?php echo site_url();?>cb/bankkeluarx/getidcash/'+id,function s(get){
	return get.status;
	
	//alert('a');
	});
	if(status == 0)
		var newVal = '<span class="customBg" style="background-color:#FFFFFF">'+cellVal+'</span>';
	else if(status == 1)
		var newVal = '<span class="customBg" style="background-color:#C1FFC1">'+cellVal+'</span>';
		else if(status == 2)
		var newVal = '<span class="customBg" style="background-color:#FFD5D5">'+cellVal+'</span>';
		else if(status == 3)
		var newVal = '<span class="customBg" style="background-color:#FF6600">'+cellVal+'</span>';
	else var newVal = cellVal;
	return newVal;
	}*/


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
			<td style="background-color:white;width:130px;height:25px" align="center">NOT PAYMENT</td>
			<td style="background-color:#C1FFC1;;width:130px;height:25px">PAYMENT</td>
			<td style="background-color:#FFD5D5;width:130px;height:25px" >PAYMENT CEK</td>
			<td style="background-color:#FF6600;;width:130px;height:25px">PAID</td>
			
		
			
		</tr>
</table>




</div>

