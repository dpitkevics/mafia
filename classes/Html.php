<?php

namespace classes;

class Html {
    
    public static $count = 0;
    
    public static function formBegin($action = '', $method = 'post', array $htmlOptions=array()) {
        if (empty($action))
            $action = $_SERVER['REQUEST_URI'];
        $htmlOptions = self::htmlOptionsToString($htmlOptions);
        $formString = "<form action='$action' method='$method' $htmlOptions>";
        return $formString;
    }
    
    public static function formEnd() {
        return "</form>";
    }
    
    public static function label($id, $text, $required = false) {
        $labelString = "<label for='$id'>$text".($required?"<span style='color:red'>*</span>":"")."</label>";
        return $labelString;
    }
    
    public static function hiddenField($name, $value='', array $htmlOptions=array()) {
        return self::inputField('hidden', $name, $value, $htmlOptions);
    }
    
    public static function textField($name, $value='', array $htmlOptions=array()) {
        return self::inputField('text', $name, $value, $htmlOptions);
    }
    
    public static function passwordField($name, $value='', array $htmlOptions=array()) {
        return self::inputField('password', $name, $value, $htmlOptions);
    }
    
    public static function dropDownField($name, $data=array(), array $htmlOptions=array()) {
        $htmlOptions = self::htmlOptionsToString($htmlOptions);
        $selectString = "<select name='$name' $htmlOptions>";
        
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $selectString .= "<option value='$key'>$value</option>";
            }
        } else {
            if (strpos($data, 'range')!==false) {
                $data = substr($data, strpos($data, ':')+1);
                $data = explode('-', $data);
                $beg = $data[0];
                $end = $data[1];
                for ($i = $beg; $i <= $end; $i++) {
                    $selectString .= "<option value='$i'>$i</option>";
                }
            }
        }
        $selectString .= "</select>";
        
        return $selectString;
    }
    
    public static function submitButton($label='Submit', array $htmlOptions=array()) {
        $id = 'mf' . self::$count++;
        if (!array_key_exists('name', $htmlOptions)) {
            $htmlOptions['name'] = $id;
        }
        if (!array_key_exists('id', $htmlOptions)) {
            $htmlOptions['id'] = $id;
        }
        return self::inputField('submit', $id, $label, $htmlOptions);
    }
    
    public static function inputField($type, $name, $value='', array $htmlOptions=array()) {
        
        if (!array_key_exists('type', $htmlOptions)) {
            $htmlOptions['type'] = $type;
        }
        if (!array_key_exists('name', $htmlOptions)) {
            $htmlOptions['name'] = $name;
        }
        if (!array_key_exists('value', $htmlOptions)) {
            $htmlOptions['value'] = $value;
        }
        if (!array_key_exists('id', $htmlOptions)) {
            $htmlOptions['id'] = $name;
        }
        
        $post = Validator::EncodeArray($_POST);
        if (isset($post[$name]))
            $htmlOptions['value'] = $post[$name];

        $htmlOptions = self::htmlOptionsToString($htmlOptions);
        $inputString = "<input $htmlOptions />";
        return $inputString;
    }
    
    public static function htmlOptionsToString(array $htmlOptions = array()) {
        $htmlOptionString = '';
        foreach ($htmlOptions as $key => $value) {
            $htmlOptionString .= "$key = '$value' ";
        }
        return $htmlOptionString;
    }
    
    public static function link($text, $url='#', array $htmlOptions = array()) {
        $htmlOptions = self::htmlOptionsToString($htmlOptions);
        $linkString = "<a href='$url' $htmlOptions>$text</a>";
        return $linkString;
    }
    
    public static function ajaxLink($text, $url, array $data = array(), array $params = array(), array $htmlOptions = array(), $type = 'POST') {
        if (!isset($htmlOptions['id']))
            $htmlOptions['id'] = 'al' . ++self::$count;
        $id = $htmlOptions['id'];
        $htmlOptions = self::htmlOptionsToString($htmlOptions);
        $linkString = "<a href='#' $htmlOptions>$text</a>";
        JS::ajaxCall($url, $data, $params, 'click', $id);
        return $linkString;
    }
    
    public static function unorderedList(array $elements = array(), array $htmlOptions = array()) {
        $htmlOptions = self::htmlOptionsToString($htmlOptions);
        $ulString = "<ul $htmlOptions>";
        foreach ($elements as $element) {
            if (is_array($element)) {
                if (array_key_exists('htmlOptions', $element) && is_array($element['htmlOptions'])) {
                    $htmlOptions = self::htmlOptionsToString($element['htmlOptions']);
                    $ulString .= "<li $htmlOptions>";
                } else 
                    $ulString .= "<li>";
                
                if (array_key_exists('link', $element)) {
                    $ulString .= self::link(
                        $element['link']['name'], 
                        ((array_key_exists('url', $element['link']))?$element['link']['url']:"#"), 
                        ((array_key_exists('htmlOptions', $element['link']) && is_array($element['link']['htmlOptions']))?$element['link']['htmlOptions']:array())
                    );
                } else if (array_key_exists('name', $element)) {
                    $ulString .= $element['name'];
                }
                
                $ulString .= "</li>";
            } else {
                $ulString .= "<li>$element</li>";
            }
        }
        $ulString .= "</ul>";
        return $ulString;
    }
    
}
