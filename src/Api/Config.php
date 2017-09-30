<?php
namespace Api;

/**
 * Class Config
 * Require easily config file's data
 * @package Api
 */
class Config
{
    static private $path = __DIR__ . '/../../config/';

    /**
     * Return config file's data
     *
     * @param string $name
     * @param null|string|null $path
     * @return array|null
     */
    public static function get(string $name, ?string $path = null):?array
    {
        $response = null;
        $dir = self::getCleanDir($path);

        if (\file_exists($dir . $name . '.php')) {
            $response = require $dir . $name . '.php';
        }

        if (\file_exists($dir . $name)) {
            $response = require $dir . $name;
        }

        return $response;
    }

    /**
     * @param null|string $path
     * @return string
     */
    private function getCleanDir(?string $path): string
    {
        $dir = self::$path;
        if ($path) {
            if (substr($path, 0, 1) != '/') {
                $path = '/' . $path;
            }

            if (substr($path, -1) != '/') {
                $path = $path . '/';
            }

            $dir = __DIR__ . '/../..' . $path;
        }

        return $dir;
    }
}
