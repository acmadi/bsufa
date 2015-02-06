<?
	$this->load->view(ADMIN_HEADER);
	$session_id = $this->UserLogin->isLogin();
	$data =  $session_id['username'];
	#echo '<h2 align="center">Selamat Datang</h2>'.$data;
?>
	<!-- shortcut menu -->
		<div class=grid_12> 
		<? if(isset($sites_menu)): ?>
		<? echo $sites_menu?>
		<? endif; ?>			
			<!--div class=block-border> <div class=block-content> <ul class=shortcut-list> <li> <a href="javascript:void(0);"> <img src="<?=base_url()?>assets/img/icons/packs/crystal/48x48/apps/kedit.png"> Write an Article </a> </li> <li> <a href="javascript:void(0);"> <img src="<?=base_url()?>assets/img/icons/packs/crystal/48x48/apps/penguin.png"> User Manager </a> </li> <li> <a href="javascript:void(0);"> <img src="<?=base_url()?>assets/img/icons/packs/crystal/48x48/apps/wifi.png"> Control Monitor </a> </li> <li> <a href="javascript:void(0);"> <img src="<?=base_url()?>assets/img/icons/packs/crystal/48x48/apps/mailreminder.png"> Check the Mails </a> </li> <li> <a href="javascript:void(0);"> <img src="<?=base_url()?>assets/img/icons/packs/crystal/48x48/apps/Volume%20Manager.png"> Statistics </a> </li> <li> <a href="javascript:void(0);"> <img src="<?=base_url()?>assets/img/icons/packs/crystal/48x48/apps/terminal.png"> Manage Console </a> </li> <li> <a href="javascript:void(0);"> <img src="<?=base_url()?>assets/img/icons/packs/crystal/48x48/apps/knotes.png"> Notes </a> </li> <li> <a href="javascript:void(0);"> <img src="<?=base_url()?>assets/img/icons/packs/crystal/48x48/apps/kview.png"> Manage Images </a> </li> </ul> <div class=clear></div> </div> 
			</div--> 
		</div> 
	<!-- shortcut menu -->
	
	<!-- dashbord charts -->
		<!--div class=grid_4> 
			<div class=block-border> 
				<div class=block-header> 
					<h1>Rekap Jumlah Customer</h1>
					<span></span> 
				</div>
			</div> 
		</div> 
		<div class=grid_4> 
			<div class=block-border> 
				<div class=block-header> 
					<h1>Rekap Jumlah Kenaikan Data Customer</h1>
					<span></span> 
				</div>
			</div> 
		</div> 
		<div class=grid_4> 
			<div class=block-border> 
				<div class=block-header> 
					<h1>Rekap Status Data Customer</h1>
					<span></span> 
				</div>
			</div> 
		</div--> 
	<!-- dashbord charts -->
<?
	$this->load->view(ADMIN_FOOTER);
?>
