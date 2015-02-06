<html>
<head>
<script type="text/javascript">
function load()
{
  window.print();
  window.close();
}
</script>
<style type="text/css" media="print">
    .NonPrintable
    {
      display: none;
    }
  </style>

<style type="text/css">

body
{
//width:1280px;
//padding:0px;
//border:1px solid gray;
margin:0px;
//height:490px;
font-family:sans-serif;
}

img#bgr
{
     position:absolute;
     width:1280px;
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
  margin-left:965px;
  margin-top:85px;
  
}
p.t2
{
  position:absolute;
  margin-left:210px;
  margin-top:145px;
}
p.t3
{
  position:absolute; 
  margin-left:210px;
  margin-top:160px;
}
p.t4
{
  position:absolute;
  margin-left:210px;
  margin-top:193px;
}
p.t5
{
  position:absolute;
  margin-left:210px;
  margin-top:212px;
}
p.t6
{
  position:absolute;
  margin-left:210px;
  margin-top:240px;
}
p.t7
{
  position:absolute;
  margin-left:210px;
  margin-top:278px;
}
p.t8_k1
{
  position:absolute;
  margin-left:210px;
  margin-top:287px;
}
p.t8_k2
{
  position:absolute;
  margin-left:210px;
  margin-top:302px;
}
p.t8_k3
{
  position:absolute;
  margin-left:210px;
  margin-top:317px;
}
p.t9
{
  position:absolute;
  margin-left:210px;
  margin-top:328px;
}
p.t10
{
  position:absolute;
  margin-left:210px;
  margin-top:345px;
}
p.t11
{
  position:absolute;
  margin-left:60px;
  margin-top:370px;
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
  margin-left:970px;
  margin-top:348px;
}
p.t14
{
  position:absolute;
  margin-left:930px;
  margin-top:440px;
  
}

p.t15
{
  position:absolute;
  margin-left:930px;
  margin-top:455px;
}
#dc14
{
	width:300px;
	//border:solid;
	position:absolute;
	margin-left:880px;
	margin-top:440px;
	text-align:center;
	font-size:12px;
}
#dc15
{
	width:300px;
	//border:solid;
	position:absolute;
	margin-left:880px;
	margin-top:455px;
	text-align:center;
	font-size:12px;
}

</style>
</head>

<body onload="load()">
<!--img class="nonPrintable" id="bgr" src="<?=base_url();?>assets/images/kw.jpg"-->
<p class="t1"><strong> <?php echo $nomor;?> </strong></p> 
<p class="t2"><strong> <?php echo $tdari;?> </strong> </p>
<p class="t3">   </p>
<p class="t4"> <strong><?php echo "# ".ucwords($outnominal)." ".$format." #" ;?></strong> </p>
<p class="t5">  </p>
<p class="t6"> <strong><?php echo $untuk;?></strong>  </p>
<p class="t7">  </p>
<p class="t8_k1"> <strong><?php echo $ket1;?> </strong> </p>
<p class="t8_k2"> <strong><?php echo $ket2;?> </strong> </p>
<p class="t8_k3"> <strong><?php echo $ket3;?> </strong> </p>
<p class="t9">  </p>
<p class="t10"> </p>
<p class="t11"> <strong><?php echo number_format($jumlah);?> </strong></p>
<p class="t12">  </p>
<p class="t13"> <strong><?php echo indo_datem($tgl);?></strong>  </p>
<div id="dc14"><strong><u> <?php echo $nama;?> </u></strong></div>
<div id="dc15"><strong> <?php echo $jabatan;?></strong></div>


</body>
</html>

