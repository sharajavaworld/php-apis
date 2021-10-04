<?php
/**
 * Making a generic class to make rest api calls. 
 * Shara Mishra
 * 
 */
class curl
{
    function _make_rest_call($destinationUrl, $method = "GET") {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL             => $destinationUrl,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_ENCODING        => '',
            CURLOPT_MAXREDIRS       => 10,
            CURLOPT_TIMEOUT         => 0,
            CURLOPT_FOLLOWLOCATION  => true,
            CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST   => $method,
        ));
        $response = curl_exec($curl);
        return $response;
    }



}


?>