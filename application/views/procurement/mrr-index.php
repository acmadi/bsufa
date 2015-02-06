
<?php
$session_id = $this->UserLogin->isLogin();
$grid_data = str_replace('"numberFormat"','numberFormat',$grid_data);
$grid_data = str_replace('"cellColumn"','cellColumn',$grid_data);
$level = $session_id['level_id']; 
?>
<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	grid.navButtonAdd('#pager',{
		   caption:"MRR", 
		   buttonicon:"ui-icon-cros", 
		  onClickButton: function(){
			  var id = getSelectedID(); 
			 if(id){ 
				popupForm("<?=site_url($module_url)?>" + '/update/'+ id +'/?width='+950+'&height='+450);
		   }else{
				alert('Pilih PO yang ingin di Update');
			}
		   }, 
		   position:"last"
		})
		
	grid.navButtonAdd('#pager',{
		   caption:"CloseMR", 
		   buttonicon:"ui-icon-cros", 
		  onClickButton: function(){
			  var id = getSelectedID(); 
			 if(id){ 
				window.open("<?=site_url($module_url)?>" + '/closemrr/'+ id +'/?width='+0+'&height='+0);
		   }else{
				alert('Pilih PO yang ingin di Close');
			}
		   }, 
		   position:"last"
		})		
	// .navButtonAdd('#pager',{
		   // caption:"Print MRR Form", 
		  // buttonicon:"ui-icon-print", 
		   // onClickButton: function(){ 
			 // var id = getSelectedID();
			 // if(id){
				 // popupForm("<?=site_url($module_url)?>" + '/app/' + id + '/?width='+750+'&height='+400);
			 // }else{
				 // alert('Pilih baris yang ingin di print');
			 // }
		   // }, 
		   // position:"last"
		// })		

	// .navButtonAdd('#pager',{
			   // caption:"Print MRR dg Qty Masuk", 
			   // buttonicon:"ui-icon-print", 
			   // onClickButton: function(){ 
				 // var id = getSelectedID();
				 // if(id){
					 // popupForm("<?=site_url()?>" + '/prverifikasi/generatepr/' + id + '/?width='+950+'&height='+600);
				 // }else{
					 // alert('Pilih baris yang ingin di print');
				 // }
			   // }, 
			   // position:"last"
			// })


    .navButtonAdd('#pager',{
		   caption:"Search", 
		buttonicon:"ui-icon-search", 
		   onClickButton: function(){ 
			 grid.jqGrid('searchGrid');
		   }, 
		   position:"last"
		})

function cellColumn(cellVal,opts,element){
	if(element.status_pr == 0)
		var newVal = '<span class="customBg" style="background-color:#FFD5D5">'+cellVal+'</span>';
		else if(element.status_pr == 1)
		var newVal = '<span class="customBg" style="background-color:#C1FFC1">'+cellVal+'</span>';		
		else if(element.status_pr == 2)
		var newVal = '<span class="customBg" style="background-color:#FFFF66">'+cellVal+'</span>';
		else if(element.status_pr == 3)
		var newVal = '<span class="customBg" style="background-color:#FFFF66">'+cellVal+'</span>';	
		else if(element.status_pr == 4)
		var newVal = '<span class="customBg" style="background-color:#00FFFF">'+cellVal+'</span>';	
		else if(element.status_pr == 6)
		var newVal = '<span class="customBg" style="background-color:#D3D3D3">'+cellVal+'</span>';						
		else if(element.status_pr == 9)
		var newVal = '<span class="customBg" style="background-color:#FF6600">'+cellVal+'</span>';
	else var newVal = cellVal;
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




