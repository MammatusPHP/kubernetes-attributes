<?php

declare(strict_types=1);


namespace Mammatus\Tests\Kubernetes\Attributes;

use Mammatus\Kubernetes\Attributes\Resources;
use WyriHaximus\TestUtilities\TestCase;

final class ResourcesTest extends TestCase
{
    /**
     * @test
     */
    public function jsonLowResources(): void
    {
        $resources = new Resources(0.1, 0.5);

        self::assertSame('{"type":"container","helper":"mammatus.container.resources","arguments":{"cpu":"100m","memory":"512Mi"}}', \Safe\json_encode($resources));
    }

    /**
     * @test
     */
    public function jsonHighResources(): void
    {
        $resources = new Resources(13.371337, 128.256);

        self::assertSame('{"type":"container","helper":"mammatus.container.resources","arguments":{"cpu":"13372m","memory":"131335Mi"}}', \Safe\json_encode($resources));
    }
}
