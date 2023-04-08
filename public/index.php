<?php

use App\Service\Session;

require_once '../vendor/autoload.php';
new Session();

$app = require_once '../bootstrap/app.php';

$app->handle();
