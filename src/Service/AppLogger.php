<?php

namespace App\Service;

use think\facade\Log;

/**
 * 工厂设计模式
 */
class AppLogger
{
    const TYPE_LOG4PHP = 'log4php';

    const TYPE_THINK = 'think-log';

    private $logger;

    public function __construct($type = self::TYPE_LOG4PHP)
    {
        if ($type == self::TYPE_LOG4PHP) {
            $this->logger = Log4php::getInstance();
        }
        if ($type == self::TYPE_THINK) {
            $this->logger = ThinkLog::getInstance();
        }
    }

    public function info($message = '')
    {
        $this->logger->info($message);
    }

    public function debug($message = '')
    {
        $this->logger->debug($message);
    }

    public function error($message = '')
    {
        $this->logger->error($message);
    }
}

/**
 *  单例 + 桥接模式
 */
class Log4php {
    private  $logger = null;
    public static $log4php = null;
    private function __construct()
    {
        if ($this->logger == null) {
            $this->logger = \Logger::getLogger("Log");
        }
    }

    public static function getInstance()
    {
        if (static::$log4php == null){
            static::$log4php = new static();
        }
        return static::$log4php;
    }

    public function info($message = '')
    {
        $this->logger->info($message);
    }

    public function debug($message = '')
    {
        $this->logger->debug($message);
    }

    public function error($message = '')
    {
        $this->logger->error($message);
    }

    private function __clone()
    {
    }
}

/**
 *  单例 + 桥接 设计模式
 */
class ThinkLog {
    public static $thinkLog = null;
    private function __construct()
    {
        Log::init([
            'default'	=>	'file',
            'channels'	=>	[
                'file'	=>	[
                    'type'	=>	'file',
                    'path'	=>	'/tmp/logs/',
                ],
            ],
        ]);
    }

    public static function getInstance()
    {
        if (static::$thinkLog == null){
            static::$thinkLog = new static();
        }
        return static::$thinkLog;
    }

    public function info($message = '')
    {
        Log::info(strtoupper($message));
    }

    public function debug($message = '')
    {
        Log::debug(strtoupper($message));
    }

    public function error($message = '')
    {
        Log::error(strtoupper($message));
    }

    public function __destruct()
    {
        Log::save();
    }

    private function __clone()
    {
    }
}