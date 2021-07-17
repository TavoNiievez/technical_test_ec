<?php

namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Netflix\ExampleContext\Domain\Placeholder;

class PlaceholderTest extends TestCase
{
    public function testSomething(): void
    {
        $placeholder = new Placeholder();
        $this->assertEquals(5, $placeholder->example());
    }
}
