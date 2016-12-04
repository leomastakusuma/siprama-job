<?php

class Lamarancms_model extends CI_Model {

    protected $_table = 'cms_tm_location';

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function insertLocation($data) {
          return $this->db->insert($this->_table, $data);
    }
    public function updatelocation($updateData,$lokid) {
        $this->db->where('location_no', $lokid);
        $data = $this->db->update($this->_table, $updateData);
    }
    function select($data) {
        $this->db->select($data);
        $this->db->where("_delete", "0");
        $query = $this->db->get("cms_tm_location");

        return $query->result_array();
    }

    public function insertInterview($data){
       return $this->db->insert('cms_tx_interview',$data);
    }

    public function insertInterviewClient($data){
      return $this->db->insert('cms_tx_interview_client',$data);
    }

    public function listApply(){
        $sql = "SELECT
                   ap.apply_lowongan_no,
                   ap.branch_id,
                   ap.lowongan_no,
                   l.type_lowongan_id,
                   tl._name as type_lowongan_name,
                   l._name as lowongan_name,
                   p._name as lowongan_posisi,
                   c._name, c._logo_enc_name,
                   ap.status_apply_lowongan_id,
                   stlw._name as status_lamar_name,
                   ap.create_date as tanggal_lamar,
                   sp._name as status_psikotes,
                   ap._cancel,
                   ap.pelamar_no,
                   ap._cancel_reason,
                   ap.last_update,
                   pe._fullname as namalengkap,
                   ps.psikotes_no,
                   ps.status_psikotes_id
                FROM fe_tx_psikotes ps,fe_tm_pelamar_personal_info pe,fe_tx_apply_lowongan ap, sys_type sp, cms_tm_lowongan l, sys_type tl, cms_tm_client c, cms_tm_pekerjaan_branch pb, cms_tm_pekerjaan p, sys_type stlw
                WHERE
                  ap.lowongan_no = l.lowongan_no
                  AND l.pekerjaan_branch_no = pb.pekerjaan_branch_no
                  AND pb.pekerjaan_id = p.pekerjaan_id
                  AND l.client_id = c.client_id
                  AND ap.status_apply_lowongan_id = stlw.type_id
                  AND l.type_lowongan_id = tl.type_id
                  AND pe.pelamar_no = ap.pelamar_no
                  AND ps.status_psikotes_id = sp.type_id
                  AND ps.apply_lowongan_no = ap.apply_lowongan_no
                  AND ap._cancel ='0'";
                  $query = $this->db->query($sql);
                  return $result = $query->result();

    }

    public function Psikotes($id){
        $sql = "SELECT
                 ap.apply_lowongan_no,
                 ap.branch_id,
                 ap.lowongan_no,
                 l.type_lowongan_id,
                 tl._name as type_lowongan_name,
                 l._name as lowongan_name,
                 p._name as lowongan_posisi,
                 c._name, c._logo_enc_name,
                 ap.status_apply_lowongan_id,
                 stlw._name as status_lamar_name,
                 ap.create_date as tanggal_lamar,
                 ap._cancel,
                 ap._cancel_reason,
                 ap.last_update,
                 pe._fullname,
                 pe.pelamar_no,
                 ps.psikotes_no,
                 sp.type_id as status_psikotes_id,
                 sp._name as status_psikotes,
                 ps._analisa,
                 ps._score,
                 ps.create_date as tglPsikotes
              FROM fe_tx_psikotes ps,fe_tx_apply_lowongan ap,fe_tm_pelamar_personal_info pe, cms_tm_lowongan l, sys_type sp, sys_type tl, cms_tm_client c, cms_tm_pekerjaan_branch pb, cms_tm_pekerjaan p, sys_type stlw
              WHERE
                ap.lowongan_no = l.lowongan_no
                AND l.pekerjaan_branch_no = pb.pekerjaan_branch_no
                AND pb.pekerjaan_id = p.pekerjaan_id
                AND l.client_id = c.client_id
                AND ap.status_apply_lowongan_id = stlw.type_id
                AND l.type_lowongan_id = tl.type_id
                AND ps.status_psikotes_id = sp.type_id
                AND pe.pelamar_no = ap.pelamar_no
                AND ap.apply_lowongan_no = ps.apply_lowongan_no
                AND ap.apply_lowongan_no = '{$id}'";
                $query = $this->db->query($sql);
                // echo $this->db->last_query();die;
                return $result = $query->row();

    }

    public function selecStatus(){
      $sql = "SELECT * from sys_type where category_id ='22' AND type_id != 'STATUSPSI00'";
      $query = $this->db->query($sql);
      return $result = $query->result();
    }

    public function selecStatusIntervieClient(){
      $sql = "SELECT * from sys_type where category_id ='26' AND type_id !='STATUSINTCL00'";
      $query = $this->db->query($sql);
      return $result = $query->result();
    }

