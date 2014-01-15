<?php

namespace AC\ModelTraits\Tests;

use AC\ModelTraits\Tests\Model\Person;
use AC\ModelTraits\Tests\Model\Group;
use AC\ModelTraits\Tests\Model\Corvette;

class ArrayFactoryTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateFromArray()
    {
        $p = Person::createFromArray([
            'name' => 'John',
            'age' => 27
        ]);

        $this->assertTrue($p instanceof Person);
        $this->assertSame('John', $p->getName());
        $this->assertSame(27, $p->getAge());
    }

    public function testFailIfPropertyDoesNotExist()
    {
        $this->setExpectedException('InvalidArgumentException');
        $p = Person::createFromArray([
            'id' => 3,
            'name' => 'John',
            'foo' => 'bar'
        ]);
    }

    public function testCreateNestedFromArray()
    {
        $g = Group::createFromArray([
            'name' => 'Example',
            'owner' => Person::createFromArray(['name' => 'John'])
        ]);

        $this->assertTrue($g instanceof Group);
        $this->assertTrue($g->getOwner() instanceof Person);
    }

    public function testInheritedTrait()
    {
        $c = Corvette::createFromArray([
            'make' => 'Chevy',
            'model' => 1901,
            'color' => 'green'
        ]);

        $this->assertTrue($c instanceof Corvette);
        $this->assertSame('Chevy', $c->getMake());
        $this->assertSame(1901, $c->getModel());
        $this->assertSame('green', $c->getColor());
    }

}
