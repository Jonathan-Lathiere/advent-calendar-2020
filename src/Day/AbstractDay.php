<?php

namespace App\Day;

abstract class AbstractDay {
    protected array $dictionnary = [];

    abstract public function configure(): void;
    abstract public function firstPuzzle();
    abstract public function secondPuzzle();
}