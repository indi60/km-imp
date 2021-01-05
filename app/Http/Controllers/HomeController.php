<?php

namespace App\Http\Controllers;

use App\Project;
use App\Ticket;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count_total_project = Project::all()->count();
        $count_total_tiket = Ticket::all()->count();
        $count_open_tiket = Ticket::where('status_id', '1')->count();
        $count_close_tiket = Ticket::where('status_id', '2')->count();
        return view('home', compact('count_total_tiket', 'count_total_project', 'count_open_tiket', 'count_close_tiket'));
    }
}
