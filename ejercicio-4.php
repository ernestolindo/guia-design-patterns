<?php

// Strategy interface
interface OutputStrategy
{
    public function execute(string $message): string;
}

// Concrete strategies

class ConsoleOutput implements OutputStrategy
{
    public function execute(string $message): string
    {
        return "Logging to console: " . $message . PHP_EOL;
    }
}

class JsonOutput implements OutputStrategy
{
    public function execute(string $message): string
    {
        return json_encode(["message" => $message]) . PHP_EOL;
    }
}

class TxtOutput implements OutputStrategy
{
    public function execute(string $message): string
    {
        return "Saving message to TXT: " . $message . PHP_EOL;
    }
}

// Context class

class OutputContext
{
    private OutputStrategy $outputStrategy;

    public function setOutputStrategy(OutputStrategy $outputStrategy): void
    {
        $this->outputStrategy = $outputStrategy;
    }

    public function executeMessage(string $message): string
    {
        return $this->outputStrategy->execute($message);
    }
}

// Client code

function showOutput(OutputContext $outputContext, string $message): void
{
    echo $outputContext->executeMessage($message);
}

// Examples usage

$message = "Hello world";
$outputContext = new OutputContext();

// Use console output
$consoleOutput = new ConsoleOutput();
$outputContext->setOutputStrategy($consoleOutput);
showOutput($outputContext, $message);

// Use JSON output
$jsonOutput = new JsonOutput();
$outputContext->setOutputStrategy($jsonOutput);
showOutput($outputContext, $message);

// Use TXT output
$txtOutput = new TxtOutput();
$outputContext->setOutputStrategy($txtOutput);
showOutput($outputContext, $message);
