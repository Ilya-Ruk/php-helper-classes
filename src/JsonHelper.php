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
            throw new RuntimeException('JSON encode error!', 0, $e);
        }
    }

    /**
     * @param string $data
     * @param bool $associative
     * @return mixed
     */
    public function decode(string $data, bool $associative = false): mixed
    {
        try {
            return @json_decode($data, $associative, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new RuntimeException('JSON decode error!', 0, $e);
        }
    }
}
