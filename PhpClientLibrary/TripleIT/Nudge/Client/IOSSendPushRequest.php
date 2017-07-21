<?php

/**
 * A request object containing the properties for sending notifications to iOS devices
 */
class TripleIT_Nudge_Client_IOSSendPushRequest extends TripleIT_Nudge_Client_ASendPushRequest {

    /**
     * The iOS tokens to send the notification for
     */
    public $PushTokens = array();

    /**
     * The name of a sound file in the application bundle
     */
    public $SoundFile = null;
    
    /**
     * Indicate that there is new content available<p>
     * iOS 5 and news stand apps only
     */
    public $ContentAvailable = false; 

    /**
     * The key of a localized string in the application, specifying what text to show on the action button of the notification
     */
    public $ActionLocKey = null;

    /**
     * The key of a localized string in the application, specifying the alert to show
     */
    public $LocKey = null;

    /**
     * List of values to put into the localized alert, replacing the %@ placeholders
     */
    public $LocArgs = null;

    /**
     * The filename of an image file in the application bundle to launch the application with when using the notification to open the application
     */
    public $LaunchImage = null;
}

?>