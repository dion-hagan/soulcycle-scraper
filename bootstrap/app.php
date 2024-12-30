<?php

use LaravelZero\Framework\Application;
use Dotenv\Dotenv;

$app = Application::configure(basePath: dirname(__DIR__))->create();

Dotenv::createImmutable(dirname(__DIR__))->safeLoad();

return $app;
