<?php

/**
 * Base object for push requests
 */
abstract class TripleIT_Nudge_Client_ASendPushRequest extends TripleIT_Nudge_Client_ASignedRequest {

    /**
     * A timestamp (optional) after which the push services of the different platforms will not send this notification anymore
     * Format: yyyy-MM-ddTHH:mm:ss, for example 2012-11-30T18:35:59
     * date('Y-m-d\TH:i:s', time() + 3600)
     */
    public $ExpiryUtcDateTime = null;

    /**
     * The message to send
     * Take into account that a long message is not displayed entirely on the devices
     */
    public $Alert = null;

    /**
     * A badge number to show
     * 0 to remove badge number
     */
    public $Badge = null;

    /**
     * Whether or not a sound should be played upon receiving this notification
     * Only supported by iOS by default. Android apps should implement their own logic for this. Not supported by Windows
     */
    public $Sound = null;

    /**
     * Custom data to send along with the notification
     * Only supported by iOS and Android
     */
    public $CustomData = array();

}

?>
