<?php 

namespace App\Http\Requests;

use System\Http\Validation as HttpValidation;

class UserRequest extends HttpValidation{

   public function run()
   {
       return [
           'name' => 'required|min:3',
           'email' => 'required|email'
       ];
   }

}