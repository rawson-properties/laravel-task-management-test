<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $user)
    {
    }

    public function build(): WelcomeEmail
    {
        return $this->subject('Welcome to Our Website')
            ->view('emails.welcome', ['user' => $this->user]);
    }
}
