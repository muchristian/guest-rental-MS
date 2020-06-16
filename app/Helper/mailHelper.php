<?php 

namespace App\Helper;

use Mail;

trait mailHelper {
    public function sendMail($view, $title, $subject, $attr, $email, $code, $url) {
        return Mail::send($view, ['firstName'=> $attr, "{$code}"=>$url], function($mail) use ($email) {
            $mail->from('markjoker73@gmail.com', $title);
            $mail->to($email);
            $mail->subject($subject);
          });
    }
}