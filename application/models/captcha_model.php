<?php
 class Captcha_model extends Model
 {
 	private $vals = array();
 	
/*
	private $baseUrl  = 'http://localhost/captchademo/';
	private $basePath = 'D:/apache2triad/htdocs/captchademo/';
*/
	
	private $captchaImagePath = 'assets/tmp/captcha/';
	private $captchaFontPath  = 'system/fonts/textb.ttf';
	
	public function Captcha_model($configVal = array())
	{
		parent::Model();
		
		$this->load->plugin('captcha');		
		
		if(!empty($configVal)) 
			$this->initialize($configVal);
		else 
			$this->vals = array(
								'word'		 	=> '',
								'word_length'	=> 4,
								//'img_path'	 	=> $this->basePath . $this->captchaImagePath,
								//'img_url'	 	=> $this->baseUrl . $this->captchaImageUrl,
								'img_path'	 	=> $this->captchaImagePath,
								'img_url'	 	=> base_url() . $this->captchaImagePath,
								'font_path'	 	=> $this->captchaFontPath,
								'img_width'	 	=> '150',
								'img_height' 	=> 50,
								'expiration' 	=> 3600
							   );	
	}	
	
	/**
	 * initializes the variables
	 *
	 * @author 	Mohammad Jahedur Rahman <jahed01@gmail.com>
	 * @access 	public
	 * @param 	array 	config
	 */		 	
	public function initialize ($configVal = array())
	{
		$this->vals = $configVal;
	} //end function initialize
	
	//---------------------------------------------------------------
	
	/**
	 * generate the captcha
	 *
	 * @author 	Mohammad Jahedur Rahman <jahed01@gmail.com>
	 * @access 	public
	 * @return 	array
	 */	
	public function generateCaptcha () 
	{
		$cap = create_captcha($this->vals);
		
		return $cap;	
	} //end function generateCaptcha	
 }
?>
