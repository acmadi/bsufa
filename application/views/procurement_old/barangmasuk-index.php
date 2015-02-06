<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	grid.navButtonAdd('#pager',{
		   caption:"Input", 
		 buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			 popupForm("<?=site_url($module_url)?>" + '/add/?width='+950+'&height='+500);
		   }, 
		   position:"last"
		})
		
	grid.navButtonAdd('#pager',{
		   caption:"CloseMR", 
		   buttonicon:"ui-icon-cros", 
		  onClickButton: function(){
			  var id = getSelectedID(); 
			 if(id){ 
				popupForm("<?=site_url()?>" + '/prverifikasi/mapingbarang/'+ id +'/?width='+950+'&height='+500);
		   }else{
				alert('Pilih PO yang ingin di Close');
			}
		   }, 
		   position:"last"
		})		
	.navButtonAdd('#pager',{
		   caption:"Print MRR Form", 
		  buttonicon:"ui-icon-print", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url($module_url)?>" + '/app/' + id + '/?width='+750+'&height='+400);
			 }else{
				 alert('Pilih baris yang ingin di print');
			 }
		   }, 
		   position:"last"
		})		

	.navButtonAdd('#pager',{
			   caption:"Print MRR dg Qty Masuk", 
			   buttonicon:"ui-icon-print", 
			   onClickButton: function(){ 
				 var id = getSelectedID();
				 if(id){
					 popupForm("<?=site_url()?>" + '/prverifikasi/generatepr/' + id + '/?width='+950+'&height='+600);
				 }else{
					 alert('Pilih baris yang ingin di print');
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

});
</script>
<div align="center">
	<table id="mytable" class="scroll"></table>
	<div id="pager" style="height:35px"></div>


</div>




