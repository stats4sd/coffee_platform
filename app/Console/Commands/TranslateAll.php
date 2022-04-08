<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TranslateAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translation:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs all needed commands to fully sync translation.io translations with the platform (back-end, front-end and DB)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('translation:db');
        $this->call('translation:vue');
        $this->call('translation:sync');
        $this->call('translation:extract-json');
    }
}
