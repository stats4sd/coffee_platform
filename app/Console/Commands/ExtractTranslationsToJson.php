<?php

namespace App\Console\Commands;

use Gettext\Translations;
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
     * @throws \JsonException
     */
    public function handle()
        {

        // ************* Convert Po file to json for reading by Vue app:
        $translations = Translations::fromPoFile(resource_path('lang/gettext/es/app.po'));

        $outputArray = [];

        foreach($translations as $translation) {
            if($translation->getTranslation() && $translation->getTranslation() !== ""){
                $outputArray[$translation->getOriginal()] = $translation->getTranslation();
            }
        }

        $output = ['es' => $outputArray];
         file_put_contents(
            resource_path('js/translations.json'),
             json_encode($output, JSON_THROW_ON_ERROR)
        );


        $this->call('cache:clear');
        $this->info('translations.json updated from es/app.po file, and the cache has been cleared!');
    }
}
