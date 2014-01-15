<?php

namespace AC\ModelTraits\Tests\Model;

use AC\ModelTraits\GetterSetterTrait;
use AC\ModelTraits\ArrayFactoryTrait;

abstract class AbstractCar
{
    use GetterSetterTrait, ArrayFactoryTrait;

    protected $make;
    protected $model;
}
