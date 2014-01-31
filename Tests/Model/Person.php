<?php

namespace AC\ModelTraits\Tests\Model;

use AC\ModelTraits\AutoGetterSetterTrait;
use AC\ModelTraits\ArrayFactoryTrait;

class Person
{
    use AutoGetterSetterTrait, ArrayFactoryTrait;

    private $id;
    public $name;
    protected $age;

    public function __construct($id = null)
    {
        $this->id = $id;
    }
}
