<?php
declare(strict_types=1);

namespace App\Domain\Exception;

final class InvalidGridHeight extends \DomainException
{
    public function __construct(int $value)
    {
        $message = sprintf(
            "Value <%d> for grid height is invalid. Only accept positive value",
            $value
        );

        parent::__construct($message);
    }

}