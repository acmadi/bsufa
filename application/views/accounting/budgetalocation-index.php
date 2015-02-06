<?php
$session_id = $this->UserLogin->isLogin();
$grid_data = str_replace('"numberFormat"','numberFormat',$grid_data);
$grid_data = str_replace('"cellColumn"','cellColumn',$grid_data);
//var_dump($module_url."--".$grid_data);
$uri = $this->uri->segment(2);
if($uri=="budgetalocation"){ $select="all"; }
if($uri=="budgetalocationbsu"){ $select="11"; }
if($uri=="budgetalocationbdm"){ $select="22"; }
if($uri=="budgetalocationbpr"){ $select="33"; }
if($uri=="budgetalocationgmi"){ $select="44"; }
if($uri=="budgetalocationpi"){ $select="55"; }
if($uri=="budgetalocationpb"){ $select="66"; }
?>

<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
});

function generateGrid(gridData,moduleURL,width,height){
	return $('#mytable').jqGrid(gridData)
		.navGrid('#pager',{edit:false,add:false,del:false,search:false})
		/*
		.navButtonAdd('#pager',{
		   caption:"Add", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			 popupForm("<?=site_url()?>"  + 'accounting/budgetalocation/add/?width='+700+'&height='+450);
		   }, 
		   position:"last"
		})
		*/
		.navButtonAdd('#pager',{
		   caption:"Alokasi", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url()?>"  + 'budgetalocation/view_add/' + id + '/?width='+400+'&height='+250);	
			 }else{
				 alert('Pilih baris yang ingin alokasi');
			 }
		   }, 
		   position:"last"
		})
	}
function cellColumn(cellVal,opts,element){
	if(element.status == 1)
		var newVal = '<span class="customBg" style="background-color:#C1FFC1">'+cellVal+'</span>';
		else if(element.status == 2)
		var newVal = '<span class="customBg" style="background-color:#FFD5D5">'+cellVal+'</span>';
		else if(element.status == 3)
		var newVal = '<span class="customBg" style="background-color:#808080">'+cellVal+'</span>';
	else var newVal = cellVal;
	return newVal;
}


/* Dinamic combo */
$(function(){
	$("#select_pt").change(function(){
		var v = $("#select_pt").val();
		$.post('<?=site_url()?>budgetalocation/show_project/'+v);
		refreshTable();
		refreshTable();
	});
});

</script>
<style>
.customBg{
	display:block;
	margin-height:-4px;
	margin-left:-2px;
	height: 17px;
	padding: 5px;
}
.customBg2{
	display:block;
	margin-height:-2px;
	margin-left:-2px;
	height: 14px;
	padding: 4px;
}
</style>
<?php $row = $this->db->query("select * from project where (kd_project = 11 or kd_project = 111 or kd_project = 112) and kd_project!='1'")->result();?>
<br><br>
<div style="margin-left:100px">
	<h2><font color='red' size='4'>Budget Alocation<hr width="150px" align="left"></font></h2>
	<table>
		<tr>
			<td>
				Project 
			</td>
			<td>
				: 
			</td>
			<td>
				<select id="select_pt">
					<option value="all">-- Pilih Project --
					</option>
					<?php foreach($row as $pt):?>
					<option value="<?=$pt->kd_project;?>"><?=$pt->kd_project;?> | <?=$pt->nm_project;?></option>
					<?php endforeach;?>
				</select>
			</td>
		</tr>
	
	</table>
	
	
</div><br>
<div align="center">
	<table id="mytable" class="scroll"></table><div id="pager"></div>
</div>
