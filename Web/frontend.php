<?php
    require '../Library/autoload.php';
    require '../Include/config.php';

    $app = new Applications\Frontend\FrontendApplication;
    $app->run();