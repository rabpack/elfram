<?php 

namespace System\Mail\Services;

use Exception;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer as Mailer;
use System\Config\Config;

class PhpMailer{

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
  
  private function send($email,$name='elearnac',$subject,$body,$attachment=null){
    $mail = new Mailer(true);

try {
    //Server settings
    $mail->CharSet = 'UTF-8';
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       =  $this->host;
    $mail->SMTPAuth   = $this->SMTPAuth;
    $mail->Username   = $this->username;
    $mail->Password   = $this->password;
    $mail->SMTPSecure = Mailer::ENCRYPTION_STARTTLS;
    $mail->Port       = $this->port;

    //Recipients
    $mail->setFrom($this->from, $this->name);
    $mail->addAddress($email, $name);

    //Attachments
    if(!is_null($attachment)){
    $mail->addAttachment($attachment);
    }

    //Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $body;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
   $result = $mail->send();
   
   return $result;

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
  }

  // protected function send($email,$subject,$body,$attachment=null)
  // {
  //    $this->setConfig();
  // }

  public static function __callStatic($name, $arguments)
  {
    $obj = new self();
    return call_user_func_array([$obj,$name],$arguments);
  }
}