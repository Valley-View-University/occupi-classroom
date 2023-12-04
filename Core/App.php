<?php

namespace Core;

class App
{
    protected static object $container;

    public static function setContainer($container): void
    {
        static::$container = $container;
    }

    public static function bind($class, $resolve): void
    {
        static::$container->bind($class, $resolve);
    }

    public static function resolve($class)
    {
        return static::$container->resolve($class);
    }
}