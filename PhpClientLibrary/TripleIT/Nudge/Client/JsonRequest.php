<?php

class TripleIT_Nudge_Client_JsonRequest {

    private $_serviceBaseUrl = null;
    private $_method = null;
    private $_json = null;

    public function __construct($serviceBaseUrl, $method, $sharedSecret, $request) {
        $this->_serviceBaseUrl = $serviceBaseUrl;
        $this->_method = $method;
        
        $request->Salt = TripleIT_Nudge_Common_Tools::getGUID();
        $sig = $method . ";" . $request->ProjectKey . ";" . $request->UtcTimestamp . ";" . $sharedSecret . ";" . $request->Salt;
        $sha1 = sha1($sig);
        $request->Signature = strtoupper($sha1);
        
        $this->_json = json_encode($request);
    }

    public function performRequest($responseObjectClassName) {
        $ch = curl_init($this->_serviceBaseUrl . $this->_method);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($this->_json))
        );
        $response = curl_exec($ch);

        // Check if any error occured
        if(curl_errno($ch))
        {
            $result = new TripleIT_Nudge_Server_ApiResponse();
            $result->responseCode = TripleIT_Nudge_Server_ApiResponseCode::ERROR;
            $result->responseKey = 'CurlError: ' . curl_error($ch);
            curl_close($ch);
            return $result;
        }

        curl_close($ch);
        
        $jsonObject = json_decode($response);
        $apiResponse = TripleIT_Nudge_Server_ApiResponse::fromJsonObject($jsonObject);

        if ($apiResponse->responseCode != 200) throw new TripleIT_Nudge_Common_PushNotificationServiceException($apiResponse->responseCode, $apiResponse->responseKey);

        if($responseObjectClassName != null) {
            $responseObject = new $responseObjectClassName;
            $apiResponse->responseObject = $responseObject->fromJsonObject($apiResponse->responseObject);
        }
        
        return $apiResponse->responseObject;
    }

}

?>