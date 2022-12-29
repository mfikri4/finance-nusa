<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendMailVerif extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email Verif to User';

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
     * @return int
     */
    public function handle()
    {

        Mail::to($email)->send(new HappyBirthdayMail($user));
    }
}
