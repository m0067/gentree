<?php

declare(strict_types=1);

namespace App\Helper;

class BasicHelper
{
    public static function jsonEncode(mixed $value): false|string
    {
        return json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public static function printMemoryUsage(string $message = ''): void
    {
        $mem = memory_get_usage(true);

        if ($message !== '') {
            $message = ", $message, ";
        }

        echo date('g:i:s') . "$message mem $mem bytes\n";
    }
}
