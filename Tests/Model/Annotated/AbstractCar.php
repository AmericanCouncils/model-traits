<?php

namespace AC\ModelTraits\Tests\Model\Annotated;

use AC\ModelTraits\AnnotatedGetterSetterTrait;
use AC\ModelTraits\Annotation as ACMT;

abstract class AbstractCar
{
    use AnnotatedGetterSetterTrait;

    /**
     * @ACMT\GetterAndSetter
     */
    private $make;

    /**
     * @ACMT\GetterAndSetter
     */
    private $model;
}
