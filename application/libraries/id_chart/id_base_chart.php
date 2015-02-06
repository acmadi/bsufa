<?php
abstract class ID_Base_Chart 
{
	protected $chart = null;
	
	protected $xLabels = array();
	protected $xOnClick = array();
	protected $xSteps = 1;
	
	protected $yLabels = array();
	protected $yValues = array();
	protected $yUnit = '';
	
	protected $maxValue;
	protected $minValue;
	protected $displayPercentageInTooltip = true;
	
	protected $rotate=0;
	
	protected $selected_color;
	protected $colors = array(
		'#5f9ef3', 
		'#2cb72c', 
		'#db020c', 
		'#cb2fe7', 
		'#fbd501',
        '#e107a6', 
        '#f93305', 
        '#072f49', 
        '#444907', 
        '#fd05b4',
        '#2fe7e5', 
        '#6b4212', 
        '#2b0749', 
        '#7878f8', 
        '#78f88d',
        '#9ad009', 
        '#490712', 
        '#074929', 
        '#f88a78', 
        '#080808'
	);
	function __construct($i=0)
	{
		$this->chart = new open_flash_chart();
		$this->rotate = $i;
		#var_dump($this->rotate);
	}
	

	public function set_axis_x_labels($xLabels)
	{
		$this->xLabels = $xLabels;
	}

	public function set_axis_x_on_click($onClick)
	{
		$this->xOnClick = $onClick;
	}
	
	public function set_axis_y_values($values)
	{
		$this->yValues = $values;
		while(count($this->yValues)/$this->xSteps >10)
		{
			$this->xSteps++;
		}
	}

	function set_axis_y_unit($yUnit)
	{
		if(!empty($yUnit))
		{
			$this->yUnit = $yUnit;
		}
	}
	
	public function set_axis_Y_labels($labels)
	{
		$this->yLabels = $labels;
		
	}
	
	public function set_display_percentage($bool)
	{
		$this->displayPercentageInTooltip = $bool;
	}
	
	public function setXSteps($steps)
	{
		$this->xSteps = $steps;
	}
	
	
	public function get_max_value()
	{
		if (!$this->yValues) return 10;
		$maxCrossDataSets = false;
		$maxValue = max($this->yValues);
		if($maxValue > 10)
		{
			  $pembagi = 10;
			  $maxValue = round($maxValue/$pembagi,0);
			  if (($maxValue+1)%2 == 0)
			  {
				$maxValue++;
			  }
			  else
			  {
				$maxValue = $maxValue+2;
			  }
			  $maxValue = $maxValue*10;
	  
		}
		else if ($maxValue > 1){
			 if ($$maxValue%2 == 0)
			 {
				$maxValue = $maxValue+2;
 			 }
 			 else
 			 {
				$maxValue++;
			}
	
		}
		
		#	die($maxValue);	
		return $maxValue;
	}
	
	public function set_title($text, $css)
	{
		$title = new title($text);
		$title->set_style($css);
		$this->chart->set_title($title);
	}
	
	public function render()
	{
		
		return $this->chart->toPrettyString();
	}
	
	function set_default_properties()
	{
		$this->chart->set_number_format($num_decimals = 2, 
							$is_fixed_num_decimals_forced = true, 
							$is_decimal_separator_comma = true, 
							$is_thousand_separator_disabled = true);
							
		$gridColour = '#E0E1E4';
		$countValues = count($this->xLabels);
		$this->maxValue = $this->get_max_value();
		$this->minValue = 0;
		
		// X Axis
		$this->x = new x_axis();
		$this->x->set_colour( '#596171' );
		$this->x->set_grid_colour( $gridColour );
		$this->x->set_steps($this->xSteps);
		
		// X Axis Labels
		$this->x_labels = new x_axis_labels();
		$this->x_labels->set_size(10);
		#var_dump($this->rotate);
		if ($this->rotate > 0)
			$this->x_labels->rotate($this->rotate);
		//manually fix the x labels step as this doesn't work in this OFC release..
		$xLabelsStepped = $this->xLabels;

		$this->x_labels->set_labels($xLabelsStepped);
		#$this->x_labels->set_steps(2);
		$this->x->set_labels($this->x_labels);
		
		// Y Axis
		$this->y = new y_axis();
		$this->y->set_colour('#ffffff');
		$this->y->set_grid_colour($gridColour);
		$stepsCount = 3;
		if (($this->maxValue - $this->minValue) % $stepsCount == 0)
			$stepsEveryNLabel = ceil(($this->maxValue - $this->minValue) / $stepsCount);
		else
			$stepsEveryNLabel = ceil(($this->maxValue - $this->minValue) / ($stepsCount-1));
		
		if($this->maxValue == 0)
		{
			$this->maxValue = 1;
			#$stepsEveryNLabel = 0.5;
			//die('sss');
			$stepsEveryNLabel = ($this->maxValue - $this->minValue) /4;
		}
		if ($this->maxValue <= 1)
			$stepsEveryNLabel = 1;
			
        $this->y->set_range( $this->minValue,  ceil($this->maxValue),  $stepsEveryNLabel);
		
		// Tooltip
		$this->tooltip = new tooltip();
		$this->tooltip->set_shadow( true );
		$this->tooltip->set_stroke( 1 );
		//		$this->tooltip->set_hover();
		// Attach elements to the graph
		$this->chart->set_x_axis($this->x);
		$this->chart->set_y_axis($this->y);
		$this->chart->set_tooltip($this->tooltip);
		$this->chart->set_bg_colour('#ffffff');
	}
}
