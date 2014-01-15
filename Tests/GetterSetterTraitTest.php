<?php

namespace AC\ModelTraits\Tests;

use AC\ModelTraits\Tests\Model\Person;
use AC\ModelTraits\Tests\Model\Group;
use AC\ModelTraits\Tests\Model\Corvette;

class GetterSetterTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testGetAndSetPublicProperty()
    {
        $p = new Person();
        $this->assertNull($p->getName());

        $p->setName('Foobert');
        $this->assertSame('Foobert', $p->getName());
    }

    public function testGetAndSetProtectedProperty()
    {
        $p = new Person();
        $this->assertNull($p->getAge());

        $p->setAge(86);
        $this->assertSame(86, $p->getAge());
    }

    public function testGetAndSetPrivateProperty()
    {
        $p = new Person(5);
        $this->assertSame(5, $p->getId());

        $this->setExpectedException('RuntimeException');
        $p->setId(1);
    }

    public function testOverriddenMethods()
    {
        $g = new Group();
        $g->setName('Test');
        $g->setOwner(new Person(5));

        $this->setExpectedException('Exception');
        $g->setOwner(5);
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
