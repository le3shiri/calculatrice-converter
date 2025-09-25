<?php

require __DIR__ . '/../vendor/autoload.php';

use App\NumberConverter;

try {
    if (count($argv) < 3) {
        throw new InvalidArgumentException("Usage: php bin/converter.php <A> <B> [--json]");
    }

    $a = $argv[1];
    $b = $argv[2];

    $jsonMode = isset($argv[3]) && $argv[3] === '--json';

    if (!ctype_digit($a) || !ctype_digit($b)) {
        throw new InvalidArgumentException("Both numbers must be positive integers.");
    }

    $a = (int) $a;
    $b = (int) $b;

    $convA = new NumberConverter($a);
    $convB = new NumberConverter($b);

    $lines = [];
    $lines[] = $convA->formatLine("Input A", $convA->toDecimal(), $convA->toBinary());
    $lines[] = $convB->formatLine("Input B", $convB->toDecimal(), $convB->toBinary());
    $lines[] = $convA->formatLine("A AND B", $convA->bitwiseAnd($b), decbin($convA->bitwiseAnd($b)));
    $lines[] = $convA->formatLine("A OR B", $convA->bitwiseOr($b), decbin($convA->bitwiseOr($b)));
    $lines[] = $convA->formatLine("A XOR B", $convA->bitwiseXor($b), decbin($convA->bitwiseXor($b)));
    $lines[] = $convA->formatLine("NOT A", $convA->bitwiseNot(), decbin($convA->bitwiseNot()));
    $lines[] = $convB->formatLine("NOT B", $convB->bitwiseNot(), decbin($convB->bitwiseNot()));


    if ($jsonMode) {
        $jsonLines = [];
        foreach ($lines as $line) {
            $jsonLines[] = str_replace(["\r","\n"], '', $line);
        }
        
        $jsonOutput = json_encode($jsonLines, JSON_PRETTY_PRINT);
        echo $jsonOutput;
        
    } else {
        
        foreach ($lines as $line) {
            echo $line;
        }
    }

} catch (Throwable $e) {
    fwrite(STDERR, "Error: " . $e->getMessage() . PHP_EOL);
    exit(1);
}