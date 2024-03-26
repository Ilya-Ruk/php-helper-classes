<?php

declare(strict_types=1);

namespace Rukavishnikov\Php\Helper\Classes;

final class ArrayToString
{
    const LEFT_INDENT = '  '; // Two spaces

    const OPEN_TAG = '[' . "\r\n";
    const CLOSE_TAG = ']' . "\r\n";

    const NAME_VALUE_DELIMITER = ': ';

    const PARAM_DELIMITER = "\r\n";
    const LAST_PARAM_DELIMITER = "\r\n";

    /**
     * @param string $leftIndent
     * @param string $openTag
     * @param string $closeTag
     * @param string $nameValueDelimiter
     * @param string $paramDelimiter
     * @param string $lastParamDelimiter
     */
    public function __construct(
        private string $leftIndent = self::LEFT_INDENT,
        private string $openTag = self::OPEN_TAG,
        private string $closeTag = self::CLOSE_TAG,
        private string $nameValueDelimiter = self::NAME_VALUE_DELIMITER,
        private string $paramDelimiter = self::PARAM_DELIMITER,
        private string $lastParamDelimiter = self::LAST_PARAM_DELIMITER
    ) {
    }

    /**
     * @param array $arr
     * @return string
     */
    public function convert(array $arr): string
    {
        return $this->convertInternal($arr);
    }

    /**
     * @param array $arr
     * @param int $level
     * @return string
     */
    private function convertInternal(array $arr, int $level = 0): string
    {
        $result = $this->openTag;

        $index = 0;
        $lastIndex = count($arr) - 1;

        foreach ($arr as $name => $value) {
            $result .= str_repeat($this->leftIndent, $level + 1);
            $result .= $name;
            $result .= $this->nameValueDelimiter;

            if (is_array($value)) {
                $result .= $this->convertInternal($value, $level + 1);
            } else {
                $result .= $value;

                if ($index === $lastIndex) {
                    $result .= $this->lastParamDelimiter;
                } else {
                    $result .= $this->paramDelimiter;
                }
            }

            $index++;
        }

        $result .= str_repeat($this->leftIndent, $level);
        $result .= $this->closeTag;

        return $result;
    }
}
