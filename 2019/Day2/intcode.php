#!/usr/bin/env php
<?php
declare(strict_types=1);

$input = array_map('intval', explode(',',$argv[1]));

$target = 19690720;

foreach(range(0,99) as $noun) {
    foreach(range(0,99) as $verb) {
        $output = execute($noun, $verb, ...$input);
        if ($output[0] === $target) {
            echo "Noun $noun, Verb $verb" . PHP_EOL;
        }
    }
}

function execute(int $noun, int $verb, int... $input)
{
    $input[1] = $noun;
    $input[2] = $verb;

    $currentPosition = 0;
    while (true) {
        switch ($input[$currentPosition])
        {
            case 1: // Add
                $val1 = $input[$input[$currentPosition + 1]];
                $val2 = $input[$input[$currentPosition + 2]];
                $target = $input[$currentPosition + 3];
                $input[$target] = $val1 + $val2;
                $currentPosition += 4;
                break;
            case 2: // Multiply
                $val1 = $input[$input[$currentPosition + 1]];
                $val2 = $input[$input[$currentPosition + 2]];
                $target = $input[$currentPosition + 3];
                $input[$target] = $val1 * $val2;
                $currentPosition += 4;
                break;
            case 99: // Terminate
                return $input;
                break;
            default:
                throw new RuntimeException('Invalid Operation');
        }

    }
}

