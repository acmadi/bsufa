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
	<?php #if($level != 3 ){ ?>
	/*grid.navButtonAdd('#pager',{
		   caption:"Proposed Budget", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			 popupForm("<?=site_url($module_url)?>" + '/add/?width='+900+'&height='+500);
		   }, 
		   position:"last"
		})*/
	<?php #}else{ ?>
	grid.navButtonAdd('#pager',{
		   caption:"Approve", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url($module_url)?>" + '/approve/' + id + '/?width='+880+'&height='+450);
			 }else{
				 alert('Pilih baris yang ingin di Approve');
			 }
		   }, 
		   position:"last"
		})
	<?php if($level == 10 ){ ?>
		.navButtonAdd('#pager',{
		   caption:"Budget Alokasi", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 window.open("<?=site_url($module_url)?>" + '/printmon/' + id );
			 }else{
				 alert('Pilih baris yang ingin diview');
			 }
		   }, 
		   position:"last"
		})
	<? } ?>
    .navButtonAdd('#pager',{
		   caption:"Search", 
		   buttonicon:"ui-icon-search", 
		   onClickButton: function(){ 
			 grid.jqGrid('searchGrid');
		   }, 
		   position:"last"
		})
		<?php if($level == 3 ){ ?>
		.navButtonAdd('#pager',{
		   caption:"Delete", 
		   buttonicon:"ui-icon-trash", 
		   onClickButton: function(){ 
			 if(confirm('Hapus data ini?')){
				 var id = getSelectedID(); 
				 if(id){	
					 $.get("<?=site_url($module_url)?>" + '/deletedata/' + id,
						function(response){
							if(response == 'success'){
								refreshTable();
							}else{
								alert('Hapus data gagal');
							}
						}
					 );
				 }else{
					 alert('Pilih baris yang ingin dihapus');
				 }
			 }
		   }, 
		   position:"last"
		})
		<?php } ?>
		<?php if($level == 10 ){ ?>
		.navButtonAdd('#pager',{
		   caption:"Delete", 
		   buttonicon:"ui-icon-trash", 
		   onClickButton: function(){ 
			 if(confirm('Hapus data ini?')){
				 var id = getSelectedID(); 
				 if(id){	
					 $.get("<?=site_url($module_url)?>" + '/deletedata/' + id,
						function(response){
							if(response == 'success'){
								refreshTable();
							}else{
								alert('Hapus data gagal');
							}
						}
					 );
				 }else{
					 alert('Pilih baris yang ingin dihapus');
				 }
			 }
		   }, 
		   position:"last"
		})
		<?php } ?>
		

});


function cellColumn(cellVal,opts,element){
	if(element.flag_id == 1)
		var newVal = '<span class="customBg" style="background-color:#C1FFC1">'+cellVal+'</span>';
	else if(element.flag_id == 0)
		var newVal = '<span class="customBg" style="background-color:#FFD5D5">'+cellVal+'</span>';
	else if(element.flag_id == 2)
		var newVal = '<span class="customBg" style="background-color:#C0C0C0">'+cellVal+'</span>';
	else var newVal = cellVal;
	return newVal;
}

function numberFormat(cellVal,opts,element){
	if(element.flag_id == 0)
		var newVal = '<span class="customBg" style="background-color:#FFD5D5">'+numToCurr(element.amount)+'</span>';
	else if(element.flag_id == 1)
		var newVal = '<span class="customBg" style="background-color:#C1FFC1">'+numToCurr(element.amount)+'</span>';
	else if(element.flag_id == 2)
		var newVal = '<span class="customBg" style="background-color:#C0C0C0">'+numToCurr(element.amount)+'</span>';
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
<div style="left">
<br>
<br>
<table >
		<tr>
			<td style="background-color:#FF80FF;width:130px;height:25px" >PROPOSED</td>
			<td style="background-color:#00FF00;;width:130px;height:25px">APPROVED</td>
						<td style="background-color:#808080;;width:130px;height:25px">DECLINED</td>
			
		
			
		</tr>
</table>

