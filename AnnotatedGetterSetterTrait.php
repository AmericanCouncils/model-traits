<?php

namespace AC\ModelTraits;

use AC\ModelTraits\Annotation\GetterAndSetter;
use AC\ModelTraits\Annotation\Getter;
use AC\ModelTraits\Annotation\Setter;

trait AnnotatedGetterSetterTrait
{
    use AbstractGetterSetterTrait;

    protected function acModelTraitsGenerateMethodMap($class)
    {
        $reader = AnnotationReaderFetcher::getReader();
        $map = [];

        foreach ($class->getProperties() as $prop) {
            $name = $prop->getName();
            $getter = 'get'.ucfirst($name);
            $setter = 'set'.ucfirst($name);
            $getterEnabled = false;
            $setterEnabled = false;

            if ($reader->getPropertyAnnotation($prop, 'AC\ModelTraits\Annotation\GetterAndSetter')) {
                $getterEnabled = true;
                $setterEnabled = true;
            }

            if ($reader->getPropertyAnnotation($prop, 'AC\ModelTraits\Annotation\Getter')) {
                $getterEnabled = true;
            }

            if ($reader->getPropertyAnnotation($prop, 'AC\ModelTraits\Annotation\Setter')) {
                $setterEnabled = true;
            }

            if ($getterEnabled) {
                $map[$getter] = ['name' => $name, 'method' => 'acModelTraitsGetProperty'];
            }

            if ($setterEnabled) {
                $map[$setter] = ['name' => $name, 'method' => 'acModelTraitsSetProperty'];
            }
        }

        return $map;
    }
}
