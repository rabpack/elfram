<?php 

return [

    "phpMailer" => [
        'host' => env('HOST') === null ? 'smtp.gmail.com' : env('HOST'),
        'SMTPAuth' => env('SMTP_AUTH') === null ? true : env('SMTP_AUTH'),
        'username' => env('USERNAME') === null ? '' : env('USERNAME'),
        'password' => env('PASSWORD') === null ? '' : env('PASSWORD'),
        'port' => env('PORT') === null ? 587 : env('PORT'),
        'from' => env('SET_FROM') === null ? 'info@elearnac.ir' : env('SET_FROM'),
        'name' => env('SET_NAME') === null ? 'noReplay' : env('SET_NAME'),
    ],
    
    "swiftMailer" => [
        'host' => env('HOST') === null ? 'smtp.gmail.com' : env('HOST'),
        'SMTPAuth' => env('SMTP_AUTH') === null ? true : env('SMTP_AUTH'),
        'username' => env('USERNAME') === null ? '' : env('USERNAME'),
        'password' => env('PASSWORD') === null ? '' : env('PASSWORD'),
        'port' => env('PORT') === null ? 587 : env('PORT'),
        'from' => env('SET_FROM') === null ? 'info@elearnac.ir' : env('SET_FROM'),
        'name' => env('SET_NAME') === null ? 'noReplay' : env('SET_NAME'),
    ],


];