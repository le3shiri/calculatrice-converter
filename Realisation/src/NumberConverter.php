<?php

namespace App;

class NumberConverter implements ConverterInterface
{
    use FormatterTrait;

    private int $number;

    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public function toDecimal(): int
    {
        return $this->number;
    }

    public function toBinary(): string
    {
        return decbin($this->number);
    }

    public function toHexa(): string
    {
        return strtoupper(dechex($this->number));
    }

    public function bitwiseAnd(int $other): int
    {
        return $this->number & $other;
    }

    public function bitwiseOr(int $other): int
    {
        return $this->number | $other;
    }

    public function bitwiseXor(int $other): int
    {
        return $this->number ^ $other;
    }

    public function bitwiseNot(): int
    {
        return ~$this->number;
    }
}
