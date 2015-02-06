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
			$data['c_cekdata'] = $this->cekdata();
			
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
			
			$strXML = $this->fusioncharts->setDataXML($arrData,'','','Detail.php?id=asd') ;
			
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

			$item = 0;
			$bulanlalu = 0;
			foreach($arrData as $a) {
				$arrData[$item][2] = rand ( 20 , 80 );
				$item++;
			}

			$strXML = $this->fusioncharts->setDataXML($arrData,'','') ;
			
			return $this->fusioncharts->renderChart($this->swfChartsPie,'',$strXML,"rekapStatusCustomer", 440, 300, false, false);
		}
		
		function cekdata() {
			$arrData[0][1] = "Karyawan";
			$arrData[1][1] = "Wiraswasta";
			$arrData[2][1] = "Profesional";
			$arrData[3][1] = "Akting";
			$arrData[4][1] = "Coaching";

			$arrData[0][2] = 10;
			$arrData[1][2] = 20;
			$arrData[2][2] = 60;
			$arrData[3][2] = 10;
			$arrData[4][2] = 10;
			#$item = 0;
			#$bulanlalu = 0;
			/*foreach($arrData as $a) {
				$arrData[$item][2] = rand ( 20 , 80 );
				$item++;
			}*/

			$strXML = $this->fusioncharts->setDataXML($arrData,'','') ;
			
			return $this->fusioncharts->renderChart($this->swfChartsPie,'',$strXML,"cekdata", 440, 300, false, false);
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
