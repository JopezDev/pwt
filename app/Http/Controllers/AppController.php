<?php

namespace App\Http\Controllers;

use App\Data;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index() {
        $date           = Carbon::now();
        $date->timezone = 'America/New_York';

        $stats      = Data::all()->sortBy('date');
        $todayStats = Data::whereRaw("date like '{$date->format('Y-m-d')}%'")->first();

        return view('index', compact('stats', 'todayStats'));
    }

    public function store(Request $req) {
        $date           = Carbon::now();
        $date->timezone = 'America/New_York';

        $data            = new Data;
        $data->date      = $date;
        $data->bank_role = $req->get('bank_role');
        $data->winnings  = $req->get('winnings');
        $data->net_gain  = $req->get('winnings') - $req->get('bank_role');
        $data->save();

        return redirect()->back();
    }

    public function data() {
        $rawStats = Data::all()->sortBy('date');
        $labels   = $rawStats->pluck('date')->map(function($datum) {
            return $datum->format('m/d/y H:i:s');
        });
        $stats    = $rawStats->pluck('net_gain');

        $data = collect([
            'labels' => $labels,
            'stats'  => $stats,
        ]);

        return response()->json(['data' => $data]);
    }

    public function debug() {
        $temp = [];
        Data::all()->each(function($stat) use (&$temp) {
            $temp[$stat->date->format('Ymd')][] = $stat->net_gain;
        });

        $sum = 0;
        foreach($temp as $dateGroup)
            $sum += array_sum($dateGroup);
    }
}

