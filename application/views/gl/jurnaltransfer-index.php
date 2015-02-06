<?php
$session_id = $this->UserLogin->isLogin();
$level = $session_id['level_id'];
$user = $session_id['username'];
$grid_data = str_replace('"numberFormat"','numberFormat',$grid_data);
$grid_data = str_replace('"cellColumn"','cellColumn',$grid_data);
?>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<!--script language="javascript" src="<?=base_url()?>assets/js/jquery-1.5.2.min.js"></script-->
<script language="javascript" src="<?=base_url()?>assets/js/i18n/grid.locale-en.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.jqGrid.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.jqGrid.src.js"></script>


<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	
		
	grid.navButtonAdd('#pager',{
		   caption:"Search", 
		   buttonicon:"ui-icon-search", 
		   onClickButton: function(){ 
			 grid.jqGrid('searchGrid');
		   }, 
		   position:"last"
	})
					function cellColumn(cellVal,opts,element){
	if(element.status == 1)
		var newVal = '<span class="customBg" style="background-color:#C1FFC1">'+cellVal+'</span>';
		else if(element.status == 2)
		var newVal = '<span class="customBg" style="background-color:#C1FFC1">'+cellVal+'</span>';		
		else if(element.status == 3)
		var newVal = '<span class="customBg" style="background-color:#FFD5D5">'+cellVal+'</span>';
	else var newVal = cellVal;
	return newVal;
}
});	

function generateGrid(gridData,moduleURL,width,height){
	return $('#mytable').jqGrid(gridData)
		.navGrid('#pager',{edit:false,add:false,del:false,search:false})
		// .navButtonAdd('#pager',{
		   // caption:"Tambah", 
		   // buttonicon:"ui-icon-plus", 
		   // onClickButton: function(){ 
			 // popupForm(moduleURL + '/add/?width='+700+'&height='+500);
			// // myWindow=window.open("<?=site_url()?>" + '/datagrid2/' , '_parent' , '/?width='+750+'&height='+700);
		   // }, 
		   // position:"last"
		// })
		// .navButtonAdd('#pager',{
		   // caption:"Search", 
		   // buttonicon:"ui-icon-search", 
		   // onClickButton: function(){ 
			 // grid.jqGrid('searchGrid');
		   // }, 
		   // position:"last"
	// })
// });	
		.navButtonAdd('#pager',{
		   caption:"Posting", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			var table =  $('#mytable').jqGrid(gridData);
			 var id = table.jqGrid('getGridParam','selarrrow');
			// var id = getSelectedID();
			 if(id){
				 popupForm(moduleURL + '/approve/' + id + '/?width='+0+'&height='+0);
				// alert('Posting Berhasil');
				refreshTable();

	
			 }else{
				 alert('Pilih baris yang ingin di Approve');
			 }
		   }, 
		   position:"last"
		})
		
		.navButtonAdd('#pager',{
		   caption:"UnPosting", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			var table =  $('#mytable').jqGrid(gridData);
			 var id = table.jqGrid('getGridParam','selarrrow');
			// var id = getSelectedID();
			 if(id){
				 popupForm(moduleURL + '/unapprove/' + id + '/?width='+0+'&height='+0);
				// alert('Posting Berhasil');
				refreshTable();

	
			 }else{
				 alert('Pilih baris yang ingin di Approve');
			 }
		   }, 
		   position:"last"
		})
		
		// .navButtonAdd('#pager',{
		   // caption:"Unverifikasi", 
		   // buttonicon:"ui-icon-pencil", 
		   // onClickButton: function(){ 
			// var table =  $('#mytable').jqGrid(gridData);
			 // var id = table.jqGrid('getGridParam','selarrrow');
			// // var id = getSelectedID();
			 // if(id){
				 // popupForm(moduleURL + '/unverifikasi/' + id + '/?width='+0+'&height='+0);
				// // alert('Posting Berhasil');
				// refreshTable();

	
			 // }else{
				 // alert('Pilih baris yang ingin di verifikasi');
			 // }
		   // }, 
		   // position:"last"
		// })
		
		.navButtonAdd('#pager',{
		   caption:"View", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm(moduleURL + '/view/' + id + '/?width='+1000+'&height='+425);
			 }else{
				 alert('Pilih baris yang ingin diedit');
			 }
		   }, 
		   position:"last"
		})
				.navButtonAdd('#pager',{
		   caption:"Print", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 window.open("<?=site_url($module_url)?>" + '/print_slip/' + id + '/?width='+900+'&height='+500);
			 }else{
				 alert('Pilih data yang akan di Print');
			 }
		   }, 
		   position:"last"
		})	
		
		
}
var ts= this, grid={
	dragStart: function(i,x,y) {
		$(ts).triggerHandler("jqGridResizeStart", [x, i]);
	},
	selectionPreserver : function(ts) {
		var p = ts.p,
		sr = p.selrow, sra = p.selarrrow ? $.makeArray(p.selarrrow) : null,
		left = ts.grid.bDiv.scrollLeft,
		restoreSelection = function() {
			var i;
			p.selrow = null;
			p.selarrrow = [];
			if(p.multiselect && sra && sra.length>0) {
				for(i=0;i<sra.length;i++){
					if (sra[i] != sr) {
						$(ts).jqGrid("setSelection",sra[i],false, null);
					}
				}
			}
			if (sr) {
				$(ts).jqGrid("setSelection",sr,false,null);
			}
			ts.grid.bDiv.scrollLeft = left;
			$(ts).unbind('.selectionPreserver', restoreSelection);
		};
		$(ts).bind('jqGridGridComplete.selectionPreserver', restoreSelection);				
	}
};

var onid;
$(ts).before(grid.hDiv).on("dblclick",function(e) { 
	td = e.target;
	ptr = $(td,ts.rows).closest("tr.jqgrow");
	onid = ptr[0].id;
	if(onid){
		popupForm('<?=site_url();?>jurnaltransfer' + '/view/' + onid + '/?width='+1000+'&height='+425);
	 }else{
		 alert('Pilih baris yang ingin diedit');
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
<script>
$(document).ready(function(){
$('#year').change(function(){
var year = $('#year').val();
$.post('<?php echo base_url();?>jurnaltransfer/show_year/'+year);
refreshTable();
refreshTable();
});
});
</script>
<form method="post" action="#">
<select name="year" id="year" style="width:200px;padding:3px;border:1px solid lightgray">
<?php for($a=-10;$a<=10;$a++){?>
<option value="<?php echo date('Y')+$a;?>" <?php if(date('Y')+$a==date('Y')){ echo 'selected'; } ?>><?php echo date('Y')+$a;?></option>
<?php } ?>
</select>
</form>
<div align="center">
	<table id="mytable" class="scroll"></table>
	<div id="pager"></div>
</div>


