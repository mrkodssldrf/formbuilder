<?php namespace Derduesseldorf\Formbuilder;

use Illuminate\Support\Facades\Facade;

class FormBuilderFacade extends Facade {

    protected static function getFacadeAccessor() {
        return 'formbuilder';
    }

}