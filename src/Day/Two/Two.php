<?php

namespace App\Day\Two;

use App\Day\AbstractDay;

class Two extends AbstractDay
{
    public const DAY = 2;

    public function configure(): void
    {
        $handle = fopen(__DIR__ . '/data.txt', 'rb+');
        while ($line = fgets($handle)) {
            $this->inputData[] = trim($line);
        }
    }

    public function firstPuzzle()
    {
        $count = 0;
        foreach ($this->inputData as $line) {
            [$rule, $char, $string] = explode(' ', $line);

            $char = str_replace(':', '', $char);
            $string = str_split($string);

            $nbOccCharInStr = 0;
            foreach ($string as $strChar) {
                if ($strChar === $char) {
                    $nbOccCharInStr++;
                }
            }

            [$min, $max] = explode('-', $rule);
            $min = (int)$min;
            $max = (int)$max;

            if ($nbOccCharInStr >= $min && $nbOccCharInStr <= $max) {
                $count++;
            }
        }

        return $count;
    }

    public function secondPuzzle()
    {
        $count = 0;
        foreach ($this->inputData as $line) {
            [$rule, $char, $string] = explode(' ', $line);

            $char = str_replace(':', '', $char);
            $string = str_split($string);

            [$first, $last] = explode('-', $rule);
            $first = (int)$first - 1;
            $last = (int)$last - 1;

            if (($string[$first] === $char || $string[$last] === $char) && $string[$first] !== $string[$last]) {
                $count++;
            }
        }

        return $count;
    }
}