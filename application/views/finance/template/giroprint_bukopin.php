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
font-size:12px;
}
p.t1
{
position:absolute;
margin-left:730px;
margin-top:22px;
}
p.t2
{
position:absolute;
margin-left:870px;
margin-top:22px;
}
p.t3
{
position:absolute;
margin-left:480px;
margin-top:35px;
}
p.t4
{
position:absolute;
margin-left:660px;
margin-top:51px;
font-size:16px;
}
p.t5
{
position:absolute;
margin-left:75px;
margin-top:70px;
}
p.t6
{
position:absolute;
margin-left:325px;
margin-top:95px;
}
p.t7
{
position:absolute;
margin-left:585px;
margin-top:95px;
}
p.t8
{
position:absolute;
margin-left:895px;
margin-top:95px;
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
<!--img class="nonPrintable" id="bgr" src="><!--?=base_url();?>assets/images/bukopin_giro.jpg"-->
<p class="t1"> <?php echo "Jakarta";?> </p>
<p class="t2"> <?php echo $tgl;?> </p>
<p class="t3"> <?php echo $tglklr;//tgl trx?> </p>
<p class="t4"><STRONG> <?php echo $jml; ?> </STRONG></p>
<p class="t5"> <?php echo ucfirst(strtolower($outnominal))." rupiah";?> </p>
<p class="t6"><?php echo $norek; //no rek tujuan?> </p>
<p class="t7"><?php echo $nm;?> </p>
<p class="t8"><?php echo $nb;//nama bank tujuan?> </p>
<!--p class="t9"><-?php echo "PIC"; //PIC ?> </p-->
</body>
</html>

