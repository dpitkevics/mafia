<?php

namespace core\mvc;

class Model extends \RedBean_SimpleModel {
    
    public $errors = array();
    public $data = array();
    
    public function validate() {
        $data = $this->data;
        $rules = $this->rules();
        $required = array_search('required', $rules);
        $attributes = $this->attributes();
        foreach ($this->rules() as $fields => $rule) {
            $fields = explode(', ', $fields);
            switch ($rule) {
                case 'required':
                    foreach ($fields as $field) {
                        if (!isset($data[$field]) || empty($data[$field]))
                            $this->errors[$this->model][] = "<p>Field <em>{$attributes[$field]}</em> cannot be left empty.</p>";
                    }
                    break;
                case 'identical':
                    $tmp = $data[$fields[0]];
                    $fName = '';
                    foreach ($fields as $field) {
                        $fName .= $attributes[$field] . ', ';
                        if (strpos($required, $field)!==false)
                            if ($data[$field] != $tmp)
                                $this->errors[$this->model][] = "<p>Fields <em>".rtrim($fName, ', ')."</em> must be the same.</p>";
                            else
                                if (isset($data[$field]) && !empty($data[$field]))
                                    if ($data[$field] != $tmp)
                                        $this->errors[$this->model][] = "<p>Fields <em>".rtrim($fName, ', ')."</em> must be the same.</p>";
                    }
                    break;
                case 'email':
                    foreach ($fields as $field) {
                        if (strpos($required, $field)!==false)
                            if (!filter_var($data[$field], FILTER_VALIDATE_EMAIL))
                                $this->errors[$this->model][] = "<p><em>{$attributes[$field]}</em> must be a valid email address</p>";
                        else
                            if (isset($data[$field]) && !empty($data[$field]))
                                if (!filter_var($data[$field], FILTER_VALIDATE_EMAIL))
                                    $this->errors[$this->model][] = "<p><em>{$attributes[$field]}</em> must be a valid email address</p>";
                    }
                    break;
                case 'int':
                    foreach ($fields as $field) {
                        if (strpos($required, $field)!==false)
                            if (!is_numeric($data[$field]))
                                $this->errors[$this->model][] = "<p>{$attributes[$field]} must be numeric.</p>";
                        else
                            if (isset($data[$field]) && !empty($data[$field]))
                                if (!is_numeric($data[$field]))
                                    $this->errors[$this->model][] = "<p>{$attributes[$field]} must be numeric.</p>";
                    }
                    
            }
        }
        if (empty($this->errors))
            return true;
        return false;
    }
    
    public function save($validate = false) {
        $data = $this->data;
        if ($validate)
            if (!$this->validate($data))
                return false;
        $entry = \R::dispense($this->table);
        foreach ($data as $key => $value) {
            $entry->$key = $value;
        }
        return \R::store($entry);
    }
    
    public function get($attr_name) {
        return $this->model . '['.$attr_name.']';
    }
    
    public function getAttribute($attr_name) {
        $attributes = $this->attributes();
        return $attributes[$attr_name];
    }
    
}
