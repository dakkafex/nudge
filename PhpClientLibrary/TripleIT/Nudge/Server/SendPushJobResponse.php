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
     * A boolean which indicates if all items were added to the queue.
     */
    public $Result = false;
    
}

?>