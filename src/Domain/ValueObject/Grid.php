<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\Exception\InvalidCommand;
use App\Domain\Exception\InvalidMove;
use App\Domain\Exception\InvalidPositionInGrid;

final class Grid
{
    private ?Mower $mower;

    public function __construct(
        private Width $width,
        private Height $height,
    ) {
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

    public function setMower(Mower $mower): void
    {
        $this->validate($mower->position());
        $this->mower = $mower;
    }

    public function process(string $commands): string
    {
        try {
            $letters = str_split($commands);
            foreach ($letters as $letter) {
                $this->execute($letter);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return (string)$this->mower;
    }

    private function validate(Position $position): void
    {
        if (
            $position->posX() > $this->width->value()
            || $position->posY() > $this->height->value()
        ) {
            throw new InvalidPositionInGrid($position, $this->width, $this->height);
        }
    }

    private function execute(string $letter): void
    {
        try {
            match ($letter) {
                'L' => $this->mower->turnLeft(),
                'R' => $this->mower->turnRight(),
                'M' => $this->mower->move(),
            };
        } catch (\Exception) {
            throw new InvalidMove($letter, $this->mower->position(), $this->mower->orientation());
        }
    }
}
