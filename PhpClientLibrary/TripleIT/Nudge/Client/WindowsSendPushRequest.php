<?php

/**
 * A request object containing the properties for sending notifications to Windows devices
 */
class TripleIT_Nudge_Client_WindowsSendPushRequest extends TripleIT_Nudge_Client_ASendPushRequest {

    /**
     * The Windows tokens to send the notification for
     */
    public $PushTokens = array();

    /**
     * In stead of a badge number, you can also specify one of the available badge icons to display on the app tile
     */
    public $BadgeIcon = TripleIT_Nudge_Client_WnsBadgeIcon::None;
    
    /**
     * Optional: A raw string to send that can be handled when the application is open
     */
    public $Raw = null;
    
    /**
     * The toast template to use. None if you don't want to send a toast message
     */
    public $ToastTemplate = TripleIT_Nudge_Client_WnsToastTemplate::None;
    
    /**
     * Extra toast text to send
     * Select the correct toast template in order to make this text visible
     */
    public $ToastAlert2 = null;
    
    /**
     * Extra toast text to send
     * Select the correct toast template in order to make this text visible
     */
    public $ToastAlert3 = null;
    
    /**
     * The toast image to send
     * Select the correct toast template in order to make this image visible
     */
    public $ToastImage = null;
    
    /**
     * The duration the toast notification stays visible
     */
    public $ToastDuration = TripleIT_Nudge_Client_WnsToastDuration::Long;

    /**
     * An arbitrary string that will be sent to the application when the application is opened using the notification
     */
    public $LaunchParam = null;

    /**
     * Which sound to play when the notification is received
     */
    public $SoundType = TripleIT_Nudge_Client_WnsSoundType::None;

    /**
     * Whether or not to loop the sound as long as the notification is visible
     */
    public $LoopSound = false;
    
    /**
     * The square tile template to use. None if you don't want to update the square tile
     * Send both a wide and a square tile update to make sure the user sees the update. You never know if the user has configured the wide or the square tile
     */
    public $SquareTileTemplate = TripleIT_Nudge_Client_WnsSquareTileTemplate::None;
    
    /**
     * What kind of application branding to show on the square tile
     */
    public $SquareTileBranding = TripleIT_Nudge_Client_WnsBranding::Name;
    
    /**
     * Square tile text to send
     * Select the correct square tile template in order to make this text visible
     */
    public $SquareTileText = null;
    
    /**
     * Extra square tile text to send
     * Select the correct square tile template in order to make this text visible
     */
    public $SquareTileText2 = null;
    
    /**
     * Extra square tile text to send
     * Select the correct square tile template in order to make this text visible
     */
    public $SquareTileText3 = null;
    
    /**
     * Extra square tile text to send
     * Select the correct square tile template in order to make this text visible
     */
    public $SquareTileText4 = null;
    
    /**
     * The square tile image to send
     * Select the correct square tile template in order to make this image visible
     */
    public $SquareTileImage = null;
    
    
    /**
     * The wide tile template to use. None if you don't want to update the wide tile
     * Send both a wide and a square tile update to make sure the user sees the update. You never know if the user has configured the wide or the square tile
     */
    public $WideTileTemplate = TripleIT_Nudge_Client_WnsWideTileTemplate::None;
    
    /**
     * What kind of application branding to show on the wide tile
     */
    public $WideTileBranding = TripleIT_Nudge_Client_WnsBranding::Name;
    
    /**
     * Wide tile text to send
     * Select the correct wide tile template in order to make this text visible
     */
    public $WideTileText = null;
    
    /**
     * Extra wide tile text to send
     * Select the correct wide tile template in order to make this text visible
     */
    public $WideTileText2 = null;
    
    /**
     * Extra wide tile text to send
     * Select the correct wide tile template in order to make this text visible
     */
    public $WideTileText3 = null;
    
    /**
     * Extra wide tile text to send
     * Select the correct wide tile template in order to make this text visible
     */
    public $WideTileText4 = null;
    
    /**
     * Extra wide tile text to send
     * Select the correct wide tile template in order to make this text visible
     */
    public $WideTileText5 = null;
    
    /**
     * Extra wide tile text to send
     * Select the correct wide tile template in order to make this text visible
     */
    public $WideTileText6 = null;
    
    /**
     * Extra wide tile text to send
     * Select the correct wide tile template in order to make this text visible
     */
    public $WideTileText7 = null;
    
    /**
     * Extra wide tile text to send
     * Select the correct wide tile template in order to make this text visible
     */
    public $WideTileText8 = null;
    
    /**
     * Extra wide tile text to send
     * Select the correct wide tile template in order to make this text visible
     */
    public $WideTileText9 = null;
    
    /**
     * Extra wide tile text to send
     * Select the correct wide tile template in order to make this text visible
     */
    public $WideTileText10 = null;
    
    /**
     * Wide tile image to send
     * Select the correct square tile template in order to make this image visible
     */
    public $WideTileImage = null;
    
    /**
     * Extra wide tile image to send
     * Select the correct square tile template in order to make this image visible
     */
    public $WideTileImage2 = null;
    
    /**
     * Extra wide tile image to send
     * Select the correct square tile template in order to make this image visible
     */
    public $WideTileImage3 = null;
    
