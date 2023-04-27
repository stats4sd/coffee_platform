# The State of the Smallholder Coffee Farmer Platform
This platform was developed to be an open access resource, connecting indicator data about smallholder coffee farmers as part of a pilot stemming from a partnership between Heifer International, Lutheran World Relief, the Agroecology and Livelihoods Collaborative at the University of Vermont and Stats4SD.

https://coffeesmallholder.org/

# Development
This platform is built using Laravel/PHP. The front-end is written in VueJS and the admin panel uses Backpack for Laravel.

## Setup Local Environment
1.	Clone repo: `git@github.com:stats4sd/coffee_platform.git`
2.	Copy `.env.example` as a new file and call it `.env`
3.	Update variables in `.env` file to match your local environment:
    1.	Check APP_URL is correct
    2.	Update DB_DATABASE (name of the local MySQL database to use), DB_USERNAME (local MySQL username) and DB_PASSWORD (local MySQL password)
4.	Create a local MySQL database with the same name used in the `.env` file
5.	Run the following setup commands in the root project folder:
```
composer install
php artisan key:generate
php artisan backpack:install
php artisan telescope:publish
php artisan updatesql
npm install
npm run dev
cd scripts/Rscript && Rscript -e "renv::restore()"
```
6.	Migrate the database: `php aritsan migrate:fresh --seed` (This might take a while! The seeder is not well optimised and it also automatically indexes all the IndicatorValues for Tntsearch...) or copy from the staging site


### Note:
If you got "Cannot find module 'webpack-cli/package.json' error" when running command `npm install`, 
   it can be resolved by executing below commands:

   1. Install webpack-cli globally
   ```
   npm install -g webpack-cli
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
