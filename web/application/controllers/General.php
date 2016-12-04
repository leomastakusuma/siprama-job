<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends ci_controller {
    public function __construct()
    {
          parent::__construct();
          $this->load->helper('url');

    }

    public function UploadCV($fileName,$fileTmp){
        $uploaddir = FCPATH.'public_assets/uploads/';
        $ext = substr($fileName, -3);
        if ($ext == 'doc' || $ext == 'ocx' || $ext == 'pdf') {
            $name = $fileName.date('Y-m-d H:i:s');
            $extension = $ext;
            if($ext ==='ocx'){
              $extension = 'docx';
            }
            $encName   = md5($name).'.'.$extension;
            $uploadfile = $uploaddir . basename($encName);
            if(move_uploaded_file($fileTmp, $uploadfile)){
                $response['success'] = 'Succes Uploading';
                $response['_resume_real_name'] = $fileName;
                $response['_resume_enc_name'] = $encName;
                $response['_resume_url'] = site_url('').'public_assets/uploads/'.$encName;
            }else{
                $response['error'] = 'Error Uploading';
            }
        }else{
            $response['error'] = 'Invalid Format Resume (doc/docx/pdf)';
        }

        return $response;
    }

    public function uploadImage($fileName,$fileTmp){
        $uploaddir = FCPATH.'public_assets/uploads/';
        $ext = substr($fileName, -3);
        if ($ext == 'jpg' || $ext == 'peg' || $ext == 'png') {
            $name = $fileName.date('Y-m-d H:i:s');
            $encName   = md5($name).'.'.$ext;
            $uploadfile = $uploaddir . basename($encName);
            if(move_uploaded_file($fileTmp, $uploadfile)){
                $response['success'] = 'Succes Uploading';
                $response['_photo_real_name'] = $fileName;
                $response['_photo_enc_name'] = $encName;
                $response['_photo_url'] = site_url('').'public_assets/uploads/'.$encName;
            }else{
                $response['error'] = 'Error Uploading';
            }
        }else{
            $response['error'] = 'Invalid image Format Image (jpg/png)';
        }
        return $response;
    }

    public function checkLogin(){
      $userInfo = $this->session->userdata('userinfo');
      // $this->pr($userInfo);
      if(empty($userInfo)){
        redirect('Login');
      }else{
        return true;
      }
    }

    public function userInfo(){
       return $this->session->userdata('userinfo');
    }

    public function pr($array){
      echo "<pre>";
      print_r($array);
      echo "<pre>";exit();
    }
}
