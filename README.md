#Formbuilder Package for Laravel 
A small formbuilder for Laravel Models 

##About 
This Package is in early status. 

##Installing
Require this package in your composer.json 

`"derduesseldorf/formbuilder" : "dev-master"`

After updating composer add the ServiceProvider to the providers in your app/config/app.php 

`"Derduesseldord\Formbuilder\FormbuilderServiceProvider"`

Add the Facade to the aliases in app/config/app.php 

`"Formbuilder" => "Derduesseldorf\Formbuilder\FormBuilderFacade"`

##Configuration

To publish the configuration for the Formbuilder Package run 

`php artisan config:publish derduesseldorf/formbuilder`

###Possible Settings 
* **use-labels**   
is used to display labels in your form (Recommended: true)

* **wrapper-class**   
sets the class around the form wrapper 

* **section-class**   
sets the class around the form sections / fields 

* **form-class**   
sets the class form the form

* **exclude-fields**   
exclude fields from beeing displayed by default

* **form-types**   
strongly recommended to leave as it is. Defines types for input fields

* **form-options**   
Defines options for inputs

##The Form View 

The view is located under 

`<root>/vendor/derduesseldorf/formbuilder/src/views/forms/formbuilder.blade.php`

The HTML is clean. So you can style it your way. 

##How to use 

* **The simplest way**   
`$form = Formbuilder::form(new YourModel)->render();`  
Assign `$form` to your View

* **With Form attributes**   
`$form = Formbuilder::form(new YourModel);`    
`$form->withAttributes(array('url' => 'actionurl', 'method' => 'post|get|put|delete'))`  
`$form = $form->render(); `  
[Documentation on Laravel.com - Opening a form](http://laravel.com/docs/html#opening-a-form)

* **With Field excludes**   
`$form = Formbuilder::form(new YourModel);`    
`$form->withAttributes(array('url' => 'actionurl', 'method' => 'post|get|put|delete'))`  
`$form->excludeFields(array('of', 'excluded', 'field'))`  
`$form = $form->render(); `

* **With Enable/Disable labels**   
`$form = Formbuilder::form(new YourModel);`    
`$form->withAttributes(array('url' => 'actionurl', 'method' => 'post|get|put|delete'))`  
`$form->excludeFields(array('of', 'excluded', 'field'))`    
`$form->withLabels(true|false)`
`$form = $form->render(); `