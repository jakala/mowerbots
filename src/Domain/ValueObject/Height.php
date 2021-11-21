<?php
declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\Exception\InvalidGridHeight;

final class Height
{
    private int $height;

    public function __construct(int $value)
    {
        $this->validate($value);
        $this->height = $value;
    }

    private function validate(int $value): void
    {
        $this->validatePositiveHeight($value);
    }

    private function validatePositiveHeight(int $value): void
    {
        if($value < 0) {
            throw new InvalidGridHeight($value);
        }
    }

    public function value(): int
    {
        return $this->height;
    }

}