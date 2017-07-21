<?php

/*
 * The response object returned after performing a push notification request
 */
class TripleIT_Nudge_Server_SendPushResponse {

    /*
     * A message indicating success or error
     */
    public $Message = null;
    
    /*
     * A list of iOS push tokens that are in the rejected list, because of invalid length or APNS feedback for example
     */
    public $RejectedIOSPushTokens = array();
    
    /*
     * A list of Android push tokens that are in the rejected list, because of GCM feedback for example
     */
    public $RejectedAndroidPushTokens = array();
    
    /*
     * A list of Windows push tokens that are in the rejected list, because of WNS feedback for example
     */
    public $RejectedWindowsPushTokens = array();
    
    /*
     * A list of Windows Phone push tokens that are in the rejected list, because of WNS feedback for example
     */
    public $RejectedWindowsPhonePushTokens = array();

    /*
     * Creates a new send push response from a json object
     * 
     * @param object json object containing the properties for the push response
     * 
     * @return TripleIT_Nudge_Server_SendPushResponse the push response
     */
    public static function fromJsonObject($jsonObject) {
        $result = new self();
        $result->Message = $jsonObject->Message;
        if(isset($jsonObject->RejectedIOSPushTokens))
            $result->RejectedIOSPushTokens = $jsonObject->RejectedIOSPushTokens;
        if(isset($jsonObject->RejectedAndroidPushTokens))
            $result->RejectedAndroidPushTokens = $jsonObject->RejectedAndroidPushTokens;
        if(isset($jsonObject->RejectedWindowsPushTokens))
            $result->RejectedWindowsPushTokens = $jsonObject->RejectedWindowsPushTokens;
        if(isset($jsonObject->RejectedWindowsPhonePushTokens))
            $result->RejectedWindowsPhonePushTokens = $jsonObject->RejectedWindowsPhonePushTokens;
        return $result;
    }
}

?>