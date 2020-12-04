<?php

namespace App\Day\Three;

use App\Day\AbstractDay;
use function count;

class Three extends AbstractDay
{
    public const DAY = 3;

    public function configure(): void
    {
        $handle = fopen(__DIR__ . '/data.txt', 'rb+');
        while ($line = fgets($handle)) {
            $this->inputData[] = trim($line);
        }
    }

    public function firstPuzzle()
    {
        return $this->countTrees(3, 1);
    }

    public function secondPuzzle()
    {
        return $this->countTrees(1, 1)
            * $this->countTrees(3, 1)
            * $this->countTrees(5, 1)
            * $this->countTrees(7, 1)
            * $this->countTrees(1, 2);
    }

    private function countTrees(int $stepX, int $stepY): int
    {
        $inputDataLength = count($this->inputData);

        $treesCounted = 0;

        $currentX = 0;
        $currentY = 0;

        foreach ($this->inputData as $line) {
            $lineChars = str_split($line);
            $rowLength = count($lineChars);

            $currentX += $stepX;
            $currentY += $stepY;

            if ($currentY >= $inputDataLength) {
                break;
            }

            $revisedX = $currentX % $rowLength;

            $charAtSpot = $this->inputData[$currentY][$revisedX];

            if ($charAtSpot === "#") {
                $treesCounted++;
            }
        }

        return $treesCounted;
    }
}