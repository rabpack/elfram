<?php 

namespace System\Application;

use Dotenv\Dotenv;
use Rabpack\Routing\Application\Application as Router;
use System\Config\Config;

class Application {

     public function __construct()
     {
        $this->dotEnvRun();
        $this->debagDdRun();
        $this->providersRun();
        $this->routerRun();
        
     }
     private function debagDdRun()
     {
        require_once dirname(dirname(__DIR__))."/vendor/larapack/dd/src/helper.php";
     }
     private function dotEnvRun()
     {
        $dotenv = Dotenv::createImmutable(dirname(dirname(__DIR__)));
        $dotenv->load();
     }
     private function routerRun()
     {
      $app = new Router();
      $app->globalRoutes();

      require_once dirname(dirname(__DIR__))."/routes/api.php";
      require_once dirname(dirname(__DIR__))."/routes/web.php";

      $app->loadConfig(dirname(dirname(__DIR__)),dirname(dirname(__DIR__))."/app/Http/Controllers","App\Http\Controllers");
       
     }

     private function providersRun()
     {
        $providers = Config::get('app.Providers');
        foreach($providers as $provider){
           $obj = new $provider();
           $obj->boot();
        }
     }



}