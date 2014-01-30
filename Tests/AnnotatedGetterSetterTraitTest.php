<?php

namespace AC\ModelTraits\Tests;

use AC\ModelTraits\Tests\Model\Annotated\Person;
use AC\ModelTraits\Tests\Model\Annotated\Group;
use AC\ModelTraits\Tests\Model\Annotated\Corvette;

class AnnotatedGetterSetterTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testGetAndSetPublicProperty()
    {
        $p = new Person();
        $this->assertNull($p->getName());

        $p->setName('Foobert');
        $this->assertSame('Foobert', $p->getName());
    }

    public function testSetOnlyProperty()
    {
        $p = new Person();
        $p->setAge(86);
        $this->assertSame(86, $p->age);

        $this->setExpectedException('BadMethodCallException');
        $p->getAge();
    }

    public function testGetOnlyProperty()
    {
        $p = new Person(5);
        $this->assertSame(5, $p->getId());

        $this->setExpectedException('BadMethodCallException');
        $p->setId(1);
    }

    public function testOverriddenMethods()
    {
        $g = new Group();
        $r = $g->setOwner(new Person(5));
        $this->assertSame("foo", $r);
    }

    public function testInheritedTrait()
    {
        $car = new Corvette();

        $car->setMake('Chevy');
        $car->setModel(2054);

        $car->setColor('blue');

        $this->assertSame('blue', $car->getColor());
        $this->assertSame('Chevy', $car->getMake());
    }
}
