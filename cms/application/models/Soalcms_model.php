<?php
class Soalcms_model extends CI_Model
{
    protected $_table = 'cms_tm_soal';
    function __construct()
    {
          parent::__construct();
          $this->load->database();
    }

		public function insertSoal($data) {
				  return $this->db->insert($this->_table, $data);
		}

    public function typeSoal(){
        $sql = "SELECT type_id, _name FROM sys_type WHERE category_id = '20' AND _active='1' AND _delete='0'";
        $query = $this->db->query($sql);
        return $result = $query->result();
    }

    public function position($branch_id){
        $sql = "SELECT _position FROM `cms_tm_soal` WHERE branch_id='{$branch_id}' AND _delete ='0' ORDER BY _position DESC";
        $query = $this->db->query($sql);
        return $result = $query->result();
    }
    public function listSoal(){
         $this->db->select('cms_tm_soal.*, sys_type._name as kategori_soal, sys_tm_branch._name as branchName,cms_tm_user._full_name');
         $this->db->from($this->_table);
         $where = array(
           'cms_tm_soal._delete'=>'0',
         );
         $this->db->where($where);
         $this->db->join('sys_type', 'sys_type.type_id=cms_tm_soal.category_soal_id');
         $this->db->join('sys_tm_branch', 'sys_tm_branch.branch_id=cms_tm_soal.branch_id');
         $this->db->join('cms_tm_user','cms_tm_user.user_no=cms_tm_soal.create_by');
         $this->db->order_by("cms_tm_soal.create_date", "desc");
         $query = $this->db->get();
         return $result = $query->result();

    }
		public function updateSoal($updateData,$roleID) {
				$this->db->where('soal_id', $roleID);
				$data = $this->db->update($this->_table, $updateData);
		}
    public function search($id){
       $query = "SELECT * from cms_tm_soal where soal_id='{$id}'";
       $result = $this->db->query($query);
       return $result->row();
    }

    public function hapus_soal($soalid)
    {

        $caridulu = "soal_id =" . "'" . $soalid . "'";
        $this->db->select('*');
        $this->db->from('cms_tm_soal');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {

            return "Data tidak valid.";
        } else {
            $data = array(
                '_active' => "0",
                '_delete' => "1"
            );

            $this->db->where('soal_id', $soalid);
            $this->db->update('cms_tm_soal', $data);
            return "Data berhasil dihapus.";
        }

    }

    public function set_active($no_key)
    {

        $caridulu = "cms_tm_soal.soal_id =" . "'" . $no_key . "' AND " . "cms_tm_soal._delete =" . "'0' AND " . "cms_tm_soal._active =" . "'0'";
        $this->db->select('*');
        $this->db->from('cms_tm_soal');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {

            return "Data tidak valid.";
        } else {
            $data = array(
                'cms_tm_soal._active' => "1",
                'cms_tm_soal._delete' => "0"
            );

            $this->db->where('cms_tm_soal.soal_id', $no_key);
            $this->db->update('cms_tm_soal', $data);
            return "Soal berhasil diaktifkan.";
        }

    }

    public function set_noactive($no_key)
    {

        $caridulu = "cms_tm_soal.soal_id =" . "'" . $no_key . "' AND " . "cms_tm_soal._delete =" . "'0' AND " . "cms_tm_soal._active =" . "'1'";
        $this->db->select('*');
        $this->db->from('cms_tm_soal');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {

            return "Data tidak valid.";
        } else {
            $data = array(
                'cms_tm_soal._active' => "0",
                'cms_tm_soal._delete' => "0"
            );

            $this->db->where('cms_tm_soal.soal_id', $no_key);
            $this->db->update('cms_tm_soal', $data);
            return "Soal berhasil dinonaktifkan.";
        }

    }

}


?>
