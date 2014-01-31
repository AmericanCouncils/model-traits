<?php

namespace AC\ModelTraits\Tests\Model\Annotated;

use AC\ModelTraits\AnnotatedGetterSetterTrait;
use AC\ModelTraits\Annotation as ACMT;

class Corvette extends AbstractCar
{
    use AnnotatedGetterSetterTrait;

    /**
     * @ACMT\GetterAndSetter
     */
    private $color;
}
