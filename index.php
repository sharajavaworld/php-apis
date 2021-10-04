<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'redis_adapter.php';
echo "<h1>Welcome to PHP World.</h1>";

$redisAdapter = new redisAdapter();


$redisAdapter->setValue(
    'sharak', 
    $url = 'http://investocart.mindstack.in/wordpress/wp-json/wp/v2/home_page_intro/4821',
    $method = "GET"
);

$value = $redisAdapter->getValue('sharak');
echo '===> '. $value;

?>