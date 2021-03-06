<?php 

namespace System\Requests;

class Request {
    
    private $request = [];
    private $ip = null;

    public function __construct()
    {
        if(!empty($_POST)) $this->postData(); 
        if(!empty($_GET)) $this->getData(); 
    }
    private function postData()
    {
        foreach($_POST as $key=>$request){
            $this->request[$key] = htmlentities($request);
            $this->$key = $request;
        }
    }
    private function getData()
    {
        foreach($_GET as $key=>$request){
            $this->request[$key] = htmlentities($request);
            $this->$key = $request;
        }
    }

    public function all()
    {
        return $this->request;
    }
    public function ip()
    {
        if(is_null($this->ip)) $this->ip = $_SERVER['REMOTE_ADDR'];
        return $this->ip;
    }
     
    public function input(string $attribute)
    {
       return $this->request[$attribute];
    }


}