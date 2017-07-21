<?php

/*
 * A class containging some handy functions
 */
class TripleIT_Nudge_Common_Tools {

    /*
     * Remove duplicate push tokens from a list
     * 
     * @param array $pushTokens The list of push tokens containing possible duplicates
     * 
     * @return array A list with distinct push tokens
     */
    public static function removeDuplicatePushTokens($pushTokens){
        return array_unique($pushTokens);
    }

    /*
     * Breaks a list of push tokens down into smaller lists
     * 
     * @param array $pushTokens The complete set of push tokens
     * @param array $maxBatchSize The maximum amount of push tokens you want to send in one batch. The maximum is 50000.
     * 
     * @return array A list of push token lists with a maximum of maxBatchSize elements
     */
    public static function getPushTokenBatches($pushTokens, $maxBatchSize){
        if ($maxBatchSize <= 0 || $maxBatchSize > 50000)
        {
            throw new InvalidArgumentException("'maxBatchSize should be greater than 0 and smaller than 50000");
        }
        $result = array();
        if(empty($pushTokens)){
            return $result;
        }
        
        $nrOfBatches = ceil(count($pushTokens) / $maxBatchSize);
        $batchSize = ceil(count($pushTokens) / $nrOfBatches);
        
        for ($i = 0; $i < $nrOfBatches; $i++)
        {
            $count = $batchSize;
            if (($i * $batchSize) + $batchSize > count($pushTokens))
                $count = count($pushTokens) - ($i * $batchSize);
            $result[] = array_slice($pushTokens, $i * $batchSize, $count);
        }

        return $result;
    }
    
    /*
     * Creates a random GUID
     * 
     * @return string A randomly generated GUID
     */
    public static function getGUID(){
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12);
        return strtolower($uuid);
    }
    
}
?>