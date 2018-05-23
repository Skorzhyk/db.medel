<?php

require_once 'Api.php';

if (!$q = strpos($_SERVER['REQUEST_URI'], '?')) {
    $q = strlen($_SERVER['REQUEST_URI']);
}

$url = explode('/', substr($_SERVER['REQUEST_URI'], 1, $q - 1));

$api = new Api();

$api->execute($url[0], $url[1], json_decode($_REQUEST['data'], true));




