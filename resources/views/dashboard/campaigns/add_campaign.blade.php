@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-8 col-md-offset-2">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> {{ __('Create Campaign') }}
                        </div>
                        <div class="card-body mx-2">
                            <form method="POST" action="{{ route('campaigns.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label>Campaign Name</label>
                                    <input class="form-control" type="text" placeholder="{{ __('Name') }}" name="name" required autofocus>
                                </div>

                                <div class="form-group row">
                                    <label>Campaign Category</label>
                                    <select class="form-control" name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group row">
                                    <label>Custom Category <small> (Optional)</small></label>
                                    <input class="form-control" type="text" placeholder="{{ __('Custom Category') }}" name="custom_category">
                                </div>


                                <div class="form-group row">
                                    <div class="col-md-6" style="padding-left:0 !important">
                                        <label>Start Date</label>
                                        <input class="form-control" type="date" placeholder="{{ __('Start Date') }}" name="start">
                                    </div>

                                    <div class="col-md-6"  style="padding-left:0 !important">
                                        <label>End Date</label>
                                        <input class="form-control" type="date" placeholder="{{ __('End Date') }}" name="end">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label>Day Parting</label>
                                    <select class="form-control" name="day_parting" required>
                                        <option value="">Select Day Part</option>
                                        <option value="All Day">All Day</option>
                                        <option value="day">During the day</option>
                                        <option value="morning">Morning</option>
                                        <option value="afternoon">Afternoon</option>

                                    </select>
                                </div>

                                <div class="form-group row">
                                    <label>Geo Targeting</label>
                                    <select class="form-control" name="geo_targeting" required>
                                        <option value="">Select Region</option>
                                        <option value="all">All Regions</option>
                                        <option value='USA'>USA</option>
                                        <option value='UK'>UK</option>
                                        <option value='South Africa'>South Africa</option>
                                    </select>
                                </div>

                                <div class="form-group row">
                                    <label>Devices</label>
                                    <select class="form-control" name="devices" required>
                                        <option value="">Select Device Types</option>
                                        <option value="all">All Devices</option>
                                        <option value="ios">iOS devices</option>
                                        <option value="android">Android Devices</option>
                                    </select>
                                </div>

                                <div class="form-group row">
                                    <label>Traffic Source</label>
                                    <select class="form-control" name="traffic_source" required>
                                        <option value="">Select Source</option>
                                        <option value="applications">Applications</option>
                                        <option value='mobile websites'>Mobile websites</option>
                                    </select>
                                </div>

                                <div class="form-group row">
                                    <label>Ad Format</label>
                                    <div class="col-md-12">

                                        @foreach($ad_formats as $ad_format)
                                            <div class="row mb-2" style="border-bottom: 1px solid #dedede;">
                                                <div class="col-md-6 my-2">
                                                    <input class="form-check-input ad_format" id="{{$ad_format->id }}" data-bid="{{$ad_format->min_bid }}" type="radio" value="{{ $ad_format->id }}" name="ad_format_id">
                                                    <label class="form-check-label" for="{{$ad_format->id }}">{{$ad_format->name }} <br><small>{{$ad_format->description}}</small></label>
                                                </div>
                                                @if ($ad_format->thumb_path)

                                                    <div class="col-md-3 my-2">
                                                        <img src="/assets/img/adformats/thumbs/{{$ad_format->thumb_path}}" width="64px">
                                                    </div>

                                                @endif
                                            </div>
                                        @endforeach
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label>Daily budget</label>
                                    <input class="form-control" type="text" placeholder="{{ __('Daily budget') }}" name="daily_budget" required>
                                </div>

                                <div class="form-group row">
                                    <label>CPC Bid</label>
                                    <input class="form-control current_bid" type="text" placeholder="{{ __('CPC Bid') }}" name="current_bid" required>
                                </div>
                                <div class="row mb-5">
                                    Min Bid: $ <span id="min_bid"></span>

                                </div>


                                <button class="btn btn-block btn-success" type="submit">{{ __('Save and add creatives') }}</button>
                                <a href="{{ route('campaigns.index') }}" class="btn btn-block btn-primary">{{ __('Return') }}</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            $('.ad_format').click(function () {
                if ($(this).is(':checked'))
                {
                    $('#min_bid').text($(this).data('bid'));
                }
            });
        });
    </script>

@endsection
