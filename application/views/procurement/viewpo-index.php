<?php
$session_id = $this->UserLogin->isLogin();
$grid_data = str_replace('"cellColumn"','cellColumn',$grid_data);
$level = $session_id['level_id']; 
?>

<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	grid.navButtonAdd('#pager',{
		   caption:"Print", 
		   buttonicon:"ui-icon-print", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 window.open("<?=site_url($module_url)?>" + '/printpo/' + id + '/?width='+900+'&height='+400);
			 }else{
				 alert('Pilih baris yang ingin diedit');
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



function cellColumn(cellVal,opts,element){
	var newVal = '<span class="customBg" style="background-color:#00FFFF">'+cellVal+'</span>';	
	return newVal;

}	

	
		
});
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
	<div id="pager" style="height:35px"></div>
</div>

