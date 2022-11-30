<?php

namespace Test\Component\Http;

use Component\Http\ParameterBag;
use PHPUnit\Framework\TestCase;

class ParameterBagTest extends TestCase
{
    public function testGet()
    {
        $bag = new ParameterBag(['foo' => 'bar', 'null' => null]);

        $this->assertNull($bag->get('unknown'));
        $this->assertEquals('bar', $bag->get('foo'));
    }

    public function testSet()
    {
        $bag = new ParameterBag([]);

        $bag->set('foo', 'bar');
        $this->assertEquals('bar', $bag->get('foo'));

        $bag->set('foo', 'baz');
        $this->assertEquals('baz', $bag->get('foo'), 'overrides set parameter');

    }
}
