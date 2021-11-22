<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use App\Domain\ValueObject\Height;
use App\Domain\ValueObject\Position;
use App\Domain\ValueObject\Width;

final class InvalidPositionInGrid extends \DomainException
{
    public function __construct(Position $position, Width $width, Height $height)
    {
        $message = sprintf(
            "Position <%d, %d> for grid size <%d, %d> is invalid.",
            $position->posX(),
            $position->posY(),
            $width->value(),
            $height->value()
        );

        parent::__construct($message);
    }
}
