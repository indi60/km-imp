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
        $count_total_project = Project::all()->count();
        $count_total_tiket = Ticket::all()->count();
        $Members = User::where('role_id', '2')->get();
        $Guests = User::where('role_id', '3')->get();
        return view('admin.manage_member.index', compact('Members', 'Guests', 'count_total_project', 'count_total_tiket'));
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
        $Jobs = Job::all();
        return view('admin.manage_member.create', compact('Jobs', 'count_total_project', 'count_total_tiket'));
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
        $count_total_project = Project::all()->count();
        $count_total_tiket = Ticket::all()->count();
        $Members = User::find($id);
        $Jobs = Job::all();
        return view('admin.manage_member.edit', compact('Members', 'Jobs', 'count_total_project', 'count_total_tiket'));
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

        $Members = User::find($id);
        $Members->name = $request->name;
        $Members->jenis_kelamin = $request->jenis_kelamin;
        $Members->role_id = $request->role_id;
        $Members->job_id = $request->job_id;
        $Members->alamat = $request->alamat;
        $Members->no_hp = $request->no_hp;
        $Members->email = $request->email;
        $Members->password = Hash::make($request->password);
        $Members->update();
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
        $Members = User::find($id);
        $Members->delete();
        return redirect('/manage-member')->with('statusDelete', 'Data Berhasil Dihapus!');
    }

    public function approve($id)
    {
        $Guests = User::find($id);
        $name = $Guests->name;
        $Guests->role_id = 2;
        $Guests->update();
        return redirect('/manage-member')->with('status', 'Data ' . $name . ' Berhasil Diapprove!');
    }
}
