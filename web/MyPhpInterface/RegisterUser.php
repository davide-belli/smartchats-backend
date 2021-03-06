<?php 
 require_once 'DbOperation.php';
 $response = array(); 
 
 if($_SERVER['REQUEST_METHOD']=='POST'){
	 
	 $token = $_POST['token'];
	 $fbid = $_POST['fbid'];
	 $name = $_POST['name'];
	 $version = $_POST['version'];
	 
	 $db = new DbOperation(); 

	 if($db->checkVersion($version)){
	 
		 $result = $db->registerDevice($fbid,$token,$name);
		 
		 if($result == 0){
			 $response['error'] = false; 
			 $response['message'] = 'New account registered';
		 }elseif($result == 2){
			 $response['error'] = false; 
			 $response['message'] = 'New Device registered successfully for existing account';
		 }else{
			 $response['error'] = true;
			 $response['message']='Registration failed';
		 } 

	 }else {
		$response['error'] = true; 
		$response['message'] = 'Outdated Client Version!';
	 }
 }else{
	 $response['error']=true;
	 $response['message']='Invalid Request...';
 }
 
 echo json_encode($response);