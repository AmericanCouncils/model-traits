<?php

namespace AC\ModelTraits\Tests\Model\Annotated;

use AC\ModelTraits\Annotation as ACMT;

class Corvette extends AbstractCar
{
    /**
     * @ACMT\GetterAndSetter
     */
    // FIXME: Try making this private
    protected $color;
}
