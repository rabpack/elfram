<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use System\Requests\Request;

class HomeController extends Controller{
    public function index()
    {
        $request = new Request();
        dd($request);
    }
}