<?php

// $projectKey = 'at5-app-live'; //provided by Triple IT
// $sharedSecret = 'tvxTcWUKH4jiEjwKAuLs3Vl9F1dxaeLJtxBv4T9Ro4FwtPfRZ7TS2KcXKNafKmZV'; //provided by Triple IT
// $serviceUrl = 'https://nudge.triple-it.nl';

$projectKey = 'at5-app-dev'; //provided by Triple IT
$sharedSecret = 'oSrQk1x3Q19172gM0aHhkNhGFGAb5yY2wxmZhe3Zxd5F7KqjvG5Ev1GdjHA2XzEH'; //provided by Triple IT
$serviceUrl = 'https://nudge.triple-it.nl';

// $iphoneTestToken = 'C03B8893C74E9C3CC3C10B6BD5B23A0BE0DE272ED26E976EB215B74BBFACA86D';
// $androidTestToken = 'APA91bGxCMRwQmPNr0p3MFw2zg6XYR5JVhcnB6JEajpm29MJj5hRnI6C6-piuzIkiT3nZqDFJszZJ9vd7dHfNqr54W3QBYFAPchRIx07s-WnkUvlholeeymy82hoLxWpTcJaOuVYPYbpzxp61Z_rVyqVeRs7uoz4nA';
// $windowsTestToken = 'https://db3.notify.windows.com/?token=AgYAAABOyluT%2fNpCCXGRQNWt5qiX51qLzN7AelrJLDT3Jod2eMkIQJzrYfuuNuQBe8r8bJVBOhXnlUk2RTa4vvgT7X%2foDXUzboi0YfSEPiAYFUDay3HubSlhKcBoKNGLUQl41zQ%3d';
// $windowsPhoneTestToken = 'http://db3.notify.live.net/throttledthirdparty/01.00/AAEEjy_sHV6cSqGwtLHwaNnXAgAAAAADsgEAAAQUZm52Ojk2MkQ1MDRGOUJCOTUzRjg';

require_once 'SplClassLoader.php';
$classLoader = new SplClassLoader();
$classLoader->register();

