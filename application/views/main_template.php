<html>
 <head>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css" />
	<title><?=$page_title?></title>
	<script language="javascript">
		var SITE_URL = "<?=site_url()?>";
		var IMAGE_PATH = SITE_URL + 'assets/images/';
	</script>
	<?=$head_scripts?>
 </head>
<body>
<div id="menu">
	<div id="header">
	</div>
	<div id="tengah">
		<?=$content?>
		<a href="" id="popupForm" class="thickbox" style="display:none"></a>
	</div>
</div>
</body>
</html>
