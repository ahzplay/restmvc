<?php

class ApiGate {

    private $apiKey;
    function __construct()
    {
        $this->apiKey = "theblueschelseaisthebest";

    }
    public function validate($mandatoryFields, $method)
    {
        $this->checkHeaders();
        if(strtolower($_SERVER['REQUEST_METHOD']) != $method) {
            echo json_encode($this->response(5, 405)); die();
        }
        if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->mandatoryFields($mandatoryFields);
        }
        return $this->response(1,200);
    }

    public function mandatoryFields($fields=array())
    {
        $i = 0;
        foreach ($fields as $val_mandatory) {
            foreach ($_POST as $key => $val) {
                if ($val_mandatory == $key) {
                    if (empty($_POST[$key])) {
                        return $this->response(4, 200);
                    }
                    $i++;
                }
            }
        }
        if ($i != sizeof($fields)) {
            echo json_encode($this->response(4, 200));
            die();
        } else {}
    }

    private function checkHeaders()
    {
        $headers = apache_request_headers();
        if(!isset($headers['api-key'])) {
            echo json_encode($this->response(3, 401)); die();
        }
        if($headers['api-key'] != $this->apiKey){
            echo json_encode($this->response(3, 401)); die();
        } else {}
    }

    public function response($flag, $http_status) {
        $response = array();
        switch ($flag) {
            case 1 :
                $response = array(
                    'status' => 1,
                    'message' => 'Request accepted',
                );
                break;
            case 2 :
                $response = array(
                    'status' => 0,
                    'message' => 'Request Rejected',
                );
                break;
            case 3 :
                $response = array(
                    'status' => 0,
                    'message' => 'Invalid api key',
                );
                break;
            case 4 :
                $response = array(
                    'status' => 0,
                    'message' => 'Mandatory fields is not complete',
                );
                break;
            case 5 :
                $response = array(
                    'status' => 0,
                    'message' => 'Method '.$_SERVER['REQUEST_METHOD'].' is not allowed',
                );
                break;
        }
        http_response_code($http_status);
        return $response;
    }

    public function customResponse($status, $message, $data=array()) {
        echo json_encode(array(
            'status' => $status,
            'message' => $message,
            'data' => $data
        ));
    }
}