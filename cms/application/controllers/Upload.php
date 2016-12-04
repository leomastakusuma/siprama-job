<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
        }

        public function index()
        {
                // $this->load->view('upload_form', array('error' => ' ' ));
        }

        public function do_upload()
        {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);
                echo "<pre>";
                print_r($_FILES);
                if ( ! $this->upload->do_upload($_FILES['avatar']))
                {
                        $data ['error'] =  $this->upload->display_errors();
                }
                else
                {
                        $data['succes'] =  $this->upload->data();
                }
                print_r($data);
                return $data;
        }
}
?>
