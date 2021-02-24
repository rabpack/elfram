<?php 

namespace Test\Unit;

use PHPUnit\Framework\TestCase;
use System\Config\Config;

class ConfigTest extends TestCase{

    public function testGetConfigArrayInConfigFile(){
        $config = Config::getArrayConfig('app');
        $this->assertIsArray($config);
    }
    public function testGetConfig()
    {
       $config = Config::get('database.PDO.mysql.data.database');
       $this->assertIsString($config);
    }

}