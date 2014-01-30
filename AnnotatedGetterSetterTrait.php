<?php

namespace AC\ModelTraits;

use AC\ModelTraits\Annotation\GetterAndSetter;
use AC\ModelTraits\Annotation\Getter;
use AC\ModelTraits\Annotation\Setter;

trait AnnotatedGetterSetterTrait
{
    use AbstractGetterSetterTrait;

    private function acModelTraitsPropsFetch($cls)
    {
        $props = [];
        foreach ($cls->getProperties() as $prop) {
            $props[$prop->getName()] = $prop;
        }
        if ($parent = $cls->getParentClass()) {
            $props = array_merge($props, $this->acModelTraitsPropsFetch($parent));
        }
        foreach ($cls->getTraits() as $name => $trait) {
            $props = array_merge($props, $this->acModelTraitsPropsFetch($trait));
        }
        return $props;
    }


    protected function acModelTraitsGenerateMethodMap()
    {
        $reader = AnnotationReaderFetcher::getReader();
        $class = new \ReflectionClass($this);
        $map = [];

        foreach ($this->acModelTraitsPropsFetch($class) as $name => $prop) {
            $getter = 'get'.ucfirst($name);
            $setter = 'set'.ucfirst($name);
            $getterEnabled = false;
            $setterEnabled = false;

            if ($reader->getPropertyAnnotation($prop, GetterAndSetter::class)) {
                $getterEnabled = true;
                $setterEnabled = true;
            }

            if ($reader->getPropertyAnnotation($prop, Getter::class)) {
                $getterEnabled = true;
            }
            
            if ($reader->getPropertyAnnotation($prop, Setter::class)) {
                $setterEnabled = true;
            }

            if ($getterEnabled) {
                $method = 'acModelTraitsGet' . ($prop->isPrivate() ? 'Private' : '') . 'Property';
                $map[$getter] = ['name' => $name, 'method' => $method];
            }

            if ($setterEnabled) {
                $method = 'acModelTraitsSet' . ($prop->isPrivate() ? 'Private' : '') . 'Property';
                $map[$setter] = ['name' => $name, 'method' => $method];
            }
        }

        return $map;
    }
}
