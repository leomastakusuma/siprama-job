<?php
class Pekerjaancms_model extends CI_Model
{
    protected $_table = 'cms_tm_pekerjaan';
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

		public function insertPekerjaan($data) {
				return $this->db->insert($this->_table, $data);
		}
    public function insertPekerjaanbranch($data) {
        return $this->db->insert("cms_tm_pekerjaan_branch", $data);
    }
    public function listPekerjaan(){
         $sql = "SELECT cms_tm_pekerjaan.*,p._name as parent_name,us._full_name
                    FROM cms_tm_pekerjaan
                      LEFT JOIN cms_tm_pekerjaan as p
                        ON p.pekerjaan_id = cms_tm_pekerjaan._parent_pekerjaan_id
                      JOIN cms_tm_user as us
                         ON us.user_no = cms_tm_pekerjaan.create_by
                         WHERE cms_tm_pekerjaan._delete='0'" ;
        $query = $this->db->query($sql);
        return $result = $query->result();

    }

    public function listPekerjaanBranch(){
        $sql ="SELECT tp.*, tb._name as branchname,us._full_name, tpb.pekerjaan_branch_no,tpb._active  as status FROM cms_tm_pekerjaan_branch as tpb
                JOIN cms_tm_pekerjaan as tp
                  ON tp.pekerjaan_id = tpb.pekerjaan_id
                    JOIN sys_tm_branch as tb
                      ON tb.branch_id = tpb.branch_id
                        JOIN cms_tm_user as us
                          ON us.user_no = tpb.create_by
                            WHERE tpb._delete = '0'";
        $query = $this->db->query($sql);

        return $result = $query->result();
    }

  	public function updatePekerjaan($updateData,$pekerjaanID) {
				$this->db->where('pekerjaan_id', $pekerjaanID);
				$data = $this->db->update($this->_table, $updateData);
		}

    public function updatePekerjaanbranch($updateData,$pekerjaanBranchID) {
        $this->db->where('pekerjaan_branch_no', $pekerjaanBranchID);
        $data = $this->db->update("cms_tm_pekerjaan_branch", $updateData);
    }

    public function searchpekerjaan($id){
       $query = "SELECT * from cms_tm_pekerjaan where pekerjaan_id='{$id}'";
       $result = $this->db->query($query);
       return $result->row();
    }

    public function searchpekerjaanbranch($id){
       $query = "SELECT * from cms_tm_pekerjaan_branch where pekerjaan_branch_no='{$id}'";
       $result = $this->db->query($query);
       return $result->row();
    }

    public function getPekerjaan(){
       $sql = "SELECT pekerjaan_id,_name FROM cms_tm_pekerjaan where _delete='0'";
       $query = $this->db->query($sql);
       return $query->result();
    }

    public function getPekerjaanbyBranch($branch_id){
       $sql = "SELECT cms_tm_pekerjaan.*,br.branch_id,tpb.pekerjaan_branch_no FROM cms_tm_pekerjaan
                  JOIN cms_tm_pekerjaan_branch as tpb
                  ON tpb.pekerjaan_id = cms_tm_pekerjaan.pekerjaan_id
                  JOIN sys_tm_branch as br
                  ON br.branch_id = tpb.branch_id
                  where br.branch_id ='$branch_id' AND cms_tm_pekerjaan._active='1'";
       $query = $this->db->query($sql);
       return $query->result();
    }

    public function getPekerjaanParent(){
       $sql = "SELECT pekerjaan_id,_name FROM cms_tm_pekerjaan where _delete='0' AND _parent_pekerjaan_id = 'NULL' ";
       $query = $this->db->query($sql);
       return $query->result();
    }

    public function hapus_pekerjaan($pekerjaan_id){
        $caridulu = "cms_tm_pekerjaan.pekerjaan_id =" . "'" . $pekerjaan_id . "'";
        $this->db->select('*');
        $this->db->from('cms_tm_pekerjaan');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {return "Data tidak valid.";}
        else {
            $data = array('_delete' => "1");
            $this->db->where('pekerjaan_id', $pekerjaan_id);
            $this->db->update('cms_tm_pekerjaan', $data);
            return "Data berhasil dihapus.";
        }

    }

    public function hapus_pekerjaanlangsungBranch($pekerjaan_id){
        $caridulu = "cms_tm_pekerjaan_branch.pekerjaan_id =" . "'" . $pekerjaan_id . "'";
        $this->db->select('*');
        $this->db->from('cms_tm_pekerjaan_branch');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {return "Data tidak valid.";}
        else {
            $data = array('_delete' => "1");
            $this->db->where('pekerjaan_id', $pekerjaan_id);
            $this->db->update('cms_tm_pekerjaan_branch', $data);
            return "Data berhasil dihapus.";
        }

    }

