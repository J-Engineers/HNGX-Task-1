<?php
require_once "API/index.php";

use API\Endpoints;

$github_file_url = "https://github.com/J-Engineers/HNGX-Task-1/blob/main/API/index.php";
$github_repo_url = "https://github.com/J-Engineers/HNGX-Task-1";


$return = false;
$status_code = 404;
$status_massage = 'Bad Request. Failed!';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $return = false;
    $status_code = 400;
    $status_massage = 'The request URL should include two parameter named slack_name  and track';
    if(isset($_GET['slack_name']) && isset($_GET['track'])){
        
        $slack_name = $_GET['slack_name'];
        $track = $_GET['track'];
        
        $return = false;
        $status_code = 400;
        $status_massage = 'The two parameters passed should have at least 1 character as a value each';
        if(strlen($slack_name) > 0 && strlen($track) > 0){
            $return = true;
            $status_code = 400;
            $status_massage = '';
        }
    }
}

if($return === true){
    $endpoints = new Endpoints($slack_name, $track, $github_file_url, $github_repo_url);
    echo str_replace("\\", "", $endpoints->get_request_response());
}else{
    $response = array(
        "status_code"=> $status_code,
        "status_massage"=> $status_massage,
    );
    echo json_encode($response);
}