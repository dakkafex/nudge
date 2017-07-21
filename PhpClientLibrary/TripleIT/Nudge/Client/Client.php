<?php

/*
 * Client object to communicate with Nudge
 */
class TripleIT_Nudge_Client_Client
{
    private $_projectKey;
    private $_sharedSecret;
    private $_serviceBaseUrl;

    private $_initCalled = false;
    private $_serverTimeOffset = 0;
    private $_maxBatchSize = 50000;

    /*
     * Creates a client for Nudge
     * 
     * @param string $projectKey The key of the project you want to send push notifications for. Supplied by Triple IT
     * @param string $sharedSecret The associated secret key required for sending push notifications. Supplied by Triple IT
     * @param string $serviceBaseUrl The base url of the notification service. Typically https://nudge.triple-it.nl
     */
    public function __construct($projectKey, $sharedSecret, $serviceBaseUrl)
    {
        date_default_timezone_set('UTC');
        $this->_projectKey = $projectKey;
        $this->_sharedSecret = $sharedSecret;
        $this->_serviceBaseUrl = $serviceBaseUrl;
    }

    private function currentServerUnixTime()
    {
        return time() + $this->_serverTimeOffset;
    }

    /*
     * Call this function to enable tokens that are currently in the rejected token list. No push notifications are sent to devices whos tokens are in the rejected token list
     * If you are not sure a token is in the rejected token list, you can still call this function to make sure it isn't
     * The total amount of push tokens that can be sent is 50000. Please use TripleIT.Nudge.Common.Tools.GetPushTokenBatches(pushTokens, maxBatchSize) to split a list up in batches when needed
     *
     * @param array $iosPushTokens A list of iOS push tokens that should be enabled. E.g. removed from the rejected token list
     * @param array $androidPushTokens A list of Android push tokens that should be enabled. E.g. removed from the rejected token list
     * @param array $windowsPushTokens A list of Windows push tokens that should be enabled. E.g. removed from the rejected token list
     * @param array $windowsPhonePushTokens A list of Windows Phone push tokens that should be enabled. E.g. removed from the rejected token list
     */
    public function enableTokens($iosPushTokens, $androidPushTokens, $windowsPushTokens, $windowsPhonePushTokens)
    {
        if (count($iosPushTokens) + count($androidPushTokens) + count($windowsPushTokens) + count($windowsPhonePushTokens) > $this->_maxBatchSize)
        {
            throw new InvalidArgumentException('The total amount of push tokens for 1 request is exceeded (' . $this->_maxBatchSize . '). Please use TripleIT_Nudge_Common_Tools::getPushTokenBatches($pushTokens, $maxBatchSize) to split a list up into batches');
        }
    
        if (!$this->_initCalled) $this->init();

        $enableRequest = new TripleIT_Nudge_Client_EnableRequest();
        $enableRequest->IOSPushTokens = $iosPushTokens;
        $enableRequest->AndroidPushTokens = $androidPushTokens;
        $enableRequest->WindowsPushTokens = $windowsPushTokens;
        $enableRequest->WindowsPhonePushTokens = $windowsPhonePushTokens;
        $enableRequest->ProjectKey = $this->_projectKey;
        $enableRequest->UtcTimestamp = $this->currentServerUnixTime();

        $request = new TripleIT_Nudge_Client_JsonRequest($this->_serviceBaseUrl, '/API/Enable', $this->_sharedSecret, $enableRequest);
        $request->performRequest(null);
    }

    /*
     * Send a generic push notification, that is supported for all platforms
     * The total amount of push tokens that can be sent is 50000. Please use TripleIT.Nudge.Common.Tools.GetPushTokenBatches(pushTokens, maxBatchSize) to split a list up in batches when needed
     *
     * @param TripleIT_Nudge_Client_GenericSendPushRequest $request The generic request object, containing the specifics for the push notification to send
     *
     * @return TripleIT_Nudge_Server_SendPushResponse The response from the push service possibly containing push tokens that are rejected
     */
    public function sendGeneric($request)
    {
        if (count($request->IOSPushTokens) + count($request->AndroidPushTokens) + count($request->WindowsPushTokens) + count($request->WindowsPhonePushTokens) > $this->_maxBatchSize)
        {
            throw new InvalidArgumentException('The total amount of push tokens for 1 request is exceeded (' . $this->_maxBatchSize . '). Please use TripleIT_Nudge_Common_Tools::getPushTokenBatches($pushTokens, $maxBatchSize) to split a list up into batches');
        }
    
        if (!$this->_initCalled) $this->init();

        $request->ProjectKey = $this->_projectKey;
        $request->UtcTimestamp = $this->currentServerUnixTime();
        $clientRequest = new TripleIT_Nudge_Client_JsonRequest($this->_serviceBaseUrl, '/API/Send/Generic', $this->_sharedSecret, $request);

        return $clientRequest->performRequest('TripleIT_Nudge_Server_SendPushResponse');
    }

