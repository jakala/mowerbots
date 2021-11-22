<?php

declare(strict_types=1);

namespace App\Domain\Exception;

final class GeneralException extends \DomainException
{
    public function __construct(string $value)
    {
        $message = sprintf(
            "In <%s>: Undefined Error.",
            $value
        );

        parent::__construct($message);
    }
}
