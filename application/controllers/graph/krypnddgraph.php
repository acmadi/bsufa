<?php
	defined('BASEPATH') or die('Access Denied');
	class krypnddgraph extends AdminPage{
		

		function krypnddgraph()
		{
			parent::AdminPage();
			$this->load->library('id_chart/id_chart');
			$this->load->Model('tblkary_model','pnddkary');
			$this->pageCaption = 'HRMS DASHBOARD';
		}
		
		
		function index(){
			$data['graphdata'] = $this->id_chart->chart_embed('graphdata',350,180,site_url('graph/krypnddgraph/my_data'));	
			$data['graphdata1'] = $this->id_chart->chart_embed('graphdata1',450,180,site_url('graph/krypnddgraph/my_data1'));
			$data['graphdata2'] = $this->id_chart->chart_embed('graphdata2',800,200,site_url('graph/krypnddgraph/my_data2'));	
			$this->parameters['data'] = $data;
			$this->loadTemplate('graph/krypndd_view');
		}
		
		function my_data(){
			$data  = $this->pnddkary->graphkarypndd();
			foreach($data as $row){
				$nil = $row->total;
				$dt[] = array('label'=>$row->pndd_nm,'value'=>$nil);
			}
			echo $this->id_chart->set_chart('pie')
							->set_data($dt)
							->render();	
		}
		function my_data1(){
			$data  = $this->pnddkary->graphkarystat();
			foreach($data as $row){
				$nil = $row->jumlah;
				$dt[] = array('label'=>$row->karystat_nm,'value'=>$nil);
			}
			echo $this->id_chart->set_chart('pie')
							->set_data($dt)
							->render();	
		}
		function my_data2(){
			$data  = $this->pnddkary->graphdivisi();
			foreach($data as $row){
				$nil = $row->jml;
				$dt[] = array('label'=>$row->divisi_nm,'value'=>$nil);
			}
			echo $this->id_chart->set_chart('pie')
							->set_data($dt)
							->render();	
		}										
		
	}
