<?php

namespace App\Day\Four;

use App\Day\AbstractDay;

class Four extends AbstractDay
{
    public const DAY = 4;

    public function configure(): void
    {
        $passportIndex = 0;
        $handle = fopen(__DIR__ . '/data.txt', 'rb+');
        while ($line = fgets($handle)) {
            $line = trim($line);
            if ("" === $line) {
                ++$passportIndex;

                continue;
            }

            if (!isset($this->inputData[$passportIndex])) {
                $this->inputData[$passportIndex] = $line;
                continue;
            }

            $this->inputData[$passportIndex] .= " {$line}";
        }

        foreach ($this->inputData as $passportKey => $passportValue) {
            $passportFields = [];
            foreach (explode(" ", $passportValue) as $field) {
                [$fieldKey, $fieldValue] = explode(':', $field);
                $passportFields[$fieldKey] = $fieldValue;
            }

            $this->inputData[$passportKey] = $passportFields;
        }
    }

    public function firstPuzzle()
    {
        $validPassports = 0;

        $requiredFields = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid'];
        foreach ($this->inputData as $passport) {
            $isValidPassport = true;
            foreach ($requiredFields as $requiredField) {
                if (!isset($passport[$requiredField])) {
                    $isValidPassport = false;
                    break;
                }
            }

            if ($isValidPassport) {
                ++$validPassports;
            }
        }
        return $validPassports;
    }

    public function secondPuzzle()
    {
        $validPassports = 0;

        $fieldsRules = [
            'byr' => [
                'rule' => static function ($value) {
                    return preg_match('/^\d{4}$/', $value) && $value >= 1920 && $value <= 2002;
                }
            ],
            'iyr' => [
                'rule' => static function ($value) {
                    return preg_match('/^\d{4}$/', $value) && $value >= 2010 && $value <= 2020;
                }
            ],
            'eyr' => [
                'rule' => static function ($value) {
                    return preg_match('/^\d{4}$/', $value) && $value >= 2020 && $value <= 2030;
                }
            ],
            'hgt' => [
                'rule' => static function ($value) {
                    if (preg_match('/(in)$/', $value)) {
                        return $value >= 59 && $value <= 76;
                    }

                    if (preg_match('/(cm)$/', $value)) {
                        return $value >= 150 && $value <= 193;
                    }

                    return false;
                }
            ],
            'hcl' => [
                'rule' => static function ($value) {
                    return (bool)preg_match('/^#([\d]|[a-f]){6}$/', $value);
                }
            ],
            'ecl' => [
                'rule' => static function ($value) {
                    return in_array($value, ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'], true);
                }
            ],
            'pid' => [
                'rule' => static function ($value) {
                    return (bool)preg_match('/^\d{9}$/', $value);
                }
            ],
        ];

        foreach ($this->inputData as $passport) {
            $isValidPassport = true;
            foreach ($fieldsRules as $ruleKey => $ruleValue) {
                if (!isset($passport[$ruleKey])) {
                    $isValidPassport = false;
                    break;
                }

                if (false === $ruleValue['rule']($passport[$ruleKey])) {
                    $isValidPassport = false;
                    break;
                }
            }

            if ($isValidPassport) {
                ++$validPassports;
            }
        }
        return $validPassports;
    }
}