<?php

declare(strict_types=1);


namespace Mammatus\Tests\Kubernetes\Attributes;

use Mammatus\Kubernetes\Attributes\PriorityClassName;
use Mammatus\Kubernetes\Attributes\Resources;
use WyriHaximus\TestUtilities\TestCase;

final class PriorityClassNameTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function json(): void
    {
        $resources = new PriorityClassName('rock-bottom');

        self::assertSame('{"type":"pod","helper":"mammatus.pod.priorityClassName","arguments":{"priorityClassName":"rock-bottom"}}', json_encode($resources));
    }
}
