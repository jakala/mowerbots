<?php

declare(strict_types=1);

namespace App\Domain\Exception;

final class InvalidCommand extends \DomainException
{
    public function __construct(string $value)
    {
        $message = sprintf(
            "Value <%s> command line is invalid. Only accepts (M)ove, (L)eft, (R)ight",
            $value
        );

        parent::__construct($message);
    }
}
