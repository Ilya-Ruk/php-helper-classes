<?php

declare(strict_types=1);

namespace Rukavishnikov\Php\Helper\Classes;

use RuntimeException;

final class DirPath
{
    /**
     * @var string
     */
    private string $dirPath;

    /**
     * @param string $dirPath
     * @param bool $createIfNotExists
     */
    public function __construct(string $dirPath, bool $createIfNotExists = false)
    {
        $this->validateOrCreateDir($dirPath, $createIfNotExists);

        $this->dirPath = $dirPath;
    }

    /**
     * @return string
     */
    public function getDirPath(): string
    {
        return $this->dirPath;
    }

    /**
     * @param string $dirPath
     * @param bool $createIfNotExists
     * @return void
     */
    private function validateOrCreateDir(string $dirPath, bool $createIfNotExists): void
    {
        if (is_dir($dirPath)) {
            return;
        }

        if ($createIfNotExists) {
            if (@mkdir($dirPath, 0777, true) === false) {
                throw new RuntimeException(sprintf("Create directory '%s' error!", $dirPath), 500);
            }
        } else {
            throw new RuntimeException(sprintf("Directory '%s' not exists!", $dirPath), 500);
        }
    }
}
