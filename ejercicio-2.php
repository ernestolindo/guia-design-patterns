<?php

// Adaptee: Windows7File
class Win7File
{
    private $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function openFileOnWin7(): void
    {
        echo "Opening file \"" . $this->fileName . "\" on Windows 7" . PHP_EOL;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }
}

// Target Interface: The client expects Win 10 compatibility
interface Win10Compatibility
{
    public function openFile(): string;
}

// Adapter: Read Win7 files on Win10
class Win7FileAdapter implements Win10Compatibility
{
    private Win7File $win7File;

    public function __construct(Win7File $win7File)
    {
        $this->win7File = $win7File;
    }

    public function openFile(): string
    {
        return "Opening file \"" . $this->win7File->getFileName() . "\" on Windows 10";
    }
}

// Client: Opens a Win7File on Win10
function openFileOnWin10(Win10Compatibility $fileAdapter): void
{
    echo $fileAdapter->openFile() . PHP_EOL;
}

// Usage example
$win7file = new Win7File("New document 1");
$win7file->openFileOnWin7();

$adapter = new Win7FileAdapter($win7file);
openFileOnWin10($adapter);

// Additional example with multiple files
$win7Files = [
    new Win7File("Document 1"),
    new Win7File("Document 2"),
    new Win7File("Presentation")
];

foreach ($win7Files as $file) {
    $adapter = new Win7FileAdapter($file);
    openFileOnWin10($adapter);
}
