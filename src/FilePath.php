<?php

declare(strict_types=1);

namespace Rukavishnikov\Php\Helper\Classes;

use InvalidArgumentException;
use RuntimeException;

final class FilePath
{
    /**
     * @var string
     */
    private string $filePath;

    /**
     * @param string $filePath
     * @param bool $createIfNotExists
     */
    public function __construct(string $filePath, bool $createIfNotExists = false)
    {
        $this->validateOrCreateFile($filePath, $createIfNotExists);

        $this->filePath = $filePath;
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * @return string
     */
    public function getFileDirPath(): string
    {
        return dirname($this->filePath);
    }

    /**
     * @param string $filePath
     * @param bool $createIfNotExists
     * @return void
     */
    private function validateOrCreateFile(string $filePath, bool $createIfNotExists): void
    {
        if (is_file($filePath)) {
            return;
        }

        if ($createIfNotExists) {
            $dirPath = dirname($filePath);

            if (!is_dir($dirPath)) {
                if (@mkdir($dirPath, 0777, true) === false) {
                    throw new RuntimeException(sprintf("Create directory '%s' error!", $dirPath));
                }
            }

            if (@touch($filePath) === false) {
                throw new RuntimeException(sprintf("Create file '%s' error!", $filePath));
            }
        } else {
            throw new InvalidArgumentException(sprintf("File '%s' not exists!", $filePath));
        }
    }
}
