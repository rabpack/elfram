<?php 

namespace System\Application;

use Dotenv\Dotenv;

class Application { 

     public function __construct()
     {
        $this->dotEnvRun();
        
     }

     private function dotEnvRun()
     {
        $dotenv = Dotenv::createImmutable(dirname(dirname(__DIR__)));
        $dotenv->load();
     }



}