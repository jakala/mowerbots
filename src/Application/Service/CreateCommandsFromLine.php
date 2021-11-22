<?php

declare(strict_types=1);

namespace App\Application\Service;

final class CreateCommandsFromLine
{
    public function create(string $commandLine): string
    {
        list($commands) = sscanf($commandLine, '%s\n');

        return $commands;
    }
}
