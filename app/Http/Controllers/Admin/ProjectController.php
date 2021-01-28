<?php

namespace App\Http\Controllers\admin;

use App\Ticket;
use App\Project;
use App\CategoryProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProjectAssigned;
use App\StatusArticle;
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
        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();
        $projects = Project::all();
        $currentProjects = User::find(Auth::user()->id);
        return view('admin.project.index', compact('currentProjects', 'projects', 'countTotalProject', 'countTotalTicket'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();
        $categoryProjects = CategoryProject::all();
        $users = User::all();
        $statusArticles = StatusArticle::all();
        return view('admin.project.create', compact('categoryProjects', 'users', 'statusArticles', 'countTotalProject', 'countTotalTicket'));
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
            'status_article_id' => 'required',
        ]);

        $project = new Project;
        $project->name = $request->name;
        $project->category_id = $request->category_id;
        $project->status_article_id = $request->status_article_id;
        $project->save();

        $assigned = $request->assigned_to_user;
        foreach ($assigned as $assign) {
            $this->insertData($project->id, $assign);
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
        $projects = Project::find($id);
        $idProject = $id;
        session(['findIdProjects' => $id]);

        if (Auth::user()->role_id == "1") {
            $countTotalProject = Project::all()->count();
            $countTotalTicket = Ticket::all()->count();
            $tickets = Ticket::where('project_id', $id)->where('role_id', 1)->orWhere('project_id', $id)->where('role_id', 2)->get();
            $countOpenTicket = Ticket::where('project_id', $id)->where('status_id', '1')->count();
            $countClosedTicket = Ticket::where('project_id', $id)->where('status_id', '2')->count();
        } else {
            $countTotalProject = Project::all()->count();
            $countTotalTicket = Ticket::all()->count();
            $tickets = Ticket::where('project_id', $id)->where('role_id', 1)->orWhere('project_id', $id)->where('role_id', 2)->get();
            $countOpenTicket = Ticket::where('project_id', $id)->where('status_id', '1')->count();
            $countClosedTicket = Ticket::where('project_id', $id)->where('status_id', '2')->count();
        }
        return view('admin.project.show', compact('projects', 'idProject', 'tickets', 'countOpenTicket', 'countClosedTicket', 'countTotalProject', 'countTotalTicket'));
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
        $projects = Project::find($id);
        $categoryProjects = CategoryProject::all();
        $users = User::all();
        $statusArticles = StatusArticle::all();
        return view('admin.project.edit', compact('projects', 'categoryProjects', 'users', 'statusArticles', 'countTotalProject', 'countTotalTicket'));
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
            'status_article_id' => 'required',
        ]);

        $projects = Project::find($id);
        $projects->name = $request->name;
        $projects->category_id = $request->category_id;
        $projects->status_article_id = $request->status_article_id;
        $projects->update();

        $curentProject = ProjectAssigned::where('project_id', $id)->get();
        foreach ($curentProject as $item) {
            $item->delete();
        }

        $assigned = $request->assigned_to_user;
        foreach ($assigned as $assign) {
            $this->insertData($projects->id, $assign);
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
        $curentProject = ProjectAssigned::where('project_id', $id)->get();
        foreach ($curentProject as $item) {
            $item->delete();
        }

        $curentTicket = Ticket::where('project_id', $id)->get();
        foreach ($curentTicket as $item) {
            $item->delete();
        }

        $projects = Project::find($id);
        $projects->delete();
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
