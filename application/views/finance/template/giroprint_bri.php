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
//border:1px solid gray;
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
margin-left:775px;
margin-top:25px;
}
p.t2
{
position:absolute;
margin-left:880px;
margin-top:20px;
}
p.t3
{
position:absolute;
margin-left:355px;
margin-top:40px;
}
p.t4
{
position:absolute;
margin-left:240px;
margin-top:70px;
font-size:16px;
}
p.t5
{
position:absolute;
margin-left:615px;
margin-top:70px;
}
p.t6
{
position:absolute;
margin-left:230px;
margin-top:105px;
}
p.t7
{
position:absolute;
margin-left:530px;
margin-top:110px;
}
p.t8
{
position:absolute;
margin-left:860px;
margin-top:105px;
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
<!--img class="nonPrintable" id="bgr" src=""><!--?=base_url();?>assets/images/btn_giro.jpg"-->
<p class="t1"> <?php echo "Jakarta";?> </p>
<p class="t2"> <?php echo $tgl;?> </p>
<p class="t3"> <?php echo $tglklr;//tgl trx?> </p>
<p class="t4"><strong> <?php echo $jml; ?> </strong></p>
<p class="t5"> <?php echo ucfirst(strtolower($outnominal))." rupiah";?> </p>
<p class="t6"><?php echo $norek; //no rek tujuan?> </p>
<p class="t7"><?php echo $nm;?> </p>
<p class="t8"><?php echo $nb;//nama bank tujuan?> </p>
<!--p class="t9"><-?php echo "PIC"; //PIC ?> </p-->
</body>
</html>

