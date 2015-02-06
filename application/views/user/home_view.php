<?
	$this->load->view(ADMIN_HEADER);
	$session_id = $this->UserLogin->isLogin();
	$data =  $session_id['username'];
	#echo '<h2 align="center">Selamat Datang</h2>'.$data;
?>
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/jqcar-skins/tango/skin.css" />
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/jqcar-skins/ie7/skin.css" />

	<script type="text/javascript" src="<?=base_url();?>assets/js/FusionCharts.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.jcarousel.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.qtip-1.0.0-rc3.min.js"></script>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('.db-carousel').jcarousel();
		
		$('ul.shortcut-list a[href][title]').qtip({
			  content: {
				 text: false // Use each elements title attribute
			  },
			  position: {
				 corner: {
					target: 'topMiddle',
					tooltip: 'bottomMiddle'
				 }
			  },
			  style: {
				 name: 'cream',
				 padding: '7px 13px',
				 width: {
					max: 210,
					min: 0
				 },
				 tip: true
			  }
		   });
	});
	</script>
	<!-- shortcut menu -->
	<?php
	$site_id = ($site_id=="favicon.ico"?"0":$site_id);
	if($site_id > 0):
	?>
		<div class="grid_12"> 
			<div class=block-border> <div class=block-content> 
			<div id="shortcut-menu" class="db-carousel jcarousel-skin-tango">
			<ul class=shortcut-list> 
				<?php
				$sqlModules = 'SELECT m.* FROM modules m left JOIN user_menu u ON m.id_module = u.module_id left join db_site_modules sm on m.id_module = sm.id_module WHERE u.group_id = \''.$this->UserLogin->getClass().'\' and (sm.id_sites = \''. ($site_id=="favicon.ico"?"0":$site_id) .'\' or sm.id_sites = \'0\' or sm.id_sites is null) and m.parent_module_id is not null and m.parent_module_id > 0 ORDER BY m.module_index , m.parent_module_id';
				$_rowModules = $this->ado->GetAll($sqlModules);
				if($_rowModules):
					foreach($_rowModules as $m):
				?>
				<li> 
					<a href="<?=base_url().$m->module_path?>" title="<?=$m->module_name?>"><img src="<?=base_url()?>assets/img/icons/shortcut/<?=($m->icon_img==""?"default.png":$m->icon_img)?>" alt="<?=$m->module_name?>"></a> 
				</li>
				<?php		
					endforeach;
				endif;
				?>
			</ul> 
			</div>
			<div class=clear></div> 
			</div> 
			</div> 
		</div> 
	<?php endif; ?>
	<!-- shortcut menu -->
	<?php if($site_id=="1"): ?>
	<!-- dashbord charts -->
		<div class="grid_12"> 
			<div class=block-border> 
				<div class=block-header> 
					<h1>CRM Dashboard</h1>
				</div>
				<div class=block-content> 
					<div class="db-carousel jcarousel-skin-tango">
						<ul>
							<li>
								<h4>AWANA CONDOTEL AND TOWN HOUSE PROJECT</h4>
								<h2>Customer HomeTown Analysis</h2>
								<?=$c_AnalisaCustomerHome?>
							</li>
						
							<li>
								<h4>AWANA CONDOTEL AND TOWN HOUSE PROJECT</h4>
								<h2>Customer Occupation Analysis</h2>
								<?=$c_AnalisaCustomerProfesi?>
							</li>
							
							<li>
								<h4>AWANA CONDOTEL AND TOWN HOUSE PROJECT</h4>
								<h2>Customer Source Media</h2>
								<?=$c_AnalisaCustomerSourceMedia?>
							</li>
							
							
							
							<li>
								<h4>AWANA CONDOTEL AND TOWN HOUSE PROJECT</h4>
								<h2>Customer Ages</h2>
								<?=$c_AnalisaCustomerAges?>
							</li>
							
							
						</ul>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>	
	<?php #if($site_id=="5"): ?>
		<!--div class="grid_12"> 
			<div class=block-border> 
				<div class=block-header> 
					<h1>Sales Dashboard</h1>
				</div>
				<div class=block-content> 
					<div class="db-carousel jcarousel-skin-tango">
						<ul>
							<li>
								<h4>Rekap Data Front Office By Source</h4>
								<?#=$c_rekapfrontofficebysource?>
							</li>
							<li>
								<h4>Rekap Data Front Office By Date</h4>
								<?#=$c_rekapfrontofficebytgl?>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div-->
	<?#php endif; ?>	
	<!-- dashbord charts -->
<?
	$this->load->view(ADMIN_FOOTER);
?>