    /*
     * Send a generic push notification, that is supported for all platforms
     * The total amount of push tokens that can be sent is 50000. Please use TripleIT.Nudge.Common.Tools.GetPushTokenBatches(pushTokens, maxBatchSize) to split a list up in batches when needed
     * 
     * @param array $iosPushTokens The iOS tokens to send the notification for
     * @param array $androidPushTokens The Android tokens to send the notification for
     * @param array $windowsPushTokens The iOS tokens to send the notification for
     * @param array $alert The message to send
     * 
     * @return TripleIT_Nudge_Server_SendPushResponse The response from the push service possibly containing push tokens that are rejected
     */
    public function sendGenericSimple($iosPushTokens, $androidPushTokens, $windowsPushTokens, $windowsPhonePushTokens, $alert)
    {
        if (count($iosPushTokens) + count($androidPushTokens) + count($windowsPushTokens) + count($windowsPhonePushTokens) > $this->_maxBatchSize)
        {
            throw new InvalidArgumentException('The total amount of push tokens for 1 request is exceeded (' . $this->_maxBatchSize . '). Please use TripleIT_Nudge_Common_Tools::getPushTokenBatches($pushTokens, $maxBatchSize) to split a list up into batches');
        }
    
        if (!$this->_initCalled) $this->init();

        $sendGenericRequest = new TripleIT_Nudge_Client_GenericSendPushRequest();
        $sendGenericRequest->IOSPushTokens = $iosPushTokens;
        $sendGenericRequest->AndroidPushTokens = $androidPushTokens;
        $sendGenericRequest->WindowsPushTokens = $windowsPushTokens;
        $sendGenericRequest->WindowsPhonePushTokens = $windowsPhonePushTokens;
        $sendGenericRequest->Alert = $alert;
        $sendGenericRequest->Sound = true;
        $sendGenericRequest->ExpiryUtcDateTime = date('Y-m-d\TH:i:s', time() + 3600);
        $sendGenericRequest->ProjectKey = $this->_projectKey;
        $sendGenericRequest->UtcTimestamp = $this->currentServerUnixTime();

        $clientRequest = new TripleIT_Nudge_Client_JsonRequest($this->_serviceBaseUrl, '/API/Send/Generic', $this->_sharedSecret, $sendGenericRequest);

        return $clientRequest->performRequest('TripleIT_Nudge_Server_SendPushResponse');
    }

    /*
     * Send a generic push notification, that is supported for all platforms
     * 
     * @param TripleIT_Nudge_Client_IOSSendPushRequest $request The generic request object, containing the specifics for the push notification to send
     * 
     * @return TripleIT_Nudge_Server_SendPushResponse The response from the push service possibly containing push tokens that are rejected
     */
    public function sendGenericJob($request)
    {
        if (!$this->_initCalled) $this->init();

        $request->ProjectKey = $this->_projectKey;
        $request->UtcTimestamp = $this->currentServerUnixTime();
        $clientRequest = new TripleIT_Nudge_Client_JsonRequest($this->_serviceBaseUrl, '/API/Send/GenericJob', $this->_sharedSecret, $request);

        return $clientRequest->performRequest('TripleIT_Nudge_Server_SendPushResponse');
    }
    
    
    /*
     * Send an iOS push notification
     * The total amount of push tokens that can be sent is 50000. Please use TripleIT.Nudge.Common.Tools.GetPushTokenBatches(pushTokens, maxBatchSize) to split a list up in batches when needed
     * 
     * @param TripleIT_Nudge_Client_IOSSendPushRequest $request The iOS request object, containing the specifics for the push notification to send
     * 
     * @return TripleIT_Nudge_Server_SendPushResponse The response from the push service possibly containing push tokens that are rejected
     */
    public function sendIOS($request)
    {
        if (count($request->PushTokens) > $this->_maxBatchSize)
        {
            throw new InvalidArgumentException('The total amount of push tokens for 1 request is exceeded (' . $this->_maxBatchSize . '). Please use TripleIT_Nudge_Common_Tools::getPushTokenBatches($pushTokens, $maxBatchSize) to split a list up into batches');
        }
        
        if (!$this->_initCalled) $this->init();

        $request->ProjectKey = $this->_projectKey;
        $request->UtcTimestamp = $this->currentServerUnixTime();
        $clientRequest = new TripleIT_Nudge_Client_JsonRequest($this->_serviceBaseUrl, '/API/Send/IOS', $this->_sharedSecret, $request);

        return $clientRequest->performRequest('TripleIT_Nudge_Server_SendPushResponse');
    }

