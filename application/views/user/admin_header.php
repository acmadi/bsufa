<?php
$_imglogo = "logo.png";
$_sitetitle = "e-property";
switch($site_id) {
	case 1:
		$_imglogo = "logo-crm.png";
		$_sitetitle = "Customer Relationship Management";
		break;
	case 2:
		$_imglogo = "logo-finance.png";
		$_sitetitle = "Finance";
		break;
	case 3:
		$_imglogo = "logo-hrd.png";
		$_sitetitle = "Human Resources Management";
		break;
	case 4:
		$_imglogo = "logo-asset.png";
		$_sitetitle = "Asset Management";
		break;
	case 5:
		$_imglogo = "logo-sales.png";
		$_sitetitle = "Sales Management";
		break;
	case 6:
		$_imglogo = "logo-system.png";
		$_sitetitle = "System Config";
		break;
}

$sqlModules = 'SELECT m.* FROM modules m left JOIN user_menu u ON m.id_module = u.module_id left join db_site_modules sm on m.id_module = sm.id_module WHERE u.group_id = \''.$this->UserLogin->getClass().'\' and (sm.id_sites = \''. ($site_id=="favicon.ico"?"0":$site_id) .'\' or sm.id_sites = \'0\' or sm.id_sites is null) and m.parent_module_id is not null and m.parent_module_id > 0 ORDER BY m.module_index , m.parent_module_id';
$_rowModules = $this->ado->GetAll($sqlModules);
?>
<!doctype html>

<!--[if lt IE 7]>
<html class="no-js ie6 oldie" lang=en>
<![endif]--> 
<!--[if IE 7]>
<html class="no-js ie7 oldie" lang=en>
<![endif]--> 
<!--[if IE 8]>
<html class="no-js ie8 oldie" lang=en>
<![endif]--> 
<!--[if gt IE 8]><!--> 
<html class=no-js lang=en> 
<!--<![endif]--> 
<head> 
	<meta charset=utf-8> 
	<meta http-equiv=X-UA	-Compatible content="IE=edge,chrome=1"> 
	<title><?=$_sitetitle?></title> 
	<meta name=description content=""> 
	<meta name=author content=""> 
	<meta name=viewport content="width=device-width,initial-scale=1"> 
	<?=link_tag(CSS_PATH.'bsu_themes.css')?>	
	<?=link_tag(CSS_PATH.'menu.css')?>	
	<?=script('libs/modernizr-2.0.6.min.js')?>

	<?=script('libs/jquery-1.6.2.min.js')?>
	<?=script('menu.js')?>
	<?=script('bsu_scripts.js')?>
</head> 
<body id=top <?=($site_id!="0" && $site_id!=""?"style=\"background:#E3E5E7;\"":"")?>> 

<div id=container> 

	<div id=header-surround>
		<header id=header> 
			<div id="logo-head">
			<img src="<?=base_url()?>assets/img/<?=$_imglogo?>" alt=Grape class=logo> 
			</div>
				<div class="divider-header divider-vertical"></div> 
				<div id=user-info> 
					<p> 
						<span class=messages>Hello <a href="javascript:void(0);"><?=ucwords($session_id)?></a>
						</span> 
						<a href="<?=base_url()?>user/login/out/" class="button red">Logout</a> </p> 
				</div> 
		</header>
	</div> 
	
	<div class=fix-shadow-bottom-height></div> 
	<aside id=sidebar <?=($site_id!="0" && $site_id!=""?"style=\"display:none\"":"")?>> 
		<div id=search-bar>
		</div> 
		<section id=login-details> 
			<?php
			$sqlModules = 'select * from user_admin where id_user = \''. $this->UserLogin->getid() .'\'';
			$_rowModules = $this->ado->GetAll($sqlModules);
			if($_rowModules) {
				foreach($_rowModules as $a) {
					$foto = $a->img_file;
				}
			}
			?>
			<?php
			if($foto!=""):
			?>
			<img class="img-left framed" src="<?=base_url()?>assets/foto/<?=$foto?>" width="50" alt="Hello <?=ucwords($session_id)?>"> 
			<?php
			else:
			?>
			<img class="img-left framed" src="<?=base_url()?>assets/img/misc/avatar_small.png" alt="Hello <?=ucwords($session_id)?>"> 
			<?php
			endif;
			?>
			<h3>Logged in as</h3> 
			<h2>
				<a class=user-button href="javascript:void(0);"><?=ucwords($session_id)?>&nbsp;
					<span class=arrow-link-down></span>
				</a>
			</h2> 
			<ul class=dropdown-username-menu> 
				<li><a href="#">Change Password</a></li> 
				<li><a href="<?=base_url()?>user/login/out">Logout</a></li> 
			</ul> 
			<div class=clearfix></div> 
		</section> 
		<? if(isset($sites_menu)): ?>
		<? echo $sites_menu?>
		<? endif; ?>
	</aside> 

	<div id=main role=main <?=($site_id!="0" && $site_id!=""?"style=\"margin-left: 0;\"":"")?>> 
		<?php
		if($site_id > 0):
		?>
		<div id=title-bar <?=($site_id!="0" && $site_id!=""?"style=\"margin-left: 261px;\"":"")?>>
			<? if(isset($modules_menu)): ?>
			<div id="menu-drop">
			<? echo $modules_menu ?>
			</div>
			<? endif; ?>
		</div> 
		<?php endif; ?>
		<div id=title-bar> 
			<ul id=breadcrumbs> 
				<li>
					<a href="<?=base_url()?>user/home/sites/0" title=Home><span id=bc-home></span></a>
				</li> 
				<li class=no-hover>
					Dashboard
				</li> 
			</ul> 
		</div> 
		<div class="shadow-bottom shadow-titlebar"></div> 
		<div id=main-content>
		<?php if($site_id <= 0): ?>
		<!--div id="imgHome"></div-->
		<?php endif; ?>
