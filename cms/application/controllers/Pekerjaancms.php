<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class Pekerjaancms extends General {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('Sequencecms_model');
        $this->load->model('Pekerjaancms_model');
        $this->load->model('Managementbrandcms_model');
          $this->load->model('General_model');
    }

    public function index(){
      $data['data'] = $this->Pekerjaancms_model->listpekerjaan();
      $this->load->view('pekerjaan/listpekerjaan',$data);
    }

    public function addpekerjaan(){
      //Cek Access Url
      // $this->getAccessUrl('ROLE00004316');
      $data['pekerjaan']= $this->Pekerjaancms_model->getPekerjaanParent();
      if(!empty($_POST)){
        $configValidation = $this->Validation();
        $pekerjaanID = $this->Sequencecms_model->next('cms_tm_pekerjaan');
        $idPekerjaanBranch = $this->Sequencecms_model->next('cms_tm_pekerjaan_branch');
        // echo $this->db->last_query();die;
        $this->form_validation->set_rules($configValidation);
        if ($this->form_validation->run() == TRUE) {
            #Check Exist Pekerjaan.
            $checkExistPekerjaan = $this->General_model->checkExist('cms_tm_pekerjaan','_name',$this->input->post('name'));
            if($checkExistPekerjaan > 1){
                $set_notif = array('notiferror' => 'Pekerjaan Telah Tersedia, Silahkan Masukan Pekerjaan Lain');
                $this->session->set_userdata($set_notif);
                redirect("pekerjaancms");
            }


            $dataPekerjaan = array(
                      'pekerjaan_id'=>$pekerjaanID['nextval'],
                      '_name'=>$this->input->post('name'),
                      '_parent_pekerjaan_id'=>!empty($this->input->post('parent')) ? $this->input->post('parent') : 'NULL',
                      '_active'=>'1',
                      '_delete'=>'0',
                      'create_date'=>date('Y-m-d H:i:s'),
                      'create_by'=>$this->userInfo()->user_no
            );

            $dataPekerjaanBranch = array(
                      'pekerjaan_branch_no'=>$idPekerjaanBranch['nextval'],
                      'branch_id'=>branchID,
                      'pekerjaan_id'=>$pekerjaanID['nextval'],
                      'create_date'=>date('Y-m-d H:i:s'),
                      '_active'=>'1',
                      '_delete'=>'0',
                      'create_by'=>$this->userInfo()->user_no
            );
            try {
               $this->Pekerjaancms_model->insertpekerjaan($dataPekerjaan);

               $this->Pekerjaancms_model->insertPekerjaanbranch($dataPekerjaanBranch);
               $set_notif = array('notifsukses' => 'Pekerjaan Berhasil Disimpan');
               $this->session->set_userdata($set_notif);
               redirect("pekerjaancms");
             }catch (Exception $ex) {
               $set_notif = array('notiferror' => $ex);
               $this->session->set_userdata($set_notif);
               redirect("pekerjaancms");
             }
        }

      }
      $this->load->view('pekerjaan/addpekerjaan',$data);

    }

    public function editpekerjaan(){
      //Cek Access Url
      $pekerjaanID = $this->input->post('pekerjaanID');
      $data['r'] = $this->Pekerjaancms_model->searchpekerjaan($pekerjaanID);
      $data['pekerjaan']= $this->Pekerjaancms_model->getPekerjaanParent();
      // $this->pr($data);

      if(!empty($this->input->post('method'))){
          $pekerjaanID = $this->input->post('pekerjaanID');
          $configValidation = $this->Validation();
          $this->form_validation->set_rules($configValidation);
          if($this->form_validation->run() == true){
                  #Check Exist Pekerjaan.
                  $checkExistPekerjaan = $this->General_model->checkExist('cms_tm_pekerjaan','_name',$this->input->post('name'));
                  if($checkExistPekerjaan > 1){
                      $set_notif = array('notiferror' => 'Pekerjaan Telah Tersedia, Silahkan Masukan Pekerjaan Lain');
                      $this->session->set_userdata($set_notif);
                      redirect("pekerjaancms");
                  }
                  $dataPekerjaan = array(
                              '_name'=>$this->input->post('name'),
                              '_parent_pekerjaan_id'=>!empty($this->input->post('parent')) ? $this->input->post('parent') : 'NULL',
                              'last_update'=>date('Y-m-d H:i:s'),
                              'last_update_by'=>$this->userInfo()->user_no
                  );
                  try{
                    $result    = $this->Pekerjaancms_model->updatepekerjaan($dataPekerjaan,$pekerjaanID);
                    $set_notif = array('notifsukses' => 'Pekerjaan Berhasil Di Update');
                    $this->session->set_userdata($set_notif);
                    redirect("pekerjaancms");
                  }catch (Exception $ex) {
                    $set_notif = array('notiferror' => $ex);
                    $this->session->set_userdata($set_notif);
                    redirect("pekerjaancms");
                  }
          }
      }
      $this->load->view('pekerjaan/editpekerjaan',$data);
    }

    public function Operation() {
      //  $this->pr($_POST);
        $this->form_validation->set_rules('pekerjaanID', 'pekerjaanID', 'required');
        $pekerjaanID = $this->input->post('pekerjaanID');
        $pekerjaanBranchID = $this->input->post('pekerjaanBranchID');
        // $this->pr($_POST);
        if ($this->input->post('delete')) {
            $hapus_pekerjaan = $this->Pekerjaancms_model->hapus_pekerjaan($pekerjaanID);
            $hapusPekerjanLangBranch = $this->Pekerjaancms_model->hapus_pekerjaanlangsungBranch($pekerjaanID);

            if($hapus_pekerjaan && $hapusPekerjanLangBranch){
              $set_notif = array('notifsukses' => "Pekerjaan Berhasi DI Hapus");
              $this->session->set_userdata($set_notif);
              redirect("pekerjaancms");
            }else{
              $set_notif = array('notifsukses' => "Pekerjaan Gagal DI Hapus");
              $this->session->set_userdata($set_notif);
              redirect("pekerjaancms");
            }
        }elseif ($this->input->post('edit')) {
            $this->editpekerjaan();
        }elseif ($this->input->post('set_nonactive')) {
            $set_aktif = $this->Pekerjaancms_model->set_active($pekerjaanID);
           if($set_aktif){
              $set_notif = array('notifsukses' => $set_aktif);
              $this->session->set_userdata($set_notif);
              redirect("pekerjaancms");
           }else{
              $set_notif = array('notifsukses' => $set_aktif);
              $this->session->set_userdata($set_notif);
              redirect("pekerjaancms");
          }
        }elseif ($this->input->post('set_active')) {
            $set_noaktif = $this->Pekerjaancms_model->set_noactive($pekerjaanID);
            if($set_noaktif){
              $set_notif = array('notifsukses' => $set_noaktif);
              $this->session->set_userdata($set_notif);
              redirect("pekerjaancms");
            }else{
              $set_notif = array('notifsukses' => $set_noaktif);
              $this->session->set_userdata($set_notif);
              redirect("pekerjaancms");
            }
        }elseif($this->input->post('deletebranch')){
            $hapus_pekerjaanbranch = $this->Pekerjaancms_model->hapus_pekerjaanbranch($pekerjaanBranchID);
            if($hapus_pekerjaanbranch){
              $set_notif = array('notifsukses' => "Pekerjaan Berhasi DI Hapus");
              $this->session->set_userdata($set_notif);
              redirect("pekerjaancms/listPekerjaanBranch");
            }else{
              $set_notif = array('notifsukses' => "Pekerjaan Gagal DI Hapus");
              $this->session->set_userdata($set_notif);
              redirect("pekerjaancms/listPekerjaanBranch");
            }
        }elseif($this->input->post('editbranch')){
            $this->editpekerjaanbranch();
        }elseif($this->input->post('set_nonactivebranch')){
             $set_aktif = $this->Pekerjaancms_model->set_activebranch($pekerjaanBranchID);
             if($set_aktif){
                $set_notif = array('notifsukses' => $set_aktif);
                $this->session->set_userdata($set_notif);
                redirect("pekerjaancms/listPekerjaanBranch");
             }else{
                $set_notif = array('notifsukses' => $set_aktif);
                $this->session->set_userdata($set_notif);
                redirect("pekerjaancms/listPekerjaanBranch");
             }

        }elseif($this->input->post('set_activebranch')){
            $set_noaktif = $this->Pekerjaancms_model->set_nonactivebranch($pekerjaanBranchID);
            if($set_noaktif){
              $set_notif = array('notifsukses' => $set_noaktif);
              $this->session->set_userdata($set_notif);
              redirect("pekerjaancms/listPekerjaanBranch");
            }else{
              $set_notif = array('notifsukses' => $set_noaktif);
              $this->session->set_userdata($set_notif);
              redirect("pekerjaancms/listPekerjaanBranch");
            }
        }
    }

    public function listpekerjaanbranch(){
      $data['data'] = $this->Pekerjaancms_model->listPekerjaanBranch();
      $this->load->view('pekerjaan/listpekerjaanbranch',$data);
    }

    public function addpekerjaanbranch(){
        $data['branch'] = $this->Managementbrandcms_model->selectBranch();
        $data['pekerjaan'] = $this->Pekerjaancms_model->getPekerjaan();
        if(!empty($_POST)){
            $this->form_validation->set_rules('branch', 'branch', 'required');
            $this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'required');
            $idPekerjaanBranch = $this->Sequencecms_model->next('cms_tm_pekerjaan_branch');
            if($this->form_validation->run() == true) {
               $dataPekerjaanBranch = array(
                  'pekerjaan_branch_no'=>$idPekerjaanBranch['nextval'],
                  'branch_id'=>$this->input->post('branch'),
                  'pekerjaan_id'=>$this->input->post('pekerjaan'),
                  'create_date'=>date('Y-m-d H:i:s'),
                  '_active'=>'1',
                  '_delete'=>'0',
                  'create_by'=>$this->userInfo()->user_no
               );
               try {
                  $this->Pekerjaancms_model->insertPekerjaanbranch($dataPekerjaanBranch);
                  $set_notif = array('notifsukses' => 'Pekerjaan Branch Berhasil Disimpan');
                  $this->session->set_userdata($set_notif);
                  redirect("pekerjaancms/listpekerjaanbranch");
                }catch (Exception $ex) {
                  $set_notif = array('notiferror' => $ex);
                  $this->session->set_userdata($set_notif);
                  redirect("pekerjaancms/listpekerjaanbranch");
                }
            }
        }
        $this->load->view('pekerjaan/addpekerjaanbranch',$data);
    }

    public function editpekerjaanbranch(){
       $pekerjaanBranchID = $this->input->post('pekerjaanBranchID');
       $data['result'] = $this->Pekerjaancms_model->searchpekerjaanbranch($pekerjaanBranchID);
       $data['branch'] = $this->Managementbrandcms_model->selectBranch();
       $data['pekerjaan'] = $this->Pekerjaancms_model->getPekerjaan();
      //  $this->pr($data);
       if(!empty($this->input->post('method'))){
           $this->form_validation->set_rules('branch', 'branch', 'required');
           $this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'required');
           $idPekerjaanBranch = $this->Sequencecms_model->next('cms_tm_pekerjaan_branch');
           if($this->form_validation->run() == true) {
              $updatedataPekerjaanBranch = array(
                 'branch_id'=>$this->input->post('branch'),
                 'pekerjaan_id'=>$this->input->post('pekerjaan'),
                 'last_update'=>date('Y-m-d H:i:s'),
                 'last_update_by'=>$this->userInfo()->user_no
              );
              try {
                 $this->Pekerjaancms_model->updatePekerjaanbranch($updatedataPekerjaanBranch,$pekerjaanBranchID);
                 $set_notif = array('notifsukses' => 'Pekerjaan Branch Berhasil Disimpan');
                 $this->session->set_userdata($set_notif);
                 redirect("pekerjaancms/listpekerjaanbranch");
               }catch (Exception $ex) {
                 $set_notif = array('notiferror' => $ex);
                 $this->session->set_userdata($set_notif);
                 redirect("pekerjaancms/listpekerjaanbranch");
               }
           }
       }
       $this->load->view('pekerjaan/editpekerjaanbranch',$data);
    }

    public function validation() {
        $configValidation = array(array('field' => 'name','label' => 'Name','rules' => 'required'));
        return $configValidation;
    }



}
