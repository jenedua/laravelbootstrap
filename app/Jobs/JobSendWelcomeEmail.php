<?php

namespace App\Jobs;

use App\Mail\SendWelcomeEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class JobSendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private $userId)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //Recuperar os dados do usuario
        $user = User::find($this->userId);

        // Enviar o email de boas-vindas para o usuário
        Mail::to($user->email)
        ->later(now()->addMinute(), new SendWelcomeEmail($user));
        
    }
}
