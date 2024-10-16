# Contracts for Kubernetes related attributes

![Continuous Integration](https://github.com/mammatusphp/kubernetes-attributes/workflows/Continuous%20Integration/badge.svg)
[![Latest Stable Version](https://poser.pugx.org/mammatus/kubernetes-attributes/v/stable.png)](https://packagist.org/packages/mammatus/kubernetes-attributes)
[![Total Downloads](https://poser.pugx.org/mammatus/kubernetes-attributes/downloads.png)](https://packagist.org/packages/mammatus/kubernetes-attributes/stats)
[![Type Coverage](https://shepherd.dev/github/mammatusphp/kubernetes-attributes/coverage.svg)](https://shepherd.dev/github/mammatusphp/kubernetes-attributes)
[![License](https://poser.pugx.org/mammatus/kubernetes-attributes/license.png)](https://packagist.org/packages/mammatus/kubernetes-attributes)

# Install

To install via [Composer](http://getcomposer.org/), use the command below, it will automatically detect the latest version and bind it with `^`.

```
composer require mammatus/kubernetes-attributes
```

# Attributes

This package provides the following attributes:

## Resources

The `Resources` attribute is an addon for other attributes used in conjunction with the `SplitOut` attribute to
configure the expected resources a split out operation can used. Both the `cpu` and `memory` arguments must provided
with a non-negative value. The `cpu` argument works in full CPU cores. It translates everything into the string
notation, so `1` becomes `1000m` and `13.37` becomes `13370m`. Same goes for the `memory` argument, it takes in
GigaBytes and turns it into MegaBytes. `0.5` becomes `512Mi`.

## SplitOut

Mammatus is build with both big and small budgets in mind. By default every HTTP server, queue consumer, cronjob etc
will run in a general all purpose pod. By using the `SplitOut` on that specific class will mark it to be a separate
resource in Kubernetes. Cronjobs will become Kubernetes cronjob, the rest will become a deployment.

# Example

The following example is from one of the services that runs on my home cluster using both the `Resources` and
`SplitOut` attributes:

```php
<?php

declare(strict_types=1);

namespace WyriHaximus\Apps\WorldOfWarcraft\DataMiner\Images\BLP;

use Mammatus\Cron\Attributes\Cron;
use Mammatus\Cron\Contracts\Action;
use Mammatus\Kubernetes\Attributes\Resources;
use Mammatus\Kubernetes\Attributes\SplitOut;
use Psr\Log\LoggerInterface;

use function React\Async\await;
use function substr;

#[SplitOut]
#[Cron(
    'scan-images-blp-to-png',
    259200,
    '8 7 * * *',
    new Resources(
        cpu: 0.666,
        memory: 3,
    ),
)]
final readonly class Scan implements Action
{
    public function __construct(
        private LoggerInterface $logger,
    ) {
    }

    public function perform(): void
    {
        $this->logger->debug('Performing Cron Job');
    }
}
```

# License

The MIT License (MIT)

Copyright (c) 2024 Cees-Jan Kiewiet

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
