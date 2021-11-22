<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\Exception\InvalidOrientationLength;
use App\Domain\Exception\InvalidOrientationLetter;

final class Orientation
{
    private string $value;
    public function __construct(string $orientation)
    {
        $this->validate($orientation);
        $this->value = $orientation;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private function validate(string $value): void
    {
        $this->validateOneLetter($value);
        $this->validateValidOrientation($value);
    }

    private function validateOneLetter(string $value): void
    {
        if (strlen($value) !== 1) {
            throw new InvalidOrientationLength($value);
        }
    }

    private function validateValidOrientation(string $value): void
    {
        if (!in_array($value, ['N', 'S', 'E', 'W'])) {
            throw new InvalidOrientationLetter($value);
        }
    }
}
