<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploadcms extends CI_Controller {
  public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('curl');
        $this->load->model('sequencecms_model');
        $this->load->model('Channelcms_model');
    } 
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function Index()
	{
        $datacontent['channel'] = $this->Channelcms_model->selectChannel('channel_no,_name');
		$this->load->view('upload/index',$datacontent);
	}

	public function getnextval($data){
		$next = $this->sequencecms_model->next($data);
		echo $next['nextval'];
	}

	public function added(){
		$adminid = $this->session->userdata('userinfo');
		$next = $this->sequencecms_model->next('cms_tm_article');
		$nextattach = $this->sequencecms_model->next('cms_tm_article_attachment');
		$apiKey = apiKey;
        $apiSecret = apiSecret;
        $testUser = testUser;
        $testPassword = testPassword;
    	/*$vidName = $this->input->post('title');
        $vidDesc = $this->input->post('desc');*/
        $this->load->library('upload');
        if(!empty($_FILES['videofile']['name'])){  
        	$ext = substr($_FILES['videofile']['name'],-3);
        	if($ext=='peg'){
        		$ext = 'mpeg';
        	}
            $video_namep =  md5(str_replace(' ','_',date('Ymdhis').strtolower($_FILES['videofile']['name']))).'.'.$ext;
            $config['upload_path']      = $this->config->item('upload_images');
            /*$config['allowed_types']    = 'mp4|mpg|mov|flv|mpeg|avi|mkv|';*/
            $config['allowed_types']    = '*';
            $config['file_name']        = $video_namep;
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('videofile')){
            	//print_r($this->upload->display_errors());
		         $callback['response'] = 'failures';
		         $callback['message']	= $this->upload->display_errors();
	        }else{
            	$testVideoFile = $this->config->item('upload_images').$video_namep;
            	// echo $testVideoFile;
            	// exit();
				$url = 'https://api.dailymotion.com/oauth/token';
		        /* GET ACCESS TOKEN */
		        try {
		        $data = "grant_type=password&client_id=" . $apiKey . "&client_secret=" .      $apiSecret . "&username=".$testUser."&password=".$testPassword."&scope=read+write+manage_videos+feed";
		        $curlInit = curl_init($url);
		        curl_setopt($curlInit, CURLOPT_POST, 1);
		        curl_setopt($curlInit, CURLOPT_POSTFIELDS, $data);
		        curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, 1);
		        $output = curl_exec($curlInit);
		        curl_close($curlInit);
		        $res = json_decode($output);
		        $accessToken = $res->access_token;
		        $getUploadUrl = "curl -d 'access_token=$accessToken' -G  https://api.dailymotion.com/file/upload/";
		        $uploadUrl = json_decode(file_get_contents('https://api.dailymotion.com/file/upload?access_token='.$accessToken));
		        
		        
		         ob_end_clean();
		         //unlink($testVideoFile);
		         $callback['response'] = 'success';
		         $callback['dailyID']  = $uploadUrl->upload_url.','.$uploadUrl->progress_url.','.$accessToken.','.$_FILES['videofile']['name'].','.$video_namep;
		         } catch (Exception $e) {
		         $callback['response'] = 'failure';
		         }
            }   
             echo json_encode($callback);
        }
	}

	public function get_url(){
		$apiKey = apiKey;
        $apiSecret = apiSecret;
        $testUser = testUser;
        $testPassword = testPassword;
        $url = 'https://api.dailymotion.com/oauth/token';
        /* GET ACCESS TOKEN */
        try {
        $data = "grant_type=password&client_id=" . $apiKey . "&client_secret=" .      $apiSecret . "&username=".$testUser."&password=".$testPassword."&scope=read+write+manage_videos+feed";
        $curlInit = curl_init($url);
        curl_setopt($curlInit, CURLOPT_POST, 1);
        curl_setopt($curlInit, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curlInit);
        curl_close($curlInit);
        $res = json_decode($output);
        $accessToken = $res->access_token;
        $getUploadUrl = "curl -d 'access_token=$accessToken' -G  https://api.dailymotion.com/file/upload/";
        $uploadUrl = json_decode(file_get_contents('https://api.dailymotion.com/file/upload?access_token='.$accessToken));
        
        
         ob_end_clean();
         //unlink($testVideoFile);
         if(!empty($uploadUrl)){
	         $callback['response'] = 'success';
	         $callback['dailyID']  = $uploadUrl->upload_url.','.$uploadUrl->progress_url.','.$accessToken;
         	}else{
         		$callback['response']	= 'failure';
         		$callback['message']	= 'no response from dailymotion';
         	}
         } catch (Exception $e) {
         $callback['response'] = 'failure';
         }
         echo json_encode($callback);
	}

	public function uploading(){
		if(!empty($_POST)){
			$detail = $_POST['detailfile'];
			//$testVideoFile = $this->config->item('upload_images').$detail[4];
			$vidName = $_POST['title'];
			$vidDesc = $_POST['desc'];
			$accessToken = $_POST['acc'];
			/*$postFileCmd = "curl -F 'file=@$testVideoFile'" . ' "' . $detail[0] . '"';
	        $postFileResponse = json_decode(system($postFileCmd));
	        */
	        $postVideoCmd = "curl -d 'access_token=$accessToken&url=$detail&title=$vidName&channel=news&published=true&description=$vidDesc' https://api.dailymotion.com/me/videos?private=1";

	        $postVideoResponse = json_decode(system($postVideoCmd));
	        $videoId = $postVideoResponse->id;
	        $get_private = json_decode(file_get_contents("https://api.dailymotion.com/video/$videoId?access_token=$accessToken&fields=private_id"));
	        $dailyurl = 'https://www.dailymotion.com/video/'.$get_private->private_id;
	        if($dailyurl){
	        	unlink($testVideoFile);
	        	$callback['response'] = 'success';
	        	$callback['dailyID'] = $dailyurl;
	        	$callback['dailyID2'] = $_POST['truename'].','.md5($_POST['truename']);
	        }
	        ob_end_clean();
	        echo json_encode($callback);
		}
	}

	public function testing(){
		//
		$apiKey = apiKey;
        $apiSecret = apiSecret;
        $testUser = testUser;
        $testPassword = testPassword;
        $url = 'https://api.dailymotion.com/oauth/token';
        /* GET ACCESS TOKEN */
        try {
        $data = "grant_type=password&client_id=" . $apiKey . "&client_secret=" .      $apiSecret . "&username=".$testUser."&password=".$testPassword."&scope=read+write+manage_videos+feed";
        $curlInit = curl_init($url);
        curl_setopt($curlInit, CURLOPT_POST, 1);
        curl_setopt($curlInit, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curlInit);
        curl_close($curlInit);
        $res = json_decode($output);
        $accessToken = $res->access_token;
        $getUploadUrl = "curl -d 'access_token=$accessToken' -G  https://api.dailymotion.com/file/upload/";
        $uploadUrl = json_decode(file_get_contents('https://api.dailymotion.com/file/upload?access_token='.$accessToken));
        
        
         ob_end_clean();
         //unlink($testVideoFile);
         $callback['response'] = 'success';
         $callback['uploadurl']  = $uploadUrl->upload_url;//.','.$uploadUrl->progress_url.','.$accessToken.','.$_FILES['videofile']['name'].','.$video_namep;
         } catch (Exception $e) {
         $callback['response'] = 'failure';
         }

         $this->load->view('callback',$callback);
	}

}
