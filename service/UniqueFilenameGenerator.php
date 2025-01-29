<?php

namespace App\Service;

class UniqueFilenameGenerator
{
    public function generate(string $extension): string
    {
        return uniqid() . '.' . $extension;
    }
}
