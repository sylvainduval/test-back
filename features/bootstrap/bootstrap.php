<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(dirname(__DIR__)).'/vendor/autoload.php';

(new Dotenv())->bootEnv(dirname(dirname(__DIR__)).'/.env');
