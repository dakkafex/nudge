<?php

/*
 * Key-value pair used for sending custom data with a push notification
 */
class TripleIT_Nudge_Common_CustomKeyValue {

    /*
     * The key of the key-value pair
     * Some keys are reserved: aps, badge
     */
    public $Key = null;
    
    /*
     * The value of the key-value pair
     */
    public $Value = null;
    
    /*
     * Sets the key of the key-value pair and checks for reserved keys
     * Some keys are reserved: aps, badge
     * 
     * @param string The key of the key-value pair
     */
    public function setKey($value) {
        $check = strtolower($value);
        if ($check == "aps")
        {
            throw new InvalidArgumentException("'Aps' is a reserved key");
        }
        if ($check == "badge")
        {
            throw new InvalidArgumentException("'Badge' is a reserved key");
        }
        $this->Key = $value;
    }

    /*
     * Create a new custom key-value pair
     * 
     * @param string The key of the key-value pair
     * @param string The value of the key-value pair
     */
    public function __construct($key, $value) {
        $this->setKey($key);
        $this->Value = $value;
    }

    public function toString()
    {
        return "Key: [" . $this->getKey() . "], Value: {" . $this->getValue() . "}";
    }
}

?>