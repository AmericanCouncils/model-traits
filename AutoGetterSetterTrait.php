<?php

namespace AC\ModelTraits;

trait AutoGetterSetterTrait
{
    use AbstractGetterSetterTrait;

    protected function acModelTraitsGenerateMethodMap()
    {
        $class = new \ReflectionClass($this);
        $map = [];

        foreach ($class->getProperties() as $prop) {
            $name = $prop->getName();
            $getter = 'get'.ucfirst($name);
            $setter = 'set'.ucfirst($name);

            $map[$getter] = ['name' => $name, 'method' => 'acModelTraitsGetProperty'];
            if ($prop->isPublic() || $prop->isProtected()) {
                $map[$setter] = ['name' => $name, 'method' => 'acModelTraitsSetProperty'];
            }
        }

        return $map;
    }
}
