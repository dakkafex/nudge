<?php

// Live environment
$projectKey = 'at5-app-live'; //provided by Triple IT
$sharedSecret = 'tvxTcWUKH4jiEjwKAuLs3Vl9F1dxaeLJtxBv4T9Ro4FwtPfRZ7TS2KcXKNafKmZV'; //provided by Triple IT

// Dev environment
// $projectKey = 'at5-app-dev'; //provided by Triple IT
// $sharedSecret = 'oSrQk1x3Q19172gM0aHhkNhGFGAb5yY2wxmZhe3Zxd5F7KqjvG5Ev1GdjHA2XzEH'; //provided by Triple IT

// Service URL to Triple Nudge server
$serviceUrl = 'https://nudge.triple-it.nl';

// Includes
require_once 'SplClassLoader.php';
$classLoader = new SplClassLoader();
$classLoader->register();

// This is where the magic happens
try {
    $c = new TripleIT_Nudge_Client_Client($projectKey, $sharedSecret, $serviceUrl);

    $type = 'genericjob';
    $push_message = 'AT5 Testbericht'; // The actual message
    $post_id = '144978'; // Dynamic var, replace this with a post id

    if($type == 'genericjob'){
        $genericJobRequest = new TripleIT_Nudge_Client_GenericSendPushJobRequest();
        $genericJobRequest->Alert = $push_message; // The Push message
        $genericJobRequest->Sound = true;
        $genericJobRequest->CustomData[] = new TripleIT_Nudge_Common_CustomKeyValue('post_id', $post_id); // Custom data from dynamic var
        $genericJobRequest->ExpiryUtcDateTime = date('Y-m-d\TH:i:s', time() + 3600);
        $genericJobRequest->Query = ''; // Possible to, for example, only targer ios
        $result = $c->sendGenericJob($genericJobRequest);
    } else
    {
        echo "Incorrect test command \r\n";
    }
    
    if ($result)
    {
        echo "Request performed succesfully: \r\n";
        print_r($result);
    }
} catch (Exception $e) {
    echo 'Request failed: ' . $e->getMessage();
}

?>