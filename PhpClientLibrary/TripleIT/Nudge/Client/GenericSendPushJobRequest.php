<?php

/**
 * A request object containing the properties for sending generic notifications
 */
class TripleIT_Nudge_Client_GenericSendPushJobRequest extends TripleIT_Nudge_Client_ASendPushRequest {

    /**
     * The used for to select the push tokens.
     */
    public $Query = null;

}

?>