<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;
use Laravel\Dusk\Browser;
use App\Chrome\CustomChromeProcess;
use Laravel\Dusk\Chrome\SupportsChrome;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

class BookSoulCycleClass extends Command
{
    use SupportsChrome;

    protected $signature = 'soulcycle:book';
    protected $description = 'Check and book available Soul Cycle classes';

    public function handle()
    {
        $browser = null;

        // Start Chrome process
        $process = (new CustomChromeProcess)->toProcess();
        $process->start();

        // Wait for ChromeDriver to start
        sleep(2);

        try {
            $browser = new Browser($this->createWebDriver());

            $browser->visit('https://www.soul-cycle.com/signin')
                    ->waitFor('h1', 10) // Wait for "Log In" heading
                    ->waitUntilMissing('.loading', 10) // Wait for any loading indicators to disappear
                    ->type('#email-input', env('SOULCYCLE_EMAIL'))
                    ->type('#password-input', env('SOULCYCLE_PASSWORD'))
                    ->pause(1000) // Wait for input to register
                    ->click('#handle-login') // Click the Next button
                    ->waitFor('.dashboard', 30);

            // Add your class booking logic here
            // Example:
            // $browser->visit('desired-class-url')
            //         ->press('Book Class')

            $this->info('Successfully completed Soul Cycle booking check.');

        } catch (\Exception $e) {
            $this->info($e);
            $this->error('An error occurred: ' . $e->getMessage());
        } finally {
            if ($browser) {
                $browser->quit();
            }
            $process->stop();
        }
    }

    protected function driver()
    {
        $options = (new \Facebook\WebDriver\Chrome\ChromeOptions())->addArguments([
            // Remove --headless
            '--disable-gpu',
            '--no-sandbox',
            '--window-size=1920,1080'
        ]);

        return RemoteWebDriver::create(
            'http://localhost:9515',
            DesiredCapabilities::chrome()->setCapability(
                \Facebook\WebDriver\Chrome\ChromeOptions::CAPABILITY,
                $options
            )
        );
    }

    protected function createWebDriver()
    {
        return retry(5, function () {
            return $this->driver();
        }, 50);
    }
}
