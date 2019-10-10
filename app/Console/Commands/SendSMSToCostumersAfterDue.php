<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Twilio\Rest\Client;

class SendSMSToCostumersAfterDue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer:afterdue {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends SMS to Customers when they failed to pay on their due date';

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
        $name = $this->argument('name');
        $message = "Hi {$name}!\nI would like to remind you that you failed to pay within your due date. You have only 5 days to settle your account before we add penalty unto it. Thank you.\n\n~A friendly reminder from Transcycle Motors";
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $numbers = ['+639754276790', '+639552742128'];
        $client = new Client($account_sid, $auth_token);
        foreach ($numbers as $key => $number) {
            $client->messages->create($number, ['from' => $twilio_number, 'body' => $message]);
        }
    }
}
