<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use JsonException;

class TranslationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Cache::rememberForever('translations', function () {
            $translations = collect();

            $supportedLocales = array_merge(
                (array) config('translation.source_locale'),
                (array) config('translation.target_locales')
            );

            foreach ($supportedLocales as $locale) {
                $translations[$locale] = [
                    'php' => $this->phpTranslations($locale),
                    'json' => $this->jsonTranslations($locale),
                ];
            }

            return $translations;
        });
    }

    private function phpTranslations($locale): Collection
    {
        $path = resource_path("lang/$locale");

        return collect(File::allFiles($path))->flatMap(function ($file) use ($locale) {
            $key = ($translation = $file->getBasename('.php'));

            return [$key => trans($translation, [], $locale)];
        });
    }

    /**
     * @throws JsonException
     */
    private function jsonTranslations($locale): array
    {
        $path = resource_path("js/translations.json");

        if (is_string($path) && is_readable($path)) {
            $full = json_decode(file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);

            // workaround for the fact that there is no .po file for the source locale:
            // get the keys of the first target locale for the source locale
            if($locale === config('translation.source_locale')) {
                return array_keys($full[array_keys($full)[0]]);
            }

            //return only the needed locale
            return $full[$locale];
        }

        return [];
    }
}
