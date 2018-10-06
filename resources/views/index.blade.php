@extends('layouts.main')

@section('content')
    {{--<h1 class="display-4 text-center"> PWT </h1>--}}

    <div class="row">
        <div class="col col-sm-4 offset-sm-4">
            <form method="post" action="{{route('post')}}">
                {{csrf_field()}}
                <div class="row">
                    <div class="col">
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
                    </div>
                    <div class="col">
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
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="chart-tab" data-toggle="tab" href="#chart-content">Chart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="table-tab" data-toggle="tab" href="#table-content">Table</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="chart-content" role="tabpanel" aria-labelledby="home-tab">
                    <canvas id="chart"></canvas>
                </div>
                <div class="tab-pane fade" id="table-content" role="tabpanel" aria-labelledby="profile-tab">
                    <table class="table table-sm" style="font-size: 12px;">
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
                            <tr class="{{App\Data::cssClass($stat->net_gain, 'table-success', 'table-danger')}}">
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
    </div>

@stop
