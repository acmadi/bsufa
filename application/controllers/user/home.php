<?php
	defined('BASEPATH') or die('Access Denied');
		
	class Home extends AdminPage {

		function Home()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
			
			$this->load->library('fusioncharts');
			$this->swfChartsColumn  = base_url().'assets/FusionCharts/Column3D.swf';
			$this->swfChartsLine  = base_url().'assets/FusionCharts/Line.swf';
			$this->swfChartsPie  = base_url().'assets/FusionCharts/Pie3D.swf';
		}
		
		function index()
		{			
			//rendering charts
			$data['c_rekapjumlahcustomer'] = $this->rekapJumlahCustomer();
			$data['c_rekapjumlahkenaikancustomer'] = $this->rekapJumlahKenaikanCustomer();
			$data['c_rekapjumlahstatuscustomer'] = $this->rekapJumlahStatusCustomer();
			$data['c_rekapcustomerbyprofesi'] = $this->rekapCustomerByProfesi();
			$data['c_rekapcustomerbykota'] = $this->rekapCustomerByKota();
			$data['c_rekapcustomerprospectbypayment'] = $this->rekapCustomerProspectByPayment();
			$data['c_rekapfrontofficebysource'] = $this->rekapFrontOfficeBySource();
			$data['c_rekapfrontofficebytgl'] = $this->rekapFrontOfficeByTgl();
			$data['c_AnalisaCustomerHome'] = $this->AnalisaCustomerHome();
			$data['c_AnalisaCustomerProfesi'] = $this->AnalisaCustomerProfesi();
			$data['c_AnalisaCustomerSourceMedia'] = $this->AnalisaCustomerSourceMedia();
			$data['c_AnalisaCustomerAges'] = $this->AnalisaCustomerAges();
			
			
			
			$this->parameters = $data;
			$this->loadTemplate('user/home_view');
		}
		
		function sites($id) {		
			if($id!="")
				$this->UserLogin->setSites($id);
			else
				$this->UserLogin->setSites("0");
			$this->index();
		}
		
		function rekapCustomerByProfesi() {
			$sql = "select COUNT(a.id_profesi) as jumlah, ISNULL(b.profesi_nm, 'Others') as profesi from db_customer a left join db_profesi b on b.profesi_id = a.id_profesi group by b.profesi_nm";
			$cust = $this->ado->GetAll($sql);
			
			$count = 0;
			if($cust) {
				foreach($cust as $c) {
					$arrData[$count][1] = $c->profesi;
					$arrData[$count][2] = $c->jumlah;
					$count++;
				}
			}
			
			$strXML = $this->fusioncharts->setDataXML($arrData,'','','javascript:alert("tes");') ;
			
			return $this->fusioncharts->renderChart($this->swfChartsColumn,'',$strXML,"rekapCustomerByProfesi", 440, 300, false, false);
		}
		
		function rekapCustomerByKota() {
			$sql = "select COUNT(a.customer_id) as jumlah, ISNULL(b.kota_nm, 'Other') as kota from db_customer a left join db_kota b on b.kota_id = a.id_kota group by b.kota_nm";
			$cust = $this->ado->GetAll($sql);
			
			$count = 0;
			if($cust) {
				foreach($cust as $c) {
					$arrData[$count][1] = $c->kota;
					$arrData[$count][2] = $c->jumlah;
					$count++;
				}
			}
			
			$strXML = $this->fusioncharts->setDataXML($arrData,'','') ;
			
			return $this->fusioncharts->renderChart($this->swfChartsColumn,'',$strXML,"rekapCustomerByKota", 920, 300, false, false);
		}
		
		function rekapJumlahCustomer() {
			$arrData[0][1] = "Jan";
			$arrData[1][1] = "Feb";
			$arrData[2][1] = "Mar";
			$arrData[3][1] = "Apr";
			$arrData[4][1] = "Mei";
			$arrData[5][1] = "Jun";
			$arrData[6][1] = "Jul";
			$arrData[7][1] = "Agu";
			$arrData[8][1] = "Sep";
			$arrData[9][1] = "Okt";
			$arrData[10][1] = "Nov";
			$arrData[11][1] = "Des";

			$item = 0;
			foreach($arrData as $a) {
				//$sql = "select count(*) as jumlah from customer where month(tgl_input) = ". ($item+1) ." and year(tgl_input) = year(GETDATE())";
				//$cust = $this->ado->GetAll($sql);
				//$arrData[$item][2] = $cust[0]->jumlah;
				$arrData[$item][2] = rand ( 0 , 250 );
				$item++;
			}

			$strXML = $this->fusioncharts->setDataXML($arrData,'','') ;
			
			return $this->fusioncharts->renderChart($this->swfChartsColumn,'',$strXML,"rekapCustomer", 440, 300, false, false);
		}
		
		function rekapJumlahKenaikanCustomer() {
			$arrData[0][1] = "Jan";
			$arrData[1][1] = "Feb";
			$arrData[2][1] = "Mar";
			$arrData[3][1] = "Apr";
			$arrData[4][1] = "Mei";
			$arrData[5][1] = "Jun";
			$arrData[6][1] = "Jul";
			$arrData[7][1] = "Agu";
			$arrData[8][1] = "Sep";
			$arrData[9][1] = "Okt";
			$arrData[10][1] = "Nov";
			$arrData[11][1] = "Des";

			$item = 0;
			$bulanlalu = 0;
			foreach($arrData as $a) {
				//$sql = "select count(*) as jumlah from customer where month(tgl_input) = ". ($item+1) ." and year(tgl_input) = year(GETDATE())";
				//$cust = $this->ado->GetAll($sql);
				
				//if($item==0) $arrData[$item][2] = 0;
				//else $arrData[$item][2] = $bulanlalu - $cust[0]->jumlah;
				//$bulanlalu = $cust[0]->jumlah;
				
				$arrData[$item][2] = rand ( 0 , 50 );
				$item++;
			}

			$strXML = $this->fusioncharts->setDataXML($arrData,'','') ;
			
			return $this->fusioncharts->renderChart($this->swfChartsLine,'',$strXML,"rekapKenaikanCustomer", 440, 300, false, false);
		}
		
		function rekapFrontOfficeByTgl() {
			$sql = "select COUNT(fo_id) as jumlah, tgl as ket from db_fo group by tgl";
			$cust = $this->ado->GetAll($sql);
			
			$count = 0;
			if($cust) {
				foreach($cust as $c) {
					$arrData[$count][1] = date("d-m-Y", strtotime($c->ket));
					$arrData[$count][2] = $c->jumlah;
					$count++;
				}
			}			
			
			$strXML = $this->fusioncharts->setDataXML($arrData,'','') ;
			
			return $this->fusioncharts->renderChart($this->swfChartsLine,'',$strXML,"rekapFrontOfficeByTgl", 440, 300, false, false);
		}
		
		function rekapJumlahStatusCustomer() {
			$arrData[0][1] = "Karyawan";
			$arrData[1][1] = "Wiraswasta";
			$arrData[2][1] = "Profesional";
			$arrData[3][1] = "Artist";

			$item = 0;
			$bulanlalu = 0;
			foreach($arrData as $a) {
				$arrData[$item][2] = rand ( 20 , 80 );
				$item++;
			}

			$strXML = $this->fusioncharts->setDataXML($arrData,'','') ;
			
			return $this->fusioncharts->renderChart($this->swfChartsPie,'',$strXML,"c_rekapJumlahStatusCustomer", 440, 300, false, false);
		}
		
		function rekapCustomerProspectByPayment() {
			$sql = "select COUNT(custcomp_id) as jumlah, payment from db_custcomp group by payment";
			$cust = $this->ado->GetAll($sql);
			
			$count = 0;
			if($cust) {
				foreach($cust as $c) {
					$arrData[$count][1] = $c->payment;
					$arrData[$count][2] = $c->jumlah;
					$count++;
				}
			}			
			
			$strXML = $this->fusioncharts->setDataXML($arrData,'','') ;
			
			return $this->fusioncharts->renderChart($this->swfChartsPie,'',$strXML,"rekapCustomerProspectByPayment", 400, 300, false, false);
		}
		
		function AnalisaCustomerHome() {
			$sql = "select propinsi_nm, count(propinsi_nm) as jml from db_sp 
					join db_customer on id_customer = customer_id
					join db_propinsi on id_propinsi1 = propinsi_id
					where db_sp.id_flag = 1 
					group by propinsi_nm";
			
			$cust = $this->ado->GetAll($sql);
			#var_dump($cust);
			$count = 0;
			if($cust) {
				foreach($cust as $c) {
					$arrData[$count][1] = $c->propinsi_nm;
					$arrData[$count][2] = $c->jml;
					$count++;
				}
			}			
			
			$strXML = $this->fusioncharts->setDataXML($arrData,'','') ;
			
			return $this->fusioncharts->renderChart($this->swfChartsPie,'',$strXML,"AnalisaCustomerHome", 400, 300, false, false);
		}
		
		function AnalisaCustomerSourceMedia() {
			$sql = "select media_nm,count(media_nm) as jml from db_sp 
					join db_customer on id_customer = customer_id
					join db_media on id_media = media_id
					where db_sp.id_flag = 1 
					Group by media_nm";
			
			$cust = $this->ado->GetAll($sql);
			#var_dump($cust);
			$count = 0;
			if($cust) {
				foreach($cust as $c) {
					$arrData[$count][1] = $c->media_nm;
					$arrData[$count][2] = $c->jml;
					$count++;
				}
			}			
			
			$strXML = $this->fusioncharts->setDataXML($arrData,'','') ;
			
			return $this->fusioncharts->renderChart($this->swfChartsPie,'',$strXML,"AnalisaCustomerSourceMedia", 400, 300, false, false);
		}
		
		
		
		function AnalisaCustomerProfesi() {
			$sql = "select profesi_nm, count(profesi_nm) as jml from db_sp 
					join db_customer on id_customer = customer_id
					join db_profesi on id_profesi = profesi_id
					where db_sp.id_flag = 1 
					group by profesi_nm";
			
			$cust = $this->ado->GetAll($sql);
			#var_dump($cust);
			$count = 0;
			if($cust) {
				foreach($cust as $c) {
					$arrData[$count][1] = $c->profesi_nm;
					$arrData[$count][2] = $c->jml;
					$count++;
					#var_dump($arrData[$count][1]);exit;
				}
			}			
			$strXML = $this->fusioncharts->setDataXML($arrData,'','') ;
			
			return $this->fusioncharts->renderChart($this->swfChartsPie,'',$strXML,"AnalisaCustomerProfesi", 400, 300, false, false);
		}
		
		function AnalisaCustomerAges() {
			#lebih dari 50 tahun
			$sql = "select count(datediff(Year,customer_tgl_lhr,tgl_sales)) as thn from db_sp 
					join db_customer on id_customer = customer_id
					where datediff(Year,customer_tgl_lhr,tgl_sales) > 50 and db_sp.id_flag = 1";
			
			#antara 40 - 50
			$sql1 = "select count(datediff(Year,customer_tgl_lhr,tgl_sales)) as thn from db_sp 
					join db_customer on id_customer = customer_id
					where datediff(Year,customer_tgl_lhr,tgl_sales) between 40 and 50 and db_sp.id_flag = 1";
					
			#antara 30 - 40
			$sql2 = "select count(datediff(Year,customer_tgl_lhr,tgl_sales)) as thn from db_sp 
					join db_customer on id_customer = customer_id
					where datediff(Year,customer_tgl_lhr,tgl_sales) between 30 and 40 and db_sp.id_flag = 1";	
					
			#antara kurang dari 30
			$sql3 = "select count(datediff(Year,customer_tgl_lhr,tgl_sales)) as thn from db_sp 
					join db_customer on id_customer = customer_id
					where datediff(Year,customer_tgl_lhr,tgl_sales) < 30 and db_sp.id_flag = 1";	
			
			$row1 = $this->db->query($sql)->row();
			$row2 = $this->db->query($sql1)->row();
			$row3 = $this->db->query($sql2)->row();
			$row4 = $this->db->query($sql3)->row();
			#var_dump($row4);exit;
			
			/*$cust = $this->ado->GetAll($sql);
			#var_dump($cust);
			$count = 0;
			if($cust) {
				foreach($cust as $c) {
					$arrData[$count][1] = $c->media_nm;
					$arrData[$count][2] = $c->jml;
					$count++;
				}
			}*/
			#$x = array('','Age > 50 Year Old','40 - 50 Year Old','30 - 40 Year Old','< 30');
			#$y = array($row1->thn,$row2->thn,$row3->thn,$row4->thn);
			$arrData[0][1] = "Besar dari 50";
			$arrData[1][1] = "40 - 50 Year Old";
			$arrData[2][1] = "30 - 40 Year Old";
			$arrData[3][1] = "kecil dari 30";
			
			$arrData[0][2] = $row1->thn;
			$arrData[1][2] = $row2->thn;
			$arrData[2][2] = $row3->thn;
			$arrData[3][2] = $row4->thn;
			#$arrData[3][2] = 4;
						
			
			#$length = count($y);
			#var_dump($length);exit;
			/*$count = 0;
			$i = 0;
			foreach($arrData as $a){
					#$arrData[$count][1] = $x[$i];
					$arrData[$count][2] = $y[$i];
					$count++;		
					$i++;	
					#var_dump($arrData[$count][1]);exit;
			}	*/		
			
			$strXML = $this->fusioncharts->setDataXML($arrData,'','');
			
			return $this->fusioncharts->renderChart($this->swfChartsPie,'',$strXML,"AnalisaCustomerAges", 400, 300, false, false);
		}
		
		
		
		
		
		function rekapFrontOfficeBySource() {
			$sql = "select COUNT(fo_id) as jumlah, [source] as ket from db_fo group by [source]";
			$cust = $this->ado->GetAll($sql);
			
			$count = 0;
			if($cust) {
				foreach($cust as $c) {
					$arrData[$count][1] = $c->ket;
					$arrData[$count][2] = $c->jumlah;
					$count++;
				}
			}			
			
			$strXML = $this->fusioncharts->setDataXML($arrData,'','') ;
			
			return $this->fusioncharts->renderChart($this->swfChartsPie,'',$strXML,"rekapFrontOfficeBySource", 400, 300, false, false);
		}
	}
?>
