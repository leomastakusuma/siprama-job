<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class General extends ci_controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        if (!$this->session->userdata('username')) {
            redirect('logincms'); // the user is not logged in, redirect them!
        }
        $this->csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        );
    }


    /**
     * @return keyword_no and name
     */
    function GetUserInfo($level) {
        $this->load->model('Logincms_model');
        return $this->Logincms_model->findUserAccess($level);
    }

    /* ----------------------------------------------------------------------*
     * checkUserAccess                                               *
     * ~~~~~~~~~~~~~                                                        *
     *                                                                      *
     * Description   - function ini untuk check user akses antara user level dan role *
     *                                                                      *
     * Change Request-                                            *
     * Specification -                                               *
     * Programmer    - Yansen                     *
     * Date          - 11.3.2016                                           *
     * Version       - 0.1                                                  *
     * ----------------------------------------------------------------------*
     * @parameter_required =
     * ----------------------------------------------------------------------*
     * Amendment History                                                    *
     * ~~~~~~~~~~~~~~~~~                                                    *
     * Ref | Date     | Programmer | Correction | Description               *
     * ~~~   ~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~~               *
     *           *
     * ---------------------------------------------------------------------- */

    function checkUserAccess($level_id, $role_id) {
        $this->load->model('General_model');

        $checkUserAccess = $this->General_model->checkUserAccess($level_id, $role_id);
        return $checkUserAccess;
    }

    function getAccessUrl($roleID){
        $allroleID = $this->session->userdata('cek');
        // $this->pr($allroleID);
        if(in_array($roleID,$allroleID)){
             return true;
        }else{
            redirect("logincms/logout");
        }
    }
    // untuk session user login cms
    public function userInfo() {
        return $userInfo = $this->session->userdata('userinfo');
    }

    public function pr($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
        die;
    }

    // menu channel article
    public function build_child($oldID) {
        $tempTree = "";
        GLOBAL $exclude, $depth;               // Refer to the global array defined at the top of this script

        $this->load->model('General_model');

        $child = $this->General_model->listMenuArticleChannel($oldID);
        if (!empty($child)) {
            $tempTree .='<ul class="sub">';
        }
        foreach ($child as $child) {

            if ($child['channel_no'] != $child['_parent_channel_no']) {
                for ($c = 0; $c < $depth; $c++) {               // Indent over so that there is distinction between levels
                    $tempTree .= "";
                }
                $tempTree .= "<li><a onclick='simpanmenu(this.id)' id='articlesx' href='" . site_url('articlecms/index/' . $child['channel_no']) . "'>" . $child['_name'] . "</a></li>";
                $depth++;
                $child['channel_no'];        // Incriment depth b/c we're building this child's child tree  (complicated yet???)
                $tempTree .= $this->build_child($child['channel_no']);
                $tempTree .= "";        // Add to the temporary local tree
                $depth--;          // Decrement depth b/c we're done building the child's child tree.
                // array_push($exclude, $child['categories_id']);               // Add the item to the exclusion list
            }
        }
        $tempTree .= "";
        if (!empty($child)) {
            $tempTree .='</ul>';
        }
        RETURN $tempTree;          // Return the entire child tree
    }

    // menu channel article
    public function build_child2($oldID) {
        $tempTree = "";
        GLOBAL $exclude, $depth;               // Refer to the global array defined at the top of this script

        $this->load->model('General_model');

        $child = $this->General_model->listMenuArticleChannel($oldID);
        if (!empty($child)) {
            $tempTree .='<ul class="sub">';
        }
        foreach ($child as $child) {

            if ($child['channel_no'] != $child['_parent_channel_no']) {
                for ($c = 0; $c < $depth; $c++) {               // Indent over so that there is distinction between levels
                    $tempTree .= "";
                }
                $tempTree .= "<li><a onclick='simpanmenu(this.id)' id='articlesz' href='" . site_url('articleAdvertorialcms/index/' . $child['channel_no']) . "'>" . $child['_name'] . "</a></li>";
                $depth++;
                $child['channel_no'];        // Incriment depth b/c we're building this child's child tree  (complicated yet???)
                $tempTree .= $this->build_child2($child['channel_no']);
                $tempTree .= "";        // Add to the temporary local tree
                $depth--;          // Decrement depth b/c we're done building the child's child tree.
                // array_push($exclude, $child['categories_id']);               // Add the item to the exclusion list
            }
        }
        $tempTree .= "";
        if (!empty($child)) {
            $tempTree .='</ul>';
        }
        RETURN $tempTree;          // Return the entire child tree
    }


    public function page500() {
        $this->load->view('500');
    }

    /* ----------------------------------------------------------------------*
     * fixSlugLSNull                                               *
     * ~~~~~~~~~~~~~                                                        *
     *                                                                      *
     * Description   - function ini untuk benerin slug yang kosong *
     *                                                                      *
     * Change Request-                                            *
     * Specification -                                               *
     * Programmer    - Yansen                     *
     * Date          - 11.3.2016                                           *
     * Version       - 0.1                                                  *
     * ----------------------------------------------------------------------*
     * @parameter_required =
     * ----------------------------------------------------------------------*
     * Amendment History                                                    *
     * ~~~~~~~~~~~~~~~~~                                                    *
     * Ref | Date     | Programmer | Correction | Description               *
     * ~~~   ~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~~               *
     *           *
     * ---------------------------------------------------------------------- */

    public function fixSlugLSNull($mode = "") {
        $this->load->model('General_model');
        $this->load->model('Sequencecms_model');

        $no = 0;
        $slugLSNull = $this->General_model->slugLSNull($mode);
        if (!empty($slugLSNull)) {
            foreach ($slugLSNull as $s) {
                $ls_no = $s['live_streaming_no'];
                $ls_title = $s['_title'];

                $slugUnique = $this->General_model->getSlugUniqueNumber($ls_no);
                $slug = slugify($ls_title);

                $fixSlugLSNull = $this->General_model->fixSlugLSNull($ls_no, $slugUnique, $slug);
                $no++;
            }
        }

        echo $no;
    }

    /* ----------------------------------------------------------------------*
     * fixSlugStoryNull                                               *
     * ~~~~~~~~~~~~~                                                        *
     *                                                                      *
     * Description   - function ini untuk benerin slug yang kosong *
     *                                                                      *
     * Change Request-                                            *
     * Specification -                                               *
     * Programmer    - Yansen                     *
     * Date          - 21.4.2016                                           *
     * Version       - 0.1                                                  *
     * ----------------------------------------------------------------------*
     * @parameter_required =
     * ----------------------------------------------------------------------*
     * Amendment History                                                    *
     * ~~~~~~~~~~~~~~~~~                                                    *
     * Ref | Date     | Programmer | Correction | Description               *
     * ~~~   ~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~~               *
     *           *
     * ---------------------------------------------------------------------- */

    public function fixSlugStoryNull($mode = "") {
        $this->load->model('General_model');
        $this->load->model('Sequencecms_model');

        $no = 0;
        $slugStoryNull = $this->General_model->slugStoryNull($mode);
        if (!empty($slugStoryNull)) {
            foreach ($slugStoryNull as $s) {
                $story_no = $s['story_no'];
                $story_title = $s['_title'];

                $slugUnique = $this->General_model->getSlugUniqueNumber($story_no);
                $slug = slugify($story_title);

                $fixSlugStoryNull = $this->General_model->fixSlugStoryNull($story_no, $slugUnique, $slug);
                $no++;
            }
        }

        echo $no;
    }

    /* ----------------------------------------------------------------------*
     * _addWorkerInsertToRE                                               *
     * ~~~~~~~~~~~~~                                                        *
     *                                                                      *
     * Description   - function ini untuk add worker curl insert data ke recommendation engine *
     *                                                                      *
     * Change Request-                                            *
     * Specification -                                               *
     * Programmer    - Yansen                     *
     * Date          - 18.5.2016                                           *
     * Version       - 0.1                                                  *
     * ----------------------------------------------------------------------*
     * @parameter_required = $functionRE = string, $param = array
     * ----------------------------------------------------------------------*
     * Amendment History                                                    *
     * ~~~~~~~~~~~~~~~~~                                                    *
     * Ref | Date     | Programmer | Correction | Description               *
     * ~~~   ~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~~               *
     *           *
     * ---------------------------------------------------------------------- */



    public function dataTablesAjax($table, $primaryKey, $columsArray = array(), $sqljoinQuery = NULL, $extraWhere = null,$groupBy =null) {
        // Table's primary key
        $tables = $table;
        // primaryKeys Tables
        $primaryKeys = $primaryKey;

        // $columns = array(
        // 	array( 'db' => '`u`.`first_name`', 'dt' => 0, 'field' => 'first_name' ),
        // 	array( 'db' => '`u`.`last_name`',  'dt' => 1, 'field' => 'last_name' ),
        // 	array( 'db' => '`u`.`position`',   'dt' => 2, 'field' => 'position' ),
        // 	array( 'db' => '`u`.`office`',     'dt' => 3, 'field' => 'office'),
        // 	array( 'db' => '`ud`.`email`',     'dt' => 4, 'field' => 'email' ),
        // 	array( 'db' => '`ud`.`phone`',     'dt' => 5, 'field' => 'phone' )
        // );
        $columns = $columsArray;
        $database = $this->load->database('default', TRUE);
        $sql_details = array(
            'user' => $database->username,
            'pass' => $database->password,
            'db' => $database->database,
            'host' => $database->hostname,
        );

        require('ssp.customized.class.php' );
        echo json_encode(
                SSP::simple($_POST, $sql_details, $tables, $primaryKeys, $columns, $sqljoinQuery, $extraWhere,$groupBy)
        );
    }

    public function uploadImage($fileName,$fileTmp){
        $uploaddir = FCPATH.'public_assets/uploads/';
        $ext = substr($fileName, -3);
        if ($ext == 'jpg' || $ext == 'peg' || $ext == 'png') {
            $name = $fileName.date('Y-m-d H:i:s');
            $encName   = md5($name).'.'.$ext;
            $uploadfile = $uploaddir . basename($encName);
            if(move_uploaded_file($fileTmp, $uploadfile)){
                $response['success'] = 'Succes Uploading';
                $response['_icon_real_name'] = $fileName;
                $response['_icon_enc_name'] = $encName;
                $response['_icon_url'] = site_url('').'public_assets/uploads/'.$encName;
            }else{
                $response['error'] = 'Error Uploading';
            }
        }else{
            $response['error'] = 'Invalid image Format Image (jpg/png)';
        }
        return $response;
    }


}
