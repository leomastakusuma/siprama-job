<?php
class Lowongancms_model extends CI_Model
{
    protected $_table = 'cms_tm_lowongan';
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function selectCount(){
        $start = date('Y-m-d');
        $end = date('Y-m-d');
        $sql = "SELECT COUNT(lowongan_no) as totalLowongan FROM `cms_tm_lowongan`
        WHERE DATE_FORMAT(cms_tm_lowongan._date_from, '%Y-%m-%d') <= STR_TO_DATE('$start', '%Y-%m-%d')
        AND DATE_FORMAT(cms_tm_lowongan._date_thru, '%Y-%m-%d') >= STR_TO_DATE('$end', '%Y-%m-%d')
        AND cms_tm_lowongan._active = '1'
        AND cms_tm_lowongan._delete = '0'
        ";
        $query = $this->db->query($sql);
        return $result = $query->row();
    }

		public function insertLowongan($data) {
				return $this->db->insert($this->_table, $data);
		}

    public function homeslider(){
      $sql = "SELECT cms_tm_fe_homeslider.* ,cms_tm_multimediabank.* FROM cms_tm_multimediabank, cms_tm_fe_homeslider
              where cms_tm_multimediabank.multimediabank_no= cms_tm_fe_homeslider.multimediabank_no
              AND cms_tm_multimediabank._delete='0'";
      $query = $this->db->query($sql);
      return $result = $query->result();
    }

    public function insertApplyLowongan($data){
        return $this->db->insert('fe_tx_apply_lowongan', $data);
    }

    public function updateApplyLowongan($data,$id){
        $this->db->where('apply_lowongan_no', $id);
        $data = $this->db->update('fe_tx_apply_lowongan', $data);
    }


    public function listLowonganPromoted(){
         $start = date('Y-m-d');
         $end = date('Y-m-d');
         $sql   = "SELECT cms_tm_lowongan_promoted._cover_url,cms_tm_lowongan_promoted._cover_enc_name,cms_tm_lowongan_promoted._position ,  cms_tm_lowongan.lowongan_no, cms_tm_lowongan._name
                      FROM cms_tm_lowongan_promoted
                           JOIN  cms_tm_lowongan  on cms_tm_lowongan.lowongan_no = cms_tm_lowongan_promoted.lowongan_no
                           WHERE DATE_FORMAT(cms_tm_lowongan_promoted._date_from, '%Y-%m-%d') <= STR_TO_DATE('$start', '%Y-%m-%d')
                           AND DATE_FORMAT(cms_tm_lowongan_promoted._date_thru, '%Y-%m-%d') >= STR_TO_DATE('$end', '%Y-%m-%d')
                           AND cms_tm_lowongan._active = '1'
                           ORDER BY cms_tm_lowongan_promoted._position ASC";
         $query = $this->db->query($sql);
         return $result = $query->result();

    }


