<?php
class trans_budget extends DBController{
	private $divisi;
	function __construct(){
		parent::__construct('trans_budget_model');
		$this->set_page_title('Budget Status List');
		$this->template_dir = 'accounting/trans_budget';

	}


	function get_json(){
		$this->set_custom_function('tanggal','indo_date');
		parent::get_json();
	}

	protected function setup_form($data=false){
		#give parameter
		$session_id = $this->UserLogin->isLogin();
		$divisi = $session_id['divisi_id'];	
		$pt = $session_id['id_pt'];
		$coa = "";
		$this->parameters['kd'] = $this->mstmodel->getmstbudget2(@$data->code_id);
		$this->parameters['cash'] = $this->mstmodel->get_list('cashflow');
		$this->parameters['coa'] = $this->mstmodel->get_list('coa_tra');	
		$this->parameters['kodecoa'] = $this->mstmodel->get_coa($coa);
		//$this->parameters['kodebgt'] = $this->mstmodel->getbudget($divisi,$pt);
		
	}
	
	
	function index(){
		$this->set_grid_column('id_trbgt','ID',array('hidden'=>true));
		$this->set_grid_column('form_kode','Batch.No',array('width'=>50,'align'=>'center','formatter' => 'cellColumn'));
		$this->set_grid_column('tanggal','Date',array('width'=>30,'align'=>'center','formatter' => 'cellColumn'));
		$this->set_grid_column('description','Budget Name',array('width'=>100,'formatter' => 'cellColumn'));
		$this->set_grid_column('amount','Amount',array('width'=>50,'align'=>'right','formatter' => 'numberFormat'));
		$this->set_grid_column('flag_id','Flag',array('width'=>50,'hidden'=>true,'formatter' => 'cellColumn'));
		$this->set_jqgrid_options(array('width'=>860,'height'=>300,'caption'=>'Proposed Operation Budget','rownumbers'=>True,'sortname'=>'id_trbgt','sortorder'=>'desc'));
		parent::index();
	}
	
		function data($id){
			$data = $this->mstmodel->getbgtdetail($id);
			echo json_encode($data);			
		}
	
