<?php

namespace API;

class Endpoints
{
    public string $request_method;
    public string $slack_name;
    public string $track;
    public string $github_file_url;
    public string $github_repo_url;

    public function __construct($slack_name, $track, $github_file_url, $github_repo_url){
        $this->slack_name = $slack_name;
        $this->track = $track;
        $this->github_file_url = $github_file_url;
        $this->github_repo_url = $github_repo_url;
    }

    public function get_request_response(){

        $utc_time = gmdate("Y-m-d\TH:i:s\Z");
        $current_day = gmdate("l");
        $status_code = 200;
        $response = array(
            "slack_name"=> $this->slack_name,
            "current_day"=> $current_day,
            "utc_time"=> $utc_time,
            "track"=> $this->track,
            "github_file_url"=> $this->github_file_url,
            "github_repo_url"=> $this->github_repo_url,
            "status_code"=> $status_code
        );
        return json_encode($response);
    }
}