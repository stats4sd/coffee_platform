<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $targetLocales = config('translation.target_locales');
        $sourceLocale = config('translation.source_locale');

        $availableLocales = array_merge($targetLocales, array($sourceLocale));

        // See if locale in url is absent or isn't among known languages.
        if (!\in_array($request->segment(1), $availableLocales, true)) {

            // pick the most appropriate locale:
            $priorityLocales = [
                $request->getPreferredLanguage($availableLocales),
                config('app.fallback_locale'),
                $sourceLocale
            ];


            // Redirect to same url with default locale prepended.
            $uri = $request->getUriForPath('/' . reset($priorityLocales) . $request->getPathInfo());

            return redirect($uri, 302);
        }

        return $next($request);
    }
}
