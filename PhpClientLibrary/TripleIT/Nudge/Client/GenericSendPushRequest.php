<?php

/**
 * A request object containing the properties for sending generic notifications
 */
class TripleIT_Nudge_Client_GenericSendPushRequest extends TripleIT_Nudge_Client_ASendPushRequest {

    /**
     * The iOS tokens to send the notification for
     */
    public $IOSPushTokens = array();

    /**
     * The Android tokens to send the notification for
     */
    public $AndroidPushTokens = array();

    /**
     * The Windows tokens to send the notification for
     */
    public $WindowsPushTokens = array();
    
    /**
     * The Windows Phone tokens to send the notification for
     */
    public $WindowsPhonePushTokens = array();

}

?>