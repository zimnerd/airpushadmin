@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i>{{ __('Campaigns') }}</div>
                        <div class="card-body">
                            <div class="row">
                                <a href="{{ route('campaigns.create') }}" class="btn btn-primary m-2 float-right">{{ __('Add Campaign') }}</a>
                            </div>
                            <br>
                            <table class="table table-responsive-sm table-sm table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Daily Budget</th>
                                    <th>Impressions</th>
                                    <th>Clicks</th>
                                    <th>CTR</th>
                                    <th>Current Bid</th>
                                    <th>Avg. Bid Spent</th>
                                    {{--                                    <th>Conv.</th>--}}
                                    {{--                                    <th>Conv. Rate</th>--}}
                                    {{--                                    <th>CPA</th>--}}
                                    <th>Last Update</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($campaigns as $campaign)
                                    <tr>
                                        <td><strong><a href="{{ url('/campaigns/' . $campaign->id) }}" class="btn btn-block btn-outline-success">{{ $campaign->name }}</a></strong></td>
                                        <td><strong>{{ substr($campaign->start,0,10)}}</strong></td>
                                        <td><strong>{{ substr($campaign->end,0,10)}}</strong></td>
                                        <td>{{ $campaign->adformat->name }}</td>
                                        <td>
                                            @if ($campaign->status->name !== 'deleted' && $campaign->end < Carbon\Carbon::now())
                                                <span class="badge badge-pill badge-primary">
                                      Expired
                                            @else
                                                        <span class="{{ $campaign->status->class }}">
                                      {{ $campaign->status->name }}
                                  </span>
                                            @endif

                                        </td>
                                        <td>{{ $campaign->daily_budget }}</td>
                                        @if (count($campaign->creative)> 0)

                                            <td><strong>{{ $campaign->creative->sum("impressions") }}</strong></td>
                                        @else
                                            <td><strong>Creatives missing</strong></td>
                                        @endif
                                        <td><strong>{{  $campaign->creative->sum("clicks")}}</strong></td>
                                        @if (count($campaign->creative)> 0 && $campaign->creative->sum("impressions") > 0)
                                            <td><strong>{{  round($campaign->creative->sum("clicks") / $campaign->creative->sum("impressions") * 100,2) }}%</strong></td>
                                        @else

                                            <td><strong>N/A</strong></td>
                                        @endif
                                        <td><strong>{{ $campaign->current_bid }}</strong></td> @if (count($campaign->creative)> 0)
                                            <td><strong>{{ $campaign->creative->sum('spend')/ count($campaign->creative) }}</strong></td>@else
                                            <td><strong>N/A</strong></td>
                                        @endif
                                        {{--                                            <td><strong>{{ $campaign->creative->sum("conversion") }}</strong></td>--}}
                                        {{--                                        @if (count($campaign->creative)> 0 && $campaign->creative->sum("clicks") > 0)--}}
                                        {{--                                            <td><strong>{{ round($campaign->creative->sum("conversion") /$campaign->creative->sum("clicks")*100,2)}} %</strong></td>--}}
                                        {{--                                        @else--}}

                                        {{--                                            <td><strong>N/A</strong></td>--}}
                                        {{--                                        @endif--}}
                                        {{--                                        @if (count($campaign->creative)> 0 &&  $campaign->creative->sum("clicks") > 0)--}}
                                        {{--                                            <td><strong>R{{ round(($campaign->creative->sum("spend") / $campaign->creative->sum("clicks")) *100, 2)}} </strong></td>--}}
                                        {{--                                        @else--}}

                                        {{--                                            <td><strong>N/A</strong></td>--}}
                                        {{--                                        @endif--}}
                                        <td><small>{{ date('Y-m-d', strtotime($campaign->updated_at))   }}</small></td>
                                        <td>
                                            <a href="{{ url('/campaigns/' . $campaign->id . '/edit') }}" class="btn btn-block btn-primary btn-sm">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('campaigns.destroy', $campaign->id ) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-block btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('javascript')

@endsection

