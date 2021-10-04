<?php
/**
 * Making a generic class to redis operations. 
 * Shara Mishra
 * 
 */
require_once 'curl.php';
class redisAdapter 
{
    var $redisObj     = null;
    var $curlClassObj = null;

    function __construct(){
        if (null == $this->redisObj || $this->curlClassObj == null) {
            $this->redisObj = new Redis();
            $this->curlClassObj = new curl();
        }       
    }
    function openRedisConnection( $hostName, $port, $pwd) {                
        $this->redisObj->connect( $hostName, $port );
        $this->redisObj->auth($pwd);        
        return $this->redisObj;
    }
    function setValueWithTtl( $key, $value, $minute = 60 ){ 
        try{ 
            $redisObject = $this->openRedisConnection( 'localhost', 6379, $pwd = 'redis98100'); 
          // setting the value in redis
            $redisObject->setex( $key, $minute, $value );
        }catch( Exception $e ){ 
            echo $e->getMessage(); 
        } 
    } 
  
    function getValueFromKey( $key ){ 
        try{ 
            $redisObject = $this->openRedisConnection( 'localhost', 6379, $pwd = 'redis98100');
          // getting the value from redis
            return $redisObject->get( $key);
        }catch( Exception $e ){ 
            echo $e->getMessage(); 
        } 
    } 
    function deleteValueFromKey( $key ){ 
        try{ 
            $redisObject = $this->openRedisConnection( 'localhost', 6379, $pwd = 'redis98100');;
          // deleting the value from redis
            $redisObject->del( $key);
        }catch( Exception $e ){ 
            echo $e->getMessage(); 
        } 
    } 

    function setValue($key, $url, $method = "GET") {
        //echo 'jsonResponse : '. 
        $jsonResponse = $this->curlClassObj->_make_rest_call($url, $method);        
        //$connectionObj = $this->openRedisConnection( 'localhost', 6379, $pwd = 'redis98100');
        $this->setValueWithTtl( $key, $jsonResponse, 36000);
    }

    function getValue($key)
    {
        return $this->getValueFromKey($key);
    }

    function write($key, $url, $method = "GET") {
        $redisClient = new Redis();        
        $redisClient->connect('localhost', 6379);
        $redisClient->auth('redis98100');
        $callResponse = $this->_make_rest_call($url, $method);
        $redisClient->set($key, $callResponse);

    }
}


?>