<?php
$session_id = $this->UserLogin->isLogin();
$grid_data = str_replace('"numberFormat"','numberFormat',$grid_data);
$grid_data = str_replace('"cellColumn"','cellColumn',$grid_data);
$level = $session_id['level_id']; 
#die($level);
$username = $session_id['username'];
$group_id = $session_id['group_id'];
#die($group_id); 
?>

<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	grid
		<? if($level == 1 or $level == 10){?>
	.navButtonAdd('#pager',{
		   caption:"Verification", 
		  // buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 //popupForm("<?=site_url()?>" + '/prverifikasi/updatepr/' + id + '/?width='+800+'&height='+400);
				 popupForm("<?=site_url($module_url)?>" + '/update/' + id + '/?width='+800+'&height='+400);
			 }else{
				 alert('Pilih PR yang akan di VERIFIKASI');
			 }
		   }, 
		   position:"last"
		})
	<? }if($level == 1 or $level == 10){?>
	.navButtonAdd('#pager',{
		   caption:"Map Barang", 
		  // buttonicon:"ui-icon-pencil", 
		  onClickButton: function(){
			  var id = getSelectedID(); 
			 if(id){ 
				popupForm("<?=site_url($module_url)?>" + '/mapping/'+ id +'/?width='+920+'&height='+500);
		   }else{
				alert('Pilih PR yang ingin di MAPPING');
			}
		   }, 
		   position:"last"
		})				
	<? }if($level == 1 or $level == 10){?>	
	.navButtonAdd('#pager',{
		   caption:"Map Vendor", 
		  // buttonicon:"ui-icon-pencil", 
		  onClickButton: function(){
			  var id = getSelectedID(); 
			 if(id){ 
				popupForm("<?=site_url($module_url)?>" + '/app/'+ id +'/?width='+1120+'&height='+500);
		   }else{
				alert('Pilih PR yang ingin di MAPPING');
			}
		   }, 
		   position:"last"
		})		
	<? }if($level == 1 or $level == 10){?>	
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

	<? }if ($level == 5 or $level == 10 or $level == 6 ){?>
	.navButtonAdd('#pager',{
			   caption:"Approval I", 
			  // buttonicon:"ui-icon-pencil", 
			   onClickButton: function(){ 
				 var id = getSelectedID();
				 if(id){
					 popupForm("<?=site_url($module_url)?>" + '/view/' + id + '/?width='+900+'&height='+500);
				 }else{
					 alert('PR belum dipilih');
				 }
			   }, 
			   position:"last"
	})
	<?php }if($level == 6 or $level == 10 ){?>

	.navButtonAdd('#pager',{
			   caption:"Approval II", 
			  // buttonicon:"ui-icon-pencil", 
			   onClickButton: function(){ 
				 var id = getSelectedID();
				 if(id){
					 popupForm("<?=site_url($module_url)?>" + '/appr/' + id + '/?width='+900+'&height='+500);
				 }else{
					 alert('PR belum dipilih');
				 }
			   }, 
			   position:"last"
	})
	<?php }else{$level = 3;}?>


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
		var newVal = '<span class="customBg" style="background-color:#FFFFFF">'+cellVal+'</span>';		
		else if(element.status_pr == 2)
		var newVal = '<span class="customBg" style="background-color:#FFFF66">'+cellVal+'</span>';
		else if(element.status_pr == 3)
		var newVal = '<span class="customBg" style="background-color:#80FFFF">'+cellVal+'</span>';	
		else if(element.status_pr == 4)
		var newVal = '<span class="customBg" style="background-color:#AEA9F1">'+cellVal+'</span>';	
		else if(element.status_pr == 5)
		var newVal = '<span class="customBg" style="background-color:#9BFF9B">'+cellVal+'</span>';	
		else if(element.status_pr == 6)
		var newVal = '<span class="customBg" style="background-color:#FFBF80">'+cellVal+'</span>';						
		else if(element.status_pr == 7)
		var newVal = '<span class="customBg" style="background-color:#C0C0C0">'+cellVal+'</span>';
		else if(element.status_pr == 8)
		var newVal = '<span class="customBg" style="background-color:#C0C0C0">'+cellVal+'</span>';												
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
.bg1{
	display:block;
	background-color:#FFD5D5;	
	margin-height:-2px;
	margin-left:-2px;
	height: 14px;
	padding: 4px;	
}

.bg2{
	display:block;
	background-color:#C1FFC1;	
	margin-height:-2px;
	margin-left:-2px;
	height: 14px;
	padding: 4px;	
}

.bg3{
	display:block;
	background-color:#FFFF66;	
	margin-height:-2px;
	margin-left:-2px;
	height: 14px;
	padding: 4px;	
}

.bg4{
	display:block;
	background-color:#FFFF66;	
	margin-height:-2px;
	margin-left:-2px;
	height: 14px;
	padding: 4px;	
}

.bg5{
	display:block;
	background-color:#00FFFF;	
	margin-height:-2px;
	margin-left:-2px;
	height: 14px;
	padding: 4px;	
}

.bg6{
	display:block;
	background-color:#D3D3D3;	
	margin-height:-2px;
	margin-left:-2px;
	height: 14px;
	padding: 4px;	
}

.bg7{
	display:block;
	background-color:#FF6600;	
	margin-height:-2px;
	margin-left:-2px;
	height: 14px;
	padding: 4px;	
}


.ui-state-highlight span{
	background-color:#A0A0A0;
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
<br>
<br>
<table >
		<tr>
			
			<td style="background-color:#FFFFFF;;width:130px;height:25px" align="center">PROPOSED</td>
			<td style="background-color:#FFFF66;;width:130px;height:25px" align="center">VERIFICATION</td>
			<td style="background-color:#80FFFF;;width:130px;height:25px" align="center">MAP BARANG</td>
			<td style="background-color:#8F88EC;;width:130px;height:25px" align="center">MAP VENDOR</td>
			<td style="background-color:#80FF80;;width:130px;height:25px" align="center">POSTING PR</td>
			<td style="background-color:#FFBF80;;width:130px;height:25px" align="center">APPROVED I</td>
			<td style="background-color:#C0C0C0;;width:130px;height:25px" align="center">APPROVED II</td>
			
		
			
		</tr>
</table>



