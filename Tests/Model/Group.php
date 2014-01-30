<?php

namespace AC\ModelTraits\Tests\Model;

use AC\ModelTraits\GetterSetterTrait;
use AC\ModelTraits\ArrayFactoryTrait;

class Group
{
    use GetterSetterTrait, ArrayFactoryTrait;

    protected $name;
    protected $owner;
    protected $description;

    public function setOwner(Person $person)
    {
        $this->owner = $person;
        return "foo";
    }
}
