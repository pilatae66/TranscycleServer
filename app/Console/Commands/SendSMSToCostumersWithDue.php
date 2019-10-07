<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Twilio\Rest\Client;

class SendSMSToCostumersWithDue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer:beforedue {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends SMS to Customers when their due is tomorrow';

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
        $message = "Hi {$name}!\nI would like to remind you that your due date is tomorrow. Please be guided. Thank you!\n\n~A friendly reminder from Transcycle Motors";
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create('+639554869511', ['from' => $twilio_number, 'body' => $message]);
    }
}
