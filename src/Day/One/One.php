<?php

namespace App\Day\One;

use App\Day\AbstractDay;

class One extends AbstractDay
{
    public function configure(): void
    {
        $handle = fopen(__DIR__ . '/data.txt', 'rb+');
        while ($line = fgets($handle)) {
            $this->dictionnary[] = $line;
        }
    }

    public function firstPuzzle()
    {
        foreach ($this->dictionnary as $i) {
            foreach ($this->dictionnary as $j) {
                if ((int)$i + (int)$j === 2020) {
                    return (int)$i * (int)$j;
                }
            }
        }

        return '';
    }

    public function secondPuzzle()
    {
        foreach ($this->dictionnary as $i) {
            foreach ($this->dictionnary as $j) {
                foreach ($this->dictionnary as $k) {
                    if ((int)$i + (int)$j + (int)$k === 2020) {
                        return (int)$i * (int)$j * (int)$k;
                    }
                }
            }
        }

        return '';
    }
}