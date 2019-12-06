<?php
function deliver_response($response){
	// Define HTTP responses
	$http_response_code = array(
		100 => 'Continue',
		101 => 'Switching Protocols',
		200 => 'OK',
		201 => 'Created',
		202 => 'Accepted',
		203 => 'Non-Authoritative Information',
		204 => 'No Content',
		205 => 'Reset Content',
		206 => 'Partial Content',
		300 => 'Multiple Choices',
		301 => 'Moved Permanently',
		302 => 'Found',
		303 => 'See Other',
		304 => 'Not Modified',
		305 => 'Use Proxy',
		306 => '(Unused)',
		307 => 'Temporary Redirect',
		400 => 'Bad Request',
		401 => 'Unauthorized',
		402 => 'Payment Required',
		403 => 'Forbidden',
		404 => 'Not Found',
		405 => 'Method Not Allowed',
		406 => 'Not Acceptable',
		407 => 'Proxy Authentication Required',
		408 => 'Request Timeout',
		409 => 'Conflict',
		410 => 'Gone',
		411 => 'Length Required',
		412 => 'Precondition Failed',
		413 => 'Request Entity Too Large',
		414 => 'Request-URI Too Long',
		415 => 'Unsupported Media Type',
		416 => 'Requested Range Not Satisfiable',
		417 => 'Expectation Failed',
		500 => 'Internal Server Error',
		501 => 'Not Implemented',
		502 => 'Bad Gateway',
		503 => 'Service Unavailable',
		504 => 'Gateway Timeout',
		505 => 'HTTP Version Not Supported'
		);

  header("Access-Control-Request-Method: PUT");
  header("Access-Control-Allow-Origin: *");
	// Set HTTP Response
	header('HTTP/1.1 '.$response['status'].' '.$http_response_code[ $response['status'] ]);
	// Set HTTP Response Content Type
	header('Content-Type: application/json; charset=utf-8');
	// Format data into a JSON response
	$json_response = json_encode($response['data']);
	// Deliver formatted data
	print_r($json_response);
	exit;
}
// Set default HTTP response of 'Not Found'
$response['status'] = 404;
$response['data'] = NULL;
$url_array = explode('/', $_SERVER['REQUEST_URI']);
array_shift($url_array); // remove first value as it's empty
// remove 2nd and 3rd array, because it's directory
array_shift($url_array); // 2nd = 'NativeREST'
array_shift($url_array); // 3rd = 'api'
// get the action (resource, collection)
$action = $url_array[0];
// get the method
$method = $_SERVER['REQUEST_METHOD'];
include("pripojenie.php");
$miestnost = new Miestnost();
if ($method == 'GET') {
  //if(!isset($url_array[1])){
    $data = $miestnost->getData();
    $data = $url_array[1];
    $response['status'] = 200;
    $response['data'] = $data;
//}

  /*}else{
      $id=$url_array[1];
			$data=$miestnost->getDataById($id);
			if(empty($data)) {
				$response['status'] = 404;
				$response['data'] = array('error' => 'Zaznam nenajdeny');
			}else{
				$response['status'] = 200;
				$response['data'] = $data;
  }*/
}else if($method == 'POST' ){
  $json = $_POST['miestnost'];
  //$post = json_decode($json);
  $status = $miestnost->createData($json);
  if($status == 1){
    $response['status'] = 201;
    $response['data'] = array('success' => 'Data úspešne uložené');
  }else{
    $response['status'] = 400;
		$response['data'] = array('error' => 'Neuspešné nahravanie');
  }
}else if($method == 'PUT'){
  if(isset($url_array[1])){
			$id = $url_array[1];
			// check if idBarang exist in database
			$data=$miestnost->getDataById($id);
			if(empty($data)) {
				$response['status'] = 404;
				$response['data'] = array('error' => 'Chyba zapisu');
			}else{
				// get post from client
				$json = file_get_contents('php://input');
				$post = json_decode($json); // decode to object
				// check input completeness
				if($post->miestnost==""){
					$response['status'] = 400;
					$response['data'] = array('error' => 'Chyba zapisu');
				}else{
					$status = $barang->updateData($id, $post->miestnost);
					if($status==1){
						$response['status'] = 200;
						$response['data'] = array('success' => 'Uspešne upravené');
					}else{
						$response['status'] = 400;
						$response['data'] = array('error' => 'Chyba zapisu');
					}
				}
			}
		}
}

deliver_response($response);

 ?>
