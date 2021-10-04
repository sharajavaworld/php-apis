<?php
/**
 * Making a generic class to make rest api calls. 
 * Shara Mishra
 * 
 */
class curl 
{
    var $redisObj = null;

    function curl(){
        if (null == $redisObj) {
            $redisObj = new Redis();
        }
        print_r($redisObj);
    }
    function openRedisConnection( $hostName, $port, $pwd) { 
        global $redisObj;     
        $redisObj->connect( $hostName, $port );
        $redisObj->auth($pwd);
        return $redisObj; 
    }
    function setValueWithTtl( $key, $value, $minute = 60 ){ 
        try{ 
            global $redisObj; 
          // setting the value in redis
            $redisObj->setex( $key, $ttl, $value );
        }catch( Exception $e ){ 
            echo $e->getMessage(); 
        } 
    } 
  
    function getValueFromKey( $key ){ 
        try{ 
            global $redisObj; 
          // getting the value from redis
            return $redisObj->get( $key);
        }catch( Exception $e ){ 
            echo $e->getMessage(); 
        } 
    } 
    function deleteValueFromKey( $key ){ 
        try{ 
            global $redisObj; 
          // deleting the value from redis
            $redisObj->del( $key);
        }catch( Exception $e ){ 
            echo $e->getMessage(); 
        } 
    } 

    function setValue($key, $url, $method = "GET") {
        $jsonResponse = $this->_make_rest_call($url, $method);        
        $this->openRedisConnection( 'localhost', 6379, $pwd = 'redis98100');
        $this->setValueWithTtl( $key, $jsonResponse, 3600);
    }

    function write($key, $url, $method = "GET") {
        $redisClient = new Redis();        
        $redisClient->connect('localhost', 6379);
        $redisClient->auth('redis98100');
        $callResponse = $this->_make_rest_call($url, $method);
        $redisClient->set($key, $callResponse);

    }

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