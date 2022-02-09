<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): WelcomeMail
    {
        return $this->view('mail.verify_email')
            ->subject('Bem vindo ao ' . config('app.name'))
            ->with([
                'verifyEmailLink' => config("app.url") . '/verificar-email?token=' . $this->user->confirmation_token
            ]);
    }
}
