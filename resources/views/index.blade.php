@extends('layouts.main')

@section('content')
    <h1 class="display-4 text-center"> Poker Tracker </h1>

    <div class="row">
        <div class="col col-sm-4 offset-sm-4">
            <form method="post" action="{{route('post')}}">
                {{csrf_field()}}

                <div class="form-group">
                    <label for="bank_role">Bank Role</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                        </div>

                        <input type="number" name="bank_role"
                               id="bank_role" class="form-control"
                               placeholder="" step="5" min="60" value="{{optional($todayStats)->bank_role}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="winnings">Winnings</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                        </div>
                        <input type="number" name="winnings"
                               id="winnings" class="form-control"
                               step="5" min="-1000" value="{{optional($todayStats)->winnings}}">
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary w-100" value="Submit">
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h4 class="text-right w-100">Net Gain:
                <span class="{{App\Data::cssClass(App\Data::totalGain())}}">
                {{App\Data::formatTotalGain()}}
            </span>
            </h4>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <canvas id="chart"></canvas>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="pt-4">

            <table class="table table-condensed" style="font-size: 12px;">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Bank Role</th>
                    <th>Winnings</th>
                    <th>Net Gain</th>
                </tr>
                </thead>
                <tbody>
                @foreach($stats as $stat)
                    <tr class="{{App\Data::cssClass($stat->net_gain)}}">
                        <td>{{$stat->formatDate()}}</td>
                        <td>{{$stat->formatBankRole()}}</td>
                        <td>{{$stat->formatWinnings()}}</td>
                        <td>{{$stat->formatNetGain()}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
@stop
