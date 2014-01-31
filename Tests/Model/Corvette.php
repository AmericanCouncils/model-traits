<?php

namespace AC\ModelTraits\Tests\Model;

use AC\ModelTraits\AutoGetterSetterTrait;
use AC\ModelTraits\ArrayFactoryTrait;

class Corvette extends AbstractCar
{
    use AutoGetterSetterTrait, ArrayFactoryTrait;

    protected $color;
}
