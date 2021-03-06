<?php

Class Logincms_model extends CI_Model {

    protected $_table = 'fe_tm_pelamar';

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function login($email, $pass) {
        $condition = "_email =" . "'" . strtoupper($email) . "'
					 AND " . "_password =" . "'" .trim($pass," "). "'
					 AND _active = '1'
					 AND _delete = '0'";
        $this->db->select('*');
        $this->db->from('fe_tm_pelamar');
        $this->db->where($condition);
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function userInfo($user, $pass) {
        $condition = "_email =" . "'" . strtoupper($user) . "'
					 AND " . "_password =" . "'" . $pass . "'
					 AND fe_tm_pelamar._active = '1'
					 AND fe_tm_pelamar._delete = '0' ";
        $this->db->select('fe_tm_pelamar.*');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get($this->_table);
        return $query->row(0);
    }

    public function cari_user_dulu($user, $pass) {
        $condition1 = "_email =" . "'" . strtoupper($user) . "'
					 AND _active = '1'
					 AND _delete = '0' ";
        $this->db->select('*');
        $this->db->where($condition1);
        $this->db->limit(1);
        $query1 = $this->db->get($this->_table);
        $run = $query1->row(0);
        if ($run) {
            $condition2 = array(
              '_email'=>strtoupper($user),
              '_password'=>trim($pass," "),
              '_active'=>'1',
              '_delete'=>'0'
            );
            $this->db->select('*');
            $this->db->where($condition2);
            $this->db->limit(1);
            $query2 = $this->db->get($this->_table);
            $run2 = $query2->row(0);

            if ($run2) {
                return true;
            } else {
                return "Password salah";
            }
        } else {
            return "User tidak ditemukan";
        }
    }

    public function getuser_by_id($id) {
        $this->db->where('user_no', $id);
        $query = $this->db->get($this->_table);
        return $query->row_array();
    }

    function update($id, $data) {
        $this->db->where('pelamar_no', $id);
        $this->db->update($this->_table, $data);
        return true;
    }

    public function findUserAccess($userLevelId) {

        $this->db->select('cms_tm_user.user_no,cms_tm_user.user_level_id,cms_tm_user._full_name');
        $this->db->from('cms_tm_user');
        $this->db->join('cms_tm_user_level', 'cms_tm_user_level.user_level_id=cms_tm_user.user_level_id');
        $this->db->where('cms_tm_user.user_level_id', $userLevelId);

        $query = $this->db->get();

        return $query->result_array();
    }

}

?>
