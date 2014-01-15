# Model Traits #

[![Build Status](https://travis-ci.org/AmericanCouncils/model-traits.png?branch=master)](https://travis-ci.org/AmericanCouncils/model-traits)

This is a small convenience library for reusing some common patterns in model classes.  Each trait is defined
in a section below.

## Installing ##

Just require `"ac/model-traits": "0.1.0"` in your `composer.json` and run `composer update ac/model-traits`.

## GetterSetterTrait ##

This will use some reflection magic to allow you to use getters/setters for any property, without having to define them yourself.  Of course
you are still free to explicitly override any getters/setters for properties where you want or need custom logic.  Some assumptions are baked
into this:

* `public` and `protected` properties are both settable and gettable
* `private` properties are only gettable

Example:

```php
use AC\ModelTraits\GetterSetterTrait;

class MyModel
{
    use GetterSetterTrait;

    private $id;
    protected $name;
    protected $description;

    public function __construct($id = null)
    {
        $this->id = $id;
    }
}

$m = new MyModel(5);
$m->setName('John');
$m->setAge(23);

echo $m->getId();       //5
echo $m->getName();     //John
echo $m->getAge();      //23
```

## ArrayFactoryTrait ##

This adds a static factory method to allow creating an instance of a model with a map of property names to values.  It does assume that
any exhibiting model does not require custom arguments in its constructor.  This will allow setting private properties during creation.

Example:

```php
use AC\ModelTraits\GetterSetterTrait
use AC\ModelTraits\ArrayFactoryTrait;

class MyModel
{
    use ArrayFactoryTrait, GetterSetterTrait;

    private $id;
    protected $name;
    protected $description;
}

$m = MyModel::createFromArray([
    'id' => 5,
    'name' => 'John',
    'age' => 23
]);

echo $m->getId();       //5
echo $m->getName();     //John
echo $m->getAge();      //23
```