    public function selecStatusInterview(){
      $sql = "SELECT * from sys_type where category_id ='25' AND type_id != 'STATUSINT00'";
      $query = $this->db->query($sql);
      return $result = $query->result();
    }

    public function psikotesdetail($id){
      $sql = "SELECT * from fe_tx_psikotes_detail where  psikotes_no = '{$id}' ";
      $query = $this->db->query($sql);
      return $result = $query->result();
    }

    public function updatepsikotes($data,$id){
      $this->db->where('psikotes_no',$id);
      return $this->db->update('fe_tx_psikotes',$data);
    }

    public function updateInterview($data,$id){
      $this->db->where('interview_no',$id);
      return $this->db->update('cms_tx_interview',$data);
    }

    public function updateInterviewclient($data,$id){
      $this->db->where('interview_client_no',$id);
      return $this->db->update('cms_tx_interview_client',$data);
    }


    public function listInterview(){
        $sql = "SELECT
                   ap.apply_lowongan_no,
                   ap.branch_id,
                   ap.lowongan_no,
                   l.type_lowongan_id,
                   tl._name as type_lowongan_name,
                   l._name as lowongan_name,
                   p._name as lowongan_posisi,
                   stlw._name as status_interview_name,
                   ap.pelamar_no,
                   ap.last_update,
                   pe._fullname as namalengkap,
                   ps.psikotes_no,
                   intv.interview_no,
                   intv.status_interview_id
                FROM cms_tx_interview as intv, fe_tx_psikotes ps,fe_tm_pelamar_personal_info pe,fe_tx_apply_lowongan ap, cms_tm_lowongan l, sys_type tl, cms_tm_client c, cms_tm_pekerjaan_branch pb, cms_tm_pekerjaan p, sys_type stlw
                WHERE
                  ap.lowongan_no = l.lowongan_no
                  AND l.pekerjaan_branch_no = pb.pekerjaan_branch_no
                  AND pb.pekerjaan_id = p.pekerjaan_id
                  AND l.client_id = c.client_id
                  AND l.type_lowongan_id = tl.type_id
                  AND pe.pelamar_no = ap.pelamar_no
                  AND ps.apply_lowongan_no = ap.apply_lowongan_no
                  AND intv.psikotes_no = ps.psikotes_no
                  AND intv.status_interview_id = stlw.type_id
                  AND ap._cancel ='0'
                  AND ps.follow_up_by != ''";

                  $query = $this->db->query($sql);
                  return $result = $query->result();

    }

    public function Interview($id){
        $sql = "SELECT
                 ap.apply_lowongan_no,
                 ap.branch_id,
                 ap.lowongan_no,
                 l.type_lowongan_id,
                 tl._name as type_lowongan_name,
                 l._name as lowongan_name,
                 p._name as lowongan_posisi,
                 c._name, c._logo_enc_name,
                 ap.create_date as tanggal_lamar,
                 ap._cancel,
                 ap._cancel_reason,
                 ap.last_update,
                 pe._fullname,
                 pe.pelamar_no,
                 ps.psikotes_no,
                 sp._name as status_psikotes,
                 ps._analisa,
                 ps._score,
                 ps.create_date as tglPsikotes,
                 intv.interview_no,
                 intv._analisa_interview as analisaInterview,
                 stlw._name as status_interview_name,
                 intv.status_interview_id


              FROM cms_tx_interview as intv,fe_tx_psikotes ps,fe_tx_apply_lowongan ap,fe_tm_pelamar_personal_info pe, cms_tm_lowongan l, sys_type sp, sys_type tl, cms_tm_client c, cms_tm_pekerjaan_branch pb, cms_tm_pekerjaan p, sys_type stlw
              WHERE
                ap.lowongan_no = l.lowongan_no
                AND l.pekerjaan_branch_no = pb.pekerjaan_branch_no
                AND pb.pekerjaan_id = p.pekerjaan_id
                AND l.client_id = c.client_id
                AND l.type_lowongan_id = tl.type_id
                AND ps.status_psikotes_id = sp.type_id
                AND pe.pelamar_no = ap.pelamar_no
                AND intv.psikotes_no = ps.psikotes_no
                AND ap.apply_lowongan_no = ps.apply_lowongan_no
                AND intv.psikotes_no = ps.psikotes_no
                AND intv.status_interview_id = stlw.type_id
                AND ap.apply_lowongan_no = '{$id}'";
                $query = $this->db->query($sql);
                // echo $this->db->last_query();die;
                return $result = $query->row();

    }

