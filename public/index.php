<?php

use App\Http\Controllers\ViewController;

require_once '../vendor/autoload.php';

require_once '../bootstrap/app.php';




(new ViewController())->authorization();
