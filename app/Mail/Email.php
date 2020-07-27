<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
       $this->data=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->data['parameter']=='tutor_register'){
        return $this->view('mail.tutor_register_mail');
      }
     elseif($this->data['parameter']=='admin_send_to_tutor'){
        return $this->view('mail.admin_mailsend_to_tutor');
      }
      elseif($this->data['parameter']=='student_register'){
        return $this->view('mail.student_register_mail');
      }
      elseif($this->data['parameter']=='tutor_send_to_student'){
        return $this->view('mail.tutor_mailsend_to_student');
      }
      
    }
}
