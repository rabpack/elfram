<?php 

namespace System\Validations;

use System\Validations\Classes\Validator;
use System\Validations\ValidationsInterface;

class Validation{
    private $errors;
    public function __construct()
    {
      
    }
    
    public function run()
    {
        return [];
    }

    protected function make(array $request,array $rules,array $messages = null)
    {
       $validator = new Validator($request,$rules,$messages);
       $this->errors = $validator->validate() === true ? [] : $validator->validate();
       return $this;
    }

    protected function isError()
    {
        return empty($this->errors) ? false : true;
    }
    protected function errors()
    {   
        return $this->errors;
    }
    protected function error($errorName)
    {
        $errorNames = explode('.',$errorName);
        $errors = [];
        foreach($errorNames as $key=>$name){
            if($key === 0){
                 $errors = $this->errors[$name];
            }else{
                $errors = $errors[$name];
            }
        }
        return $errors;
    }
    public static function __callStatic($name, $arguments)
    {
        $obj = new self();
        return call_user_func_array([$obj,$name],$arguments);
    }
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this,$name],$arguments);
    }
    
}