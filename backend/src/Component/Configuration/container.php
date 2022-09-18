<?php

declare(strict_types=1);

use Yiisoft\Di\Container;
use Yiisoft\Di\ContainerConfig;

return static fn (array $dependencies): Container => new Container(ContainerConfig::create()->withDefinitions($dependencies));
