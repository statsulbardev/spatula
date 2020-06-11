<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $subject;
    public $template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $data, $template)
    {
        $this->data = $data;
        $this->subject = $subject;
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->template === 'notification') {
            return $this->subject('Subject: ' . $this->subject)->view('backend.emails.notification');
        } else {
            return $this->subject('Subject: ' . $this->subject)->view('backend.emails.mail');
        }
    }
}
