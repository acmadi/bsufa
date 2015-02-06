<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<?php
$session_id = $this->UserLogin->isLogin();
$username = $session_id['username']; 
?>

<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	grid
	
	.navButtonAdd('#pager',{
		   caption:"Cancel Unit", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
		   var id = getSelectedID();
			 if(id){
			 popupForm("<?=site_url()?>" + 'cancelunit/cancel/' + id + '/?width='+250+'&height='+80);
			  }else{
				  alert('Pilih baris yang ingin di cetak');
				  }
		   }, 
		   position:"last"
		})
		
	.navButtonAdd('#pager',{
		   caption:"Reschedule", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
		   var id = getSelectedID();
			 if(id){
			 popupForm("<?=site_url()?>" + 'cancelunit/reschedule/' + id + '/?width='+1000+'&height='+600);
			  }else{
				  alert('Pilih baris yang ingin di reschedule');
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
	if(element.flag_id == 10)
		var newVal = '<span class="customBg" style="background-color:#FFD5D5">'+cellVal+'</span>';
		
	else var newVal = cellVal;
	return newVal;
}


});
</script>
<div align="center">
	<table id="mytable" class="scroll"></table>
	<div id="pager"></div>
</div>

