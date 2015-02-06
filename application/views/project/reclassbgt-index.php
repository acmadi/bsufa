<?php
$session_id = $this->UserLogin->isLogin();
$grid_data = str_replace('"numberFormat"','numberFormat',$grid_data);
$grid_data = str_replace('"cellColumn"','cellColumn',$grid_data);
$level = $session_id['level_id']; 
?>

<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	grid
	
	
		
			.navButtonAdd('#pager',{
		   caption:"Approved", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url($module_url)?>" + '/approved/' + id + '/?width='+500+'&height='+250);
			 }else{
				 alert('Belum memilih data RECLASS');
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
	if(element.id_flag == 1)
		//var newVal = '<span class="customBg" style="background-color:#FFFF80">'+cellVal+'</span>';
		//else if(element.id_flag == 3)
		var newVal = '<span class="customBg" style="background-color:#80FF80">'+cellVal+'</span>';	
		else if(element.id_flag == 10)
		var newVal = '<span class="customBg" style="background-color:#FF8080">'+cellVal+'</span>';
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
	<div id="pager"></div>
</div>
<br>
<br>
<div style="left">
<table >
		<tr>
			<td style="background-color:#FFFFFF;width:130px;height:25px" align="center">PROPOSED</td>
			<td style="background-color:#80FF80;width:130px;height:25px" align="center">APPROVED</td>
			<td style="background-color:#FF8080;width:130px;height:25px" align="center">DECLINED</td>
			
		
			
		</tr>
</table>

</div>



