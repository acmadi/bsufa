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


#header{
  position:fixed;
  z-index:1;
  font-size:12px;
  width:100%;	
  //border:dotted;  
}

#header .head1{
	float:left;
	padding : 0 0 0 0;
 	width : 30%;
 	//border:dotted;  
 	font-size:8px;
 	text-align:center;
}

#header .head2{
	float:left;
	padding : 50 0 0 0;
 	width : 30%;
 	font-size:14px;
 	//border:dotted;  
 	text-align:center; 	
}

#header .head3{
	float:left;
	padding : 0 0 0 0;
 	width : 35%;
 	//border:dotted;
 	text-align:right;  
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
  position:fixed;
  margin-left:65%;
  margin-top:60px;
  font-size:12px;
  
}

p.t2
{
  position:fixed;
  margin-left:15px;
  margin-top:145px;
  font-size:10px;
}

p.t2_1
{
  position:fixed;
  margin-left:200px;
  margin-top:145px;
  font-size:10px;	
}

p.t2_2
{
  position:fixed;
  margin-left:220px;
  margin-top:145px;
  font-size:10px;	
}


p.t3
{
  position:absolute; 
  margin-left:210px;
  margin-top:160px;
}
p.t4
{
  position:fixed;
  margin-left:15px;
  margin-top:185px;
  font-size:10px;
}

p.t4_1
{
  position:fixed;
  margin-left:200px;
  margin-top:185px;
  font-size:10px;
}
p.t4_2
{
  position:fixed;
  margin-left:220px;
  margin-top:185px;
  font-size:10px;
}
p.t5
{
  position:absolute;
  margin-left:100px;
  margin-top:212px;
}
p.t6
{
  position:fixed;
  margin-left:15px;
  margin-top:225px;
  font-size:10px;
}
p.t6_1
{
  position:fixed;
  margin-left:200px;
  margin-top:225px;
  font-size:10px;
}
p.t6_2
{
  position:fixed;
  margin-left:220px;
  margin-top:225px;
  font-size:10px;
}
p.t7
{
  position:fixed;
  margin-left:15px;
  margin-top:265px;
  font-size:10px;
}
p.t7_1
{
  position:fixed;
  margin-left:200px;
  margin-top:265px;
  font-size:10px;
}
p.t7_2
{
  position:fixed;
  margin-left:220px;
  margin-top:265px;
  font-size:10px;
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
  position:fixed;
  margin-left:15px;
  margin-top:330px;
  font-size:10px;
}
p.t12
{
  position:absolute;
  margin-left:43px;
  margin-top:425px;
}
p.t13
{
  position:fixed;
  margin-left:80%;
  margin-top:280px;
  font-size:10px;
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
	width:455px;
	//border:solid;
	position:fixed;
	margin-left:65%;
	margin-top:370px;
	text-align:center;
	font-size:10px;
}
#dc15
{
	width:455px;
	//border:solid;
	position:fixed;
	margin-left:65%;
	margin-top:380px;
	text-align:center;
	font-size:10px;
}

</style>
</head>

<body ><!--onload="load()"-->
<!--img class="nonPrintable" id="bgr" src="<?=base_url();?>assets/images/kw.jpg"-->
<div id="header">
	<div class="head1">
		<font size="3"><b>PT GRAHA MULTI INSANI</b></font><br/>
		Lantai Dasar Podium Utara Apartemen Taman Rasuna<br/>
		Jl.H.R. Rasuna Said Jakarta 12960<br/>
		Telp.021.830 5011<br/>
		Telp.021.830 5632<br/>
		Site Office :
		A. Mayjen Sutoyo No.53<br/>
		Mantri Jeron
		Kota Yogyakarta
	</div>
	<div class="head2">
	<b>KWITANSI <br/>
	OFFICIAL RECEIPT</b>
	</div>
	<!--div class="head3">
		<img src="<?=site_url('assets/images/graha.jpg')?>" width="120px" height="60px"/>
	</div-->
</div>
<p class="t1"><strong> Nomor : <?=$kwt->no_bill?> </strong></p> 
<p class="t2"><strong>Sudah terima dari</strong></p>
<p class="t2_1"><strong>:</strong></p>
<p class="t2_2"><?=$kwt->customer_nama?></p>
<p class="t3"></p>
<p class="t4"><strong>Uang Sejumlah</strong></p>
<p class="t4_1"><strong>:</strong></p>
<p class="t4_2"><?=Ucfirst(toRupiah($kwt->kwtbill_pay))?>&nbsp;Rupiah</p>
<p class="t5"></p>
<p class="t6"><strong>Untuk Pembayaran</strong></p>
<p class="t6_1"><strong>:</strong></p>
<p class="t6_2"><?=$kwt->paygroup_nm?> &nbsp; Unit&nbsp;&nbsp;<?=$kwt->unit_no?></p>
<p class="t7"><strong>Keterangan</strong></p>
<p class="t7_1"><strong>:</strong></p>
<p class="t7_2">Pembayaran &nbsp;<?=$kwt->paygroup_nm?>&nbsp;atas &nbsp;unit&nbsp;&nbsp;<?=$kwt->unit_no?>&nbsp;&nbsp;,&nbsp;&nbsp;<?=$kwt->nm_subproject?></p>
<!--p class="t8_k1"> <font style="padding-left:50px"><strong>keterangan 1 </strong></font></p>
<p class="t8_k2"> <font style="padding-left:50px"><strong>Keterangan 2 </strong></font></p>
<p class="t8_k3"> <font style="padding-left:50px"><strong>Keterangan 3 </strong></font></p-->
<p class="t9"></p>
<p class="t10"></p>
<p class="t11"><strong>Rp <?=number_format($kwt->kwtbill_pay)?> </strong></p>
<p class="t12"></p>
<p class="t13"><strong>Jakarta, <?=indo_date($kwt->kwtbill_paydate)?></strong>  </p>
<div id="dc14"><strong><u> M Reza Febrian Khadafi</u></strong></div>
<div id="dc15"><strong> Chief Officer</strong></div>
</body>
</html>

