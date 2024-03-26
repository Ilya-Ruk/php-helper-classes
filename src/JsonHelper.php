<?php

declare(strict_types=1);

namespace Rukavishnikov\Php\Helper\Classes;

use JsonException;
use RuntimeException;

final class JsonHelper
{
    /**
     * @param mixed $data
     * @return string
     */
    public function encode(mixed $data): string
    {
        try {
            return @json_encode($data, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new RuntimeException(sprintf("JSON encode error!\r\n\r\n%s", var_export($data, true)), 500, $e);
        }
    }

    /**
     * @param string $data
     * @return mixed
     */
    public function decode(string $data): mixed
    {
        try {
            return @json_decode($data, false, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new RuntimeException(sprintf("JSON decode error!\r\n\r\n%s", var_export($data, true)), 500, $e);
        }
    }
}
