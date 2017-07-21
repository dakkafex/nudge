<?php

/**
 * Base object for signed requests 
 */
abstract class TripleIT_Nudge_Client_ASignedRequest {

    /**
     * The key of the project as configured in the Nudge CMS
     */
    public $ProjectKey = null;

    /**
     * The current UTC timestamp used to calculate the signature of the request
     */
    public $UtcTimestamp = null;

    /**
     * Salt value used to calculate the signature of the request
     */
    public $Salt = null;

    /**
     * The calculated signature of the request that will be verified server side
     */
    public $Signature = null;

}

?>
