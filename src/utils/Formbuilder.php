<?php namespace Derduesseldorf\Formbuilder\Utils;
use Illuminate\View\View;

/**
 * Class Formbuilder
 * @package Derduesseldorf\Formbuilder\Utils
 * @version 1.0.0.0
 * @author Mirko Düßeldorf <rheingestalter@gmail.com>
 */
class Formbuilder {

    /** @var  \Eloquent $model */
    protected $model;

    /** @var  array $columns */
    protected $columns;

    /** @var array $schema */
    protected $schema = array();

    /** @var array $formAttributes */
    protected $formAttributes = array();

    /** @var string $formElementsContainer */
    protected $formElementsContainer = "ul>li";

    /** @var bool $useLabels */
    protected $useLabels = true;

    /** @var array $excludeFields */
    protected $excludeFields = array();

    /** @var  View $formView */
    protected $formView;

    /**
     * Set model and retrieve Schema
     * @param null $model
     * @return $this
     */
    public function form($model = null) {
        if($model && !is_null($model)) {
            $this->model = $model;
            $this->_getSchema();
            $this->build();
        }
        return $this;
    }

    /**
     * Use labels in form - recommended
     * @param bool $useLabels
     * @return $this
     */
    public function withLabels($useLabels = true) {
        $this->useLabels = $useLabels;
        return $this;
    }

    /**
     * Set attributes for form
     * - same as for Form::open()
     * @param array $attributes
     * @return $this
     */
    public function withAttributes(array $attributes = array()) {
        $this->formAttributes = $attributes;
        return $this;
    }

    /**
     * Set form wrapper class from call
     * @param $tagName
     * @return $this
     */
    public function setFormWrapper($tagName) {
        $this->formElementsContainer = $tagName;
        return $this;
    }

    /**
     * Exlcde fields from beeing populated
     * @param array $fields
     * @return $this
     */
    public function excludeFields(array $fields = array()) {
        $this->excludeFields = $fields;
        return $this;
    }

    /**
     * Build the view
     * @return \Illuminate\View\View
     */
    public function build() {
        if($this->schema && !is_null($this->schema) && count($this->schema) > 0) {
            $this->hasWrapper();
            $this->formView = \View::make('formbuilder::forms.formbuilder');
            return $this;
        }
    }

    /**
     * Render form to string
     * @return string
     */
    public function render() {
        return $this->formView->render();
    }

    /**
     * Return form
     * @return View
     */
    public function make() {
        return $this->formView;
    }

    /**
     * Retrieve single field from schema
     * @param $field
     * @return string
     */
    public function getField($field) {
        return FormElement::getElement($field, $this->useLabels());
    }

    /**
     * Retrieve all fields to be populated
     * @return array
     */
    public function getFormFields() {
        $this->_cleanSchema();
        return $this->schema;
    }

    /**
     * Check for using labels
     * @return bool
     */
    public function useLabels() {
        return $this->useLabels;
    }

    /**
     * Get form attributes in view
     * @return array
     */
    public function getFormAttributes() {
        return $this->formAttributes;
    }

    /**
     * Is form wrapped
     * @return bool
     */
    public function hasWrapper() {
        if(str_contains($this->formElementsContainer, '>')) {
            $this->formElementsContainer = explode('>', $this->formElementsContainer);
        }

        return is_array($this->formElementsContainer);
    }

    /**
     * Open wrapper element
     * @return string
     */
    public function openWrapper() {
        return is_array($this->formElementsContainer)
            ? '<'.$this->formElementsContainer[0].' class="'.\Config::get('formbuilder::config.wrapper-class').'">'
            : '';
    }

    /**
     * Close wrapper element
     * @return string
     */
    public function closeWrapper() {
        return is_array($this->formElementsContainer)
            ? '</'.$this->formElementsContainer[0].'>'
            : '';
    }

    /**
     * Open section element
     * @return string
     */
    public function openSection() {
        return is_array($this->formElementsContainer)
            ? '<'.$this->formElementsContainer[1].' class="'.\Config::get('formbuilder::config.section-class').'">'
            : $this->formElementsContainer;
    }

    /**
     * Close section element
     * @return string
     */
    public function closeSection() {
        return is_array($this->formElementsContainer)
            ? '</'.$this->formElementsContainer[1].'>'
            : $this->formElementsContainer;
    }

    /**
     * Clean Schema from expected fields
     * @return $this
     */
    private function _cleanSchema() {
        $this->excludeFields = array_merge(\Config::get('formbuilder::config.exclude-fields'), $this->excludeFields);
        foreach($this->excludeFields as $exceptField) {
            if(array_key_exists($exceptField, $this->schema)) {
                unset ($this->schema[$exceptField]);
            }
        }
        return $this;
    }

    /**
     * Retrieve table schema
     * @return array
     */
    private function _getSchema() {
        if($this->model && !is_null($this->model)) {
            $this->columns = \Schema::getColumnListing($this->model->getTable());
            foreach($this->columns as $column) {
                $this->schema[$column] = new FormSchema(\DB::connection()->getDoctrineColumn($this->model->getTable(), $column));
            }
            return $this;
        }
    }





}