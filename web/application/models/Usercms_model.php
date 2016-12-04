<?php
class Usercms_model extends CI_Model
{
    protected $_table = 'cms_tm_user';
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getUserLever(){
        $query = $this->db->query("SELECT * FROM sys_type where _active = '1' AND _delete = '0' AND category_id ='8'");
        return $query->result_array();
    }


    public function Ambil_level_id()
    {
        $query = $this->db->query("SELECT * FROM cms_tm_user_level WHERE user_level_id > 'LVL001' ");


        return $query->result();
    }

    public function Ambil_channel_id()
    {
        $query = $this->db->query('SELECT * FROM cms_tm_channel');


        return $query->result();
    }

    public function simpan_user($datauser)
    {
        $userinfo = $this->session->userdata("userinfo");
        $caridulu = "_delete = '0' AND (_id=" . "'" . $datauser['_id'] . "' OR " . "_initial_name =" . "'" . $datauser['_initial_name'] . "')";
        $this->db->select('*');
        $this->db->from('cms_tm_user');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {
            $simpan   = $this->db->insert('cms_tm_user', $datauser);
            if ($simpan) {
                return "Berhasil simpan user.";
            } else {
                return "Gagal simpan user.";
            }
        } else {
            return "Gagal simpan user. User sudah ada, atau inisial sudah digunakan.";
        }


    }


    public function ambil_data()
    {
        $sql = "SELECT
                  u.user_no as nomor,
                  u.user_level_id, l._name as level_name,
                  u._id,
                  u._email,
                  u._full_name,
                  u._initial_name,
                  u._active,
                  u._delete,
                  u.create_date,
                  u.create_by, u2._full_name as create_by_full_name
                FROM cms_tm_user u, cms_tm_user u2, sys_type l, sys_tm_branch b
                WHERE
                  u.create_by = u2.user_no
                  AND u.user_level_id = l.type_id
                  AND u._delete = '0'
                 AND b.branch_id = '".branchID."' ";
    		$jalankan = $this->db->query($sql);
        return $result = $jalankan->result();

    }

    public function ambil_edit_data($user_no)
    {

        $kondisi = "user_no =" . "'" . $user_no . "' AND " . "_delete =" . "'0'";
        $this->db->select('*');
        $this->db->from('cms_tm_user');
        $this->db->where($kondisi);
        $query = $this->db->get();
        return $result = $query->result();


    }

    function updateuser($updateuser, $p_user_no)
    {
		    $userinfo = $this->session->userdata("userinfo");
        $caridulu = "_delete = '0' AND (_id=" . "'" . $updateuser['_id'] . "' OR " . "_initial_name =" . "'" . $updateuser['_initial_name'] . "')";
        $this->db->select('*');
        $this->db->from('cms_tm_user');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        $row_caridulu_data = $query->row_array();

        $run_update = $query->num_rows() < 1 ? "1" : "0";

        // ambil data user
        $sql = "SELECT _id, _initial_name
                FROM cms_tm_user
                WHERE user_no = '$p_user_no' ";
        $query = $this->db->query($sql);
        $row_data2 = $query->row_array();
        $current_username = $row_data2['_id'];
        $current_initial = $row_data2['_initial_name'];

        // jika tidak merubah initial atau username
        if ($current_username==$row_caridulu_data['_id'] && $current_initial==$row_caridulu_data['_initial_name'])
        {
            $run_update = "1";
        }
        else
        {
            $run_update = "0";
        }

        if ($run_update=="1") {

            $this->db->where('user_no', $p_user_no);
            $result = $this->db->update('cms_tm_user', $updateuser);
    	   if($result)
    	   {
                return "1";
    		  // return "Data berhasil diupdate.";
    	   }
    	   else
		    {
                return "2";
    		  // return "Data gagal diupdate.";
    	   }
        }
		 else {
            return "3";
            // return "Gagal update user. User sudah ada, atau inisial sudah digunakan.";
        }
    }

    public function hapus_user($no_user)
    {

        $caridulu = "user_no =" . "'" . $no_user . "'";
        $this->db->select('*');
        $this->db->from('cms_tm_user');
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

            $this->db->where('user_no', $no_user);
            $this->db->update('cms_tm_user', $data);
            return "Data berhasil dihapus.";
        }

    }

     public function reset_pass($no_key,$pass)
    {

        $caridulu = "cms_tm_user.user_no =" . "'" . $no_key . "' AND " . "cms_tm_user._delete =" . "'0' AND " . "cms_tm_user._active =" . "'1'";
        $this->db->select('*');
        $this->db->from('cms_tm_user');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {

            return "Data tidak valid.";
        } else {
            $data = array(
                'cms_tm_user._password' => encText($pass),
            );

            $this->db->where('cms_tm_user.user_no', $no_key);
            $this->db->update('cms_tm_user', $data);
            return $pass;
        }

    }

    public function set_active($no_key)
    {

        $caridulu = "cms_tm_user.user_no =" . "'" . $no_key . "' AND " . "cms_tm_user._delete =" . "'0' AND " . "cms_tm_user._active =" . "'0'";
        $this->db->select('*');
        $this->db->from('cms_tm_user');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {

            return "Data tidak valid.";
        } else {
            $data = array(
                'cms_tm_user._active' => "1",
                'cms_tm_user._delete' => "0"
            );

            $this->db->where('cms_tm_user.user_no', $no_key);
            $this->db->update('cms_tm_user', $data);
            return "User berhasil diaktifkan.";
        }

    }

    public function set_noactive($no_key)
    {

        $caridulu = "cms_tm_user.user_no =" . "'" . $no_key . "' AND " . "cms_tm_user._delete =" . "'0' AND " . "cms_tm_user._active =" . "'1'";
        $this->db->select('*');
        $this->db->from('cms_tm_user');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {

            return "Data tidak valid.";
        } else {
            $data = array(
                'cms_tm_user._active' => "0",
                'cms_tm_user._delete' => "0"
            );

            $this->db->where('cms_tm_user.user_no', $no_key);
            $this->db->update('cms_tm_user', $data);
            return "User berhasil dinonaktifkan.";
        }

    }

    public function searchUser($userNo){
        $this->db->select('*');
        $this->db->from('cms_tm_user');
        $where = array(
          'user_no'=>$userNo
        );
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row_array();

    }

}


?>