    /*
     * Send a simple iOS push notification
     * The total amount of push tokens that can be sent is 50000. Please use TripleIT.Nudge.Common.Tools.GetPushTokenBatches(pushTokens, maxBatchSize) to split a list up in batches when needed
     * 
     * @param array $pushTokens The iOS tokens to send the notification for
     * @param array $alert The message to send
     * 
     * @return TripleIT_Nudge_Server_SendPushResponse The response from the push service possibly containing push tokens that are rejected
     */
    public function sendIOSSimple($pushTokens, $alert)
    {
        if (count($pushTokens) > $this->_maxBatchSize)
        {
            throw new InvalidArgumentException('The total amount of push tokens for 1 request is exceeded (' . $this->_maxBatchSize . '). Please use TripleIT_Nudge_Common_Tools::getPushTokenBatches($pushTokens, $maxBatchSize) to split a list up into batches');
        }
        
        if (!$this->_initCalled) $this->init();

        $sendIOSRequest = new TripleIT_Nudge_Client_IOSSendPushRequest();
        $sendIOSRequest->PushTokens = $pushTokens;
        $sendIOSRequest->Alert = $alert;
        $sendIOSRequest->Sound = true;
        $sendIOSRequest->ExpiryUtcDateTime = date('Y-m-d\TH:i:s', time() + 3600);
        $sendIOSRequest->ProjectKey = $this->_projectKey;
        $sendIOSRequest->UtcTimestamp  =$this->currentServerUnixTime();

        $clientRequest = new TripleIT_Nudge_Client_JsonRequest($this->_serviceBaseUrl, '/API/Send/IOS', $this->_sharedSecret, $sendIOSRequest);

        return $clientRequest->performRequest('TripleIT_Nudge_Server_SendPushResponse');
    }

    /*
     * Send an Android push notification
     * The total amount of push tokens that can be sent is 50000. Please use TripleIT.Nudge.Common.Tools.GetPushTokenBatches(pushTokens, maxBatchSize) to split a list up in batches when needed
     * 
     * @param TripleIT_Nudge_Client_AndroidSendPushRequest $request The Android request object, containing the specifics for the push notification to send
     * 
     * @return TripleIT_Nudge_Server_SendPushResponse The response from the push service possibly containing push tokens that are rejected
     */
    public function sendAndroid($request)
    {
        if (count($request->PushTokens) > $this->_maxBatchSize)
        {
            throw new InvalidArgumentException('The total amount of push tokens for 1 request is exceeded (' . $this->_maxBatchSize . '). Please use TripleIT_Nudge_Common_Tools::getPushTokenBatches($pushTokens, $maxBatchSize) to split a list up into batches');
        }
        
        if (!$this->_initCalled) $this->init();

        $request->ProjectKey = $this->_projectKey;
        $request->UtcTimestamp = $this->currentServerUnixTime();
        $clientRequest = new TripleIT_Nudge_Client_JsonRequest($this->_serviceBaseUrl, '/API/Send/Android', $this->_sharedSecret, $request);

        return $clientRequest->performRequest('TripleIT_Nudge_Server_SendPushResponse');
    }

