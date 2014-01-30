<?php

namespace AC\ModelTraits\Tests\Model\Annotated;

use AC\ModelTraits\AnnotatedGetterSetterTrait;

class Group
{
    use AnnotatedGetterSetterTrait;

    /**
     * @ACMT\GetterAndSetter
     */
    protected $name;

    /**
     * @ACMT\GetterAndSetter
     */
    protected $owner;

    /**
     * @ACMT\GetterAndSetter
     */
    protected $description;

    public function setOwner(Person $person)
    {
        $this->owner = $person;
        return "foo";
    }
}
