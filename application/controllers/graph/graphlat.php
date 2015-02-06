<?php
class graphlat extends controller{

	function graphlat()
	{
		parent::Controller();
		$this->load->plugin('graph');
        $this->load->library('opgraph');

	}


	function index(){	
	    $data['graph1'] = open_flash_chart_object_str( '800', '250', site_url('graph/graphlat/mydata'), false, base_url());
		$data['graph2'] = open_flash_chart_object_str( '800', '250', site_url('graph/graphlat/mydata2'), false, base_url());
		$data['graph3'] = open_flash_chart_object_str( '800', '250', site_url('graph/graphlat/mydata3'), false, base_url());
		$this->load->view('graphlat',$data);	
	}
	
	
	function mydata(){
		srand((double)microtime()*1000000);
		$data_1 = array();
		$data_2 = array();
		
		for($i=0; $i<9; $i++)
		{
			$data_1[] = rand(21,25);
			$data_2[] = rand(21,25);
			$data_3[] = rand(21,25);
		}
		
		$this->opgraph->title( 'MIS Department', '{font-size: 25px; color: #FFB900}' );

		$this->opgraph->bg_colour = '#000000';

		$this->opgraph->set_data( $data_1 );
		$this->opgraph->bar(75, '#FFB900', 'Kittens', 10 );

		$this->opgraph->set_data( $data_2);
		$this->opgraph->bar( 75, '#28A0DC', 'Puppies', 10);

		$this->opgraph->set_data( $data_3);
		$this->opgraph->bar( 75, '#ffffff', 'chick', 10 );

		
		$this->opgraph->set_x_labels(array('January','February','March','April','May','June','July','August','September' ) );
		$this->opgraph->set_x_label_style( 14, '#FFFFFF', 2 );
		$this->opgraph->set_x_legend( 'Sacrifice breakdown (2007)', 12, '#FFFFFF' );

		$this->opgraph->set_y_min( 20 );
		$this->opgraph->set_y_max( 30 );

		$this->opgraph->y_label_steps( 2 );
		$this->opgraph->set_y_label_style( 14, '#FFFFFF' );
		$this->opgraph->set_y_legend( 'Totals', 12, '#FFFFFF' );

		$this->opgraph->x_axis_colour( '#D0D0D0', '#808080' );
		$this->opgraph->y_axis_colour( '#D0D0D0', '#808080' );

		echo $this->opgraph->render();		
		
	}
	
	function mydata2(){
		srand((double)microtime()*1000000);
		$data_1 = array();
		$data_2 = array();
		
		for($i=0; $i<9; $i++)
		{
			$data_1[] = rand(10,100000);
			$data_2[] = rand(10,100000);
		}
		
		$this->opgraph->title('MIS Department', '{font-size: 25px; color: #FFB900}');	
		
		$this->opgraph->set_data($data_1);		
		$this->opgraph->bar_3d(75, '#D54C78', 'Budget', 10 );

		
		$this->opgraph->set_data($data_2);		
		$this->opgraph->bar_3d( 75, '#3334AD', 'Actual', 10 );

		
		$this->opgraph->set_x_labels(array('January','February','March','April','May','June','July','August','September' ) );
		$this->opgraph->set_x_label_style( 14, '#000000', 2 );
		$this->opgraph->set_x_legend( 'Budget Vs Actual', 12, '#000000' );

		$this->opgraph->set_y_min(100);
		$this->opgraph->set_y_max(100000);

		$this->opgraph->y_label_steps( 2 );
		$this->opgraph->set_y_label_style( 14, '#000000' );
		$this->opgraph->set_y_legend( 'Totals', 12, '#000000' );

		$this->opgraph->x_axis_colour( '#D0D0D0', '#808080' );
		$this->opgraph->y_axis_colour( '#D0D0D0', '#808080' );

		echo $this->opgraph->render();	
	}
	
	function mydata3(){
		#$sql = ;
		$arr = array("","bgt1","bgt2","bgt3","bgt4","bgt5","bgt6","bgt7","bgt8","bgt9","bgt10"
		,"bgt11","bgt12");
		for($i = 1 ; $i <= 12 ; $i++)
		{
			$bln = "0".$i;
			$row1 = $this->db->select('sum(amount) as jml')
			                 ->where('substring(date,4,2)',$bln)
							 ->get('db_trbgtdiv')
							 ->row_array();
			$dt1 = $row1['jml'];
			$num1 = ceil($dt1 / 1000000);
			$data_1[] = (string) $num1;
			#var_dump($data_1);
			

			
			$row2 = $this->db->select('sum('.$arr[$i].') as jml')
			                 ->get('db_mstbgt')
							 ->row_array();
			$dt2 = $row2['jml'];
			$num2 = ceil ($dt2 /1000000);
			$data_2[] =  (string) $num2;
		}
		
		$this->opgraph->title('Budget Vs Actual', '{font-size: 25px; color: #FFB900}');	
		
		
		$this->opgraph->set_data($data_2);	
		$this->opgraph->bar_3d( 75, '#3334AD', 'Budget', 10 );		
		
		
		$this->opgraph->set_data($data_1);	
		$this->opgraph->bar_3d(75, '#D54C78', 'Actual', 10 );		

		
		$this->opgraph->set_x_labels(array('January','February','March','April'
		,'Mei','Juni','Juli','Agustus','September','Oktober','November','December') );
		$this->opgraph->set_x_label_style( 14, '#000000', 2 );
		$this->opgraph->set_x_legend('Dalam satuan (1000000)', 12, '#000000');

		$this->opgraph->set_y_min(1000);
		$this->opgraph->set_y_max(100000);

		$this->opgraph->y_label_steps( 2 );
		$this->opgraph->set_y_label_style( 14, '#000000' );
		$this->opgraph->set_y_legend( 'Totals', 12, '#000000' );

		$this->opgraph->x_axis_colour( '#D0D0D0', '#808080' );
		$this->opgraph->y_axis_colour( '#D0D0D0', '#808080' );

		echo $this->opgraph->render();		
		
	}

}
