<?php

namespace App\Http\Controllers;

use App\Job;
use App\Project;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
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
        $userProfiles = User::where('id', Auth::user()->id)->get();
        return view('profile.index', compact('userProfiles', 'countTotalProject', 'countTotalTicket'));
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
        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();
        $userProfiles = User::find($id);
        $jobs = Job::all();
        return view('profile.edit', compact('userProfiles', 'jobs', 'countTotalProject', 'countTotalTicket'));
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
            'name' => 'nullable',
            'jenis_kelamin' => 'required',
            'role_id' => 'required',
            'job_id' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        $userProfiles = User::find($id);
        $userProfiles->name = $request->name;
        $userProfiles->jenis_kelamin = $request->jenis_kelamin;
        $userProfiles->role_id = $request->role_id;
        $userProfiles->job_id = $request->job_id;
        $userProfiles->alamat = $request->alamat;
        $userProfiles->no_hp = $request->no_hp;
        $userProfiles->update();
        return redirect('/profile')->with('status', 'Your Profile Has Been Updated!');
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

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required',
            'password' => 'required|max:255'
        ]);

        // Cross check the old password
        $oldPass = Auth::user()->password; // hashed
        if ($request->password === $request->confirmpassword) {
            if (Hash::check($request->oldpassword, $oldPass)) {
                // old pass shoud not be same as new pass
                if (!Hash::check($request->password, $oldPass)) {
                    $user = User::find(Auth::id());
                    $user->password = Hash::make($request->password);
                    $user->save();

                    // Logout
                    Auth::logout();
                    return redirect()->back();
                } else {
                    return redirect('/profile')->with('statusDelete', 'Kata sandi baru tidak boleh sama dengan kata sandi lama');
                }
            } else {
                return redirect('/profile')->with('statusDelete', 'Masukkan kata sandi lama yang benar');
            }
        } else {
            return redirect('/profile')->with('statusDelete', 'Kata sandi dan kata sandi konfirmasi anda tidak cocok');
        }
    }
}
