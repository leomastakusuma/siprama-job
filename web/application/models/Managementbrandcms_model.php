<?php
class Managementbrandcms_model extends CI_Model
{
    protected $_table = 'sys_tm_branch';
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function select($data)
    {   if($data){
          $this->db->select($data);
        }
        else {
          $this->db->select('*');
        }
        $this->db->where("_delete", "0");
        $query = $this->db->get($this->_table);

        return $query->result_array();
    }

    function selectBranch()
    {
        $this->db->select('*');
        $this->db->where(array(
            '_delete' => "0",
            '_active' => '1'
        ));
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    function selectsubChannel($parentchannelno)
    {
        $this->db->select('channel_no,_name');
        $this->db->where(array(
            '_delete' => "0",
            "_parent_channel_no" => $parentchannelno
        ));
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }

    function checkslug($data)
    {
        $this->db->select('slug');
        $this->db->where('slug', $data);
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }

    public function insertBranch($data) {
        return $this->db->insert($this->_table, $data);
    }

    public function insertBranchRole($data) {
        return $this->db->insert("sys_tm_branch_role", $data);
    }

    public function checkBrancRoleId($branch,$role){
       $this->db->select('*');
       $this->db->from('sys_tm_branch_role');
       $where = array(
         'branch_id'=>$branch,
         'role_id'=>$role,
         '_delete'=>'0',
       );
       $this->db->where($where);
       $this->db->limit(1);
       $query = $this->db->get();
       if ($query->num_rows() > 0) {
           $response['msg'] = "Branch Role Telah tersedia, Branch Role Tidak Dapat Disimpan";
           $response['status'] = "0";
           return $response;
       }else{
           $response['msg'] = "Branch Role Belum tersedia, Branch Role Dapat Disimpan";
           $response['status'] = "1";
           return $response;
       }

    }
    public function updateBranch($updateData,$IDBranch) {
      $this->db->where('branch_id', $IDBranch);
      $data = $this->db->update($this->_table, $updateData);
    }

    public function searchBranch($branchID) {
        $this->db->select('sys_tm_branch.*,sys_tm_corporate._name as corporatename');
        $this->db->from('sys_tm_branch');
        $this->db->join('sys_tm_corporate','sys_tm_corporate.corporate_id = sys_tm_branch.corporate_id');
        $this->db->where('sys_tm_branch.branch_id', $branchID);
        $query = $this->db->get();
        return $result = $query->row_array();
    }

    public function searchBranchRole($branchID) {
        $this->db->select('sys_tm_role.*,sys_tm_branch_role.branch_role_id');
        $this->db->from('sys_tm_role');
        $this->db->join('sys_tm_branch_role','sys_tm_branch_role.role_id = sys_tm_role.role_id');
        $this->db->join('sys_tm_branch','sys_tm_branch.branch_id = sys_tm_branch_role.branch_id');
        $where = array(
          'sys_tm_role._active'=>'1',
          'sys_tm_role._delete'=>'0',
          'sys_tm_branch.branch_id'=>$branchID
        );
        $this->db->where($where);
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function set_active($no_brand)
    {

        $caridulu = "branch_id  =" . "'" . $no_brand . "' AND " . "_delete =" . "'0' AND " . "_active =" . "'0'";
        $this->db->select('*');
        $this->db->from('sys_tm_branch');
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

            $this->db->where('branch_id ', $no_brand);
            $this->db->update('sys_tm_branch', $data);
            return "Brand berhasil diaktifkan.";
        }

    }

    public function set_noactive($no_brand)
    {

        $caridulu = "branch_id  =" . "'" . $no_brand . "' AND " . "_delete =" . "'0' AND " . "_active =" . "'1'";
        $this->db->select('*');
        $this->db->from('sys_tm_branch');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {

            return "Data tidak valid.";
        } else {
            $data = array(
                '_active' => "0",
                '_delete' => "0"
            );

            $this->db->where('branch_id ', $no_brand);
            $this->db->update('sys_tm_branch', $data);
            return "Brand berhasil dinonaktifkan.";
        }

    }

    public function set_activerole($no_brand)
    {

        $caridulu = "branch_role_id  =" . "'" . $no_brand . "' AND " . "_delete =" . "'0' AND " . "_active =" . "'0'";
        $this->db->select('*');
        $this->db->from('sys_tm_branch_role');
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

            $this->db->where('branch_role_id ', $no_brand);
            $this->db->update('sys_tm_branch_role', $data);
            return "Brand Role ID berhasil diaktifkan.";
        }

    }

