<?php

namespace App;

use \PHPMailer;

class Email
{
    private $username;
    private $password;
    private $path;
    private $host;
    private $port;
    private $smtpSecure;

    /**
     * 	@param string[] $config eamil data
     */
    public function __construct($config)
    {
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->path 	= $_SERVER['HTTP_HOST']. '/activate';
        $this->host     = $config['host'];
        $this->port     = $config['port'];
        $this->smtpSecure = $config['secure'];
    }

    /**
     * Send activation email to user
     * @param string $email  users email
     * @param string $code  activation code
     * @return bool
     */
    public function sendActivationCode($email, $code)
    {
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->isHTML(true);
        $mail->SMTPAuth = true;
        //$mail->SMTPDebug = 3;

        $mail->Host = $this->host;
        $mail->Username = $this->username;
        $mail->Password = $this->password;
        $mail->SMTPSecure = $this->smtpSecure;
        $mail->Port =  $this->port;

        $mail->SetFrom("no-reply@todo.com","TODO admin");
        $mail->AddAddress($email, 'Todo user');

        $mail->Subject  =  'Activation as todo website';

        $body = $this->createActivationBody($email, $code);
        $mail->Body     =  $body;

        if($mail->send()) {
            return true;
        }
        else {
            return false;
        }
    }
    private function createActivationBody($email,$code)
    {
        $link = $this->path."?c=" . $code ."&e={$email}";

        $body = "<p>Thanks for signing up with TODO app! You must follow this link to <strong>activate your</strong> account:</p>";
        $body .= "<p>{$link}<p>";
        $body .= "<footer><p>Have fun, and don't hesitate to contact us with your feedback.</p></footer>";
        $body .= "<footer><p>The todo Team</p></footer>";

        return $body;
    }
}