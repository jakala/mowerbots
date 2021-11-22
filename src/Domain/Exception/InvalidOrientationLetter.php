<?php

declare(strict_types=1);

namespace App\Domain\Exception;

final class InvalidOrientationLetter extends \DomainException
{
    public function __construct(string $value)
    {
        $message = sprintf(
            "Value <%s> for orientation is invalid. Only accept: (N)orth, (S)outh, (E)ast, (W)est",
            $value
        );

        parent::__construct($message);
    }
}