		function bgt_balance($bln,$thn,$kode){
			$arr = array("","bgt1","bgt2","bgt3","bgt4","bgt5","bgt6","bgt7","bgt8","bgt9","bgt10","bgt11","bgt12");
			$month = date( 'F', mktime(0, 0, 0, $bln));
			#session
			$session_id = $this->UserLogin->isLogin();
			#$divisi = $session_id['divisi_id'];
			$level_id = $session_id['level_id'];
			$pt = $session_id['id_pt'];
			$cekdiv = $this->db->where('code',$kode)
							   ->where('thn',$thn)
							   ->where('id_pt',$pt)
							   ->get('db_mstbgt')->row();			
			$divisi = $cekdiv->divisi_id;
			//if($level_id == 1) $divisi = $divisi;
			//else $divisi = $divisi_id;
			#get budget
			$datv = $this->mstmodel->getmstbudgetupdate($kode,$thn);
			$annu_tot = $datv->tot_mst;

			#Cek id budget terakhir
			$row = $this->db->order_by('id_trbgt','DESC')
						   ->get('db_trbgtdiv')->row();
			$id = $row->id_trbgt;
			$noid = $id + 1;
			//var_dump($id);exit;			   
			
			#tanggal approved
			#$apptanggal = $this->mstmodel->apptgl($kode);
			#$apptanggal = date("d-m-Y",strtotime($apptanggal));
			
			#Balance  Budget Annual
			$tot1 = $this->mstmodel->total_annual($kode,$thn,$pt);
			$tot2 = $this->mstmodel->act_annual($kode,$divisi,$thn,$pt);
			$totmst = $tot1['tot_mst'];
			$actmst = $tot2['jml'];
			$amount = $totmst - $actmst;//balance annual budget
			
			#Balance Budget Annual Perdivisi
			$dtdiv = $this->mstmodel->total_annualdiv($divisi,$thn,$pt);
			$dtactdiv = $this->mstmodel->act_annualdiv($divisi,$thn,$pt);
			$totdiv = $dtdiv->jml;
			$actdiv = $dtactdiv ->jml;
			$blcdiv =  $totdiv - $actdiv;
			
			#Balance Budget Annual Alldivisi
			$dtalldiv = $this->mstmodel->total_annualalldiv($thn,$pt);
			$dtactalldiv = $this->mstmodel->act_annualalldiv($thn,$pt);
			$totalldiv = $dtalldiv->jml;
			$actalldiv = $dtactalldiv ->jml;
			$blcalldiv =  $totalldiv - $actalldiv;
			


			#Balance Budget Month
			$id = str_replace("0","",$bln);
			$jbln = $arr[$id];
			$tot3 = $this->mstmodel->total_month($kode,$jbln,$thn);
			$tot4 = $this->mstmodel->act_month($kode,$month,$thn);
			
			$totmnth = $tot3['jml'];
			$actmnth = $tot4['jml'];
			$blcmnth = $totmnth - $actmnth;
			//var_dump($blcmnth);exit;

			#Balance Budget Month perdivisi
			$tot3div = $this->mstmodel->total_monthdiv($divisi,$jbln,$thn);
			$tot4div = $this->mstmodel->act_monthdiv($divisi,$month,$thn);
			$totmnthdiv = $tot3div['jml'];
			$actmnthdiv = $tot4div['jml'];
			$blcmnthdiv = $totmnthdiv - $actmnthdiv;

			#Balance Budget Month Alldivisi
			$tot3alldiv = $this->mstmodel->total_monthalldiv($jbln,$thn,$pt);
			$tot4alldiv = $this->mstmodel->act_monthalldiv($month,$thn,$pt);
			$totmnthalldiv = $tot3alldiv['jml'];
			$actmnthalldiv = $tot4alldiv['jml'];
			$blcmnthalldiv = $totmnthalldiv - $actmnthalldiv;


			
			#Balance Budget YTD
			$totytd = 0;
			for($i=1;$i<=$bln;$i++){
				$n = $arr[$i];
				$tot5 = $this->mstmodel->total_ytd($n,$kode,$thn);
				$hsl = $tot5['jml'];
				$totytd = $totytd + $hsl;
			}			
			$tot6 = $this->mstmodel->act_ytd($kode,$thn);
			$totytd = $totytd;
			$actytd = $tot6['jml'];
			$blcytd = $totytd - $actytd;

			#Balance Budget perdivisi
			$totytddiv = 0;
			for($i=1;$i<=$bln;$i++){
				$n = $arr[$i];
				$tot5div = $this->mstmodel->total_ytddiv($n,$divisi,$thn);
				$hsldiv = $tot5div['jml'];
				$totytddiv = $totytddiv + $hsldiv;
			}			
			$tot6div = $this->mstmodel->act_ytddiv($divisi,$thn);
			$totytddiv = $totytddiv;
			$actytddiv = $tot6div['jml'];
			$blcytddiv = $totytddiv - $actytddiv;

			#Balance Budget Alldivisi
			$totytdalldiv = 0;
			for($i=1;$i<=$bln;$i++){
				$n = $arr[$i];
				$tot5alldiv = $this->mstmodel->total_ytdalldiv($n,$thn,$pt);
				$hslalldiv = $tot5alldiv['jml'];
				$totytdalldiv = $totytdalldiv + $hslalldiv;
			}			
			$tot6alldiv = $this->mstmodel->act_ytdalldiv($thn,$pt);
			$totytdalldiv = $totytdalldiv;
			$actytdalldiv = $tot6alldiv['jml'];
			$blcytdalldiv = $totytdalldiv - $actytdalldiv;
			
			
			
			
			$blcdata = array
			(
				'annu_tot'=>number_format($annu_tot),
				'totdiv'=>number_format($totdiv),	
				'blcdiv'=>number_format($blcdiv),
				'totalldiv'=>number_format($totalldiv),		
				'blcalldiv'=>number_format($blcalldiv),
				'blc_ann'=> number_format($amount),
				'blc_month'=> number_format($blcmnth),
				'bgtmnth'=>number_format($totmnth),
				'totmnthdiv'=>number_format($totmnthdiv),
				'blcmnthdiv'=>number_format($blcmnthdiv),
				'totmnthalldiv'=>number_format($totmnthalldiv),
				'blcmnthalldiv'=>number_format($blcmnthalldiv),
				'blc_ytd'=> number_format($blcytd),
				'bgtytd'=>number_format($totytd),
				'totytddiv'=>number_format($totytddiv),
				'blcytddiv'=>number_format($blcytddiv),
				'totytdalldiv'=>number_format($totytdalldiv),
				'blcytdalldiv'=>number_format($blcytdalldiv),
				'actmst'=>number_format($actmst),
				'actytd'=>number_format($actytd),
				'actdivytd'=>number_format($actytddiv),
				'actalldivytd'=>number_format($actytdalldiv),
				'actmonth'=>number_format($actmnth),
				'actdivmonth'=>number_format($actmnthdiv),
				'actalldivmonth'=>number_format($actmnthalldiv),
				'actann' => number_format($actmst),
				'actdivann' => number_format($actdiv),
				'actdivallann' => number_format($actalldiv),
				'noid' => $noid,
				'divisi_id' => $divisi
				#'apptanggal' => $apptanggal
				
			);			
			echo json_encode($blcdata);
		}
		
