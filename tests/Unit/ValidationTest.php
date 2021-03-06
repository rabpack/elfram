<?php 

namespace Test\Unit;

use App\Http\Requests\UserRequest;
use PHPUnit\Framework\TestCase;
use System\Validations\Validation;

class ValidationTest extends TestCase{

    private $request = ['name'=>'','family'=>'nosrati','email'=>'m.nosrati2019@gmail.com','password'=>'meysam12345','passwordConf'=>'meysam12345'];

    public function setUp():void
    {
        parent::setUp();
    
    }

    public function testItCanGetErrorsValidationWithMakeMethod()
    {
        $validator = Validation::make($this->request,[
            'name' => 'required|min:3|max:100',
            'family' => 'required|min:3|max:100',
            'email' => 'required|max:190|email|unique:users',
            'password' => 'required|min:8|max:64',
            'passwordConf' => 'required|min:8|max:64|confirm:password'
        ],[
            'name'=>[
                'required' => 'name is required!',
                'min' => 'name should be minimum 3 character',
                'max' => 'name should be maximum 100 character',
            ],
            'family'=>[
                'required' => 'family is required!',
                'min' => 'family should be minimum 3 character',
                'max' => 'family should be maximum 100 character',
            ],          
            'email'=>[
                'required' => 'email is required!',
                'max' => 'email should be maximum 190 character',
                'email' => 'email format is invalid',
                'unique' => 'email should be unique in database',
            ],
            'password'=>[
                'required' => 'password is required!',
                'min' => 'password should be maximum 8 character',
                'max' => 'password should be maximum 64 character',
            ],
            'passwordConf'=>[
                'required' => 'password is required!',
                'min' => 'password should be maximum 8 character',
                'max' => 'password should be maximum 64 character',
                'confirm' => 'password should be equals with passwordConf',
            ],
        ]);
        
        $this->assertTrue($validator->isError());
        $this->assertIsArray($validator->errors());
        $this->assertEquals($validator->error('name.required'),'name is required!');
    }



}