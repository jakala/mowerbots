<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\Exception\InvalidPosition;

final class Position
{
    private int $posX;
    private int $posY;
    public function __construct(int $x, int $y)
    {
        $this->validate($x);
        $this->validate($y);

        $this->posX = $x;
        $this->posY = $y;
    }

    private function validate(int $value): void
    {
        if ($value < 0) {
            throw new InvalidPosition($value);
        }
    }

    public function posX(): int
    {
        return $this->posX;
    }

    public function posY(): int
    {
        return $this->posY;
    }
}
