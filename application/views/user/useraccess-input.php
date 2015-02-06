<link rel="stylesheet" href="<?=base_url()?>assets/css/tabcontent.css" type="text/css" />
<script language="javascript" src="<?=base_url()?>assets/js/tabcontent.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.formx.js"></script>

<script language="javascript">
	$.validationEngineLanguage.allRules['ajaxValidateNip'] = {
		"url": "<?=site_url('useraccess/cekuser')?>",
	    "alertText": "*This name is already taken",
	    "alertTextOk": "This name is avaliable",
	    "alertTextLoad": "* Validating, please wait"
	};
	
	$(function(){
		$('#formAdd')
		.validationEngine()
		.ajaxForm({
			success:function(response){
				alert(response);
				refreshTable();
				//$('#buttonID').click();
			}
		});
	});
</script>
<script type="text/javascript">
	var countries=new ddtabcontent("countrytabs")
	countries.setpersist(true)
	countries.setselectedClassTarget("link") //"link" or "linkparent"
	countries.init()
</script>

<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuformx.css" type="text/css" />
<form method="post" action="<?=site_url('useraccess/save')?>" id="formAdd">
 
<ul id="countrytabs" class="shadetabs">
	<li><a href="#" rel="country1" class="selected">User Access</a></li>
	<li><a href="#" rel="country2">Information User</a></li>
</ul>

<div style="border:1px solid gray; width:450px; margin-bottom: 1em; padding: 10px">

	<div id="country1" class="tabcontent">
	<table border="0" cellspacing="2" cellpadding="2">
		<tr>
			<td>Group ID</td>
			<td>:</td>
			<td>
				<select name="group" id="group" class="xinput">
					<?php foreach($UserGroup as $row): ?>
						<option value="<?=$row->id_group?>"><?=$row->group_name?></option>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>PT</td>
			<td>:</td>
			<td>
				<select name="pt" id="pt" class="xinput">
					<?php foreach($pt as $row): ?>
						<option value="<?=$row->id_pt?>"><?=$row->nm_pt?></option>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Divisi</td>
			<td>:</td>
			<td>
				<select name="divisi" id="divisi" class="xinput">
					<?php foreach($divisi as $row): ?>
						<option value="<?=$row->divisi_id?>"><?=$row->divisi_nm?></option>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>		
		<tr>
			<td>Username</td>
			<td>:</td>
			<td>
				<input type="text" name="username" id="username" class="xinput validate[required,ajax[ajaxValidateNip]"/> *
			</td>
		</tr>
		<tr>
			<td>Password</td>
			<td>:</td>
			<td>
				<input type="password" name="pass1" id="pass1" class="xinput validate[required]"/> *
			</td>
		</tr>
		<tr>
			<td>Password Confirmation</td>
			<td>:</td>
			<td>
				<input type="password" name="pass2" id="pass2" class="xinput validate[required,equals[pass1]]"/> *
			</td>
		</tr>
		<tr>
			<td>Status</td>
			<td>:</td>
			<td>
				<input type="radio" name="status" value="on" selected/> On
				<input type="radio" name="status" value="off"/> Off
			</td>
		</tr>					
	</table>	
	</div>
	<div id="country2" class="tabcontent">
	Tab content 2 here<br />Eko Saputra<br />
	</div>
</div>
<?=form_submit('submit','Save')?>
<?=form_submit('reset','Clear')?>
<!--<h1>User Access</h1>
<input type="hidden" name="hidesell" id="hidesell"/>-->
</form>



