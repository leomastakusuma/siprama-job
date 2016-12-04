<?php
class Lowongancms_model extends CI_Model
{
    protected $_table = 'cms_tm_lowongan';
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

		public function insertLowongan($data) {
				return $this->db->insert($this->_table, $data);
		}

    public function listlowonganPromote(){
       $start = date('Y-m-d');
       $end = date('Y-m-d');
       $sql   = "SELECT cms_tm_lowongan.lowongan_no, cms_tm_lowongan._name
                            FROM cms_tm_lowongan where cms_tm_lowongan._active ='1'
                                AND DATE_FORMAT(_date_from, '%Y-%m-%d') <= STR_TO_DATE('$start', '%Y-%m-%d')
		                             AND DATE_FORMAT(_date_thru, '%Y-%m-%d') >= STR_TO_DATE('$end', '%Y-%m-%d')";
       $query = $this->db->query($sql);
       return $result = $query->result();
    }

    public function promotedLowonganList(){
       $sql   = "SELECT cms_tm_lowongan_promoted.*,  cms_tm_lowongan.lowongan_no, cms_tm_lowongan._name
                    FROM cms_tm_lowongan_promoted
                        LEFT JOIN  cms_tm_lowongan  on cms_tm_lowongan.lowongan_no = cms_tm_lowongan_promoted.lowongan_no
                         ORDER BY cms_tm_lowongan_promoted._position ASC";
       $query = $this->db->query($sql);
       return $result = $query->result();
    }


    public function udateLowonganPromoted($data,$id){
      $this->db->where('lowongan_promoted_no', $id);
      return $this->db->update('cms_tm_lowongan_promoted', $data);
    }

    public function udateLowonganPromotedall($data){
      return $this->db->update('cms_tm_lowongan_promoted', $data);
    }

    public function listLowongan(){
      $this->db->select('cms_tm_lowongan.*,sys_type._name as type_lowongan,tp._name as pekerjaanName, sys_tm_branch._name as branchname,cms_tm_client._name as clientname');
      $this->db->from($this->_table);
      $where = array(
        'cms_tm_lowongan._delete'=>'0',
      );

      $this->db->join('sys_type','sys_type.type_id=cms_tm_lowongan.type_lowongan_id');
      $this->db->join('cms_tm_pekerjaan_branch as tpb','tpb.pekerjaan_branch_no = cms_tm_lowongan.pekerjaan_branch_no');
      $this->db->join('cms_tm_pekerjaan as tp','tp.pekerjaan_id = tpb.pekerjaan_id');
      $this->db->join('sys_tm_branch','sys_tm_branch.branch_id = cms_tm_lowongan.branch_id');
      $this->db->join('cms_tm_client','cms_tm_client.client_id = cms_tm_lowongan.client_id');
      $this->db->where($where);
      $this->db->order_by("cms_tm_lowongan.create_date", "desc");
      $query = $this->db->get();
      return $result = $query->result();
    }

    public function searchLowongan($lowonganNO) {
        $this->db->select('*');
        $this->db->from('cms_tm_lowongan');
        $this->db->where('cms_tm_lowongan.lowongan_no', $lowonganNO);
        $query = $this->db->get();
        return $result = $query->row_array();
    }

