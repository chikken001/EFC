<?php

define("PICTURE_FOLDER", '/Web/upload/pictures/');
define("PICTURE_FOLDER_TEAM", '/Web/upload/pictures_team/');

require '../../Library/Autoload.php';
require '../../Library/Exception.php' ;

$app = new Applications\Frontend\FrontendApplication;

$app->run();
