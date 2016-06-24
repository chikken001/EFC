<?php
require '../../Library/Autoload.php';
require '../../Library/Exception.php' ;

$app = new Applications\Backend\BackendApplication;

$app->run();