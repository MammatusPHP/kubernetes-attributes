<?php

declare(strict_types=1);

namespace Mammatus\Kubernetes\Attributes;

use Attribute;
use Mammatus\Kubernetes\Contracts\AddOn;

use function ceil;

#[Attribute(Attribute::TARGET_CLASS)]
final readonly class Resources implements AddOn, AddOn\Container
{
    /**
     * @param non-negative-int|float $cpu    Non-negative value in CPU cores
     * @param non-negative-int|float $memory Non-negative value in GigaBytes
     *
     * @api
     */
    public function __construct(
        public int|float $cpu,
        public int|float $memory,
    ) {
    }

    public function type(): string
    {
        return 'container';
    }

    public function helper(): string
    {
        return 'mammatus.container.resources';
    }

    /** @return array{type: string, helper: string, arguments: array{cpu: string, memory: string}} */
    public function jsonSerialize(): array
    {
        return [
            'type' => $this->type(),
            'helper' => $this->helper(),
            'arguments' => [
                'cpu' => ceil($this->cpu * 1000) . 'm',
                'memory' => ceil($this->memory * 1024) . 'Mi',
            ],
        ];
    }
}
