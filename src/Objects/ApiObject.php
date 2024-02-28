<?php

namespace Jarca0123\CzechPostLibrary\Objects;

class ApiObject implements \JsonSerializable
{

    /*public function __construct($data) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }*/

    public function jsonSerialize() : mixed
    {
        $data = array();
        foreach (static::getRules() as $key => $rules) {
            $value = $this->$key;
            if ($value !== null) {
                if (array_key_exists('class', $rules)) {
                    if ($rules['class'] === \DateTime::class) {
                        $value = $value->format('Y-m-d');
                    }
                }
                $data[$key] = $value;
            }
        }
        return $data;
    }

    protected static function getRules(){
        return array();
    }

    public function __call($name, $arguments)
    {
        //when calling a setter, check if validation rules pass
        $passedValue = $arguments[0];
        if (substr($name, 0, 3) == 'set') {
            $property = lcfirst(substr($name, 3));
            if (isset(static::getRules()[$property])) {
                $rules = static::getRules()[$property];
                foreach ($rules as $rule => $value) {
                    switch ($rule) {
                        case 'valueType':
                            if ($value !== gettype($passedValue)) {
                                throw new \Exception('Property ' . $property . ' must be of type ' . $value);
                            }
                            break;
                        case 'class':
                            if (!is_a($passedValue, $value)) {
                                throw new \Exception('Property ' . $property . ' must be of class ' . $value);
                            }
                            break;
                        case 'minLength':
                            if (strlen($passedValue) < $value) {
                                throw new \Exception('Property ' . $property . ' must be at least ' . $value . ' characters long');
                            }
                            break;
                        case 'maxLength':
                            if (strlen($passedValue) > $value) {
                                throw new \Exception('Property ' . $property . ' must be at most ' . $value . ' characters long');
                            }
                            break;
                        case 'min':
                            if ($passedValue < $value) {
                                throw new \Exception('Property ' . $property . ' must be at least ' . $value);
                            }
                            break;
                        case 'max':
                            if ($passedValue > $value) {
                                throw new \Exception('Property ' . $property . ' must be at most ' . $value);
                            }
                            break;
                        case 'regex':
                            if (!preg_match($value, $passedValue)) {
                                throw new \Exception('Property ' . $property . ' must match regex ' . $value);
                            }
                            break;
                        case 'in':
                            if (!in_array($passedValue, $value)) {
                                throw new \Exception('Property ' . $property . ' must be one of ' . implode(', ', $value));
                            }
                            break;
                    }
                }
                $this->$property = $passedValue;
            }
        }
    }

    public function __get($name)
    {
        /*if (isset(static::getRules()[$name])) {
            return $this->{"get" . ucfirst($name)}();
        }*/
        return $this->$name;
    }
}
