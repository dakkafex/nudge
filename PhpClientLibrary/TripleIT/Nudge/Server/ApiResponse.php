<?php

/*
 * Object that can hold the response of Nudge
 */
class TripleIT_Nudge_Server_ApiResponse {
    public $responseCode;
    public $responseKey;
    public $responseObject;
    public $timestamp;

    public function __construct() {
        $this->responseCode = TripleIT_Nudge_Server_ApiResponseCode::OK;
        $this->responseKey = 'OK';
        $this->responseObject = null;
        $this->timestamp = time();
    }

    public static function fromJsonObject($jsonObject) {
        $result = new self();
        if($jsonObject){
            $result->responseCode = $jsonObject->rc;
            $result->responseKey = $jsonObject->rk;
            $result->responseObject = $jsonObject->ro;
            $result->timestamp = $jsonObject->rt;
        }else{
            $result->responseCode = TripleIT_Nudge_Server_ApiResponseCode::ERROR;
            $result->responseKey = 'EmptyResponse';
            $result->responseObject = null;
            $result->timestamp = time();
        }
        return $result;
    }

}

?>