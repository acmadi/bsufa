<?php
$session_id = $this->UserLogin->isLogin();
$level = $session_id['level_id'];
$grid_data = str_replace('"numberFormat"','numberFormat',$grid_data);
$grid_data = str_replace('"cellColumn"','cellColumn',$grid_data);
?>

<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	grid
	
	<? if($level == 5){?>
	.navButtonAdd('#pager',{
		   caption:"Print", 
		   buttonicon:"ui-icon-print", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 var myGrid = $('#mytable'),
			selRowId = myGrid.jqGrid ('getGridParam', 'selrow'),
			celValue = myGrid.jqGrid ('getCell', selRowId, 'id_print');
			
			if(celValue==1){
			  window.open("<?=site_url()?>" + '/kwtbill/reprintkwt/'  + id + '/?width='+650+'&height='+400);
			  }  else if (id) {		
				window.open("<?=site_url()?>" + '/kwtbill/reprintkwt/'  + id + '/?width='+650+'&height='+400);
				}
			  else{
				  alert('Pilih baris yang ingin di cetak');
				  }
			 
			 // if(id){
				 // window.open("<?=site_url()?>" + '/kwtbill/reprintkwt/' + id);
			 // }else{
				 // alert('Pilih baris yang ingin diedit');
			 // }
		   }, 
		   position:"last"
		})
	<? } ?>	
	<? if($level != 5){?>
	.navButtonAdd('#pager',{
		   caption:"Print", 
		   buttonicon:"ui-icon-print", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 var myGrid = $('#mytable'),
			selRowId = myGrid.jqGrid ('getGridParam', 'selrow'),
			celValue = myGrid.jqGrid ('getCell', selRowId, 'id_print');
			
			if(celValue==1){
			 popupForm("<?=site_url()?>" + '/kwtbill/reprintkwt/'  + id + '/?width='+650+'&height='+400);
			  }  else if (id) {		
				window.open("<?=site_url()?>" + '/kwtbill/reprintkwt/'  + id + '/?width='+650+'&height='+400);
				}
			  else{
				  alert('Pilih baris yang ingin di cetak');
				  }
			 
			 // if(id){
				 // window.open("<?=site_url()?>" + '/kwtbill/reprintkwt/' + id);
			 // }else{
				 // alert('Pilih baris yang ingin diedit');
			 // }
		   }, 
		   position:"last"
		})
	<? } ?>	
		<?
			$session_id = $this->UserLogin->isLogin();
			$this->pt_id = $session_id['id_pt'];
			$pt = $this->pt_id;
		
			if($pt == 44 || $pt == 66){?>
	
		.navButtonAdd('#pager',{
		   caption:"Receipt", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 window.open("<?=site_url()?>" + '/kwtbill/receipt/' + id + '/?width='+750+'&height='+700);
			 }else{
				 alert('Pilih baris yang ingin diedit');
			 }
		   }, 
		   position:"last"
		})
		<?}ELSE{?>
				.navButtonAdd('#pager',{
		   caption:"Receipt", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 var myGrid = $('#mytable'),
			selRowId = myGrid.jqGrid ('getGridParam', 'selrow'),
			celValue = myGrid.jqGrid ('getCell', selRowId, 'kwtbill_no');
			 if(id){
				 window.open("<?=site_url()?>" + '/kwtbill/receipt/' + celValue + '/?width='+750+'&height='+700);
			 }else{
				 alert('Pilih baris yang ingin diedit');
			 }
		   }, 
		   position:"last"
		})
		<?}?>

		.navButtonAdd('#pager',{
		   caption:"Void", 
		   buttonicon:"ui-icon-cancel", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url($module_url)?>" + '/update/' + id + '/?width='+750+'&height='+400);
			 }else{
				 alert('Pilih baris yang mau di Cancel');
			 }
		   }, 
		   position:"last"
		})	
	
		.navButtonAdd('#pager',{
		   caption:"Kwitansi", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			// alert(id);
		 var myGrid = $('#mytable'),
			selRowId = myGrid.jqGrid ('getGridParam', 'selrow'),
			celValue = myGrid.jqGrid ('getCell', selRowId, 'kwtbill_no');
			 if(id){
				 window.open("<?=site_url()?>" + '/kwtbill/kwitansi_new/' + id + '/?width='+750+'&height='+700);
			 }else{
				 alert('Pilih baris yang ingin di print');
			 }
		   }, 
		   position:"last"
		})
	.navButtonAdd('#pager',{
		   caption:"Search", 
		   buttonicon:"ui-icon-search", 
		   onClickButton: function(){ 
			 grid.jqGrid('searchGrid');
		   }, 
		   position:"last"
		})

});

function cellColumn(cellVal,opts,element){
	if(element.flag_id == 1)
		var newVal = '<span class="customBg" style="background-color:#C1FFC1">'+cellVal+'</span>';
		else if(element.flag_id == 0)
		var newVal = '<span class="customBg" style="background-color:#FFD5D5">'+cellVal+'</span>';
	else var newVal = cellVal;
	return newVal;
}

function numberFormat(cellVal,opts,element){
	if(element.flag_id == 0)
		var newVal = '<span class="customBg" style="background-color:#FFD5D5">'+numToCurr(element.amount)+'</span>';
	else if(element.flag_id == 1)
		var newVal = '<span class="customBg" style="background-color:#C1FFC1">'+numToCurr(element.amount)+'</span>';
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


