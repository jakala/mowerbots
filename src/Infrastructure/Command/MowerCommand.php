<?php

declare(strict_types=1);

namespace App\Infrastructure\Command;

use App\Application\Service\CreateCommandsFromLine;
use App\Application\Service\CreateGridFromLine;
use App\Application\Service\CreateMowerFromLine;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class MowerCommand extends Command
{
    protected static $defaultName = 'mower:process-file';

    public function __construct(
        string $name = null,
        private CreateGridFromLine $gridCreator,
        private CreateMowerFromLine $mowerCreator,
        private CreateCommandsFromLine $commandsCreator
    ) {
        parent::__construct($name);
    }


    protected function configure()
    {
        $this->setDescription('Proceso de lectura de archivo de ordenes de movimientos en un grid para varios mowers');
        $this->setHelp('Este comando ejecuta una serie de instrucciones de movimientos de mowers en una grilla de cesped, en la que
        el robot correspondiente se mueve segun la orientacion de las instrucciones. Cada vez que se finalizan los movimientos el mower
        indica su posicion final.');

        $this->addArgument('file', InputArgument::REQUIRED, 'archivo a procesar');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeLn([
            'Procesando archivo ' . $input->getArgument('file'),
            '------------------'
        ]);

        $file = new \SplFileObject($input->getArgument('file'));

        // primera linea es el tamaño de la malla de cesped.
        $firstLine = $file->fgets();
        $grid = $this->gridCreator->create($firstLine);

        // a partir de aqui leemos el archivo linea a linea y vamos procesando
        while (!$file->eof()) {
            try {
                $botLine = $file->fgets();    // linea de inicio de mower
                $commandLine = $file->fgets();// linea de comandos para el mower

                $mower = $this->mowerCreator->create($botLine);
                $commands = $this->commandsCreator->create($commandLine);

                $grid->setMower($mower);
                $lastPos = $grid->process($commands);

                $output->writeln($lastPos);
            } catch (\Exception $e) {
                $output->writeln([$e->getMessage()]);
            }
        }

        return Command::SUCCESS;
    }
}