try {
    $c = new TripleIT_Nudge_Client_Client($projectKey, $sharedSecret, $serviceUrl);

    $test = 'genericjob';
    if(isset($_REQUEST['test']))
        $test = $_REQUEST['test'];
    if(isset($argv[1])){
        $test = $argv[1];
    }

    if($test == 'genericsimple'){
        $result = $c->sendGenericSimple(
            array($iphoneTestToken), 
            array($androidTestToken),
            array($windowsTestToken), 
            array($windowsPhoneTestToken), 
            'Generic Simple Test');
    }

    else if($test == 'generic'){
        $genericRequest = new TripleIT_Nudge_Client_GenericSendPushRequest();
        $genericRequest->Alert = 'Generic Test';
        $genericRequest->Sound = true;
        $genericRequest->IOSPushTokens = array($iphoneTestToken);
        $genericRequest->AndroidPushTokens = array($androidTestToken);
        $genericRequest->WindowsPushTokens = array($windowsTestToken);
        $genericRequest->WindowsPhonePushTokens = array($windowsPhoneTestToken);
        $genericRequest->CustomData[] = new TripleIT_Nudge_Common_CustomKeyValue('custom1', 'value1');
        $genericRequest->ExpiryUtcDateTime = date('Y-m-d\TH:i:s', time() + 3600);
        $result = $c->sendGeneric($genericRequest);
    }

    else if($test == 'genericjob'){
        $genericJobRequest = new TripleIT_Nudge_Client_GenericSendPushJobRequest();
        $genericJobRequest->Alert = 'Generic Job Test 1';
        $genericJobRequest->Sound = true;
        $genericJobRequest->CustomData[] = new TripleIT_Nudge_Common_CustomKeyValue('custom1', 'value1');
        $genericJobRequest->ExpiryUtcDateTime = date('Y-m-d\TH:i:s', time() + 3600);
        $genericJobRequest->Query = '';
        $result = $c->sendGenericJob($genericJobRequest);
    }
    
    else if($test == 'iossimple'){
        $result = $c->sendIOSSimple(
            array($iphoneTestToken), 
            'iOS Simple Test');
    }

    else if($test == 'ios'){
        $iosRequest = new TripleIT_Nudge_Client_IOSSendPushRequest();
        $iosRequest->Alert = 'iOS Test';
        $iosRequest->PushTokens = array($iphoneTestToken);
        $iosRequest->Badge = 2;
        $iosRequest->Sound = true;
        $iosRequest->SoundFile = null;
        $iosRequest->CustomData[] = new TripleIT_Nudge_Common_CustomKeyValue('custom1', 'value1');
        $iosRequest->CustomData[] = new TripleIT_Nudge_Common_CustomKeyValue('custom2', 'value2');
        $iosRequest->ExpiryUtcDateTime = date('Y-m-d\TH:i:s', time() + 3600);
        $result = $c->sendIOS($iosRequest);
    }

    else if($test == 'androidsimple'){
        $result = $c->sendAndroidSimple(
            array($androidTestToken), 
            'Android Simple Test');
    }

    else if($test == 'android'){
        $androidRequest = new TripleIT_Nudge_Client_AndroidSendPushRequest();
        $androidRequest->Alert = 'Android Test';
        $androidRequest->PushTokens = array($androidTestToken);
        $androidRequest->Badge = 2;
        $androidRequest->Sound = true;
        $androidRequest->CollapseKey = 'php tests';
        $androidRequest->DelayWhileIdle = false;
        $androidRequest->CustomData[] = new TripleIT_Nudge_Common_CustomKeyValue('custom1', 'value1');
        $androidRequest->CustomData[] = new TripleIT_Nudge_Common_CustomKeyValue('custom2', 'value2');
        $androidRequest->ExpiryUtcDateTime = date('Y-m-d\TH:i:s', time() + 3600);
        $result = $c->sendAndroid($androidRequest);
    }

    else if($test == 'windowssimple'){
        $result = $c->sendWindowsSimple(
            array($windowsTestToken), 
            'Windows Simple Test');
    }

    else if($test == 'windows'){
        $windowsRequest = new TripleIT_Nudge_Client_WindowsSendPushRequest();
        $windowsRequest->PushTokens = array($windowsTestToken);
        $windowsRequest->Badge = 2;
        $windowsRequest->BadgeIcon = TripleIT_Nudge_Client_WnsBadgeIcon::Available;
        $windowsRequest->ExpiryUtcDateTime = date('Y-m-d\TH:i:s', time() + 3600);
        
        $windowsRequest->ToastTemplate = TripleIT_Nudge_Client_WnsToastTemplate::ToastText01;
        $windowsRequest->Alert = 'Windows Test';
        $windowsRequest->ToastAlert2 = 'Toast Text 2';
        $windowsRequest->ToastAlert3 = 'Toast Text 3';
        $windowsRequest->ToastImage = $serviceUrl . '/Content/TestImages/normal1.png';
        $windowsRequest->ToastDuration = TripleIT_Nudge_Client_WnsToastDuration::Long;
        $windowsRequest->Sound = true;
        $windowsRequest->SoundType = TripleIT_Nudge_Client_WnsSoundType::LoopingCall6;
        $windowsRequest->LoopSound = true;
        $windowsRequest->LaunchParam = 'test-push';
                
        $windowsRequest->SquareTileTemplate = TripleIT_Nudge_Client_WnsSquareTileTemplate::TileSquarePeekImageAndText04;
        $windowsRequest->SquareTileBranding = TripleIT_Nudge_Client_WnsBranding::None;
        $windowsRequest->SquareTileText = 'Windows Test';
        $windowsRequest->SquareTileText2 = 'Square Tile Text 2';
        $windowsRequest->SquareTileText3 = 'Square Tile Text 3';
        $windowsRequest->SquareTileText4 = 'Square Tile Text 4';
        $windowsRequest->SquareTileImage = $serviceUrl . '/Content/TestImages/normal1.png';
        
        $windowsRequest->WideTileTemplate = TripleIT_Nudge_Client_WnsWideTileTemplate::TileWidePeekImageCollection05;
        $windowsRequest->WideTileBranding = TripleIT_Nudge_Client_WnsBranding::Logo;
        $windowsRequest->WideTileText = 'Windows Test';
        $windowsRequest->WideTileText2 = 'Wide Tile Text 2';
        $windowsRequest->WideTileText3 = 'Wide Tile Text 3';
        $windowsRequest->WideTileText4 = 'Wide Tile Text 4';
        $windowsRequest->WideTileText5 = 'Wide Tile Text 5';
        $windowsRequest->WideTileText6 = 'Wide Tile Text 6';
        $windowsRequest->WideTileText7 = 'Wide Tile Text 7';
        $windowsRequest->WideTileText8 = 'Wide Tile Text 8';
        $windowsRequest->WideTileText9 = 'Wide Tile Text 9';
        $windowsRequest->WideTileText10 = 'Wide Tile Text 10';
        $windowsRequest->WideTileImage = $serviceUrl . '/Content/TestImages/wide1.png';
        $windowsRequest->WideTileImage2 = $serviceUrl . '/Content/TestImages/normal2.png';
        $windowsRequest->WideTileImage3 = $serviceUrl . '/Content/TestImages/normal3.png';
        $windowsRequest->WideTileImage4 = $serviceUrl . '/Content/TestImages/normal4.png';
        $windowsRequest->WideTileImage5 = $serviceUrl . '/Content/TestImages/normal5.png';
        $windowsRequest->WideTileImage6 = $serviceUrl . '/Content/TestImages/normal6.png';
        
        $result = $c->sendWindows($windowsRequest);
    }
    
    else if($test == 'windowsphonesimple'){
        $result = $c->sendWindowsPhoneSimple(
            array($windowsPhoneTestToken), 
            'Windows Phone Simple Test');
    }

    else if($test == 'windowsphone'){
        $windowsPhoneRequest = new TripleIT_Nudge_Client_WindowsPhoneSendPushRequest();
        $windowsPhoneRequest->PushTokens = array($windowsPhoneTestToken);
        $windowsPhoneRequest->WindowsPhoneVersion = TripleIT_Nudge_Client_WindowsPhoneVersion::Seven;
        $windowsPhoneRequest->DeliverySpeed = TripleIT_Nudge_Client_MpnsDeliverySpeed::Fast;
        $windowsPhoneRequest->Badge = 2;
        $windowsPhoneRequest->Alert = 'Windows Phone Test';
        
        $windowsPhoneRequest->Raw = 'Raw Text';
        
        $windowsPhoneRequest->Text2 = 'Toast Text 2';
        $windowsPhoneRequest->Param = null;
        
        $windowsPhoneRequest->TileTemplate = TripleIT_Nudge_Client_MpnsTileTemplate::Normal;
        $windowsPhoneRequest->TileId = null;
        $windowsPhoneRequest->Title = 'Tile Title';
        $windowsPhoneRequest->BackgroundImage = $serviceUrl . '/Content/TestImages/normal1.png';
        $windowsPhoneRequest->BackTitle = 'Back Tile Title';
        $windowsPhoneRequest->BackContent = 'Back Tile Content';
        $windowsPhoneRequest->BackBackgroundImage = $serviceUrl . '/Content/TestImages/normal2.png';
                
        $result = $c->sendWindowsPhone($windowsPhoneRequest);
    }

    else if($test == 'enable'){
        $result = $c->enableTokens(array('aWrongRejectedToken'), null, null);
    }
    
    else
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