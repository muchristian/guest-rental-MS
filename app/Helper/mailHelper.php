<?php 

namespace App\Helper;

use Mail;

trait mailHelper {
    public function sendMail($view, $attr, $email, $code, $url) {  
        if ("{$code}" === 'verification_code') {
            $mail = Mail::send($view, ['firstName'=> $attr, "{$code}"=>$url], function($mail) use ($email) {
                $mail->from('markjoker73@gmail.com', 'verify account');
                $mail->to($email);
                $mail->subject('Please verify your email account');
              }); 
          } else {
            $mail = Mail::send($view, ['firstName'=> $attr, "{$code}"=>$url], function($mail) use ($email) {
                $mail->from('markjoker73@gmail.com', "reset password");
                $mail->to($email);
                $mail->subject('Could you please reset your password');
              });
          }
        return $mail;
    }
   
}