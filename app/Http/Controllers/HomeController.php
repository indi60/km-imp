<?php

namespace App\Http\Controllers;

use App\Article;
use App\Description;
use App\Project;
use App\Ticket;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::user()->role_id == 1) {
            $countTotalProject = Project::all()->count();
            $countTotalTicket = Ticket::all()->count();
            $count_total_admin = User::where('role_id', '1')->count();
            $count_total_member = User::where('role_id', '2')->count();
            $count_total_guest = User::where('role_id', '3')->count();
            return view('home', compact('countTotalProject', 'countTotalTicket', 'count_total_admin', 'count_total_member', 'count_total_guest'));
        } else if (Auth::user()->role_id == 2) {
            $countTotalProject = Project::all()->count();
            $countTotalTicket = Ticket::all()->count();
            $currentProjects = User::find(Auth::user()->id);
            $projects = Project::all();
            return view('admin.project.index', compact('currentProjects', 'projects', 'countTotalProject', 'countTotalTicket'));
        } else {
            $countTotalProject = Project::all()->count();
            $countTotalTicket = Ticket::all()->count();
            $tickets = Ticket::where('user_id',Auth::user()->id)->get();
            return view('ticket.index', compact('tickets','countTotalProject', 'countTotalTicket'));
        }
    }
}
