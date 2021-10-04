<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once 'redisAdapter.php';
require_once 'apiUrls.php';


echo "<br>";
echo "<h1>Welcome to PHP World.</h1>";

echo "<br>";
echo "<br>";

$redisAdapter = new redisAdapter();


$redisAdapter->setValue(
    'sharak',
    $url = HOME_PAGE_INTRO,
    $method = "GET"
);

$value = $redisAdapter->getValue('sharak');
echo '===> <br>'. $value;

?>
