<style>
    td.column_name{
        border: 3px solid #000 !important;
    }
    .table th, .table td {
        padding: 0 5px !important;
        vertical-align: middle !important;

    }
</style>
@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> <h4>Campaign Name: {{ $campaign->name }}</h4></div>
                        <div class="card-body">
                            <table class="table table-responsive-sm table-sm table-bordered table-striped">
                                <thead>
                                <tr>
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
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
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
                                    <td><strong>{{ $campaign->current_bid }}</strong></td>
                                    @if (count($campaign->creative)> 0)
                                        <td><strong>{{ round($campaign->creative->sum('spend')/ count($campaign->creative),2)}}</strong></td> @else
                                        <td><strong>Creatives missing</strong></td>
                                    @endif
                                    {{--                                    <td><strong>{{ $campaign->creative->sum("conversion") }}</strong></td>--}}

                                    {{--                                    @if (count($campaign->creative)> 0 && $campaign->creative->sum("clicks") > 0)--}}
                                    {{--                                        <td><strong>{{ round($campaign->creative->sum("conversion") /$campaign->creative->sum("clicks")*100,2)}} %</strong></td>--}}
                                    {{--                                    @else--}}

                                    {{--                                        <td><strong>N/A</strong></td>--}}
                                    {{--                                    @endif--}}
                                    {{--                                    @if (count($campaign->creative)> 0 &&  $campaign->creative->sum("clicks") > 0)--}}
                                    {{--                                        <td><strong>R{{ round(($campaign->creative->sum("spend") / $campaign->creative->sum("clicks")) *100, 2)}} </strong></td>--}}
                                    {{--                                    @else--}}

                                    {{--                                        <td><strong>N/A</strong></td>--}}
                                    {{--                                    @endif--}}
                                    <td><small>{{ date('Y-m-d', strtotime($campaign->updated_at))   }}</small></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> <h4>Creatives <small>(Edit values in bordered cells below.)</small><span><a href="{{ route('creatives.create',['id'=>$campaign->id] ) }}" class="btn btn-primary m-2 float-right">{{ __('Add Creative') }}</a></span></h4></div>
                        <div class="card-body">
                            <div id="message"></div>

                            <table class="table table-responsive-sm table-sm table-bordered table-striped">
                                <thead class="bg-dark text-white">
                                <tr>
                                    <th></th>
                                    <th>Creative Ad</th>
                                    <th>Status</th>
                                    <th>Creative URL</th>
                                    <th>Impressions</th>
                                    <th>Clicks</th>
                                    <th>CTR Avg.</th>
                                    <th>Spent</th>
{{--                                    <th>Conv.</th>--}}
{{--                                    <th>Conv. Rate</th>--}}
{{--                                    <th>CPA</th>--}}
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($campaign->creative as $creative)
                                    <tr>
                                        @if($creative->image_path !== null)
                                        <td>
                                        <a href="{{url('storage/'.$creative->image_path)}}"><button class="btn-xs btn-success">
                                            <svg class="c-icon">
                                            <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-cloud-download">{{$creative->image_path}}</use>
                                            </svg>
                                        </button></a>
                                        </td>
                                        @elseif($creative->video_path !== null)
                                        <td>
                                            <a href="{{url('storage/'.$creative->video_path)}}"><button class="btn-sm btn-success">
                                                <svg class="c-icon">
                                                <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-cloud-download">{{$creative->image_path}}</use>
                                                </svg>
                                            </button></a>
                                        </td>
                                        @else
                                        <td></td>
                                        @endif
                                        <td>{{$creative->name}}</td>
                                        <td>
                                            @if ($creative->status->name !== 'deleted' && $campaign->end < Carbon\Carbon::now())
                                                <span class="badge badge-pill badge-primary">
                                      Expired
                                            @else
                                                        <span class="{{ $creative->status->class }}">
                                      {{ $creative->status->name }}
                                  </span>
                                            @endif

                                        </td>
                                        <td @if ($isadmin)
                                            contenteditable class="column_name" data-column_name="link" data-id="{{$creative->id}}" @endif >{{$creative->link}}</td>
                                        <td @if ($isadmin) contenteditable class="column_name" data-column_name="impressions" data-id="{{$creative->id}}" @endif>{{$creative->impressions}}</td>
                                        <td @if ($isadmin) contenteditable class="column_name" data-column_name="clicks" data-id="{{$creative->id}}" @endif>{{$creative->clicks}}</td>
                                        @if ($creative->impressions > 0 && $creative->clicks >= 0)
                                            <td><?= round(($creative->clicks / $creative->impressions) * 100, 2) ?> %</td>
                                        @else

                                            <td>N/A</td>
                                        @endif
                                        <td @if ($isadmin) contenteditable class="column_name" data-column_name="spend" data-id="{{$creative->id}}" @endif>{{$creative->spend}}</td>

                                        <td>
                                            <div class="row no-gutters">
                                                <div class="col-md-4 no-gutters">
                                                    <form action="{{ route('creatives.edit_status', [$creative->id,'stopped']) }}" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <button class="btn-xs btn-warning">
                                                            <svg class="c-icon">
                                                                <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-media-stop"></use>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="col-md-4 no-gutters">
                                                    <form action="{{ route('creatives.edit_status', [$creative->id,'ongoing']) }}" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <button class="btn-xs btn-success">
                                                            <svg class="c-icon">
                                                                <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-media-play"></use>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="col-md-4 no-gutters">
                                                    <form action="{{ route('creatives.edit_status', [$creative->id,'deleted']) }}" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <button class="btn-xs btn-danger">
                                                            <svg class="c-icon">
                                                                <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-trash"></use>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ csrf_field() }}
                        </div>
                    </div>
                </div>


            </div>
            <a href="{{ route('campaigns.index') }}" class="btn  btn-primary">{{ __('Return') }}</a>

        </div>
    </div>

@endsection


@section('javascript')

    <script>

        $(document).ready(function () {
            const _token = $('input[name="_token"]').val();
            $('.column_name').on('keypress', function (e) {
                if (e.which === 13)
                {
                    $(this).trigger('blur');
                }
            });
            $(document).on('blur', '.column_name', function () {
                const column_name = $(this).data('column_name');
                const column_value = $(this).text();
                const id = $(this).data('id');

                if (column_value !== '')
                {
                    $.ajax({
                        url: "{{ route('creatives.live_update') }}",
                        method: 'POST',
                        data: {column_name: column_name, column_value: column_value, id: id, _token: _token},
                        success: function (data) {
                            console.log(data);
                            $('#message').html(data).delay(3000).slideUp(200, function () {
                                $(this).alert('close');
                                location.reload();
                            });
                        }
                    });
                }
                else
                {
                    $('#message').html('<div class=\'alert alert-danger\'>Enter some value</div>').delay(8000).slideUp(200, function () {
                        $(this).alert('close');
                        location.reload();
                    });
                }
            });

        });
    </script>

@endsection

