<?php
$session_id = $this->UserLogin->isLogin();
$level = $session_id['level_id'];
$user = $session_id['username'];
$grid_data = str_replace('"numberFormat"','numberFormat',$grid_data);
$grid_data = str_replace('"cellColumn"','cellColumn',$grid_data);
?>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.5.2.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/i18n/grid.locale-en.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.jqGrid.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.jqGrid.src.js"></script>


<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	//grid.jqGrid('inlineNav',"#pager");
	grid.navButtonAdd('#pager',{
		   caption:"Input", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			 myWindow=window.open("<?=site_url()?>" + 'sales/unidentified_call/' , '_parent' , '/?width='+750+'&height='+700);
		   }, 
		   position:"last"
		})

		.navButtonAdd('#pager',{
		   caption:"View", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 window.open("<?=site_url()?>" + '/unidentified/receipt_unidentified/' + id + '/?width='+750+'&height='+700);
			 }else{
				 alert('Pilih baris yang ingin diedit');
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
/*var grid = $("#mytable");
				grid.jqGrid({
					//url: '<?=base_url()?>General_ledger/coa_call', //URL Tujuan Yg Mengenerate data Json nya
					datatype: "json", //Datatype yg di gunakan					
					mtype: "GET",
					colNames: ['acc_no','acc_name','Level','type','currency_cd'],
					colModel: [
						{name:'acc_no', key:true, index:'acc_no', hidden:true,editable:false,editrules:{required:true}},
						{name:'acc_name',index:'acc_name',editable:true,editrules:{required:true}},
						{name:'Level',index:'Level',editable:true,editrules:{required:true}},
						{name:'type',index:'type',align:'center',editable:true,editrules:{required:true}},
                        {name:'currency_cd',index:'currency_cd',align:'center',editable:true,editrules:{required:true}}
					],
					rownumbers:true,
					rowNum: 10,
					height: "50%", //Mengset Tinggi table jadi Auto menyesuaikan dengan isi table
					rowList: [10,20,30],
					pager: '#pager',
					sortname: 'id',
					viewrecords: true,
					sortorder: "desc",
					//editurl: '<?php echo base_url() ?>index.php/welcome/crud', //URL Proses CRUD Nya
					multiselect: false, 
					caption: "Record Test", //Caption List					
				});
				grid.jqGrid('navGrid','#pager',{view:true,edit:true,add:true,del:true},{},{},{},{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:false,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'});				
				grid.jqGrid('inlineNav',"#pager");
			});*/
	



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


