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
		   caption:"Verification", 
		  // buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 //popupForm("<?=site_url()?>" + '/prverifikasi/updatepr/' + id + '/?width='+800+'&height='+400);
				 popupForm("<?=site_url($module_url)?>" + '/update/' + id + '/?width='+800+'&height='+400);
			 }else{
				 alert('Pilih baris yang ingin diedit');
			 }
		   }, 
		   position:"last"
		})

	grid.navButtonAdd('#pager',{
		   caption:"Map Barang", 
		  // buttonicon:"ui-icon-pencil", 
		  onClickButton: function(){
			  var id = getSelectedID(); 
			 if(id){ 
				popupForm("<?=site_url($module_url)?>" + '/mapping/'+ id +'/?width='+900+'&height='+400);
		   }else{
				alert('Pilih PR yang ingin di MAPPING');
			}
		   }, 
		   position:"last"
		})				
		
	grid.navButtonAdd('#pager',{
		   caption:"Map Vendor", 
		  // buttonicon:"ui-icon-pencil", 
		  onClickButton: function(){
			  var id = getSelectedID(); 
			 if(id){ 
				popupForm("<?=site_url($module_url)?>" + '/app/'+ id +'/?width='+900+'&height='+400);
		   }else{
				alert('Pilih PR yang ingin di MAPPING');
			}
		   }, 
		   position:"last"
		})		
		
	.navButtonAdd('#pager',{
		   caption:"Posting PR", 
		  // buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url($module_url)?>" + '/posting/' + id + '/?width='+900+'&height='+500);
			 }else{
				 alert('Pilih baris yang ingin diedit');
			 }
		   }, 
		   position:"last"
		})		

<?php //if($level==3) {?> 
	.navButtonAdd('#pager',{
			   caption:"App 1", 
			  // buttonicon:"ui-icon-pencil", 
			   onClickButton: function(){ 
				 var id = getSelectedID();
				 if(id){
					 popupForm("<?=site_url($module_url)?>" + '/app1/' + id + '/?width='+10+'&height='+10);
				 }else{
					 alert('Pilih PR yang ingin di Generate');
				 }
			   }, 
			   position:"last"
	})
	<?php //}elseif($level==2){?>

	.navButtonAdd('#pager',{
			   caption:"App 2", 
			  // buttonicon:"ui-icon-pencil", 
			   onClickButton: function(){ 
				 var id = getSelectedID();
				 if(id){
					 popupForm("<?=site_url($module_url)?>" + '/app2/' + id + '/?width='+10+'&height='+10);
				 }else{
					 alert('Pilih PR yang ingin di Generate');
				 }
			   }, 
			   position:"last"
	})
	<?php //}?>


    .navButtonAdd('#pager',{
		   caption:"Search", 
		//buttonicon:"ui-icon-search", 
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




