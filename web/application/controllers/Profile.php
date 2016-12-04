<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class Profile extends General {
    public function __construct()
    {
          parent::__construct();
          $this->load->helper('url');
          $this->load->library('form_validation');
          $this->load->model("Lowongancms_model");
          $this->load->model("Soalcms_model");
          $this->load->model("Pelamarcms_model");
          $this->load->model('General_model');
          $this->load->model('Sequencecms_model');
          $this->checkLogin();
    }

    public function Index(){
          $data['userInfo'] = $this->Pelamarcms_model->searchPelamars($this->userInfo()->pelamar_no);
          $data['personalInfo']= $this->Pelamarcms_model->searchPelamarInfo($this->userInfo()->pelamar_no);
          if(empty($data['personalInfo'])){
            $this->session->set_flashdata('error', 'Harap lengkapi data personal anda. Terima kasih.');
            redirect('Register/step2');
          }
          if(!empty($_POST['download'])){
            $this->load->helper('download');
            $url = $_POST['url'];
            $realname = $_POST['realname'];
            $content = file_get_contents($url);
            force_download($realname, $content);
          }
          if(!empty($_POST['update'])){
            $updateData = array();
            if(!empty($_POST['email'])){
              $this->form_validation->set_rules('email', 'email', 'required|valid_email');
              if ($this->form_validation->run() == true) {
                $updateData['_email'] = $_POST['email'];
              }
            }

            if($_FILES['upload-resume']['name']){
               $upload = $this->UploadCV($_FILES['upload-resume']['name'],$_FILES['upload-resume']['tmp_name']);
               if($upload['success']){
               $updateData['_resume_real_name']=$upload['_resume_real_name'];
               $updateData['_resume_url']=$upload['_resume_url'];
               $updateData['_resume_enc_name']=$upload['_resume_enc_name'];
               $updateData['last_update'] = date('Y-m-d H:i:s');
               }
            }
            if(!empty($updateData)){
              $updatePelamar = $this->Pelamarcms_model->updatePelamar($updateData,$this->userinfo()->pelamar_no);
            }
              if ($updatePelamar==true)
              {
                $session_alert_type = "success";
                $session_alert_message = "Data Akun Berhasil Di Update.";
              }
              else
              {
                $session_alert_type = "error";
                $session_alert_message = "Resume (CV) gagal Di ubah. Silahkan dicoba kembali atau hubungi call center, terima kasih.";
              }
              $this->session->set_flashdata($session_alert_type,$session_alert_message);
              redirect('Profile');



          }
          if(!empty($_POST['remove'])){
              $updateData['_resume_real_name']='';
              $updateData['_resume_url']='';
              $updateData['_resume_enc_name']='';
              $updateData['last_update'] = date('Y-m-d H:i:s');
              /**
              sample action & lempar session alert
              */
                $removeResume = $this->Pelamarcms_model->updatePelamar($updateData,$this->userinfo()->pelamar_no);
                if ($removeResume==true)
                {
                  $session_alert_type = "success";
                  $session_alert_message = "Resume (CV) berhasil dihapus.";
                }
                else
                {
                  $session_alert_type = "error";
                  $session_alert_message = "Resume (CV) gagal dihapus. Silahkan dicoba kembali atau hubungi call center, terima kasih.";
                }
                $this->session->set_flashdata($session_alert_type,$session_alert_message);
              /**
              end sample action & lempar session alert
              */
              redirect('Profile');
          }
  		    $this->load->view('profile/dataakun',$data);

  	}

    public function personal()
    {
          $data['userInfo'] = $this->userInfo();
          $data['personalInfo']= $this->Pelamarcms_model->searchPelamarInfo($this->userInfo()->pelamar_no);
          $data['religion'] = $this->General_model->getReligion();
          $data['pendidikan'] = $this->General_model->getPendidikan();
          $data['warnakulit'] = $this->General_model->getWarnaKulit();
          $data['statuspernikahan'] = $this->General_model->getStatusPernikahan();
          $data['bank'] = $this->General_model->getBank();
          $data['kendaraan']=$this->General_model->getKendaraan();
          $data['asuransi'] = $this->General_model->getAsuransi();
          $data['kota']=$this->General_model->getKota();
          // $this->pr($data);
          if(!empty($_POST)){

            $configValidation = $this->Validation();
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules($configValidation);
            if($this->form_validation->run()===TRUE){
                  $dataPelamarInfo = array(
                    '_no_ktp'=>$this->input->post('n_ktp'),
                    '_fullname'=>$this->input->post('n_lengkap'),
                    'place_birth'=>$this->input->post('tempat_lahir'),
                    '_birthdate'=>$this->input->post('tgl_lahir'),
                    '_gender'=>$this->input->post('j_kelamin'),
                    '_closer_person_fullname'=>$this->input->post('n_orang_t'),
                    '_closer_person_phone'=>$this->input->post('t_orang_t'),
                    'religion_id'=>$this->input->post('agama'),
                    '_address_ktp'=>$this->input->post('alamatktp'),
                    '_address_ktp_kelurahan'=>$this->input->post('kelurahan'),
                    '_address_ktp_kecamatan'=>$this->input->post('kecamatan'),
                    'address_ktp_kota'=>$this->input->post('ktp'),
                    '_address_sekarang'=>$this->input->post('alamat_sekarang'),
                    'address_sekarang_kota'=>$this->input->post('kota_sekarang'),
                    '_height'=>$this->input->post('beratbadan'),
                    '_weight'=>$this->input->post('tinggibandan'),
                    'skin_color_id'=>$this->input->post('warnakulit'),
                    '_phone_home'=>$this->input->post('t_rumah'),
                    '_phone_primary'=>$this->input->post('t_hpke_1'),
                    '_phone_secondary'=>$this->input->post('t_hpke_2'),
                    'relationship_id'=>$this->input->post('s_pernikahan'),
                    '_total_children'=>$this->input->post('jumlahanak'),
                    '_no_sim_a'=>$this->input->post('n_sim_a'),
                    '_no_sim_b1'=>$this->input->post('n_sim_b1'),
                    '_no_sim_b2'=>$this->input->post('n_sim_b2'),
                    '_no_sim_c'=>$this->input->post('n_simc'),
                    'owned_kendaraan_id'=>$this->input->post('k_yang_dimiliki'),
                    '_no_npwp'=>$this->input->post('npwp'),
                    '_no_bpjs_tk'=>$this->input->post('bpjs_k'),
                    '_no_bpjs_kesehatan'=>$this->input->post('bpjs_kes'),
                    'insurance_id'=>$this->input->post('p_asuransi'),
                    '_no_insurance'=>$this->input->post('p_asuransi_rek'),
                    'pendidikan_id'=>$this->input->post('pendidikan'),
                    '_pendidikan_place'=>$this->input->post('t_pendidikan'),
                    '_pendidikan_year'=>$this->input->post('t_lulus'),
                    'bank_id'=>$this->input->post('p_bank'),
                    '_phone_home'=>$this->input->post('t_rumah'),
                    '_phone_primary'=>$this->input->post('t_hpke_1'),
                    '_phone_secondary'=>$this->input->post('t_hpke_2'),
                    '_bank_account_no'=>$this->input->post('p_bank_rek'),
                    '_experience'=>$this->input->post('pengalaman'),
                    'last_update'=>date ('Y-m-d H:i:s'),
                );
                  #upload Foto
                  if(!empty($_FILES['profile'])){
                      $profile = $_FILES['profile'];
                      $maxFle = 1000000; #one MB;
                      if($profile['size'] > $maxFle){
                        $this->session->set_flashdata('error', 'Photo Profile Tidak Boleh Lebih Dari 1 MB');
                        redirect('Register/step2');
                      }
                      $uploadProfile = $this->uploadImage($profile['name'],$profile['tmp_name']);
                      if($uploadProfile['success']){
                      $dataPelamarInfo['_photo_url']= $uploadProfile['_photo_url'] ;
                      $dataPelamarInfo['_photo_real_name']= $uploadProfile['_photo_real_name'];
                      $dataPelamarInfo['_photo_enc_name']= $uploadProfile['_photo_enc_name'];
                    }
                  }
                  $this->Pelamarcms_model->updatePelamarInfo($dataPelamarInfo,$_POST['personalInfo']);

                  $this->session->set_flashdata('success', 'Personal Data Berhasil Disimpan !!');
                  redirect('Profile/personal');
            }
          }
          $this->load->view('profile/profile',$data);

    }

    public function family(){
        $data['userInfo'] = $this->userInfo();
        $data['personalInfo']= $this->Pelamarcms_model->searchPelamarInfo($this->userInfo()->pelamar_no);
        $data['personalFamily'] = $this->Pelamarcms_model->searchPelamarFamily($this->userInfo()->pelamar_no);
        if(!empty($_POST)){
          $this->form_validation->set_rules('nsoi', 'Nama Suami / Istri', 'required');
          $this->form_validation->set_rules('jumlahanak','Jumlah Anak','required');
          if($this->form_validation->run()===TRUE) {
              $dataUpdate = array(
                '_name' => $_POST['nsoi'],
                '_phone'  => $_POST['telp'],
                'last_update'=>date('Y-m-d H:i:s')
              );
              $this->Pelamarcms_model->updatePelamarFamily($dataUpdate,$_POST['familyInfo']);

              /*Update Jumlah Anak */
              $dataAnak = array(
                'last_update'=>date('Y-m-d H:i:s'),
                '_total_children'=>$_POST['jumlahanak']
              );
              $this->Pelamarcms_model->updatePelamarInfo($dataAnak,$_POST['NoPersonalInfo']);
              $this->session->set_flashdata('success', 'Profile Data Keluarga Berhasil Diupdate.');
              redirect('Profile/family');
          }

        }
        // $this->pr($data);
        if($data['personalInfo']->relationship_id != 'RELATIONSHIP02'){
          $this->load->view('profile/family',$data);
        }else{
          $this->load->view('profile/nonfamily',$data);
        }
    }


    public function start(){
          $data['TanjungJawab'] = $this->Soalcms_model->TypeTanggungJawab();
          $data['IntegritasKejujuran']  = $this->Soalcms_model->TypeIntegritasKejujuran();
          $data['InisiatifKreatifitas'] = $this->Soalcms_model->TypeInisitipKreatif();
          $data['Teamwork'] = $this->Soalcms_model->TypeTeamWork();
          $data['TypeSoal'] = $this->Soalcms_model->typeSoal();
          $this->load->view('psikotes/start',$data);

    }

    public function download($realname,$url){
          file_put_contents($realname, fopen($url, 'r'));
          return;
    }

    public function changePassword(){
          $data['userInfo'] = $this->userInfo();
          $data['personalInfo']= $this->Pelamarcms_model->searchPelamarInfo($this->userInfo()->pelamar_no);
          if(!empty($_POST)){
            $this->form_validation->set_rules('oldpassword', 'Old Password', 'required');
            $this->form_validation->set_rules('newpassword', 'New Password', 'required');

            if ($this->form_validation->run() == true) {
                $oldpassword = encText($_POST['oldpassword']);
                $newpassword = encText($_POST['newpassword']);
                $check = $this->Pelamarcms_model->searchChangePW($this->userInfo()->pelamar_no,$oldpassword);
                if($check){
                  if($oldpassword === $newpassword){
                      $this->session->set_flashdata('error', 'Password baru tidak boleh sama dengan password lama');
                      redirect('Profile/changepassword');
                  }else{
                      $updatePassword = array(
                          'last_update'=>date('Y-m-d H:i:s'),
                          '_password' => trim($newpassword,' ')
                      );
                      $this->Pelamarcms_model->updatePelamar($updatePassword,$this->userInfo()->pelamar_no);
                      $this->session->set_flashdata('notifsukses', 'Password berhasil di ubah');
                      redirect('Profile/changepassword');
                  }
                }else{
                  $this->session->set_flashdata('error', 'Password Lama Salah, Silahkan coba lagi');
                  redirect('Profile/changepassword');
                }
            }



          }
          $this->load->view('profile/password',$data);
    }

    public function ajaxsavefamily(){
        if(!empty($_POST)){
          $this->form_validation->set_rules('formanak','Nama Anak','required');
          if($this->form_validation->run()===TRUE) {
              $dataUpdate = array(
                '_name' => $_POST['formanak'],
                '_phone'  => $_POST['formtlp'],
                'last_update'=>date('Y-m-d H:i:s')
              );
              $this->Pelamarcms_model->updatePelamarFamily($dataUpdate,$_POST['pelamarFamily']);
              $this->session->set_flashdata('success', 'Profile Personal Data Keluarga Berhasil Di Update.');
              echo $this->session->flashdata('success');
          }else{
                echo $this->session->set_flashdata('error',validation_errors());
          }

        }
    }

    public function ajaxaddfamily(){
        if(!empty($_POST)){
          $IDPelamarInfoFamily = $this->Sequencecms_model->next('fe_tm_pelamar_family_info');
          $this->form_validation->set_rules('formanak','Nama Anak','required');
          if($this->form_validation->run()===TRUE) {
              $dataInsert = array(
                  'pelamar_family_info_no'  =>$IDPelamarInfoFamily['nextval'],
                  'pelamar_no'  =>$_POST['pelamarNo'],
                  'family_type_id'  =>'FAMILY03',
                  '_name'   => $_POST['formanak'],
                  '_phone'  => $_POST['formtlp'],
                  'create_date' =>date('Y-m-d H:i:s'),
                  '_delete' =>'0'
              );
              $this->Pelamarcms_model->insertPelamarFamily($dataInsert);
              $this->session->set_flashdata('success', 'Profile Personal Data Keluarga, Anak Berhasil diupdate.');
              echo $this->session->flashdata('success');
          }else{
                echo $this->session->set_flashdata('error',validation_errors());
          }


        }
    }
    public function ajaxchangeFamily(){
        if(!empty($_POST)){
           $personalFamilyNo = $_POST['personalFamilyNo'];
           $pelamaNo = $_POST['pelamarNo'];
           $totalChild = $this->Pelamarcms_model->searchPelamarInfo($pelamaNo);
           $updatePersonal = array(
             'last_update'=>date('Y-m-d H:i:s'),
             '_total_children'=>$totalChild->_total_children - 1,
           );
           $updatePersonalFamily = array(
             'last_update'=>date('Y-m-d H:i:s'),
             '_delete'=>'1',
           );
           $this->Pelamarcms_model->updatePelamarInfochildren($updatePersonal,$pelamaNo);
           $this->Pelamarcms_model->updatePelamarFamily($updatePersonalFamily,$personalFamilyNo);

           $this->session->set_flashdata('success', 'Profile Personal Data Keluarga Anak Berhasil Di Hapus.');
           echo $this->session->flashdata('success');
        }
    }

    public function Validation() {
        $configValidation = array(
                array(
                    'field' => 'n_ktp',
                    'label' => 'Nomer KTP',
                    'rules' => 'required'
                ), array(
                    'field' => 'n_lengkap',
                    'label' => 'Nama Lengkap',
                    'rules' => 'required'
                ), array(
                    'field' => 'j_kelamin',
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required'
                ), array(
                    'field' => 'agama',
                    'label' => 'Agama',
                    'rules' => 'required'
                ), array(
                    'field' => 'alamatktp',
                    'label' => 'Alamat (KTP)',
                    'rules' => 'required'
                ),array(
                    'field' => 'kelurahan',
                    'label' => 'Kelurahan (KTP)',
                    'rules' => 'required'
                ),array(
                    'field' => 'kecamatan',
                    'label' => 'Kecamatan (KTP)',
                    'rules' => 'required'
                ),array(
                    'field' => 'ktp',
                    'label' => 'Kota (KTP)',
                    'rules' => 'required'
                ), array(
                    'field' => 'alamat_sekarang',
                    'label' => 'Alamat Sekarang',
                    'rules' => 'required'
                ), array(
                    'field' => 'kota_sekarang',
                    'label' => 'Kota Sekarang',
                    'rules' => 'required'
                ), array(
                    'field' => 'warnakulit',
                    'label' => 'Warna Kulit',
                    'rules' => 'required'
                ), array(
                    'field' => 's_pernikahan',
                    'label' => 'Status Pernikahan',
                    'rules' => 'required'
                ), array(
                    'field' => 't_hpke_1',
                    'label' => 'Nomer Telpon HP Ke 1',
                    'rules' => 'required'
                ), array(
                    'field' => 'n_orang_t',
                    'label' => 'Nama Orang Terdedat',
                    'rules' => 'required'
                ), array(
                    'field' => 't_orang_t',
                    'label' => 'Nomer Telpon Orang Terdekat',
                    'rules' => 'required'
                ), array(
                    'field' => 'k_yang_dimiliki',
                    'label' => 'Kendaraan Yang Dimiliki',
                    'rules' => 'required'
                ), array(
                    'field' => 'p_asuransi',
                    'label' => 'Provider Asuransi',
                    'rules' => 'required'
                ), array(
                    'field' => 'pendidikan',
                    'label' => 'Pendidikan',
                    'rules' => 'required'
                ), array(
                    'field' => 't_lulus',
                    'label' => 'Tahun Lulus',
                    'rules' => 'required'
                ), array(
                    'field' => 'p_bank',
                    'label' => 'Provider Bank',
                    'rules' => 'required'
                ), array(
                    'field' => 'pengalaman',
                    'label' => 'Pegalaman',
                    'rules' => 'required'
                )
            );

        return $configValidation;
    }

}