    public function set_active($no_key){
        $caridulu = "cms_tm_pekerjaan.pekerjaan_id =" . "'" . $no_key . "' AND " . "cms_tm_pekerjaan._delete =" . "'0' AND " . "cms_tm_pekerjaan._active =" . "'0'";
        $this->db->select('*');
        $this->db->from('cms_tm_pekerjaan');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {return "Data tidak valid.";}
        else {
            $data = array('cms_tm_pekerjaan._active' => "1",'cms_tm_pekerjaan._delete' => "0");
            $this->db->where('cms_tm_pekerjaan.pekerjaan_id', $no_key);
            $this->db->update('cms_tm_pekerjaan', $data);
            return "Pekerjaan berhasil diaktifkan.";
        }

    }

    public function set_noactive($no_key){
        $caridulu = "cms_tm_pekerjaan.pekerjaan_id =" . "'" . $no_key . "' AND " . "cms_tm_pekerjaan._delete =" . "'0' AND " . "cms_tm_pekerjaan._active =" . "'1'";
        $this->db->select('*');
        $this->db->from('cms_tm_pekerjaan');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {return "Data tidak valid.";}
        else {
            $data = array('cms_tm_pekerjaan._active' => "0",'cms_tm_pekerjaan._delete' => "0");
            $this->db->where('cms_tm_pekerjaan.pekerjaan_id', $no_key);
            $this->db->update('cms_tm_pekerjaan', $data);
            return "User berhasil dinonaktifkan.";
        }

    }

    public function hapus_pekerjaanbranch($pekerjaan_branch_no_id) {
        $caridulu = "cms_tm_pekerjaan_branch.pekerjaan_branch_no =" . "'" . $pekerjaan_branch_no_id . "'";
        $this->db->select('*');
        $this->db->from('cms_tm_pekerjaan_branch');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {return "Data tidak valid.";}
        else {
            $data = array('_delete' => "1");
            $this->db->where('pekerjaan_branch_no', $pekerjaan_branch_no_id);
            $this->db->update('cms_tm_pekerjaan_branch', $data);
            return "Data berhasil dihapus.";
        }

    }

    public function set_activebranch($no_key){
        $caridulu = "cms_tm_pekerjaan_branch.pekerjaan_branch_no =" . "'" . $no_key . "' AND " . "cms_tm_pekerjaan_branch._delete =" . "'0' AND " . "cms_tm_pekerjaan_branch._active =" . "'0'";
        $this->db->select('*');
        $this->db->from('cms_tm_pekerjaan_branch');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {return "Data tidak valid.";}
        else {
            $data = array('cms_tm_pekerjaan_branch._active' => "1",'cms_tm_pekerjaan_branch._delete' => "0");
            $this->db->where('cms_tm_pekerjaan_branch.pekerjaan_branch_no', $no_key);
            $this->db->update('cms_tm_pekerjaan_branch', $data);
            return "Pekerjaan Branch berhasil diaktifkan.";
        }

    }

    public function set_nonactivebranch($no_key){
        $caridulu = "cms_tm_pekerjaan_branch.pekerjaan_branch_no =" . "'" . $no_key . "' AND " . "cms_tm_pekerjaan_branch._delete =" . "'0' AND " . "cms_tm_pekerjaan_branch._active =" . "'1'";
        $this->db->select('*');
        $this->db->from('cms_tm_pekerjaan_branch');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {return "Data tidak valid.";}
        else {
            $data = array('cms_tm_pekerjaan_branch._active' => "0",'cms_tm_pekerjaan_branch._delete' => "0");
            $this->db->where('cms_tm_pekerjaan_branch.pekerjaan_branch_no', $no_key);
            $this->db->update('cms_tm_pekerjaan_branch', $data);
            return "User berhasil dinonaktifkan.";
        }

    }

    public function insertPekerjaanToBranch(){
      $sql ="  INSERT INTO cms_tm_pekerjaan_branch (
                 pekerjaan_branch_no
                ,branch_id
                ,pekerjaan_id
                ,create_date
                ,create_by
              ) SELECT
                    '$articleHis'
                    ,article_imagegallery_no
                    ,article_imagegallery_temp_no
                    ,article_no
                    ,type_attachment_id
                    ,type_img_ratio_id
                    ,_real_name
                    ,_enc_name
                    ,_url
                    ,_caption
                    ,_position
                    ,now()
                    ,'$userNo' AS create_by
                FROM cms_tm_article_imagegallery
                WHERE article_no = '$articleNO'
                AND _delete = '0'";
      $query = $this->db->query($sql);
      return $query;
    }



}


?>
