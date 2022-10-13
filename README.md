# Coffee Platform
https://coffeesmallholder.org/en/

# Development
To setup / test this for development:

1. Pull latest branch (dev, or whichever feature branch you are testing)
2. Check you have all variables from .env.example inside your .env file.
   1. If you have no APP_KEY, generate one with `php artisan key:generate`
3. Run the following to setup the dependancies and database with test data
   ```
   composer install
   php artisan migrate:fresh --seed  ## This might take a while! The seeder is not well optimised and it also automatically indexes all the IndicatorValues for Tntsearch...
   php artisan updatesql
   npm i
   npm run dev
   cd scripts/Rscript && Rscript -e "renv::restore()"
   ```

   Extra note:
   If you got "Cannot find module 'webpack-cli/package.json' error" when running command "npm i", 
   it can be resolved by executing below commands:

   1. Install webpack-cli globally
   ```
   npm i -g webpack-cli
   ```

   2. Install the latest versions of each dependancy
   ```
   npm update
   ```

If you encounter errors when running the migration, that may indicate errors with the migrations, model factories or database seeder. If you encounter errors when running the renv::restore(), that may indicate an issue with renv in the RStudio project.

## Translation Management
The platform is linked to translation.io to manage the translations. There are also custom commands that enable translation of Vue component strings *and* DB entries via the service. To sync to translation.io:

1. Run the meta command `php artisan translation:all`. This will do the following:
   1. Run `php artisan translation:db` to search the database for translatable strings agethow get the back into the databasend add them to the set of strings that get sent to translation.io
   2. Run `php artisan translation:vue` to search the Vue components from strings and add them.
   3. Run `php artisan translation:sync` to sync the platform with the strings on the translation.io project
   4. Run `php artisan translation:extract-json` to extract the translated strings to a JSON file (Vue is setup to read translations from JSON)
