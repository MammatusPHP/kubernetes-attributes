<?php

declare(strict_types=1);

namespace Mammatus\Kubernetes\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
final readonly class Group
{
    public function __construct(
        public string $group,
    ) {
    }
}