		function save(){
			extract(PopulateForm());
			$session_id = $this->UserLogin->isLogin();
			$divisi_id = $session_id['divisi_id'];
			$pt = $session_id['id_pt'];
			list($d,$m,$y) = split("-",$tgl_aju);
			$tanggal = $y."-".$m."-".$d;
			$serverdate = date("d-m-Y H:i:s");
			$data = array
			(
				'code_id' => $code,
				'amount' => str_replace(',',"",$amount),
				//'blc_month' => str_replace(',',"",$blc_month),
				//'blc_ytd' => str_replace(',',"",$blc_ytd),
				//'blc_ann' => str_replace(',',"",$blc_ann),
				//'blc_divmonth' => str_replace(',',"",$blc_divmonth),
				//'blc_divytd' => str_replace(',',"",$blc_divytd),
				//'blc_divann' => str_replace(',',"",$blc_divann),
				//'blc_divallmonth' => str_replace(',',"",$blc_divallmonth),
				//'blc_divallytd' => str_replace(',',"",$blc_divallytd),
				//'blc_divallann' => str_replace(',',"",$blc_divallann),
				'divisi_id' => $divisi_id,
				'remark' => $remark,
				'flag_id'=> 0,
				'id_pt' => $pt,
				'tanggal' => $tanggal
			);
			
			if($id=="") {
				$this->db->insert("db_trbgtdiv",$data);
			}else{
				if($approve == "Approve") {
					$data1 = array(
						'amount' => str_replace(',',"",$amount),
						//'blc_month' => str_replace(',',"",$blc_month),
						//'blc_ytd' => str_replace(',',"",$blc_ytd),
						//'blc_ann' => str_replace(',',"",$blc_ann),
						//'blc_divmonth' => str_replace(',',"",$blc_divmonth),
						//'blc_divytd' => str_replace(',',"",$blc_divytd),
						//'blc_divann' => str_replace(',',"",$blc_divann),
						//'blc_divallmonth' => str_replace(',',"",$blc_divallmonth),
						//'blc_divallytd' => str_replace(',',"",$blc_divallytd),
						//'blc_divallann' => str_replace(',',"",$blc_divallann),
						'remark' => $remark,
						'flag_id'=> 1,
						'id_pt' => $pt,
						'tanggal' => $tanggal
						);
					$data2 = array('flag_id'=>1,'tanggal'=>$serverdate,'alasan'=>$alasan,'trbgt_id'=>$id);
				}else{
					$data1 = array(
						'amount' => str_replace(',',"",$amount),
						//'blc_month' => str_replace(',',"",$blc_month),
						//'blc_ytd' => str_replace(',',"",$blc_ytd),
						//'blc_ann' => str_replace(',',"",$blc_ann),
						//'blc_divmonth' => str_replace(',',"",$blc_divmonth),
						//'blc_divytd' => str_replace(',',"",$blc_divytd),
						//'blc_divann' => str_replace(',',"",$blc_divann),
						//'blc_divallmonth' => str_replace(',',"",$blc_divallmonth),
						//'blc_divallytd' => str_replace(',',"",$blc_divallytd),
						//'blc_divallann' => str_replace(',',"",$blc_divallann),
						'remark' => $remark,
						'flag_id'=> 2,
						'id_pt' => $pt,
						'tanggal' => $tanggal
						);
					$data2 = array('flag_id'=>2,'tanggal'=>$serverdate,'alasan'=>$alasan,'trbgt_id'=>$id);
				 }
				$this->db->where('id_trbgt',$id)
                         ->update("db_trbgtdiv",$data1);
                         
                $this->db->insert('db_approve',$data2);
                
			    
			}
	        redirect("trans_budget");
		}
		
		
		function loaddata(){
			#die($this->input->post('parent_id'));
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				$session_id = $this->UserLogin->isLogin();
				$pt = $session_id['id_pt'];
				$divisi = $session_id['divisi_id'];
				$lvl = $session_id['level_id'];
				
				switch($data_type){
					case 'code':
						if($lvl==3){
							$sql = $this->db->select("code id,' {' +code+ '}' + descbgt  nama")
										->where('thn',$parent_id)
										->where('id_pt',$pt)
										->get('db_mstbgt')->result();
						}else{
							$sql = $this->db->select("code id,' {' +code+ '}' + descbgt  nama")
										->where('thn',$parent_id)
										->where('divisi_id',$divisi)
										->where('id_pt',$pt)
										->get('db_mstbgt')->result();							
						}
						break;
					default:
					    $sql = $this->db->select('subproject_id id,nm_subproject nama')
										->where('id_pt',$pt)
										->order_by('nm_subproject','ASC')
										->get('db_subproject')->result();
				}
				$response = array();
				if($sql){
					foreach($sql as $row){
						$response[] = $row;
					}
				}else{
					$response['error'] = 'Data kosong';
				}
				die(json_encode($response));
			}			
		}
		
	
}
