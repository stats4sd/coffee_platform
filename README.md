<h1>Coffee Platform</h1>
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

