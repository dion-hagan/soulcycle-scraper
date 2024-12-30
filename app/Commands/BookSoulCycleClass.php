<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome\ChromeProcess;
use Laravel\Dusk\Chrome\SupportsChrome;

class BookSoulCycleClass extends Command
{
    use SupportsChrome;

    protected $signature = 'soulcycle:book';
    protected $description = 'Check and book available Soul Cycle classes';

    public function handle()
    {
        // Start Chrome process
        $process = (new ChromeProcess)->toProcess();
        $process->start();

        try {
            $browser = new Browser($this->createWebDriver());

            $browser->visit('https://www.soul-cycle.com/signin')
                    ->type('email', env('SOULCYCLE_EMAIL'))
                    ->type('password', env('SOULCYCLE_PASSWORD'))
                    ->press('Sign In')
                    ->waitFor('.dashboard');  // Adjust selector as needed

            // Add your class booking logic here
            // Example:
            // $browser->visit('desired-class-url')
            //         ->press('Book Class')

            $this->info('Successfully completed Soul Cycle booking check.');

        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
        } finally {
            $browser->quit();
            $process->stop();
        }
    }

    protected function createWebDriver()
    {
        return retry(5, function () {
            return $this->driver();
        }, 50);
    }
}
