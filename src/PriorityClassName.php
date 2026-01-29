<?php

declare(strict_types=1);

namespace Mammatus\Kubernetes\Attributes;

use Attribute;
use Mammatus\Kubernetes\Contracts\AddOn;

#[Attribute(Attribute::TARGET_CLASS)]
final readonly class PriorityClassName implements AddOn, AddOn\Pod
{
    /** @api */
    public function __construct(
        public string $priorityClassName,
    ) {
    }

    public function type(): string
    {
        return 'pod';
    }

    public function helper(): string
    {
        return 'mammatus.pod.priorityClassName';
    }

    /** @return array{type: string, helper: string, arguments: array{priorityClassName: string}} */
    public function jsonSerialize(): array
    {
        return [
            'type' => $this->type(),
            'helper' => $this->helper(),
            'arguments' => [
                'priorityClassName' => $this->priorityClassName,
            ],
        ];
    }
}
