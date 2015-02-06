<?php
$session_id = $this->UserLogin->isLogin();
$level = $session_id['level_id'];
$user = $session_id['username'];
$grid_data = str_replace('"numberFormat"','numberFormat',$grid_data);
$grid_data = str_replace('"cellColumn"','cellColumn',$grid_data);
?>

<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/i18n/grid.locale-en.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.jqGrid.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.jqGrid.src.js"></script>

<script type="text/javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	grid.navButtonAdd('#pager',{
		   caption:"Tambah Data", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
				popupForm("<?=site_url($module_url)?>" + '/add/?width='+600+'&height='+300);
		   }, 
		   position:"last"
		})
		.navButtonAdd('#pager',{
		   caption:"Edit Data", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url($module_url)?>" + '/update/' + id + '/?width='+600+'&height='+300);
			 }else{
				 alert('Pilih baris yang ingin diedit');
			 }
		   }, 
		   position:"last"
		})
		.navButtonAdd('#pager',{
		   caption:"Hapus Data", 
		   buttonicon:"ui-icon-trash", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
			 	var r = confirm("Hapus Data ?");
			    if (r == true) {
			    	popupForm("<?=site_url($module_url)?>" + '/deletebegin/' + id);  
			    }
			 }else{
				 alert('Pilih baris yang ingin dihapus');
			 }
		   }, 
		   position:"last"
		})
		.navButtonAdd('#pager',{
		   caption:"CARI", 
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