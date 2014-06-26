<?php namespace Derduesseldorf\Formbuilder\Utils;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Types\Type;

/**
 * Class FormSchema
 * @package Derduesseldorf\Formbuilder\Utils
 * @version 1.0.0.0
 * @author Mirko Düßeldorf <rheingestalter@gmail.com>
 */
class FormSchema
{

    /** @var  int $id */
    protected $id;

    /** @var  string $name */
    protected $name;

    /** @var  string $type */
    protected $type;

    /** @var  int $length */
    protected $length;

    /** @var  string $default */
    protected $default;

    /** @var  string $comment */
    protected $comment;

    /**
     * Maps only needed definitions defined as __CLASS__ properties
     * @param Column $column
     */
    public function __construct(Column $column) {
        foreach ($column->toArray() as $type => $value) {
            if (array_key_exists($type, get_class_vars(__CLASS__))) {
                if ($value instanceof Type) {
                    $this->$type = $value->getName();
                    continue;
                }
                $this->$type = $value;
            }
        }
        return $this;
    }

    /**
     * Let's do some magic
     * Caller for properties
     * @param $method
     * @param $arg
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function __call($method, $arg) {
        if (str_contains($method, 'get')) {
            $definition = strtolower(substr($method, 3, strlen($method)));
            if (array_key_exists($definition, get_class_vars(__CLASS__))) {
                return $this->$definition;
            } else {
                throw new \InvalidArgumentException('Fieldtype has not been defined');
            }
        }
    }

}