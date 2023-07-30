<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewUserLoginCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userEmail;
    public $password;
    /**
     * Create a new message instance.
     */
    public function __construct( $userEmail, $password)
    {
        $this->userEmail = $userEmail;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Welcome to Our System - Your Account Login Credentials')
                    ->view('emails.login_credentials');

    }
}
