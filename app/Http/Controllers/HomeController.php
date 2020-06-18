<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Creative;
use App\Models\Status;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $creatives = Creative::all();
        $users = Users::all();
        $statuses = Status::all();
        $user = auth()->user();

        if (strpos(Auth::user()->menuroles, 'admin')) {
            $campaigns = Campaign::withTrashed()->get();
            $active_campaigns = Campaign::all();
            $creatives = Creative::all();
            $users = Users::all();
            $statuses = Status::all();

            return view('dashboard.homepage', [
                'campaigns' => $campaigns,
                'active_campaigns' => $active_campaigns,
                'creatives' => $creatives,
                'statuses' => $statuses,
                'users' => $users,
            ]);

        } else {
            $campaigns = Campaign::withTrashed()->with('user')->with('status')->where('user_id', '=', $user->getAuthIdentifier())->get();
            $active_campaigns = Campaign::with('user')->with('status')->where('user_id', '=', $user->getAuthIdentifier())->get();
            $creatives = Creative::join('campaigns', 'campaigns.id', '=', 'creatives.campaign_id')
                ->where('campaigns.user_id', $user->getAuthIdentifier())
                ->get();
            return view('dashboard.homepage', [
                'campaigns' => $campaigns->count(),
                'active_campaigns' => $active_campaigns->count(),
                'creatives' => $creatives->count()
            ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
