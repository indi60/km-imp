<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Priority;
use App\Project;
use App\Status;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count_total_project = Project::all()->count();
        $count_total_tiket = Ticket::all()->count();
        $Tickets = Ticket::where('role_id', '3')->get();
        return view('admin.issue.index', compact('Tickets','count_total_project', 'count_total_tiket'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $count_total_project = Project::all()->count();
        $count_total_tiket = Ticket::all()->count();
        $Tickets = Ticket::find($id);
        $Projects = Project::all();
        $Users = User::all();
        $Statuses = Status::all();
        $Priorities = Priority::all();
        return view('admin.issue.edit', compact('Tickets', 'Projects', 'Users', 'Statuses', 'Priorities', 'count_total_project', 'count_total_tiket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // get id project
        $idProject = session('findIdProjects');

        $request->validate([
            'project_id' => 'required',
            'assigned_to_user' => 'required',
            'priority_id' => 'required',
        ]);

        $Tickets = Ticket::find($id);
        $Tickets->role_id = 2;
        $Tickets->project_id = $request->project_id;
        $Tickets->assigned_to_user = $request->assigned_to_user;
        $Tickets->priority_id = $request->priority_id;
        $Tickets->update();
        return redirect('/issue')->with('status', 'Data ' . $request->title . ' Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
