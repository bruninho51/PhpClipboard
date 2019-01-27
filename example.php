<?php
ini_set('display_errors', true);
include_once __DIR__ . '/vendor/autoload.php';
include 'AdapterExample.php';

$adapter = new AdapterExample;
$myClip = new PhpClipboard\PhpClipboard($adapter);
$form = $myClip->getForm(1);

echo $form->getHTML();
