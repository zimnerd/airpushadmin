<?php

namespace App\Http\Controllers;

use App\Models\AdFormat;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Status;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();
        if (strpos($user->menuroles, 'admin'))
        {
            $campaigns = Campaign::withTrashed()->with('user')->with('status')->paginate(10);

            return view('dashboard.campaigns.admin_list', ['campaigns' => $campaigns]);
        }
        else
        {
            $campaigns = Campaign::with('user')->with('status')->where('user_id', '=', $user->getAuthIdentifier())->paginate(10);

        }

        return view('dashboard.campaigns.list_campaigns', ['campaigns' => $campaigns]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        $users = Users::all();
        $statuses = Status::all();
        $formats = AdFormat::all();
        $categories = Category::all();
        $user = auth()->user();
        $isadmin = strpos($user->menuroles, 'admin');
        $selected = Status::where('name', 'pending')
            ->first()->id;

        return view('dashboard.campaigns.add_campaign',
            [
                'categories' => $categories,
                'statuses' => $statuses,
                'ad_formats' => $formats,
                'user' => $user,
                'isadmin' => $isadmin,
                'users' => $users,
                'selected' => $selected,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'start' => 'required|date_format:Y-m-d',
            'end' => 'required|date_format:Y-m-d',
            'name' => 'required|min:1|max:64',
            'geo_targeting' => 'required',
            'day_parting' => 'required',
            'devices' => 'required',
            'ad_format_id' => 'required',
            'traffic_source' => 'required',
            'daily_budget' => 'required',
            'current_bid' => 'required',

        ]);
        $pendingStatus = Status::where('name', 'pending')
        ->first()->id;
        $user = auth()->user();
        $campaign = new Campaign();
        $campaign->start = $request->input('start');
        $campaign->end = $request->input('end');
        $campaign->name = $request->input('name');
        $campaign->geo_targeting = $request->input('geo_targeting');
        $campaign->day_parting = $request->input('day_parting');
        $campaign->devices = $request->input('devices');
        $campaign->ad_format_id = $request->input('ad_format_id');
        $campaign->status_id = $pendingStatus;
        $campaign->category_id = $request->input('category_id');
        $campaign->custom_category = $request->input('custom_category');
        $campaign->traffic_source = $request->input('traffic_source');
        $campaign->daily_budget = $request->input('daily_budget');
        $campaign->current_bid = $request->input('current_bid');
        $campaign->user_id = $user->id;
        $campaign->save();

        return redirect('/creatives/create?id=' . $campaign->id)->with('success', 'Successfully created a campaign, add creative now');
        //return redirect()->route('campaigns.index')->with('success', 'Successfully created campaign');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $users = Users::all();
        $user = auth()->user();
        $isadmin = strpos($user->menuroles, 'admin');
        $campaign = Campaign::withTrashed()->with('user')->with('status')->find($id);

        return view('dashboard.campaigns.view_campaign', [
            'campaign' => $campaign,
            'isadmin' => $isadmin,
            'users' => $users
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $campaign = Campaign::withTrashed()->find($id);
        $statuses = Status::all();
        $formats = AdFormat::all();
        $categories = Category::all();

        return view('dashboard.campaigns.edit_campaign', ['statuses' => $statuses, 'categories' => $categories, 'formats' => $formats, 'campaign' => $campaign]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //var_dump('bazinga');
        //die();
        $validatedData = $request->validate([
            'start' => 'required|date_format:Y-m-d',
            'end' => 'required|date_format:Y-m-d',
            'name' => 'required|min:1|max:64',
            'geo_targeting' => 'required',
            'day_parting' => 'required',
            'devices' => 'required',
            'traffic_source' => 'required',
            'daily_budget' => 'required',
            'current_bid' => 'required',
        ]);
        $pendingStatus = Status::where('name', 'pending')
            ->first()->id;
        $campaign = Campaign::withTrashed()->find($id);
        $campaign->start = $request->input('start');
        $campaign->end = $request->input('end');
        $campaign->name = $request->input('name');
        $campaign->geo_targeting = $request->input('geo_targeting');
        $campaign->day_parting = $request->input('day_parting');
        $campaign->devices = $request->input('devices');
        $campaign->deleted_at = NULL;
        $campaign->category_id = $request->input('category_id');
        $campaign->traffic_source = $request->input('traffic_source');
        $campaign->daily_budget = $request->input('daily_budget');
        $campaign->current_bid = $request->input('current_bid');
        $campaign->save();
        $request->session()->flash('message', 'Successfully edited campaign');

        return redirect()->route('campaigns.index')->with('success', 'Successfully edited campaign');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit_status($id, $status)
    {
        $campaign = Campaign::withTrashed()->find($id);
        if ($campaign)
        {
            $data = [
                'status_id' => Status::where('name', $status)->first()->id,
                'updated_at' => Carbon::now(),
                'deleted_at' => NULL
            ];
            DB::table('campaigns')
                ->where('id', $id)
                ->update($data);
        }

        return redirect()->route('campaigns.index')->with('success', 'Successfully edited campaign');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $campaign = Campaign::withTrashed()->find($id);
        if ($campaign)
        {
            $data = [
                'status_id' => Status::where('name', 'deleted')->first()->id,
                'updated_at' => Carbon::now()
            ];
            DB::table('campaigns')
                ->where('id', $id)
                ->update($data);
            $campaign->delete();
        }

        return redirect()->route('campaigns.index');
    }

    public function download($path)
    {
        return Storage::download($path);
    }
}
