<?php

/**
 * A request object containing push tokens to enable
 */
class TripleIT_Nudge_Client_EnableRequest extends TripleIT_Nudge_Client_ASignedRequest {

    /**
     * The iOS tokens to enable
     */
    public $IOSPushTokens = array();

    /**
     * The Android tokens to enable
     */
    public $AndroidPushTokens = array();

    /**
     * The Windows tokens to enable
     */
    public $WindowsPushTokens = array();

    /**
     * The Windows Phone tokens to enable
     */
    public $WindowsPhonePushTokens = array();    
}

?>