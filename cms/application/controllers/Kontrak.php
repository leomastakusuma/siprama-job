<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class Kontrak extends General {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Kontrakcms_model');
        $this->load->model('Sequencecms_model');

    }

    public function Index()
  	{
        $this->getAccessUrl('ROLE00009716');

        if(!empty($_SESSION['idKontrakTemp'])){
          $this->session->unset_userdata('idKontrakTemp');
        }

        $listKontrak = $this->Kontrakcms_model->listkontrak();
        $whereIN = '';
        if($listKontrak){
          foreach ($listKontrak as $key => $value) {
            if($key > 0){
              $whereIN .= ',';
            }
            $whereIN .="'".$value->apply_lowongan_no."'";
          }
        }
        $data['result'] = $this->Kontrakcms_model->listInterviewClient($whereIN);
        $data['datakontrak'] = $this->Kontrakcms_model->getKontrak();
        // echo $this->db->last_query();
        // $this->pr($data);
        $this->load->view('kontrak/listkontrak',$data);
        $data['bulan'] = $this->Romawi(date('m'));
  	}

    public function addkontrak($idLowongan){
       #Create Kontrak Tmp When open form
       $this->getAccessUrl('ROLE00009816');

       if(!empty($this->session->userdata('idKontrakTemp'))){
            $data['idKontrakTemp'] = $this->session->userdata('idKontrakTemp');
       }else{
            $idKontrakTmp  = $this->Kontrakcms_model->getIDKontrakTemp();
            $kontrakTemp = array('idKontrakTemp'=>$idKontrakTmp->nextval);
            $this->session->set_userdata($kontrakTemp);
            $data['idKontrakTemp'] = $this->session->userdata('idKontrakTemp');
       }

       $data['select'] = $this->Kontrakcms_model->seletType();
       $data['pelamarInfo'] = $this->Kontrakcms_model->detailPelamarInfo($idLowongan);
       $data['kontrakTemp'] = $this->Kontrakcms_model->selectKontrakTemp($data['idKontrakTemp']);
      //  $this->pr($data);
       $this->load->view('kontrak/buatkontrak',$data);
    }


    public function editkontrak($idLowongan){
       #Create Kontrak Tmp When open form
       $this->getAccessUrl('ROLE00010116');
       $data['getKontrak'] = $this->Kontrakcms_model->getdetailKontrak($idLowongan);
      //  $this->pr($getKontrak);
      if(empty($data['getKontrak'])){
        $set_notif = array('notiferror' => 'Ops Data Tidak Ditemukan');
        $this->session->set_userdata($set_notif);
        redirect("Kontrak");
      }

       $data['select'] = $this->Kontrakcms_model->seletType();
       $data['pelamarInfo'] = $this->Kontrakcms_model->detailPelamarInfo($idLowongan);
       $data['kontrak'] = $this->Kontrakcms_model->getdetailKontrak($idLowongan);
       $data['kontrakTemp'] = $this->Kontrakcms_model->getdetailKontrakAtch($data['getKontrak']->kontrak_no);
      //  $this->pr($data);
       $this->load->view('kontrak/editkontrak',$data);
    }

    public function deleteKontrakAtch(){
      $this->getAccessUrl('ROLE00010216');

       $this->Kontrakcms_model->deleteKontrakAtch($this->input->post('kontrakAtch'));
       $set_notif = array('notifsukses' => 'Rincian Kontrak Berhasil Dihapus');
       $this->session->set_userdata($set_notif);
    }

    public function detailkontrak($idLowongan){
      $this->getAccessUrl('ROLE00009916');

       $data['result'] = $this->Kontrakcms_model->listInterviewClient();
       $data['select'] = $this->Kontrakcms_model->seletType();
       $data['pelamarInfo'] = $this->Kontrakcms_model->detailPelamarInfo($idLowongan);
       if(empty($data['pelamarInfo'])){
         $set_notif = array('notiferror' => 'Ops Data Tidak Ditemukan');
         $this->session->set_userdata($set_notif);
         redirect("Kontrak");
       }
       $data['kontrak'] = $this->Kontrakcms_model->getdetailKontrak($idLowongan);
       $data['kontrakAtch'] = $this->Kontrakcms_model->getdetailKontrakAtch( $data['kontrak']->kontrak_no);
      //  $this->pr($data);

       $this->load->view('kontrak/detailkontrak',$data);
    }

    public function ajaxKontrak(){
        if($_POST){
             $idLowongan = $this->input->post('idLowongan');
             $idKontrak = $this->Kontrakcms_model->getKontrakNO();
             $dataKontrakAtch = array(
                  'kontrak_no'=>$idKontrak->nextval,
                  'branch_id'=>branchID,
                  'apply_lowongan_no'=>$this->input->post('idLowongan'),
                  'type_lowongan_id'=>$this->input->post('typelowongan'),
                  '_periode_start'=>$this->input->post('priodeawal'),
                  '_periode_end'=>$this->input->post('priodeakhir'),
                  '_active'=>'1',
                  '_print'=>'0',
                  'create_date'=>date('Y-m-d H:i:s'),
                  'create_by'=>$this->userInfo()->user_no,
                  '_delete'=>'0'
             );

             try{
                    $this->Kontrakcms_model->insertKontrak($dataKontrakAtch);
                    $updateDataKontrakAtch = array(
                      'kontrak_no'=>$idKontrak->nextval,
                    );
                    $this->Kontrakcms_model->updateKontrakAtch($updateDataKontrakAtch,$this->input->post('tempKontrak'));
                    $set_notif = array('notifsukses' => 'Kontrak Berhasil Disimpan');
                    $this->session->set_userdata($set_notif);

                    #unset Session Kontrak
                    $this->session->unset_userdata('idKontrakTemp');


             }catch(Exception $e){
                $set_notif = array('notiferror' => 'Kontrak Tidak Berhasil Disimpan');
                $this->session->set_userdata($set_notif);
             }

        }
    }

    public function ajaxEditKontrak(){
        if($_POST){
             $idLowongan = $this->input->post('idLowongan');
             $kontrakNO  = $this->input->post('kontrakNO');
             $dataKontrakAtch = array(
                  '_periode_start'=>$this->input->post('priodeawal'),
                  '_periode_end'=>$this->input->post('priodeakhir'),
                  'last_update'=>date('Y-m-d H:i:s'),
                  'last_update_by'=>$this->userInfo()->user_no,
             );

            //  print_r($_POST);
             try{
                $this->Kontrakcms_model->updateKontrakbyKontrak($dataKontrakAtch,$kontrakNO);
                // echo $this->db->last_query();
                $set_notif = array('notifsukses' => 'Kontrak Berhasil Diubah');
                $this->session->set_userdata($set_notif);
             }catch(Exception $e){
                $set_notif = array('notiferror' => 'Kontrak Tidak Berhasil Disimpan');
                $this->session->set_userdata($set_notif);
             }

        }
    }



    public function ajaxKontrakatch(){
        if($_POST){
             $idLowongan = $this->input->post('idLowongan');
             $idKontrakAtch = $this->Kontrakcms_model->getIDKontrakAttch();
             $kontrakNO = !empty($this->input->post('kontrakNO')) ?  $this->input->post('kontrakNO') : NULL;
             $setPosition = $this->Kontrakcms_model->setPosition($this->input->post('tempKontrak'),$kontrakNO);
            //  $posisi = $setPosition->posisi != 1 ? $setPosition->posisi+1 : 1;
             $dataKontrakAtch = array(
                  'kontrak_attachment_no'=>$idKontrakAtch->nextval,
                  'kontrak_temp_no'=>!empty($this->input->post('tempKontrak')) ? $this->input->post('tempKontrak') : NULL ,
                  'kontrak_no'=>$kontrakNO,#!empty($_POST['kontrakNO']) ?  $_POST['kontrakNO'] : NULL,
                  'type_attachment_id'=>$this->input->post('tipe'),
                  '_amount' => $this->input->post('jumlah'),
                  '_position'=>$setPosition->posisi,
                  'create_date'=>date('Y-m-d H:i:s'),
                  'create_by'=>$this->userInfo()->user_no,
                  '_delete'=>'0'
             );
             #checkExistTIPE
             if($kontrakNO){
               $exisTipe = $this->Kontrakcms_model->checkExisKontrakAttch($this->input->post('tempKontrak'),$this->input->post('tipe'),$kontrakNO);
             }else{
               $exisTipe = $this->Kontrakcms_model->checkExisKontrakAttch($this->input->post('tempKontrak'),$this->input->post('tipe'));
             }
             echo $this->db->last_query();
             if($exisTipe){
                 $set_notif = array('notiferror' => 'Tidak boleh memilih tipe yang sama');
                 $this->session->set_userdata($set_notif);
             }else{
                 $this->Kontrakcms_model->insertKontrakAtch($dataKontrakAtch);
                 $set_notif = array('notifsukses' => 'Rincian Berhasi Ditambahkan');
                 $this->session->set_userdata($set_notif);
             }
        }
    }


    public function Romawi($n){
        $hasil = "";
        $iromawi = array("","I","II","III","IV","V","VI","VII","VIII","IX","X",20=>"XX",30=>"XXX",40=>"XL",50=>"L",
                          60=>"LX",70=>"LXX",80=>"LXXX",90=>"XC",100=>"C",200=>"CC",300=>"CCC",400=>"CD",500=>"D",600=>"DC",700=>"DCC",
                          800=>"DCCC",900=>"CM",1000=>"M",2000=>"MM",3000=>"MMM");
        if(array_key_exists($n,$iromawi)){
          $hasil = $iromawi[$n];
        }elseif($n >= 11 && $n <= 99){
          $i = $n % 10;
          $hasil = $iromawi[$n-$i] . $this->Romawi($n % 10);
        }elseif($n >= 101 && $n <= 999){
          $i = $n % 100;
          $hasil = $iromawi[$n-$i] . $this->Romawi($n % 100);
        }else{
          $i = $n % 1000;
          $hasil = $iromawi[$n-$i] . $this->Romawi($n % 1000);
        }
        return $hasil;
    }

    public function batal($idLowongan){
      $this->getAccessUrl('ROLE00010216');

       $updateData = array(
          'last_update_by'=>$this->userInfo()->user_no,
          'last_update'=>date('Y-m-d'),
          '_delete'=>'1',
       );
       $this->Kontrakcms_model->updateKontrak($updateData,$idLowongan);
       $set_notif = array('notifsukses' => 'Kontrak Berhasil Dibatalkan. ');
       $this->session->set_userdata($set_notif);
       redirect('Kontrak');

    }

    public function cetak($idLowongan){
      $this->getAccessUrl('ROLE00010016');
       $getPrint = $this->Kontrakcms_model->getdetailKontrak($idLowongan);
       if(empty($getPrint)){
         $set_notif = array('notiferror' => 'Ops Data Tidak Ditemukan');
         $this->session->set_userdata($set_notif);
         redirect("Kontrak");
       }
       $data['pelamarInfo'] = $this->Kontrakcms_model->detailPelamarInfo($idLowongan);
       $data['kontrak'] = $this->Kontrakcms_model->getdetailKontrak($idLowongan);
       $data['kontrakAtch'] = $this->Kontrakcms_model->getdetailKontrakAtch( $data['kontrak']->kontrak_no);

       $data['bulan'] = $this->Romawi(date('m'));
      //  $this->pr($data);
       $updateData = array(
          'last_update_by'=>$this->userInfo()->user_no,
          'last_update'=>date('Y-m-d'),
          '_last_print_date'=>date('Y-m-d H:i:s'),
          '_print'=>!empty($getPrint->_print) ? $getPrint->_print+1 : 1,
       );
       $this->Kontrakcms_model->updateKontrak($updateData,$idLowongan);
       if($getPrint->type_lowongan_id =='CTGLWGN01'){
         $this->load->view('kontrak/kontrak',$data);
       }else{
         $this->load->view('kontrak/kontrakevent',$data);
       }


    }

}
