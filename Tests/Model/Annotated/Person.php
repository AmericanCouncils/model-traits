<?php

namespace AC\ModelTraits\Tests\Model\Annotated;

use AC\ModelTraits\AnnotatedGetterSetterTrait;
use AC\ModelTraits\Annotation as ACMT;

class Person
{
    use AnnotatedGetterSetterTrait;

    /**
     * @ACMT\Getter
     */
    private $id;

    /**
     * @ACMT\GetterAndSetter
     */
    public $name;

    /**
     * @ACMT\Setter
     */
    public $age;

    public function __construct($id = null)
    {
        $this->id = $id;
    }
}
