<?php
class bar_chart extends ID_Base_Chart
{
	protected $hidden_label=false;
	protected $vertical=false;
	
	public function hidden_label()
	{
		$this->hidden_label =true;
	}
	public function set_rotate($d)
	{
		$this->rotate = $d;
	}
		
	function set_vertical()
	{
		$this->vertical= true;

	}
	public function set_default_properties()
	{
		parent::set_default_properties();
		
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
			$barValue->set_tooltip($label."<br>$value $unit   $displayPercentage");
			$barValues[] = $barValue;
			$i++;
		}
		if ($this->vertical)
			$this->x_labels->set_vertical();
		$bar->set_values($barValues);
		$this->x_labels->rotate(30);
		#$this->chart->set_3d(5);
		$this->chart->add_element($bar);
	}
}
