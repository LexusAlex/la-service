<?php

declare(strict_types=1);

use League\Container\Container;
use League\Container\Definition\Definition;

return static function (array $dependencies): Container {
    $definitions = [];

    foreach ($dependencies as $keyDependency => $dependency) {
        $definitions[] = (new Definition($keyDependency,$dependency));
    }

    $aggregate = new League\Container\Definition\DefinitionAggregate($definitions);
    return new League\Container\Container($aggregate);
};

