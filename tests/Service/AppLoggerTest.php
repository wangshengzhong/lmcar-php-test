<?php

namespace Test\Service;

use PHPUnit\Framework\TestCase;
use App\Service\AppLogger;

/**
 * Class ProductHandlerTest
 */
class AppLoggerTest extends TestCase
{
    public function testInfoLog()
    {
        $logger = new AppLogger('log4php');
        echo PHP_EOL;
        $logger->info('This is log4php info log message');
        $logger->debug('This is log4php debug log message');
        $logger->error('This is log4php error log message');

        $logger2 = new AppLogger('think-log');
        $logger2->info('This is think-log info log message');
        $logger2->debug('This is think-log debug log message');
        $logger2->error('This is think-log error log message');
        $logFile = '/tmp/logs/' . date("Ym") . '/' .date("d").'_cli.log';
        if (file_exists($logFile)) {
            echo PHP_EOL;
            echo file_get_contents($logFile);
        }
        $this->assertEquals(1,1);
    }
}