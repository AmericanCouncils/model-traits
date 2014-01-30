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
            throw new \RuntimeException(sprintf("Method [%s] missing in class [%s].", $method, get_class($this)));
        }

        $data = static::$acModelTraitsMethodMap[$method];

        return $this->{$data['method']}($data['name'], $args);
    }

    protected function acModelTraitsSetProperty($name, $args)
    {
        $this->$name = $args[0];

        return $this;
    }

    protected function acModelTraitsGetProperty($name, $args)
    {
        return $this->$name;
    }

    abstract protected function acModelTraitsGenerateMethodMap();
}
