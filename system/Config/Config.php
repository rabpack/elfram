<?php 

namespace System\Config;

class Config {

    protected function getArrayConfig($fileConfig)
    {
         $configDir = dirname(dirname(__DIR__))."/configs/";
         $config = require $configDir.$fileConfig.'.php';
         return $config;
    }
    
    protected function get($config)
    {
       $config = explode('.',$config);
       $fileConfig = $this->getArrayConfig($config[0]);
       unset($config[0]);
       $config = array_values($config);
       return $this->arrayDot($fileConfig,$config);
    }
    private function arrayDot(array $configs,$settings)
    {
       $config = [];
       foreach($settings as $key => $setting){
              if($key === 0){
                $config = $configs[$setting];
              }else{
                $config = $config[$setting];
              }
       }
       return $config;
    }

    public static function __callStatic($name, $arguments)
    {
      $obj = new self();
      return call_user_func_array([$obj,$name],$arguments);
    }

}