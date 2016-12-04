<?php
class Homeslidercms_model extends CI_Model
{
    protected $_table = 'cms_tm_fe_homeslider';
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

		public function insertHomesilder($data) {
				return $this->db->insert($this->_table, $data);
		}

    public function listMulitmediaBank(){
       $sql   = "SELECT cms_tm_multimediabank.*
                            FROM cms_tm_multimediabank where cms_tm_multimediabank._delete ='0'";
       $query = $this->db->query($sql);
       return $result = $query->result();
    }

    public function getmultimediaBank($id){
        $sql   = "SELECT cms_tm_multimediabank.*
                             FROM cms_tm_multimediabank where cms_tm_multimediabank._delete ='0'
                             AND cms_tm_multimediabank.multimediabank_no = '$id'";
        $query = $this->db->query($sql);
        return $result = $query->row();
    }

    public function updateHomeslider($data,$id){
        $this->db->where('homeslider_no', $id);
        return $this->db->update('cms_tm_fe_homeslider', $data);
    }
    public function updateLowonganPromotedall($data){
      return $this->db->update('cms_tm_fe_homeslider', $data);
    }
    public function checkPosition(){
       $sql = "SELECT COUNT(cms_tm_fe_homeslider._position)+1 as position FROM cms_tm_fe_homeslider";
       $query = $this->db->query($sql);
       return $result = $query->row();
    }
    public function searchHomeSlider($id){
        $this->db->select('cms_tm_fe_homeslider.*,cms_tm_multimediabank._title as titleM, cms_tm_multimediabank._desc as _descM ,cms_tm_multimediabank._url, cms_tm_multimediabank._enc_name ');
        $this->db->from($this->_table);
        $where = array(
          'cms_tm_fe_homeslider._delete'=>'0',
          'cms_tm_fe_homeslider.homeslider_no'=>$id
        );
        $this->db->join('cms_tm_multimediabank','cms_tm_multimediabank.multimediabank_no=cms_tm_fe_homeslider.multimediabank_no','left');
        $this->db->where($where);
        $this->db->order_by("cms_tm_fe_homeslider._position",'asc');
        $query = $this->db->get();
        return $result = $query->row();
    }

    public function listHomeSlider(){
        $this->db->select('cms_tm_fe_homeslider.*,cms_tm_user._full_name');
        $this->db->from($this->_table);
        $where = array(
          'cms_tm_fe_homeslider._delete'=>'0',
        );
        $this->db->join('cms_tm_multimediabank','cms_tm_multimediabank.multimediabank_no=cms_tm_fe_homeslider.multimediabank_no','left');
        $this->db->join('cms_tm_user','cms_tm_user.user_no=cms_tm_fe_homeslider.create_by');
        $this->db->where($where);
        $this->db->order_by("cms_tm_fe_homeslider._position",'asc');
        $query = $this->db->get();
        return $result = $query->result();
    }


    function select_homeslider_by_id($id) {
        $sql = "SELECT a._position
                FROM cms_tm_fe_homeslider a
                WHERE homeslider_no ='$id'";
        $query = $this->db->query($sql);
        $row = $query->result_array();
        return $row;
    }

    function update_position_homeslider($id, $data) {
        $this->db->where('homeslider_no', $id);
        return $this->db->update('cms_tm_fe_homeslider', $data);
    }

    function update_position_homeslidersame($id,$position, $data) {
        $where = array(
          'homeslider_no !=' =>$id,
          '_position' =>$position
        );
        $this->db->where($where);
        return $this->db->update('cms_tm_fe_homeslider', $data);
    }

    function check_position_homeslider($position,$id) {
      $sql = "SELECT a._position,
              a.homeslider_no
              FROM cms_tm_fe_homeslider a
              WHERE a._position ='$position' AND homeslider_no ='$id'";
      $query = $this->db->query($sql);
      return $query->result_array();
    }

     function insertWhenEmpty(){
        $sql = "SELECT * FROM `cms_tm_fe_homeslider`";
        $query = $this->db->query($sql);
        $result = $query->result();
        if(empty($result)){
            for($i=1;$i<=10;$i++){
               $data = array(
                   'multimediabank_no'=>NULL,
                   '_title'=>'',
                   '_desc'=>'',
                   '_position'=>$i,
                   'create_date'=>date('Y-m-d H:i:s'),
                   'create_by'=>$_SESSION['userinfo']->user_no
              );
              $this->insertHomesilder($data);
            }
        }
     }

}


?>