    /*
     * Send a simple Android push notification
     * The total amount of push tokens that can be sent is 50000. Please use TripleIT.Nudge.Common.Tools.GetPushTokenBatches(pushTokens, maxBatchSize) to split a list up in batches when needed
     * 
     * @param array $pushTokens The Android tokens to send the notification for
     * @param array $alert The message to send
     * 
     * @return TripleIT_Nudge_Server_SendPushResponse The response from the push service possibly containing push tokens that are rejected
     */
    public function sendAndroidSimple($pushTokens, $alert)
    {
        if (count($pushTokens) > $this->_maxBatchSize)
        {
            throw new InvalidArgumentException('The total amount of push tokens for 1 request is exceeded (' . $this->_maxBatchSize . '). Please use TripleIT_Nudge_Common_Tools::getPushTokenBatches($pushTokens, $maxBatchSize) to split a list up into batches');
        }
        
        if (!$this->_initCalled) $this->init();

        $sendAndroidRequest = new TripleIT_Nudge_Client_AndroidSendPushRequest();
        $sendAndroidRequest->PushTokens = $pushTokens;
        $sendAndroidRequest->Alert = $alert;
        $sendAndroidRequest->Sound = true;
        $sendAndroidRequest->ExpiryUtcDateTime = date('Y-m-d\TH:i:s', time() + 3600);
        $sendAndroidRequest->ProjectKey = $this->_projectKey;
        $sendAndroidRequest->UtcTimestamp = $this->currentServerUnixTime();
        $clientRequest = new TripleIT_Nudge_Client_JsonRequest($this->_serviceBaseUrl, '/API/Send/Android', $this->_sharedSecret, $sendAndroidRequest);

        return $clientRequest->performRequest('TripleIT_Nudge_Server_SendPushResponse');
    }
    
    /*
     * Send a Windows push notification
     * The total amount of push tokens that can be sent is 50000. Please use TripleIT.Nudge.Common.Tools.GetPushTokenBatches(pushTokens, maxBatchSize) to split a list up in batches when needed
     * 
     * @param TripleIT_Nudge_Client_WindowsSendPushRequest $request The Windows request object, containing the specifics for the push notification to send
     * 
     * @return TripleIT_Nudge_Server_SendPushResponse The response from the push service possibly containing push tokens that are rejected
     */
    public function sendWindows($request)
    {
        if (count($request->PushTokens) > $this->_maxBatchSize)
        {
            throw new InvalidArgumentException('The total amount of push tokens for 1 request is exceeded (' . $this->_maxBatchSize . '). Please use TripleIT_Nudge_Common_Tools::getPushTokenBatches($pushTokens, $maxBatchSize) to split a list up into batches');
        }
        
        if (!$this->_initCalled) $this->init();

        $request->ProjectKey = $this->_projectKey;
        $request->UtcTimestamp = $this->currentServerUnixTime();
        $clientRequest = new TripleIT_Nudge_Client_JsonRequest($this->_serviceBaseUrl, '/API/Send/Windows', $this->_sharedSecret, $request);

        return $clientRequest->performRequest('TripleIT_Nudge_Server_SendPushResponse');
    }

    /*
     * Send a simple Windows push notification
     * The total amount of push tokens that can be sent is 50000. Please use TripleIT.Nudge.Common.Tools.GetPushTokenBatches(pushTokens, maxBatchSize) to split a list up in batches when needed
     * 
     * @param array $pushTokens The Windows tokens to send the notification for
     * @param array $alert The message to send
     * 
     * @return TripleIT_Nudge_Server_SendPushResponse The response from the push service possibly containing push tokens that are rejected
     */
    public function sendWindowsSimple($pushTokens, $alert)
    {
        if (count($pushTokens) > $this->_maxBatchSize)
        {
            throw new InvalidArgumentException('The total amount of push tokens for 1 request is exceeded (' . $this->_maxBatchSize . '). Please use TripleIT_Nudge_Common_Tools::getPushTokenBatches($pushTokens, $maxBatchSize) to split a list up into batches');
        }
        
        if (!$this->_initCalled) $this->init();

        $sendWindowsRequest = new TripleIT_Nudge_Client_WindowsSendPushRequest();
        $sendWindowsRequest->PushTokens = $pushTokens;
        $sendWindowsRequest->Alert = $alert;
        $sendWindowsRequest->Sound = true;
        $sendWindowsRequest->SoundType = TripleIT_Nudge_Client_WnsSoundType::Normal;
        $sendWindowsRequest->ToastTemplate = TripleIT_Nudge_Client_WnsToastTemplate::ToastText01;
        $sendWindowsRequest->ExpiryUtcDateTime = date('Y-m-d\TH:i:s', time() + 3600);
        $sendWindowsRequest->ProjectKey = $this->_projectKey;
        $sendWindowsRequest->UtcTimestamp = $this->currentServerUnixTime();
        $clientRequest = new TripleIT_Nudge_Client_JsonRequest($this->_serviceBaseUrl, '/API/Send/Windows', $this->_sharedSecret, $sendWindowsRequest);

        return $clientRequest->performRequest('TripleIT_Nudge_Server_SendPushResponse');
    }
    
