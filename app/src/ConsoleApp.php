<?php

declare(strict_types=1);

namespace App;

use App\Command\CommandInterface;

class ConsoleApp
{
    public function run(): void
    {
        foreach (\glob($this->getProjectDir() . '/src/Command/*Command.php') as $fileName) {
            $className = pathinfo($fileName)['filename'];
            $commandName = '\\App\\Command\\' . $className;
            $command = new $commandName;

            if ($command instanceof CommandInterface && $command::getName() === $this->getCommandName()) {
                $command->execute($this->getParams());
            }
        }
    }

    public function getProjectDir(): string
    {
        return \dirname(__DIR__);
    }

    private function getCommandName(): string
    {
        $arg = $_SERVER['argv'][1] ?? '';

        return (string)$arg;
    }

    private function getParams(): array
    {
        return array_slice($_SERVER['argv'], 2);
    }
}
