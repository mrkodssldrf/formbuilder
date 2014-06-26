<?php namespace Derduesseldorf\Formbuilder\Utils;

use Doctrine\DBAL\Schema\Column;

/**
 * Class FormElement
 * @package Derduesseldorf\Formbuilder\Utils
 * @version 1.0.0.0
 * @author Mirko Düßedorf <rheingestalter@googlemail.com>
 */
class FormElement
{
    /**
     * @param FormSchema $field
     * @param bool $useLabels
     * @return string the Element to return
     */
    public static function getElement(FormSchema $field, $useLabels = true) {
        $returnElement = null;
        $types = \Config::get('formbuilder::config.form-types');
        $options = \Config::get('formbuilder::config.form-options');
        $options = array_key_exists($field->getType(), $options) ? $options[$field->getType()] : null;
        if ($useLabels) { $returnElement .= \Form::label($field->getName(), ucfirst($field->getName())); }
        if (method_exists('\Illuminate\Html\FormBuilder', $field->getName())) {
            $method = $field->getName();
            $returnElement .= \Form::$method($field->getName(), null);
        } elseif (method_exists('\Illuminate\Html\FormBuilder', $field->getType()) && $field->getType() != 'text') {
            $method = $field->getType();
            $returnElement .= \Form::$method($field->getName(), null);
        } elseif ($field->getType() == 'text') {
            $returnElement .= \Form::textarea($field->getName(), null);
        } else {
            $returnElement .= \Form::input($types[$field->getType()], $field->getName(), ($field->getType() == 'boolean' ? 0 : null), $options);
        }
        return $returnElement;
    }
}