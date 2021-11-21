<?php
declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\Exception\GeneralException;

final class Mower implements \Stringable
{
    public function __construct(
        private Position $position,
        private Orientation $orientation
    ) {
    }

    public function position(): Position
    {
        return $this->position;
    }

    public function orientation(): Orientation
    {
        return $this->orientation;
    }

    public function move(): void
    {
        $actualX = $this->position->posX();
        $actualY = $this->position->posY();

        match($this->orientation->value()) {
            'N' => $actualY++,
            'S' => $actualY--,
            'E' => $actualX++,
            'W' => $actualX--,
        };

       $this->position = new Position($actualX, $actualY);
    }

    public function turnLeft(): void
    {
        $newOrientation  = match($this->orientation->value()) {
            'N' => 'W',
            'W' => 'S',
            'S' => 'E',
            'E' => 'N',
            default => throw new GeneralException("mower TurnLeft")
        };

        $this->orientation = new Orientation($newOrientation);
    }

    public function turnRight(): void
    {
        $newOrientation  = match($this->orientation->value()) {
            'N' => 'E',
            'E' => 'S',
            'S' => 'W',
            'W' => 'N',
            default => throw new GeneralException("mower TurnRight")
        };

        $this->orientation = new Orientation($newOrientation);
    }

    public function __toString(): string
    {
        return sprintf(
            '%d %d %s\n',
            $this->position->posX(),
            $this->position->posY(),
            $this->orientation->value()
        );
    }
}