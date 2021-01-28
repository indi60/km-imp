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
        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();
        $tickets = Ticket::where('assigned_to_user', Auth::user()->id)->get();
        $countOpenTicket = Ticket::where('assigned_to_user', Auth::user()->id)->where('status_id', '1')->count();
        $countClosedTicket = Ticket::where('assigned_to_user', Auth::user()->id)->where('status_id', '2')->count();
        return view('ticket.index', compact('tickets', 'countOpenTicket', 'countClosedTicket', 'countTotalProject', 'countTotalTicket'));
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

        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();
        $projects = Project::find($idProject);
        $statuses = Status::all();
        $priorities = Priority::all();
        return view('ticket.create', compact('idProject', 'projects', 'statuses', 'priorities', 'countTotalProject', 'countTotalTicket'));
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
            'role_id' => $request->role_id,
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

        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();
        $tickets = Ticket::find($id);
        $comments = Comment::where('ticket_id', $id);
        return view('ticket.show', compact('idProject', 'tickets', 'comments', 'countTotalProject', 'countTotalTicket', 'countTotalProject', 'countTotalTicket'));
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

        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();
        $tickets = Ticket::find($id);
        $projects = Project::find($idProject);
        $users = User::all();
        $statuses = Status::all();
        $priorities = Priority::all();
        return view('ticket.edit', compact('idProject', 'tickets', 'projects', 'users', 'statuses', 'priorities', 'countTotalProject', 'countTotalTicket'));
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

        $tickets = Ticket::find($id);
        $tickets->user_id = $request->user_id;
        $tickets->project_id = $request->project_id;
        $tickets->title = $request->title;
        $tickets->content = $request->content;
        $tickets->author_name = $request->author_name;
        $tickets->author_email = $request->author_email;
        $tickets->assigned_to_user = $request->assigned_to_user;
        $tickets->status_id = $request->status_id;
        $tickets->priority_id = $request->priority_id;
        $tickets->update();
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
        $tickets = Ticket::find($id);
        $tickets->delete();
        return redirect('/project/' . $idProject . '/ticket')->with('statusDelete', 'Data Berhasil Dihapus!');
    }

    public function closed_ticket($id)
    {
        // get id project
        $idProject = session('findIdProjects');

        $tickets = Ticket::find($id);
        $tickets->status_id = 2;
        $tickets->save();
        return redirect('/project/' . $idProject . '/ticket')->with('statusDelete', 'Issue was closed!');
    }

    public function reopen_ticket($id)
    {
        // get id project
        $idProject = session('findIdProjects');

        $tickets = Ticket::find($id);
        $tickets->status_id = 1;
        $tickets->save();
        return redirect('/project/' . $idProject . '/ticket')->with('status', 'Issue was open!');
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
        $countTotalTicket = Ticket::all()->count();
        $countTotalProject = Project::all()->count();

        // get id project
        $idProject = session('findIdProjects');

        $countOpenTicket = Ticket::where('status_id', '1')->where('project_id', $idProject)->count();
        $countClosedTicket = Ticket::where('status_id', '2')->where('project_id', $idProject)->count();
        $tickets = Ticket::where('status_id', '1')->where('project_id', $idProject)->get();
        $projects = Project::find($idProject);

        return view('admin.project.show', compact('tickets', 'projects', 'idProject', 'countOpenTicket', 'countClosedTicket', 'countTotalProject', 'countTotalTicket'));
    }

    public function filter_status_closed()
    {
        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();

        // get id project
        $idProject = session('findIdProjects');

        $countOpenTicket = Ticket::where('status_id', '1')->where('project_id', $idProject)->count();
        $countClosedTicket = Ticket::where('status_id', '2')->where('project_id', $idProject)->count();
        $tickets = Ticket::where('status_id', '2')->where('project_id', $idProject)->get();
        $projects = Project::find($idProject);
        return view('admin.project.show', compact('tickets', 'projects', 'idProject', 'countOpenTicket', 'countClosedTicket', 'countTotalProject', 'countTotalTicket'));
    }

    public function filter_status_open_all()
    {
        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();

        $tickets = Ticket::where('status_id', '1')->where('assigned_to_user', Auth::user()->id)->get();

        $countOpenTicket = Ticket::where('status_id', '1')->where('assigned_to_user', Auth::user()->id)->count();
        $countClosedTicket = Ticket::where('status_id', '2')->where('assigned_to_user', Auth::user()->id)->count();
        return view('ticket.index', compact('tickets', 'countOpenTicket', 'countClosedTicket', 'countTotalProject', 'countTotalTicket'));
    }

    public function filter_status_closed_all()
    {
        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();

        $tickets = Ticket::where('status_id', '2')->where('assigned_to_user', Auth::user()->id)->get();

        $countOpenTicket = Ticket::where('status_id', '1')->where('assigned_to_user', Auth::user()->id)->where('role_id', 1)->orWhere('role_id', 2)->count();
        $countClosedTicket = Ticket::where('status_id', '2')->where('assigned_to_user', Auth::user()->id)->where('role_id', 1)->orWhere('role_id', 2)->count();
        return view('ticket.index', compact('tickets', 'countOpenTicket', 'countClosedTicket', 'countTotalProject', 'countTotalTicket'));
    }
}
