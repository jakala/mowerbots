<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\Exception\InvalidGridWidth;

final class Width
{
    private int $width;

    public function __construct(int $value)
    {
        $this->validate($value);
        $this->width = $value;
    }

    private function validate(int $value): void
    {
        $this->validatePositiveWidth($value);
    }

    private function validatePositiveWidth(int $value): void
    {
        if ($value < 0) {
            throw new InvalidGridWidth($value);
        }
    }

    public function value(): int
    {
        return $this->width;
    }
}
