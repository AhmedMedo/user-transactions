<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReadJsonDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'read:json-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users_path = storage_path().'/json/users.json';
        $users = json_decode(file_get_contents($users_path) , true)['users'];

        foreach ($users as $user) {
            User::firstOrCreate([
                'uuid'  => $user['id']
            ],[
                'name'   => $user['email'],
                'email'  => $user['email'],
                'uuid'   => $user['id'],
                'password'=> \Hash::make('ourEducation@2022'),
                'balance' => $user['balance'],
                'currency' => $user['currency'],
                'created_at'=> Carbon::createFromFormat('d/m/Y',$user['created_at'])->toDateTimeString()
            ]);
        }


        $transactions_path = storage_path().'/json/transactions.json';
        $transactions = json_decode(file_get_contents($transactions_path) , true)['transactions'];

        foreach ($transactions as $transaction) {
            Transaction::firstOrCreate([
                'uuid'      => $transaction['parentIdentification']
            ],[
                'uuid'      => $transaction['parentIdentification'],
                'user_email'=> $transaction['parentEmail'],
                'paid_amount'=> $transaction['paidAmount'],
                'payment_date'=> Carbon::parse($transaction['paymentDate'])->toDateTimeString(),
                'currency'    => $transaction['Currency'],
                'status'      => $this->mapTransactionStatus($transaction['statusCode'])
            ]);
        }

    }

    private function mapTransactionStatus($status)
    {
        $statuses = [
            '1'    => 'authorized',
            '2'    => 'decline',
            '3'    => 'refunded'
        ];

        return array_key_exists($status , $statuses) ? $statuses[$status] : 'authorized';
    }
}
