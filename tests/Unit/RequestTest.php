<?php 

namespace Test\Unit;

use PHPUnit\Framework\TestCase;
use System\Requests\Request;

class RequestTest extends TestCase{
    private $request = null;

    public function setUp():void
    {
        parent::setUp();
        $_POST = ["name" => "meysam","family"=>"nosrati","mobile"=>"09120629038"];
        $this->request = new Request();
    }
    
    public function tearDown():void
    {
        parent::tearDown();
        $this->request = null;
        $_POST = [];
    }

    public function testGetAllMethodInRequest()
    {
        $this->assertIsArray($this->request->all());
        $this->assertEquals("meysam",$this->request->all()["name"]);
        $this->assertEquals("nosrati",$this->request->all()["family"]);
        $this->assertEquals("09120629038",$this->request->all()["mobile"]);
    }
     
    public function testItCanGetRequestPropertyInRequestClass()
    {
        $this->assertIsString($this->request->name);
        $this->assertIsString($this->request->family);
        $this->assertIsString($this->request->mobile);
        $this->assertEquals("meysam",$this->request->name);
        $this->assertEquals("nosrati",$this->request->family);
        $this->assertEquals("09120629038",$this->request->mobile);
    }

    public function testItCanGetRequestByInputMethod()
    {
        $name = $this->request->input('name');
        $this->assertIsString($name);
        $this->assertEquals('meysam',$name);

    }


}