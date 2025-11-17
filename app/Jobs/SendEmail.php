<?php

namespace App\Jobs;

use App\Mail\PublishedPostEmail;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private $post)
    {
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try{
            $users = User::all();
            foreach($users as $user){
                Mail::to($user->email)->send(new PublishedPostEmail($this->post));
            }
        }catch(Exception $e){
            \log::error("Message: ".$e->getMessage()."File: ".$e->getFile()."Line: ".$e->getLine());
        }

    }
}
