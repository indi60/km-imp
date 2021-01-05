<?php

namespace App\Http\Controllers\admin;

use App\Ticket;
use App\Project;
use App\CategoryProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProjectAssigned;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role_id == "1") {
            $count_total_project = Project::all()->count();
            $count_total_tiket = Ticket::all()->count();
            $Projects = Project::all();
        } else {
            $count_total_project = Project::all()->count();
            $count_total_tiket = Ticket::all()->count();
            $Projects = Project::all();
        }
        return view('admin.project.index', compact('Projects', 'count_total_project', 'count_total_tiket'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $count_total_project = Project::all()->count();
        $count_total_tiket = Ticket::all()->count();
        $CategoryProjects = CategoryProject::all();
        $Users = User::all();
        return view('admin.project.create', compact('CategoryProjects', 'Users', 'count_total_project', 'count_total_tiket'));
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
            'name' => 'required',
            'category_id' => 'required',
            'assigned_to_user' => 'required',
        ]);

        $Project = new Project;
        $Project->name = $request->name;
        $Project->category_id = $request->category_id;
        $Project->save();

        $Assigned = $request->assigned_to_user;
        foreach ($Assigned as $Assign) {
            $this->insertData($Project->id, $Assign);
        }

        return redirect('/project')->with('status', 'Data ' . $request->name . ' Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $Projects = Project::find($id);
        $idProject = $id;
        session(['findIdProjects' => $id]);

        if (Auth::user()->role_id == "1") {
            $count_total_project = Project::all()->count();
            $count_total_tiket = Ticket::all()->count();
            $Tickets = Ticket::where('project_id', $id)->get();
            $count_open_ticket = Ticket::where('project_id', $id)->where('status_id', '1')->count();
            $count_closed_ticket = Ticket::where('project_id', $id)->where('status_id', '2')->count();
        } else {
            $count_total_project = Project::all()->count();
            $count_total_tiket = Ticket::all()->count();
            $Tickets = Ticket::where('project_id', $id)->get();
            $count_open_ticket = Ticket::where('project_id', $id)->where('status_id', '1')->count();
            $count_closed_ticket = Ticket::where('project_id', $id)->where('status_id', '2')->count();
        }
        return view('admin.project.show', compact('Projects', 'idProject', 'Tickets', 'count_open_ticket', 'count_closed_ticket', 'count_total_project', 'count_total_tiket'));
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
        $Projects = Project::find($id);
        $CategoryProjects = CategoryProject::all();
        $Users = User::all();
        return view('admin.project.edit', compact('Projects', 'CategoryProjects', 'Users', 'count_total_project', 'count_total_tiket'));
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
            'name' => 'required',
            'category_id' => 'required',
            'assigned_to_user' => 'required',
        ]);

        $Projects = Project::find($id);
        $Projects->name = $request->name;
        $Projects->category_id = $request->category_id;

        $CurentProject = ProjectAssigned::where('project_id', $id)->get();
        foreach ($CurentProject as $item) {
            $item->delete();
        }

        $Assigned = $request->assigned_to_user;
        foreach ($Assigned as $Assign) {
            $this->insertData($Projects->id, $Assign);
        }

        return redirect('/project')->with('status', 'Data ' . $request->name . ' Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Projects = Project::find($id);
        $Projects->delete();
        return redirect('/project')->with('statusDelete', 'Data Berhasil Dihapus!');
    }

    private function insertData($project_id, $assigned_to_user)
    {
        ProjectAssigned::create([
            'project_id' => $project_id,
            'assigned_to_user' => $assigned_to_user,
        ]);
    }
}
