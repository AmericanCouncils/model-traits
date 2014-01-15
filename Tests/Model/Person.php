<?php

namespace AC\ModelTraits\Tests\Model;

use AC\ModelTraits\GetterSetterTrait;
use AC\ModelTraits\ArrayFactoryTrait;

class Person
{
    use GetterSetterTrait, ArrayFactoryTrait;

    private $id;
    public $name;
    protected $age;

    public function __construct($id = null)
    {
        $this->id = $id;
    }
}
