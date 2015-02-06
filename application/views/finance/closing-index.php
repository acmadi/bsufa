<?php
$session_id = $this->UserLogin->isLogin();
$level = $session_id['level_id'];
$user = $session_id['username'];
$grid_data = str_replace('"numberFormat"','numberFormat',$grid_data);
$grid_data = str_replace('"cellColumn"','cellColumn',$grid_data);
?>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.5.2.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/i18n/grid.locale-en.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.jqGrid.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.jqGrid.src.js"></script>


<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	
});	

function generateGrid(gridData,moduleURL,width,height){
	return $('#mytable').jqGrid(gridData)
		.navGrid('#pager',{edit:false,add:false,del:false,search:false})	
		.navButtonAdd('#pager',{
		   caption:"Closing", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				popupForm(moduleURL + '/closingf/?width='+0+'&height='+0);
				refreshTable();
				alert('Berhasil');
				refreshTable();
			 }else{
				 alert('Pilih Company yang akan Closing');
			 }
		   }, 
		   position:"last"
		})
		.navButtonAdd('#pager',{
		   caption:"UnClosing", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				popupForm(moduleURL + '/unclosingf/' + id + '/?width='+0+'&height='+0);
				
				refreshTable();
				alert('Unclosing Berhasil');
				refreshTable();
			 }else{
				 alert('Pilih Company yang akan Closing');
			 }
		   }, 
		   position:"last"
		})
		
}



</script>

<div align="center">
	<table id="mytable" class="scroll"></table>
	<div id="pager"></div>
</div>


