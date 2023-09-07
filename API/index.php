<?php

namespace API;

use DateTime;

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
    
    private function validate_date($date, $format){
        $date_created = DateTime::createFromFormat($format, $date);
        return $date_created && $date_created->format($format) == $date;
    }

    public function get_request_response(){

        $utc_time = ($this->validate_date(gmdate("Y-m-d\TH:i:s\Z"), "Y-m-d\TH:i:s\Z") === true)?gmdate("Y-m-d\TH:i:s\Z"):'Date Validation failed';
        $current_day = ($this->validate_date(gmdate("l"), 'l') === true)?gmdate("l"):'Day Validation failed';
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