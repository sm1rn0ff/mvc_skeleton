<?php 
    require '../Library/autoload.php';
    require '../Include/config.php';

    $app = new Applications\Backend\BackendApplication;
    $app->run();
    