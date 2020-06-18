@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> {{ __('Edit') }}: {{ $campaign->name }}</div>
                        <div class="card-body  mx-3">
                            <form method="POST" action="/campaigns/{{ $campaign->id }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label>Campaign Name</label>
                                    <input class="form-control" type="text" placeholder="{{ __('Name') }}" value="{{$campaign->name}}" name="name" required autofocus>
                                </div>

                                <div class="form-group row">
                                    <label>Campaign Category</label>
                                    <select class="form-control" name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @if($category->id == $campaign->category->id) selected="selected" @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6" style="padding-left:0 !important">
                                        <label>Start Date</label>
                                        <input class="form-control" type="date" placeholder="{{ __('Start Date') }}" value="{{ date('yy-m-d', strtotime($campaign->start)) }}" name="start" required>
                                    </div>

                                    <div class="col-md-6" style="padding-left:0 !important">
                                        <label>End Date</label>
                                        <input class="form-control" type="date" placeholder="{{ __('End Date') }}" value="{{ date('yy-m-d', strtotime($campaign->end)) }}" name="end" required>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label>Day Parting</label>
                                    <select class="form-control" name="day_parting" required>
                                        <option value="" @if($campaign->day_parting == "") selected="selected" @endif>Select Day Part</option>
                                        <option value="All Day" @if($campaign->day_parting == "All Day") selected="selected" @endif>All Day</option>
                                        <option value="day" @if($campaign->day_parting == "day") selected="selected" @endif>During the day</option>
                                        <option value="morning" @if($campaign->day_parting == "morning") selected="selected" @endif>Morning</option>
                                        <option value="afternoon" @if($campaign->day_parting == "afternoon") selected="selected" @endif>Afternoon</option>
                                    </select>
                                </div>

                                <div class="form-group row">
                                    <label>Geo Targeting</label>
                                    <select class="form-control" name="geo_targeting" required>
                                        <option value="" @if($campaign->geo_targeting == "") selected="selected" @endif>Select Region</option>
                                        <option value="all" @if($campaign->geo_targeting == "all") selected="selected" @endif>All Regions</option>
                                        <option value='Northern Cape' @if($campaign->geo_targeting == "USA") selected="selected" @endif>USA</option>
                                        <option value='Northern Cape' @if($campaign->geo_targeting == "UK") selected="selected" @endif>UK</option>
                                         <option value='Northern Cape' @if($campaign->geo_targeting == "South Africa") selected="selected" @endif>South Africa</option>                                   <option value='USA'>USA</option>
                                    </select>
                                </div>

                                <div class="form-group row">
                                    <label>Devices</label>
                                    <select class="form-control" name="devices" required>
                                        <option value="" @if($campaign->devices == "") selected="selected" @endif>Select Device Types</option>
                                        <option value="all" @if($campaign->devices == "all") selected="selected" @endif>All Devices</option>
                                        <option value="ios" @if($campaign->devices == "ios") selected="selected" @endif>iOS devices</option>
                                        <option value="android" @if($campaign->devices == "android") selected="selected" @endif>Android Devices</option>
                                    </select>
                                </div>

                                <div class="form-group row">
                                    <label>Traffic Source</label>
                                    <select class="form-control" name="traffic_source" required>
                                        <option value="" @if($campaign->traffic_source == "") selected="selected" @endif>Select Source</option>
                                        <option value="applications" @if($campaign->traffic_source == "applications") selected="selected" @endif>Applications</option>
                                        <option value='mobile websites' @if($campaign->traffic_source == "mobile websites") selected="selected" @endif>Mobile websites</option>
                                    </select>
                                </div>

                                <div class="form-group row">
                                    <label>Ad Format</label>
                                    <div class="col-md-12">

                                        @foreach($formats as $ad_format)
                                            @if ($campaign->ad_format_id == $ad_format->id)


                                                <div class="row mb-2" style="border-bottom: 1px solid #dedede;">
                                                    <div class="col-md-6 my-2">
                                                        <input class="form-check-input ad_format" id="{{$ad_format->id }}" data-bid="{{$ad_format->min_bid }}" type="radio" value="{{ $ad_format->id }}" name="ad_format_id" @if ($campaign->ad_format_id == $ad_format->id)
                                                        checked
                                                               @endif disabled>
                                                        <label class="form-check-label" for="{{$ad_format->id }}">{{$ad_format->name }} <br><small>{{$ad_format->description}}</small></label>
                                                    </div>
                                                    @if ($ad_format->thumb_path)

                                                        <div class="col-md-3 my-2">
                                                            <img src="/assets/img/adformats/thumbs/{{$ad_format->thumb_path}}" width="64px">
                                                        </div>

                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label>Daily budget</label>
                                    <input class="form-control" value="{{$campaign->daily_budget}}" type="number" placeholder="{{ __('Daily budget') }}" name="daily_budget" required>
                                </div>

                                <div class="form-group row">
                                    <label>CPC Bid</label>
                                    <input class="form-control current_bid" value="{{$campaign->current_bid}}" type="number" placeholder="{{ __('CPC Bid') }}" name="current_bid" required>
                                </div>
                                <div class="row mb-5">
                                    Min Bid: $ <span id="min_bid">{{$campaign->adformat->min_bid}}</span>

                                </div>


                                <button class="btn btn-block btn-success" type="submit">{{ __('Save') }}</button>
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

@endsection
