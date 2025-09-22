<?php
// trait
namespace App;

trait FormatterTrait {
    public function format(string $label, string|int $value): string {
        return str_pad($label, 8, " ", STR_PAD_RIGHT) . ": " . $value . PHP_EOL;
    }
}
