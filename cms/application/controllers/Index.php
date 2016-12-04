<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class Index extends General {
    public function __construct()
    {
          parent::__construct();
          $this->load->helper('url');

    }

    public function Index($idChannel='')
  	{
  		    $this->load->view('index');

  	}



}
