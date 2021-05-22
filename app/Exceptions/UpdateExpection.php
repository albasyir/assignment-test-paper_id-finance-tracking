<?php

namespace App\Exceptions;

use Exception;

class UpdateExpection extends Exception
{
    public function render(string $msg, int $code)
    {
        return response($this->getMessage(), $this->getCode());
    }
}
