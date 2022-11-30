<?php

namespace Test\Component\Http;

use Component\Http\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testSend()
    {
        $response = new Response();
        $responseSent = $response->send();
        $this->assertObjectHasAttribute('headers', $responseSent);
    }
}
