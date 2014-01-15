<?php

namespace AC\ModelTraits;

/**
 * Reduces boiler plate by providing automatic getter/setters for any defined property.  Public/Protected properties are
 * both gettable and settable, while private properties are only gettable.
 */
trait GetterSetterTrait
{
    private $methodMap = false;

    public function __call($method, $args)
    {
        $map = $this->getMethodMap();

        if (!isset($map[$method])) {
            throw new \RuntimeException(sprintf("Method [%s] missing in class [%s].", $method, get_class($this)));
        }

        $data = $map[$method];

        return $this->{$data['method']}($data['name'], $args);
    }

    private function setProperty($name, $args)
    {
        $this->$name = $args[0];

        return $this;
    }

    private function getProperty($name, $args)
    {
        return $this->$name;
    }

    private function getMethodMap()
    {
        if ($this->methodMap) {
            return $this->methodMap;
        }

        $class = new \ReflectionClass($this);
        $properties = $class->getProperties();

        $map = [];

        foreach ($properties as $prop) {
            $name = $prop->getName();
            $getter = 'get'.ucfirst($name);
            $setter = 'set'.ucfirst($name);

            $data = [
                'name' => $name,
                'ref' => $prop,
            ];

            if ($prop->isPublic() || $prop->isProtected()) {
                $map[$getter] = ['name' => $name, 'method' => 'getProperty'];
                $map[$setter] = ['name' => $name, 'method' => 'setProperty'];
            } elseif ($prop->isPrivate()) {
                $map[$getter] = ['name' => $name, 'method' => 'getProperty'];
            }
        }

        return $this->methodMap = $map;
    }
}
