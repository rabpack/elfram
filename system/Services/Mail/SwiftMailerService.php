<?php

namespace System\Services\Mail;

use System\Config\Config;

class SwiftMailerService{
    private $host;
   private $SMTPAuth;
   private $username;
   private $password;
   private $port;
   private $from;
   private $name;
  
  public function __construct()
  {
    $this->host = Config::get('email.phpMailer.host');
    $this->SMTPAuth = Config::get('email.phpMailer.SMTPAuth');
    $this->username = Config::get('email.phpMailer.username');
    $this->password = Config::get('email.phpMailer.password');
    $this->port = Config::get('email.phpMailer.port');
    $this->from = Config::get('email.phpMailer.from');
    $this->name = Config::get('email.phpMailer.name');
  }
  
  private function send($email,$name='elearnac',$subject,$body,$attachment=null)
  {
// Create the Transport
$transport = (new \Swift_SmtpTransport($this->host, $this->port,'tls'))
  ->setUsername($this->username)
  ->setPassword($this->password);

// Create the Mailer using your created Transport
$mailer = new \Swift_Mailer($transport);

// Create a message
$message = (new \Swift_Message($subject))
  ->setFrom([$this->from => $this->name])
  ->setTo($email)
  ->setBody($body,'text/html');
    
  if(!is_null($attachment)){
        $message->attach(\Swift_Attachment::fromPath($attachment));
  }


// Send the message
$result = $mailer->send($message);
 return $result;
  }
  public static function __callStatic($name, $arguments)
  {
    $obj = new self();
    return call_user_func_array([$obj,$name],$arguments);
  }
}