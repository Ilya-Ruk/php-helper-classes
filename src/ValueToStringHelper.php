<?php

declare(strict_types=1);

namespace Rukavishnikov\Php\Helper\Classes;

use Stringable;

final class ValueToStringHelper
{
    /**
     * @param string $leftIndent
     * @param string $openTag
     * @param string $closeTag
     * @param string $nameValueDelimiter
     * @param string $paramDelimiter
     * @param string $lastParamDelimiter
     */
    public function __construct(
        private string $leftIndent = "",
        private string $openTag = "[",
        private string $closeTag = "]",
        private string $nameValueDelimiter = ": ",
        private string $paramDelimiter = ", ",
        private string $lastParamDelimiter = "",
    ) {
    }

    /**
     * @param mixed $value
     * @return string
     */
    public function valueToString(mixed $value): string
    {
        return $this->valueToStringInternal($value);
    }

    /**
     * @param mixed $value
     * @param int $level
     * @return string
     */
    private function valueToStringInternal(mixed $value, int $level = 0): string
    {
        if (is_null($value)) {
            return 'null';
        }

        if (is_bool($value)) {
            return ($value) ? 'true' : 'false';
        }

        if (is_int($value) || is_float($value) || is_string($value) || ($value instanceof Stringable)) {
            return (string)$value;
        }

        if (is_array($value)) {
            return $this->arrayToStringInternal($value, $level);
        }

        if (is_object($value)) {
            return '[object]';
        }

        if (is_resource($value)) {
            return '[resource]';
        }

        return '[unknown type]';
    }

    /**
     * @param array $arr
     * @param int $level
     * @return string
     */
    private function arrayToStringInternal(array $arr, int $level = 0): string
    {
        $result = $this->openTag;

        $index = 0;
        $lastIndex = count($arr) - 1;

        foreach ($arr as $name => $value) {
            $result .= str_repeat($this->leftIndent, $level + 1);

            $result .= $name;
            $result .= $this->nameValueDelimiter;
            $result .= $this->valueToStringInternal($value, $level + 1);

            if ($index === $lastIndex) {
                $result .= $this->lastParamDelimiter;
            } else {
                $result .= $this->paramDelimiter;
            }

            $index++;
        }

        $result .= str_repeat($this->leftIndent, $level);
        $result .= $this->closeTag;

        return $result;
    }
}
