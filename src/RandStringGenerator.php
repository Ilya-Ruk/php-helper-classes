<?php

declare(strict_types=1);

namespace Rukavishnikov\Php\Helper\Classes;

final class RandStringGenerator
{
    const DEFAULT_CHARACTERS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * @param string $characters
     */
    public function __construct(
        private string $characters = self::DEFAULT_CHARACTERS
    ) {
    }

    /**
     * @param int $length
     * @return string
     */
    public function generate(int $length = 10): string
    {
        $characters = $this->characters;
        $charactersLength = strlen($characters);

        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
