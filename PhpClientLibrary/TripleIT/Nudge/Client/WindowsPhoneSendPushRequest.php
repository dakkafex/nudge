<?php

/**
 * A request object containing the properties for sending notifications to Windows Phone devices
 */
class TripleIT_Nudge_Client_WindowsPhoneSendPushRequest extends TripleIT_Nudge_Client_ASendPushRequest {

    /**
     * The Windows Phone tokens to send the notification for
     */
    public $PushTokens = array();

    /**
     * The minimum version of the Windows Phone OS regarding to the devices to push to
     * The higher this value, the more features are supported
     */
    public $WindowsPhoneVersion = TripleIT_Nudge_Client_WindowsPhoneVersion::Seven;
    
    /**
     * MPNS has multiple queues a message can end up in. If the push notification is not time critical, consider to select a slower delivery speed
     */
    public $DeliverySpeed = TripleIT_Nudge_Client_MpnsDeliverySpeed::Fast;
    
    /**
     * Optional: A raw string to send that can be handled when the application is open
     */
    public $Raw = null;
    
    /**
     * Extra toast text to send
     */
    public $Text2 = null;
    
    /**
     * Optional: A XAML page to open in the app, along with any query string parameters
     * Only for OS Mango or higher
     */
    public $Param = null;
    
    /**
     * The tile template to use. None if you don't want to update the tile
     */
    public $TileTemplate = TripleIT_Nudge_Client_MpnsTileTemplate::None;
    
    /**
     * Optional: The id of the tile to update, for updating secondary tiles
     */
    public $TileId = null;
    
    /**
     * Tile title to set on the tile
     */
    public $Title = null;
    
    /**
     * Image to set on the background
     * For normal or flip tile
     */
    public $BackgroundImage = null;
    
    /**
     * Image to set on the background of the back of the tile
     * For normal or flip tile
     */
    public $BackBackgroundImage = null;
    
    /**
     * Tile title to set on the back of tile
     * For normal or flip tile
     */
    public $BackTitle = null;
    
    /**
     * Tile text to set on the back of tile
     * For normal or flip tile
     */
    public $BackContent = null;
    
    /**
     * Tile text to set on the back of a wide tile
     * For flip tile only
     */
    public $WideBackContent = null;
    
    /**
     * Image to set on the background of a small tile
     * For flip and cycle tile only
     */
    public $SmallBackgroundImage = null;
    
    /**
     * Image to set on the background of a wide tile
     * For flip tile only
     */
    public $WideBackgroundImage = null;
    
    /**
     * Image to set on the background of the back of a wide tile
     * For flip tile only
     */
    public $WideBackBackgroundImage = null;
    
    /**
     * Image to use in the image cycle
     * For cycle tile only
     */
    public $CycleImage1 = null;
    
    /**
     * Image to use in the image cycle
     * For cycle tile only
     */
    public $CycleImage2 = null;
    
    /**
     * Image to use in the image cycle
     * For cycle tile only
     */
    public $CycleImage3 = null;
    
    /**
     * Image to use in the image cycle
     * For cycle tile only
     */
    public $CycleImage4 = null;
    
    /**
     * Image to use in the image cycle
     * For cycle tile only
     */
    public $CycleImage5 = null;
    
    /**
     * Image to use in the image cycle
     * For cycle tile only
     */
    public $CycleImage6 = null;
    
    /**
     * Image to use in the image cycle
     * For cycle tile only
     */
    public $CycleImage7 = null;
    
    /**
     * Image to use in the image cycle
     * For cycle tile only
     */
    public $CycleImage8 = null;
    
    /**
     * Image to use in the image cycle
     * For cycle tile only
     */
    public $CycleImage9 = null;
    
    /**
     * Image to use as the icon on a small and wide tile
     * For iconic tile only
     */
    public $SmallIconImage = null;
    
    /**
     * Image to use as the icon on the tile
     * For iconic tile only
     */
    public $IconImage = null;
    
    /**
     * Text to display on a wide tile
     * For iconic tile only
     */
    public $WideContent1 = null;
    
    /**
     * Extra text to display on a wide tile
     * For iconic tile only
     */
    public $WideContent2 = null;
    
    /**
     * Extra text to display on a wide tile
     * For iconic tile only
     */
    public $WideContent3 = null;
    
    /**
     * The hex ARGB background color to use. For example #FF5133AB
     * For iconic tile only
     */
    public $BackgroundColor = null;
}

/**
 * The available square tile templates
 * More info on normal tiles: http://msdn.microsoft.com/en-us/library/windowsphone/develop/jj553779(v=vs.105).aspx
 * More info on flip tiles: http://msdn.microsoft.com/en-us/library/windowsphone/develop/jj206971(v=vs.105).aspx
 * More info on iconic tiles: http://msdn.microsoft.com/en-us/library/windowsphone/develop/jj207009(v=vs.105).aspx
 * More info on cycle tiles: http://msdn.microsoft.com/en-us/library/windowsphone/develop/jj207036(v=vs.105).aspx
 */
class TripleIT_Nudge_Client_MpnsTileTemplate {
    const None = 0;
    const Normal = 1;
    const FlipTile = 2;
    const IconicTile = 3;
    const CycleTile = 4;
}

/**
 * The available Windows Phone OS versions
 */
class TripleIT_Nudge_Client_WindowsPhoneVersion {
    const Seven = 1;
    const Mango = 2;
    const Eight = 3;
}

/**
 * The available delivering speeds, corresponding to different MPNS queues
 * Fast = as fast as possible, Medium = delivery within 450 seconds, Slow = delivery within 900 seconds
 */
class TripleIT_Nudge_Client_MpnsDeliverySpeed {
    const Fast = 0;
    const Medium = 1;
    const Slow = 2;
}

?>