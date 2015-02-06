<html>
<head>
<style type="text/css">

body
{
width:800px;
//padding:0px;
//border:1px solid gray;
margin:0px;
height:490px;
}

img#bgr
{
     position:absolute;
     width:800px;
     height:535px;
     z-index:1;
}
p
{
  position:fixed;
  z-index:2;
  font-size:12px;
}

p.t1
{
  position:absolute;
  margin-left:610px;
  margin-top:93px;
  
}
p.t2
{
  position:absolute;
  margin-left:140px;
  margin-top:160px;
}
p.t3
{
  position:absolute; 
  margin-left:140px;
  margin-top:176px;
}
p.t4
{
  position:absolute;
  margin-left:140px;
  margin-top:211px;
}
p.t5
{
  position:absolute;
  margin-left:140px;
  margin-top:228px;
}
p.t6
{
  position:absolute;
  margin-left:140px;
  margin-top:261px;
}
p.t7
{
  position:absolute;
  margin-left:140px;
  margin-top:278px;
}
p.t8
{
  position:absolute;
  margin-left:140px;
  margin-top:310px;
}
p.t9
{
  position:absolute;
  margin-left:140px;
  margin-top:328px;
}
p.t10
{
  position:absolute;
  margin-left:140px;
  margin-top:345px;
}
p.t11
{
  position:absolute;
  margin-left:43px;
  margin-top:393px;
}
p.t12
{
  position:absolute;
  margin-left:43px;
  margin-top:425px;
}
p.t13
{
  position:absolute;
  margin-left:608px;
  margin-top:376px;
}
p.t14
{
  position:absolute;
  margin-left:540px;
  margin-top:488px;
}
input
{
	position : absolute;
	margin-top: 550px;
	margin-left : 50px;

}

</style>
</head>

<body onload="load()">
<img class="nonPrintable" id="bgr" src="<?=base_url();?>assets/images/kw.jpg">
<p class="t1"> <?php echo $nomor;?> </p> 
<p class="t2"> <?php echo $tdari;?>  </p>
<p class="t3">   </p>
<p class="t4"> <?php echo $outnominal;?> </p>
<p class="t5">  </p>
<p class="t6"> <?php echo $untuk;?>  </p>
<p class="t7">  </p>
<p class="t8"> <?php echo $kets;?>  </p>
<p class="t9">  </p>
<p class="t10"> </p>
<p class="t11"> <?php echo number_format($jumlah);?> </p>
<p class="t12">  </p>
<p class="t13"> <?php echo $tgl;?>  </p>
<p class="t14"> <?php echo $ttd;?>  </p>
<form method="post" action="<?=site_url('kwitansi/kwitansi_view')?>" id="formAdd" target="_blank"> 
	<input type="hidden" name="nomor" value="<?php echo $nomor;?>" />
	<input type="hidden" name="tdari" value="<?php echo $tdari;?>" />
	<input type="hidden" name="jumlah" value="<?php echo $jumlah;?>" />
	<input type="hidden" name="untuk" value="<?php echo $untuk;?>" />
	<input type="hidden" name="kets" value="<?php echo $kets;?>" />
	<input type="hidden" name="tgl" value="<?php echo $tgl;?>" />
	<input type="hidden" name="ttd" value="<?php echo $ttd;?>" />
	<input type="hidden" name="curr" value="<?php echo $curr;?>" />
	<input type="submit" value="Print" name="Print" />
<!--input type="submit" name="choice" onclick="window.open('kwprint.php','popuppage','width=870,toolbar=0,menubar=1,status=0,resizable=0,scrollbars=no,height=590,top=100,left=100');" value="Print Kwitansi"-->
</form>
</body>
</html>
