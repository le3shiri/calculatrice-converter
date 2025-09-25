<?php

namespace App;

trait FormatterTrait{
    public function formatLine(string $label, int $decimal ,string $binary): string{
        return str_pad($label, 8, " ", STR_PAD_RIGHT) . ": {$decimal} ({$binary})" . PHP_EOL;
    }
}