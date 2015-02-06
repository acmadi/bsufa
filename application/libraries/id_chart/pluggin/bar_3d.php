<?php
class bar_chart extends Visualization_Chart
{
	public $hidden_label;
	// return the first dataset id from the list
	protected function getDataSetsToDisplay()
	{
		$dataSetsToDisplay = parent::getDataSetsToDisplay();
		if($dataSetsToDisplay === false)
		{
			return false;
		}
		#return array_slice($dataSetsToDisplay, 0, 1);
		return 1;
	}
	
	function set_rotate($d)
	{
		$this->rotate = $d;
	}
	
	function customizeChartProperties()
	{
		parent::customizeChartProperties();
		
		$this->x->set_grid_colour('#ffffff');
		#$this->x_labels->set_steps(2);
		#$this->x->set_stroke(1);

		// create the Bar object
		$bar = new bar_filled('#3B5AA9', '#063E7E');
		$bar->set_alpha("0.5");
		
		$bar->set_key($this->yLabels, 12);
		
		
		// create the bar values
		$yValues = $this->yValues;
		$labelName = $this->yLabels;
		
		$unit = $this->yUnit;
		$barValues = array();
		$i = 0;
		#var_dump($yValues);
		$sum = array_sum($yValues);
		foreach($this->xLabels as $label) {
			$value = (float)$yValues[$i];
			
			$displayPercentage = '';
			if($this->displayPercentageInTooltip)
			{
				$percentage = round(100 * $value / $sum);
				$displayPercentage = "($percentage%)";
			}
			$barValue = new bar_value($value);
			if ($label==" ") $label = $this->hidden_label[$i];
			$barValue->set_tooltip($label."<br>$value $unit  ".$labelName[$i]." $displayPercentage");
			$barValues[] = $barValue;
			$i++;
		}

		$bar->set_values($barValues);
		$this->chart->add_element($bar);
	}
}
