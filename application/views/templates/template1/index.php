<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><?=$pageTitle?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?=$html_head?>
<base href="<?=$pathTemplate?>" />
<link href="css/default.css" rel="stylesheet" type="text/css" />
<!--link href="css/addition.css" rel="stylesheet" type="text/css" /-->
</head>
<body>
  <table width="1000" border="0" cellpadding="0" cellspacing="0" align="center">
    <thead>
	<tr>
	  <td colspan="3" id="header"><img src="images/header.gif"></td>
    </tr>
    <tr>
	  <td colspan="3" id="menu">
		<table align="center" width="90%">
		  <tr>
			<td><?=$menu_navigator?></td>
			<td>
				<table id="searchTable" cellpadding="0" cellspacing="0">
					<tr>
						<td><input type="text" size="18" id="searchText" /></td>
						<td><input type="image" id="searchButton" src="images/buttonsearch.jpg" /></td>
					</tr>
				</table>
			</td>
		  </tr>
		</table>
	  </td>
	</tr>
	</thead>
	<? if(false): ?>
	<tr>
	  <td colspan="3" class="gray"><? echo implode(" &raquo; ",$headerNav); ?></td>
    </tr>
	<? endif; ?>
	<tbody id="trContent1">
	<?=$content?>    
	</tbody>
  </table><br/><br/>
  <div id="footer" align="center"><label>Disclaimer | Privacy Policy | Sitemap<br/>Copyright@2009 - PTMSI</label></div>
</body>
</html>
