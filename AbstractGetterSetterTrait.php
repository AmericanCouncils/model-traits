<?php

namespace AC\ModelTraits;

/**
 * Reduces boiler plate by providing automatic getter/setters for any defined property.
 */
trait AbstractGetterSetterTrait
{
    protected function acModelTraitsGetMethodMap()
    {
        $clsname = get_class($this);
        static $metaMap = [];
        if (!isset($metaMap[$clsname])) {
            $metaMap[$clsname] = [];
            $cls = new \ReflectionClass($clsname);
            while ($cls) {
                $map = $this->acModelTraitsGenerateMethodMap($cls);
                $metaMap[$clsname] = array_merge($metaMap[$clsname], $map);
                $cls = $cls->getParentClass();
            }
        }
        return $metaMap[$clsname];
    }

    public function __call($method, $args)
    {
        $map = $this->acModelTraitsGetMethodMap();
        if (!isset($map[$method])) {
            throw new \BadMethodCallException(sprintf(
                "No such method [%s] for class [%s].",
                $method, get_class($this)
            ));
        }
        $data = $map[$method];
        return $this->{$data['method']}($data['name'], $args);
    }

    protected function acModelTraitsGetProperty($name, $args)
    {
        return $this->$name;
    }

    protected function acModelTraitsSetProperty($name, $args)
    {
        $this->$name = $args[0];
        return $this;
    }

    abstract protected function acModelTraitsGenerateMethodMap($class);
}