    public function listLowonganbyID($id){
        // $this->db->select('cms_tm_lowongan.*,sys_type._name as type_lowongan,tp._name as pekerjaanName, sys_tm_branch._name as branchname,cms_tm_client._name as clientname, cms_tm_client._logo_url,ap.create_date as dateloker , ap.apply_lowongan_no , typ._name as statusLamaran');
        // $this->db->from('cms_tm_lowongan');
        // $this->db->join('fe_tx_apply_lowongan','fe_tx_apply_lowongan.lowongan_no=cms_tm_lowongan.lowongan_no');
        // $this->db->join('sys_type','sys_type.type_id=cms_tm_lowongan.type_lowongan_id');
        // $this->db->join('cms_tm_pekerjaan_branch as tpb','tpb.pekerjaan_branch_no = cms_tm_lowongan.pekerjaan_branch_no');
        // $this->db->join('cms_tm_pekerjaan as tp','tp.pekerjaan_id = tpb.pekerjaan_id');
        // $this->db->join('sys_tm_branch','sys_tm_branch.branch_id = cms_tm_lowongan.branch_id');
        // $this->db->join('cms_tm_client','cms_tm_client.client_id = cms_tm_lowongan.client_id');
        // $this->db->join('fe_tx_apply_lowongan as ap','fe_tx_apply_lowongan.lowongan_no = cms_tm_lowongan.lowongan_no');
        // $this->db->join('sys_type as typ','typ.type_id=ap.status_apply_lowongan_id');
        //
        // // $this->db->join('')
        // $this->db->where('fe_tx_apply_lowongan.pelamar_no',$id);
        // $query = $this->db->get();
        // return $result = $query->result();

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
                 ap.last_update
              FROM fe_tx_psikotes as ps,fe_tx_apply_lowongan ap, cms_tm_lowongan l, sys_type tl, cms_tm_client c, cms_tm_pekerjaan_branch pb, cms_tm_pekerjaan p, sys_type stlw
              WHERE
                ap.lowongan_no = l.lowongan_no
                AND l.pekerjaan_branch_no = pb.pekerjaan_branch_no
                AND pb.pekerjaan_id = p.pekerjaan_id
                AND l.client_id = c.client_id
                AND ap.status_apply_lowongan_id = stlw.type_id
                AND l.type_lowongan_id = tl.type_id
                AND ps.apply_lowongan_no = ap.apply_lowongan_no
                AND ap.pelamar_no = '{$id}'
                  AND ap._cancel ='0'";
                  $query = $this->db->query($sql);
                  return $result = $query->result();

    }



    public function searchApplyLowongan($id,$userno){
       $this->db->select('*');
       $this->db->from('fe_tx_apply_lowongan');
       $this->db->join('fe_tx_psikotes','fe_tx_psikotes.apply_lowongan_no=fe_tx_apply_lowongan.apply_lowongan_no');
       $this->db->where(array('lowongan_no'=>$id,'pelamar_no'=>$userno));
       $query = $this->db->get();
       return $result = $query->result();
    }

