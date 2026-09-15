<?php

declare(strict_types=1);

namespace Mammatus\Kubernetes\Attributes;

use Attribute;
use JsonSerializable;

#[Attribute(Attribute::TARGET_CLASS)]
final readonly class Ingress implements JsonSerializable
{
    /**
     * @api
     * @phpstan-ignore ergebnis.noConstructorParameterWithDefaultValue
     */
    public function __construct(
        public string $host,
        public string $path = '/',
    ) {
    }

    /** @return array{host: string, path: string} */
    public function jsonSerialize(): array
    {
        return [
            'host' => $this->host,
            'path' => $this->path,
        ];
    }
}
