<?php

namespace Test\Component\Http;

use Component\Http\ParameterBag;
use PHPUnit\Framework\TestCase;

use Component\Http\Request;

class RequestTest extends TestCase
{

    public function testCreateFromGlobals()
    {
        $_GET['foo1'] = 'bar1';
        $_POST['foo2'] = 'bar2';
        $_SERVER['foo3'] = 'bar3';

        $request = Request::createFromGlobals();

        $this->assertEquals('bar1', $request->query->get('foo1'));
        $this->assertEquals('bar2', $request->request->get('foo2'));
        $this->assertEquals('bar3', $request->server->get('foo3'));

        $this->assertInstanceOf(ParameterBag::class, $request->request);
    }

    public function testGetSetMethod()
    {
        $request = Request::createFromGlobals();

        $this->assertEquals('GET', $request->getMethod());

        $request->setMethod('POST');

        $this->assertEquals('POST', $request->getMethod());
    }
}
