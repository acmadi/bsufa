<!DOCTYPE html>
<html>
<head>
 
	<title>Cashflow Controll Page</title>
	
	
    <script src="<?php echo base_url();?>assets/js/jquery-1.7.2.min.js"></script> 
	
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    
	<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/styless.css" rel="stylesheet">
    
	<style>
		div.scroll {
			background-color: #ffffff;
			width: 1200px;
			height: 500px;
			overflow: scroll;
		}

</style>
	
</head>

<body>
	
	
	<br>	
	<br>
	
  <div class="main-inner">
    <div class="container" style="width:1300px">
	<tr>
			<td style="width: 170px;">Project</td>
			<td>
				<select name="subproject" id="subproject" class="mytextbox">
					<?php if($this->session->userdata('sessproject') != ''){
							$query = $this->db->query("select kd_project,nm_project from project where kd_project = ".$this->session->userdata('sessproject')." ")->row();
							?>
							<option value="<?php echo $query->kd_project;?>" selected> <?php echo $query->nm_project;?> </option>
					<?php } ?>
					<option> Pilih Project </option>
				</select>
			</td>
	</tr>
	<input type="submit" value="VIEW" id="submit" name="submit" class="mytextboxx" />
	
	<div class="row">
	<div class="span12">      		  		
  		<div class="widget ">
  			<div class="widget-header">
  				<i class="icon-user"></i>
  				<h3>CashFlow Control</h3>
			</div> <!-- /widget-header -->
			
			<div class="widget-content">
				<div class="span11">
					<div class="">
					<table id="example1" class="table table-bordered table-striped" style="width:1200px">
	                	<thead>
	                        <tr> 
                                <th>Nomor</th>
                                <th>Uraian</th>
                                <th>Petty Cash</th>
	                            <? foreach ($bankcf as $row2){ ?>
								<th><?=@$row2->bank_store;?></th>
								<? } ?>
	                        </tr>
	                    </thead>
	                    <tbody>
							<? foreach ($judulcf as $row){ ?>
	                        <tr>
	                        	<td><?=@$row->kodecash;?></td>
	                        	<td><?=@$row->nama;?></td>
	                        	<td></td>
	                        	 <? foreach ($bankcf as $row2){ ?>
								<td></td>
								<? } ?>
	                        </tr>
							<? } ?>
	                    </tbody>
	               	</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</div>	
</div>


	
	</div>
	

</body>

<script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/js/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $("#example2").dataTable();
        $("#example3").dataTable();
        $("#example4").dataTable();
        $("#example5").dataTable();
        $('#example1').dataTable({
            "bPaginate": false,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": true
        });
    });
</script>



</html>

