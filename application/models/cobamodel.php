<?php
	
	class Cobamodel extends Model{
		
		function __construct(){
			parent::Model();
		}
		
		function get_data(){
			$data = array(
				'nama' => 'Chandra',
				'alamat' => 'Meruya',
				'jenkel' => 'Laki-laki'
			);
			return $data;
		}
	}
