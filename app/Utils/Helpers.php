<?php

/**
 * Get the configuration path.
 *
 * @param string $path This is path.
 * @return string
 */
function config_path(string $path = '')
{
    return app()->basePath() . '/config' . ( $path ? '/' . $path : $path );
}