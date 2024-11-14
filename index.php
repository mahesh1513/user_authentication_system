<?php

include_once __DIR__ . '/Routes.php';
$url = trim($_REQUEST['url']);
$sanitized_url = filter_var($url, FILTER_SANITIZE_URL);
$router = new Routes();
$router->route($sanitized_url);


?>