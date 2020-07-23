<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Mail\MailNotify;
use Mail;

class CheckAddRecord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:addrecord';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $u = User::where('tdee_guide', 1)->where('roles', 0)->get();
        foreach ($u as $user) {
            if (count($user->eatings) == 0  || count($user->cannangs) == 0) {
                Mail::to($user)->send(new MailNotify($user));
            }
        }
    }
}