    public function listInterviewClient(){
        $sql = "SELECT
                   ap.apply_lowongan_no,
                   ap.branch_id,
                   ap.lowongan_no,
                   l.type_lowongan_id,
                   tl._name as type_lowongan_name,
                   l._name as lowongan_name,
                   p._name as lowongan_posisi,
                   stlw._name as status_interview_client_name,
                   ap.pelamar_no,
                   ap.last_update,
                   pe._fullname as namalengkap,
                   ps.psikotes_no,
                   intv.interview_no,
                   intvc.status_interview_client_id,
                   intvc.interview_client_no
                FROM cms_tx_interview_client intvc, cms_tx_interview as intv, fe_tx_psikotes ps,fe_tm_pelamar_personal_info pe,fe_tx_apply_lowongan ap, cms_tm_lowongan l, sys_type tl, cms_tm_client c, cms_tm_pekerjaan_branch pb, cms_tm_pekerjaan p, sys_type stlw
                WHERE
                  ap.lowongan_no = l.lowongan_no
                  AND l.pekerjaan_branch_no = pb.pekerjaan_branch_no
                  AND pb.pekerjaan_id = p.pekerjaan_id
                  AND l.client_id = c.client_id
                  AND l.type_lowongan_id = tl.type_id
                  AND pe.pelamar_no = ap.pelamar_no
                  AND ps.apply_lowongan_no = ap.apply_lowongan_no
                  AND intv.psikotes_no = ps.psikotes_no
                  AND intvc.interview_no = intv.interview_no
                  AND intvc.status_interview_client_id = stlw.type_id
                  AND ap._cancel ='0'
                  AND ps.follow_up_by != ''
                  AND intvc._delete = '0'
                  AND intvc._active ='1'";
                  $query = $this->db->query($sql);
                  return $result = $query->result();

    }

    public function Interviewclient($id){
        $sql = "SELECT
                 ap.apply_lowongan_no,
                 ap.branch_id,
                 ap.lowongan_no,
                 l.type_lowongan_id,
                 tl._name as type_lowongan_name,
                 l._name as lowongan_name,
                 p._name as lowongan_posisi,
                 c._name, c._logo_enc_name,
                 ap.create_date as tanggal_lamar,
                 ap._cancel,
                 ap._cancel_reason,
                 ap.last_update,
                 pe._fullname,
                 pe.pelamar_no,
                 ps.psikotes_no,
                 sp._name as status_psikotes,
                 ps._analisa,
                 ps._score,
                 ps.create_date as tglPsikotes,
                 intv.interview_no,
                 stlw._name as status_interview_name,
                 intv._analisa_interview,
                 intv.status_interview_id,
                 intvc.status_interview_client_id,
                 intvc.interview_client_no,
                 intvc.last_update as tglInterviewClient,
                 intvc._analisa_interview as analisainterviewclient,
                 stp._name as selecStatusInterviewName
              FROM sys_type as stp,cms_tx_interview_client intvc,cms_tx_interview as intv,fe_tx_psikotes ps,fe_tx_apply_lowongan ap,fe_tm_pelamar_personal_info pe, cms_tm_lowongan l, sys_type sp, sys_type tl, cms_tm_client c, cms_tm_pekerjaan_branch pb, cms_tm_pekerjaan p, sys_type stlw
              WHERE
                ap.lowongan_no = l.lowongan_no
                AND l.pekerjaan_branch_no = pb.pekerjaan_branch_no
                AND pb.pekerjaan_id = p.pekerjaan_id
                AND l.client_id = c.client_id
                AND l.type_lowongan_id = tl.type_id
                AND ps.status_psikotes_id = sp.type_id
                AND pe.pelamar_no = ap.pelamar_no
                AND intv.psikotes_no = ps.psikotes_no
                AND ap.apply_lowongan_no = ps.apply_lowongan_no
                AND intv.psikotes_no = ps.psikotes_no
                AND intv.status_interview_id = stlw.type_id
                AND intvc.interview_no = intv.interview_no
                AND intvc.status_interview_client_id = stp.type_id
                AND ap.apply_lowongan_no = '{$id}'";
                $query = $this->db->query($sql);
                // echo $this->db->last_query();die;
                return $result = $query->row();

    }

    public function getApplyLowongan($id){
       $sql = "SELECT fe_tx_apply_lowongan.apply_lowongan_no as applyNo  FROM fe_tx_apply_lowongan,fe_tx_psikotes WHERE fe_tx_psikotes.apply_lowongan_no = fe_tx_apply_lowongan.apply_lowongan_no AND  fe_tx_psikotes.psikotes_no='$id'";
       $query = $this->db->query($sql);
       return $result = $query->row();

    }
    public function updateStatusApplyLowongan($status,$id){
      $userInfo = $_SESSION['userinfo'];
      $this->db->where('apply_lowongan_no',$id);
      $data  = array(
        'status_apply_lowongan_id'=>$status,
        'last_update'=>date('Y-m-d H:i:s'),
        'admin_last_update'=>date('Y-m-d H:i:s'),
        'admin_last_update'=>$userInfo->user_no
      );
      return $this->db->update('fe_tx_apply_lowongan',$data);
    }

}


?>
