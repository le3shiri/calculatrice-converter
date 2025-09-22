<?php
// convert.php
require __DIR__ . '/../vendor/autoload.php';

use App\NumberConverter;

if ($argc < 2) {
    echo "Usage: php bin/convert.php <number> [options]\n";
    echo "Options:\n";
    echo "  --jsonin            Read input from input.json\n";
    echo "  --jsonout           Output to output.json\n";
    echo "  --and <n>           Bitwise AND with n\n";
    echo "  --or <n>            Bitwise OR with n\n";
    echo "  --xor <n>           Bitwise XOR with n\n";
    echo "  --not               Bitwise NOT\n";
    echo "  --shl <n>           Shift left by n bits\n";
    echo "  --shr <n>           Shift right by n bits\n";
    exit(1);
}

try {
    $isJsonIn = in_array("--jsonin", $argv, true);
    $isJsonOut = in_array("--jsonout", $argv, true);

    if ($isJsonIn) {
        $inputFile = 'input.json';
        if (!file_exists($inputFile)) {
            throw new Exception("Input file input.json not found");
        }
        $jsonInput = file_get_contents($inputFile);
        $inputData = json_decode($jsonInput, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Invalid JSON in input.json");
        }
        if (!isset($inputData['number']) || !is_int($inputData['number'])) {
            throw new Exception("Input JSON must contain a valid 'number' integer");
        }
        $number = $inputData['number'];
    } else {
        $number = (int) $argv[1];
    }

    $converter = new NumberConverter($number);

    $results = [
        "decimal" => $converter->toDecimal(),
        "binary"  => $converter->toBinary(),
        "hexa"    => $converter->toHexa(),
    ];

    foreach ($argv as $i => $arg) {
        switch ($arg) {
            case "--and":
                $results["and"] = $converter->andOp((int) $argv[$i+1]);
                break;
            case "--or":
                $results["or"] = $converter->orOp((int) $argv[$i+1]);
                break;
            case "--xor":
                $results["xor"] = $converter->xorOp((int) $argv[$i+1]);
                break;
            case "--not":
                $results["not"] = $converter->notOp();
                break;
            case "--shl":
                $results["shift_left"] = $converter->shiftLeft((int) $argv[$i+1]);
                break;
            case "--shr":
                $results["shift_right"] = $converter->shiftRight((int) $argv[$i+1]);
                break;
        }
    }

    if ($isJsonOut) {
        $outputFile = 'output.json';
        $jsonOutput = json_encode($results, JSON_PRETTY_PRINT);
        if (file_put_contents($outputFile, $jsonOutput) === false) {
            throw new Exception("Failed to write to output.json");
        }
    } else {
        foreach ($results as $label => $value) {
            echo $converter->format(ucfirst(str_replace("_", " ", $label)), (string)$value);
        }
    }
    
} catch (Throwable $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
    exit(1);
}
?>