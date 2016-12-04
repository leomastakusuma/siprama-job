<?php

Class General_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function checkUserAccess($level_id, $role_id)
    {
        if (is_array($role_id)) {
            $First = $role_id[0];
            $Second = $role_id[1];
            $sql = "SELECT
				  1
				FROM cms_tm_user_access uac
				WHERE uac.user_level_id = '$level_id'
				  AND uac.role_id = '$First' OR uac.role_id = '$Second'
				  AND uac._active = '1'
				  AND uac._delete = '0' ";
        } else {
            $sql = "SELECT
				  1
				FROM cms_tm_user_access uac
				WHERE uac.user_level_id = '$level_id'
				  AND uac.role_id = '$role_id'
				  AND uac._active = '1'
				  AND uac._delete = '0' ";
        }
        $query = $this->db->query($sql);

        $row = $query->num_rows();

        return $row;
    }

    function get_all_access($level_id)
    {
        $sql = "SELECT
				  uac.branch_role_id
				FROM cms_tm_user_access uac
				WHERE uac.user_level_id = '$level_id'
				  AND uac._active = '1'
				  AND uac._delete = '0' ";
        $query = $this->db->query($sql);
        $row = $query->result_array();
        return $row;
    }

    function getLowongan(){
       $sql = "SELECT type_id,_name FROM sys_type WHERE category_id = '21'";
       $query = $this->db->query($sql);
       return $query->result();
    }

    function getReligion(){
       $sql = "SELECT type_id,_name FROM sys_type WHERE category_id = '12'";
       $query = $this->db->query($sql);
       return $query->result();
    }
    function getGender(){
       $sql = "SELECT type_id,_name FROM sys_type WHERE category_id = '11'";
       $query = $this->db->query($sql);
       return $query->result();
    }
    function getLocation(){
       $sql = "SELECT type_id,_name FROM sys_type WHERE category_id = '10'";
       $query = $this->db->query($sql);
       return $query->result();
    }
    function getPendidikan(){
       $sql = "SELECT type_id,_name FROM sys_type WHERE category_id = '18'";
       $query = $this->db->query($sql);
       return $query->result();
    }
    function getKendaraan(){
       $sql = "SELECT type_id,_name FROM sys_type WHERE category_id = '16'";
       $query = $this->db->query($sql);
       return $query->result();
    }
    function getStatusPernikahan(){
       $sql = "SELECT type_id,_name FROM sys_type WHERE category_id = '14'";
       $query = $this->db->query($sql);
       return $query->result();
    }
    function getWarnaKulit(){
       $sql = "SELECT type_id,_name FROM sys_type WHERE category_id = '13'";
       $query = $this->db->query($sql);
       return $query->result();
    }
    function getBank(){
       $sql = "SELECT type_id,_name FROM sys_type WHERE category_id = '19'";
       $query = $this->db->query($sql);
       return $query->result();
    }
    function getAsuransi(){
       $sql = "SELECT type_id,_name FROM sys_type WHERE category_id = '17'";
       $query = $this->db->query($sql);
       return $query->result();
    }
    function getKota(){
       $sql = "SELECT location_no, _name FROM cms_tm_location WHERE type_location_id='TYPELOC03' AND _active='1' AND _delete='0'";
       $query = $this->db->query($sql);
       return $query->result();
    }







}
