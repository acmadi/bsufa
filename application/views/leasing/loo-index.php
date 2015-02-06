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
	grid.navButtonAdd('#pager',{
		   caption:"INPUT", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			 popupForm("<?=site_url($module_url)?>" + '/add/?width='+1000+'&height='+370);
		   }, 
		   position:"last"
		})
	.navButtonAdd('#pager',{
		   caption:"EDIT", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url($module_url)?>" + '/app/' + id + '/?width='+800+'&height='+310);
			 }else{
				 alert('Pilih baris yang ingin diedit');
			 }
		   }, 
		   position:"last"
		})
		
		//~ .navButtonAdd('#pager',{
		   //~ caption:"DELETE", 
		   //~ buttonicon:"ui-icon-trash", 
		   //~ onClickButton: function(){ 
			 //~ if(confirm('Cetak LOO ini?')){
				 //~ var id = getSelectedID(); 
				 //~ if(id){	
					 //~ $.get("<?=site_url($module_url)?>" + '/del/' + id,
						//~ function(response){
							//~ if(response == 'success'){
								//~ refreshTable();
							//~ }else{
								//~ alert('Hapus data gagal');
							//~ }
						//~ }
					 //~ );
				 //~ }else{
					 //~ alert('Pilih baris yang ingin dicetak');
				 //~ }
			 //~ }
		   //~ }, 
		   //~ position:"last"
		//~ })    
		.navButtonAdd('#pager',{
		   caption:"PRINT", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 window.open("<?=site_url($module_url)?>" + '/cetakloo/' + id + '/?width='+750+'&height='+700);
			 }else{
				 alert('Pilih baris yang ingin diedit');
			 }
		   }, 
		   position:"last"
		})
	.navButtonAdd('#pager',{
		   caption:"SEARCH", 
		   buttonicon:"ui-icon-search", 
		   onClickButton: function(){ 
			 grid.jqGrid('searchGrid');
		   }, 
		   position:"last"
		})

});


function cellColumn(cellVal,opts,element){
	if(element.status == 0)
		var newVal = '<span class="customBg" style="background-color:white">'+cellVal+'</span>';
		else if(element.status == 2)
		var newVal = '<span class="customBg" style="background-color:#C1FFC1">'+cellVal+'</span>';
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
<br>
<br>
<div style="left">
<table >
		<tr>
			<td style="background-color:white;width:130px;height:25px" align="center">LOO</td>
			<td style="background-color:#C1FFC1;;width:130px;height:25px">CONTRACT</td>
			
			
			
		
			
		</tr>
</table>


