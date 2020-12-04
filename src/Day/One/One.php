<?php

namespace App\Day\One;

use App\Day\AbstractDay;

class One extends AbstractDay
{
    public const DAY = 1;
    public function configure(): void
    {
        $handle = fopen(__DIR__ . '/data.txt', 'rb+');
        while ($line = fgets($handle)) {
            $this->inputData[] = $line;
        }
    }

    public function firstPuzzle()
    {
        foreach ($this->inputData as $i) {
            foreach ($this->inputData as $j) {
                if ((int)$i + (int)$j === 2020) {
                    return (int)$i * (int)$j;
                }
            }
        }

        return '';
    }

    public function secondPuzzle()
    {
        foreach ($this->inputData as $i) {
            foreach ($this->inputData as $j) {
                foreach ($this->inputData as $k) {
                    if ((int)$i + (int)$j + (int)$k === 2020) {
                        return (int)$i * (int)$j * (int)$k;
                    }
                }
            }
        }

        return '';
    }
}