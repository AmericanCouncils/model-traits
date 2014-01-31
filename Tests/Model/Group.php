<?php

namespace AC\ModelTraits\Tests\Model;

use AC\ModelTraits\AutoGetterSetterTrait;
use AC\ModelTraits\ArrayFactoryTrait;

class Group
{
    use AutoGetterSetterTrait, ArrayFactoryTrait;

    protected $name;
    protected $owner;
    protected $description;

    public function setOwner(Person $person)
    {
        $this->owner = $person;
        return "foo";
    }
}
