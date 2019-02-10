<?php
ini_set('display_errors', true);
include_once __DIR__ . '/../vendor/autoload.php';
include 'AdapterExample.php';

$adapter = new AdapterExample;
$phpClipboard = new PhpClipboard\PhpClipboard($adapter);
$phpClipboard->process($_POST);