    /**
     * Extra wide tile image to send
     * Select the correct square tile template in order to make this image visible
     */
    public $WideTileImage4 = null;
    
    /**
     * Extra wide tile image to send
     * Select the correct square tile template in order to make this image visible
     */
    public $WideTileImage5 = null;
    
    /**
     * Extra wide tile image to send
     * Select the correct square tile template in order to make this image visible
     */
    public $WideTileImage6 = null;
    
}

/**
 * The available badge icons to display on the application tile. None to display a badge number (0 to display no badge at all)
 */
class TripleIT_Nudge_Client_WnsBadgeIcon {
    const None = 0;
    const Activity = 1;
    const Alert = 2;
    const Available = 3;
    const Away = 4;
    const Busy = 5;
    const NewMessage = 6;
    const Paused = 7;
    const Playing = 8;
    const Unavailable = 9;
    const Error = 10;
    const Attention = 11;
}

/**
 * The available toast templates
 * More information can be found here: http://msdn.microsoft.com/en-us/library/windows/apps/hh761494.aspx
 */
class TripleIT_Nudge_Client_WnsToastTemplate {
    const None = 0;
    const ToastText01 = 1;
    const ToastText02 = 2;
    const ToastText03 = 3;
    const ToastText04 = 4;
    const ToastImageAndText01 = 5;
    const ToastImageAndText02 = 6;
    const ToastImageAndText03 = 7;
    const ToastImageAndText04 = 8;
}

/**
 * The available square tile templates
 * More information can be found here: http://msdn.microsoft.com/en-us/library/windows/apps/hh761491.aspx
 */
class TripleIT_Nudge_Client_WnsSquareTileTemplate {
    const None = 0;
    const TileSquareBlock = 1;
    const TileSquareText01 = 2;
    const TileSquareText02 = 3;
    const TileSquareText03 = 4;
    const TileSquareText04 = 5;
    const TileSquareImage = 6;
    const TileSquarePeekImageAndText01 = 7;
    const TileSquarePeekImageAndText02 = 8;
    const TileSquarePeekImageAndText03 = 9;
    const TileSquarePeekImageAndText04 = 10;
}

/**
 * The available wide tile templates
 * More information can be found here: http://msdn.microsoft.com/en-us/library/windows/apps/hh761491.aspx
 */
class TripleIT_Nudge_Client_WnsWideTileTemplate {
    const None = 0;
    const TileWideText01 = 1;
    const TileWideText02 = 2;
    const TileWideText03 = 3;
    const TileWideText04 = 4;
    const TileWideText05 = 5;
    const TileWideText06 = 6;
    const TileWideText07 = 7;
    const TileWideText08 = 8;
    const TileWideText09 = 9;
    const TileWideText10 = 10;
    const TileWideText11 = 11;
    const TileWideImage = 12;
    const TileWideImageCollection = 13;
    const TileWideImageAndText01 = 14;
    const TileWideImageAndText02 = 15;
    const TileWideBlockAndText01 = 16;
    const TileWideBlockAndText02 = 17;
    const TileWideSmallImageAndText01 = 18;
    const TileWideSmallImageAndText02 = 19;
    const TileWideSmallImageAndText03 = 20;
    const TileWideSmallImageAndText04 = 21;
    const TileWideSmallImageAndText05 = 22;
    const TileWidePeekImageCollection01 = 23;
    const TileWidePeekImageCollection02 = 24;
    const TileWidePeekImageCollection03 = 25;
    const TileWidePeekImageCollection04 = 26;
    const TileWidePeekImageCollection05 = 27;
    const TileWidePeekImageCollection06 = 28;
    const TileWidePeekImageAndText01 = 29;
    const TileWidePeekImageAndText02 = 30;
    const TileWidePeekImage01 = 31;
    const TileWidePeekImage02 = 32;
    const TileWidePeekImage03 = 33;
    const TileWidePeekImage04 = 34;
    const TileWidePeekImage05 = 35;
    const TileWidePeekImage06 = 36;
}

/**
 * The available sound types
 */
class TripleIT_Nudge_Client_WnsSoundType {
    const None = 0;
    const Normal = 1;
    const IM = 2;
    const Mail = 3;
    const Reminder = 4;
    const SMS = 5;
    const LoopingAlarm = 6;
    const LoopingAlarm2 = 7;
    const LoopingAlarm3 = 8;
    const LoopingAlarm4 = 9;
    const LoopingAlarm5 = 10;
    const LoopingAlarm6 = 11;
    const LoopingAlarm7 = 12;
    const LoopingAlarm8 = 13;
    const LoopingAlarm9 = 14;
    const LoopingAlarm10 = 15;
    const LoopingCall = 16;
    const LoopingCall2 = 17;
    const LoopingCall3 = 18;
    const LoopingCall4 = 19;
    const LoopingCall5 = 20;
    const LoopingCall6 = 21;
    const LoopingCall7 = 22;
    const LoopingCall8 = 23;
    const LoopingCall9 = 24;
    const LoopingCall10 = 25;
}

/**
 * The available toast durations
 */
class TripleIT_Nudge_Client_WnsToastDuration {
    const Long = 0;
    const Short = 1;
}

/**
 * The available branding types
 */
class TripleIT_Nudge_Client_WnsBranding {
    const Name = 0;
    const Logo = 1;
    const None = 2;
}

?>