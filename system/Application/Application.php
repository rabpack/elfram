<?php 

namespace System\Application;

use Dotenv\Dotenv;
use Rabpack\Routing\Application\Application as Router;
use System\Config\Config;
use Illuminate\Database\Capsule\Manager as Capsule;


class Application {

     public function __construct()
     {
        $this->dotEnvRun();
        $this->debagDdRun();
        $this->ormRun();
        $this->helpersRun();
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

     private function helpersRun()
     {
        $customHelperPath = dirname(dirname(__DIR__)).'/app/Http/Helpers/helpers.php';
        if(file_exists($customHelperPath)){
           require_once $customHelperPath;
        }
        require_once dirname(__DIR__).'/Helpers/helpers.php';

     }
     private function ormRun()
     {
      $capsule = new Capsule;
      $capsule->addConnection([

         "driver" => Config::get('database.PDO.mysql.DB_DRIVER'),
      
         "host" =>Config::get('database.PDO.mysql.DB_HOST'),
      
         "database" => Config::get('database.PDO.mysql.DB_NAME'),
      
         "username" => Config::get('database.PDO.mysql.DB_USERNAME'),
      
         "password" => Config::get('database.PDO.mysql.DB_PASSWORD')
      
      ]);

      $capsule->setAsGlobal();
      $capsule->bootEloquent();

     }



}