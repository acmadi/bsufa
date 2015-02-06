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
	//grid.jqGrid('inlineNav',"#pager");
	grid.navButtonAdd('#pager',{
		   caption:"Input", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			 popupForm("<?=site_url($module_url)?>" + '/add/?width='+800+'&height='+300);
		   }, 
		   position:"last"
		})

		.navButtonAdd('#pager',{
		   caption:"Edit", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				  popupForm("<?=site_url($module_url)?>" + '/update/' + id + '/?width='+500+'&height='+230);
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
});	



</script>

<div align="center">
	<table id="mytable" class="scroll"></table>
	<div id="pager"></div>
</div>


