<?php
require_once 'curl.php';
echo "<h1>Welcome to PHP World.</h1>";

$redisObject = new curl();


$redisObject->setValue(
    'sharak', 
    $url = 'http://investocart.mindstack.in/wordpress/wp-json/wp/v2/home_page_intro/4821',
    $method = "GET"
);

?>