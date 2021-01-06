<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Priority;
use App\Project;
use App\Status;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get id project
        $idProject = session('findIdProjects');

        $count_total_project = Project::all()->count();
        $count_total_tiket = Ticket::all()->count();
        $Projects = Project::all();
        $Users = User::where('role_id', '2')->get();
        $Statuses = Status::all();
        $Priorities = Priority::all();
        return view('ticket.create', compact('idProject', 'Projects', 'Users', 'Statuses', 'Priorities', 'count_total_project', 'count_total_tiket'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // get id project
        $idProject = session('findIdProjects');

        $request->validate([
            'user_id' => 'required',
            'project_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'author_name' => 'required',
            'author_email' => 'required',
            'assigned_to_user' => 'required',
            'status_id' => 'required',
            'priority_id' => 'required',
        ]);
        Ticket::create([
            'user_id' => $request->user_id,
            'project_id' => $request->project_id,
            'title' => $request->title,
            'content' => $request->content,
            'author_name' => $request->author_name,
            'author_email' => $request->author_email,
            'assigned_to_user' => $request->assigned_to_user,
            'status_id' => $request->status_id,
            'priority_id' => $request->priority_id,
        ]);
        return redirect('/project/' . $idProject . '/ticket')->with('status', 'Data ' . $request->title . ' Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get id project
        $idProject = session('findIdProjects');

        $count_total_project = Project::all()->count();
        $count_total_tiket = Ticket::all()->count();
        $Tickets = Ticket::find($id);
        $Comments = Comment::where('ticket_id', $id);
        return view('ticket.show', compact('idProject', 'Tickets', 'Comments', 'count_total_project', 'count_total_tiket', 'count_total_project', 'count_total_tiket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get id project
        $idProject = session('findIdProjects');

        $count_total_project = Project::all()->count();
        $count_total_tiket = Ticket::all()->count();
        $count_total_project = Project::all()->count();
        $count_total_tiket = Ticket::all()->count();
        $Tickets = Ticket::find($id);
        $Projects = Project::all();
        $Users = User::all();
        $Statuses = Status::all();
        $Priorities = Priority::all();
        return view('ticket.edit', compact('idProject', 'Tickets', 'Projects', 'Users', 'Statuses', 'Priorities', 'count_total_project', 'count_total_tiket'));
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
            'title' => 'required',
            'user_id' => 'required',
            'project_id' => 'required',
            'content' => 'required',
            'author_name' => 'required',
            'author_email' => 'required',
            'assigned_to_user' => 'required',
            'status_id' => 'required',
            'priority_id' => 'required',
        ]);

        $Tickets = Ticket::find($id);
        $Tickets->user_id = auth()->user()->id;
        $Tickets->project_id = $request->project_id;
        $Tickets->title = $request->title;
        $Tickets->content = $request->content;
        $Tickets->author_name = auth()->user()->name;
        $Tickets->author_email = auth()->user()->email;
        $Tickets->assigned_to_user = $request->assigned_to_user;
        $Tickets->status_id = $request->status_id;
        $Tickets->priority_id = $request->priority_id;
        $Tickets->update();
        return redirect('/project/' . $idProject . '/ticket')->with('status', 'Data ' . $request->title . ' Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get id project
        $idProject = session('findIdProjects');

        $id = session('findIdProjects');
        $Tickets = Ticket::find($id);
        $Tickets->delete();
        return redirect('/project/' . $idProject . '/ticket')->with('statusDelete', 'Data Berhasil Dihapus!');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('storage/photos/upload/ckeditor_image'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/photos/upload/ckeditor_image/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    public function filter_status_open()
    {
        if (Auth::user()->role_id == "1") {
            // get id project
            $idProject = session('findIdProjects');

            $count_total_project = Project::all()->count();
            $count_total_tiket = Ticket::all()->count();
            $count_open_ticket = Ticket::where('status_id', '1')->where('project_id', $idProject)->count();
            $count_closed_ticket = Ticket::where('status_id', '2')->where('project_id', $idProject)->count();
            $Tickets = Ticket::where('status_id', '1')->where('project_id', $idProject)->get();
            $Projects = Project::find($idProject);
        } else {
            // get id project
            $idProject = session('findIdProjects');

            $count_total_project = Project::all()->count();
            $count_total_tiket = Ticket::all()->count();
            $count_open_ticket = Ticket::where('status_id', '1')->where('assigned_to_user', Auth::user()->id)->count();
            $count_closed_ticket = Ticket::where('status_id', '2')->where('assigned_to_user', Auth::user()->id)->count();
            $Tickets = Ticket::where('assigned_to_user', Auth::user()->id)->where('status_id', '1')->get();
            $Projects = Project::find($idProject);
        }
        return view('admin.project.show', compact('Tickets', 'Projects', 'idProject', 'count_open_ticket', 'count_closed_ticket', 'count_total_project', 'count_total_tiket'));
    }

    public function filter_status_closed()
    {
        if (Auth::user()->role_id == "1") {
            // get id project
            $idProject = session('findIdProjects');

            $count_total_project = Project::all()->count();
            $count_total_tiket = Ticket::all()->count();
            $count_open_ticket = Ticket::where('status_id', '1')->where('project_id', $idProject)->count();
            $count_closed_ticket = Ticket::where('status_id', '2')->where('project_id', $idProject)->count();
            $Tickets = Ticket::where('status_id', '2')->where('project_id', $idProject)->get();
            $Projects = Project::find($idProject);
        } else {
            // get id project
            $idProject = session('findIdProjects');

            $count_total_project = Project::all()->count();
            $count_total_tiket = Ticket::all()->count();
            $count_open_ticket = Ticket::where('status_id', '1')->where('assigned_to_user', Auth::user()->id)->count();
            $count_closed_ticket = Ticket::where('status_id', '2')->where('assigned_to_user', Auth::user()->id)->count();
            $Tickets = Ticket::where('assigned_to_user', Auth::user()->id)->where('status_id', '2')->get();
            $Projects = Project::find($idProject);
        }
        return view('admin.project.show', compact('Tickets', 'Projects', 'idProject', 'count_open_ticket', 'count_closed_ticket', 'count_total_project', 'count_total_tiket'));
    }
}
