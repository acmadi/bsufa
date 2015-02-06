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
//width:875px;
//padding:0px;
//border:1px solid gray;
margin:0px;
height:350px;
font-family:sans-serif;
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
margin-left:825px;
margin-top:20px;
}
p.t2
{
position:absolute;
margin-left:900px;
margin-top:20px;
}
p.t3
{
position:absolute;
margin-left:400px;
margin-top:45px;
}
p.t4
{
position:absolute;
margin-left:350px;
margin-top:65px;
}
p.t5
{
position:absolute;
margin-left:860px;
margin-top:95px;
}
p.t6
{
position:absolute;
margin-left:790px;
margin-top:80px;
font-size:16px;
}
p.t7
{
position:absolute;
margin-left:670px;
margin-top:220px;
}
</style>
</head>
<body onload="load()">
<!--img class="nonPrintable" id="bgr" src="<-?=base_url();?>assets/images/btn_cek.jpg"-->
<p class="t1"> <?php echo "Jakarta";?> </p>
<p class="t2"> <?php echo $tgl;?> </p>
<p class="t3"> <?php echo $nm;?> </p>
<p class="t4"> <?php echo ucfirst(strtolower($outnominal))." rupiah";?> </p>
<p class="t5"> - </p>
<p class="t6"><STRONG> <?php echo $jml;?> </STRONG></p>
<!--p class="t7"><-?php echo $nm;?> </p-->
</body>
</html>

