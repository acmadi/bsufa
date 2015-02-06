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
//margin:0px;
  margin-left:100px;
  margin-top:40px;
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
 	font-size:6px;
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
  margin-left:855px;
  margin-top:38px;
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
  margin-left:75px;
  margin-top:95px;
  font-size:12px;	
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
  margin-left:75px;
  margin-top:150px;
  font-size:12px;
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
  margin-left:75px;
  margin-top:197px;
  font-size:12px;
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

p.t7_x1
{
  position:fixed;
  margin-left:200px;
  margin-top:280px;
  font-size:10px;
}

p.t7_2
{
  position:fixed;
  margin-left:75px;
  margin-top:240px;
  font-size:12px;
}

p.t7_x2
{
  position:fixed;
  margin-left:220px;
  margin-top:285px;
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
  position:absolute;
  margin-left:-40px;
  margin-top:327px;
  font-size:12px;
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
  margin-left:875px;
  margin-top:304px;
  font-size:12px;
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
p.dc14
{
	
	position:absolute;
	margin-left:860px;
	margin-top:400px;
	
	font-size:12px;
}
p.dc15
{
	
	position:absolute;
	margin-left:860px;
	margin-top:420px;
	font-size:12px;
}

</style>
</head>

<body onload="load()">
<!--img class="nonPrintable" id="bgr" src="<?#=base_url();?>assets/images/kw.jpg"-->
<!--
<div id="header">
	<div class="head1">
		<font size="2"><b>PT GRAHA MULTI INSANI</b></font><br/>
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
		<img src="<?#=site_url('assets/images/graha.jpg')?>" width="120px" height="60px"/>
	</div-->
<!--
</div>
-->

<p class="t1"><strong><?=$cekdt->kwtbill_no?> </strong></p> 
<!--
<p class="t2"><strong>Sudah terima dari</strong></p>
-->
<!--
<p class="t2_1"><strong>:</strong></p>
-->
<p class="t2_2"><?=$cekdt->customer_nama?></p>
<p class="t3"></p>
<!--
<p class="t4"><strong>Uang Sejumlah</strong></p>
-->
<!--
<p class="t4_1"><strong>:</strong></p>
-->
<p class="t4_2"><?=Ucfirst(toRupiah($cekdt->kwtbill_pay))?>&nbsp;Rupiah</p>
<p class="t5"></p>
<!--
<p class="t6"><strong>Untuk Pembayaran</strong></p>
-->
<!--
<p class="t6_1"><strong>:</strong></p>
-->
<p class="t6_2"><?=$cekdt->paygroup_nm?> &nbsp; Unit&nbsp;&nbsp;<?=$cekdt->unit_no?>&nbsp;&nbsp;dari harga jual Rp <?=number_format($cekdt->selling_price)?></p>
<!--
<p class="t7"><strong>Keterangan</strong></p>
-->
<!--
<p class="t7_1"><strong>:</strong></p>
-->
<p class="t7_2"><?=$cekdt->kwtbill_remark?>&nbsp;-&nbsp;<?=$cekdt->kwtbill_descs?></p>
<!--p class="t7_x1"><strong>:</strong></p>
<p class="t7_x2"><?#=$cekdt->kwtbill_remark?></p-->
<!--p class="t8_k1"> <font style="padding-left:50px"><strong>keterangan 1 </strong></font></p>
<p class="t8_k2"> <font style="padding-left:50px"><strong>Keterangan 2 </strong></font></p>
<p class="t8_k3"> <font style="padding-left:50px"><strong>Keterangan 3 </strong></font></p-->
<p class="t9"></p>
<p class="t10"></p>
<p class="t11"><strong><?=number_format($cekdt->kwtbill_pay)?> </strong></p>
<p class="t12"></p>
<p class="t13"><strong><?=indo_date($cekdt->kwtbill_paydate)?></strong>  </p>
<p class="t12"></p>
<p class="dc14"><strong><u>Sovialisma. MDS</u></strong></p>
<p class="dc15"><strong>Retail & Strata Dept. Head</strong></p>
</body>
</html>

