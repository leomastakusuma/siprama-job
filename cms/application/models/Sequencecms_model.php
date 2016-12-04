<?php
class Sequencecms_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
        $this->load->database();
	}

	function next($data){
		$query = $this->db->query("SELECT nextseq('".$data."','') as nextval FROM DUAL");
		$chek = $query->row_array();

		/**SELECT COLUMNS*/
		$sql = "SELECT ORDINAL_POSITION, COLUMN_NAME
						FROM INFORMATION_SCHEMA.COLUMNS
						WHERE table_name = '$data'
						AND table_schema = 'myr_recruitment'
						AND ORDINAL_POSITION = '1'";
	  $query = $this->db->query($sql);
    $colums = $query->row_array();
		/**END COLUMNS*/

		$sql = "SELECT 1 FROM $data WHERE ".$colums['COLUMN_NAME']."='".$chek['nextval']."'";
		$query = $this->db->query($sql);
    $checkSquence = $query->num_rows();
		while ($checkSquence > 0){
			$query = $this->db->query("SELECT nextseq('".$data."','') as nextval FROM DUAL");
			$chek = $query->row_array();

			$sql = "SELECT 1 FROM $data WHERE ".$colums['COLUMN_NAME']."='".$chek['nextval']."'";#'".$chek['nextval']."'";
			$query = $this->db->query($sql);
			$checkSquence = $query->num_rows();
		}

  	return $chek;

	}

}

?>
