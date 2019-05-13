<?php
require_once '../vendor/autoload.php';

try
{
    \Miciew\Router\Router::getInstance()->run();    
}
catch (Exception $exception)
{
    echo '<pre> '; print_r($exception); echo '<br>'. __FILE__ . ' ' . __LINE__ .'</pre>';
}

