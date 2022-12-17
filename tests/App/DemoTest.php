<?php

namespace Test\App;

use PHPUnit\Framework\TestCase;
use App\Util\HttpRequest;
use App\Service\AppLogger;

class DemoTest extends TestCase
{
    const URL = "http://some-api.com/user_info";
    private $_logger;
    private $_req;

    public function test_foo()
    {
        $this->assertEquals("bar","bar");
    }

    public function test_get_user_info()
    {
        $this->_logger = new AppLogger();
        $this->_req = new HttpRequest();
        $result = $this->_req->get(self::URL);
        $result_arr = $result ? json_decode($result, true) : [];
        if (in_array('error', $result_arr) && $result_arr['error'] == 0) {
            if (in_array('data', $result_arr)) {
                $this->assertEquals($result_arr,[
                    'error' => 0,
                    'data' => [
                        'id' => 1,
                        'username' => 'hello world',
                    ],
                ]);
            }
        } else {
            $this->_logger->error("fetch data error.");
        }
        $this->assertEquals(1,1);
    }
}
