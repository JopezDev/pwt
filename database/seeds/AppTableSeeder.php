<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AppTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $fromDate = '2015-01-01';
        $toDate   = '2018-12-31';

        $startDate = Carbon::parse($fromDate)->next(Carbon::FRIDAY); // Get the first friday.
        $endDate   = Carbon::parse($toDate);

        for($date = $startDate; $date->lte($endDate); $date->addWeek()) {
            $bankRoleRange = range(60, 200, 20);
            $bankRoleIndex = rand(0, count($bankRoleRange) - 1);
            $bankRole      = $bankRoleRange[$bankRoleIndex];
            $winningsRange = range(0, 800, 1);
            $winningsIndex = rand(0, count($winningsRange) - 1);
            $winnings      = $winningsRange[$winningsIndex];

            DB::table('app')->insert([
                'date'       => $date->format('Y-m-d'),
                'bank_role'  => $bankRole,
                'winnings'   => $winnings,
                'net_gain'   => $winnings - $bankRole,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
