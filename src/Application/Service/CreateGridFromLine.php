<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\ValueObject\Grid;
use App\Domain\ValueObject\Height;
use App\Domain\ValueObject\Width;

final class CreateGridFromLine
{
    public function create(string $line): Grid
    {
        list($width, $height) = sscanf($line, '%d %d\n');

        return new Grid(
            new Width($width),
            new Height($height)
        );
    }
}
