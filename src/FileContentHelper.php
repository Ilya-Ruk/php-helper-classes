<?php

declare(strict_types=1);

namespace Rukavishnikov\Php\Helper\Classes;

use RuntimeException;

final class FileContentHelper
{
    /**
     * @param string $fileFullName
     * @param string $content
     * @return void
     */
    public function saveContent(string $fileFullName, string $content): void
    {
        if (@file_put_contents($fileFullName, $content, LOCK_EX) === false) {
            throw new RuntimeException(sprintf("Save content to file '%s' error!", $fileFullName));
        }
    }

    /**
     * @param string $fileFullName
     * @return string
     */
    public function loadContent(string $fileFullName): string
    {
        $content = @file_get_contents($fileFullName);

        if ($content === false) {
            throw new RuntimeException(sprintf("Load content from file '%s' error!", $fileFullName));
        }

        return $content;
    }
}
