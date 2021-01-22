<?php

require_once('global.php');
$currentUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$request = str_replace($appUrl, '', $currentUrl);
$request = str_replace('/', '', $request);
$request = strtolower($request);