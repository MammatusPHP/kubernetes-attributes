<?php

declare(strict_types=1);

namespace Mammatus\Tests\Kubernetes\Attributes;

use Mammatus\Kubernetes\Attributes\NodeSelector;
use PHPUnit\Framework\Attributes\Test;
use WyriHaximus\TestUtilities\TestCase;

use function json_encode;

final class NodeSelectorTest extends TestCase
{
    #[Test]
    public function json(): void
    {
        $resources = new NodeSelector('wyrihaximus.net/region', 'ground-floor');

        self::assertSame('{"type":"pod","helper":"mammatus.pod.nodeSelector","arguments":{"key":"wyrihaximus.net\/region","value":"ground-floor"}}', json_encode($resources));
    }
}
