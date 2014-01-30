<?php

namespace AC\ModelTraits;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

class AnnotationReaderFetcher
{
    private static $reader;

    public static function getReader()
    {
        if (!isset(static::$reader)) {
            $loader = require('vendor/autoload.php');
            AnnotationRegistry::registerLoader([$loader, 'loadClass']);
            static::$reader = new AnnotationReader;
        }

        return static::$reader;
    }

    public static function setReader($r)
    {
        static::$reader = $r;
    }
}
