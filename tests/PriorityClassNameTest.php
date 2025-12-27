<?php

declare(strict_types=1);

namespace Mammatus\Tests\Kubernetes\Attributes;

use Mammatus\Kubernetes\Attributes\PriorityClassName;
use PHPUnit\Framework\Attributes\Test;
use WyriHaximus\TestUtilities\TestCase;

use function json_encode;

final class PriorityClassNameTest extends TestCase
{
    #[Test]
    public function json(): void
    {
        $resources = new PriorityClassName('rock-bottom');

        self::assertSame('{"type":"pod","helper":"mammatus.pod.priorityClassName","arguments":{"priorityClassName":"rock-bottom"}}', json_encode($resources));
    }
}
