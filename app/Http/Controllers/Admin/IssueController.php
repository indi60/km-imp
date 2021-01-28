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
        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();
        $tickets = Ticket::where('role_id', null)->get();
        return view('admin.issue.index', compact('tickets', 'countTotalProject', 'countTotalTicket'));
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
        $request->validate([
            'project_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'author_name' => 'required',
            'author_email' => 'required',
        ]);
        Ticket::create([
            'project_id' => $request->project_id,
            'title' => $request->title,
            'content' => $request->content,
            'author_name' => $request->author_name,
            'author_email' => $request->author_email,
        ]);
        return redirect('/');
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
        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();
        $tickets = Ticket::find($id);
        $projects = Project::all();
        $users = User::all();
        $statuses = Status::all();
        $priorities = Priority::all();
        return view('admin.issue.edit', compact('tickets', 'projects', 'users', 'statuses', 'priorities', 'countTotalProject', 'countTotalTicket'));
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
        $request->validate([
            'assigned_to_user' => 'required',
            'priority_id' => 'required',
        ]);

        $tickets = Ticket::find($id);
        $tickets->status_id = 1;
        $tickets->role_id = 2;
        $tickets->assigned_to_user = $request->assigned_to_user;
        $tickets->priority_id = $request->priority_id;
        $tickets->update();
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
        $tickets = Ticket::find($id);
        $tickets->delete();
        return redirect('/issue')->with('statusDelete', 'Data Berhasil Dihapus!');
    }
}
