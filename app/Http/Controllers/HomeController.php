<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use System\Services\Mail\SwiftMailerService;
use System\Requests\Request;
use System\Mail\Services\PhpMailer;

class HomeController extends Controller{
    public function index()
    {
    //    $_POST = ['name'=>'asdas','email'=>'meysam@gmail.com'];
    // //     $request = new UserRequest();
    //     dd(env('meysam'));
    // $body = '<b>سلام این یک ایمیل است</b>';
    // PhpMailer::send('m.nosrati2019@gmail.com','elearn','این یک ایمیل تستی است',$body);
    // $swiftMailer = SwiftMailerService::send('m.nosrati2019@gmail.com','elearn','این یک ایمیل تستی است',$body,__DIR__.'/meysam.txt');
    // d($swiftMailer);

    
       
    }
}