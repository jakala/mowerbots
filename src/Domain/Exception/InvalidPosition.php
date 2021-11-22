<?php

declare(strict_types=1);

namespace App\Domain\Exception;

final class InvalidPosition extends \DomainException
{
    public function __construct(int $value)
    {
        $message = sprintf(
            "Value <%d> for position is invalid. Only accept positive values",
            $value
        );

        parent::__construct($message);
    }
}
