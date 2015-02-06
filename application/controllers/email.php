<?php
class email extends controller{
function __construct()
{
        parent::Controller();   
        $this->load->library('email');
}

function index()
{
	$message = "<h>Test</h>";
    $this->email->from('mis@bsu.co.id', 'MIS Department');
    $this->email->to('reza@bsu.co.id'); 

    $this->email->subject('Approval Cuti karyawan');
    $this->email->message('Reza ganteng, Please click this link http://mis.bsu.co.id');  

    $this->email->send();

    echo $this->email->print_debugger();

     //$this->load->view('email_view');

   }

}
