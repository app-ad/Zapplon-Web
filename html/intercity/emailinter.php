<?php
    session_start();
    include("conf.php");
		include('Contents/includes/config_class.php');
		//echo "sending request;";
		error_reporting(E_ALL);
		ini_set("display_errors", "1");
		require_once('../utils/Http2.php');
		$r = new HttpRequest("post", $GLOBALS['server_url']auth/login?isFacebookLogin=true&device_id=00000000", array(
        "client_id" => 'bt_android_client',
        "app_type" => 'bt_android',
        "user_name" => $_SESSION['name'],
        "email" => $_GET['email'],
		    "fb_token" => $_GET['t']
      //  "fbid" => $_GET['id']
    	));
  		if ($r->getError()) {
      	echo "sorry, an error occured";
  		}	 
  		else {
  			//echo "got rsponse";
      	// parse json and show tweets
        $js = json_decode($r->getResponse());
      	//var_dump($js);
       	$obj=$js->response;
       	$res=json_decode($obj);
       	$access_token=$res->access_token;
      // 	var_dump($access_token);
       	//echo $access_token;

		$_SESSION['token']=$access_token;
		$_SESSION['email']=$_GET['email'];
    $url=$GLOBALS['localhost']."intercity";
    header('Location: '. $url);
        }     
?>