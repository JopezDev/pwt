<?php

namespace App\Http\Controllers;

use App\Data;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index() {
        $stats      = Data::all()->sortBy('date');
        $todayStats = Data::where('date', Carbon::now()->format('Y-m-d'))->first();

        return view('index', compact('stats', 'todayStats'));
    }

    public function store(Request $req) {
        $date = Carbon::now()->format('Y-m-d');

        if(!$data = Data::where('date', $date)->first())
            $data = new Data;

        $data->date      = Carbon::now();
        $data->bank_role = $req->get('bank_role');
        $data->winnings  = $req->get('winnings');
        $data->net_gain  = $req->get('winnings') - $req->get('bank_role');
        $data->save();

        return redirect()->back();
    }

    public function data() {
        $rawStats = Data::all()->sortByDesc('date');
        $labels   = $rawStats->pluck('date')->map(function($datum) {
            return $datum->format('m/d/y');
        });
        $stats    = $rawStats->pluck('net_gain');

        $data = collect([
            'labels' => $labels,
            'stats'  => $stats,
        ]);

        return response()->json(['data' => $data]);
    }

    public function debug() {
        $fromDate = '2015-01-01';
        $toDate   = '2018-12-31';

        $startDate = Carbon::parse($fromDate)->next(Carbon::FRIDAY); // Get the first friday.
        $endDate   = Carbon::parse($toDate);

        for($date = $startDate; $date->lte($endDate); $date->addWeek()) {
            $fridays[] = $date->format('Y-m-d');
        }
    }
}

