<html>
 <head>
  <title>AGATHON WEB ADMINISTRATOR</title>
 <?=link_tag(CSS_PATH.'main.css')?>
 <?=link_tag(CSS_PATH.'admin.css')?>
 <?=link_tag(CSS_PATH.'jquerycssmenu.css')?>
 <?=script('jquery.js')?>
 <?=script('jquerycssmenu.js')?>
 <script language="javascript">
	var BASE_URL = "<?=base_url()?>";
	var SITE_URL = "<?=site_url()?>";
	var IMAGE_PATH = "<?=base_url().IMAGE_PATH?>";
	var arrowimages = {
		down: ['downarrowclass', IMAGE_PATH+'arrow-down.gif',25],
		right: ['rightarrowclass', IMAGE_PATH+'arrow-right.gif']
	};
	$(document).ready(
	  function(){		
		$('.tableDataColomn').mouseover(
		  function(){
			this.style.backgroundColor = '#EEEEEE';
		  }
		);
		$('.tableDataColomn').mouseout(
		  function(){
			this.style.backgroundColor = '#75AFD1';
		  }
		);
		jquerycssmenu.buildmenu("myjquerymenu",arrowimages)
	  }
	);
 </script>
 </head>
<body bgcolor="#000000">
 <table width="900" align="center" cellspacing="0" border="1" bordercolor="#000000" id="tableMain" bgcolor="#E6E6FA">
 	<tr>
		<th id="tdHeader">ADMINISTRATOR PAGE</th>
	</tr>
	<? if(isset($modules_menu)): ?>
 	<tr>
		<td id="myjquerymenu" class="jquerycssmenu"><? echo $modules_menu ?></td>
	</tr>
	<? endif; ?>
	<tr valign="top">
		<td width="80%" style="height:300px">
		  <!-- begin content -->
		<? if(isset($pageCaption)): ?>
		  <div id="divPageTitle"><?=$pageCaption?></div>
		<? endif; ?>
<? if(0): ?>
			  </td>
			</tr>
		  </table>
		  <!-- end content -->
         </td>
     </tr>
     <tr id="trFooter">
         <td>FOOTER</td>
     </tr>
 </table>
</body>
</html>
<? endif; ?>
