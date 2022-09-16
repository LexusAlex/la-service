<?php

declare(strict_types=1);

use Yiisoft\Di\Container;
use Yiisoft\Di\ContainerConfig;

return static function (array $dependencies): Container {
    return new Container(ContainerConfig::create()->withDefinitions($dependencies));
};

