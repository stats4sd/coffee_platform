<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class ExtractTranslationsToJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translation:extract-json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Extracts the translation strings from the .po file that gettext() + translation.io syncs to a JSON file, so the Vue front-end can read them.';

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
                // ************* 3. Convert Po file to json for reading by Vue app:
        $compileProcess = new Process(["node_modules/.bin/gettext-compile", "--output", "resources/js/translations.json", "resources/lang/gettext/es/app.po"]);

        $compileProcess->mustRun();

        if($compileProcess->isSuccessful()) {
            $this->info('gettext-compile succeeded!');
        }
        else {
            $this->info('gettext-compile failed with output' . $compileProcess->getErrorOutput());
        }
    }
}