    public function record_count() {
         return $this->db->count_all("cms_tm_lowongan");
    }
    public function listLowongan($offset = null){
      $this->db->select("cms_tm_lowongan.lowongan_no,
        cms_tm_lowongan.create_date,
        cms_tm_lowongan._date_from,
        cms_tm_lowongan._name,
        cms_tm_lowongan._date_thru,
        cms_tm_client._logo_enc_name,
        cms_tm_client._name as clientname,
        cms_tm_location._name as locname,
        sys_type._name as type_lowongan");
      $this->db->from($this->_table);
      $p_period_start = date('Y-m-d');

      $this->db->join("cms_tm_pekerjaan_branch","cms_tm_pekerjaan_branch.pekerjaan_branch_no = cms_tm_lowongan.pekerjaan_branch_no");
      $this->db->join("cms_tm_pekerjaan","cms_tm_pekerjaan.pekerjaan_id = cms_tm_pekerjaan_branch.pekerjaan_id");
      $this->db->join("cms_tm_client","cms_tm_client.client_id = cms_tm_lowongan.client_id");
      $this->db->join("sys_type","sys_type.type_id = cms_tm_lowongan.type_lowongan_id ");
      $this->db->join("cms_tm_location","cms_tm_location.location_no = cms_tm_lowongan.location_no");

      $this->db->where("DATE_FORMAT(cms_tm_lowongan._date_from, '%Y-%m-%d') <=","$p_period_start");
      $this->db->where("DATE_FORMAT(cms_tm_lowongan._date_thru, '%Y-%m-%d') >=","$p_period_start");
      $this->db->where("cms_tm_lowongan._delete",'0');
      $this->db->where("cms_tm_lowongan._active",'1');

      $lmt = 5;
      $oft = 0;
      if($offset){
        $oft = $offset;
      }
      $this->db->limit($lmt,$oft);
      // $this->db->limit(3,0);

      $this->db->order_by("cms_tm_lowongan.create_date", "desc");
      $query = $this->db->get();
      // echo $this->db->last_query();die;
      return $result = $query->result();
    }

    public function detailLowongan($lowonganID = null){
      $this->db->select('cms_tm_lowongan.*,sys_type._name as type_lowongan,tp._name as pekerjaanName, sys_tm_branch._name as branchname,cms_tm_client._desc as clientdesc,cms_tm_client._name as clientname, cms_tm_client._logo_url,cms_tm_location._name as locname');
      $this->db->from($this->_table);
      if(!empty($lowonganID)){
        $where = array(
            'cms_tm_lowongan._delete'=>'0',
            'lowongan_no'=>$lowonganID
        );
      }else{
        $where = array(
          'cms_tm_lowongan._delete'=>'0',
        );
      }

      $this->db->join('sys_type','sys_type.type_id=cms_tm_lowongan.type_lowongan_id');
      $this->db->join('cms_tm_pekerjaan_branch as tpb','tpb.pekerjaan_branch_no = cms_tm_lowongan.pekerjaan_branch_no');
      $this->db->join('cms_tm_pekerjaan as tp','tp.pekerjaan_id = tpb.pekerjaan_id');
      $this->db->join('sys_tm_branch','sys_tm_branch.branch_id = cms_tm_lowongan.branch_id');
      $this->db->join('cms_tm_client','cms_tm_client.client_id = cms_tm_lowongan.client_id');
      $this->db->join("cms_tm_location","cms_tm_location.location_no = cms_tm_lowongan.location_no");
      $this->db->where($where);
      $this->db->order_by("cms_tm_lowongan.create_date", "desc");
      $query = $this->db->get();
      return $result = $query->row();
    }

    public function searchLowongan($lowonganNO) {
        $this->db->select('*');
        $this->db->from('cms_tm_lowongan');
        $this->db->where('cms_tm_lowongan.lowongan_no', $lowonganNO);
        $query = $this->db->get();
        return $result = $query->row_array();
    }
		public function updateLowongan($updateData,$lowonganNO) {
				$this->db->where('lowongan_no', $lowonganNO);
				$data = $this->db->update($this->_table, $updateData);
		}
    public function search($id){
       $query = "SELECT * from cms_tm_lowongan where lowongan_no = '{$id}'";
       $result = $this->db->query($query);
       return $result->row_array();
    }

    public function ambil_data()
    {
        $kondisi = array(
            "cms_tm_lowongan._delete"=>"0",
        );

        $this->db->select('*');
        $this->db->from('cms_tm_lowongan');
        $this->db->order_by('cms_tm_lowongan.create_date');
        $this->db->where($kondisi);
        $query = $this->db->get();
        return $result = $query->result();

    }

    public function set_active($lowonganNO)
    {

        $caridulu = "lowongan_no  =" . "'" . $lowonganNO . "' AND " . "_delete =" . "'0' AND " . "_active =" . "'0'";
        $this->db->select('*');
        $this->db->from('cms_tm_lowongan');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {

            return "Data tidak valid.";
        } else {
            $data = array(
                '_active' => "1",
                '_delete' => "0"
            );

            $this->db->where('lowongan_no ', $lowonganNO);
            $this->db->update('cms_tm_lowongan', $data);
            return "Lowongan berhasil diaktifkan.";
        }

    }

    public function set_noactive($lowonganNO)
    {

        $caridulu = "lowongan_no  =" . "'" . $lowonganNO . "' AND " . "_delete =" . "'0' AND " . "_active =" . "'1'";
        $this->db->select('*');
        $this->db->from('cms_tm_lowongan');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {
            return "Data tidak valid 3.";
        } else {
            $data = array(
                '_active' => "0",
                '_delete' => "0"
            );

            $this->db->where('lowongan_no ', $lowonganNO);
            $this->db->update('cms_tm_lowongan', $data);
            return "Lowongan berhasil dinonaktifkan.";
        }

    }

    public function hapus_Lowongan($lowonganNO)
    {

        $caridulu = "lowongan_no  =" . "'" . $lowonganNO . "' AND " . "_delete =" . "'0'";
        $this->db->select('*');
        $this->db->from('cms_tm_lowongan');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {

            return $no_brand;
        } else {
            $data = array(
                '_active' => "0",
                '_delete' => "1"
            );

            $this->db->where('lowongan_no ', $lowonganNO);
            $this->db->update('cms_tm_lowongan', $data);
            return "Data berhasil dihapus.";
        }

    }

}


?>
