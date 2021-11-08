<?php

namespace App\Console\Commands;

use Gettext\Translations;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class UpdateDbTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translation:db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syncs Model translatable fields from the database to a placeholder PHP class so they can be identified by the translation.io system and translated through the same interface as the main platform strings';

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
//        if(! $this->confirm('This may overwrite translated strings stored in the database with translations pulled from Translation.io. Any translated strings in the db that are *not* translated in translation.io will be synced back to translation.io and tagged with 'translated-on-platform')) {
//            $this->info("terminating");
//            return 'terminated';
//        }


        // list translatable models;
        // for package - should maybe move this to a config that can be set by the developer
        $models = $this->getTranslatableModels();
        $finishedTranslations = Translations::fromPoFile(resource_path('lang/gettext/es/app.po'));
        // reset placeholder PHP file
        file_put_contents(resource_path('lang/DbTranslationPlaceholder.php'), "<?php \n");
        $this->addToPlaceholder("class DbTranslationPlaceholder
        {
            public function getTranslations(): array
            {
                return [\n"
        );

        foreach ($models as $model) {
            $model = Str::of($model)->replace('.php', '');

            $model = 'App\\Models\\' . $model;

            $translatable = (new $model)->getTranslatableAttributes();
            $this->comment('###################### lets gooooo...' . $model);

            $models = $model::all();

            foreach ($models as $entry) {
                //extract exportable entries into PHP placeholder class
                $values = $entry->getTranslations();
                $this->comment(json_encode($values));

                // for each entry, add a line to the translation placeholder:
                foreach ($values as $field => $value) {

                    // ************** 1. Extract variables from the database + store in placeholder;
                    $entryId = $entry->id;
                    $value = $value['en'] ?? null;

                    // if the en value is not set, skip value;
                    if (!$value) {
                        continue;
                    }


                    $this->addToPlaceholder("
                [
                    'model' => '${model}',
                    'id' => '${entryId}',
                    'field' => '${field}',
                    'value' => t('${value}'),
                ],
                    ");

                    // ******* 2. Check if this value is translated and restore to db:
                    $finishedTranslation = $finishedTranslations->find(null, $value);

                    if ($finishedTranslation
                        && $finishedTranslation->getTranslation()
                        && $finishedTranslation->getTranslation() !== "") {
                        // update translation in database:
                        $dbEntry = $model::find($entryId);
                        $dbEntry->setTranslation($field, 'es', $finishedTranslation->getTranslation());
                        $dbEntry->save();
                    }
                }
            }
        }

        $this->addToPlaceholder("];
            }
        }
        ");


        return true;
    }

    /**
     * Gets array of models with translatable fields;
     * @return string[]
     */
    public function getTranslatableModels()
    {
        return [
            'ApproachCollection',
            'Characteristic',
            'Country',
            'Department',
            'Gender',
            'GeoBoundary',
            'Group',
            'Indicator',
//            'IndicatorValue',
            'Municipality',
            'Partner',
            'PurposeOfCollection',
            'Region',
            'Scope',
            'SubCharacteristic',
            'Type',
            'Unit',
            'UnitType',
        ];
    }

    /** Adds a string to the PHP Placeholder file for db translations */
    private function addToPlaceholder(string $string)
    {
        file_put_contents(
            resource_path('lang/DbTranslationPlaceholder.php'),
            "${string}\n",
            FILE_APPEND
        );

        return true;
    }
}
