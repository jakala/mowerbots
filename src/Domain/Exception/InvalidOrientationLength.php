<?php

declare(strict_types=1);

namespace App\Domain\Exception;

final class InvalidOrientationLength extends \DomainException
{
    public function __construct(string $value)
    {
        $message = sprintf(
            "Value <%s> for orientation is invalid. Only accept one letter",
            $value
        );

        parent::__construct($message);
    }
}
