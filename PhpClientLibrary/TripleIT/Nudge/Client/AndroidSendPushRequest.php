<?php

/**
 * A request object containing the properties for sending notifications to Android devices
 */
class TripleIT_Nudge_Client_AndroidSendPushRequest extends TripleIT_Nudge_Client_ASendPushRequest {

    /**
     * The push tokens to send the notification to
     */
    public $PushTokens = array();

    /**
     * An arbitrary string (such as "Updates Available") that is used to collapse a group of like messages when the device is offline, so that only the last message gets sent to the client
     */
    public $CollapseKey = null;

    /**
     * True if the GCM push service should wait sending the notification while the device is idle and send it when the device becomes active
     */
    public $DelayWhileIdle = false;
}

?>