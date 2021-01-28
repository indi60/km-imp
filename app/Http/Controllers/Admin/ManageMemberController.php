<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Project;
use App\Ticket;

class ManageMemberController extends Controller
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
        $members = User::where('role_id', '2')->get();
        $guests = User::where('role_id', '3')->get();
        return view('admin.manage_member.index', compact('members', 'guests', 'countTotalProject', 'countTotalTicket'));
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
        $jobs = Job::all();
        return view('admin.manage_member.create', compact('jobs', 'countTotalProject', 'countTotalTicket'));
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
            'jenis_kelamin' => 'required',
            'job_id' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'jenis_kelamin' => $request->jenis_kelamin,
            'role_id' => $request->role_id,
            'job_id' => $request->job_id,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect('/manage-member')->with('status', 'Data ' . $request->name . ' Berhasil Ditambahkan!');
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
        $members = User::find($id);
        $jobs = Job::all();
        return view('admin.manage_member.edit', compact('members', 'jobs', 'countTotalProject', 'countTotalTicket'));
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
            'jenis_kelamin' => 'required',
            'job_id' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $members = User::find($id);
        $members->name = $request->name;
        $members->jenis_kelamin = $request->jenis_kelamin;
        $members->role_id = $request->role_id;
        $members->job_id = $request->job_id;
        $members->alamat = $request->alamat;
        $members->no_hp = $request->no_hp;
        $members->email = $request->email;
        $members->password = Hash::make($request->password);
        $members->update();
        return redirect('/manage-member')->with('status', 'Data ' . $request->name . ' Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $members = User::find($id);
        $members->delete();
        return redirect('/manage-member')->with('statusDelete', 'Data Berhasil Dihapus!');
    }

    public function approve($id)
    {
        $guests = User::find($id);
        $name = $guests->name;
        $guests->role_id = 2;
        $guests->update();
        return redirect('/manage-member')->with('status', 'Data ' . $name . ' Berhasil Diapprove!');
    }
}
