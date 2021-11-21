<?php
declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\Exception\InvalidCommand;
use App\Domain\Exception\InvalidPositionInGrid;

final class Grid
{
    private ?Mower $mower;

    public function __construct(
        private Width $width,
        private Height $height,
    ){
        $this->mower = null;
    }

    public function width(): Width
    {
        return $this->width;
    }

    public function height(): Height
    {
        return $this->height;
    }

    public function setMower(Position $position, Orientation $orientation): void
    {
        $this->validate($position);
        $this->mower = new Mower($position, $orientation);
    }

    public function process(string $commands): void
    {
        $letters = str_split($commands);
        foreach($letters as $letter) {
            $this->execute($letter);
        }
        printf((string)$this->mower);
    }

    private function validate(Position $position): void
    {
        if(
            $position->posX() > $this->width->value()
            || $position->posY() > $this->height->value()
        ) {
            throw new InvalidPositionInGrid($position, $this->width, $this->height);
        }
    }

    private function execute(string $letter): void
    {
        match($letter) {
            'L' => $this->mower->turnLeft(),
            'R' => $this->mower->turnRight(),
            'M' => $this->mower->move(),
            default => throw new InvalidCommand($letter)
        };
    }

}