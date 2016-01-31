<?php

namespace App;

use Laravel\Lumen\Application as LumenApplication;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Application extends LumenApplication
{
    /**
     * {@inheritdoc}
     */
    protected function getMonologHandler()
    {
        // screw you, vagrant&virtualbox
        return new NullHandler();
    }
}
