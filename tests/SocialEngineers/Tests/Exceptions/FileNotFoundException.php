<?php

namespace SocialEngineers\Tests\Exceptions;

use Exception;

class FileNotFoundException extends \Exception
{
    public function __construct($file_path)
    {
        parent::__construct("File '{$file_path}' not found.");
    }
}
