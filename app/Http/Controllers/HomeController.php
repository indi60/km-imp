<?php

namespace App\Http\Controllers;

use App\Project;
use App\ProjectAssigned;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
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
            $count_total_project = Project::all()->count();
            $count_total_tiket = Ticket::all()->count();
            $count_total_admin = User::where('role_id', '1')->count();
            $count_total_member = User::where('role_id', '2')->count();
            $count_total_guest = User::where('role_id', '3')->count();
            return view('home', compact('count_total_project', 'count_total_tiket', 'count_total_admin', 'count_total_member', 'count_total_guest'));
        } else if (Auth::user()->role_id == 2) {
            $count_total_project = Project::all()->count();
            $count_total_tiket = Ticket::all()->count();
            $CurrentProjects = User::find(Auth::user()->id);
            $Projects = Project::all();
            return view('admin.project.index', compact('CurrentProjects', 'Projects', 'count_total_project', 'count_total_tiket'));
        }
    }
}
