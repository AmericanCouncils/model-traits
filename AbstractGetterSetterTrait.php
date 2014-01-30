<?php

namespace AC\ModelTraits;

/**
 * Reduces boiler plate by providing automatic getter/setters for any defined property.
 */
trait AbstractGetterSetterTrait
{
    protected static $acModelTraitsMethodMap = false;

    public function __call($method, $args)
    {
        if (!static::$acModelTraitsMethodMap) {
            static::$acModelTraitsMethodMap = $this->acModelTraitsGenerateMethodMap();
        }

        if (!isset(static::$acModelTraitsMethodMap[$method])) {
            throw new \BadMethodCallException(sprintf(
                "No such method [%s] for class [%s].",
                $method, get_class($this)
            ));
        }
        $data = static::$acModelTraitsMethodMap[$method];
        return $this->{$data['method']}($data['name'], $args);
    }

    protected function acModelTraitsGetProperty($name, $args)
    {
        return $this->$name;
    }

    protected function acModelTraitsGetPrivateProperty($name, $args)
    {
        $getter = \Closure::bind(function () use ($name, $args) {
            return $this->$name;
        }, $this, $this);
        return $getter($name, $args);
    }

    protected function acModelTraitsSetProperty($name, $args)
    {
        $this->$name = $args[0];
        return $this;
    }

    protected function acModelTraitsSetPrivateProperty($name, $args)
    {
        $setter = \Closure::bind(function () use ($name, $args) {
            $this->$name = $args[0];
            return $this;
        }, $this, $this);
        return $setter($name, $args);
    }

    abstract protected function acModelTraitsGenerateMethodMap();
}
