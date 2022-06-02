<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    private $user;
    /**
     * @var string
     */
    private $token;

    /**
     * @param User $user
     * @param string $token
     */
    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
    }
    /**
     * @return ResetPassword
     */
    public function build(): ResetPassword
    {
        return $this->view('emails.forgot_password_template',[
            'token' =>  $this->token,
            'user'=> $this->user,
        ]);
    }
}
