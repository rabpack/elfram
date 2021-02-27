<?php 

namespace System\Validations\Classes;

class Validator{

    private $request;
    private $messages;
    private $rules;
    private $errors = [];


    public function __construct(array $request,array $rules,array $messages)
    {
    
        $this->request = $request;
        $this->messages = $messages;
        $this->rules = $rules;
    }
    
    public function validate()
    {
       foreach($this->rules as $key=>$rule){
           $rule = explode('|',$rule);
           foreach($rule as $value){
               if(strpos($value,':') !== false){
               
                  $args = substr($value,strpos($value,':')+1);
                  $method = strtok($value,':');
                  $this->{$method}($key,$args);
                 
               }else{
                  $this->{$value}($key);
               }
           }
       }
       return empty($this->errors) ? true : $this->errors;
    }

    protected function required($name,$value=null)
    {
       
        if (!isset($this->request[$name]) or empty($this->request[$name]) or strlen($this->request[$name]) === 0){
            $this->errors[$name]['required'] = isset($this->messages[$name]['required']) ? $this->messages[$name]['required'] : "$name is required";
            return false;
         }
         return true;
    }
    protected function email($name,$value=null)
    {
        
        if (!filter_var($this->request[$name],FILTER_VALIDATE_EMAIL)){
            $this->errors[$name]['email'] =isset($this->messages[$name]['email']) ? $this->messages[$name]['email']  : "email is invalid!";
            return false;
        }
        return true;
    }
    protected function min($name,$value=null)
    {
        if (strlen($this->request[$name]) < (int)$value){
            $this->errors[$name]['min'] = isset($this->messages[$name]['min']) ? $this->messages[$name]['min'] : "$name should be minimum $value character";
            return false;
        }
        return true;
    }
    protected function max($name,$value=null)
    {
        if (strlen($this->request[$name]) > (int)$value){
            $this->errors[$name]['max'] = isset($this->messages[$name]['max']) ? $this->messages[$name]['max'] : "$name should be maximum $value character";
            return false;
        }
        return true;
    }
    protected function unique($name,$value=null)
    {
      
    }
    protected function confirm($name,$value=null)
    {
      if ($this->request[$name] !== $this->request[$value]){
          $this->errors[$name]['confirm'] = isset($this->messages[$name]['confirm']) ? $this->messages[$name]['confirm'] : "Password is not equaled with password confirm";
          return false;
      }
      return true;
    }

    private function number($name,$value=null)
    {
        if (!is_numeric($this->request[$name])){
            $this->errors[$name]['number'] = isset($this->messages[$name]['number']) ? $this->messages[$name]['number'] :"$name should be number";
            return false;
        }
        return true;
    }
} 