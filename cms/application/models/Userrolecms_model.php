  <?php
class Userrolecms_model extends CI_Model
{
    protected $_table = 'cms_tm_user';
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }



    public function ambil_data()
    {
        $sql = "SELECT
                  uac.user_access_no,
                  uac.user_level_id,
                  l._name as level_name,
                  sr._name,
                  uac._active,
                  uac.create_date,
                  u._full_name as created_by_fullname
                FROM cms_tm_user_access uac, sys_tm_role sr, sys_type l, cms_tm_user u, sys_tm_branch_role br
                WHERE uac.branch_role_id = br.branch_role_id
                  AND br.role_id = sr.role_id
                  AND uac.user_level_id = l.type_id
                  AND uac.create_by = u.user_no
                  AND uac._delete = '0'
                ORDER BY l._name ASC ";
        $query = $this->db->query($sql);
        return $result = $query->result();

    }

    public function getUserAccess(){
        $sql = "SELECT sys_tm_branch._name,sys_type._name as level, sys_tm_role._name as role,
                       cms_tm_user._full_name, cms_tm_user_access.create_date ,cms_tm_user_access.user_access_no,
                       cms_tm_user_access._active
                		FROM cms_tm_user_access , sys_tm_branch_role, sys_type, sys_tm_branch,cms_tm_user ,sys_tm_role
                where cms_tm_user_access.branch_role_id = sys_tm_branch_role.branch_role_id
                AND sys_type.type_id = cms_tm_user_access.user_level_id
                AND sys_tm_branch.branch_id = sys_tm_branch_role.branch_id
                AND cms_tm_user.user_no = cms_tm_user_access.create_by
                AND sys_tm_role.role_id = sys_tm_branch_role.role_id
                AND cms_tm_user_access._delete = '0'
                ";
        $query = $this->db->query($sql);
        return $result = $query->result();
    }

    public function getBranchRoleID(){
      $sql = " SELECT
                brole.branch_role_id,
                br._name,
                crp._name as cpname,
                sr._name as rolename,
                brole._active,
                brole.create_date,
                u._full_name as created_by_fullname
              FROM sys_tm_branch br, sys_tm_branch_role brole, sys_tm_role sr,
              	   sys_tm_corporate crp,	cms_tm_user u
              WHERE br.branch_id = brole.branch_id
              AND brole.create_by = u.user_no
              AND sr.role_id = brole.role_id
              AND crp.corporate_id = br.corporate_id
              AND brole._delete = '0'
              ORDER BY br._name";

      $query = $this->db->query($sql);
      return $result = $query->result();

    }

    public function hapus_role($user_access_no)
    {

        $caridulu = "user_access_no =" . "'" . $user_access_no . "'";
        $this->db->select('*');
        $this->db->from('cms_tm_user_access');
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

            $this->db->where('user_access_no', $user_access_no);
            $this->db->update('cms_tm_user_access', $data);
            return "Data berhasil dihapus.";
        }

    }

    public function checkExistAcces($branchroleID,$level){
        $this->db->select('*');
        $this->db->from('cms_tm_user_access');
        $where = array(
          'branch_role_id'=>$branchroleID,
          'user_level_id'=>$level,
          '_active'=>'1',
          '_delete'=>'0'
        );
        $this->db->where($where);
        $query = $this->db->get();
        if($query->num_rows() > 0){
           $res['msg'] = "User Access Sudah Ada,Tidak Dapat Disimpan";
           $res['status']='0';
        }else{
          $res['msg'] = "User Access  Dapat disimpan";
          $res['status']='1';
        }
        return $res;
    }

    public function insertUserAccess($data){
      return $this->db->insert('cms_tm_user_access', $data);
    }

    public function simpan_userrole($p_level_id, $p_role_id)
    {
		    $userinfo = $this->session->userdata("userinfo");
        $caridulu = "user_level_id=" . "'" . $p_level_id . "' AND " . "role_id =" . "'" . $p_role_id . "' AND " . "_delete =" . "'0'";
        $this->db->select('*');
        $this->db->from('cms_tm_user_access');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {
        $userinfo       = $this->session->userdata("userinfo");
        $sql            = "SELECT nextseq('cms_tm_user_access','') AS seq_cms_article_share FROM DUAL";
        $query          = $this->db->query($sql);
        $row            = $query->row_array();
        $user_access_no = $row['seq_cms_article_share'];
        $datarole = array(
            'user_access_no' => $user_access_no,
            'user_level_id' => $p_level_id,
            'role_id' => $p_role_id,
            '_active' => '1',
            '_delete' => '0',
            'create_date' => date("Y-m-d H:i:s"),
            'create_by' => $userinfo->user_no
        );
        $simpan   = $this->db->insert('cms_tm_user_access', $datarole);

        if ($simpan) {
            return "Berhasil disimpan.";
        } else {
            return "Gagal disimpan.";
        }
    } else {
            return "Gagal simpan role. User access sudah tersedia.";
        }


    }

    public function Ambil_level_id()
    {
        $query = $this->db->query('SELECT * FROM cms_tm_user_level ORDER BY _name ASC');


        return $query->result();
    }

    public function Ambil_role_id()
    {
        $query = $this->db->query('SELECT * FROM sys_tm_role ORDER BY _name ASC');


        return $query->result();
    }

    public function set_active($no_key)
    {
        $caridulu = "cms_tm_user_access.user_access_no =" . "'" . $no_key . "' AND " . "cms_tm_user_access._delete =" . "'0' AND " . "cms_tm_user_access._active =" . "'0'";
        $this->db->select('*');
        $this->db->from('cms_tm_user_access');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {

            return "Data tidak valid.";
        } else {
            $data = array(
                'cms_tm_user_access._active' => "1",
                'cms_tm_user_access._delete' => "0"
            );

            $this->db->where('cms_tm_user_access.user_access_no', $no_key);
            $this->db->update('cms_tm_user_access', $data);
            return "Useraccess berhasil diaktifkan.";
        }

    }

    public function set_noactive($no_key,$p_user_no)
    {
        $caridulu = "cms_tm_user_access.user_access_no =" . "'" . $no_key . "' AND " . "cms_tm_user_access._delete =" . "'0' AND " . "cms_tm_user_access._active =" . "'1'";
        $this->db->select('*');
        $this->db->from('cms_tm_user_access');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {

            return "Data tidak valid.";
        } else {
            $data = array(
                'cms_tm_user_access._active' => "0",
                'cms_tm_user_access._delete' => "0"
            );

            $this->db->where('cms_tm_user_access.user_access_no', $no_key);
            $this->db->update('cms_tm_user_access', $data);
            return "Useraccess berhasil dinonaktifkan.";
        }

    }

    public function getAccess($branch_id,$level){
       $sql = "SELECT
                     cms_tm_user_access.*,
                     sys_tm_role.role_id
                FROM
                       cms_tm_user_access,
                       sys_tm_branch_role,
                       sys_tm_branch,
                       sys_tm_role,
                       sys_type,
                       cms_tm_user

                WHERE
                       cms_tm_user_access.branch_role_id =  sys_tm_branch_role.branch_role_id
                       AND sys_tm_branch_role.branch_id = sys_tm_branch.branch_id
                       AND sys_tm_role.role_id = sys_tm_branch_role.role_id
                       AND sys_tm_branch.branch_id = '{$branch_id}'
                       AND sys_type.type_id = cms_tm_user.user_level_id
                       AND cms_tm_user_access.user_level_id = '{$level}'
                       AND cms_tm_user_access._active = '1'
                       AND cms_tm_user_access._delete ='0'
                       GROUP BY cms_tm_user_access.user_access_no";
       $query = $this->db->query($sql);
       return $result = $query->result_array();
    }
}

?>
