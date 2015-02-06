<?php
	defined('BASEPATH') or die('Access Denied');
	class graph_budget extends AdminPage{
		

		function graph_budget()
		{
			parent::AdminPage();
			$this->load->library('id_chart/id_chart');
			$this->load->Model('mstbudgetdiv_model','master');
			$this->pageCaption = 'Graph Budget';
		}
		
		
		function index(){
			$data['graphdata'] = $this->id_chart->chart_embed('graphdata',400,250,site_url('graph/graph_budget/my_data'));
			$data['graphdata2'] = $this->id_chart->chart_embed('graphdata2',900,250,site_url('graph/graph_budget/my_data2'));
			$data['graphdata3'] = $this->id_chart->chart_embed('graphdata3',900,250,site_url('graph/graph_budget/my_data3'));	
			$this->parameters['data'] = $data;
			$this->loadTemplate('graph/graphbudget_view');
		}
		
		function my_data(){
			$data  = $this->master->graphdivisi();
			foreach($data as $row){
				$nil = $row->jumlah;
				$dt[] = array('label'=>$row->divisi_nm,'value'=>$nil);
			}
			echo $this->id_chart->set_chart('pie')
							->set_data($dt)
							->render();	
		}
		
		function my_data2(){
			$data = $this->master->graphcek();
			foreach($data as $row){
				$nil = $nil = $row->total;
				$dt[] = array('label'=>$row->agama_nm,'value'=>$nil);
			}
			echo $this->id_chart->set_chart('pie')
							->set_data($dt)
							->render();	
		}
		
		function my_data3(){
			for($i=0; $i<9; $i++ )
			{
				$data_1[] = array('label'=>'data 1'.$i, 'value'=>rand(21,25));
				$data_2[] = array('label'=>'data 2'.$i, 'value'=>rand(21,25));
			}
			
			echo $this->id_chart->set_chart('bar')
								->set_data($data_1)
								->set_chart('bar2')
								->set_data($data_2)							
								->render();

		}			
		
	}
