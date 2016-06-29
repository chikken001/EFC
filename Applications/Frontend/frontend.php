<?php

define("PICTURE_FOLDER", '/Web/upload/pictures/');

require '../../Library/Autoload.php';
require '../../Library/Exception.php' ;

$app = new Applications\Frontend\FrontendApplication;

$app->run();
