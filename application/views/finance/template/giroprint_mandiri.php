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
width:875px;
padding:0px;
border:1px solid gray;
margin:0px;
height:350px;
}
img#bgr
{
position:absolute;
width:875px;
height:350px;
z-index:1;
}
p
{
position:fixed;
z-index:2;
font-size:14px;
}
p.t1
{
position:absolute;
margin-left:570px;
margin-top:37px;
}
p.t2
{
position:absolute;
margin-left:680px;
margin-top:37px;
}
p.t3
{
position:absolute;
margin-left:440px;
margin-top:57px;
}
p.t4
{
position:absolute;
margin-left:510px;
margin-top:85px;
}
p.t5
{
position:absolute;
margin-left:60px;
margin-top:110px;
}
p.t6
{
position:absolute;
margin-left:260px;
margin-top:137px;
}
p.t7
{
position:absolute;
margin-left:460px;
margin-top:137px;
}
p.t8
{
position:absolute;
margin-left:690px;
margin-top:137px;
}
p.t9
{
position:absolute;
margin-left:660px;
margin-top:237px;
}
</style>
</head>
<body onload="load()">
<img class="nonPrintable" id="bgr" src="<?=base_url();?>assets/images/mandiri_giro.jpg">
<p class="t1"> <?php echo "Jakarta";?> </p>
<p class="t2"> <?php echo $tgl;?> </p>
<p class="t3"> <?php echo $tglklr;//tgl trx?> </p>
<p class="t4"> <?php echo $jml; ?> </p>
<p class="t5"> <?php echo ucfirst(strtolower($outnominal))." rupiah";?> </p>
<p class="t6"><?php echo $norek; //no rek tujuan?> </p>
<p class="t7"><?php echo $nm;?> </p>
<p class="t8"><?php echo $nb;//nama bank tujuan?> </p>
<!--p class="t9"><-?php echo "PIC"; //PIC ?> </p-->
</body>
</html>

