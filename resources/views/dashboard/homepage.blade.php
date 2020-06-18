@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        @if (Auth::check())
            @if (strpos(Auth::user()->menuroles, 'admin'))

                <div class="fade-in">
                    <div class="row">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="btn-group float-right">
                                        <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg class="c-icon">
                                                <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-settings"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="/campaigns">Show campaigns</a><a class="dropdown-item" href="/campaigns/create">Add new campaign</a></div>
                                    </div>
                                    <div class="text-value-lg">{{count($campaigns)}}</div>
                                    <div>Total Campaigns</div>
                                </div>
                                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                    <canvas class="chart" id="card-chart1" height="70"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-white bg-info">
                                <div class="card-body pb-0">
                                    <button class="btn btn-transparent p-0 float-right" type="button">
                                        <svg class="c-icon">
                                            <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-location-pin"></use>
                                        </svg>
                                    </button>
                                    <div class="text-value-lg">{{count($active_campaigns)}}</div>
                                    <div>Total Active Campaigns</div>
                                </div>
                                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                    <canvas class="chart" id="card-chart2" height="70"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-white bg-warning">
                                <div class="card-body pb-0">
                                    <div class="btn-group float-right">
                                        <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg class="c-icon">
                                                <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-settings"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="/campaigns">View campaigns</a><a class="dropdown-item" href="campains/create">Add new campaign</a></div>
                                    </div>
                                    <div class="text-value-lg">{{count($creatives)}}</div>
                                    <div>Creatives</div>
                                </div>
                                <div class="c-chart-wrapper mt-3" style="height:70px;">
                                    <canvas class="chart" id="card-chart3" height="70"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-white bg-danger">
                                <div class="card-body pb-0">
                                    <div class="btn-group float-right">
                                        <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg class="c-icon">
                                                <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-settings"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="/users">List users</a><a class="dropdown-item" href="users/create">Add new user</a></div>
                                    </div>
                                    <div class="text-value-lg">{{count($users)}}</div>
                                    <div>Members</div>
                                </div>
                                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                    <canvas class="chart" id="card-chart4" height="70"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-->
                    </div>
                    <!-- /.row-->
                    {{-- <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    <h4 class="card-title mb-0">Traffic</h4>
                                    <div class="small text-muted">September 2019</div>
                                </div>
                                <!-- /.col-->
                                <div class="col-sm-7 d-none d-md-block">
                                    <button class="btn btn-primary float-right" type="button">
                                        <svg class="c-icon">
                                            <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-cloud-download"></use>
                                        </svg>
                                    </button>
                                    <div class="btn-group btn-group-toggle float-right mr-3" data-toggle="buttons">
                                        <label class="btn btn-outline-secondary">
                                            <input id="option1" type="radio" name="options" autocomplete="off"> Day
                                        </label>
                                        <label class="btn btn-outline-secondary active">
                                            <input id="option2" type="radio" name="options" autocomplete="off" checked=""> Month
                                        </label>
                                        <label class="btn btn-outline-secondary">
                                            <input id="option3" type="radio" name="options" autocomplete="off"> Year
                                        </label>
                                    </div>
                                </div>
                                <!-- /.col-->
                            </div>
                            <!-- /.row-->
                            <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">
                                <canvas class="chart" id="main-chart" height="300"></canvas>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row text-center">
                                <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                    <div class="text-muted">Visits</div>
                                    <strong>29.703 Users (40%)</strong>
                                    <div class="progress progress-xs mt-2">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                    <div class="text-muted">Unique</div>
                                    <strong>24.093 Users (20%)</strong>
                                    <div class="progress progress-xs mt-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                    <div class="text-muted">Pageviews</div>
                                    <strong>78.706 Views (60%)</strong>
                                    <div class="progress progress-xs mt-2">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                    <div class="text-muted">New Users</div>
                                    <strong>22.123 Users (80%)</strong>
                                    <div class="progress progress-xs mt-2">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                    <div class="text-muted">Bounce Rate</div>
                                    <strong>40.15%</strong>
                                    <div class="progress progress-xs mt-2">
                                        <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- /.card-->

                    <!-- /.row-->
                </div>
            @else

                <div class="fade-in">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <h1 class="text-center">Welcome to Air Push</h1>
                            <h2  class="text-center">You are logged in as {{Auth::user()->name}}</h2>
                        </div>
                    </div>
                </div>
            <div class="p-5"></div>
                <div class="fade-in">
                    <div class="row">
                        <div class="col-sm-6 col-lg-4">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="btn-group float-right">
                                        <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg class="c-icon">
                                                <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-settings"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="/campaigns">Show campaigns</a><a class="dropdown-item" href="/campaigns/create">Add new campaign</a></div>
                                    </div>
                                    <div class="text-value-lg">{{$campaigns}}</div>
                                    <div>Total Campaigns</div>
                                </div>
                                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                    <canvas class="chart" id="card-chart1" height="70"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-->
                        <div class="col-sm-6 col-lg-4">
                            <div class="card text-white bg-info">
                                <div class="card-body pb-0">
                                    <button class="btn btn-transparent p-0 float-right" type="button">
                                        <svg class="c-icon">
                                            <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-location-pin"></use>
                                        </svg>
                                    </button>
                                    <div class="text-value-lg">{{$active_campaigns}}</div>
                                    <div>Total Active Campaigns</div>
                                </div>
                                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                    <canvas class="chart" id="card-chart2" height="70"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-->
                        <div class="col-sm-6 col-lg-4">
                            <div class="card text-white bg-warning">
                                <div class="card-body pb-0">
                                    <div class="btn-group float-right">
                                        <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg class="c-icon">
                                                <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-settings"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="/campaigns">View campaigns</a><a class="dropdown-item" href="campains/create">Add new campaign</a></div>
                                    </div>
                                    <div class="text-value-lg">{{$creatives}}</div>
                                    <div>Creatives</div>
                                </div>
                                <div class="c-chart-wrapper mt-3" style="height:70px;">
                                    <canvas class="chart" id="card-chart3" height="70"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-->
                    </div>
                    <!-- /.row-->
                {{-- <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <h4 class="card-title mb-0">Traffic</h4>
                                <div class="small text-muted">September 2019</div>
                            </div>
                            <!-- /.col-->
                            <div class="col-sm-7 d-none d-md-block">
                                <button class="btn btn-primary float-right" type="button">
                                    <svg class="c-icon">
                                        <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-cloud-download"></use>
                                    </svg>
                                </button>
                                <div class="btn-group btn-group-toggle float-right mr-3" data-toggle="buttons">
                                    <label class="btn btn-outline-secondary">
                                        <input id="option1" type="radio" name="options" autocomplete="off"> Day
                                    </label>
                                    <label class="btn btn-outline-secondary active">
                                        <input id="option2" type="radio" name="options" autocomplete="off" checked=""> Month
                                    </label>
                                    <label class="btn btn-outline-secondary">
                                        <input id="option3" type="radio" name="options" autocomplete="off"> Year
                                    </label>
                                </div>
                            </div>
                            <!-- /.col-->
                        </div>
                        <!-- /.row-->
                        <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">
                            <canvas class="chart" id="main-chart" height="300"></canvas>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row text-center">
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Visits</div>
                                <strong>29.703 Users (40%)</strong>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Unique</div>
                                <strong>24.093 Users (20%)</strong>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Pageviews</div>
                                <strong>78.706 Views (60%)</strong>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">New Users</div>
                                <strong>22.123 Users (80%)</strong>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md mb-sm-2 mb-0">
                                <div class="text-muted">Bounce Rate</div>
                                <strong>40.15%</strong>
                                <div class="progress progress-xs mt-2">
                                    <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- /.card-->

                    <!-- /.row-->
                </div>

            @endif
        @else
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <h1 class="text-center">Welcome to Air Push</h1>
                        <h2>Create and account or login to access the resources</h2>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection

@section('javascript')

    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection
