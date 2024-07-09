<?php

use PHPUnit\Framework\TestCase;
use Tsumari\Icalendar\Cal;

class ExampleTest extends TestCase
{
    public function testSayHello()
    {
        $example = new Cal();
        $this->assertEquals('Hello, World!', $example->sayHello());
    }
}
