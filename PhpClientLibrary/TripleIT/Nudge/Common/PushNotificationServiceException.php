<?php

/*
 * Exception that can be returned by the push notification service
 */
class TripleIT_Nudge_Common_PushNotificationServiceException extends Exception {

    public function __construct($code, $key) {
        parent::__construct($key, $code);
    }

}

?>