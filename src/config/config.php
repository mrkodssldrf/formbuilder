<?php

return array(
    'use-labels' => true,
    'wrapper-class' => 'from-wrapper',
    'section-class' => 'form-element',
    'form-class' => 'formbuilder-form',

    /** Exlude Fields by default */
    'exclude-fields' => array(
        'id',           // Standard pk
        'deleted_at',   // Standart softdelete
        'created_at',   // Standart timestamp
        'updated_at',   // Standart timestamp
    ),

    /** Form Types */
    'form-types' => array(
        'integer' => \Derduesseldorf\Formbuilder\Utils\FormTypes::FORM_INTEGER,
        'smallint' => \Derduesseldorf\Formbuilder\Utils\FormTypes::FORM_INTEGER,
        'bigint' => \Derduesseldorf\Formbuilder\Utils\FormTypes::FORM_INTEGER,
        'boolean' => \Derduesseldorf\Formbuilder\Utils\FormTypes::FORM_INTEGER,
        'email' => \Derduesseldorf\Formbuilder\Utils\FormTypes::FORM_EMAIL,
        'password' => \Derduesseldorf\Formbuilder\Utils\FormTypes::FORM_PASSWORD,
        'datetime' => \Derduesseldorf\Formbuilder\Utils\FormTypes::FORM_DATETIME,
        'date' => \Derduesseldorf\Formbuilder\Utils\FormTypes::FORM_DATE,
        'timestamp' => \Derduesseldorf\Formbuilder\Utils\FormTypes::FORM_DATETIME,
        'time' => \Derduesseldorf\Formbuilder\Utils\FormTypes::FORM_DATETIME,
        'string' => \Derduesseldorf\Formbuilder\Utils\FormTypes::FORM_TEXT,
        'double' => \Derduesseldorf\Formbuilder\Utils\FormTypes::FORM_TEXT,
        'float' => \Derduesseldorf\Formbuilder\Utils\FormTypes::FORM_TEXT,
        'decimal' => \Derduesseldorf\Formbuilder\Utils\FormTypes::FORM_TEXT,
    ),

    /** Form Options */
    'form-options' => array(
        'boolean' => array('min' => 0, 'max' => 1, 'value' => 0),
    )
);