    public function searchLowonganPromote($lowonganNO) {
        $this->db->select('cms_tm_lowongan_promoted.*,cms_tm_lowongan._date_from as start, cms_tm_lowongan._date_thru as end');
        $this->db->from('cms_tm_lowongan_promoted');
        $this->db->join('cms_tm_lowongan','cms_tm_lowongan.lowongan_no=cms_tm_lowongan_promoted.lowongan_no','left');
        $this->db->where('cms_tm_lowongan_promoted.lowongan_promoted_no', $lowonganNO);
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

    public function ambil_data(){
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

    public function set_active($lowonganNO){

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

    public function set_noactive($lowonganNO){

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

    public function hapus_Lowongan($lowonganNO){

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


    function select_lowongan_promoted_by_id($id) {
        $sql = "SELECT a._position
                FROM cms_tm_lowongan_promoted a
                WHERE lowongan_promoted_no ='$id'";
        $query = $this->db->query($sql);
        $row = $query->result_array();
        return $row;
    }

    function update_position_lowonganpromote($id, $data) {
        $this->db->where('lowongan_promoted_no', $id);
        return $this->db->update('cms_tm_lowongan_promoted', $data);
    }

    function update_position_lowonganpromotesame($id,$position, $data) {
        $where = array(
          'lowongan_promoted_no !=' =>$id,
          '_position' =>$position
        );
        $this->db->where($where);
        return $this->db->update('cms_tm_lowongan_promoted', $data);
    }

    function check_position_lowonganpromote($position,$id) {
      $sql = "SELECT a._position,
              a.lowongan_promoted_no
              FROM cms_tm_lowongan_promoted a
              WHERE a._position ='$position' AND lowongan_promoted_no ='$id'";
      $query = $this->db->query($sql);
      return $query->result_array();
  }

  public function laporanpelamarmasuk($start,$end){
     $sql ="SELECT fe_tm_pelamar_personal_info._fullname,
        		sys_type._name as pendidikan,
        		fe_tm_pelamar_personal_info._phone_primary,
                cms_tm_lowongan._name as lowonganName,
                fe_tx_apply_lowongan.create_date as tanggalDibuat,
                fe_tm_pelamar_personal_info._address_ktp


                FROM
              fe_tm_pelamar_personal_info, cms_tm_lowongan , fe_tx_apply_lowongan,fe_tm_pelamar,sys_type
              WHERE
              	fe_tm_pelamar_personal_info.pelamar_no = fe_tm_pelamar.pelamar_no
                AND cms_tm_lowongan.lowongan_no = fe_tx_apply_lowongan.lowongan_no
              	AND fe_tm_pelamar.pelamar_no = fe_tx_apply_lowongan.pelamar_no
                AND fe_tm_pelamar_personal_info.pendidikan_id = sys_type.type_id
                AND fe_tx_apply_lowongan.create_date >='$start'
                AND fe_tx_apply_lowongan.create_date <='$end'
                ";
        $query = $this->db->query($sql);
        return $query->result();
  }

  public function laporanlowongan($start,$end){
     $sql ="SELECT cms_tm_lowongan._name, cms_tm_client._name as klien, cms_tm_pekerjaan._name as pekerjaanname , cms_tm_lowongan._date_from,cms_tm_lowongan._date_thru
               FROM
               	cms_tm_lowongan,cms_tm_pekerjaan,cms_tm_pekerjaan_branch,cms_tm_client
               WHERE
              	cms_tm_lowongan.pekerjaan_branch_no = cms_tm_pekerjaan_branch.pekerjaan_branch_no
              	AND cms_tm_pekerjaan.pekerjaan_id = cms_tm_pekerjaan_branch.pekerjaan_id
                  AND cms_tm_lowongan.client_id = cms_tm_client.client_id
                AND cms_tm_lowongan.create_date >='$start'
                AND cms_tm_lowongan.create_date <='$end'
                ";
        $query = $this->db->query($sql);
        return $query->result();
  }

  public function insertPromote($data){
    return $this->db->insert('cms_tm_lowongan_promoted', $data);
  }
  function insertWhenEmpty(){
     $sql = "SELECT * FROM `cms_tm_lowongan_promoted`";
     $query = $this->db->query($sql);
     $result = $query->result();
     if(empty($result)){
         for($i=1;$i<=4;$i++){
            $sql = "SELECT nextseq('cms_tm_lowongan_promoted','') as nextval FROM DUAL";
            $query = $this->db->query($sql);
            $IDpromote = $query->row_array();
            $data = array(
               'lowongan_promoted_no'=>$IDpromote['nextval'],
                'branch_id'=>branchID,
                'lowongan_no'=>NULL,
                '_cover_real_name'=>'',
                '_cover_enc_name'=>'',
                '_cover_url'=>'',
                '_position'=>$i,
                'create_date'=>date('Y-m-d H:i:s'),
                'create_by'=>$_SESSION['userinfo']->user_no
           );
           $this->insertPromote($data);
         }
     }
  }
}


?>
