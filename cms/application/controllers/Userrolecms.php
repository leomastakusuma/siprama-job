<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';
class Userrolecms extends General
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Userrolecms_model');
        $this->load->model('Usercms_model');
        $this->load->model('Rolecms_model');
        $this->load->model('Managementbrandcms_model');
        $this->load->model('Sequencecms_model');

    }

    public function Index()
    {
        //Cek Access Url
        $this->getAccessUrl('ROLE00002916');
        $data['result'] = $this->Userrolecms_model->getUserAccess();
        $this->load->view('userrole/userrole', $data);
    }

    public function Adduserrole()
    {
        //Cek Access Url
        $this->getAccessUrl('ROLE00001516');
        $data['level_id'] = $this->Usercms_model->getUserLever();
        $data['branch'] = $this->Managementbrandcms_model->selectBranch();
        $data['role_id']  = $this->Rolecms_model->listRole();
        if(!empty($_POST)){
          $this->form_validation->set_rules('level', 'level', 'required');
          $this->form_validation->set_rules('branch', 'branch', 'required');
          $this->form_validation->set_rules('role', 'role', 'required');
          $idUserAccesss = $this->Sequencecms_model->next('cms_tm_user_access');
          $userInfo = $this->userInfo();
          if($this->form_validation->run() == true) {
             $dataInsert = array(
               'user_access_no'=>$idUserAccesss['nextval'],
               'branch_role_id'=>$this->input->post('role'),
               'user_level_id'=>$this->input->post('level'),
               '_active'=>'1',
               '_delete'=>'0',
               'create_date'=>date('Y-m-d H:i:s'),
               'create_by'=>$userInfo->user_no
             );
             try{
               $check = $this->Userrolecms_model->checkExistAcces($dataInsert['branch_role_id'],$dataInsert['user_level_id']);
               if($check['status']==1){
                 $this->Userrolecms_model->insertUserAccess($dataInsert);
                 $set_notif = array('notifsukses' => 'User Access Berhasil Disimpan');
               }else {
                 $set_notif = array('notiferror' => 'User Access Gagal Disimpan');
               }
               $this->session->set_userdata($set_notif);
               redirect("userrolecms");
             }catch (Exception $ex) {
               $set_notif = array('notiferror' => $ex);
               $this->session->set_userdata($set_notif);
               redirect("userrolecms");
             }
          }
        }

        $this->load->view('userrole/addaccessrole', $data);
    }

    public function ajaxRole() {
        $branch = $this->input->post('id');
        if (!empty($branch)) {
            $data = $this->Managementbrandcms_model->searchBranchRole($branch);
            $list = '<option value="">Pilih Role</option>';
            foreach ($data as $v) {
                $id = $v['branch_role_id'];
                $name = $v['_name'];
                $list .= '<option value="' . $id . '">' . $name . '</option>';
            }
        } else {
            $list = '<option value="">Pilih Role</option>';
        }
        echo $list;
    }

    public function Userrole()
    {
        $this->load->view('userrole');
    }


    public function userroleOperation($p_user_access_no)
    {
        if ($this->input->post('delete')) {
           $hapus_kiwod = $this->Userrolecms_model->hapus_role($p_user_access_no);
           $set_notif = array('notifsukses' => $hapus_kiwod);
           $this->session->set_userdata($set_notif);
           redirect("userrolecms");
        } elseif ($this->input->post('set_nonactive')) {
            $set_aktif = $this->Userrolecms_model->set_active($p_user_access_no);
            $set_notif = array('notifsukses' => $set_aktif);
            $this->session->set_userdata($set_notif);
            redirect("userrolecms");
        } elseif ($this->input->post('set_active')) {
            $set_noaktif = $this->Userrolecms_model->set_noactive($p_user_access_no);
            $set_notif = array('notiferror' => $set_noaktif);
	          $this->session->set_userdata($set_notif);
            redirect("userrolecms");
        }else{
    			redirect("userrolecms");
    		}
    }

}
