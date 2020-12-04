<?php

namespace App\Day;

abstract class AbstractDay {
    protected array $inputData = [];

    abstract public function configure(): void;
    abstract public function firstPuzzle();
    abstract public function secondPuzzle();
}