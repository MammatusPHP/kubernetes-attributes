<?php

declare(strict_types=1);

namespace Mammatus\Tests\Kubernetes\Attributes;

use Mammatus\Kubernetes\Attributes\Ingress;
use PHPUnit\Framework\Attributes\Test;
use WyriHaximus\TestUtilities\TestCase;

use function json_encode;

final class IngressTest extends TestCase
{
    #[Test]
    public function jsonDefaultPath(): void
    {
        $ingress = new Ingress('www.example.test');

        self::assertSame('{"host":"www.example.test","path":"\/"}', json_encode($ingress));
    }

    #[Test]
    public function jsonCustomPath(): void
    {
        $ingress = new Ingress('api.example.test', '/v1');

        self::assertSame('{"host":"api.example.test","path":"\/v1"}', json_encode($ingress));
    }
}
