<?php

declare(strict_types=1);

namespace Mammatus\Kubernetes\Attributes;

use Attribute;
use Mammatus\Kubernetes\Contracts\AddOn;

#[Attribute(Attribute::TARGET_CLASS)]
final readonly class NodeSelector implements AddOn, AddOn\Pod
{
    public function __construct(
        public string $key,
        public string $value,
    ) {
    }

    public function type(): string
    {
        return 'pod';
    }

    public function helper(): string
    {
        return 'mammatus.pod.nodeSelector';
    }

    /** @return array{type: string, helper: string, arguments: array{key: string, value: string}} */
    public function jsonSerialize(): array
    {
        return [
            'type' => $this->type(),
            'helper' => $this->helper(),
            'arguments' => [
                'key' => $this->key,
                'value' => $this->value,
            ],
        ];
    }
}