    public function set_noactiverole($no_brand)
    {

        $caridulu = "branch_role_id  =" . "'" . $no_brand . "' AND " . "_delete =" . "'0' AND " . "_active =" . "'1'";
        $this->db->select('*');
        $this->db->from('sys_tm_branch_role');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {

            return "Data tidak valid.";
        } else {
            $data = array(
                '_active' => "0",
                '_delete' => "0"
            );

            $this->db->where('branch_role_id ', $no_brand);
            $this->db->update('sys_tm_branch_role', $data);
            return "Brand Role ID berhasil dinonaktifkan.";
        }

    }

    public function simpan_brand($p_address, $p_phone, $p_fax, $p_name, $p_website)
    {
        $userinfo = $this->session->userdata("userinfo");
        $caridulu = "_name =" . "'" . $p_name . "' AND " . "_delete =" . "'0' AND " . "_active =" . "'1'";
        $this->db->select('*');
        $this->db->from('sys_tm_branch');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {
            $sql      = "SELECT nextseq('sys_tm_branch','') AS seq_cms_article_share FROM DUAL";
            $query    = $this->db->query($sql);
            $row      = $query->row_array();
            $branch_id  = $row['seq_cms_article_share'];

            $databrand = array(
                'branch_id ' => $branch_id ,
                '_name' => $p_name,
                '_address' => $p_address,
                '_website' => $p_website,
                '_phone' => $p_phone,
                '_fax' => $p_fax,
                '_active' => '1',
                '_delete' => '0',
                'create_date' => date("Y-m-d H:i:s"),
                'create_by' => $userinfo->user_no
            );
            $simpan    = $this->db->insert('sys_tm_branch', $databrand);

            if ($simpan) {
                return "Berhasil disimpan.";
            } else {
                return "Gagal disimpan.";
            }
        } else {
            return "Duplikat";
        }


    }

    public function ambil_data($advertorial = false)
    {
        if($advertorial){
          $kondisi = array(
              "sys_tm_branch._delete"=>"0",
              "sys_tm_branch._active"=>"1"
          );
        }else{
          $kondisi = "sys_tm_branch._delete =" . "'0'";
        }
        $this->db->select('sys_tm_branch.*,sys_tm_corporate._name as cpname');
        $this->db->from('sys_tm_branch');
        $this->db->join('sys_tm_corporate','sys_tm_corporate.corporate_id = sys_tm_branch.corporate_id');
        $this->db->order_by('sys_tm_branch.create_date');
        $this->db->where($kondisi);
        $query = $this->db->get();
        return $result = $query->result();

    }

    public function ambil_edit_data($keyno)
    {

        $kondisi = "branch_id  =" . "'" . $keyno . "' AND " . "_delete =" . "'0' AND " . "_active =" . "'1'";
        $this->db->select('*');
        $this->db->from('sys_tm_branch');
        $this->db->where($kondisi);
        $query = $this->db->get();
        return $result = $query->result();


    }

    public function hapus_brand($no_brand)
    {

        $caridulu = "branch_id  =" . "'" . $no_brand . "' AND " . "_delete =" . "'0'";
        $this->db->select('*');
        $this->db->from('sys_tm_branch');
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

            $this->db->where('branch_id ', $no_brand);
            $this->db->update('sys_tm_branch', $data);
            return "Data berhasil dihapus.";
        }

    }


    public function hapus_brandrole($no_brand)
    {

        $caridulu = "branch_role_id  =" . "'" . $no_brand . "' AND " . "_delete =" . "'0'";
        $this->db->select('*');
        $this->db->from('sys_tm_branch_role');
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

            $this->db->where('branch_role_id ', $no_brand);
            $this->db->update('sys_tm_branch_role', $data);
            return "Data berhasil dihapus.";
        }

    }

    public function ambil_update_data($keyno)
    {

        $kondisi = "keyword_no =" . "'" . $keyno . "' AND " . "_delete =" . "'0' AND " . "_active =" . "'1'";
        $this->db->select('*');
        $this->db->from('cms_tm_keyword');
        $this->db->where($kondisi);
        $query = $this->db->get();
        return $result = $query->result();


    }



}
