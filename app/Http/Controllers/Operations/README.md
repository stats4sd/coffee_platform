# Import + Export Operations
These custom operations deserve their own Laravel package, but for now the best I can do is to add this readme file... 

Both these packages use and require the [Laravel Excel](https://docs.laravel-excel.com/3.1) package. 

## Exporting Data through a Laravel Backpack Crud panel
The ExportOperation lets you link an Export class built with Laravel Excel to your Crud panel.

How to add an Excel Export:

1. Build your Export operation as described [here](https://docs.laravel-excel.com/3.1/exports/)
 - To test this operation, start with the most basic version of an export (e.g. impliment FromCollection and just get all() items from your CRUD's model. You can always add things later to customise your export.
2. Import the ExportOperation in your CrudConteroller
3. Add the following to your CrudController's setup() method:
`CRUD::set('export.exporter', YourModelExport::class);` (replace with the actual name of your ModelExport class)

That's it! The operation adds a button to the 'top' stack in List view. Click the button to download the File from your ModelExport class.

**Notes**:
 - The default name is the Crud entity_plural_name, with a date-time string appended to the end.
 - The default format is .xlsx
 - To override, add an export() method to your crud controller. 

Everything about the exported file is defined by the Export class. You can customise it using any of the features of [Laravel Excel](https://docs.laravel-excel.com/3.1) as you would if you were using the package anywhere else in Laravel. All this Operation does is make it easier to quickly link an Export class to a Crud panel. 
