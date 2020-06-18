<?php 

namespace App\Helper;

use Mail;
use App\Mail\TestEmail;

trait mailHelper {
    public function sendMail($view, $firstname, $to, $subject, $code, $url) {  
    $data = [
        'view' => $view,
        'name' => "{$firstname}", 
        'url' => $url, 
        'subject' => $subject,
        'code' => $code
    ];
    $mail = Mail::to("{$to}")->send(new TestEmail($data));
    return $mail;
    }
   
}