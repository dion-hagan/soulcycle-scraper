<?php

namespace App\Chrome;

use Laravel\Dusk\Chrome\ChromeProcess as BaseProcess;
use Symfony\Component\Process\Process;

class CustomChromeProcess extends BaseProcess
{
    /**
     * The Chromedriver port.
     *
     * @var int
     */
    protected $port = 9515;

    /**
     * The environment variables for the Chromedriver process.
     *
     * @var array|null
     */
    protected $environmentVariables = null;

    /**
     * Get the path to the ChromeDriver binary.
     *
     * @return string
     */
    public function driver()
    {
        return '/opt/homebrew/bin/chromedriver';
    }

    /**
     * Create a new ChromeProcess instance.
     *
     * @return \Symfony\Component\Process\Process
     */
    public function toProcess(array $arguments = [])
    {
        $driver = $this->driver();

        if (!file_exists($driver)) {
            throw new \RuntimeException("ChromeDriver not found at path: {$driver}");
        }

        return new Process(
            array_merge([$driver, '--port=' . $this->port], $arguments),
            null,
            $this->chromeEnvironment()
        );
    }

    /**
     * Get the Chrome environment variables.
     *
     * @return array
     */
    protected function chromeEnvironment()
    {
        if ($this->environmentVariables) {
            return $this->environmentVariables;
        }

        return ['DISPLAY' => $_ENV['DISPLAY'] ?? null];
    }
}
