<?php 

namespace App\Helper;

use Mail;

trait mailHelper {
    public function sendMail($view, $attr, $email, $code, $url) {
        return Mail::send($view, ['firstName'=> $attr, "{$code}"=>$url], function($mail) use ($email) {
            $mail->from('markjoker73@gmail.com', 'verify email');
            $mail->to($email);
            $mail->subject('please verify your email account');
          });
    }

    public function codeVal($code) {
        if ($code === 'verification_code') {
            $title = 'verify email';
            $subject = 'please verify your email account';
        } 
        $title = 'Reset Password';
        $subject = 'You can reset your password'; 
        $object = (object) ['title' => $title, 'subject' => $subject];
        return $object;
    }   
}