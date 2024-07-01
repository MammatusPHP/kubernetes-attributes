<?php

declare(strict_types=1);

namespace Mammatus\Kubernetes\Attributes;

use Mammatus\Kubernetes\Contracts\AddOn;

#[\Attribute(\Attribute::TARGET_CLASS)]
final readonly class Resources implements AddOn, AddOn\Container
{
    public function __construct(
        public int|float $cpu,
        public int|float $memory,
    )
    {
    }

    public function type(): string
    {
        return 'container';
    }

    public function helper(): string
    {
        return 'mammatus.container.resources';
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => 'container',
            'helper' => 'mammatus.container.resources',
            'arguments' => [
                'cpu' => ($this->cpu * 1000) . 'm',
                'memory' => ($this->memory * 1024) . 'Mi',
            ],
        ];
    }
}
