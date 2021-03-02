# Import + Export Operations
These custom operations deserve their own Laravel package, but for now the best I can do is to add this readme file... 

Both these packages use and require the [Laravel Excel](https://docs.laravel-excel.com/3.1) package. 

## Exporting Data through a Laravel Backpack Crud panel
The ExportOperation lets you link an Export class built with Laravel Excel to your Crud panel.

How to add an Excel Export:

1. Build your Export operation as described [here](https://docs.laravel-excel.com/3.1/exports/)
 - To test this operation, start with the most basic version of an export (e.g. impliment FromCollection and just get all() items from your CRUD's model. You can always add things later to customise your export.
2. Use the ExportOperation in your CrudController: `use \App\Http\Controllers\Operations\ExportOperation` 
3. Add the following to your CrudController's setup() method:
`CRUD::set('export.exporter', YourModelExport::class);` (replace with the actual name of your ModelExport class)

That's it! The operation adds a button to the 'top' stack in List view. Click the button to download the File from your ModelExport class.

**Notes**:
 - The default name is the Crud entity_plural_name, with a date-time string appended to the end.
 - The default format is .xlsx
 - To override, add an export() method to your crud controller. 

Everything about the exported file is defined by the Export class. You can customise it using any of the features of [Laravel Excel](https://docs.laravel-excel.com/3.1) as you would if you were using the package anywhere else in Laravel. All this Operation does is make it easier to quickly link an Export class to a Crud panel. 

## Importing Data through a Laravel Backpack Crud panel
The ImportOperation lets you link an Imort class built with Laravel Excel to your Crud panel.

How to add:

1. Build your Import operation as described [here](https://docs.laravel-excel.com/3.1/imports/)
2. Use the ImportOperation in your CrudController: `use \App\Http\Controllers\Operations\ImportOperation` 
3. Add the following to your CrudController's setup() method:
`CRUD::set('import.importer, YourModelImport::class);` (replace with the actual name of your ModelImport class)

That's it! The operation adds a button to the 'top' stack in List View. Click this button to be taken to the Import View. This view contains a basic form with a file upload input and a submit button. Add an Excel file, submit, and the file will be processed by your ModelImport class. 


**Notes**:
 - It's recommended to add validation to your importer. (See documentation page on [validating rows](https://docs.laravel-excel.com/3.1/imports/validation.html))
 - The import form has support for displaying errors returned from validation. If you use batch imports, you will see errors from the entire batch of rows at once, labeled with the correct row number. This is useful for seeing all errors at once in an Excel file, instead of going row-by-row and having to try importing the same file multiple times until it works with no validation errors. 

**TO DO: add examples of validation with both ToModel / BatchInserts AND ToCollection concerns**

