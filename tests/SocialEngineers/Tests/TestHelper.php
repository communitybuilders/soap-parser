<?php

namespace SocialEngineers\Tests;

use SocialEngineers\Tests\Exceptions\FileNotFoundException;

class TestHelper
{
    public static function getResourcePath($file_name = null)
    {
        $test_files_dir = __DIR__ . "/TestFiles";

        if( is_null($file_name) ) {
            return $test_files_dir;
        }

        $file_path = "{$test_files_dir}/{$file_name}";

        if( !file_exists($file_path) ) {
            throw new FileNotFoundException($file_path);
        }

        return $file_path;
    }
}
