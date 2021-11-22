<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\ValueObject\Mower;
use App\Domain\ValueObject\Orientation;
use App\Domain\ValueObject\Position;

final class CreateMowerFromLine
{
    public function create(string $botLine): Mower
    {
        list($posX, $posY, $orientation) = sscanf($botLine, '%d %d %c\n');

        return new Mower(
            new Position($posX, $posY),
            new Orientation($orientation)
        );
    }
}
