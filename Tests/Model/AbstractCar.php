<?php

namespace AC\ModelTraits\Tests\Model;

use AC\ModelTraits\AutoGetterSetterTrait;
use AC\ModelTraits\ArrayFactoryTrait;

abstract class AbstractCar
{
    use AutoGetterSetterTrait, ArrayFactoryTrait;

    protected $make;
    protected $model;
}
