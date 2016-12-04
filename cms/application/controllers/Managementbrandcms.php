<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';
class Managementbrandcms extends General
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Managementbrandcms_model');
        $this->load->model('Corporatecms_model');
        $this->load->model('Sequencecms_model');
        $this->load->model('Rolecms_model');
        $this->load->model('Userrolecms_model');


    }

    public function Index()
    {
        //Cek Access Url
        $this->getAccessUrl('ROLE00002616');

        $data['result'] = $this->Managementbrandcms_model->ambil_data();
        $this->load->view('branch/brandlist', $data);
    }
    public function Addbranch()
    {
        //Cek Access Url
        $this->getAccessUrl('ROLE00001916');
        $data['corporate'] = $this->Corporatecms_model->listCorporate();
        if(!empty($_POST)){
          $this->form_validation->set_rules('name', 'name', 'required|max_length[60]');
          $this->form_validation->set_rules('corporate', 'corporate', 'required|max_length[60]');
          $this->form_validation->set_rules('address', 'address', 'required|max_length[250]');
          $this->form_validation->set_rules('desc', 'desc', 'required|max_length[250]');
          $this->form_validation->set_rules('phone', 'phone', 'required|max_length[25]');
          $this->form_validation->set_rules('pic_name', 'pic_name', 'required|max_length[25]');
          $this->form_validation->set_rules('pic_phone', 'pic_phone', 'required|max_length[45]');
          $this->form_validation->set_rules('pic_email', 'pic_email', 'required|max_length[45]');
          if ($this->form_validation->run() == true) {
                  $p_address = $this->input->post('address');
                  $p_desc = $this->input->post('desc');
                  $corporate = $this->input->post('corporate');
                  $p_phone   = $this->input->post('phone');
                  $p_pic_name    = strtoupper($this->input->post('pic_name'));
                  $p_pic_email = $this->input->post('pic_email');
                  $p_pic_phone = $this->input->post('pic_phone');
                  $p_name    = strtoupper($this->input->post('name'));
                  $IDBranch = $this->Sequencecms_model->next("sys_tm_branch");
                  $_lrn = ' ';
                  $_len = ' ';
                  $_lu = ' ';

                  if(!empty($_FILES['logo'])){
                    $upload = $this->uploadImage($_FILES['logo']['name'],$_FILES['logo']['tmp_name']);
                    if($upload['success']){
                      $_lrn = $upload['_icon_real_name'];
                      $_len = $upload['_icon_enc_name'];
                      $_lu =  $upload['_icon_url'];
                    }
                  }
                  $branchData = array(
                    'branch_id' =>$IDBranch['nextval'],
                    'corporate_id'=>$corporate,
                    '_name'=>$p_name,
                    '_desc'=>$p_desc,
                    '_address'=>$p_address,
                    '_phone'=>$p_phone,
                    '_logo_real_name'=>$_lrn,
                    '_logo_enc_name'=>$_len,
                    '_logo_url'=>$_lu,
                    '_pic_name'=>$p_pic_name,
                    '_pic_phone'=>$p_pic_phone,
                    '_pic_email'=>$p_pic_email,
                    '_active'=>'1',
                    '_delete'=>'0',
                    'create_date'=>date('Y-m-d H:i:s'),
                  );
                  try{
                    $result    = $this->Managementbrandcms_model->insertBranch($branchData);
                    $set_notif = array('notifsukses' => 'Branch Berhasil Disimpan');
                    $this->session->set_userdata($set_notif);
                    redirect("managementbrandcms");
                  }catch (Exception $ex) {
                    $set_notif = array('notiferror' => $ex);
                    $this->session->set_userdata($set_notif);
                    redirect("managementbrandcms");
                  }
            }

        }

        $this->load->view('branch/addbranch',$data);
    }

    public function editBranch(){
      //Cek Access Url
      $this->getAccessUrl('ROLE00002016');
      $IDBranch = $this->input->post('brand_no');
      $data['result'] = $this->Managementbrandcms_model->searchBranch($IDBranch);
      $data['corporate'] = $this->Corporatecms_model->listCorporate();
      if(!empty($this->input->post('method'))){
        $this->form_validation->set_rules('name', 'name', 'required|max_length[60]');
        $this->form_validation->set_rules('corporate', 'corporate', 'required|max_length[60]');
        $this->form_validation->set_rules('address', 'address', 'required|max_length[250]');
        $this->form_validation->set_rules('desc', 'desc', 'required|max_length[250]');
        $this->form_validation->set_rules('phone', 'phone', 'required|max_length[25]');
        $this->form_validation->set_rules('pic_name', 'pic_name', 'required|max_length[25]');
        $this->form_validation->set_rules('pic_phone', 'pic_phone', 'required|max_length[45]');
        $this->form_validation->set_rules('pic_email', 'pic_email', 'required|max_length[45]');

        if ($this->form_validation->run() == true) {
                $p_address = $this->input->post('address');
                $p_desc = $this->input->post('desc');
                $corporate = $this->input->post('corporate');
                $p_phone   = $this->input->post('phone');
                $p_pic_name    = strtoupper($this->input->post('pic_name'));
                $p_pic_email = $this->input->post('pic_email');
                $p_pic_phone = $this->input->post('pic_phone');
                $p_name    = strtoupper($this->input->post('name'));
                $IDBranch = $this->input->post('brand_no');

                $result = $this->Managementbrandcms_model->searchBranch($IDBranch);
                $_lrn = $result['_logo_real_name'];
                $_len = $result['_logo_enc_name'];
                $_lu =  $result['_logo_url'];

                if(!empty($_FILES['logo']['name'])){
                  if(!empty($result['_icon_real_name']) && ($result['_icon_real_name'] != $_FILES['logo']['name']) ){
                      $deleteImg = FCPATH.'public_assets/uploads/'.$result['_icon_enc_name'];
                      if(unlink($deleteImg)){
                          $upload = $this->uploadImage($_FILES['logo']['name'],$_FILES['logo']['tmp_name']);
                          if($upload['success']){
                            $_lrn = $upload['_icon_real_name'];
                            $_len = $upload['_icon_enc_name'];
                            $_lu =  $upload['_icon_url'];
                          }
                      }
                  }else{
                      $upload = $this->uploadImage($_FILES['logo']['name'],$_FILES['logo']['tmp_name']);
                      if($upload['success']){
                        $_lrn = $upload['_icon_real_name'];
                        $_len = $upload['_icon_enc_name'];
                        $_lu =  $upload['_icon_url'];
                      }
                  }

                }

                $branchData = array(
                  'corporate_id'=>$corporate,
                  '_name'=>$p_name,
                  '_desc'=>$p_desc,
                  '_address'=>$p_address,
                  '_phone'=>$p_phone,
                  '_logo_real_name'=>$_lrn,
                  '_logo_enc_name'=>$_len,
                  '_logo_url'=>$_lu,
                  '_pic_name'=>$p_pic_name,
                  '_pic_phone'=>$p_pic_phone,
                  '_pic_email'=>$p_pic_email,
                  'last_update'=>date('Y-m-d H:i:s'),
                  'last_update_by'=>$this->userInfo()->user_no
                );
                try{
                  $result    = $this->Managementbrandcms_model->updateBranch($branchData,$IDBranch);
                  $set_notif = array('notifsukses' => 'Branch Berhasil Di Update');
                  $this->session->set_userdata($set_notif);
                  redirect("managementbrandcms");
                }catch (Exception $ex) {
                  $set_notif = array('notiferror' => $ex);
                  $this->session->set_userdata($set_notif);
                  redirect("managementbrandcms");
                }


              }

      }
      $this->load->view('branch/editbranch', $data);

    }
    public function brandOperation()
    {
        $this->form_validation->set_rules('brand_no', 'brand_no', 'required|max_length[45]');
        $p_brand_no = $this->input->post('brand_no');
        if ($this->input->post('delete')) {
            $hapus_brand = $this->Managementbrandcms_model->hapus_brand($p_brand_no);
            if($hapus_brand){
              $set_notif = array('notifsukses' => $hapus_brand);
	            $this->session->set_userdata($set_notif);
              redirect("managementbrandcms");
            }else{
              $set_notif = array('notifsukses' => $hapus_brand);
	            $this->session->set_userdata($set_notif);
              redirect("managementbrandcms");
            }
        }elseif ($this->input->post('edit')) {
            $this->editBranch($p_brand_no);
        }elseif ($this->input->post('set_nonactive')) {
            $set_aktif = $this->Managementbrandcms_model->set_active($p_brand_no);
           if($set_aktif){
              $set_notif = array('notifsukses' => $set_aktif);
	            $this->session->set_userdata($set_notif);
              redirect("managementbrandcms");
           }else{
              $set_notif = array('notifsukses' => $set_aktif);
	            $this->session->set_userdata($set_notif);
              redirect("managementbrandcms");
          }
        }elseif ($this->input->post('set_active')) {
            $set_noaktif = $this->Managementbrandcms_model->set_noactive($p_brand_no);
            if($set_noaktif){
              $set_notif = array('notifsukses' => $set_noaktif);
	            $this->session->set_userdata($set_notif);
              redirect("managementbrandcms");
            }else{
              $set_notif = array('notifsukses' => $set_noaktif);
	            $this->session->set_userdata($set_notif);
              redirect("managementbrandcms");
            }
        }elseif ($this->input->post('deleterole')) {
            $branchrole = $this->input->post('branchrole');
            $hapus_brand = $this->Managementbrandcms_model->hapus_brandrole($branchrole);
            if($hapus_brand){
              $set_notif = array('notifsukses' => $hapus_brand);
	            $this->session->set_userdata($set_notif);
              redirect("managementbrandcms/branchRole");
            }else{
              $set_notif = array('notifsukses' => $hapus_brand);
	            $this->session->set_userdata($set_notif);
              redirect("managementbrandcms/branchRole");
            }
        }elseif ($this->input->post('set_nonactiverole')) {
            $branchrole = $this->input->post('branchrole');
            $set_aktif = $this->Managementbrandcms_model->set_activerole($branchrole);
           if($set_aktif){
              $set_notif = array('notifsukses' => $set_aktif);
	            $this->session->set_userdata($set_notif);
              redirect("managementbrandcms/branchRole");
           }else{
              $set_notif = array('notifsukses' => $set_aktif);
	            $this->session->set_userdata($set_notif);
              redirect("managementbrandcms/branchRole");
          }
        }elseif ($this->input->post('set_activerole')) {
            $branchrole = $this->input->post('branchrole');
            $set_noaktif = $this->Managementbrandcms_model->set_noactiverole($branchrole);
            if($set_noaktif){
              $set_notif = array('notifsukses' => $set_noaktif);
	            $this->session->set_userdata($set_notif);
              redirect("managementbrandcms/branchRole");
            }else{
              $set_notif = array('notifsukses' => $set_noaktif);
	            $this->session->set_userdata($set_notif);
              redirect("managementbrandcms/branchRole");
            }
        }




    }

    public function branchRole()
    {
      //Cek Access Url
      $this->getAccessUrl('ROLE00002716');
      $data['role'] = $this->Rolecms_model->listRole();
      $data['result'] = $this->Userrolecms_model->getBranchRoleID();
      // $this->pr($data['result']);
      $this->load->view('branch/branchrole', $data);
    }

    public function addBranchRole()
    {
      //Cek Access Url
      $this->getAccessUrl('ROLE00001816');
      $data['role'] = $this->Rolecms_model->listRole();
      $data['branch'] = $this->Managementbrandcms_model->selectBranch();
      if(!empty($_POST)){
        $this->form_validation->set_rules('branch', 'branch', 'required');
        $this->form_validation->set_rules('role', 'role', 'required');
        $userInfo = $this->userInfo();
        $branchROleID = $this->Sequencecms_model->next('sys_tm_branch_role');
        if ($this->form_validation->run() == true) {
            $dataBranchRole = array(
              'branch_role_id'=>$branchROleID['nextval'],
              'branch_id'=> $this->input->post('branch'),
              'role_id'=>$this->input->post('role'),
              '_active'=>'1',
              '_delete'=>'0',
              'create_date'=>date('Y-m-d H:i:s'),
              'create_by'=>$userInfo->user_no
            );
            try{
              $checkBranchRole =  $this->Managementbrandcms_model->checkBrancRoleId($this->input->post('branch'),$this->input->post('role'));
              if($checkBranchRole['status'] == 1){
                $this->Managementbrandcms_model->insertBranchRole($dataBranchRole);
                $set_notif = array('notifsukses' => 'Branch Role Berhasil Di Simpan');
                $this->session->set_userdata($set_notif);
                redirect("managementbrandcms/branchRole");
              }else{
                $set_notif = array('notiferror' => $checkBranchRole['msg']);
                $this->session->set_userdata($set_notif);
                redirect("managementbrandcms/branchRole");
              }

            }catch (Exception $ex) {
              $set_notif = array('notiferror' => $ex);
              $this->session->set_userdata($set_notif);
              redirect("managementbrandcms/branchRole");
            }
        }

      }
      $this->load->view('branch/addbranchrole', $data);
    }
}