    /*
     * Send a Windows Phone push notification
     * The total amount of push tokens that can be sent is 50000. Please use TripleIT.Nudge.Common.Tools.GetPushTokenBatches(pushTokens, maxBatchSize) to split a list up in batches when needed
     * 
     * @param TripleIT_Nudge_Client_WindowsPhoneSendPushRequest $request The Windows Phone request object, containing the specifics for the push notification to send
     * 
     * @return TripleIT_Nudge_Server_SendPushResponse The response from the push service possibly containing push tokens that are rejected
     */
    public function sendWindowsPhone($request)
    {
        if (count($request->PushTokens) > $this->_maxBatchSize)
        {
            throw new InvalidArgumentException('The total amount of push tokens for 1 request is exceeded (' . $_maxBatchSize . '). Please use TripleIT_Nudge_Common_Tools::getPushTokenBatches($pushTokens, $maxBatchSize) to split a list up into batches');
        }
        
        if (!$this->_initCalled) $this->init();

        $request->ProjectKey = $this->_projectKey;
        $request->UtcTimestamp = $this->currentServerUnixTime();
        $clientRequest = new TripleIT_Nudge_Client_JsonRequest($this->_serviceBaseUrl, '/API/Send/WindowsPhone', $this->_sharedSecret, $request);

        return $clientRequest->performRequest('TripleIT_Nudge_Server_SendPushResponse');
    }

    /*
     * Send a simple Windows Phone push notification
     * The total amount of push tokens that can be sent is 50000. Please use TripleIT.Nudge.Common.Tools.GetPushTokenBatches(pushTokens, maxBatchSize) to split a list up in batches when needed
     * 
     * @param array $pushTokens The Windows Phone tokens to send the notification for
     * @param array $alert The message to send
     * 
     * @return TripleIT_Nudge_Server_SendPushResponse The response from the push service possibly containing push tokens that are rejected
     */
    public function sendWindowsPhoneSimple($pushTokens, $alert)
    {
        if (count($pushTokens) > $this->_maxBatchSize)
        {
            throw new InvalidArgumentException('The total amount of push tokens for 1 request is exceeded (' . $_maxBatchSize . '). Please use TripleIT_Nudge_Common_Tools::getPushTokenBatches($pushTokens, $maxBatchSize) to split a list up into batches');
        }
        
        if (!$this->_initCalled) $this->init();

        $sendWindowsPhoneRequest = new TripleIT_Nudge_Client_WindowsPhoneSendPushRequest();
        $sendWindowsPhoneRequest->PushTokens = $pushTokens;
        $sendWindowsPhoneRequest->Alert = $alert;
        $sendWindowsPhoneRequest->ProjectKey = $this->_projectKey;
        $sendWindowsPhoneRequest->UtcTimestamp = $this->currentServerUnixTime();
        $clientRequest = new TripleIT_Nudge_Client_JsonRequest($this->_serviceBaseUrl, '/API/Send/WindowsPhone', $this->_sharedSecret, $sendWindowsPhoneRequest);

        return $clientRequest->performRequest('TripleIT_Nudge_Server_SendPushResponse');
    }
    
    private function Init()
    {
        $ch = curl_init($this->_serviceBaseUrl . "/API/Init");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        if (curl_error($ch)) {
            throw new Exception("Could not init communication: " . curl_error($ch));
        }
        curl_close($ch);
        
        $jsonObject = json_decode($response);
        $apiResponse = TripleIT_Nudge_Server_ApiResponse::fromJsonObject($jsonObject);

        if ($apiResponse->responseCode == 200) {
            $this->_initCalled = true;
            $this->_serverTimeOffset = $apiResponse->timestamp - time();
        }
    }
}
?>