<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use App\Domain\ValueObject\Orientation;
use App\Domain\ValueObject\Position;

final class InvalidMove extends \DomainException
{
    public function __construct(string $value, Position $position, Orientation $orientation)
    {
        $message = sprintf(
            "Value <%s> for command is invalid in position/orientation <%d, %d, %s>",
            $value,
            $position->posX(),
            $position->posY(),
            $orientation->value()
        );

        parent::__construct($message);
    }
}
