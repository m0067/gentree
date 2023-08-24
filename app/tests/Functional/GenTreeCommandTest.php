<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Command\GenTreeCommand;
use PHPUnit\Framework\TestCase;

class GenTreeCommandTest extends TestCase
{
    /**
     * @covers GenTreeCommand
     */
    public function testExecute(): void
    {
        (new GenTreeCommand())->execute([$this->getInputFile(), $this->getOutputFile()]);
        $content = file_get_contents($this->getOutputFile());
        $originContent = file_get_contents($this->getOriginOutputFile());

        $this->assertEquals(
            json_decode($content, true),
            json_decode($originContent, true),
            "JSON files are not equal."
        );
    }

    protected function tearDown(): void
    {
        @\unlink($this->getOutputFile());
    }

    private function getInputFile(): string
    {
        return __DIR__ . '/../data/input.csv';
    }

    private function getOutputFile(): string
    {
        return __DIR__ . '/../__output/output.json';
    }

    private function getOriginOutputFile(): string
    {
        return __DIR__ . '/../data/output.json';
    }
}
