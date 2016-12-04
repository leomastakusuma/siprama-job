<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	/*----------------------------------------------------------------------*
    * encode_base64_param                                              	   *
    * ~~~~~~~~~~~~~                                                        *
    *                                                                      *
    * Description   - function decode $param array() 					   *
    *                                                                      *
    * Change Request-                                            		   *
    * Specification -                                               	   *
    * Programmer    - Luter Rinding                    					   *
    * Date          - 11.11.2015                                           *
    * Version       - 0.1                                                  *
    *----------------------------------------------------------------------*
    * @parameter_required = Array();
	* $param = array("data1"=> 1,"data2"=> 3, "data3"=> 4, "data4"=> 4);
    *----------------------------------------------------------------------*
	 *----------------------------------------------------------------------*
    * @Output = String
    *----------------------------------------------------------------------*
    * Amendment History                                                    *
    * ~~~~~~~~~~~~~~~~~                                                    *
    * Ref | Date     | Programmer | Correction | Description               *
    * ~~~   ~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~~               *
    *           *
    *----------------------------------------------------------------------*/


	if( ! function_exists('decode_base64_param'))
	{
		function encode_base64_param($param= array() )
		{

			$fields_string = '';
			foreach($param as $key => $value) {
		            $fields_string .= $key.'='.$value.';';
		    }
        	$fields_string = rtrim($fields_string,';');

			return base64_encode($fields_string);
		}
	}


	/*----------------------------------------------------------------------*
    * decode_base64_string                                                  *
    * ~~~~~~~~~~~~~                                                        *
    *                                                                      *
    * Description   - function decode $param array() 					   *
    *                                                                      *
    * Change Request-                                            		   *
    * Specification -                                                      *
    * Programmer    - Luter Rinding                    					   *
    * Date          - 11.11.2015                                           *
    * Version       - 0.1                                                  *
    *----------------------------------------------------------------------*
    * @parameter_required = string
    *----------------------------------------------------------------------*
	 *----------------------------------------------------------------------*
    * @Output = Array encode
    *----------------------------------------------------------------------*
    * Amendment History                                                    *
    * ~~~~~~~~~~~~~~~~~                                                    *
    * Ref | Date     | Programmer | Correction | Description               *
    * ~~~   ~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~~               *
    *           														   *
    *----------------------------------------------------------------------*/

	if( ! function_exists('decode_base64_string'))
	{
		function decode_base64_string($string="" )
		{
			$str_decode =  base64_decode($string);

			// check jika base64 gak valid return kosong - modify by yansen
			if ( base64_encode(base64_decode($string, true)) != $string){
			    return "";
			}

			$param_data = explode(";", $str_decode);
			$result = false;
			if(!empty($param_data)){
				foreach($param_data as $value){
					$val_data = explode("=", $value);
					$result[$val_data[0]] = $val_data[1];

				}
			}

			return $result;
		}
	}


	/*---------------------------------------------------------------------*
    * curl_get_contents                                                    *
    * ~~~~~~~~~~~~~                                                        *
    *                                                                      *
    * Description   - function curl_setopt								   *
    *                                                                      *
    * Change Request-                                            		   *
    * Specification -                                                      *
    * Programmer    - Luter Rinding                    					   *
    * Date          - 11.11.2015                                           *
    * Version       - 0.1                                                  *
    *----------------------------------------------------------------------*
    * @parameter_required = string
		$method = GET / POST
		$data = string
		$params = array('data1' => 1, 'data2' => "tess");
    *----------------------------------------------------------------------*
	 *----------------------------------------------------------------------*
    * @Output = string
    *----------------------------------------------------------------------*
    * Amendment History                                                    *
    * ~~~~~~~~~~~~~~~~~                                                    *
    * Ref | Date     | Programmer | Correction | Description               *
    * ~~~   ~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~~               *
    *           														   *
    *----------------------------------------------------------------------*/

	if ( ! function_exists('curl_get_contents'))
	{
	function curl_get_contents($uri, $method = 'GET', $data = null, $params = array())
	{

			$timeout				= (isset($params['timeout']) AND !empty($params['timeout'])) ? $params['timeout'] : 10;
			$responseOutputHeader	= false;
			$method					= strtoupper($method);
			$urlSeparator			= ( parse_url( $uri, PHP_URL_QUERY ) ) ? '&' : '?';
			$uri					= ( $method == 'GET' && ! empty($data) ) ? $uri . $urlSeparator . (is_array($data) ? http_build_query($data) : $data) : $uri;
			$curl					= curl_init();

			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_URL, $uri);
			curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);

			if(isset($params['user']) && isset($params['password'])){
				curl_setopt($curl, CURLOPT_USERPWD, $params['user'].':'.$params['password']);
			}


			if($responseOutputHeader)
		    	curl_setopt($curl, CURLOPT_HEADER, true);

			if( $method != 'GET' ) {
				if( is_array($data) ){
					$data = http_build_query($data);
				}

				if( $method == 'POST' ){
					curl_setopt($curl, CURLOPT_POST, 1);
				}

				if( $method == 'PUT' || $method == 'DELETE' ) {
					$setRequestHeaders[] = 'Content-Length: ' . strlen($_POST);
					curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
				}

				curl_setopt($curl, CURLOPT_POSTFIELDS, $_POST);
			}


			if(isset($setRequestHeaders)){
				curl_setopt($curl, CURLOPT_HTTPHEADER, $setRequestHeaders);
			}

			curl_setopt($curl, CURLINFO_HEADER_OUT, true);


			curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');

			$response = curl_exec($curl);
			$resultStatus = curl_getinfo($curl);

			if($resultStatus['http_code'] == 200) {
				return $response;
			} else {
				echo 'Call Failed '.print_r($resultStatus);
			}
		}
	}



	/*----------------------------------------------------------------------*
    * quickRandom                                              	   *
    * ~~~~~~~~~~~~~                                                        *
    *                                                                      *
    * Description   - function decode $param array() 					   *
    *                                                                      *
    * Change Request-                                            		   *
    * Specification -                                               	   *
    * Programmer    - Luter Rinding                    					   *
    * Date          - 11.11.2015                                           *
    * Version       - 0.1                                                  *
    *----------------------------------------------------------------------*
    * @parameter_required = int
	* @param  int  $length
    *----------------------------------------------------------------------*
	 *----------------------------------------------------------------------*
    * @Output = String
    *----------------------------------------------------------------------*
    * Amendment History                                                    *
    * ~~~~~~~~~~~~~~~~~                                                    *
    * Ref | Date     | Programmer | Correction | Description               *
    * ~~~   ~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~~               *
    *           *
    *----------------------------------------------------------------------*/

	if ( ! function_exists('quickRandom'))
	{
		function quickRandom($length = 16)
		{
			$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

			return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
		}
	}


	/*----------------------------------------------------------------------*
    * quickRandom                                              	   *
    * ~~~~~~~~~~~~~                                                        *
    *                                                                      *
    * Description   - function decode $param array() 					   *
    *                                                                      *
    * Change Request-                                            		   *
    * Specification -                                               	   *
    * Programmer    - Luter Rinding                    					   *
    * Date          - 11.11.2015                                           *
    * Version       - 0.1                                                  *
    *----------------------------------------------------------------------*
    * @parameter_required = array or string
    *----------------------------------------------------------------------*
	 *----------------------------------------------------------------------*
    * @Output = string or array
    *----------------------------------------------------------------------*
    * Amendment History                                                    *
    * ~~~~~~~~~~~~~~~~~                                                    *
    * Ref | Date     | Programmer | Correction | Description               *
    * ~~~   ~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~~               *
    *           *
    *----------------------------------------------------------------------*/

	if ( ! function_exists('_ErrorBug'))
	{
		function _ErrorBug($arr='')
		{
			echo "<pre>";print_r($arr);echo "</pre>";exit();
		}
	}

	/*----------------------------------------------------------------------*
    * quickRandom                                              	   *
    * ~~~~~~~~~~~~~                                                        *
    *                                                                      *
    * Description   - function decode $param array() 					   *
    *                                                                      *
    * Change Request-                                            		   *
    * Specification -                                               	   *
    * Programmer    - Luter Rinding                    					   *
    * Date          - 11.11.2015                                           *
    * Version       - 0.1                                                  *
    *----------------------------------------------------------------------*
    * @parameter_required = time
    *----------------------------------------------------------------------*
	 *----------------------------------------------------------------------*
    * @Output = string
    *----------------------------------------------------------------------*
    * Amendment History                                                    *
    * ~~~~~~~~~~~~~~~~~                                                    *
    * Ref | Date     | Programmer | Correction | Description               *
    * ~~~   ~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~~               *
    *           *
    *----------------------------------------------------------------------*/

	if ( ! function_exists('time_elapsed_string'))
	{
		function time_elapsed_string($ptime)
		{
		    $etime = time() - $ptime;
		    if ($etime < 1){
		        return '0 seconds';
		    }
		    $a = array( 365 * 24 * 60 * 60  =>  'year',
		                 30 * 24 * 60 * 60  =>  'month',
		                      24 * 60 * 60  =>  'day',
		                           60 * 60  =>  'hour',
		                                60  =>  'minute',
		                                 1  =>  'second'
		                );
		    $a_plural = array( 'year'   => 'years',
		                       'month'  => 'months',
		                       'day'    => 'days',
		                       'hour'   => 'hours',
		                       'minute' => 'minutes',
		                       'second' => 'seconds'
		                );
		    foreach ($a as $secs => $str)
		    {
		        $d = $etime / $secs;
		        if ($d >= 1)
		        {
		            $r = round($d);
		            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
		        }
		    }
		}
	}

	/*----------------------------------------------------------------------*
    * _sortArray                                              	   *
    * ~~~~~~~~~~~~~                                                        *
    *                                                                      *
    * Description   - function untuk sort array key , pembantu _sortedDataArray() 					   *
    *                                                                      *
    * Change Request-                                            		   *
    * Specification -                                               	   *
    * Programmer    - Yansen                    					   *
    * Date          - 20.11.2015                                           *
    * Version       - 0.1                                                  *
    *----------------------------------------------------------------------*
    * @parameter_required = ARRAY DATA LISTNYA, ARRAY KEY
    *----------------------------------------------------------------------*
	 *----------------------------------------------------------------------*
    * @Output = array
    *----------------------------------------------------------------------*
    * Amendment History                                                    *
    * ~~~~~~~~~~~~~~~~~                                                    *
    * Ref | Date     | Programmer | Correction | Description               *
    * ~~~   ~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~~               *
    *           *
    *----------------------------------------------------------------------*/
	if ( ! function_exists('_sortArray'))
	{
		function _sortArray($data, $field)
	    {
	        if(!is_array($field)) $field = array($field);
	        usort($data, function($a, $b) use($field)
	        {
	            $retval = 0;
	            foreach($field as $fieldname)
	            {
	                if($retval == 0) $retval = strnatcmp($a[$fieldname],$b[$fieldname]);
	            }
	            return $retval;
	        });
	        return $data;
	    }
	}

	/*----------------------------------------------------------------------*
    * _sortedDataArray                                              	   *
    * ~~~~~~~~~~~~~                                                        *
    *                                                                      *
    * Description   - function untuk sort array asc desc 				   *
    *                                                                      *
    * Change Request-                                            		   *
    * Specification -                                               	   *
    * Programmer    - Yansen                    					   *
    * Date          - 20.11.2015                                           *
    * Version       - 0.1                                                  *
    *----------------------------------------------------------------------*
    * @parameter_required = ARRAY DATA LISTNYA, ASC / DESC , ARRAY KEY ARRAY
    *----------------------------------------------------------------------*
	 *----------------------------------------------------------------------*
    * @Output = array
    *----------------------------------------------------------------------*
    * Amendment History                                                    *
    * ~~~~~~~~~~~~~~~~~                                                    *
    * Ref | Date     | Programmer | Correction | Description               *
    * ~~~   ~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~~               *
    *           *
    *----------------------------------------------------------------------*/
	if ( ! function_exists('_sortedDataArray'))
	{
		function _sortedDataArray($dataArray, $p_sort, $sort_by)
	    {
	        if (empty($sort_by))
            {
                if ($p_sort=="desc")
                {
                    $sorted_data = array_reverse($dataArray);
                }
                else
                {
                    $sorted_data = $dataArray;
                }
            }
            else
            {
                if ($p_sort=="desc")
                {
                    $sorted_data = array_reverse(_sortArray($dataArray, $sort_by));
                }
                else
                {
                    $sorted_data = _sortArray($dataArray, $sort_by);
                }
            }

            return $sorted_data;
	    }
	}

	/*----------------------------------------------------------------------*
    * _filterLimit                                              	   *
    * ~~~~~~~~~~~~~                                                        *
    *                                                                      *
    * Description   - function untuk filter limit 				   *
    *                                                                      *
    * Change Request-                                            		   *
    * Specification -                                               	   *
    * Programmer    - Yansen                    					   *
    * Date          - 20.11.2015                                           *
    * Version       - 0.1                                                  *
    *----------------------------------------------------------------------*
    * @parameter_required = limit_start , limit_end
    *----------------------------------------------------------------------*
	 *----------------------------------------------------------------------*
    * @Output = string
    *----------------------------------------------------------------------*
    * Amendment History                                                    *
    * ~~~~~~~~~~~~~~~~~                                                    *
    * Ref | Date     | Programmer | Correction | Description               *
    * ~~~   ~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~~               *
    *           *
    *----------------------------------------------------------------------*/
	if ( ! function_exists('_filterLimit'))
	{
		function _filterLimit($limit_start, $limit_end)
	    {
	        if ($limit_start=="" || $limit_end=="")
	        {
	        	$filter_limit = "";
	        }
	        else
	        {
	        	$filter_limit = "LIMIT ".$limit_start.",".$limit_end;
	        }
            return $filter_limit;
	    }
	}

	/*----------------------------------------------------------------------*
    * _validateSortBy                                              	   *
    * ~~~~~~~~~~~~~                                                        *
    *                                                                      *
    * Description   - function untuk validasi sort by array 				   *
    *                                                                      *
    * Change Request-                                            		   *
    * Specification -                                               	   *
    * Programmer    - Yansen                    					   *
    * Date          - 30.11.2015                                           *
    * Version       - 0.1                                                  *
    *----------------------------------------------------------------------*
    * @parameter_required = $p_sort_by array or string
    *----------------------------------------------------------------------*
	 *----------------------------------------------------------------------*
    * @Output = string or array
    *----------------------------------------------------------------------*
    * Amendment History                                                    *
    * ~~~~~~~~~~~~~~~~~                                                    *
    * Ref | Date     | Programmer | Correction | Description               *
    * ~~~   ~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~~               *
    *           *
    *----------------------------------------------------------------------*/
	if ( ! function_exists('_validateSortBy'))
	{
		function _validateSortBy($p_sort_by)
	    {
	    	if (!empty($p_sort_by))
	    	{
		        $sort_by = explode(",", $p_sort_by);
	            $sort_by = array_map('trim',$sort_by);
	    	}
	    	else
	    	{
	    		$sort_by = "";
	    	}

	        return $sort_by;
	    }
	}


	if ( ! function_exists('sluginterest'))
	{
		function sluginterest($text)
		{
		  // replace non letter or digits by -
		  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

		  // trim
		  $text = trim($text, '-');

		  // transliterate
		  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		  // lowercase
		  $text = strtolower($text);

		  // remove unwanted characters
		  $text = preg_replace('~[^-\w]+~', '', $text);

		  if (empty($text))
		  {
			return 'n-a';
		  }

		  return $text;
		}
	}

	if ( ! function_exists('slugify'))
	{
		function slugify($text)
		{
		  // replace non letter or digits by -
		  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

		  // trim
		  $text = trim($text, '-');

		  // transliterate
		  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		  // lowercase
		  $text = strtolower($text);

		  // remove unwanted characters
		  $text = preg_replace('~[^-\w]+~', '', $text);

		  if (empty($text))
		  {
			return 'n-a';
		  }

		  return $text;
		}
	}

	if ( ! function_exists('strtonumber'))
	{
		function strtonumber($text)
		{
		  	$text = preg_replace("/[^0-9,.]/", "", $text);
        	$text = ltrim($text, '0');

		  return $text;
		}
	}

	if ( ! function_exists('slugPost'))
	{
		function slugPost($text)
		{
		  // replace non letter or digits by -
		  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

		  // trim
		  $text = trim($text, '-');

		  // transliterate
		  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		  // lowercase
		  $text = strtolower($text);

		  // remove unwanted characters
		  $text = preg_replace('~[^-\w]+~', '', $text);

		  if (empty($text))
		  {
			return 'n-a';
		  }

		  return $text;
		}
	}


	if ( ! function_exists('slugEditorpick'))
	{
		function slugEditorpick($text)
		{
		  // replace non letter or digits by -
		  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

		  // trim
		  $text = trim($text, '-');

		  // transliterate
		  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		  // lowercase
		  $text = strtolower($text);

		  // remove unwanted characters
		  $text = preg_replace('~[^-\w]+~', '', $text);

		  if (empty($text))
		  {
			return 'n-a';
		  }

		  return $text;
		}
	}


	if ( ! function_exists('_filterFromId'))
	{
		function _filterFromId($f_operator, $f_from_id)
	    {
	    	if (!empty($f_operator) && !empty($f_from_id))
	    	{
		        $filterFromId = $f_operator.$f_from_id;
	    	}
	    	else
	    	{
	    		$filterFromId = "";
	    	}

	        return $filterFromId;
	    }
	}


	if ( ! function_exists('is_numeric_array'))
	{
		function is_numeric_array($array)
		{
			foreach ($array as $a => $b) {
				if (!is_numeric($b)) {
					return false;
				}
			}
			return true;
		}
	}

	if ( ! function_exists('_mail'))
	{
		function _mail($to_email, $to_name, $subject, $content, $from_email, $from_name, $attach)
		{
			require_once APPPATH. 'third_party/phpmailer/class.phpmailer.php';
			$mail = new PHPMailer();
			$mail->IsMail();
			$mail->SetFrom($from_email, $from_name);
			$mail->AddAddress($to_email, $to_name);
			$mail->Subject  = $subject;
			$body  = $content;
			if(count($attach)>0) {
				foreach($attach as $r) {
					if($r["inline"]==true) {
						$cid = pathinfo($r["filename"], PATHINFO_FILENAME);
						$mail->AddEmbeddedImage($r["file"], $cid, $r["filename"]);
					} else {
						$mail->AddAttachment($r["file"], $r["filename"]);
					}
				}
			}
			$mail->MsgHTML($body);
			if(!$mail->Send()) {
				echo $mail->ErrorInfo;
				return false;
			} else return true;
		}
	}

	if ( ! function_exists('alphaID'))
	{
		function alphaID($in, $to_num = false, $pad_up = false, $pass_key = null)
		{
			$out   =   '';
			$index = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$base  = strlen($index);

			if ($pass_key !== null) {
				// Although this function's purpose is to just make the
				// ID short - and not so much secure,
				// with this patch by Simon Franz (http://blog.snaky.org/)
				// you can optionally supply a password to make it harder
				// to calculate the corresponding numeric ID

				for ($n = 0; $n < strlen($index); $n++) {
					$i[] = substr($index, $n, 1);
				}

				$pass_hash = hash('sha256',$pass_key);
				$pass_hash = (strlen($pass_hash) < strlen($index) ? hash('sha512', $pass_key) : $pass_hash);

				for ($n = 0; $n < strlen($index); $n++) {
					$p[] =  substr($pass_hash, $n, 1);
				}

				array_multisort($p, SORT_DESC, $i);
				$index = implode($i);
			}

			if ($to_num) {
				// Digital number  <<--  alphabet letter code
				$len = strlen($in) - 1;

				for ($t = $len; $t >= 0; $t--) {
					$bcp = bcpow($base, $len - $t);
					$out = $out + strpos($index, substr($in, $t, 1)) * $bcp;
				}

				if (is_numeric($pad_up)) {
					$pad_up--;

					if ($pad_up > 0) {
						$out -= pow($base, $pad_up);
					}
				}
			} else {
				// Digital number  -->>  alphabet letter code
				if (is_numeric($pad_up)) {
					$pad_up--;

					if ($pad_up > 0) {
						$in += pow($base, $pad_up);
					}
				}

				for ($t = ($in != 0 ? floor(log($in, $base)) : 0); $t >= 0; $t--) {
					$bcp = bcpow($base, $t);
					$a   = floor($in / $bcp) % $base;
					$out = $out . substr($index, $a, 1);
					$in  = $in - ($a * $bcp);
				}
			}

			return $out;
		}
	}

	/*----------------------------------------------------------------------*
    * indonesian_date                                              	   *
    * ~~~~~~~~~~~~~                                                        *
    *                                                                      *
    * Description   - function konversi ke tgl indonesia 					   *
    *                                                                      *
    * Change Request-                                            		   *
    * Specification -                                               	   *
    * Programmer    - Yansen                   					   *
    * Date          - 27.5.2016                                           *
    * Version       - 0.1                                                  *
    *----------------------------------------------------------------------*
    * @parameter_required = int
	* @param  int  $length
    *----------------------------------------------------------------------*
	 *----------------------------------------------------------------------*
    * @Output = String
    *----------------------------------------------------------------------*
    * Amendment History                                                    *
    * ~~~~~~~~~~~~~~~~~                                                    *
    * Ref | Date     | Programmer | Correction | Description               *
    * ~~~   ~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~   ~~~~~~~~~~~               *
    *           *
    *----------------------------------------------------------------------*/

	if( ! function_exists('indonesian_date'))
	{
		function indonesian_date($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = '')
		{
		    if (trim ($timestamp) == '')
		    {
		            $timestamp = time ();
		    }
		    elseif (!ctype_digit ($timestamp))
		    {
		        $timestamp = strtotime ($timestamp);
		    }
		    # remove S (st,nd,rd,th) there are no such things in indonesia :p
		    $date_format = preg_replace ("/S/", "", $date_format);
		    $pattern = array (
		        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
		        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
		        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
		        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
		        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
		        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
		        '/April/','/June/','/July/','/August/','/September/','/October/',
		        '/November/','/December/',
		    );
		    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
		        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
		        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
		        'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
		        'Oktober','November','Desember',
		    );
		    $date = date ($date_format, $timestamp);
		    $date = preg_replace ($pattern, $replace, $date);
		    $date = "{$date} {$suffix}";
		    return $date;
		}
	}

	/**
	  Function Ini untuk mengambil data buat dashboard welcome page
	  Yansen - 7 jun 2016
  	*/
	if( ! function_exists('encText'))
	{
	  function encText($text)
	  {
	    $salt = "c0d!g0_CrazyassLongSALTThatMakesYourUsersPasswordVeryLong123MYR!!312567__asdSdas";
	    $text = hash('sha256', $salt.$text);
	    return $text;
	  }
	}
	function hari_ini()
{
	$array_hari = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat", "Sabtu","Minggu");
	$hari = $array_hari[date("N")];
	return $hari;
}

function bulan_ini()
{
	$array_bulan = array(1=>"Januari","Februari","Maret", "April", "Mei", "Juni","Juli","Agustus","September","Oktober", "November","Desember");
	$bulan = $array_bulan[date("n")];
	return $bulan;
}
