<?php

class pie_chart extends ID_Base_Chart
{
	protected $radius = 0;
	
	function set_radius($x)
	{
		$this->radius= $x;
	}

	public function set_default_properties()
	{
		parent::set_default_properties();
		
		$pie = new pie();
		$pie->set_alpha("0.6");
		$pie->set_start_angle( 35 );
		$pie->add_animation( new pie_fade() );
		$pie->set_label_colour('#142448');
		$pie->set_colours( $this->colors );

		// create the Pie values
		$yValues 	= $this->yValues;
		$labelName 	= $this->yLabels;
		$unit 		= $this->yUnit;
		$sum = array_sum($yValues);
		$pieValues = array();
		$i = 0;
		foreach($this->xLabels as $label) {
			$value = (float)$yValues[$i];
			$i++;
			
			if($value <= 0) {
				continue;
			}
			$pieValue = new pie_value($value, $label);
			$percentage = round(100 * $value / $sum);
			$pieValue->set_tooltip("$label<br>$percentage% ($value$unit )");
			$pieValues[] = $pieValue;
		}
		$pie->set_values($pieValues);
		if ($this->radius)
			$pie->set_radius($this->radius);
		$this->chart->add_element($pie);
	}
}
