<?php

class Logger
{
    private string $logs_directory;
    private ?string $current_file_path;

    public function __construct(string $logs_directory)
    {
        $this->logs_directory = $logs_directory.'/';
        $this->current_file_path = null;
        if (!file_exists($this->logs_directory)) {
            mkdir($this->logs_directory);
        }
        $files = scandir($this->logs_directory);
        print_r($files);
        if (count($files) > 2) {
            $this->current_file_path = $this->logs_directory.$files[count($files) - 1];
        }
        if ($this->current_file_path == null || count(file($this->current_file_path)) >= 10) {
            $this->current_file_path = $this->new_log_file_path();
        }
    }

    public function log(string $message): void {

        $file = fopen($this->current_file_path, "a") or die("Unable to open file!");
        fwrite($file, $message.PHP_EOL);
        fclose($file);

        print_r(file($this->current_file_path));
        if (count(file($this->current_file_path)) >= 10) {
            $this->current_file_path = $this->new_log_file_path();
            echo $this->current_file_path;
        }
    }

    function new_log_file_path(): string
    {
        $number = $this->current_file_path ? (int)substr(basename($this->current_file_path), 4) : 0;
        return $this->logs_directory.'log_'.$number+1 . '.txt';
    }
}