<?php

/*
 * Defines a rejected token response, including a reason of why it is rejected
 */
class TripleIT_Nudge_Server_RejectedTokenResponse {

    /*
     * The push token that is rejected
     */
    private $PushToken = null;
    
    /*
     * The reason why this token was rejected
     */
    private $Reason = null;
    
    /*
     * The new token to use for this token (optional)
    private $CanonicalToken = null;

    /*
     * The time when the token was added to the rejected token list
     */
    private $InsertionDate = null;
}

?>