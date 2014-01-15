<?php

namespace AC\ModelTraits;

trait ArrayFactoryTrait
{
    public static function createFromArray(array $data)
    {
        $instance = new static();

        foreach ($data as $key => $val) {
            if (!property_exists($instance, $key)) {
                throw new \InvalidArgumentException(sprintf("Property [%s] does not exist (or is not visible within) class [%s].", $key, get_class($instance)));
            }

            $instance->$key = $val;
        }

        return $instance;
    }
}
