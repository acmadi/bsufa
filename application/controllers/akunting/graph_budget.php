<?php
	defined('BASEPATH') or die('Access Denied');
	class graph_budget extends AdminPage{
		

		function graph_budget()
		{
			parent::AdminPage();
			$this->load->library('id_chart/id_chart');
			$this->load->Model('mstbudgetdiv_model','master');
			$this->pageCaption = 'Division Budget 2011';
		}
		
		
		function index(){
			$data['graphdata'] = $this->id_chart->chart_embed('graphdata',900,250,site_url('akunting/graph_budget/my_data'));	
			$this->parameters['data'] = $data;
			$this->loadTemplate('mis/graphbudget_view');
		}
		
		function my_data(){
			$data  = $this->master->graphdivisi();
			foreach($data as $row){
				$nil = $row->jumlah;
				$dt[] = array('label'=>$row->group_name,'value'=>$nil);
			}
			echo $this->id_chart->set_chart('pie')
							->set_data($dt)
							->render();	
		}			
		
	}
